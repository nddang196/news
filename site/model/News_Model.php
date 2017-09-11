<?php if (!defined("SITE_PATH")) die("Bad request!");

class News_Model extends Database
{
    public function getListNews($terms = array())
    {
        return $this->getList("news", $terms);
    }

    public function getNewsBySender($sender_id)
    {
        return $this->getList("news", array("where" => "category_id = '$sender_id'"));
    }

    public function getNewsById($id)
    {
        return $this->getOne("news", array("where" => "id = '$id'"));
    }

    public function addNews($data)
    {
        return $this->addData("news", $data);
    }

    public function editNews($data)
    {
        return $this->editData("news", $data);
    }

    public function findNews($input)
    {
        return $this->getList("news", array("where" => "title like '{$input}%'"));
    }

    public function getTotalRecord()
    {
        $result = $this->getOne("news", array("select" => "count(id) as counter"));

        return $result["counter"];
    }

    public function getTotalByCat($id_cat)
    {
        $result = $this->getOne("news", array("select" => "count(id) as counter", "where" => "id_cat=$id_cat"));

        return $result["counter"];
    }

    public function addCommment($data)
    {
        return $this->addData("comment", $data);
    }

    public function getComment($id_news)
    {
        return $this->getList("comment", array("where" => "news_id='$id_news' AND status='1'"));
    }
}