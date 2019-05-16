
<ul>
	<li id="li-dmsp"><a href="san-pham.html" <?php if($com=="san-pham") echo 'class="active"'; ?> title="Danh mục sản phẩm">Danh mục sản phẩm <i class="fa fa-angle-down"></i></a></li>
	<li id="li-km"><a href="khuyen-mai.html" <?php if($com=="khuyen-mai") echo 'class="active"'; ?> title="Khuyến mãi">Khuyến mãi <i class="fa fa-angle-down"></i></a>
		<ul>
			<?php foreach($km_cap1 as $v) { ?>
			<li><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>/"><?=$v['ten']?></a></li>
			<?php } ?>
		</ul>
	</li>
	<li><a href="tin-tuc.html" <?php if($com=="tin-tuc") echo 'class="active"'; ?> title="Em đẹp">Em đẹp</a></li>
	<li><a href="tuyen-dung.html" <?php if($com=="tuyen-dung") echo 'class="active"'; ?> title="Tuyển dụng">Tuyển dụng</a></li>
	<li><a href="lien-he.html" <?php if($com=="lien-he") echo 'class="active"'; ?> title="Liên hệ"><?=_lienhe?></a></li>
	<li><a href="thong-tin-dai-ly.html" <?php if($com=="thong-tin-dai-ly") echo 'class="active"'; ?> title="Thông tin đại lý">Thông tin đại lý</a></li>
	<li style="cursor:pointer;" data-toggle="modal" data-target="#myModal"><img src="assets/images/ic_search.png"></li>
	<li class="li-thanhtoan"><a title="Thanh Toán" href="thanh-toan.html"><img src="assets/images/ic2.png"></a></li>
	<li class="li-giohang"><a title="Giỏ Hàng" href="gio-hang.html"><img src="assets/images/ic3.png"> (<span id="cart-number"><?=get_total()?></span>)</a></li>
</ul>

