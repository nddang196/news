<?php
if (!defined("ADMIN_PATH")) die("Bad request!");

/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 05-07-2017
 * Time: 9:20 CH
 */
class News_Model extends Database
{
    private $properties = array(
        "id"           => 0,
        "category_id"  => "",
        "avatar"       =>"",
        "title"        => "",
        "summary"      => "",
        "content"      => "",
        "sender_id"    => "",
        "date_created" => "",
        "status"       => "",
        "view"         => ""
    );

    public function __construct($data = array())
    {
        parent::__construct();
        if (!empty($data))
        {
            foreach ($data as $key => $value)
            {
                if (isset($this->properties[$key]))
                {
                    $this->properties[$key] = $data[$key];
                }
            }
        }
    }

    public function __set($name, $value)
    {
        if (isset($this->properties[$name]))
        {
            $this->properties[$name] = $value;
        }
    }

    public function __get($name)
    {
        return $this->properties[$name];
    }

    public function addNews()
    {
        return $this->addData("news", $this->properties);
    }

    public function editNews()
    {
        return $this->editData("news", $this->properties);
    }

    public function deleteNews()
    {
        return $this->deleteData("news", $this->properties["id"]);
    }

    public function getOneNews()
    {
        return $this->getOne("news", array("where" => "id = '{$this->properties["id"]}'"));
    }

    public function getListNews($terms = array())
    {
        return $this->getList("news", $terms);
    }

    public function getTotalNews()
    {
        $result = $this->getOne("news", array("select" => "count(id) as counter"));

        return $result["counter"];
    }

    public function findNews($input)
    {
        return $this->getList("news", array("where" => "title like '{$input}%'"));
    }

    public function getSenderName()
    {
        $result = $this->getOne("users", array("where" => "id='{$this->properties['sender_id']}'"));

        if($result)
        {
            return $result['username'];
        }
        return false;
    }

    public function getMaxId()
    {
        $result = $this->getOne("news", array("select" => "max(id) as max_id"));

        return $result["max_id"] + 1;
    }

    public function getCatName()
    {
        $result = $this->getOne("categories", array("where" => "id='{$this->properties['category_id']}'"));

        if($result)
        {
            return $result['title'];
        }
        return false;
    }

    public function checkTitle()
    {
        $result = $this->getOneNews();
        if ($result)
        {
            return false;
        }

        return true;
    }

}