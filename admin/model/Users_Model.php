<?php if (!defined("ADMIN_PATH")) die("Bad request!");

class Users_Model extends Database
{
    private $properties = array(
        "id" => -1,
        "username" => "",
        "password" => "",
        "fullname" => "",
        "avatar" => "",
        "email" => "",
        "level" => "",
        "address" => "",
        "phone" => "",
        "active" => ""
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
                    $this->properties[$key] = $value;
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

    function addUser()
    {
        return $this->addData("users", $this->properties);
    }

    public function editUser()
    {
        return $this->editData("users", $this->properties);
    }

    public function deleteUser()
    {
        return $this->deleteData("users", $this->properties['id']);
    }

    public function getOneUser()
    {
        return $this->getOne("users", array("where" => "id ='{$this->properties['id']}' OR username='{$this->properties['username']}'"));
    }

    public function getListUser($terms = array())
    {
        return $this->getList("users", $terms);
    }

    public function getTotalUser()
    {
        $result = $this->getOne("users", array('select' => 'count(id) as counter'));

        return $result['counter'];
    }

    public function findUser($input)
    {
        $result = $this->getOne("users", array("select" => "count(id) as counter",
            "where" => "username LIKE '%{$input}%' OR fullname LIKE '%{$input}%'"));

        return $result['counter'];
    }

    public function checkUsername()
    {
        $result = $this->getOneUser();

        if ($result)
        {
            return true;
        }

        return false;
    }

    public function checkEmail()
    {
        $result = $this->getOne("users", array("where" => "email='{$this->properties['email']}'"));

        if ($result)
        {
            return true;
        }

        return false;
    }
}