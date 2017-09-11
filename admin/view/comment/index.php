<?php if (!defined("ADMIN_PATH")) die("Bad request!"); ?>
<div class="container " style="width: 95%; text-align: center; margin-top: 50px">
    <div class="row col-md-8 col-md-offset-2">
        <div class="col-md-7"></div>
        <div class="col-md-5">
            <form method="post" action="<?php echo createdURL(base_url("admin.php"), array('c' => 'comment', 'a' => 'find')) ?>">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nhập nội dung..." name="search"
                           value="<?php if (isset($search)) echo $search ?>">
                    <span class="input-group-btn">
                        <input type="hidden" name="require" value="find_comment">
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
        <th>Bài viết</th>
        <th>Người bình luận</th>
        <th>Nội dung</th>
        <th>Thời gian</th>
        <th>Trạng thái</th>
        <th>Xóa</th>
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
                <td><?php echo $item["news"]; ?></td>
                <td><?php echo $item["user"]; ?></td>
                <td><?php echo $item["content"]; ?></td>
                <td><?php echo $item["time"]; ?></td>
                <td><?php echo getStatus(item["status"]); ?></td>
                <td>
                    <form action="<?php echo createdURL(base_url("admin.php"), array('c' => 'comment', 'a' => 'delete')) ?>"
                          method="post" class="form_del">
                        <input type="hidden" name="require" value="delete_comment">
                        <input type="hidden" name="comment_id" value="<?php echo $item['id']; ?>">
                        <a href="" class="a_del"><span class="glyphicon glyphicon-remove"></span></a>
                    </form>
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
            if (!confirm("Bạn có thực sự muốn xóa?"))
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