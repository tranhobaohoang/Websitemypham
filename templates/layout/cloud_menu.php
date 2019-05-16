<link rel="stylesheet" type="text/css" href="assets/css/cloud_menu.css"/>

<div id="cloud_mmenu">
	<a id="humber_cloud" href="javascript:;"></a>
	<span class="mmm">Menu</span>
</div>

<div id="cloud_openmmenu">
	<div id="cloud_main">
		<div id="close_cloud"></div>
		<div class="scroll_menu_cloud">
			<div class="logo_cloud">Menu</div>
			<div class="menu-small-search" style="cursor:pointer;" data-toggle="modal" data-target="#myModal"><img src="assets/images/ic_search2.png"></div>
			<div class="linebrk_cloud"></div>
			<div class="main_manu_cloud">
				<ul>
					<li><a href="san-pham.html" <?php if($com=="san-pham") echo 'class="active"'; ?> title="Danh mục sản phẩm">Danh mục sản phẩm</a>
						<ul>
							<?php foreach($menu_cap1 as $v) { ?>
							<li><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>/"><?=$v['ten']?></a>
								<ul>
									<?php
									$d->reset();
									$sql="select ten_$lang as ten, tenkhongdau, id, type from #_product_list where type='san-pham' and hienthi=1 and id_parent=".$v['id']." order by stt, id desc";
									$d->query($sql);
									$menu_cap2=$d->result_array();
									if (!empty($menu_cap2)) {
										foreach ($menu_cap2 as $v2) { ?>
										<li><a href="<?=$v2['type']?>/<?=$v2['tenkhongdau']?>-<?=$v2['id']?>/"><?=$v2['ten']?></a></li>
										<?php } ?>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="khuyen-mai.html" <?php if($com=="khuyen-mai") echo 'class="active"'; ?> title="Khuyến mãi">Khuyến mãi</a>
						<ul>
							<?php foreach($km_cap1 as $v) { ?>
							<li><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>/"><?=$v['ten']?></a>
								<ul>
									<?php
									$d->reset();
									$sql="select ten_$lang as ten, tenkhongdau, id, type from #_product_list where type='khuyen-mai' and hienthi=1 and id_parent=".$v['id']." order by stt, id desc";
									$d->query($sql);
									$menu_cap2=$d->result_array();
									if (!empty($menu_cap2)) {
										foreach ($menu_cap2 as $v2) { ?>
										<li><a href="<?=$v2['type']?>/<?=$v2['tenkhongdau']?>-<?=$v2['id']?>/"><?=$v2['ten']?></a></li>
										<?php } ?>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="tin-tuc.html" <?php if($com=="tin-tuc") echo 'class="active"'; ?> title="Em đẹp">Em đẹp</a></li>
					<li><a href="tuyen-dung.html" <?php if($com=="tuyen-dung") echo 'class="active"'; ?> title="Tuyển dụng">Tuyển dụng</a></li>
					<li><a href="lien-he.html" <?php if($com=="lien-he") echo 'class="active"'; ?> title="Liên hệ"><?=_lienhe?></a></li>
					<li><a href="thong-tin-dai-ly.html" <?php if($com=="thong-tin-dai-ly") echo 'class="active"'; ?> title="Thông tin đại lý">Thông tin đại lý</a></li>
					<li><a href="gio-hang.html"><?=_giohang?> (<?=count($_SESSION['cart'])?>)</a></li>
					<li><a class="" href="thanh-toan.html">Thanh toán</a></li>
				</ul>
			</div>
			<div class="cloud_mmenuf" align="center">
				<img src="<?=_upload_hinhanh_l.$row_photo['logo']?>" alt="<?=$row_setting['ten_'.$lang]?>" class="img-responsive" style="margin:10px 0"/>
				<p>Địa chỉ: <?=$row_setting['diachi_vi']?></p>
				<p>Email: <?=$row_setting['email']?></p>
				<p>Điện thoại: <?=$row_setting['hotline']?></p>
			</div>
		</div>
	</div>
	<div class="mask_menu"></div>
</div>

<script>
	$(document).ready(function() {
		$('.main_manu_cloud ul li').each(function(index, el) {
			if($(this).children("ul").length) {
				$(this).prepend('<div class="btn_expand_menu_cloud"></div>');
			}
		});
	});
	$(document).on('click', '#humber_cloud', function(event) {
		event.preventDefault();
		$("#cloud_openmmenu").addClass('expand_menu');
	});
	$(document).on('click', '#close_cloud', function(event) {
		event.preventDefault();
		$("#cloud_openmmenu").removeClass('expand_menu');
	});
	$(document).on('click', '.btn_expand_menu_cloud', function(event) {
		event.preventDefault();
		if($(this).hasClass('more')) {
			$(this).removeClass('more');
			$(this).parent('li').children('a').removeClass('chk_more');
		}
		else {
			$(this).addClass('more');
			$(this).parent('li').children('a').addClass('chk_more');
		}
		$(this).parent('li').children('ul').slideToggle();
	});
</script>
