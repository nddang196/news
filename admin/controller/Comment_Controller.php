<?php
if(!defined("ADMIN_PATH")) die("Bad request!");
/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 09-07-2017
 * Time: 1:12 CH
 */
class Comment_Controller
{
    private $_comment;
    private $_data;

    public function __construct()
    {
        $this->_data['view'] = "comment";
        $this->_data['subview'] = "index";

        include_once ADMIN_PATH . "/model/Comment_Model.php";
        $this->_comment = new Comment_Model();
    }

    public function __destruct()
    {
        if (!isset($_GET['a']) || $_GET['a'] != 'delete')
        {
            extract($this->_data);
            include_once ADMIN_PATH . "/view/index.php";
        }
    }

    public function index()
    {
        $link = createdURL(base_url("admin.php"), array('c' => 'comment', 'a' => 'index', 'page' => '{page}'));
        $total_records = $this->_comment->getTotalComment();
        $current_page = inputGet('page');

        $this->_data['pagination'] = new Pagination($link, $total_records, $current_page);

        $this->_data['list'] = $this->_comment->getListComment(array('limit' => "{$this->_data["pagination"]->getStart()}, {$this->_data["pagination"]->getLimit()}"));
    }

    public function delete()
    {
        if(isSubmit('delete_comment'))
        {
            $this->_comment->__set('id', inputPost('comment_id'));
            $this->showTrueFalse($this->_comment->deleteComment());
        }
        else
        {
            redirect(base_url("admin.php"));
        }
    }

    public function find()
    {
        $this->_data['title'] = "Tìm kiếm bình luận";
        $this->_data['search'] = inputPost('search');
        $this->_data["list"] = $this->_comment->getListComment(array(
            "where" => "content LIKE '%{$this->_data["search"]}%'"));
    }

    public function showTrueFalse($bool)
    {
        if (inputPost('redirect'))
        {
            $redirect = inputPost('redirect');
        }
        else
        {
            $redirect = createdURL(base_url("admin.php"), array('c' => 'comment'));
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