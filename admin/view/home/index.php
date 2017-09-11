<?php if (!defined("ADMIN_PATH")) die("Bad request!"); ?>
<div class="row" style="margin-top: 50px">
    <a href="<?php echo base_url("admin.php?c=users"); ?>" class="thumbnail a_home col-md-3 col-md-offset-2"
       style="background-color: #ffff99">
        <div style="margin-top:35px;font-size: 20px">
            <div class="col-md-2">
                <span class="glyphicon glyphicon-user"></span></div>
            <div class="col-md-10">
                Quản lý thành viên
            </div>
        </div>
    </a>

    <a href="<?php echo base_url("admin.php?c=categories"); ?>" class="thumbnail a_home col-md-3 col-md-offset-2"
       style="background-color: #99ff99">
        <div style="margin-top:35px;font-size: 20px">
            <div class="col-md-2">
                <span class="glyphicon glyphicon-asterisk"></span></div>
            <div class="col-md-10">
                Quản lý chuyên mục
            </div>
        </div>
    </a>
</div>
<div class="row" style="margin-top: 50px">
    <a href="<?php echo base_url("admin.php?c=news"); ?>" class="thumbnail a_home col-md-3  col-md-offset-2"
       style="background-color: #99ffff">
        <div style="margin-top:35px;font-size: 20px">
            <div class="col-md-2">
                <span class="glyphicon glyphicon-asterisk"></span></div>
            <div class="col-md-10">
                Quản lý tin tức
            </div>
        </div>
    </a>

    <a href="<?php echo base_url("admin.php?c=comment"); ?>" class="thumbnail a_home col-md-3 col-md-offset-2"
       style="background-color: #ffb399">
        <div style="margin-top:35px;font-size: 20px">
            <div class="col-md-2">
                <span class="glyphicon glyphicon-asterisk"></span></div>
            <div class="col-md-10">
                Quản lý bình luận
            </div>
        </div>
    </a>
</div>