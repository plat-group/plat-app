import "regenerator-runtime/runtime";

import { initContract, login, logout } from './utils'

import getConfig from "../../../near_configs"

window.nearConfig = getConfig(process.env.NODE_ENV || "development");

const { KeyPair, utils, transactions } = require('near-api-js');
export const nearUtils = utils;
const DEFAULT_GAS = 300000000000000;

//Deposit
$('#btn-deposit').click(async function(){
    let amount = 100;
    const client = window.accountId;
    let res;
    console.log(window.accountId)
    console.log(window.nearConfig.contractTokenName)
    try {
        //document.querySelector('[data-behavior=waiting-for-transaction]').style.display = 'block';
        // near call $PLATTOKEN ft_transfer_call '{"receiver_id": "'$ID'", "amount": "100000000000000000000000000", "msg" : " {\"game_id\" : \"1\"}  "}' --accountId $CLIENT --amount 0.000000000000000000000001 --gas 50000000000000 --depositYocto 1
        // let param = {
        //     receiver_id: "a2e.nghilt.testnet",
        //     amount: "100000000000000000000000000",
        //     msg : " {\"game_id\" : \"1\"}  ",
        // }
        // console.log(param)
        // // res = window.contract.ft_transfer_call(
        // //     param, DEFAULT_GAS, "1");
        // // near view $PLATTOKEN ft_balance_of '{"account_id": "'$CLIENT'"}'
        // res = window.contract.ft_balance_of(
        //     {"account_id": "platclient.testnet"}
        // );
        // console.log(res);
        const result = await window.account.signAndSendTransaction({
            receiverId: "token.nghilt.testnet",
            actions: [
                transactions.functionCall(
                    'storage_deposit',
                    {account_id: "platuser.testnet"},
                    10000000000000,
                    utils.format.parseNearAmount("0.01")
                 ),
                transactions.functionCall(
                    'ft_transfer_call',
                    { receiver_id: "a2e.nghilt.testnet", amount: utils.format.parseNearAmount("700"), msg: JSON.stringify({game_id : '1ec7de02-931e-61a4-9119-20c9d07b7361'})},
                    250000000000000,
                    "1"
                 )
            ]
        });
        console.log("Result: ", result);

        // const clientAccount = await near.account("platclient.testnet");
        // let transaction = await clientAccount.functionCall(
        //     {
        //         contractId     : "token.nghilt.testnet",
        //         methodName     : 'ft_transfer_call',
        //         args           : {

        //                         },
        //         gas            : '300000000000000', // You may omit this for default gas
        //         attachedDeposit: 1  // You may also omit this for no deposit
        //     }
        // );
        // console.log("transaction: ", transaction);

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
    console.log(res);
});

// View Account Balance
$('#btn-view-balance').click(async function(){
    try {
        let account = $('#account').val()
        console.log(account)
        if(account == '') account = window.accountId
        let res = await window.contract.ft_balance_of(
            {"account_id": account}
        );
        console.log(res);
        $('#balance').html(utils.format.formatNearAmount(res));
    } catch (e) {
        console.log(e)
        alert(
            'Something went wrong! ' +
            'Maybe you need to sign out and back in? ' +
            'Check your browser console for more info.'
        );
        throw e;
    } finally {
        //
    }
});

// View Total Deposit
$('#btn-view-total-deposit').click(async function(){
    try {
        let gameId = $('#gameid').val()
        console.log(gameId)
        if(gameId == '') return;
        let res = await window.contractA2e.get_total_deposit(
            {"game_id": gameId}
        );
        console.log(res);
        $('#total-deposit').html(res);
    } catch (e) {
        console.log(e)
        alert(
            'Something went wrong! ' +
            'Maybe you need to sign out and back in? ' +
            'Check your browser console for more info.'
        );
        throw e;
    } finally {
        //
    }
});

$('#btn-deposit-storage').click(async function(){
    const client = window.accountId;
    let res;
    console.log(window.accountId)
    console.log(window.nearConfig.contractTokenName)
    try {

        const result = await window.account.signAndSendTransaction({
            receiverId: "token.nghilt.testnet",
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
    console.log(res);
});

// near call $ID create_fast_game '{ "game_id" : "1", "creator_id" : "'$CREATOR'"  , "client_id" : "'$CLIENT'" , "amount_creator" : "2000000000000000000000000",  "amount_referral" : "0" , "amount_user" : "100000000000000000000000"}' \--accountId $ID
// Only called from backend
// $('#btn-create_fast_game').click(async function(){
//     let creatorId = 'platcreator.testnet';
//     let clientId = 'platclient.testnet';
//     let payload = {
//         game_id: "1ec7de02-931e-61a4-9119-20c9d07b7361",
//         creator_id: creatorId,
//         client_id: clientId,
//         amount_creator: utils.format.parseNearAmount("1"),
//         amount_referral: utils.format.parseNearAmount("2"),
//         amount_user: utils.format.parseNearAmount("3")
//     }
//     try {
//         const result = await window.account.signAndSendTransaction({
//             receiverId: "a2e.nghilt.testnet",
//             actions: [
//                 transactions.functionCall(
//                     'create_fast_game',
//                     payload,
//                     10000000000000,
//                     utils.format.parseNearAmount("0.01")
//                 )
//             ]
//         });
//         console.log("Result: ", result);

//     } catch (e) {
//         console.log(e)
//         alert(
//             'Something went wrong! ' +
//             'Maybe you need to sign out and back in? ' +
//             'Check your browser console for more info.'
//         );
//         throw e;
//     } finally {
//     }
// });

// `nearInitPromise` gets called on page load
window.nearInitPromise = initContract()
  .then(() => {
    // if (window.walletConnection.isSignedIn()) signedInFlow()
    // else signedOutFlow()
  })
  .catch(console.error)
