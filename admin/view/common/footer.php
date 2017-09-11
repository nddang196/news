<?php if (!defined("ADMIN_PATH")) die("Bad request!"); ?>

<script language="JavaScript">
    $(document).ready(function ()
    {
        <?php
        if(isset($_GET['c']))
        {
            switch ($_GET['c'])
            {
                case "home" :?>
                    homeActive();<?php
                    break;
                case "users" :?>
                    userActive();<?php
                    break;
                case "categories" :?>
                    categoryActive();<?php
                    break;
                case "news" :?>
                    newsActive();<?php
                    break;
                default :?>
                    commentActive();<?php
            }
        }
        ?>
        dropdown();
    })
</script>
</body>
</html>



