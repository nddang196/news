<?php if (!defined("ADMIN_PATH")) die("Bad request!"); ?>

<form method="post" action="" role="form" class="col-md-8 col-md-offset-2" enctype="multipart/form-data"
      style="margin-top:50px;margin-bottom: 50px">
    <fieldset class="fieldset-main">
        <legend class="legend-main"><?php echo $title ?></legend>
        <fieldset class="fieldset-content"><!-- khung tiêu đề -->
            <legend class="legend-content">Tiêu đề</legend>
            <div class="form-group">
                <label class="col-sm-2 col-sm-offset-1 control-label">Hiện tại</label>
                <div class="col-sm-7">
                    <p class="form-control-static"><?php echo $news['title'] ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-offset-1  control-label">Mới</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="tilte"
                           value="<?php echo inputPost('title') ?>" placeholder="...">
                </div>
            </div>
        </fieldset><!-- kêt thúc khung tiêu đề -->
        <fieldset class="fieldset-content"><!-- khung avatar -->
            <legend class="legend-content">Ảnh đại diện</legend>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-4">
                    <img id="image" src="<?php if ($news['avatar'] != "") echo getImage($news['avatar'], "public/images", "path") ?>"
                         class="img-rounded" style="max-width: 200px;max-height: 200px"/>
                    <input type="file" name="avatar" onchange="readURL(this);" style="margin-top: 10px;">
                    <?php if (isset($e_avatar)) showError($e_avatar) ?>
                </div>
            </div>
        </fieldset><!-- kêt thúc khung Avatar -->

        <fieldset class="fieldset-content"><!-- khung tóm tắt -->
            <legend class="legend-content">Tóm tắt</legend>
            <div class="form-group">
                <?php if (isset($e_summary)) showError($e_summary) ?>
                <textarea id="editor_summary" class="form-control" rows="3" name="summary">
                    <?php echo $_POST['summary'] ?? $news['summary'] ?>
                </textarea>
                <script>
                    var summary = CKEDITOR.replace("editor_summary");
                    CKFinder.setupCKEditor(summary);
                </script>
            </div>
        </fieldset><!-- kêt thúc khung tóm tắt -->

        <fieldset class="fieldset-content"><!-- khung nội dung -->
            <legend class="legend-content">Nội dung chi tiết</legend>
            <div class="form-group">
                <?php if (isset($e_content)) showError($e_content) ?>
                <textarea id="editor_content" class="form-control" rows="7" name="content">
                    <?php echo $_POST['content'] ?? $news['content'] ?>
                </textarea>
                <script>
                    var content = CKEDITOR.replace("editor_content");
                    CKFinder.setupCKEditor(content);
                </script>
            </div>
        </fieldset><!-- kêt thúc khung nội dung -->

        <fieldset class="fieldset-content"><!-- khung chuyên mục -->
            <legend class="legend-content">Chuyên mục</legend>
            <div class="form-group">
                <?php if (isset($e_category)) showError($e_category) ?>
                <select class="form-control" name="category">
                    <?php
                    if (isset($category))
                    {
                        foreach ($category as $item)
                        {
                            if ($news['category_id'] == $item['id'])
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
        </fieldset><!-- kêt thúc khung chuyên mục -->
        <div class="form-group" style="margin-top: 30px">
            <input type="hidden" name="require" value="edit_news">
            <div class="form-group" style="text-align: center">
                <button type="submit" class="btn btn-success">Sửa</button>
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
