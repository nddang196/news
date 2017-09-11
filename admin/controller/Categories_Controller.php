<?php
if (!defined("ADMIN_PATH")) die("Bad request!");
/**
 * Created by PhpStorm.
 * cat: nddan
 * Date: 09-07-2017
 * Time: 1:12 CH
 */
class Categories_Controller
{
    private $_cat;
    private $_data;
    private $_error;

    public function __construct()
    {
        $this->_data["view"] = "categories";
        $this->_data["subview"] = isset($_GET['a']) ? $_GET['a'] : "index";
        include_once ADMIN_PATH . "/model/Categories_Model.php";
        $this->_cat = new Categories_Model();
    }

    public function index()
    {
        $this->_data["title"] = "Danh sách chuyên mục";

        //thiết lập đối tượng phân trang
        $link = createdURL(base_url("admin.php"), array("c" => "categories", "a" => "index", "page" => "{page}"));
        $current_page = inputGet("page");
        $total_record = $this->_cat->getTotalCategories();
        $this->_data["pagination"] = new Pagination($link, $total_record, $current_page);

        $this->_data["list"] = $this->_cat->getListCat(array("limit" => "{$this->_data["pagination"]->getStart()}, {$this->_data["pagination"]->getLimit()}"));
    }

    public function add()
    {
        $this->_data["title"] = "Thêm chuyên mục";

        if (isSubmit("add_cat"))
        {
            $title = inputPost('title');
            if($title != "")
            {
                $this->_cat->__set('title', $title);
                $this->showTrueFalse($this->_cat->addCategory());
            }
            else
            {
                $this->_error['err'] = "Hãy nhập vào tên chuyên mục cần thêm!";
            }
        }
    }

    public function delete()
    {
        $this->_data['title'] = "Xóa chuyên mục";
        if (isSubmit('delete_cat'))
        {
            $this->_cat->__set('id', (int)inputPost('cat_id'));
            $this->showTrueFalse($this->_cat->deleteCategory());
        }
        else
        {
            redirect(base_url('admin.php'));
        }
    }

    public function edit()
    {
        $this->_data['title'] = "Đổi tên chuyên mục";
        $this->_cat->__set('id', inputGet('id'));
        $this->_data['cat'] = $this->_cat->getOneCat();
        $title = inputPost('title');
        if (isSubmit('edit_cat') && $title != "")
        {
             $this->_cat->__set('title', $title);
             $this->showTrueFalse($this->_cat->editCategory());
        }
    }

    public function find()
    {
        $this->_data["title"] = "Tìm kiếm chuyên mục";
        $this->_data["subview"] = "index";

        $this->_data["search"] = inputPost('search');

        $this->_data["list"] = $this->_cat->getListCat(array(
            "where" => "title LIKE '%{$this->_data["search"]}%'"));

    }

    public function __destruct()
    {
        if ($this->_data['subview'] != 'delete')
        {
            if(!empty($this->_error))
            {
                extract($this->_error);
            }
            extract($this->_data);
            include_once ADMIN_PATH . "/view/index.php";
        }
    }

    public function showTrueFalse($bool)
    {
        if (inputPost('redirect'))
        {
            $redirect = inputPost('redirect');
        }
        else
        {
            $redirect = createdURL(base_url("admin.php"), array('c' => 'categories'));
        }
        if ($bool)
        {
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