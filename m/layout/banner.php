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
$sql="select ten_$lang as ten, tenkhongdau, id, type from #_product_list where com=1 and type='khuyen-mai' and hienthi=1 order by stt, id desc";
$d->query($sql);
$km_cap1=$d->result_array();
?>
<script type="text/javascript" src="assets/js/check_login.js"></script>

<div class="top_header">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="top-hot"><span>Hotline: <?=$row_setting['hotline']?></span></div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="top-mail"><span><?=$row_setting['email']?></span></div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="free-ship"><span>freeship toàn quốc</span></div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6">
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
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6">
				<div class="logo_header">
					<a href="http://<?=$config_url?>" >
					<img src="<?=_upload_hinhanh_l.$row_photo['logo']?>" alt="<?=$row_setting['ten_'.$lang]?>" class="img-responsive" />
					</a>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="mb-dis-inl"><?php include _template."layout/cloud_menu.php";?></div>
				<div class="mb-dis-inl"><a title="Thanh Toán" href="thanh-toan.html"><img src="assets/images/ic2.png"></a></div>
				<div class="mb-dis-inl"><a title="Giỏ Hàng" href="gio-hang.html"><img src="assets/images/ic3.png"> (<span id="cart-number"><?=get_total()?></span>)</a></div>
			</div>
		</div>
	</div>
</div>