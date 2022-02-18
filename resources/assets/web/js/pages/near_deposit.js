import "regenerator-runtime/runtime";

import { initContract, login, logout } from './utils'

import getConfig from "../../../near_configs"

window.nearConfig = getConfig(process.env.NODE_ENV || "development");

const { KeyPair, utils, transactions } = require('near-api-js');
export const nearUtils = utils;
const DEFAULT_GAS = 300000000000000;

//Deposit
$('#btn-order').click(function(){
    let amountElements = $('input[name="agreement_amount"]');
    let amount = amountElements[0].value;
    let res;

    try {
        //document.querySelector('[data-behavior=waiting-for-transaction]').style.display = 'block';
        res = window.contract.deposit({game_id:1}, DEFAULT_GAS, nearUtils.format.parseNearAmount(amount));
    } catch (e) {
        alert(
            'Something went wrong! ' +
            'Maybe you need to sign out and back in? ' +
            'Check your browser console for more info.'
        );
        throw e;
    } finally {
        setTimeout(() => {
            document.querySelector('[data-behavior=waiting-for-transaction]').style.display = 'none';
            document.querySelector('[data-behavior=waiting-for-transaction]').innerText = "Waiting for transaction..."
        }, 11000);
    }
    console.log(res);
});

// `nearInitPromise` gets called on page load
window.nearInitPromise = initContract()
  .then(() => {
    // if (window.walletConnection.isSignedIn()) signedInFlow()
    // else signedOutFlow()
  })
  .catch(console.error)
