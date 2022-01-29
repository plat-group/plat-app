import "regenerator-runtime/runtime";

import { initContract, login, logout } from './utils'

import getConfig from "../../../near_configs"

window.nearConfig = getConfig(process.env.NODE_ENV || "development");

const { KeyPair, utils, transactions } = require('near-api-js');
export const nearUtils = utils;
const DEFAULT_GAS = 300000000000000;

//Deposit
$('#btn-push-to-pool').click(async function(){
    const gameId = $('#game_id').val();
    const depositAmount = $('#total_budget').val();
    console.log(gameId)
    console.log(depositAmount)
    try {
        // Client must deposit token PLATS to a2e smartcontract
        const result = await window.account.signAndSendTransaction({
            receiverId: window.nearConfig.contractTokenName,
            actions: [
                transactions.functionCall(
                    'ft_transfer_call',
                    {
                        receiver_id: window.nearConfig.contractA2eName,
                        amount: utils.format.parseNearAmount(depositAmount),
                        msg: JSON.stringify({game_id : gameId})
                    },
                    DEFAULT_GAS,
                    "1"
                 )
            ]
        });
        console.log("Result: ", result);
    } catch (e) {
        console.log(e)
        alert(
            'Something went wrong! ' +
            'Maybe you need to sign out and back in? ' +
            'Check your browser console for more info.'
        );
        throw e;
    } finally {
        // setTimeout(() => {
        //     document.querySelector('[data-behavior=waiting-for-transaction]').style.display = 'none';
        //     document.querySelector('[data-behavior=waiting-for-transaction]').innerText = "Waiting for transaction..."
        // }, 11000);
    }
});

// `nearInitPromise` gets called on page load
window.nearInitPromise = initContract()
  .then(() => {
    // if (window.walletConnection.isSignedIn()) signedInFlow()
    // else signedOutFlow()
  })
  .catch(console.error)
