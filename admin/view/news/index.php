<?php if (!defined("ADMIN_PATH")) die("Bad request!"); ?>
<style>
    .large_data
    {
        max-height:100px;
        width:200px;
        overflow-y:auto
    }
    img{
        max-width:140px;
        max-height:140px;
    }
</style>
<br><br>
<div class="container-fluid" style="width: 90%; text-align: center; ">
    <div class="row">
        <div class="col-md-2">
            <a class="btn btn-primary" role="button"
               href="<?php echo createdURL(base_url("admin.php"), array('c' => 'news', 'a' => 'add')) ?>">
                <span class="glyphicon glyphicon-plus"></span> Thêm Mới
            </a>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-5">
            <form method="post"
                  action="<?php echo createdURL(base_url("admin.php"), array('c' => 'news', 'a' => 'find')) ?>">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="..."
                           name="search" value="<?php if (isset($search)) echo $search ?>">
                    <span class="input-group-btn">
                        <input type="hidden" name="require" value="find_news">
                        <input class="btn btn-default" type="submit" value="Tìm kiếm">
                    </span>
                </div>
            </form>
        </div>
    </div>

    <br>
    <div class="row" style="overflow-x: auto">
        <table class="table table-bordered table-hover table-responsive">
            <thead>
            <th>Id</th>
            <th>Tiêu đề</th>
            <th>Tóm tắt</th>
            <th>Nội dung</th>
            <th>Chuyên mục</th>
            <th>Người đăng</th>
            <th>Avatar</th>
            <th>Ngày đăng</th>
            <th>Lượt xem</th>
            <th>Trạng thái</th>
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
                    <td><div class="large_data"><?php echo $item["title"]; ?></div></td>
                    <td><div class="large_data"><?php echo $item["summary"]; ?></div></td>
                    <td><div class="large_data"><?php echo $item["content"]; ?></div></td>
                    <td><?php echo $item["category_id"]; ?></td>
                    <td><?php echo $item["sender_id"]; ?></td>
                    <td><?php if($item['avatar'] != "")getImage($item["avatar"], "public/images") ?></td>
                    <td><?php echo $item["date_created"]; ?></td>
                    <td><?php echo $item["view"]; ?></td>
                    <td><?php echo getStatus($item["status"]) ?></td>
                    <?php
                    if(isBoss() || $item['sender_id'] == isLogged()['username'])
                    { ?>
                        <td>
                            <form action="<?php echo createdURL(base_url("admin.php"), array('c' => 'news', 'a' => 'delete')) ?>"
                                  method="post" class="form_del">
                                <input type="hidden" name="require" value="delete_news">
                                <input type="hidden" name="news_id" value="<?php echo $item['id']; ?>">
                                <a href="" class="a_del"><span class="glyphicon glyphicon-remove"></span></a>
                            </form>
                        </td>
                        <td>
                        <a href="<?php echo createdURL(base_url('admin.php'), array('c' => 'news', 'a' => 'edit', 'id' => $item['id'])); ?>">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </a>
                        </td><?php
                    }
                    else
                    {
                        echo "<td></td><td></td>";
                    }
                    ?>
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

        $('.form-del').submit(function ()
        {
            if (!confirm("Xóa bài viết này các bình luận của nó cũng bị xóa!\nBạn có thực sự muốn xóa?"))
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