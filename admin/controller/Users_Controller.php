<?php
if (!defined("ADMIN_PATH")) die("Bad request!");

/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 08-07-2017
 * Time: 9:55 CH
 */
class Users_Controller
{
    private $_user;
    private $_error;
    private $_data;

    public function __construct()
    {
        $this->_data["view"] = "users";
        $this->_data["subview"] = isset($_GET['a']) ? $_GET['a'] : "index";
        include_once ADMIN_PATH . "/model/Users_Model.php";
        $this->_user = new Users_Model();
    }

    public function index()
    {
        $this->_data["title"] = "Danh sách thành viên";

        //thiết lập đối tượng phân trang
        $link = createdURL(base_url("admin.php"), array("c" => "users", "a" => "index", "page" => "{page}"));
        $current_page = inputGet("page");
        $total_record = $this->_user->getTotalUser();
        $this->_data["pagination"] = new Pagination($link, $total_record, $current_page);

        $this->_data["list"] = $this->_user->getListUser(array(
            "limit" => "{$this->_data["pagination"]->getStart()}, {$this->_data["pagination"]->getLimit()}"
        ));
    }

    public function add()
    {
        $this->_data["title"] = "Thêm thành viên";

        if (isSubmit("add_user"))
        {
            $this->validate();
            if (empty($this->_error))
            {
                $this->showTrueFalse($this->_user->addUser());
            }
        }
    }

    public function delete()
    {
        $this->_data['title'] = "Xóa thành viên";
        if (isSubmit('delete_user'))
        {
            $this->_user->__set('id', (int)inputPost('user_id'));
            $temp = $this->_user->getOneUser();
            $this->_user->__set('avatar', $temp['avatar']);

            $this->showTrueFalse($this->_user->deleteUser());
        }
        else
        {
            redirect(base_url('admin.php'));
        }
    }

    public function edit()
    {
        $this->_data['title'] = "Sửa thông tin thành viên";
        $this->_user->__set('id', inputGet('id'));
        $this->_data['user'] = $this->_user->getOneUser();
        if (isSubmit('edit_user'))
        {
            $this->validate();
            if (empty($this->_error))
            {
                $this->_user->__set('avatar', str_replace("avatar", $this->_data['user']['username'], $this->_user->__get('avatar')));
                $this->showTrueFalse($this->_user->editUser());
            }
        }
    }

    public function find()
    {
        $this->_data["title"] = "Tìm kiếm thành viên";
        $this->_data["subview"] = "index";

        $this->_data["search"] = inputPost('search');

        $this->_data["list"] = $this->_user->getListUser(array(
            "where" => "username LIKE '%{$this->_data["search"]}%' OR fullname LIKE '%{$this->_data["search"]}%'"));

    }

    public function __destruct()
    {
        if ($this->_data['subview'] != 'delete')
        {
            extract($this->_data);
            if (!empty($this->_error))
            {
                extract($this->_error, EXTR_PREFIX_ALL, "e");
            }
            include_once ADMIN_PATH . "/view/index.php";
        }
    }

    public function validate()
    {
        $username = inputPost('username');
        $password = inputPost('password');
        $re_pass = inputPost('re-pass');
        $name = inputPost('name');
        $email = inputPost('email');
        $phone = inputPost('phone');
        $address = inputPost('address');
        $level = inputPost('level');
        $active = inputPost('active');
        $avatar = empty($_FILES['avatar']) ? "" : $_FILES['avatar']['name'];

        if ($this->checkUsername($username))
        {
            $this->_user->__set('username', $username);
            if ($this->_user->checkUsername())
            {
                $this->_error['username'] = "Tên tài khoản đã tồn tại!";
            }
        }
        if ($this->checkMail($email))
        {
            $this->_user->__set('email', $email);
            if ($this->_user->checkEmail())
            {
                $this->_error['email'] = "Email đã có người sử dụng!";
            }
        }
        if ($this->checkPass($password, $re_pass))
        {
            $this->_user->__set('password', md5($password));
        }
        if ($this->checkPhone($phone))
        {
            $this->_user->__set('phone', $phone);
        }
        if (checkAvatar($avatar))
        {
            $this->_user->__set('avatar', empty($avatar) && ($this->_data['subview'] == "add") ? "avatar.png" : $avatar);
        }
        else
        {
            $this->_error['avatar'] = "Ảnh đại diện phải thuộc dạng : PNG, JPG, JPEG";
        }
        $this->_user->__set('address', $address);
        if(($this->_data['subview'] == "add") && empty($level))
        {
            $level = 2;
        }
        if(($this->_data['subview'] == "add" && empty($name)))
        {
            $name = "NO NAME";
        }
        if(($this->_data['subview'] == "add") && empty($active))
        {
            $active = 1;
        }
        $this->_user->__set('level', $level);
        $this->_user->__set('fullname', $name);
        $this->_user->__set('active', $active);
    }

    public function checkUsername($username)
    {
        if ($username == "")
        {
            if ($this->_data['subview'] == "add")
            {
                $this->_error['username'] = "Không được bỏ trống!";
            }
            return false;
        }
        if (!preg_match("/^[a-zA-Z0-9]{6,16}$/", $username))
        {
            $this->_error['username'] = "Tên tài khoản chỉ chứa chữ và số(6-16 ký tự)!";
            return false;
        }

        return true;
    }

    public function checkPass($password, $re_pass)
    {
        if ($password == "")
        {
            if ($this->_data['subview'] == "add")
                $this->_error['password'] = "Không được bỏ trống!";
            return false;
        }
        if (!preg_match("/^[a-zA-Z0-9]{6,16}$/", $password))
        {
            $this->_error['password'] = "Mật khẩu chỉ chứa chữ và số(6-16 ký tự)!";
            return false;
        }
        if ($re_pass != $password)
        {
            $this->_error['repass'] = "Mật khẩu nhập lại không khớp!";
            return false;
        }

        return true;
    }

    public function checkMail($email)
    {
        if ($email == "")
        {
            if ($this->_data['subview'] == "add")
                $this->_error['email'] = "Không được bỏ trống!";
            return false;
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
        {
            $this->_error['email'] = "Email không đúng định dạng!";
            return false;
        }

        return true;
    }

    public function checkPhone($phone)
    {
        if ($phone == "")
        {
            return false;
        }
        if (!preg_match("/^[0-9]{10,11}$/", $phone))
        {
            $this->_error['phone'] = 'Số điện thoại không hợp lệ!';
            return false;
        }

        return true;
    }

    public function showTrueFalse($bool)
    {
        if (inputPost('redirect'))
        {
            $redirect = inputPost('redirect');
        }
        else
        {
            $redirect = createdURL(base_url("admin.php"), array('c' => 'users'));
        }
        if ($bool)
        {
            if ($this->_user->__get('avatar') != "" && $this->_data['subview'] == "edit")
            {
                move_uploaded_file($_FILES['avatar']['tmp_name'], "public/images/avatar/{$this->_user->__get('avatar')}");
            }
            if($this->_data['subview'] == "delete" && $this->_user->__get('avatar') != "avatar.png")
            {
                $path = "public/images/avatar/" . $this->_user->__get('avatar');
                if(file_exists($path))
                {
                    unlink($path);
                }
            }
            ?>
            <script language="JavaScript">
                alert("Thành công!");
                window.location = "<?php echo $redirect?>";
            </script>
            <?php
            die();
        }
        else
        {
            ?>
            <script language="JavaScript">
                alert("Thất bại!");
                window.location = "<?php echo $redirect ?>";
            </script>
            <?php
            die();
        }
    }
}