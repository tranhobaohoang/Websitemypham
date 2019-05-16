<?php
$d->reset();
$sql_dmsp = "select ten_vi as ten, yahoo, skype, dienthoai from #_yahoo where hienthi =1 order by stt,id desc";
$d->query($sql_dmsp);
$result_yahoo = $d->result_array();

$d->reset();
$sql_dmsp = "select ten_vi as ten, tenkhongdau, thumb, id from #_news where hienthi =1 order by ngaytao desc limit 0,5";
$d->query($sql_dmsp);
$result_new = $d->result_array();

$d->reset();
$sql_dmsp = "select ten_$lang as ten,tenkhongdau,id from #_product_list where hienthi =1 order by stt,id desc";
$d->query($sql_dmsp);
$result_dmsp = $d->result_array();

$d->query("select id, tenkhongdau, ten_$lang as ten, photo, thumb from #_product where hienthi=1 and noibat>0 limit 0,8");
$rs_sp_nb = $d->result_array();

$d->query("select id, tenkhongdau, ten_$lang as ten, photo, thumb from #_product where hienthi=1 and spkm>0 limit 0,8");
$rs_sp_km = $d->result_array();
?>
<div class="module_left" >
    <div class="title" ><h2><?=_tintuc?></h2></div>
    <div class="content" style="padding: 3px;"> 
        <ul class="list_news">
            <?php foreach ($result_new as $v) { ?>
                <li>
                    <div class="box-tin">
                        <div class="image">
                            <a href="tin-tuc/<?= $v['tenkhongdau'] ?>-<?= $v['id'] ?>.html">
                                <img src="<?= _upload_tintuc_l . $v['thumb'] ?>" alt="<?= $v['ten'] ?>" class="img-responsive" />
                            </a>
                        </div>
                        <a href="tin-tuc/<?= $v['tenkhongdau'] ?>-<?= $v['id'] ?>.html">
                            <?= $v['ten'] ?>
                        </a>
                        <div class="clear"></div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <div class="xemthem_new"><a href="chia-se-kinh-nghiem.html"><img style="margin-top:5px;" src="images/xemthemnew.jpg" alt="Xem thêm" > </a></div>
        <div class="clear"></div>
    </div>    	                                   
</div>
<div class="module_left">
    <div class="title"><h2><?=_sanphamnoibat?></h2></div>
    <div class="content"> 
        <ul class="list_news1">
            <?php foreach ($rs_sp_nb as $v) { ?>
                <li>
                    <div class="item_product_left">
                        <div class="images">
                            <a href="san-pham/<?= $v['tenkhongdau'] ?>-<?= $v['id'] ?>.html">
                                <img src="<?= _upload_product_l . $v['photo'] ?>" alt="<?= $v['ten'] ?>" >
                            </a>
                        </div>
						<div class="name">
                            <a href="san-pham/<?= $v['tenkhongdau'] ?>-<?= $v['id'] ?>.html">
                                <?= $v['ten'] ?>
                            </a>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>            	                                   
</div>


<div class="module_left">
	<div class="title" ><h2><?=_thongketruycap?></h2></div>
    <div class="content" style="padding: 10px;">
		
        <div class="ol"><?=_dangonline?> <span>:<?= $count_user_online ?></span></div>
		<div class="tuan"><?=_homnay?> <span>:<?= $today_visitors ?></span></div>
		<div class="thang"><?=_trongthang?> <span>:<?= $month_visitors ?></span></div>
		<div class="tong"><?=_tongtruycap?> <span>:<?= $all_visitors ?></span></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (e) {
        $('.list_news1').bxSlider({
            mode: 'vertical',
            slideMargin: 4,
            minSlides: 3,
            maxSlides: 1,
            moveSlides: 1,
            auto: true,
            autoStart: true,
            controls: false
        });

    });

</script>

