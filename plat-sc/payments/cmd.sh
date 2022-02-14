ID=a2e.lienlq3.testnet
MASTER=lienlq3.testnet

near create-account $ID --masterAccount $MASTER --initialBalance 30
near delete $ID $MASTER

near call $MASTER storage_deposit '' --accountId $ID --amount 0.00125

cargo build --target wasm32-unknown-unknown --release
near deploy --accountId $ID --wasmFile target/wasm32-unknown-unknown/release/anytoearn.wasm

near call $ID new '{"owner_id": "'$ID'" ,"ft_account": "'$PLATTOKEN'" }' --accountId $ID

near view $ID ft_metadata_ '{}' --accountId $ID

near call $ID test '{}' --accountId plat-token.lienlq3.testnet
near call $ID test '{"receiver_id": "lienlq1.testnet", "amount" : "10000000"}' --accountId plat-token.lienlq3.testnet

near view $ID get_total_deposit '{"game_id": "1lienlq3.testnet"}' --accountId $ID
near view $ID get_total_deposit '{"game_id": "1"}' --accountId $ID

# Create actors
PLATTOKEN=plat-token.lienlq3.testnet
#CLIENT=a2e-client.lienlq3.testnet
#CLIENT=nearclient.testnet
CLIENT=platclient.testnet
CREATOR=a2e-creator.lienlq3.testnet
REFERRAL=a2e-referral.lienlq3.testnet
USER=a2e-user.lienlq3.testnet
TEAM=a2e-team.lienlq3.testnet

near create-account $CLIENT --masterAccount lienlq3.testnet --initialBalance 10
near create-account $CREATOR --masterAccount lienlq3.testnet --initialBalance 10
near create-account $REFERRAL --masterAccount lienlq3.testnet --initialBalance 10
near create-account $USER --masterAccount lienlq3.testnet --initialBalance 10
near create-account $TEAM --masterAccount lienlq3.testnet --initialBalance 10

# KHởi tạo storage của SMC
near call $ID new '{"owner_id": "'$ID'" ,"ft_account": "'$PLATTOKEN'" }' --accountId $ID


#deposit storage for actions
near call $PLATTOKEN storage_deposit '' --accountId $CLIENT --amount 0.00125
near call $PLATTOKEN storage_deposit '' --accountId $CREATOR --amount 0.00125
near call $PLATTOKEN storage_deposit '' --accountId $REFERRAL --amount 0.00125
near call $PLATTOKEN storage_deposit '' --accountId $USER --amount 0.00125
near call $PLATTOKEN storage_deposit '' --accountId $TEAM --amount 0.00125
near call $PLATTOKEN storage_deposit '{"account_id": "'$USER'"}' --accountId $ID --amount 0.00125

# Transfer PLT token to Client (1M PLT)
near call $PLATTOKEN ft_transfer '{"receiver_id": "'$CLIENT'", "amount": "1000000000000000000000000000000"}' --accountId $PLATTOKEN --amount 0.000000000000000000000001
near view $PLATTOKEN ft_balance_of '{"account_id": "'$CLIENT'"}'
near view $PLATTOKEN ft_balance_of '{"account_id": "'$CREATOR'"}'
near view $PLATTOKEN ft_balance_of '{"account_id": "'$REFERRAL'"}'
near view $PLATTOKEN ft_balance_of '{"account_id": "'$USER'"}'

# Client deposit
GAME=2
near call $PLATTOKEN ft_transfer_call '{"receiver_id": "'$ID'", "amount": "100000000000000000000000000", "msg" : " {\"game_id\" : \"2\"}  "}' --accountId $CLIENT --amount 0.000000000000000000000001 --gas 50000000000000 --depositYocto 1

# Create game fast
near call $ID create_fast_game '{ "game_id" : "2", "creator_id" : "'$CREATOR'"  , "client_id" : "'$CLIENT'" , "amount_creator" : "2000000000000000000000000",  "amount_referral" : "0" , "amount_user" : "100000000000000000000000"}' \
--accountId $ID

# Rewards
near call $ID reward '{ "game_id" : "2", "user_id" : "platserver.testnet", "referral_id" : ""  }' --accountId $ID --gas 50000000000000 --depositYocto 1
near call $ID reward '{"game_id":"1ec88eb2-14fb-6914-8581-068e4ee6e93c", "user_id":"platreferral.testnet", "referral_id" : "" }' --accountId $ID --gas 50000000000000 --depositYocto 1



near call $ID test1111 '{"receiver_id" : "platserver.testnet", "amount" : "111111"}'  --accountId $ID --gas 50000000000000 --depositYocto 1