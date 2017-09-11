<?php if (!defined("SITE_PATH")) die("Bad request!");

class User_Controller
{
    private $_user;
    private $_data;
    private $_err;

    public function __construct()
    {
        $this->_data['view'] = "user";

        include_once SITE_PATH . "/model/User_Model.php";
        include_once SITE_PATH . "/model/Category_Model.php";

        $this->_user = new User_Model();
        $cat = new Category_Model();

        //danh sách chuyên mục
        $this->_data['list_cat'] = $cat->getAllCat();
    }

    public function register()
    {
        $this->_data['title'] = "Đăng ký";
        $this->_data['subview'] = "register";

        if (isSubmit("add_user"))
        {
            $new_user = $this->validate();
            $new_user['username'] = $this->checkUsername();

            if (empty($this->_err))
            {
                $new_user['active'] = 1;
                $new_user['level'] = 2;
                $new_user['avatar'] = "avatar.png";
                if (empty($new_user['fullname']))
                {
                    $new_user['fullname'] = "NO NAME";
                }
                if ($this->_user->addUser($new_user))
                {
                    $new_user['id'] = $this->_user->getIdInsert();
                    setLogin($new_user);
                    $this->_data['subview'] = "thanks";
                }
                else
                {
                    $this->showFalse();
                }
            }
        }
    }

    public function profile()
    {
        $this->_data['title'] = "Thông tin cá nhân";
        $this->_data['subview'] = "profile";
        $this->_data['user'] = $this->_user->getUserById(inputGet('id'));

        if (isSubmit("edit_user"))
        {
            $profile = $this->validate();
            if (empty($this->_err) && !empty($profile))
            {
                $profile['id'] = $this->_data['user']['id'];
                if(!empty($profile['avatar']))
                {
                    $profile['avatar'] = str_replace("avatar", $this->_data['user']['username'], $profile['avatar']);
                }
                if ($this->_user->editUser($profile))
                {
                    $this->_data['user'] = $this->_data['user'] = $this->_user->getUserById($profile['id']);
                    setLogin($this->_data['user']);
                    $this->showTrue($profile['avatar'] ?? "");
                }
                else
                {
                    $this->showFalse();
                }

                redirect(createdURL(base_url(), array('c' => 'user', 'a' => 'profile', 'id' => $profile['id'])));
            }
        }
    }

    public function forget()
    {
        $this->_data['title'] = "Lấy lại mật khẩu";
        $this->_data['subview'] = "forget";

        if(isSubmit("forget"))
        {
            $email = inputPost("email");
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE)
            {
                unset($email);
                $this->_err['email'] = "Email không đúng định dạng!";
            }
            else
            {
                if ($this->_user->checkEmail($email))
                {
                    include_once SYSTEM_PATH . "/library/class.smtp.php";
                    include_once SYSTEM_PATH . "/library/class.phpmailer.php";
                    include_once SYSTEM_PATH . "/mail.php";

                    $title = "Tìm lại mật khẩu website ...";
                    $nTo = "Bạn";
                    $mTo = $email;
                    $content = "Mật khẩu hiện tại của bạn là : 12345678";

                    $mail = sendMail($title, $content, $nTo, $mTo);
                    if($mail == 1)
                    {

                        $this->_data['notify'] = "Mật khẩu dã được gửi tới e-mail của bạn hãy kiểm tra lại hòm thư!";
                    }
                    else
                    {
                        $this->_err['email'] = $mail;
                    }
                }
                else
                {
                    $this->_err['email'] = "E-mail không chính xác!";
                }
            }
        }
    }

    public function __destruct()
    {
        extract($this->_data);
        if (!empty($this->_err))
        {
            extract($this->_err, EXTR_PREFIX_ALL, "e");
        }

        include_once SITE_PATH . "/view/index.php";
    }

    public function checkUsername()
    {
        $username = inputPost("username");

        if (!preg_match("/^[a-zA-Z0-9]{6,16}$/", $username))
        {
            $this->_err['username'] = "Tên tài khoản chỉ chứa chữ và số(6-16 ký tự)!";
        }
        else
        {
            if ($this->_user->checkUsername($username))
            {
                $this->_err['username'] = "Tên tài khoản đã tồn tại!";
            }
        }

        return $username;
    }

    public function validate()
    {
        $user = array();

        if (!empty(inputPost("password")))
        {
            if (inputPost("password") == inputPost("re-pass"))
            {
                $user['password'] = inputPost("password");
                if (!preg_match("/^[a-zA-Z0-9]{6,16}$/", $user['password']))
                {
                    unset($user['password']);
                    $this->_err['password'] = "Mật khẩu chỉ chứa chữ và số(6-16 ký tự)!";
                }
                else
                {
                    $user['password'] = md5($user['password']);
                }
            }
            else
            {
                $this->_err['repass'] = "Mật khẩu nhập lại không chính xác!";
            }
        }

        if (!empty(inputPost("fullname")))
        {
            $user['fullname'] = inputPost("fullname");
        }

        if (!empty(inputPost("address")))
        {
            $user['address'] = inputPost("address");
        }

        if (!empty(inputPost("email")))
        {
            $user['email'] = inputPost("email");
            if (filter_var($user['email'], FILTER_VALIDATE_EMAIL) === FALSE)
            {
                unset($user['email']);
                $this->_err['email'] = "Email không đúng định dạng!";
            }
            else
            {
                if ($this->_user->checkEmail($user['email']))
                {
                    $this->_err['email'] = "Email đã tồn tại!";
                }
            }
        }

        if (!empty(inputPost("phone")))
        {
            $user['phone'] = inputPost("phone");
            if (!preg_match("/^[0-9]{10,11}$/", $user['phone']))
            {
                unset($user['phone']);
                $this->_err['phone'] = 'Số điện thoại không hợp lệ!';
            }
        }

        if (!empty($_FILES['avatar']))
        {
            $user['avatar'] = $_FILES['avatar']['name'];
            if (!checkAvatar($user['avatar']))
            {
                $this->_err['avatar'] = "Ảnh đại diện phải thuộc định dạng PNG, JPG, JPEG";
            }
        }

        return $user;
    }

    public function showTrue($avatar = "")
    {
        if (!empty($avatar))
        {
            move_uploaded_file($_FILES['avatar']['tmp_name'], "public/images/avatar/{$avatar}");
        }
        ?>
        <script language="JavaScript">
            alert("Thành công!");
        </script>
        <?php
        die();
    }

    public function showFalse()
    {
        ?>
        <script language="JavaScript">
            alert("Thất bại!");
        </script>
        <?php
        die();
    }
}