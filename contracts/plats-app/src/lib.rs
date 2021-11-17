
use near_sdk::borsh::{self, BorshDeserialize, BorshSerialize};
use near_sdk::{Balance, env, near_bindgen, AccountId,Promise};
use near_sdk::collections::{UnorderedMap};
use near_sdk::json_types::U128;
use std::collections::HashMap;
near_sdk::setup_alloc!();



// Game index
pub type GameID = u32;


// Storage on-chain
#[near_bindgen]
#[derive(Default,Clone,BorshDeserialize, BorshSerialize)]
pub struct Plats {
    owner_id: AccountId,
    reward: HashMap<GameID,Vec<(AccountId,u128,Actor)>>
    
}


// Smart contract
#[near_bindgen]
impl Plats {

    #[init]
    pub fn new(owner_id: AccountId) -> Self{
        assert!(env::is_valid_account_id(owner_id.as_bytes()), "Invalid Account Owner");
        assert!(env::state_exists(),"Already initialized");
        Self {
            owner_id,
            reward: Default::default()
        }
    }


    //payer: Client
    //actor_reward: Creator, Referral, User
    pub fn finish_game(&mut self, game_id:GameID, payer: AccountId, actor_reward:Vec<(AccountId,u128, Actor)>){
        let deposit = env::attached_deposit();
        let mut total_amount = 0;
        for (_, balance, _) in &actor_reward{
            total_amount += balance;
        }  

        assert!(total_amount < deposit, "Not enough tokens");


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





}
