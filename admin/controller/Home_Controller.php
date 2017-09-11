<?php

/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 06-07-2017
 * Time: 9:08 CH
 */
if(!defined("ADMIN_PATH")) die("Bar request!");
class Home_Controller
{
    private $user;
    private $error;

    public function __construct()
    {
        include_once ADMIN_PATH . "/model/Users_Model.php";
        $this->user = new Users_Model();
    }

    public function index()
    {
        $view = "home";
        $title = "Trang chủ";
        $subview = "index";
        include_once ADMIN_PATH . "/view/index.php";
    }

    public function login()
    {
        if(isSubmit('login'))
        {
            if(inputPost('username'))
            {
                $username = inputPost('username');
                if(inputPost('password'))
                {
                    $password = inputPost('password');
                    $this->user->__set("username", $username);
                    $result = $this->user->getOneUser();

                    if($result && md5($password) == $result['password'])
                    {
                        setLogin($result);
                        if(isAdmin())
                        {
                            redirect(base_url("admin.php?c=home&a=index"));
                        }
                        else
                        {
                            $this->error["username"] = "Bạn không phải là Admin hoặc tài khoản đang bị khóa!";
                        }
                    }
                    else
                    {
                        $this->error['username'] = "Tên tài khoản hoặc mật khẩu không chính xác";
                    }
                }
                else
                {
                    $this->error['password'] = "Bạn chưa nhập mật khẩu";
                }
            }
            else
            {
                $this->error['username'] = "Bạn chưa nhập tên tài khoản";
            }
        }
        if(!empty($this->error))
        {
            extract($this->error, EXTR_PREFIX_ALL, "e");
        }
        include_once ADMIN_PATH . "/view/home/login.php";
    }

    public function logout()
    {
        setLogout();
        redirect(base_url("admin.php"));
    }
}