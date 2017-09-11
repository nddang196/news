<?php

function setLogin($data)
{
    setSession("current_user", $data);
}

function setLogout()
{
    deleteSession("current_user");
}

function isLogged()
{
    $user = getSession("current_user");

    return $user;
}

function isAdmin()
{
    $user = isLogged();

    if(!empty($user['username']) && $user['level'] <= 1 && $user['active'] != 0)
    {
        return true;
    }

    return false;
}

function isBoss()
{
    $user = isLogged();
    if(!empty($user["username"]) && $user["level"] == 0)
    {
        return true;
    }

    return false;
}


