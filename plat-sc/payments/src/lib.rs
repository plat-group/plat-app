use std::convert::TryInto;
use std::fmt::format;
use near_sdk::borsh::{self, BorshDeserialize, BorshSerialize};
use near_sdk::collections::{LookupMap, UnorderedMap, Vector};
use near_sdk::json_types::{Base58PublicKey, U128, ValidAccountId};
use near_sdk::serde::{Deserialize, Serialize};
use near_sdk::{env, near_bindgen, AccountId, Balance, Promise, PublicKey, PromiseOrValue};
use near_sdk::env::panic;

use near_contract_standards::fungible_token::metadata::{
    FungibleTokenMetadata, FungibleTokenMetadataProvider, FT_METADATA_SPEC,
};
use near_sdk::{ext_contract};
use near_sdk::PromiseOrValue::Value;

near_sdk::setup_alloc!();

// use the attribute below for unit tests
#[cfg(test)]
mod tests;

pub type Gas = u64;


const BASE_GAS: Gas = 5_000_000_000_000;
const PROMISE_CALL: Gas = 5_000_000_000_000;
const GAS_FOR_FT_ON_TRANSFER: Gas = BASE_GAS + PROMISE_CALL;
const NO_DEPOSIT: Balance = 0;

// Game index
pub type GameID = String;
pub type OrderId = String;
pub type ClientAccount = AccountId;
pub type UserAccount = AccountId;
pub type ReferralAccount = AccountId;
pub type CreatorAccount = AccountId;

#[derive(Serialize, Deserialize, BorshDeserialize, BorshSerialize)]
#[serde(crate = "near_sdk::serde")]
pub struct GameInfo {
    pub creator: CreatorAccount,
    pub client: ClientAccount,
}

#[derive(Serialize, Deserialize, BorshDeserialize, BorshSerialize)]
#[serde(crate = "near_sdk::serde")]
pub struct RewardGameInfo {
    pub amount_reward_user: U128,
    pub amount_reward_referral: U128,
    pub amount_reward_creator: U128,
    pub amount_reward_team: U128,
}

// Đơn đặt hàng game của Client cho Creator

#[derive(Serialize, Deserialize, BorshDeserialize, BorshSerialize)]
#[serde(crate = "near_sdk::serde")]
pub struct Order {
    pub template_game_id: String,
    pub order_cost: U128,
    pub amount_creator: U128,
    pub client_id: ClientAccount,
    pub creator_id: CreatorAccount,
}

impl Order {
    // Trả tiền thuê làm game cho creator
    pub fn pay_order_cost(&self) {
        Promise::new(self.creator_id.clone()).transfer(self.order_cost.0);
    }
}

// Storage on-chain
#[near_bindgen]
#[derive(BorshDeserialize, BorshSerialize)]
pub struct Plats {
    owner_id: AccountId,                        //owner smart contract
    ft_account: AccountId,                        //token managerß =>TODO: Khong sử dụng
    games: LookupMap<GameID, GameInfo>,         // Game
    client_deposit: LookupMap<GameID, U128>,         // Game
    rewards: LookupMap<GameID, RewardGameInfo>, // Reward configure of game
    orders: LookupMap<OrderId, Order>,          // Đơn đặt hàng của Client và Creator
}

impl Default for Plats {
    fn default() -> Self {
        panic!("Should be initialized before usage")
    }
}

#[ext_contract(ext_ft)]
trait Contract {
    // fn ft_metadata(&self) -> FungibleTokenMetadata;
    //
    // fn ft_balance_of(&self, account_id: ValidAccountId) -> U128;
    //
    // fn ft_transfer_call(
    //     &mut self,
    //     receiver_id: ValidAccountId,
    //     amount: U128,
    //     memo: Option<String>,
    //     msg: String,
    // ) -> PromiseOrValue<U128>;

    fn ft_transfer(&mut self,
                   receiver_id: ValidAccountId,
                   amount: U128,
                   memo: Option<String>);
}

