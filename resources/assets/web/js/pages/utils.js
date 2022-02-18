import { connect, Contract, keyStores, WalletConnection } from 'near-api-js'
import * as nearAPI from "near-api-js"
import getConfig from "../../../near_configs"

const nearConfig = getConfig(process.env.NODE_ENV || 'development')

// // Initialize contract & set global variables
// export async function initContract() {
//   // Initialize connection to the NEAR testnet
//   const near = await connect(Object.assign({ deps: { keyStore: new keyStores.BrowserLocalStorageKeyStore() } }, nearConfig))

//   // Initializing Wallet based Account. It can work with NEAR testnet wallet that
//   // is hosted at https://wallet.testnet.near.org
//   window.walletConnection = new WalletConnection(near)

//   // Getting the Account ID. If still unauthorized, it's just empty string
//   window.accountId = window.walletConnection.getAccountId()

//   // Initializing our contract APIs by contract name and configuration
//   window.contract = await new Contract(window.walletConnection.account(), nearConfig.contractName, {
//     // View methods are read only. They don't modify the state, but usually return some value.
//     viewMethods: ['get_deposit','get_total_reward'],
//     // Change methods can modify the state. But you don't receive the returned value when called.
//     changeMethods: ['deposit','withdraw','remove_deposit'],
//   })
// }

export async function initContract()
{
    // Initializing connection to the NEAR node.
    window.near = await nearAPI.connect(Object.assign({ deps: { keyStore: new nearAPI.keyStores.BrowserLocalStorageKeyStore() } }, nearConfig));

    // Initializing Wallet based Account. It can work with NEAR TestNet wallet that
    // is hosted at https://wallet.testnet.near.org
    window.walletAccount = new nearAPI.WalletAccount(window.near);

    // Getting the Account ID. If unauthorized yet, it's just empty string.
    window.accountId = window.walletAccount.getAccountId();

    window.account = window.walletAccount.account();

    // Initializing our contract APIs by contract name and configuration.
    window.contract = await window.near.loadContract(nearConfig.contractTokenName, {
      // NOTE: This configuration only needed while NEAR is still in development
      // View methods are read only. They don't modify the state, but usually return some value.
        viewMethods: ['ft_balance_of'],
      // Change methods can modify the state. But you don't receive the returned value when called.
        changeMethods: ['ft_transfer_call'],
      // Sender is the account ID to initialize transactions.
        sender: window.accountId,
    });

    // Initializing our contract APIs by contract name and configuration.
    window.contractA2e = await window.near.loadContract(nearConfig.contractA2eName, {
        // NOTE: This configuration only needed while NEAR is still in development
        // View methods are read only. They don't modify the state, but usually return some value.
          viewMethods: ['get_total_deposit'],
        // Change methods can modify the state. But you don't receive the returned value when called.
          changeMethods: ['order', 'deposit'],
        // Sender is the account ID to initialize transactions.
          sender: window.accountId,
      });

}

export function logout() {
  window.walletConnection.signOut()
  // reload page
  window.location.replace(window.location.origin + window.location.pathname)
}

export function login() {
  // Allow the current app to make calls to the specified contract on the
  // user's behalf.
  // This works by creating a new access key for the user's account and storing
  // the private key in localStorage.
  window.walletConnection.requestSignIn(nearConfig.contractName)
}
