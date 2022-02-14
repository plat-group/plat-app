ID=plat-token.lienlq3.testnet
ID2=a2e1.lienlq3.testnet
MASTER=lienlq3.testnet

near create-account $ID --masterAccount $MASTER --initialBalance 20
near create-account $ID2 --masterAccount $MASTER --initialBalance 20
near delete $ID $MASTER

cargo build --target wasm32-unknown-unknown --release

#near deploy --accountId $MASTER --wasmFile target/wasm32-unknown-unknown/release/plats_token.wasm
near deploy --accountId $ID --wasmFile target/wasm32-unknown-unknown/release/plats_token.wasm

# 000000000000000000000000
near call $ID new_default_meta '{"owner_id": "'$ID'"}' --accountId $ID
#near call $ID new '{"owner_id": "'$ID'", "total_supply": "1000000000000000000000000000000000", "metadata": { "spec": "ft-1.0.0", "name": "Plats1", "symbol": "PLT", "decimals": 24 }}' --accountId $ID

near call $ID storage_deposit '' --accountId $MASTER --amount 0.00125
near call $ID ft_transfer '{"receiver_id": "'$MASTER'", "amount": "10000000000000000000000000"}' --accountId $ID --amount 0.000000000000000000000001

near call $ID storage_deposit '' --accountId $ID2 --amount 0.00125
near call $ID ft_transfer_call '{"receiver_id": "'$ID2'", "amount": "100000000000000000000", "msg" : " {\"game_id\" : \"1\"}  "}' --accountId $ID --amount 0.000000000000000000000001 --gas 50000000000000 --depositYocto 1
near call $ID ft_transfer_call '{"receiver_id": "'$ID2'", "amount": "100000000000000000000", "msg" : "1"}' --accountId $ID --amount 0.000000000000000000000001 --gas 50000000000000 --depositYocto 1

near view $ID ft_balance_of '{"account_id": "'$ID2'"}'
near view $ID ft_balance_of '{"account_id": "'$MASTER'"}'

# Create actors
CLIENT=a2e-client.lienlq1.testnet
CREATOR=a2e-creator.quanglien.testnet
REFERRAL=a2e-referral.quanglien.testnet
USER=a2e-user.quanglien.testnet

near create-account $CLIENT --masterAccount quanglien.testnet --initialBalance 10
near create-account $CREATOR --masterAccount quanglien.testnet --initialBalance 10
near create-account $REFERRAL --masterAccount quanglien.testnet --initialBalance 10
near create-account $USER --masterAccount quanglien.testnet --initialBalance 10

near view $PLATTOKEN storage_balance_of '{"account_id": "platclient1.testnet"}'

# Order game
near call $ID order '{"owner_id": "'$ID'"}' --accountId $ID

near call $ID add '{"_name": "Mua Window Surface", "_value": 1000000}' --accountId $ID

near view $ID get '' --accountId $ID

near call $ID add '{"_name": "Mua MacBookPro", "_value": 10000000, "time": "21/1/2022"}' --accountId quanglien.testnet
near call $ID add '{"_name": "Mua Iphone11", "_value": 2000000, "time": "22/1/2022"}' --accountId $ID

near view $ID get '' --accountId $ID