<?php

function isCreator() {
    return auth() && auth()->user()->role == CREATOR_ROLE;
}

function isClient() {
    return auth() && auth()->user()->role == CLIENT_ROLE;
}

function isUser() {
    return auth() && auth()->user()->role == USER_ROLE;
}

function isReferral() {
    return auth() && auth()->user()->role == REFERRAL_ROLE;
}

function displayMenuPool() {
    return true;
}

function displayMenuMarket() {
    return true;
}

function displayMenuMyGame() {
    return isCreator() || isClient();
}

function displayMenuMyOrder() {
    return isCreator() || isClient();
}

function displayMenuDashboard() {
    return isUser() || isReferral();
}
?>
