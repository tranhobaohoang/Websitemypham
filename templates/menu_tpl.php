<div class="tcat"><div class="icon"><?= $title_tcat ?></div></div>
<div class="box_content">
    <div class="container">
        <div class="content">
            <?php for ($i = 0, $count_spmoi = count($product); $i < $count_spmoi; $i++) { ?>
                <div class="col-md-3 col-sm-3 col-xs-3">     
                    <div class="item_product_menu">
                        <div class="name">
                            <a href="<?= $product[$i]['tenkhongdau'] ?>/">
                                <?= $product[$i]['ten'] ?>
                            </a>
                        </div>
                        <div class="images">
                            <a href="<?= $product[$i]['tenkhongdau'] ?>/" >
                                <img src="<?= _upload_product_l . $product[$i]['photo'] ?>" class="img-responsive" alt="<?= $product[$i]['ten'] ?>" />
                                <figcaption>
                                    <span>
                                        <?= $product[$i]['ten'] ?>
                                    </span>
                                </figcaption>
                            </a>      
                        </div>          
                    </div>
                </div>
            <?php } ?>        
            <div class="clear"></div>
            <div class="phantrang" ><?= $paging['paging'] ?></div>
        </div>
    </div>
</div>
<div class="box_content" style="background:#bebebe;">
    <div class="container content">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box-amthuc pull-right wow bounceInLeft" data-wow-duration="2s">
                <div class="amthuc-title">
                    <?php
                    $d->query("select ten_$lang as ten,photo, noidung_$lang as noidung from #_menu where id=7");
                    $nav1 = $d->fetch_array();
                    ?>
                    <a href="am-thuc-nhat-ban.html"><?= $nav1['ten'] ?></a>
                </div>
                <div class="clearfix"></div>
                <div class="amthuc">
                    <?= $nav1['noidung'] ?>
                </div>
                <div class="xemtiep">
                    <a href="am-thuc-nhat-ban.html"><?= _xemtiep ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">

            <div class="thumb_menu wow bounceInRight pull-left" data-wow-delay="0.5s" data-wow-duration="2s">
                <a href="am-thuc-nhat-ban.html"><img style="border: solid 10px #fff;" src="<?= _upload_product_l . $nav1['photo'] ?>" alt="menu" class="img-responsive" /></a>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>