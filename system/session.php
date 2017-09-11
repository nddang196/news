<?php

/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 05-07-2017
 * Time: 2:14 CH
 */

session_start();

function setSession($key, $value)
{
    $_SESSION[$key] = $value;
}

function getSession($key)
{
    return isset($_SESSION[$key]) ? $_SESSION[$key] : FALSE;
}

function deleteSession($key)
{
    if (isset($_SESSION[$key]))
    {
        unset($_SESSION[$key]);
    }
}

function deleteAllSession()
{
    session_destroy();
}
