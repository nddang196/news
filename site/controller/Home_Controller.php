<?php if(!defined("SITE_PATH")) die("Bad request!");
class Home_Controller
{
    //biến mảng data lưu trữ những dữ liệu để truyền cho các file include
    private $_data;
    //lưu các lỗi
    private $_err;
    //các biến đối tượng làm việc với DB
    private $_news;
    private $_cat;
    private $_user;

    public function __construct()
    {
        $this->_data['view'] = "home";

        include_once SITE_PATH . "/model/News_Model.php";
        include_once SITE_PATH . "/model/User_Model.php";
        include_once SITE_PATH . "/model/Category_Model.php";

        $this->_news = new News_Model();
        $this->_cat = new Category_Model();
        $this->_user = new User_Model();

        //danh sách chuyên mục
        $this->_data['list_cat'] = $this->_cat->getAllCat();
    }

    public function index()
    {
        $this->_data['title'] = "Trang thông tin công nghệ và truyền thông";
        $this->_data['subview'] = "home";
        //thông số phân trang
        $link = createdURL(base_url(), array(
            'c' => 'home',
            'a' => 'index',
            'page' => '{page}'
        ));
        $current_page = inputGet('page');
        $total_record = $this->_news->getTotalRecord();

        $this->_data['pagination'] = new Pagination($link, $total_record, $current_page);

        //danh sách tin tức theo thông số phân trang
        $this->_data['list_news'] = $this->_news->getListNews(array(
            "where" => "status = '1'",
            "orderby" => "id DESC",
            "limit" => "{$this->_data['pagination']->getStart()}, {$this->_data['pagination']->getLimit()}"
        ));

        //danh sách tin tức được xem nhiều
        $this->_data['news_interested'] = $this->_news->getListNews(array(
            "where" => "status = '1'",
            "orderby" => "view DESC",
            "limit" => "0, 6"
        ));

        //nếu người dùng ghi nhớ đăng nhập từ trước ->thiết lập trạng thái đã đăng nhập
        if(isset($_COOKIE['user']) && isLogged() == FALSE)
        {
             $result = $this->_user->getOneUser(array("where" => "username='{$_COOKIE['user']}'"));
             setLogin($result);
        }
    }

    public function login()
    {
        //nếu bấm vào nút đăng nhập -> thực hiện kiểm tra tk và mk
        if(isSubmit("login"))
        {
            $username = inputPost("username");
            $password = md5(inputPost("password"));
            $remember = inputPost("remember");

            $result = $this->_user->getOneUser(array("where" => "username='$username' AND password='$password'"));

            //nếu thông tin tài khoản chính xác
            if($result)
            {
                setLogin($result);
                //nếu chọn nhớ đăng nhập -> thiết lập cookie
                if($remember == "on")
                {
                    setcookie("user", $username, time() + (86400 * 30), "/");
                    setcookie("pass", $password, time() + (86400 * 30), "/");
                }
                //load lại trang
                redirect(inputPost('back'));
            }
            else
            {
                $this->_err['login'] = "Tài khoản hoặc mật khẩu không chính xác!";
            }
        }
    }

    public function logout()
    {
        setLogout();
        if(isset($_COOKIE['user']))
        {
            setcookie("user", "", time() - (86400 * 30), "/");
            setcookie("pass", "", time() - (86400 * 30), "/");
        }

        redirect(base_url());
    }

    public function newsByCat()
    {
        $id_cat = inputGet("cat");
        $this->_data['title'] = $this->_cat->getCatById($id_cat)["title"];
        $this->_data['subview'] = "home";
        //thông số phân trang
        $link = createdURL(base_url(), array(
            'c' => 'news',
            'a' => 'newsByCat',
            'page' => '{page}'
        ));
        $current_page = inputGet('page');
        $total_record = $this->_news->getTotalByCat($id_cat);

        $this->_data['pagination'] = new Pagination($link, $total_record, $current_page);

        //danh sách tin tức theo thông số phân trang
        $this->_data['list_news'] = $this->_news->getListNews(array(
            "where" => "status = '1' AND category_id = '$id_cat'",
            "orderby" => "id DESC",
            "limit" => "{$this->_data['pagination']->getStart()}, {$this->_data['pagination']->getLimit()}"
        ));

        $this->_data['news_interested'] = $this->_news->getListNews(array(
            "where" => "status = '1'",
            "orderby" => "view DESC",
            "limit" => "0, 6"
        ));
    }

    public function find()
    {
        $this->_data['title'] = "Tìm kiếm";
        $this->_data['subview'] = "home";
        if(isSubmit("search"))
        {
            $this->_data["search"] = inputPost('search');

            $this->_data["list_news"] = $this->_news->getListNews(array(
                "where" => "title LIKE '%{$this->_data["search"]}%'"));
        }
    }

    public function __destruct()
    {
        if(!empty($this->_err))
        {
            extract($this->_err, EXTR_PREFIX_ALL, "e");
        }
        extract($this->_data);
        if(!empty($list_news))
        {
            for ($i = 0; $i < sizeof($list_news); $i++)
            {
                //thêm 2 thuộc tính username và avatar của người đăng vào thông tin mỗi tin
                $temp = $this->_user->getUserById($list_news[$i]['sender_id']);
                $list_news[$i]['sender_name'] = $temp['username'];
                $list_news[$i]['sender_avatar'] = $temp['avatar'];

                //thêm tên chuyên mục
                $temp = $this->_cat->getCatById($list_news[$i]['category_id']);
                $list_news[$i]['cat_title'] = $temp['title'];
            }
        }

        include_once SITE_PATH . "/view/index.php";
    }
}