import "regenerator-runtime/runtime";

import getConfig from "../../../near_configs"
import {initContract} from "./utils"

window.nearConfig = getConfig(process.env.NODE_ENV || "development");

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