pub trait FungibleTokenReceiver {
    fn ft_on_transfer(
        &mut self,
        sender_id: AccountId,
        amount: U128,
        msg: String,
    ) -> PromiseOrValue<U128>;
}


#[derive(Serialize, Deserialize)]
struct PaymentInfo {
    game_id: String
}

#[near_bindgen]
impl FungibleTokenReceiver for Plats {
    fn ft_on_transfer(
        &mut self,
        sender_id: AccountId,
        amount: U128,
        msg: String,
    ) -> PromiseOrValue<U128> {

        let json_result: PaymentInfo = serde_json::from_str(&msg.as_str()).unwrap();

        let id = json_result.game_id;

        let  amount_deposit = self.client_deposit.get(&id).unwrap_or(U128(0));
        self.client_deposit.remove(&id);
        self.client_deposit.insert(&id, &U128(amount_deposit.0 + amount.0));

        Value(U128::from(0))

    }
}


#[ext_contract(ext_self)]
trait PlatTokenCallBack {
    fn callback_ft_metadata(&self) -> FungibleTokenMetadata;
}


// Smart contract
#[near_bindgen]
impl Plats {
    #[init]
    pub fn new(owner_id: AccountId, ft_account: AccountId) -> Self {
        assert!(
            env::is_valid_account_id(owner_id.as_bytes()),
            "Invalid Account Owner"
        );
        assert!(!env::state_exists(), "Already initialized");
        Self {
            owner_id,
            ft_account,
            client_deposit: LookupMap::new(b"client_deposit".to_vec()),
            games: LookupMap::new(b"game".to_vec()),
            rewards: LookupMap::new(b"rewards".to_vec()),
            orders: LookupMap::new(b"orders".to_vec()),
        }
    }

    pub fn order(
        &mut self,
        template_game_id: String,
        order_code: OrderId,
        creator_id: ClientAccount,
        order_cost: U128,
        amount_creator: U128,
    ) {
        let client_id = env::signer_account_id();

        if self.orders.contains_key(&order_code) {
            env::panic(format!("Order Code Already Exist").as_bytes());
        }

        let order = Order {
            creator_id,
            client_id,
            template_game_id,
            order_cost,
            amount_creator
        };

        self.orders.insert(&order_code, &order);
    }

    #[payable]
    pub fn deposit(
        &mut self,
        order_code: OrderId,
        game_id: GameID,
        amount_user: U128,
        amount_referral: U128,
    ) {
        let client_id = env::signer_account_id();
        let order = self
            .orders
            .get(&order_code)
            .expect("Client should order game first");

        // check client deposit hay chưa
        let amount_deposit = self.client_deposit.get(&game_id).expect("Client Must be deposit");

        assert_eq!(amount_deposit.0 <= 0, true);

        if order.client_id != client_id {
            env::panic(format!("Client doest deposit in order").as_bytes());
        }
        order.pay_order_cost();

        let reward_game_info = RewardGameInfo {
            amount_reward_team: U128(((amount_referral.0 as f32) * 0.01) as u128),
            amount_reward_referral: amount_referral,
            amount_reward_user: amount_user,
            amount_reward_creator: order.amount_creator,
        };

        self.rewards.insert(&game_id, &reward_game_info);

        // Taoj GameInfo
        if self.games.contains_key(&game_id) {
            // TODO: GameExistedException
            env::panic(format!("Game Id Existed").as_bytes());
        } else {
            let game_info = GameInfo {
                creator: order.creator_id,
                client: client_id
            };
            self.games.insert(&game_id, &game_info);
        }
    }

    // Owner tạo game nhanh khi chính owner là người tạo ra game(không cần creator)
    //


