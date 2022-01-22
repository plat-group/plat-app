import "regenerator-runtime/runtime";

import * as nearAPI from "near-api-js"
import getConfig from "../../../near_configs"

window.nearConfig = getConfig(process.env.NODE_ENV || "development");

// Initializing contract
async function initContract()
{
  // Initializing connection to the NEAR node.
    window.near = await nearAPI.connect(Object.assign({ deps: { keyStore: new nearAPI.keyStores.BrowserLocalStorageKeyStore() } }, nearConfig));

  // Initializing Wallet based Account. It can work with NEAR TestNet wallet that
  // is hosted at https://wallet.testnet.near.org
    window.walletAccount = new nearAPI.WalletAccount(window.near);

  // Getting the Account ID. If unauthorized yet, it's just empty string.
    window.accountId = window.walletAccount.getAccountId();

  // Initializing our contract APIs by contract name and configuration.
    window.contract = await window.near.loadContract(nearConfig.contractName, {
      // NOTE: This configuration only needed while NEAR is still in development
      // View methods are read only. They don't modify the state, but usually return some value.
        viewMethods: ['whoSaidHi'],
      // Change methods can modify the state. But you don't receive the returned value when called.
        changeMethods: ['sayHi'],
      // Sender is the account ID to initialize transactions.
        sender: window.accountId,
    });
}

// Using initialized contract
async function doWork()
{
  // Based on whether you've authorized, checking which flow we should go.
    if (!window.walletAccount.isSignedIn()) {
        signedOutFlow();
    } else {
        signedInFlow();
    }
}

// Function that initializes the signIn button using WalletAccount
function signedOutFlow()
{
  // Adding an event to a sing-in button.
    window.walletAccount.requestSignIn(
        // The contract name that would be authorized to be called by the user's account.
        window.nearConfig.contractName,
        // This is the app name. It can be anything.
        'Plats Network',
        // We can also provide URLs to redirect on success and failure.
        // The current URL is used by default.
    );
}

// Main function for the signed-in flow (already authorized by the wallet).
function signedInFlow()
{
    if ($('#page_action').val() === 'login') {
        // User request login to Plats
        $.post(ROUTES.LOGIN, {account_id: window.accountId}).done((data) => {
            window.location.replace(data.redirect);
        }).fail((err) => {
            window.location.replace(ROUTES.REGISTER + '/' + window.accountId);
        });
    } else {
        walletAccount.signOut();
        window.location.replace(window.location.origin);
    }

    return;
}

// Loads nearAPI and this contract into window scope.
initContract()
  .then(doWork)
  .catch(console.error);
