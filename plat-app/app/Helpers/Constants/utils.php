<?php

function isCreator()
{
    return isRole(CREATOR_ROLE);
}

function isClient()
{
    return isRole(CLIENT_ROLE);
}

function isUser()
{
    return isRole(USER_ROLE);
}

function isReferral()
{
    return isRole(REFERRAL_ROLE);
}

if (!function_exists('isRole')) {
    /**
     * Global helper for check user role
     *
     * @param int $roleCode
     *
     * @return bool
     */
    function isRole($roleCode)
    {
        return optional(auth()->user())->role == $roleCode;
    }
}


function displayMenuPool()
{
    return true;
}

function displayMenuMarket()
{
    return true;
}

function displayMenuMyGame()
{
    return isCreator() || isClient();
}

function displayMenuMyOrder()
{
    return isCreator() || isClient();
}

function displayMenuDashboard()
{
    return isUser() || isReferral();
}

?>
