<?php
if(!defined("ADMIN_PATH")) die("Bad request!");
/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 05-07-2017
 * Time: 8:51 CH
 */
class Categories_Model extends Database
{
    private $properties = array(
        "id" => 0,
        "title" => ""
    );

    public function __construct($data = array())
    {
        parent::__construct();
        if(isset($data["id"]))
        {
            $this->properties["id"] = $data["id"];
        }
        if(isset($data["title"]))
        {
            $this->properties["title"] = $data["title"];
        }
    }

    public function __set($name, $value)
    {
        if(isset($this->properties[$name]))
        {
            $this->properties[$name] = $value;
        }
    }

    public function addCategory()
    {
        return $this->addData("categories", $this->properties);
    }

    public function editCategory()
    {
        return $this->editData("categories", $this->properties);
    }

    public function deleteCategory()
    {
        return $this->deleteData("categories", $this->properties["id"]);
    }

    public function getOneCat()
    {
        return $this->getOne("categories", array("where" => "id = '{$this->properties["id"]}'"));
    }

    public function getListCat($terms = array())
    {
        return $this->getList("categories", $terms);
    }

    public function getTotalCategories()
    {
        $result = $this->getOne("categories", array("select" => "count(id) as counter"));

        return $result["counter"];
    }

    public function findCategory($input)
    {
        return $this->getOne("categories", array("where" => "title like '{$input}%'"));
    }
}