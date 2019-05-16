<div class="box_content">
    <div class="tcat"><div class="icon"><?= $tintuc_detail[0]['ten'] ?></div><div class="tcat_right">&nbsp;</div></div>
    <div class="content nd">    
        <h1 class="title_news"><?= $tintuc_detail[0]['ten'] ?> </h1>
        <?= $tintuc_detail[0]['noidung'] ?>

        <div class="othernews">
            <h1><?= _cacbaivietkhac ?></h1>
            <ul>
                <?php foreach ($tintuc_khac as $tinkhac) { ?>
                    <li><a href="chia-se-kinh-nghiem/<?= $tinkhac['tenkhongdau'] ?>-<?= $tinkhac['id'] ?>.html" style="text-decoration:none;"><?= $tinkhac['ten'] ?></a> (<?= make_date($tinkhac['ngaytao']) ?>)</li>
                    <?php } ?>
            </ul>
        </div>
    </div>
</div>
