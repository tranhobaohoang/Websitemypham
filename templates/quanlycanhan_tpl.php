

<div class="breadcrumb-arrow"><?=$breakcrumb?></div>
<div class="spct-title"><h2><?= $title_tcat ?></h2></div>
<div class="spct-box">
	<div class="spct-trai">
		<div class="spct-td">Danh mục sản phẩm</div>
		<?php foreach ($menu_cap1 as $k=>$v) { ?>
			<div class="left-menu-cap-1 menu-click-<?=$k+1?>">
				<span></span><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>/"><?=$v['ten']?></a>
				<?php
				$d->reset();
				$sql="select ten_$lang as ten, tenkhongdau, id, type from #_product_list where type='san-pham' and hienthi=1 and id_parent=".$v['id']." order by stt, id desc";
				$d->query($sql);
				$menu_cap2=$d->result_array();
				if (!empty($menu_cap2)) {
					foreach ($menu_cap2 as $k2=>$v2) { ?>
						<div class="left-menu-cap-2 menu-open-<?=$k+1?> menu2-click-<?=$k+2?>">
							<span></span><a href="<?=$v2['type']?>/<?=$v2['tenkhongdau']?>-<?=$v2['id']?>/"><?=$v2['ten']?></a>
							<?php
							$d->reset();
							$sql="select ten_$lang as ten, tenkhongdau, id, type from #_product_list where type='san-pham' and hienthi=1 and id_parent=".$v2['id']." order by stt, id desc";
							$d->query($sql);
							$menu_cap3=$d->result_array();
							if (!empty($menu_cap3)) { 
								foreach ($menu_cap3 as $k3=>$v3) { ?>
								<div class="left-menu-cap-3 menu2-open-<?=$k+2?> menu3-click-<?=$k+3?>">
									<span></span><a href="<?=$v3['type']?>/<?=$v3['tenkhongdau']?>-<?=$v3['id']?>/"><?=$v3['ten']?></a>
								</div>
							<?php } } ?>
						</div>
				<?php } }?>
			</div>
			<script>
				$(".menu-click-<?=$k+1?> > span").click(function() {
				$(".menu-open-<?=$k+1?>").slideToggle();
				if(!$(this).hasClass("opened-menu")) {
					$(this).addClass("opened-menu");
				} else {
					$(this).removeClass("opened-menu");
				}
				});
				$(".menu2-click-<?=$k+2?> > span").click(function() {
					$(".menu2-open-<?=$k+2?>").slideToggle();
					if(!$(this).hasClass("opened-menu")) {
					$(this).addClass("opened-menu");
				} else {
					$(this).removeClass("opened-menu");
				}
				});
				if ($(".menu-click-<?=$k+1?>").find(".menu-open-<?=$k+1?>").length > 0) {
					$(".menu-click-<?=$k+1?>").addClass("dau-cong");
				} else {
					$(".menu-click-<?=$k+1?>").addClass("dau-list");
				}
				if ($(".menu2-click-<?=$k+2?>").find(".menu2-open-<?=$k+2?>").length > 0) {
					$(".menu2-click-<?=$k+2?>").addClass("dau-cong");
				} else {
					$(".menu2-click-<?=$k+2?>").addClass("dau-list");
				}
				if ($(".menu3-click-<?=$k+3?>").find(".menu3-open-<?=$k+3?>").length > 0) {
					$(".menu3-click-<?=$k+3?>").addClass("dau-cong");
				} else {
					$(".menu3-click-<?=$k+3?>").addClass("dau-list");
				}
			</script>
		<?php } ?>
	</div>
	<div class="spct-phai">
		<div class="don-hang-box">
			<div class="spct-title"><h2>Thông tin đơn hàng</h2></div>
			<?php if(!empty($_SESSION['login_web'])) { 
				$d->reset();
				$d->query("select * from #_donhang where id_dangnhap=".$_SESSION['login_web']['id']." order by id desc");
				$my_donhang = $d->fetch_array();
				if(!empty($my_donhang)) { ?>
					<table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:13px;" width="100%">
						<tr  style="font-weight:bold;color:#111;font-weight:bold">
							<th align="center" style="text-transform:uppercase;">Mã đơn hàng</th>
							<th align="center" style="text-transform:uppercase;">Họ Tên</th>
							<th align="center" style="text-transform:uppercase;">Email</th>
							<th align="center" style="text-transform:uppercase;">Ngày tạo</th>
							<th align="center" style="text-transform:uppercase;">Tên người nhận hàng</th>
						</tr>
						<tr id="<?=md5($pid)?>" <?php echo 'style="background:#fff;padding:4px 0"'; ?>>
							<td width="10%" align="center"><?=$my_donhang['madonhang']?></td>
							<td width="10%" align="center"><?=$my_donhang['hoten']?></td>
							<td width="10%" align="center"><?=$my_donhang['email']?></td>
							<td width="10%" align="center"><?=date("d/m/Y" ,$my_donhang['ngaytao'])?></td>
							<td width="10%" align="center"><?=$my_donhang['tennhan']?></td>
						</tr>
					</table>
					<?=$my_donhang['donhang']?>
				<?php } else { 
					echo "Chưa có thông tin mua hàng!!! Khi bạn đặt mua hàng thông tin sẽ được hiển thị tại đây.";
				} ?>
				<br><br>
				<a href="doi-mat-khau.html"><button style="margin-right:10px;" type="button" class="btn btn-danger">Đổi mật khẩu</button></a>
				<button type="button" class="btn btn-primary" onclick="logout()">Đăng xuất</button>
			<?php } else { 
				echo "Bạn chưa đăng nhập! Vui lòng đăng nhập để xem thông tin mua hàng của bạn.";
			} ?>
		</div>
	</div>
	<div class="clear"></div>
</div>