    #[private]
    #[payable]
    pub fn create_fast_game(&mut self,
                game_id: GameID,
        creator_id: CreatorAccount,
        client_id: ClientAccount,
        amount_creator: U128,
        amount_referral: U128,
        amount_user: U128
    ) {

        // check client deposit hay chưa
        let amount_deposit = self.client_deposit.get(&game_id).expect("Client Must be deposit");
        assert_eq!(amount_deposit.0 <= 0, false);


        if self.games.contains_key(&game_id) {
            panic(format!("Game {} is existed" , game_id).as_bytes());
        }

        if self.rewards.contains_key(&game_id) {
            panic(format!("Reward Game {} is existed" , game_id).as_bytes());
        }

        // TODO: check rewards đã tồn tại hay chưa ?
        let reward_game_info = RewardGameInfo {
            amount_reward_team : U128(((amount_referral.0 as f32) * 0.01) as u128),
            amount_reward_referral: amount_referral,
            amount_reward_user: amount_user,
            amount_reward_creator: amount_creator
        };

        self.rewards.insert(&game_id, &reward_game_info);

        let game_info = GameInfo {
            creator: creator_id,
            client: client_id
        };
        self.games.insert(&game_id, &game_info);

    }

    #[payable]
    pub fn test1111(&mut self, receiver_id: String, amount: U128) {
        let prepaid_gas = env::prepaid_gas();

        // ext_ft::ft_transfer_call(
        //     "a2e-team.lienl2.testnet".to_string().try_into().unwrap(),
        //     U128(10),
        //     Some("PLT".to_string()),
        //     prepaid_gas.to_string(),
        //     &self.ft_account,
        //     1, // yocto NEAR to attach
        //     GAS_FOR_FT_ON_TRANSFER // gas to attach
        // );

        panic(
            format!("{}", self.ft_account.clone()).as_bytes()
        );
        ext_ft::ft_transfer(
            receiver_id.try_into().unwrap(),
            amount,
            Some("memo".to_string()),
            &self.ft_account,
            1, // yocto NEAR to attach
            GAS_FOR_FT_ON_TRANSFER // gas to attach
        );
    }

    fn transfer_token(&mut self, receiver_id: String, amount: U128) {
        ext_ft::ft_transfer(
            receiver_id.clone().try_into().unwrap(),
            amount,
            None,
            &self.ft_account,
            1, // yocto NEAR to attach
            GAS_FOR_FT_ON_TRANSFER // gas to attach
        );
    }

    #[private]
    #[payable]
    pub fn reward(&mut self, game_id: GameID, user_id: UserAccount, referral_id: ReferralAccount) -> U128{
        let mut game_info = self.games.get(&game_id).unwrap();
        let reward = self.rewards.get(&game_id).unwrap();
        let client_deposit = self.client_deposit.get(&game_id).unwrap_or(U128::from(0));

        // Kiểm tra số lượng deposit hiện có của client
        let mut total_rewards = reward.amount_reward_team.0;

        if client_deposit.0 < total_rewards {
            env::panic(format!("NotEnoughDepositAmount").as_bytes());
        }

        //TODO: Xử lý trường hợp gửi không thành công
        // Trả thưởng cho các đối tượng
        if !user_id.clone().is_empty() {
            self.transfer_token(user_id.clone(), reward.amount_reward_user);
            total_rewards += reward.amount_reward_user.0;
        }

        if !referral_id.clone().is_empty() {
            self.transfer_token(referral_id.clone(), reward.amount_reward_referral);
            total_rewards += reward.amount_reward_referral.0;
        }

        if !game_info.creator.clone().is_empty() {
            self.transfer_token(game_info.creator.clone(), reward.amount_reward_creator);
            total_rewards += reward.amount_reward_referral.0;
        }

        let new_deposit = client_deposit.0 - total_rewards;
        self.client_deposit.remove(&game_id);
        self.client_deposit.insert(&game_id, &U128(new_deposit));

        // Trả về số lượng deposit còn lại
        U128(new_deposit)
    }

    pub fn get_total_deposit(&self, game_id: GameID) -> u128 {
        let game_info = self
            .client_deposit
            .get(&game_id)
            .expect("Client should be deposit first");
        game_info.0
    }

}
