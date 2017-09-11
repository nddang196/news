<?php if (!defined("ADMIN_PATH")) die("Bad request!") ?>

<form method="post" action="" role="form" class="form-horizontal col-md-6 col-md-offset-3" enctype="multipart/form-data">
    <fieldset class="fieldset-main">
        <legend class="legend-main"><?php echo $title ?></legend>

        <fieldset class="fieldset-content">
            <legend class="legend-content">Tên chuyên mục</legend>
            <div class="form-group">
                <label class="col-sm-3 control-label">Hiện tại</label>
                <div class="col-sm-7">
                    <p class="form-control-static"><?php echo $cat['title'] ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Mới</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="title"
                           value="<?php echo inputPost('title') ?>" placeholder="...">
                </div>
            </div>
        </fieldset>
        
        <div class="form-group" style="margin-top: 20px">
            <input type="hidden" name="require" value="edit_cat">
            <div style="text-align: center">
                <button type="submit" class="btn btn-success">Thay đổi</button>
                <a class="btn btn-warning col-md-offset-1"
                   href="<?php echo createdURL(base_url('admin.php'), array('c' => 'categories')) ?>">Quay lại</a>
            </div>
        </div>
    </fieldset>
</form>

