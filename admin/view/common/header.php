<?php
/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 06-07-2017
 * Time: 9:52 SA
 */
if (!defined("ADMIN_PATH")) die("Bad request!");
?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $title ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap-theme.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("public/css/admin.css"); ?>">
    <script src="<?php echo base_url("public/js/jquery_min.js"); ?>"></script>
    <script src="<?php echo base_url("public/js/bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("public/ckeditor/ckeditor.js"); ?>"></script>
    <script src="<?php echo base_url("public/ckfinder/ckfinder.js"); ?>"></script>
    <script src="<?php echo base_url("public/js/admin.js") ?>"></script>
</head>
<body>
<!--Banner-->
<header class="container-fluid" style="height:100px;background-color: #bfff80;">
    <div class="col-md-8" style="font-size:48px;color: #99ccff">Quản Trị Website</div>
    <div class="col-md-4" style="margin-top:50px; text-align: right">
    <?php
        $current_user = isLogged();
        $show = ($current_user['fullname'] == 'NO NAME') ? $current_user['username'] : $current_user['fullname'];
        echo "<b style='font-size: 24px;color:#f2f2f2'>" . $show . "</b>";
        echo '&nbsp<a href="'. base_url("admin.php?c=home&a=logout") .'"><span class="glyphicon glyphicon-log-out"></span></a>';
        ?>
    </div>
</header>
<nav>
    <ul class="nav nav-tabs" role="tablist">
        <li id="nav-home"><a href="<?php echo base_url("admin.php?c=home"); ?>">Trang chủ</a></li>
        <li class="dropdown" id="nav-user">
            <a href="<?php echo base_url("admin.php?c=users"); ?>">
                Quản lý thàn viên <span class="caret"></span>
            </a>
            <ul class="dropdown-menu menu">
                <li><a href="">Thống kê</a></li>
                <li><a href="">Thống kê</a></li>
                <li><a href="">Thống kê</a></li>
                <li><a href="">Thống kê</a></li>
            </ul>
        </li>

        <li id="nav-category">
            <a href="<?php echo base_url("admin.php?c=categories"); ?>">
                Quản lý chuyên mục <span class="caret"></span>
            </a>
        </li>

        <li class="dropdown" id="nav-news">
            <a href="<?php echo base_url("admin.php?c=news"); ?>">
                Quản lý tin tức <span class="caret"></span>
            </a>
            <ul class="dropdown-menu menu">
                <li><a href="">Thống kê</a></li>
                <li><a href="">Thống kê</a></li>
                <li><a href="">Thống kê</a></li>
                <li><a href="">Thống kê</a></li>
            </ul>
        </li>

        <li class="dropdown" id="nav-comment">
            <a href="<?php echo base_url("admin.php?c=comment"); ?>">
                Quản lý bình luận <span class="caret"></span>
            </a>
            <ul class="dropdown-menu menu">
                <li><a href="">Thống kê</a></li>
                <li><a href="">Thống kê</a></li>
            </ul>
        </li>
    </ul>
</nav>
