use super::*;
use near_sdk::{log, testing_env, VMContext};
use near_sdk::{BlockchainInterface, MockedBlockchain};

// part of writing unit tests is setting up a mock context
// in this example, this is only needed for env::log in the contract
// this is also a useful list to peek at when wondering what's available in env::*

pub const GAME_TEMPLATE1: &str = "GameTemplate1";
pub const GAME_TEMPLATE2: &str = "GameTemplate2";

pub const GAME_ID1: &str = "Game1";
pub const GAME_ID2: &str = "Game2";

pub const ORDER_CODE1: &str = "OrderCode1";
pub const ORDER_CODE2: &str = "OrderCode2";

pub const CREATOR1: &str = "Creator1";
pub const CREATOR2: &str = "Creator2";

pub const REFERRAL: &str = "Referral";

pub const FT_ACCOUNT : &str = "ftaccount.testnet";

fn ntoy(near_amount: u128) -> U128 {
    U128(near_amount * 10u128.pow(24))
}

fn get_context(input: Vec<u8>, is_view: bool) -> VMContext {
    VMContext {
        current_account_id: "alice.testnet".to_string(), // smart contract
        signer_account_id: "robert.testnet".to_string(), // signer smart contract
        signer_account_pk: vec![0, 1, 2],
        predecessor_account_id: "jane.testnet".to_string(),
        input,
        block_index: 0,
        block_timestamp: 0,
        account_balance: 0,
        account_locked_balance: 0,
        storage_usage: 100000,
        attached_deposit: 0,
        prepaid_gas: 10u64.pow(18),
        random_seed: vec![0, 1, 2],
        is_view,
        output_data_receivers: vec![],
        epoch_height: 19,
    }
}

#[test]
fn test_order_should_work() {
    let context = get_context(vec![], false);
    testing_env!(context.clone());

    let mut contract = Plats::new(context.current_account_id.clone(), FT_ACCOUNT.to_string());
    contract.order(
        GAME_TEMPLATE1.to_string(),
        ORDER_CODE1.to_string(),
        CREATOR1.to_string(),
        U128(100000000000),
        U128(100),
    );

    let order_info = contract.orders.get(&ORDER_CODE1.to_string()).unwrap();

    assert_eq!(order_info.template_game_id, GAME_TEMPLATE1.to_string());
}

#[test]
#[should_panic(expected = "Order Code Already Exist")]
fn test_order_shoud_fail() {
    let context = get_context(vec![], false);
    testing_env!(context.clone());

    let mut contract = Plats::new(context.current_account_id.clone(), FT_ACCOUNT.to_string());
    contract.order(
        GAME_TEMPLATE1.to_string(),
        ORDER_CODE1.to_string(),
        CREATOR1.to_string(),
        U128(100000000000),
        U128(100),
    );
    contract.order(
        GAME_TEMPLATE2.to_string(),
        ORDER_CODE1.to_string(),
        CREATOR1.to_string(),
        U128(100000000000),
        U128(100),
    );
}

#[test]
fn test_deposit_should_work() {
    // set up the mock context into the testing environment
    let mut context = get_context(vec![], false);
    context.attached_deposit = ntoy(2).into();
    testing_env!(context.clone());

    let mut contract = Plats::new(context.current_account_id.clone(), FT_ACCOUNT.to_string());

    contract.order(
        GAME_TEMPLATE1.to_string(),
        ORDER_CODE1.to_string(),
        CREATOR1.to_string(),
        U128(100000000000),
        U128(100),
    );

    contract.deposit(
        ORDER_CODE1.to_string(),
        GAME_ID1.to_string(),
        U128(1000),
        U128(2000),
    );

    let deposit_amount = contract.get_total_deposit(GAME_ID1.to_string());
    assert_eq!(deposit_amount, ntoy(2).into());

    let game_reward = contract.rewards.get(&GAME_ID1.to_string()).unwrap();

    assert_eq!(game_reward.amount_reward_creator, U128(100));
    assert_eq!(game_reward.amount_reward_referral, U128(2000));
    assert_eq!(game_reward.amount_reward_user, U128(1000));
}

#[test]
fn test_rewards_should_work() {
    let mut context = get_context(vec![], false);
    context.attached_deposit = 10000;
    testing_env!(context.clone());

    let mut contract = Plats::new(context.current_account_id.clone(), FT_ACCOUNT.to_string());

    contract.order(
        GAME_TEMPLATE1.to_string(),
        ORDER_CODE1.to_string(),
        CREATOR1.to_string(),
        U128(100000000000),
        U128(100),
    );

    contract.deposit(
        ORDER_CODE1.to_string(),
        GAME_ID1.to_string(),
        U128(1000),
        U128(2000),
    );

    let deposit_amount = contract.get_total_deposit(GAME_ID1.to_string());
    assert_eq!(deposit_amount, 10000);
}


#[test]
pub fn test_create_game_fast() {

}