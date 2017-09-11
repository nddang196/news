<?php if (!defined("SITE_PATH")) die("Bad request!") ?>
<div class="container" style="width:95%">
    <div class="col-md-9" style="text-align:center;">
        <?php
        if (!empty($list_news))
        {
            foreach ($list_news as $item)
            {
                ?>
                <div class="list">
                    <div class="row">
                        <span>
            	            <img src="<?php echo getImage($item['sender_avatar'], "public/images/avatar", "path") ?>"
                                 class="img-circle" style="max-height:50px">
                        </span>
                        <span> <?php echo $item['sender_name'] ?> </span>&nbsp;&nbsp;
                        <span> <?php echo $item['date_created'] ?> </span>&nbsp;&nbsp;
                        <span> trong <a href="<?php echo base_url("?c=category&id={$item['category_id']}") ?>">
                                <?php echo $item['cat_title'] ?> </a>
                        </span>
                    </div>
                    <div>
                        <a href="<?php echo createdURL(base_url(), array('c' => 'news', 'id' => $item['id'])) ?>">
                            <img class="img-home" title="Nhấp vào để đến trang chi tiết"
                                src="<?php echo getImage($item['avatar'], "public/images", "path") ?>">
                        </a>
                    </div>
                    <br>
                    <a href="<?php echo createdURL(base_url(), array('c' => 'news', 'id' => $item['id'])) ?>"
                       title="Nhấp vào để đến trang chi tiết" class="title"><?php echo $item['title'] ?></a>
                    <p><?php echo $item['summary'] ?></p>
                    <span class="glyphicon glyphicon-eye-open"> <?php echo $item['view'] ?></span>
                </div>
                <br>
                <hr>
                <?php
            }
            if (isset($pagination))
            {
                echo "<div class='text-center'>{$pagination->getHtml()}</div>";
            }
        }
        else
        {
            echo "<h1 style='margin-bottom: 300px'>Không có bài viết nào..!</h1>";
        }
        ?>
    </div>

    <div class="col-md-3">
        <label>Bài viết xem nhiều</label>
        <ul class="list-group">
            <?php
            if(isset($news_interested))
            {
                foreach ($news_interested as $item)
                {
             ?>
                    <li class="list-group-item" style="height: 120px">
                        <span><img style="height: 100px;float: left;width: 120px"
                                   src="<?php echo getImage($item['avatar'], "public/images", "path") ?>"></span>
                        <a href="<?php echo createdURL(base_url(), array('c' => 'news', 'id' => $item['id'])) ?>"
                                title="Nhấp vào để đến trang chi tiết" >
                            <?php echo substr($item['summary'], 0, 100)."..." ?>
                        </a>
                    </li>
            <?php
                }
            }
            ?>
        </ul>
    </div>
</div>
