<?php if (!defined("SITE_PATH")) die("Bad request!");

class Category_Model extends Database
{
    public function getAllCat()
    {
        return $this->getList("categories");
    }

    public function getCatById($id)
    {
        return $this->getOne("categories", array("where" => "id='$id'"));
    }
}