<?php if (!defined("ADMIN_PATH")) die("Bad request!"); ?>
<br><br>
<div class="container-fluid" style="width: 95%; text-align: center">
    <div class="row">
        <div class="col-md-2">
            <a class="btn btn-primary" role="button"
               href="<?php echo createdURL(base_url("admin.php"), array('c' => 'users', 'a' => 'add')) ?>">
                <span class="glyphicon glyphicon-plus"></span> Thêm Mới
            </a>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-5">
            <form method="post"
                  action="<?php echo createdURL(base_url("admin.php"), array('c' => 'users', 'a' => 'find')) ?>">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nhập tên tài khoản hoặc tên hiển thị..."
                           name="search" value="<?php if (isset($search)) echo $search ?>">
                    <span class="input-group-btn">
                        <input type="hidden" name="require" value="find_user">
                        <input class="btn btn-default" type="submit" value="Tìm kiếm">
                    </span>
                </div>
            </form>
        </div>
    </div>

<br>
<div class="row">
    <table class="table table-bordered table-hover">
        <thead>
        <th>Id</th>
        <th>Tên tài khoản</th>
        <th>Mật khẩu</th>
        <th>Tên hiển thị</th>
        <th>Avatar</th>
        <th>E-mail</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Loại thành viên</th>
        <th>Trạng thái</th>
        <th>Xóa</th><th>Sửa</th>

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
            <td><?php echo $item["username"]; ?></td>
            <td><?php echo $item["password"]; ?></td>
            <td><?php echo $item["fullname"]; ?></td>
            <td><?php getImage($item["avatar"], "public/images/avatar"); ?></td>
            <td><?php echo $item["email"]; ?></td>
            <td><?php echo $item["phone"]; ?></td>
            <td><?php echo $item["address"]; ?></td>
            <td><?php echo getLevel($item["level"]); ?></td>
            <td><?php echo getStatus($item["active"]); ?></td>
            <?php
            if (isBoss())
            {
                if ($item['level'] != 0)
                {
                    ?>
                    <td>
                    <form action="<?php echo createdURL(base_url("admin.php"), array('c' => 'users', 'a' => 'delete')) ?>"
                          method="post" class="form_del">
                        <input type="hidden" name="require" value="delete_user">
                        <input type="hidden" name="user_id" value="<?php echo $item['id']; ?>">
                        <a href="" class="a_del"><span class="glyphicon glyphicon-remove"></span></a>
                    </form>
                    </td><?php
                }
                else
                {
                    echo "<td></td>";
                } ?>
                <td>
                    <a href="<?php echo createdURL(base_url('admin.php'), array('c' => 'users', 'a' => 'edit', 'id' => $item['id'])); ?>">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>
                </td>
                <?php
            }
            elseif ($item['username'] == isLogged()['username'])
            {
                ?>
                <td></td>
                <td>
                <a href="<?php echo createdURL(base_url('admin.php'), array('c' => 'users', 'a' => 'edit', 'id' => $item['id'])); ?>">
                    <span class="glyphicon glyphicon-refresh"></span>
                </a>
                </td><?php
            }
            else
            {
                echo "<td></td><td></td>";
            }
            echo '</tr>';
        }
        }?>
        </tbody>
    </table>
</div>

<?php
if (isset($pagination))
{
    echo "<div class='text-center'>{$pagination->getHtml()}</div>";
}
?>
</div>
<script language="JavaScript">
    $(document).ready(function ()
    {
        //nếu click nút xóa -> submit form
        $('.a_del').click(function ()
        {
            $(this).parent().submit();
            return false;
        });

        $('.form_del').submit(function ()
        {
            if (!confirm("Xóa thành viên này các bài viết và bình luận của thành viên này cũng bị xóa!Bạn có thực sự muốn xóa?"))
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