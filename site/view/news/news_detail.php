<?php if (!defined("SITE_PATH")) die("Bad request!") ?>

<style>
    #title
    {
        max-height: 300px;
        background-image: url("<?php echo getImage($news['avatar'], "public/images/", "path") ?>");
        text-align: left;
        margin-left: 30px;
        padding: 20px 30px;
    }
    #btn-comment
    {
        margin-left: 20px;
        margin-top: 30px;
    }
    #commemt
    {
        background-color: #eaeaea;
        width: 100%;
        padding: 20px;
    }
    .comment-item
    {
        margin-top: 20px;
        border: 1px white solid;
        border-radius: 5px;
        padding: 10px;
    }
</style>
<div class="container" style="width:95%">
    <div class="col-md-9" style="">
        <!-- phần tiêu đề -->
        <div id="title">
            <div class="row" style="background-color: #aabbac">
                <b style="font-size:24px"><?php echo $news['title']; ?></b>
            </div>
            <div class="row" style="margin-top: 50px">
                <span>
            	    <img src="<?php echo getImage($news['sender_avatar'], "public/images/avatar", "path") ?>"
                         class="img-circle" style="max-height:100px">
                </span>
                <span style="font-size: 18px; margin-left: 20px; color: white"> <b> <?php echo $news['sender_name'] ?> </b> </span>
                <span style="margin-left: 500px; color: white;">Lượt xem : <?php echo $news['view'] ?></span>
            </div>
        </div>

        <hr size="2px">
        <!--phần nội dung-->
        <div style="margin: 50px 30px auto 30px">
            <?php echo $news['content'] ?>
        </div>

        <!-- bình luận -->
        <div id="commemt">
            <fieldset>
                <label style="font-size: 20px">Bình luận</label><br>
            <div>
                <form method="post" action="<?=createdURL(base_url(), array('c'=>'news', 'a'=>'addComment'))?>">
                    <textarea rows="4" id="txt-commemt" required cols="100" name="txt_comment" style="float: left"
                        <?php $user = isLogged(); if(!$user) echo "disabled placeholder='Hãy đăng nhập để bình luận'";
                        else echo "placeholder='Nhập nội dụng bình luận của bạn...'"?>
                    ></textarea>
                    <input type="hidden" name="sender_id" value="<?=$user['id']?>">
                    <input type="hidden" name="news_id" value="<?=$news['id']?>">
                    <input type="hidden" name="back" value="<?=$_SERVER['REQUEST_URI']?>">
                    <button id="btn-comment" type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>

            <div style="margin-top: 30px">
                <?php
                if(!empty($comment))
                {
                    foreach ($comment as $item)
                    {
                        ?>
                        <div class="row comment-item">
                            <span class="col-md-2">
                                <img src="<?=getImage($user['avatar'], "public/images/avatar", "path")?>"
                                                        style="max-width: 100px">
                            </span>
                            <div class="col-md-10">
                                <p><b style="color: blue;margin-right: 20px"><?=$item['sender_name']?></b><?=$item['date_created']?></p>
                                <p><?=$item['content']?></p>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    echo "<p style='color: grey'>Chưa có bình luận nào</p>";
                }
                ?>
            </div>
            </fieldset>
        </div>
    </div>

    <!--menu bên phải-->
    <div class="col-md-3">
        <div class="row">
            <label>Bài viết cùng chuyên mục</label>
            <ul class="list-group">
                <?php
                if(isset($news_same))
                {
                    foreach ($news_same as $item)
                    {
                        ?>
                        <li class="list-group-item" style="height: 120px">
                        <span><img style="height: 100px;float: left;width: 120px"
                                   src="<?php echo getImage($item['avatar'], "public/images", "path") ?>"></span>
                            <a href="<?php echo createdURL(base_url(), array('c' => 'news', 'id' => $item['id'])) ?>"
                               title="Nhấp vào để đến trang chi tiết">
                                <?php echo substr($item['summary'], 0, 100)."..." ?>
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="row">
            <label>Xem nhiều trong tuần</label>
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
                               title="Nhấp vào để đến trang chi tiết">
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
</div>
