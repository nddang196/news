<?php if (!defined("SITE_PATH")) die("Bad request!") ?>
<style>
    .fieldset-content
    {
        border: 1px #ffdd9a solid;
        border-radius: 5px;
        margin-top: 10px;
        padding: 10px;
    }

    .legend-content
    {
        color: white;
        background-color: #ffdd9a;
        padding: 3px 23px;
        border-radius: 5px;
        width: auto;
        font-size: 14px;
    }
</style>

<div style="margin-left: 50px">
    <h2>Thông tin cá nhân</h2>
    <div class="col-md-offset-2" style="width: 60%">
        <form method="post" action="" role="form" class="form-horizontal" enctype="multipart/form-data">
            <fieldset class="fieldset-content">
                <legend class="legend-content">Mật khẩu</legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mới</label>
                    <div class="col-sm-7">
                        <input type="password" class="form-control" name="password"
                               value="<?php echo inputPost('password') ?>">
                        <?php if (isset($e_password)) showError($e_password) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nhập lại</label>
                    <div class="col-sm-7">
                        <input type="password" class="form-control" name="re-pass"
                               value="<?php echo inputPost('re-pass') ?>">
                        <?php if (isset($e_repass)) showError($e_repass) ?>
                    </div>
                </div>
            </fieldset>

            <fieldset class="fieldset-content">
                <legend class="legend-content">Tên hiển thị</legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Hiện tại</label>
                    <div class="col-sm-7">
                        <p class="form-control-static"><?php echo $user['fullname'] ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mới</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="name" value="<?php echo inputPost('name') ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset class="fieldset-content">
                <legend class="legend-content">Ảnh đại diện</legend>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-4">
                        <img id="blah" src="<?php echo getImage($user['avatar'], "public/images/avatar", "path") ?>"
                             style="max-width: 140px;max-height: 140px"/>
                        <input type="file" name="avatar" onchange="readURL(this);">
                        <?php if (isset($e_avatar)) showError($e_avatar) ?>
                    </div>
                </div>
            </fieldset>

            <fieldset class="fieldset-content">
                <legend class="legend-content">E-mail</legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Hiện tại</label>
                    <div class="col-sm-7">
                        <p class="form-control-static"><?php echo $user['email'] ?></p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Mới</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="email"
                               value="<?php echo inputPost('email') ?>" placeholder="...">
                        <?php if (isset($e_email)) showError($e_email) ?>
                    </div>
                </div>
            </fieldset>

            <fieldset class="fieldset-content">
                <legend class="legend-content">Số điện thoại</legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Hiện tại</label>
                    <div class="col-sm-7">
                        <p class="form-control-static"><?php echo $user['phone'] ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mới</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="phone"
                               value="<?php echo inputPost('phone') ?>" placeholder="...">
                        <?php if (isset($e_phone)) showError($e_phone) ?>
                    </div>
                </div>
            </fieldset>

            <fieldset class="fieldset-content">
                <legend class="legend-content">Địa chỉ</legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Hiện tại</label>
                    <div class="col-sm-7">
                        <p class="form-control-static"><?php echo $user['address'] ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mới</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="address"
                               value="<?php echo inputPost('address') ?>" placeholder="...">
                    </div>
                </div>
            </fieldset>

            <div class="form-group" style="margin-top: 20px">
                <input type="hidden" name="require" value="edit_user">
                <div style="text-align: center">
                    <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function readURL(input)
    {
        if (input.files && input.files[0])
        {
            var reader = new FileReader();

            reader.onload = function (e)
            {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
