<?php if (!defined("ADMIN_PATH")) die("Bad request!") ?>

<form method="post" action="" role="form" class="form-horizontal col-md-6 col-md-offset-3" enctype="multipart/form-data">
    <fieldset class="fieldset-main">
        <legend class="legend-main"><?php echo $user['username'] ?></legend>

        <fieldset class="fieldset-content">
            <legend class="legend-content">Mật khẩu</legend>
            <div class="form-group">
                <label class="col-sm-3 control-label">Mới</label>
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="password" value="" placeholder="...">
                    <?php if(isset($e_password)) showError($e_password) ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Nhập lại</label>
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="re-pass"
                           value="<?php echo inputPost('re-pass') ?>" placeholder="...">
                    <?php if(isset($e_repass)) showError($e_repass) ?>
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
                    <input type="text" class="form-control" name="name"
                           value="<?php echo inputPost('name') ?>" placeholder="...">
                </div>
            </div>
        </fieldset>

        <fieldset class="fieldset-content">
            <legend class="legend-content">Ảnh đại diện</legend>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-4">
                    <img id="blah" src="<?php echo getImage($user['avatar'], "public/images/avatar", "path") ?>" style="max-width: 140px;max-height: 140px" />
                    <input type="file" name="avatar" onchange="readURL(this);" >
                    <?php if(isset($e_avatar)) showError($e_avatar) ?>
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
                    <?php if(isset($e_email)) showError($e_email) ?>
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
                    <?php if(isset($e_phone)) showError($e_phone) ?>
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

        <?php
        if (isBoss() && $user['level'] != 0)
        {
            ?>
            <fieldset class="fieldset-content">
                <legend class="legend-content">Trạng thái</legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Hiện tại</label>
                    <div class="col-sm-7">
                        <p class="form-control-static"><?php echo getStatus($user['active']) ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mới</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="active">
                            <option value="">--Chọn trạng thái--</option>
                            <option value="1" <?php echo (inputPost('active') == 1) ? 'selected' : ''; ?>>Kích hoạt</option>
                            <option value="0" <?php echo (is_numeric(inputPost('active'))&&inputPost('active') == 0) ? 'selected' : ''; ?>>Khóa</option>
                        </select>
                    </div>
                </div>
            </fieldset>

            <fieldset class="fieldset-content">
                <legend class="legend-content">Cấp độ</legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Hiện tại</label>
                    <div class="col-sm-7">
                        <p class="form-control-static"><?php echo getLevel($user['level']) ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mới</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="level">
                            <option value="">--Chọn cấp độ--</option>
                            <option value="1" <?php echo (inputPost('level') == 1) ? 'selected' : ''; ?>>Admin</option>
                            <option value="2" <?php echo (inputPost('level') == 2) ? 'selected' : ''; ?>>Member</option>
                        </select>
                    </div>
                </div>
            </fieldset>
            <?php
        }
        ?>
        <div class="form-group" style="margin-top: 20px">
            <input type="hidden" name="require" value="edit_user">
            <div style="text-align: center">
                <button type="submit" class="btn btn-success">Thay đổi</button>
                <a class="btn btn-warning col-md-offset-1"
                   href="<?php echo createdURL(base_url('admin.php'), array('c' => 'users')) ?>">Quay lại</a>
            </div>
        </div>
    </fieldset>
</form>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
