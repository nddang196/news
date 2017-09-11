<?php if(!defined("SITE_PATH")) die("Bad request!"); ?>

<form method="post" action="" role="form" class="col-md-offset-3"
      style="width: 50%; background-color: #e7e7e7;padding: 20px;border-radius: 5px;margin-bottom: 200px">
    <div style="text-align: center"><span style="color: #0caeff; font-size: 32px">Lấy lại mật khẩu</span></div>
    <div class="form-group">
        <label for="exampleInputEmail1">E-mail <span style="color: red">(*)</span></label>
        <?php   if (isset($e_email)) showError($e_email);
                if(isset($notify)) echo "<div class='alert alert-success' role='alert'>$notify</div>";
        ?>
        <input type="email" class="form-control" id="exampleInputEmail1" required
               name="email" value="<?php echo inputPost('email') ?>" placeholder="Nhập vào e-mail đã đăng ký">
    </div>

    <div style="text-align: center">
        <input type="hidden" name="require" value="forget">
        <button type="submit" class="btn btn-success">Gửi</button>
    </div>
</form>
