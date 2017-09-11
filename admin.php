<?php
/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 04-07-2017
 * Time: 8:27 CH
 */
//header("Content-Type : text/html; charset=utf-8;");
define("ADMIN_PATH", __DIR__."/admin");

require_once "system/config.php";
require_once "system/session.php";
require_once "system/helper.php";
require_once "system/role.php";
require_once "system/library/Database.php";
require_once "system/library/Pagination.php";

if(!isAdmin())
{
    $controller = CONTROLLER_D;
    $action = "login";
}
else
{
    $controller = isset($_GET['c']) ? controllerName($_GET['c']) : CONTROLLER_D;
    $action = isset($_GET['a']) ? $_GET['a'] : ACTION_D;
}

$path = ADMIN_PATH . "/controller/" . $controller . ".php";
if(!file_exists($path))
{
    die("Không tồn tại controller : " . $controller);
}
require_once $path;

if(!class_exists($controller))
{
    die("Không tồn tại lớp : " . $controller);
}
$ctr = new $controller();

if(!method_exists($ctr, $action))
{
    die("Action không tồn tại!");
}
$ctr->{$action}();