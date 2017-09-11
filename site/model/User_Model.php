<?php if(!defined("SITE_PATH")) die("Bad request!");

class User_Model extends Database
{
    public function addUser($data)
    {
        return $this->addData("users", $data);
    }

    public function editUser($data)
    {
        return $this->editData("users", $data);
    }

    public function getUserById($id)
    {
        return $this->getOne("users", array("where" => "id='$id'"));
    }

    public function getOneUser($terms = array())
    {
        return $this->getOne("users", $terms);
    }

    public function getIdInsert()
    {
        return mysqli_insert_id($this->_link);
    }

    public function checkUsername($username)
    {
        $result = $this->getOne("users", array("where" => "username='$username'"));

        if ($result)
        {
            return true;
        }

        return false;
    }

    public function checkEmail($email)
    {
        $result = $this->getOne("users", array("where" => "email='$email'"));

        if ($result)
        {
            return true;
        }

        return false;
    }
}