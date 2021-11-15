
use near_sdk::borsh::{self, BorshDeserialize, BorshSerialize};
use near_sdk::{Balance, env, near_bindgen, AccountId};
use near_sdk::collections::{UnorderedMap};
use std::collections::HashMap;
near_sdk::setup_alloc!();


#[derive(Clone,BorshDeserialize, BorshSerialize)]
pub enum Status {
    PENDING,
    AVAILABLE, // Creator push game
    CREATOR_CANCELLED, // Creator cancel game
    ORDERED, // Client order game
    ORDER_CANCELLED, // Client cancel game
    PROMOTING // Referral generate link
}

// Game index
pub type GameID = u32;

// Game information 
#[derive(Clone,BorshDeserialize, BorshSerialize)]
pub struct GameInfo {
    creator_id: AccountId,
    clients: Vec<AccountId>,
    referrals: Vec<AccountId>,
    status: Status
}

impl Default for Status{
    fn default() -> Self{
        Status::PENDING
    }
}
impl Default for GameInfo{
    fn default() -> Self{
        
        Self {
            creator_id:"".to_string(),
            clients: Vec::new(),
            referrals:Vec::new(),
            status:Default::default()
        }
    }
}

// Storage on-chain
#[near_bindgen]
#[derive(Default,Clone,BorshDeserialize, BorshSerialize)]
pub struct Plats {
    games: HashMap<GameID, Option<GameInfo>>,
    
}


// Smart contract
#[near_bindgen]
impl Plats {

    pub fn create_game(&mut self, game_id: GameID) {
        
        let creator = env::signer_account_id();

        assert!(
            !self.games.contains_key(&game_id),
            "Game is duplicated"
        );

        let game_info = GameInfo{
            creator_id: creator,
            clients: Default::default(),
            referrals: Default::default(),
            status: Status::AVAILABLE
        };
        self.games.insert(game_id,Some(game_info) );
        env::log(format!("Created game successfully").as_bytes());


    }



    pub fn get_game_id_created(&mut self) -> Vec<GameID>{
        self.games.clone().into_iter().map(|val| val.0).collect()
    }




}

// use the attribute below for unit tests
#[cfg(test)]
mod tests {
    use super::*;
    use near_sdk::MockedBlockchain;
    use near_sdk::{testing_env, VMContext};

    // part of writing unit tests is setting up a mock context
    // in this example, this is only needed for env::log in the contract
    // this is also a useful list to peek at when wondering what's available in env::*
    fn get_context(input: Vec<u8>, is_view: bool) -> VMContext {
        VMContext {
            current_account_id: "alice.testnet".to_string(),
            signer_account_id: "robert.testnet".to_string(),
            signer_account_pk: vec![0, 1, 2],
            predecessor_account_id: "jane.testnet".to_string(),
            input,
            block_index: 0,
            block_timestamp: 0,
            account_balance: 0,
            account_locked_balance: 0,
            storage_usage: 0,
            attached_deposit: 0,
            prepaid_gas: 10u64.pow(18),
            random_seed: vec![0, 1, 2],
            is_view,
            output_data_receivers: vec![],
            epoch_height: 19,
        }
    }

    #[test]
    fn check_create_game_non_game(){
        // set up the mock context into the testing environment
        let context = get_context(vec![], false);
        testing_env!(context);
        
        let mut game = Plats::default();
        game.create_game(1);
        assert_eq!(1,game.get_game_id_created().len());
    }
    #[test]
    fn check_create_game_exist_game(){
        // set up the mock context into the testing environment
        let context = get_context(vec![], false);
        testing_env!(context);
        
        let mut game = Plats::default();
        game.create_game(1);
        game.create_game(2);
        game.create_game(3);
        game.create_game(4);

        //Number game created
        assert_eq!(4,game.get_game_id_created().len());
    }


    /*
    fn check_create_game_duplicate_game(){
        // set up the mock context into the testing environment
        let context = get_context(vec![], false);
        testing_env!(context);
        
        let mut game = Plats{games: Default::default()};
        game.create_game(1);

        //assert_eq!(game.create_game(1),"Game is duplicated");
        //assert_ne!(vec![1],game.get_game_id_created());
    }
    */


}
