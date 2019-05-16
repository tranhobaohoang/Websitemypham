<div class="logo"> <a href="#" target="_blank" onclick="return false;"> <img src="images/logo.jpg" width="150"  alt="" /> </a></div>
<div class="sidebarSep mt0"></div>
<!-- Left navigation -->
<ul id="menu" class="nav">
	<li class="dash" id="menu1"><a class=" active" title="" href="default.php"><span>Trang chủ</span></a></li>
	<li class="categories_li <?php if($_GET["com"]=='product' && $_GET["type"]=="san-pham") echo "activemenu";?>" id="menu_sp"><a href="" title="" class="exp"><span>Sản phẩm</span><strong></strong></a>
		<ul class="sub">
			<?php for($i=1;$i<=$config['subcat'];$i++){?>
			<li><a href="default.php?com=product&act=man_list&subcat=<?=$i?>&type=san-pham">Quản lý danh mục cấp <?=$i?></a></li>
			<?php }?>
			<li><a href="default.php?com=product&act=man&type=san-pham">Quản lý sản phẩm</a></li>
		</ul>
	</li>
	<li class="categories_li <?php if($_GET["com"]=='product' && $_GET["type"]=="khuyen-mai") echo "activemenu";?>" id="menu_km"><a href="" title="" class="exp"><span>Khuyến mãi</span><strong></strong></a>
		<ul class="sub">
			<?php for($i=1;$i<=$config['subcat'];$i++){?>
			<li><a href="default.php?com=product&act=man_list&subcat=<?=$i?>&type=khuyen-mai">Quản lý danh mục cấp <?=$i?></a></li>
			<?php }?>
			<li><a href="default.php?com=product&act=man&type=khuyen-mai">Quản lý Khuyến Mãi</a></li>
		</ul>
	</li>
	<li class="categories_li <?php if(($_GET["com"]=='about') ) echo "activemenu";?>" id="menu_td"><a href="" title="" class="exp"><span>Quản lý bài viết</span><strong></strong></a>
		<ul class="sub">
			<li><a href="default.php?com=about&act=man&type=tin-tuc">Tin tức</a></li>
			<li><a href="default.php?com=quangcao&act=man_photo">Banner Quảng cáo</a></li>
			<li><a href="default.php?com=about&act=man&type=y-kien">Ý Kiến</a></li>
			<li><a href="default.php?com=about&act=man&type=tuyen-dung">Tuyển dụng</a></li>
			<li><a href="default.php?com=about&act=man&type=chinh-sach">Chính sách</a></li>
			<li><a href="default.php?com=about&act=man&type=thanh-toan">Phương thức thanh toán</a></li>
			<li><a href="default.php?com=time&act=capnhat&type=gioi-thieu">Giới thiệu</a></li>
			<li><a href="default.php?com=time&act=capnhat&type=bao-mat">Bảo mật thông tin</a></li>
			<li><a href="default.php?com=time&act=capnhat&type=dieu-khoan">Điều khoản sử dụng</a></li>
			<li><a href="default.php?com=thanhvien&act=man">Quản lý Thành viên</a></li>
			<li><a href="default.php?com=order&act=man">Quản lý Đơn Hàng</a></li>
		</ul>
	</li>
	<li class="categories_li <?php if($_GET["com"]=='bannerqc' || $_GET["com"]=='quangcao' || $_GET["com"]=='slider' || $_GET["com"]=='doitac') echo "activemenu";?>" id="menu_sl"><a href="" title="" class="exp"><span>Hình ảnh - Slider</span><strong></strong></a>
		<ul class="sub">
			<li><a href="default.php?com=bannerqc&act=capnhat">Quản lý banner</a></li>
			<li><a href="default.php?com=slider&act=man_photo&type=slider">Quản lý slider</a></li>
		</ul>
	</li>
	<li class="categories_li <?php if($_GET["com"]=='dknhantin' || $_GET["com"]=='yahoo' ||$_GET["com"]=='lienhe' || $_GET["com"]=='footer' || $_GET["com"]=='video' || $_GET["com"]=='popub' || $_GET["com"]=='footer' || $_GET["com"]=='setting') echo "activemenu";?>" id="menu_tl"><a href="" title="" class="exp"><span>Thiết lập</span><strong></strong></a>
		<ul class="sub">
			<li><a href="default.php?com=icon&act=man&type=top">Quản lý MXH TRÁI</a></li>
			<li><a href="default.php?com=icon&act=man&type=footer">Quản lý MXH FOOTER</a></li>
			<li><a href="default.php?com=footer&act=capnhat">Quản lý footer</a></li>
			<li><a href="default.php?com=lienhe&act=capnhat">Quản lý liên hệ</a></li>
			<li><a href="default.php?com=setting&act=capnhat">Quản lý thiết lập</a></li>
		</ul>
	</li>
</ul>