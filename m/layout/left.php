<?php

$d->reset();
$sql="select ten_$lang as ten, tenkhongdau, id from #_product_list where com=1 and hienthi=1 order by stt, id desc";
$d->query($sql);
$rs_danhmuc=$d->result_array();

$d->reset();
$sql_dmsp = "select ten_$lang as ten, yahoo, skype, dienthoai from #_yahoo where hienthi =1 order by stt,id desc";
$d->query($sql_dmsp);
$result_yahoo = $d->result_array();
	
$d->reset();
$sql="select ten_$lang as ten, tenkhongdau, id , link, photo from #_video where hienthi=1 order by stt, id desc";
$d->query($sql);
$rs_video=$d->result_array();
?>
<div class="module_left">
    <div class="title"><span><?=_dichvuchungtoi?></span></div>
	<div class="content">
		<ul class="danhmuc">
			<?php foreach($rs_danhmuc as $v){?>
			<li <?php if($id_list==$v["id"]) echo "class='active';"?> ><a href="<?=$v["tenkhongdau"]?>-<?=$v["id"]?>/"><?=$v["ten"]?></a>
			</li>
			<?php }?>
		</ul>
	</div>
</div>
<div class="module_left hidden-sm hidden-xs">
	<div class="title"><span><?=_hotrotructuyen?></span></div>
	<div class="content">
		<div class="dienthoai">
			<span><?=$row_setting['hotline'] ?></span>
		</div>
		<?php foreach ($result_yahoo as $k => $v) { ?>
			<div class="box_hotro">
				<div class="left">
					<div class="yahoo">
						<img src="assets/images/zalo.png" alt="hỗ trợ zalo"/>
					</div>
					<div class="skype">
						<a href="Skype:<?= $v['skype'] ?>?chat"><img src="assets/images/skype.png" alt="hỗ trợ skype" /></a>
					</div>
					
				</div>
				<div class="right">
					<div class="name"><?= $v['ten'] ?></div>
					<div class="dt"><?= $v['dienthoai'] ?></div>
				
				</div>
				<div  class="clear"></div>
				
			</div>
		<?php } ?>
	</div>
</div>
<div class="module_left">
	<div class="title"><span>Fanpage facebook</span></div>
	<div class="content">
		<div class="fb-like-box" data-href="<?=$row_setting["facebook"]?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
	</div>          	                                   
</div>