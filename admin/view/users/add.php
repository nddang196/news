<?php if (!defined("ADMIN_PATH")) die("Bad request!"); ?>

<form method="post" action="" role="form" class="col-md-6 col-md-offset-3">
    <fieldset class="fieldset-main"><legend class="legend-main"><?php echo $title ?></legend>
    <div class="form-group">
        <label for="exampleInputUsername">Tên đăng nhập  <span style="color: red">(*)</span></label>
        <?php if(isset($e_username)) showError($e_username) ?>
        <input type="text" class="form-control" id="exampleInputUsername"
               name="username" value="<?php echo inputPost('username') ?>" placeholder="nhập vào tên đăng nhập">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Mật khẩu <span style="color: red">(*)</span></label>
        <?php if(isset($e_password)) showError($e_password) ?>
        <input type="password" class="form-control" id="exampleInputPassword1"
               name="password" value="<?php echo inputPost('password') ?>" placeholder="Mật khẩu truy cập..">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword2">Nhập lại mật khẩu  <span style="color: red">(*)</span></label>
        <?php if(isset($e_repass)) showError($e_repass) ?>
        <input type="password" class="form-control" id="exampleInputPassword2"
               name="re-pass" value="<?php echo inputPost('re-pass') ?>" placeholder="nhập lại mật khẩu..">
    </div>
    <div class="form-group">
        <label for="exampleInputName">Tên hiển thị</label>
        <input type="text" class="form-control" id="exampleInputName"
               name="name" value="<?php echo inputPost('name') ?>" placeholder="Nhập tên hiển thị...">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">E-mail  <span style="color: red">(*)</span></label>
        <?php if(isset($e_email)) showError($e_email) ?>
        <input type="email" class="form-control" id="exampleInputEmail1"
               name="email" value="<?php echo inputPost('email') ?>" placeholder="email">
    </div>
    <div class="form-group">
        <label for="exampleInputPhone">Số điện thoại</label>
        <?php if(isset($e_phone)) showError($e_phone) ?>
        <input type="text" class="form-control" id="exampleInputPhone"
               name="phone" value="<?php echo inputPost('phone') ?>" placeholder="số điện thoại">
    </div>
    <div class="form-group">
        <label for="exampleInputAddress">Địa chỉ</label>
        <input type="text" class="form-control" id="exampleInputAddress"
               name="address" value="<?php echo inputPost('address') ?>" placeholder="địa chỉ">
    </div>
    <?php
    if (isBoss())
    {
        ?>
        <div class="form-group">
            <label class="control-label" for="select">Loại thành viên</label>
            <select class="form-control" id="select" name="level">
                <option value="1" <?php echo (inputPost('level') == 1) ? 'selected' : ''; ?>>Admin</option>
                <option value="2" <?php echo (inputPost('level') == 2) ? 'selected' : ''; ?>>Member</option>
            </select>
        </div>
        <?php
    }
    ?>
    <input type="hidden" name="require" value="add_user">
    <div style="text-align: center">
        <button type="submit" class="btn btn-success">Thêm</button>
        <a class="btn btn-warning col-md-offset-1"
           href="<?php echo createdURL(base_url('admin.php'), array('c' => 'users')) ?>">Quay lại</a>
    </div>
    </fieldset>
</form>
