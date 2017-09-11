<?php if (!defined("SITE_PATH")) die("Bad request!"); ?>

<form method="post" action="" role="form" class="col-md-offset-3"
      style="width: 50%; background-color: #e7e7e7;padding: 20px;border-radius: 5px;">
    <div style="text-align: center"><span style="color: #0caeff; font-size: 32px">Đăng ký</span></div>
    <div style="text-align: right"><span>(*) : Bắt buộc</span></div>
    <div class="form-group">
        <label for="exampleInputUsername">Tên đăng nhập <span style="color: red">(*)</span></label>
        <?php if (isset($e_username)) showError($e_username) ?>
        <input type="text" class="form-control" id="exampleInputUsername" required
               name="username" value="<?php echo inputPost('username') ?>" placeholder="nhập vào tên đăng nhập">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Mật khẩu <span style="color: red">(*)</span></label>
        <?php if (isset($e_password)) showError($e_password) ?>
        <input type="password" class="form-control" id="exampleInputPassword1" required
               name="password" value="<?php echo inputPost('password') ?>" placeholder="Mật khẩu truy cập..">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword2">Nhập lại mật khẩu <span style="color: red">(*)</span></label>
        <?php if (isset($e_repass)) showError($e_repass) ?>
        <input type="password" class="form-control" id="exampleInputPassword2" required
               name="re-pass" value="<?php echo inputPost('re-pass') ?>" placeholder="nhập lại mật khẩu..">
    </div>
    <div class="form-group">
        <label for="exampleInputName">Tên hiển thị</label>
        <input type="text" class="form-control" id="exampleInputName"
               name="name" value="<?php echo inputPost('name') ?>" placeholder="Nhập tên hiển thị...">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">E-mail <span style="color: red">(*)</span></label>
        <?php if (isset($e_email)) showError($e_email) ?>
        <input type="email" class="form-control" id="exampleInputEmail1" required
               name="email" value="<?php echo inputPost('email') ?>" placeholder="email">
    </div>
    <div class="form-group">
        <label for="exampleInputPhone">Số điện thoại</label>
        <?php if (isset($e_phone)) showError($e_phone) ?>
        <input type="text" class="form-control" id="exampleInputPhone"
               name="phone" value="<?php echo inputPost('phone') ?>" placeholder="số điện thoại">
    </div>
    <div class="form-group">
        <label for="exampleInputAddress">Địa chỉ</label>
        <input type="text" class="form-control" id="exampleInputAddress"
               name="address" value="<?php echo inputPost('address') ?>" placeholder="địa chỉ">
    </div>

    <div style="text-align: center">
        <input type="hidden" name="require" value="add_user">
        <button type="submit" class="btn btn-success">Đăng ký</button>
    </div>
</form>
