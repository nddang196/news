<?php
if(!defined("ADMIN_PATH")) die("Bad request!");
/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 05-07-2017
 * Time: 10:17 CH
 */
class Comment_Model extends Database
{
    private $properties = array(
        "id" => 0,
        "news_id" => 0,
        "content" => "",
        "sender_id" => 0,
        "date" => "",
        "status" => 0,
    );

    public function __construct($data = array())
    {
        parent::__construct();
        if(!empty($data))
        {
            foreach ($data as $key => $value)
            {
                if(isset($this->properties[$key]))
                {
                    $this->properties[$key] = $data[$key];
                }
            }
        }
    }

    public function __set($name, $value)
    {
        if(isset($this->properties[$name]))
        {
            $this->properties[$name] = $value;
        }
    }

    public function deleteComment()
    {
        return $this->deleteData("comment", $this->properties["id"]);
    }

    public function getOneComment()
    {
        return $this->getOne("comment", array("where" => "id = '{$this->properties["id"]}'"));
    }

    public function getListComment($terms = array())
    {
        return $this->getList("comment", $terms);
    }

    public function getTotalComment()
    {
        $result = $this->getOne("comment", array("select" => "count(id) as counter"));

        return $result["counter"];
    }

    public function findComment($input)
    {
        return $this->getList("comment", array("where" => "content like '{$input}%'"));
    }
}