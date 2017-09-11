<?php

/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 04-07-2017
 * Time: 8:59 CH
 */
class Database
{
    protected $_link;

    public function __construct()
    {
        $this->_link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

        if(!$this->_link)
        {
            die("Không thể kết nối tới CSDL!<br>" . mysqli_error($this->_link));
        }

        mysqli_set_charset($this->_link, "utf8");
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }

    function addData($table, $data = array())
    {
        if(isset($data['id']))
        {
            unset($data['id']);
        }

        $keys = array();
        $values = array();

        foreach ($data as $key => $value)
        {
            $keys[] = $key;
            $values[] = "'$value'";
        }

        $sql = "INSERT INTO $table (" . implode(", ", $keys) . ") VALUE (" . implode(", ", $values) . ")";

        if(mysqli_query($this->_link, $sql))
        {
            return true;
        }

        return false;
    }

    function  editData($table, $data = array())
    {
        $set = array();

        if(isset($data["id"]))
        {
            $id = intval($data["id"]);
            unset($data["id"]);
        }
        foreach ($data as $key => $value)
        {
            if($value != "")
            {
                $set[] = $key . " = '" . $value . "'";
            }
        }

        if(!empty($set))
        {
            $sql = "UPDATE $table set " . implode(", ", $set) . " WHERE id = '$id'";
            if(mysqli_query($this->_link, $sql))
            {
                return true;
            }
        }

        return false;
    }

    function deleteData($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = '{$id}'";

        if(mysqli_query($this->_link, $sql))
        {
            return true;
        }

        return false;
    }

    function getList($table, $terms = array())
    {
        $select = isset($terms["select"]) ? $terms["select"] : "*";
        $where = isset($terms["where"]) ? " WHERE " . $terms["where"] : "";
        $orderby = isset($terms["orderby"]) ? " ORDER BY " . $terms["orderby"] : "";
        $limit = isset($terms["limit"]) ? " LIMIT " . $terms["limit"] : "";

        $sql = "SELECT $select FROM $table $where $orderby $limit";

        $result = mysqli_query($this->_link, $sql);
        if($result)
        {
            $list = array();
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $list[] = $row;
                }
                mysqli_free_result($result);

                return $list;
            }
        }

        return false;
    }

    public function getOne($table, $terms = array())
    {
        $select = isset($terms["select"]) ? $terms["select"] : "*";
        $where = isset($terms["where"]) ? " WHERE " . $terms["where"] : "";

        $sql = "SELECT $select FROM $table $where";
        $result = mysqli_query($this->_link, $sql);

        if ($result)
        {
            $row = mysqli_fetch_assoc($result);
            mysqli_free_result($result);

            return $row;
        }

        return FALSE;
    }
}