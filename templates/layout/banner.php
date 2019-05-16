<?php
$d->query("select photo_$lang as photo, logo from #_photo where com='banner_top'");
$row_photo = $d->fetch_array();

$d->reset();
$sql="select * from #_icon where com='top' and hienthi=1 order by stt, id desc";
$d->query($sql);
$rs_icon=$d->result_array();

$d->reset();
$sql="select ten_$lang as ten, tenkhongdau, id, type from #_product_list where com=1 and type='san-pham' and hienthi=1 order by stt, id desc";
$d->query($sql);
$menu_cap1=$d->result_array();

$d->reset();
$sql="select ten_$lang as ten, tenkhongdau, id, type from #_product_list where com=1 and type='san-pham' and hienthi=1 order by stt, id desc limit 0,6";
$d->query($sql);
$menu_top1=$d->result_array();

$d->reset();
$sql="select ten_$lang as ten, tenkhongdau, id, type from #_product_list where com=1 and type='khuyen-mai' and hienthi=1 order by stt, id desc";
$d->query($sql);
$km_cap1=$d->result_array();
?>
<script type="text/javascript" src="assets/js/check_login.js"></script>

<div class="top_header">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="top-hot"><span>Hotline: <?=$row_setting['hotline']?></span></div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="top-mail"><span>Mail: <?=$row_setting['email']?></span></div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="free-ship"><span>freeship toàn quốc</span></div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<?php if(!empty($_SESSION['login_web'])) { ?>
				<a href="quan-ly-ca-nhan.html" class="top-dky"><?=$_SESSION['login_web']['username']?></a> | <span onclick="logout()" class="top-dnhap">Đăng xuất</span>
				<?php } else { ?>
				<a href="dang-ky.html" class="top-dky">Đăng ký</a> | <a href="dang-nhap.html" class="top-dnhap">Đăng nhập</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="mid-header">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-12 col-xs-12">
				<div class="logo_header">
					<a href="http://<?=$config_url?>" >
					<img src="<?=_upload_hinhanh_l.$row_photo['logo']?>" alt="<?=$row_setting['ten_'.$lang]?>" class="img-responsive" />
					</a>
				</div>
			</div>
			<div class="col-md-10 col-sm-12 col-xs-12">
				<nav id="cssmenu" class="wow fadeIn" data-wow-delay="0.7s">
					<?php include _template . "layout/menu_top.php"; ?>
				</nav>
			</div>
		</div>
		<div id="menu-dmsp">
			<div class="row">
			<?php if (!empty($menu_top1)) {
					foreach($menu_top1 as $v) { ?>
				<div class="col-md-2">
					<div class="menu-dmsp-head"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>/"><?=$v['ten']?></a></div>
					<?php
					$d->reset();
					$sql="select ten_$lang as ten, tenkhongdau, id, type from #_product_list where type='san-pham' and hienthi=1 and id_parent=".$v['id']." order by stt, id desc";
					$d->query($sql);
					$menu_cap2=$d->result_array();
					if (!empty($menu_cap2)) {
						foreach ($menu_cap2 as $v2) { ?>
						<div class="menu-dmsp-ele"><a href="<?=$v2['type']?>/<?=$v2['tenkhongdau']?>-<?=$v2['id']?>/"><?=$v2['ten']?></a></div>
						<?php } ?>
					<?php } ?>
				</div>
			<?php } } ?>
			</div>
		</div>
	</div>
</div>