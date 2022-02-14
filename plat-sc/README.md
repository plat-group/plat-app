# plat-sc

Plat Smart Contract in Rust
=================================


## Description



## To Run

```
git clone https://github.com/plat-group/plat-sc.git
```


If you don't have `Rust` installed, complete the following 3 steps:

1) Install Rustup by running:

```
curl --proto '=https' --tlsv1.2 -sSf https://sh.rustup.rs | sh
```

([Taken from official installation guide](https://www.rust-lang.org/tools/install))

2) Configure your current shell by running:

```
source $HOME/.cargo/env
```

3) Add wasm target to your toolchain by running:

```
rustup target add wasm32-unknown-unknown
```

Next, make sure you have `near-cli` by running:

```
near --version
```

If you need to install `near-cli`:

```
npm install near-cli -g
```

## Login
If you do not have a NEAR account, please create one with [NEAR Wallet](https://wallet.testnet.near.org).

In the project root, login with `near-cli` by following the instructions after this command:

```
near login
```

Modify the top of `src/config.js`, changing the `CONTRACT_NAME` to be the NEAR account that was just used to log in.

```javascript
…
const CONTRACT_NAME = 'YOUR_ACCOUNT_NAME_HERE'; /* TODO: fill this in! */
…
```

Start the example!

```
yarn start
```

## To Test

```
cd contract
cargo test -- --nocapture
```

## To Explore

- `contract/src/lib.rs` for the contract code
- `src/index.html` for the front-end HTML
- `src/main.js` for the JavaScript front-end code and how to integrate contracts
- `src/test.js` for the JS tests for the contract

## To Build the Documentation

```
cd contract
cargo doc --no-deps --open
```


# Steps to deploy smart contract and test

## Create sub account
MASTER=platserver.testnet
PLATTOKENID=token-nghi.platserver.testnet
A2EID=a2e-nghi.platserver.testnet

near create-account $PLATTOKENID --masterAccount $MASTER --initialBalance 20
near create-account $A2EID --masterAccount $MASTER --initialBalance 20

## Deploy token contract
cd plats-token
cargo build --target wasm32-unknown-unknown --release
near deploy --accountId $PLATTOKENID --wasmFile target/wasm32-unknown-unknown/release/plats_token.wasm

### Init contract (with symbol)
near call $PLATTOKENID new_default_meta '{"owner_id": "'$PLATTOKENID'"}' --accountId $PLATTOKENID

## Deploy a2e contrct
cd ../payments
cargo build --target wasm32-unknown-unknown --release
near deploy --accountId $A2EID --wasmFile target/wasm32-unknown-unknown/release/anytoearn.wasm

### Init contract
near call $A2EID new '{"owner_id": "'$A2EID'" ,"ft_account": "'$PLATTOKENID'" }' --accountId $A2EID

## Deposit storage cho account master de mint token plat
near call $PLATTOKENID storage_deposit '' --accountId $MASTER --amount 0.00125
### mint
near call $PLATTOKENID ft_transfer '{"receiver_id": "'$MASTER'", "amount": "10000000000000000000000000"}' --accountId $PLATTOKENID --amount 0.000000000000000000000001

## Deposit storage cho account platclient de transfer token plat
near call $PLATTOKENID storage_deposit '{"account_id": "platclient.testnet"}' --accountId $PLATTOKENID --amount 0.00125
near call $PLATTOKENID ft_transfer '{"receiver_id": "platclient.testnet", "amount": "2000000000000000000000000000"}' --accountId $PLATTOKENID --amount 0.000000000000000000000001

## Deposit storage cho account a2e de nhan token plat tu client
near call $PLATTOKENID storage_deposit '' --accountId $A2EID --amount 0.00125


## Deposit storage cho cac account de nhan token plat khi reward (for testing only)
near call $PLATTOKENID storage_deposit '{"account_id": "platreferral.testnet"}' --accountId $PLATTOKENID --amount 0.00125
near call $PLATTOKENID storage_deposit '{"account_id": "platuser.testnet"}' --accountId $PLATTOKENID --amount 0.00125
near call $PLATTOKENID storage_deposit '{"account_id": "platcreator.testnet"}' --accountId $PLATTOKENID --amount 0.00125