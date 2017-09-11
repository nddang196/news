<?php if (!defined("ADMIN_PATH")) die("Bad request!"); ?>

<form method="post" action="" role="form" class="col-md-8 col-md-offset-2" enctype="multipart/form-data"
      style="margin-top:50px;margin-bottom: 50px">
    <fieldset class="fieldset-main">
        <legend class="legend-main"><?php echo $title ?></legend>
        <div class="form-group">
            <label for="inputTitle">Tiêu đề<span style="color: red">(*)</span></label>
            <?php if (isset($e_title)) showError($e_title) ?>
            <input type="text" class="form-control" id="inputTitle"
                   name="title" value="<?php echo inputPost('title') ?>">
        </div>
        <div class="form-group">
            <label for="inputAvatar">Avatar</label>
            <?php if (isset($e_avatar)) showError($e_avatar) ?>
            <div id="inputAvatar" class="col-md-offset-2">
                <img id="image" src="" class="img-rounded" style="max-width: 140px;max-height: 140px"/>
                <input type="file" name="avatar" onchange="readURL(this);">
            </div>
        </div>
        <div class="form-group">
            <label for="editor_summary">Tóm tắt <span style="color: red">(*)</span></label>
            <?php if (isset($e_summary)) showError($e_summary) ?>
            <textarea id="editor_summary" class="form-control" rows="3" name="summary">
                <?php echo inputPost('summary') ?>
            </textarea>
            <script>
                var editor1 = CKEDITOR.replace("editor_summary");
                CKFinder.setupCKEditor(editor1);
            </script>
        </div>
        <div class="form-group">
            <label for="editor_content">Nội dung <span style="color: red">(*)</span></label>
            <?php if (isset($e_content)) showError($e_content) ?>
            <textarea id="editor_content" class="form-control" rows="7" name="content">
                <?php echo inputPost('content') ?>
            </textarea>
            <script>
                var editor2 = CKEDITOR.replace("editor_content");
                CKFinder.setupCKEditor(editor2);
            </script>
        </div>
        <div class="form-group">
            <label for="inputCat">Chuyên mục <span style="color: red">(*)</span></label>
            <?php if (isset($e_category)) showError($e_category) ?>
            <select class="form-control" name="category">
                <option value="">--Chọn chuyên mục--</option>
                <?php
                if (isset($category))
                {
                    foreach ($category as $item)
                    {
                        if (inputPost('category') == $item['id'])
                        {
                            echo "<option value='{$item['id']}' selected>{$item['title']}</option>";
                        }
                        else
                        {
                            echo "<option value='{$item['id']}' >{$item['title']}</option>";
                        }
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group" style="margin-top: 20px">
            <input type="hidden" name="require" value="add_news">
            <div style="text-align: center">
                <button type="submit" class="btn btn-success">Thêm</button>
                <a class="btn btn-warning col-md-offset-1"
                   href="<?php echo createdURL(base_url('admin.php'), array('c' => 'news')) ?>">Quay lại</a>
            </div>
        </div>
    </fieldset>
</form>
<script>
    function readURL(input)
    {
        if (input.files && input.files[0])
        {
            var reader = new FileReader();

            reader.onload = function (e)
            {
                $('#image')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
