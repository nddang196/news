<?php if(!defined("ADMIN_PATH")) die("Bad request!") ?>
<html>
<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap-theme.min.css") ?>">
    <style>
    #btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 6px 0 rgba(0, 0, 0, 0.2);
    }
    </style>
    <script src="<?php echo base_url("public/js/jquery_min.js"); ?>"></script>
</head>
<body>
<div class="container">
    <div id="loginbox" style="margin-top:100px;" class="mainbox col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Đăng nhập vào tài khoản của bạn</div>
            </div>
            <div style="padding-top:30px" class="panel-body">
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form action="<?php echo createdURL(base_url("admin.php"), array('c' => 'home', 'a' => 'login'))?>" class="form-horizontal" role="form" method="post">
                    <?php if(isset($e_username)) showError($e_username); ?>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username"
                               value="<?php echo inputPost('username'); ?>" placeholder="Enter username">
                    </div>

                    <?php if(isset($e_password)) showError($e_password); ?>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password"
                               value="<?php echo inputPost('password'); ?>" placeholder="Enter password">
                    </div>

                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <input type="hidden" name="require" value="login">
                            <input type="submit" value="Đăng nhập" class="btn btn-success btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
