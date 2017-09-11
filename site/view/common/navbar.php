<?php if (!defined("SITE_PATH")) die("Bad request!") ?>

<nav class="navbar navbar-default navbar-inverse" role="navigation" id="navbar" >
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a class="navbar-brand links" href="<?php echo base_url() ?>">
                        <span class="glyphicon glyphicon-home"></span> <b>Trang chủ</b>
                    </a>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle links" data-toggle="dropdown">
                        <b>Chủ đề <span class="caret"></span></b></a>
                    <ul class="dropdown-menu" role="menu" id="cat">
                        <li>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <ul class="nav nav-pills nav-stacked">
                        <?php
                        if(isset($list_cat))
                        {
                            foreach ($list_cat as $item)
                            {
                                echo "<li id='{$item['id']}'><a href='" . base_url("?c=home&a=newsByCat&cat={$item['id']}") . "'>{$item['title']}</a></li>";
                            }
                        }
                        ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-9" id="news_cat" style="min-height:150px">

                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- form đăng nhập -->
            <ul class="nav navbar-nav navbar-right" id="login" style="display: <?php if(isLogged()) echo "none"; else echo "block"; ?>">
                <li class="dropdown"><a href="#" class="dropdown-toggle links" data-toggle="dropdown"><b>Đăng nhập</b> <span
                                class="caret"></span></a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form" role="form" method="post" action="<?php echo createdURL(base_url(), array('c' => 'home', 'a' => 'login')) ?>"
                                          accept-charset="UTF-8" id="login-nav">
                                        <?php echo $e_login ?? ""; ?>
                                        <div class="form-group">
                                            <label class="control-label" for="inputUsername">Tên đăng nhập</label>
                                            <input type="text" class="form-control" id="inputUsername" name="username"
                                                   placeholder="Tên đăng nhập của bạn" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="inputPassword">Mật khẩu</label>
                                            <input type="password" class="form-control" id="inputPassword"
                                                   name="password" placeholder="Mật khẩu của bạn" required>
                                            <div class="help-block text-right"><a href="<?php echo base_url("?c=user&a=forget") ?>">Quên mật khẩu ?</a></div>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="back" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
                                            <input type="hidden" name="require" value="login">
                                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                                        </div>
                                        <div class="checkbox">
                                            <label> <input type="checkbox" name="remember">Nhớ đăng nhập</label>
                                        </div>
                                    </form>
                                </div>

                                <div class="bottom text-center"> Tạo mới tài khoản ?
                                    <a href="<?php echo base_url("?c=user&a=register") ?>">Đăng ký</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sau khi đăng nhập thành công -->
            <ul id="logged" class="nav navbar-nav navbar-right" style="display:<?php if(isLogged()) echo "block"; else echo "none"; ?>;" >
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle link" data-toggle="dropdown">
                        <?php
                        $current_user = isLogged();
                        echo '<img src="' . getImage($current_user['avatar'], "public/images/avatar", "path")
                            . '" class="img-responsive img-circle" style="max-width:35px;float:left"> ';
                        echo $current_user['fullname'];
                        ?>
                    </a>
                    <ul class="dropdown-menu" id="logged-dp" style="min-width: 250px;">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-5">
                                        <img src="<?php echo getImage($current_user['avatar'], "public/images/avatar", "path") ?>" class="img-responsive img-rounded" style="max-width:80px;">
                                    </div>

                                    <div class="col-md-7" style="margin-top:24px">
                                        <a href="<?php echo createdURL(base_url(), array('c' => 'home', 'a' => 'logout')) ?>">
                                            <span class="glyphicon glyphicon-log-out"></span> Đăng xuất
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li role="presentation" class="divider"></li>
                        <li>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="<?php echo createdURL(base_url(), array('c' => 'user', 'a' => 'profile', 'id' => $current_user['id'])) ?>">
                                        <span class="glyphicon glyphicon-user"></span> Thông tin cá nhân
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="<?php echo createdURL(base_url(), array('c' => 'user', 'a' => 'notify')) ?>">
                                        <span class="glyphicon glyphicon-bell"></span> Thông báo
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Form tìm kiếm -->
            <form method="post" action="<?php echo createdURL(base_url(), array('c' => 'home', 'a' => 'find')) ?>"
                  class="navbar-form navbar-right" role="search" style="width:60%">
                <input type="text" name="search" class="form-control" value="<?=inputPost("search")?>" placeholder="Tìm kiếm..." style="width:87%">
                <input type="hidden" name="require" value="search">
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div>
     &nbsp;
</div>

<script>
    $(document).ready(function ()
    {
//        $(".btn-logout").click(function ()
//        {
//            $(this).parent().submit();
//            return false;
//        })
//        $(".logout-form").submit(function ()
//        {
//            $(this).append("<input type = 'hidden' name = 'redirect' value = '" + window.location.href + "'>");
//
//            return true;
//        })
        <?php
        foreach ($list_cat as $item)
        {
            ?>
            $("#" + <?php echo $item['id'] ?>).mouseover(function ()
            {
                $("#news_cat").empty();
                $("#news_cat").append(
                    "<div >" +
                    "Một số tin của chuyên mục ( đang thực hiện)  <?php echo $item['id'] ?>" +
                    "</div>"
                );
            })
            $("#news_cat").mouseout(function ()
            {
                $("#news_cat").empty();
            })
            <?php
        }
        ?>
    })
</script>

