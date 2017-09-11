<?php if (!defined("SITE_PATH")) die("Bad request!");
class News_Controller
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
        $this->_data['view'] = "news";

        include_once SITE_PATH . "/model/News_Model.php";
        include_once SITE_PATH . "/model/User_Model.php";
        include_once SITE_PATH . "/model/Category_Model.php";

        $this->_news = new News_Model();
        $this->_cat = new Category_Model();
        $this->_user = new User_Model();

        //danh sách chuyên mục
        $this->_data['list_cat'] = $this->_cat->getAllCat();
    }

    //hiển thị trang tin chi tiết
    public function index()
    {
        $this->_data['subview'] = "news_detail";
        $id = inputGet('id');

        $this->_data['news'] = $this->_news->getNewsById($id);
        $this->_data['title'] = $this->_data['news']['title'];

        $view = ++$this->_data['news']['view'];
        $this->_news->editNews(array("view" => "$view", "id" => $id));

        //danh sách comment của bài viết
        $this->_data['comment'] = $this->_news->getComment($id);

        //danh sách tin tức được xem nhiều
        $this->_data['news_interested'] = $this->_news->getListNews(array(
            "where" => "status = '1'",
            "orderby" => "view DESC",
            "limit" => "0, 6"
        ));

        //tin tức cùng chuyên mục
        $this->_data['news_same'] = $this->_news->getListNews(array(
            "where" => "status='1' AND category_id='{$this->_data["news"]["category_id"]}'",
            "orderby" => "view DESC",
            "limit" => "0, 4"
        ));
    }

    public function addComment()
    {
        $commnet['sender_id'] = inputPost("sender_id");
        $commnet['news_id'] = inputPost("news_id");
        $commnet['content'] = inputPost("txt_comment");
        $commnet['status'] = 1;
        $commnet['date_created'] = date("Y-m-d H:i:s", time());

        $this->_news->addCommment($commnet);

        redirect(inputPost("back"));
    }

    public function __destruct()
    {
        if (!empty($this->_err))
        {
            extract($this->_err, EXTR_PREFIX_ALL, "e");
        }
        extract($this->_data);
        if (isset($news))
        {
            //thêm 2 thuộc tính username và avatar của người đăng vào thông tin mỗi tin
            $temp = $this->_user->getUserById($news['sender_id']);
            $news['sender_name'] = $temp['username'];
            $news['sender_avatar'] = $temp['avatar'];

            //thêm tên chuyên mục
            $temp = $this->_cat->getCatById($news['category_id']);
            $news['cat_title'] = $temp['title'];

        }

        if(isset($comment))
        {
            if($comment != FALSE)
            {
                for ($i = 0; $i < sizeof($comment); $i++)
                {
                    //thêm 2 thuộc tính username và avatar của người đăng vào thông tin bình luận
                    $temp = $this->_user->getUserById($comment[$i]['sender_id']);
                    $comment[$i]['sender_name'] = $temp['username'];
                    $comment[$i]['sender_avatar'] = $temp['avatar'];
                }
            }
            else
            {
                unset($comment);
            }
        }

        include_once SITE_PATH . "/view/index.php";
    }
}