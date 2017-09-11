<?php
//header("Content-Type : text/html; charset=utf-8;");
define("SITE_PATH", __DIR__."/site");

require_once "system/config.php";
require_once SYSTEM_PATH . "/session.php";
require_once SYSTEM_PATH . "/helper.php";
require_once SYSTEM_PATH . "/role.php";
require_once SYSTEM_PATH . "/library/Database.php";
require_once SYSTEM_PATH . "/library/Pagination.php";

$controller = empty($_GET['c']) ? CONTROLLER_D : controllerName($_GET['c']);
$action = empty($_GET['a']) ? ACTION_D : $_GET['a'];

//lấy đường dẫn và kiểm tra nó có tồn tại không
$path = SITE_PATH . "/controller/" . $controller . ".php";
if(!file_exists($path))
{
    die("Không tồn tại controller : " . $controller);
}
require_once $path;

//kiểm tra lớp controller có tồn tại không
if(!class_exists($controller))
{
    die("Không tồn tại lớp : " . $controller);
}
$ctr = new $controller();

//kiểm tra phương thức action có tồn tại không
if(!method_exists($ctr, $action))
{
    die("Action không tồn tại!");
}
$ctr->$action();
