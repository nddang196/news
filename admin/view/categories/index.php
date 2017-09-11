<?php if (!defined("ADMIN_PATH")) die("Bad request!"); ?>
<div class="container " style="width: 95%; text-align: center; margin-top: 50px">
    <div class="row col-md-8 col-md-offset-2">
        <div class="col-md-2">
            <a class="btn btn-primary" role="button"
               href="<?php echo createdURL(base_url("admin.php"), array('c' => 'categories', 'a' => 'add')) ?>">
                <span class="glyphicon glyphicon-plus"></span> Thêm Mới
            </a>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-5">
            <form method="post" action="<?php echo createdURL(base_url("admin.php"), array('c' => 'categories', 'a' => 'find')) ?>">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nhập tiêu đề..." name="search"
                           value="<?php if (isset($search)) echo $search ?>">
                    <span class="input-group-btn">
                        <input type="hidden" name="require" value="find_cat">
                        <input class="btn btn-default" type="submit" value="Tìm kiếm">
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row col-md-8 col-md-offset-2" style="margin-top: 30px">
    <table class="table table-bordered table-hover">
        <thead>
        <th>Id</th>
        <th>Tiêu đề</th>
        <th>Xóa</th>
        <th>Sửa</th>
        </thead>
        <tbody>
        <?php
        if ($list)
        {
            foreach ($list as $item)
            {
                ?>
                <tr>
                <td><?php echo $item["id"]; ?></td>
                <td><?php echo $item["title"]; ?></td>
                <td>
                    <form action="<?php echo createdURL(base_url("admin.php"), array('c' => 'categories', 'a' => 'delete')) ?>"
                          method="post" class="form_del">
                        <input type="hidden" name="require" value="delete_cat">
                        <input type="hidden" name="cat_id" value="<?php echo $item['id']; ?>">
                        <a href="" class="a_del"><span class="glyphicon glyphicon-remove"></span></a>
                    </form>
                </td>
                <td>
                    <a href="<?php echo createdURL(base_url('admin.php'), array('c' => 'categories', 'a' => 'edit', 'id' => $item['id'])); ?>">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>
                </td>
                </tr><?php
            }
        } ?>
        </tbody>
    </table>
</div>

<?php
if (isset($pagination))
{
    echo "<div class='text-center'>{$pagination->getHtml()}</div>";
}
?>

<script language="JavaScript">
    $(document).ready(function ()
    {
        //nếu click nút xóa -> submit form
        $('.a_del').click(function ()
        {
            $(this).parent().submit();
            return false;
        });

        $('.form-del').submit(function ()
        {
            if (!confirm("Xóa chuyên mục này các bài viết của nó cũng bị xóa!\nBạn có thực sự muốn xóa?"))
            {
                return false;
            }

            //nếu đồng ý xóa -> thêm 1 input ẩn chứa url hiện tại vào form delete
            // trang delete sẽ lấy url này điều hướng về
            $(this).append("<input type = 'hidden' name = 'redirect' value = '" + window.location.href + "'>");

            return true;
        });
    });
</script>