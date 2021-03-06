import "regenerator-runtime/runtime";

import { initContract } from './utils'

import getConfig from "../../../near_configs"

window.nearConfig = getConfig(process.env.NODE_ENV || "development");

const {  utils, transactions } = require('near-api-js');
export const nearUtils = utils;
const DEFAULT_GAS = 100000000000000;

// When load
$(function () {

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const txtHash = urlParams.get('transactionHashes');

    // TODO need check valid hash
    if(txtHash == undefined || txtHash == '') {
        return;
    }

    // Submit
    // Get input data from localstorage
    const pStorage = window.localStorage;
    let dataStr = pStorage.getItem('campaign_data');
    const data = JSON.parse(dataStr);
    $('input[name="total_budget"]').val(data.total_budget);
    $('input[name="creator_budget"]').val(data.creator_budget);
    $('input[name="referral_budget"]').val(data.referral_budget);
    $('input[name="user_budget"]').val(data.user_budget);

    $('#campaign').trigger('submit');

});

//Deposit
$('#btn-push-to-pool').on('click', async function(){
    const gameId = $('#game_id').val();
    const depositAmount = $('#total_budget').val();
    const creatorBudget = $('#creator_budget').val();
    const referralBudget = $('#referral_budget').val();
    const userBudget = $('#user_budget').val();

    const data = {
        total_budget: depositAmount,
        creator_budget: creatorBudget,
        referral_budget: referralBudget,
        user_budget: userBudget
    }
    const pStorage = window.localStorage;
    pStorage.setItem('campaign_data', JSON.stringify(data));

    console.log(gameId)
    console.log(depositAmount)
    try {
        // Client must deposit token PLATS to a2e smartcontract
        const result = await window.account.signAndSendTransaction({
            receiverId: window.nearConfig.contractTokenName,
            actions: [
                transactions.functionCall(
                    'storage_deposit',
                    {},
                    DEFAULT_GAS,
                    utils.format.parseNearAmount("0.01")
                ),
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
        // TODO Write value to localstorage

    }
});

// `nearInitPromise` gets called on page load
window.nearInitPromise = initContract()
  .then(() => {
    // if (window.walletConnection.isSignedIn()) signedInFlow()
    // else signedOutFlow()
  })
  .catch(console.error)
