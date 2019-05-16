
<div class="box_content">
    <div class="tcat"><div class="icon"><?= $title_tcat ?></div><div class="tcat_right">&nbsp;</div></div>
    <div class="content">            
        <?php for ($i = 0; $i < count($tintuc); $i++) { ?>     
            <div class="box_news">
                <div class="image_boder"><a href="chia-se-kinh-nghiem/<?= $tintuc[$i]['tenkhongdau'] ?>-<?= $tintuc[$i]['id'] ?>.html"><img src="<?= _upload_tintuc_l . $tintuc[$i]['photo'] ?>" class="img-responsive" onerror="this.src='images/noimage.gif';"/></a></div>
                <h2> <a href="chia-se-kinh-nghiem/<?= $tintuc[$i]['tenkhongdau'] ?>-<?= $tintuc[$i]['id'] ?>.html"><?= $tintuc[$i]['ten'] ?></a></h2>
                <p><?= $tintuc[$i]['mota'] ?></p>

                <span class="readmore"> <a href="chia-se-kinh-nghiem/<?= $tintuc[$i]['tenkhongdau'] ?>-<?= $tintuc[$i]['id'] ?>.html"><?= readmore ?></a></span>
                <div class="clear"></div>             
            </div>        
        <?php } ?>
        <div class="clear"></div>
        <div class="phantrang" ><?= $paging['paging'] ?></div>
    </div> 
</div>
