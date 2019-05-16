<?php
	function countTin($dk){
		global $d;
		$d->reset();
		$sql="select id from #_product where username='".$_SESSION["login_web"]["username"]."' and type='tin-dang' and duyet='".$dk."'";
		$d->query($sql);
		$kq=$d->num_rows();
		return $kq;
	}
	$d->reset();
?>
<div class="module_left">
	<div class="title">Tài khoản cá nhân</div>
	<div class="content">
		<ul class="list_cat_product">
			<li class="" >Tên truy cập: <?=$rs_user["username"]?></li>
			<li class="" >Họ tên: <?=$rs_user["ten_vi"]?></li>
			<li class="" >Email: <?=$rs_user["email"]?></li>
			<li class="" ><a href="thong-tin-tai-khoan.html">Thông tin tài khoản</a></li>
			<li class="" ><a href="don-hang.html">Thống kê đơn hàng</a></li>
			<li class="" ><a href="doi-mat-khau.html">Thay đổi mật khẩu</a></li>
			<li class="" ><a href="thoat.html">Đăng xuất</a></li>
		</ul>
	</div>            	                                   
</div>