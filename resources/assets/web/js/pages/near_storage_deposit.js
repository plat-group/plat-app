import "regenerator-runtime/runtime";

import { initContract } from './utils'

import getConfig from "../../../near_configs"

window.nearConfig = getConfig(process.env.NODE_ENV || "development");

const { utils, transactions } = require('near-api-js');
export const nearUtils = utils;

async function deposit_storage() {
    let res;
    console.log(window.accountId)
    console.log(window.nearConfig.contractTokenName)
    try {

        const result = await window.account.signAndSendTransaction({
            // receiverId: "token.nghilt.testnet",
            receiverId: window.nearConfig.contractTokenName,
            actions: [
                transactions.functionCall(
                    'storage_deposit',
                    {},
                    10000000000000,
                    utils.format.parseNearAmount("0.01")
                )
            ]
        });
        console.log("Result: ", result);

    } catch (e) {
        console.log(e)
        // alert(
        //     'Something went wrong! ' +
        //     'Maybe you need to sign out and back in? ' +
        //     'Check your browser console for more info.'
        // );
        throw e;
    } finally {
        // setTimeout(() => {
        //     document.querySelector('[data-behavior=waiting-for-transaction]').style.display = 'none';
        //     document.querySelector('[data-behavior=waiting-for-transaction]').innerText = "Waiting for transaction..."
        // }, 11000);
    }
    console.log(res);
}

function isAlreadyDeposit() {
    //    http://localhost:3000/auth/register/larunglabay.testnet?transactionHashes=DiziHYmkwtsj6Z6gTAAhDp5Et6364vWzj6GD3HJ9xqja
    // TODO Must get deposit amount from blockchain
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const hash = urlParams.get('transactionHashes');
    return hash != undefined;
}

// `nearInitPromise` gets called on page load
window.nearInitPromise = initContract()
  .then(() => {
      if(!isAlreadyDeposit()) {
          deposit_storage();
      }
  })
  .catch(console.error)
