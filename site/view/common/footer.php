<?php if(!defined("SITE_PATH")) die("Bad request!") ?>
    </div>
</div><!-- kết thúc container -->

<!-- Nút về lên top -->
<div id="up_to_top" class="navbar-fixed-bottom">
    <a href="#"><span class="glyphicon glyphicon-circle-arrow-up"></span></a>
</div>

<hr size="2px">
<footer style="position: relative">
    <address class="navbar-left">
        Đông Lao, Đông La<br>
        Hoài Đức, Hà Nội<br>
        <strong>Điện thoại:</strong> 01663 898 196<br>
        <strong>E-mail : </strong><a href="mailto:#">nddang196@gmail.com</a>
    </address>

    <div class="navbar-right">
        <div class="navbar-nav"> <!-- footer menu -->
            <a href="<?php echo base_url() ?>">Trang chủ</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#">Phàn hồi</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#">Thông Tin</a>
        </div>
        <div class="copyright">Copyright &copy;  by Đình Đăng</div>
    </div>
</footer>

<script>
    $(document).ready(function ()
    {
        scrollEvent();

        dropdownEvent();

        $("#up_to_top").click(function(){
            $("html,body").animate({
                scrollTop:0
            },1000);
        });
    })
</script>
</body>
</html>

