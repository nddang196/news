<?php
/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 05-07-2017
 * Time: 8:30 SA
 */
function base_url($uri = "")
{
    return "http://localhost/tin_tuc_mvc/" . $uri;
}

function redirect($uri)
{
    header("Location:$uri");
    exit();
}

function controllerName($ctr)
{
    return ucfirst($ctr) . "_Controller";
}

function inputGet($key)
{
    return isset($_GET[$key]) ? trim(addslashes($_GET[$key])) : "";
}

function inputPost($key)
{
    return isset($_POST[$key]) ? trim(addslashes($_POST[$key])) : "";
}

//kiểm tra xem form có được submit hay không
function isSubmit($key)
{
    if (isset($_POST['require']) && $_POST['require'] == $key)
    {
        return TRUE;
    }

    return FALSE;
}

//hiển thị lỗi
function showError($error)
{
    echo "<div class='alert alert-danger' role='alert'>$error</div>";
}

//tạo một đường dẫn
function createdURL($uri, $filter = array())
{
    $s = "";

    foreach ($filter as $key => $item)
    {
        $s .= "{$key}={$item}&";
    }
    if ($s != "")
    {
        $s = "?" . rtrim($s, "&");
    }

    return $uri . $s;
}

function getStatus($status)
{
    if ($status == 0)
    {
        return "Khóa";
    }

    return "Kích hoạt";
}

function getLevel($level)
{
    if ($level == 0)
    {
        return "Boss";
    }
    elseif ($level == 1)
    {
        return "Admin";
    }

    return "Member";
}

//lấy đường dẫn ảnh hoặc tạo hiển thị một thẻ ảnh
function getImage($image, $uri, $chose = "")
{
    $path = base_url("$uri/$image");
    if ($chose == "path")
        return $path;
    echo "<img src='$path' alt='$image' style='max-width: = 70px;max-height: 70px'>";
}

//kiểm tra ảnh có thuộc định dạng cho phép
function checkAvatar(&$avatar)
{
    if ($avatar == "")
    {
        return true;
    }
    //mảng xác định những đinh dạng ảnh cho phép
    $extend = array("png", "jpg", "jpeg", "webp");

    //lấy phần mở rộng của ảnh truyền vào
    $temp = explode(".", $avatar);
    $img_extend = strtolower(end($temp));

    if (in_array($img_extend, $extend))
    {
        $avatar = "avatar." . $img_extend;
        return true;
    }

    return false;
}