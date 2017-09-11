<?php if (!defined("ADMIN_PATH")) die("Bad request!"); ?>

<form method="post" action="" role="form" class="col-md-6 col-md-offset-3">
    <fieldset class="fieldset-main"><legend class="legend-main"><?php echo $title ?></legend>
        <div class="form-group">
            <label for="cat_title">Tên chuyên mục<span style="color: red">(*)</span></label>
            <?php if(isset($err)) showError($err) ?>
            <input type="text" class="form-control" id="cat_title"
                   name="title" value="<?php echo inputPost('title') ?>" placeholder="...">
        </div>
        <div class="form-group" style="text-align: center">
            <input type="hidden" name="require" value="add_cat">
            <button type="submit" class="btn btn-success">Thêm</button>
            <a class="btn btn-warning col-md-offset-1"
               href="<?php echo createdURL(base_url('admin.php'), array('c' => 'users')) ?>">Quay lại</a>
        </div>
    </fieldset>
</form>

