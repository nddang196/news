<?php
if(!defined("ADMIN_PATH")) die("Bad request!");

class News_Controller
{
    private $_news;
    private $_data;
    private $_error;

    public function __construct()
    {
        $this->_data['view'] = "news";
        $this->_data['subview'] = isset($_GET['a']) ? $_GET['a'] : "index";

        include_once ADMIN_PATH . "/model/News_Model.php";
        include_once ADMIN_PATH . "/model/Categories_Model.php";
        $this->_news = new News_Model();
    }

    public function __destruct()
    {
        if ($this->_data['subview'] != 'delete')
        {
            extract($this->_data);
            if(!empty($list))
            {
                for ($i = 0; $i < sizeof($list); $i++)
                {
                    $this->_news->__set('sender_id', $list[$i]['sender_id']);
                    $this->_news->__set('category_id', $list[$i]['category_id']);
                    $list[$i]['category_id'] = $this->_news->getCatName();
                    $list[$i]['sender_id'] = $this->_news->getSenderName();
                }
            }
            if (!empty($this->_error))
            {
                extract($this->_error, EXTR_PREFIX_ALL, "e");
            }
            include_once ADMIN_PATH . "/view/index.php";
        }
    }

    public function index()
    {
        $link = createdURL(base_url("admin.php"), array("c" => "news", "a" => "index", "page" => "{page}"));
        $total_records = $this->_news->getTotalNews();
        $current_page = inputGet('page');

        $this->_data['pagination'] = new Pagination($link, $total_records, $current_page, 5);
        $this->_data['title'] = "Danh sách tin tức";
        $this->_data['list'] = $this->_news->getListNews(array(
           "limit" => "{$this->_data['pagination']->getStart()}, {$this->_data['pagination']->getLimit()}"
        ));
    }

    public function add()
    {
        $this->_data['title'] = "Thêm tin tức";

        $cat = new Categories_Model();
        $this->_data['category'] = $cat->getListCat();

        if(isSubmit('add_news'))
        {
            $this->validate();
            if(empty($this->_error))
            {
                $id = isset($this->_data['news']['id']) ? $this->_data['news']['id'] : $this->_news->getMaxId();
                $this->_news->__set('sender_id', isLogged()['id']);
                $this->_news->__set('date_created', date("Y-m-d H:i:s", time()));
                $this->_news->__set('view', 0);
                $this->_news->__set('status', 0);
                if($this->_news->__get('avatar') != "")
                {
                    $this->_news->__set('avatar', "bv".$id."_".$this->_news->__get('avatar'));
                }

                $this->showTrueFalse($this->_news->addNews());
            }
        }
    }

    public function edit()
    {
        $this->_data['title'] = "Sửa tin tức";

        $cat = new Categories_Model();
        $this->_data['category'] = $cat->getListCat();

        $this->_news->__set('id', inputGet('id'));
        $this->_data['news'] = $this->_news->getOneNews();

        if(isSubmit('edit_news'))
        {
            $this->validate();
            if(empty($this->_error))
            {
                if($this->_news->__get('avatar') != "")
                {
                    $this->_news->__set('avatar', "bv".$this->_data['news']['id']."_".$this->_news->__get('avatar'));
                }
                $this->showTrueFalse($this->_news->editNews());
            }
        }
    }

    public function delete()
    {
        $this->_data['title'] = "Xóa tin tức";
        if (isSubmit('delete_news'))
        {
            $this->_news->__set('id', (int)inputPost('news_id'));
            $this->showTrueFalse($this->_news->deleteNews());
        }
        else
        {
            redirect(base_url('admin.php'));
        }
    }

    public function find()
    {
        $this->_data["title"] = "Tìm kiếm tin tức";
        $this->_data["subview"] = "index";

        $this->_data["search"] = inputPost('search');

        $this->_data["list"] = $this->_news->getListNews(array(
            "where" => "title LIKE '%{$this->_data["search"]}%'"));

    }

    public function validate()
    {
        $title = inputPost('title');
        $summary = inputPost('summary');
        $content = inputPost('content');
        $category = inputPost('category');
        $avatar = isset($_FILES['avatar']) ? $_FILES['avatar']['name'] : "";

        if($this->checkContent($title, "tilte"))
        {
            $this->_news->__set('title', $title);
            if(!$this->_news->checkTitle())
            {
                $this->_error['title'] = "Tiêu đề này đã tồn tại!";
            }
        }
        if($this->checkContent($summary, "summary"))
        {
            $this->_news->__set('summary', $summary);
        }
        if($this->checkContent($content, "content"))
        {
            $this->_news->__set('content', $content);
        }
        if($this->checkContent($category, "category"))
        {
            $this->_news->__set('category_id', $category);
        }
        if(checkAvatar($avatar))
        {
            $this->_news->__set('avatar', $avatar);
        }
        else
        {
            $this->_error['avatar'] = "Ảnh phải thuộc dạng : PNG, JPG, JPEG";
        }
    }

    public function checkContent($content, $err)
    {
        if($content == "")
        {
            if($this->_data['subview'] == "add")
            {
                $this->_error[$err] = "Không được bỏ trống";
            }
            return false;
        }

        if($err != "category" && strlen($content) < 15)
        {
            $this->_error[$err] = "Nội dung phải trên 15 ký tự";
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
            $redirect = createdURL(base_url("admin.php"), array('c' => 'news'));
        }
        if ($bool)
        {
            if($this->_news->__get('avatar') != "")
            {
                move_uploaded_file($_FILES['avatar']['tmp_name'], "public/images/{$this->_news->__get('avatar')}");
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