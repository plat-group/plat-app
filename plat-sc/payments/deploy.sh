

MASTER=platserver.testnet
PLATTOKEN=token.platserver.testnet

near create-account $PLATTOKEN --masterAccount $MASTER --initialBalance 20
near delete $PLATTOKEN $MASTER
near deploy --accountId $PLATTOKEN --wasmFile target/wasm32-unknown-unknown/release/plats_token.wasm

near call $PLATTOKEN new '{"owner_id": "'$PLATTOKEN'", "total_supply": "1000000000000000000000000000000000", "metadata": { "spec": "ft-1.0.0", "name": "Plats", "symbol": "PLT", "decimals": 24 }}' --accountId $PLATTOKEN

near call $PLATTOKEN storage_deposit '' --accountId $MASTER --amount 0.00125
near call $PLATTOKEN ft_transfer '{"receiver_id": "'$MASTER'", "amount": "100000000000000000000000000"}' --accountId $PLATTOKEN --amount 0.000000000000000000000001


ID=a2e.platserver.testnet
MASTER=platserver.testnet

near create-account $ID --masterAccount $MASTER --initialBalance 30
near delete $ID $MASTER

# Deposit storage for $ID
near call $PLATTOKEN storage_deposit '' --accountId $ID --amount 0.00125


cargo build --target wasm32-unknown-unknown --release
near deploy --accountId $ID --wasmFile target/wasm32-unknown-unknown/release/anytoearn.wasm

near call $ID new '{"owner_id": "'$ID'" ,"ft_account": "'$PLATTOKEN'" }' --accountId $ID