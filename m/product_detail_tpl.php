<div class="breadcrumb-arrow"><?=$breakcrumb?></div>
<div style="margin-top:30px;" class="spct-box">
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
		<div class="spct-qcao">
			<?php
			$d->reset();
			$sql="select * from #_quangcao order by stt";
			$d->query($sql);
			$spct_qcao=$d->result_array();
			foreach($spct_qcao as $v) {
				if($v['mota']==2) {
					echo "<a target='_blank' href=".$v['link']."><img src="._upload_hinhanh_l.$v['photo']." class='img-responsive img-100'></a>";
				}
			}
			?>
		</div>
		<?php
		$d->reset();
		$d->query("select id,thumb,ten_$lang as ten,photo,tenkhongdau,gia,masp,spbc,giakm,rate, luot_rate,noibat, luotxem, id_list, spkm, spbc,type from #_product where hienthi=1 and id !='" . $row_detail["id"] . "' and find_in_set('" . $row_detail['id_list'] . "',list_id)>0 and spbc=1 order by stt,ngaytao desc limit 0,2");
		$spct_moi = $d->result_array();
		foreach($spct_moi as $v) { ?>
		<div class="spct-moi">
			<div class="img-hover-box"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><img src="<?=thumb($v["photo"],_upload_product_l,$v["tenkhongdau"],273,228,2,80)?>" class="img-responsive img-100"></a></div>
			<div class="spkm-ten"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><?=$v['ten']?></a></div>
			<?php if ($v['giakm']>0) { ?>
				<div class="gia-bt"><span><?=number_format($v["gia"],"0",",",".")?> đ</span></div>
				<div class="gia-km"><span><?=number_format($v["giakm"],"0",",",".")?> đ</span></div>
			<?php } else { ?>
				<div class="gia-km"><span><?=number_format($v["gia"],"0",",",".")?> đ</span></div>
			<?php } ?>
			<div class="sp-nut-box">
				<div class="sp-mua nut-mua" data-id="<?=$v['id']?>">Mua ngay</div>
				<div class="sp-them nut-them" data-id="<?=$v['id']?>"></div>
			</div>
			<div class="clear"></div>
			<div class="spct-moi-box">Sản phẩm mới</div>
		</div>
		<?php } ?>
	</div>
	<div class="spct-phai">
		<div class="spct-box-con">
			<div class="spct-info-box">
				<div class="spct-info-trai">
					<div class="app-figure" id="zoom-fig">
						<a id="Zoom-1" class="MagicZoom" title="<?=$row_detail["ten"]?>" href="<?=thumb($row_detail["photo"],_upload_product_l,$row_detail["tenkhongdau"],583,583,1,80)?>"	>
							<img class="img-responsive img-100" src="<?=thumb($row_detail["photo"],_upload_product_l,$row_detail["tenkhongdau"],583,583,1,80)?>" alt="<?=$row_detail["ten"]?>">
						</a>
						<div class="selectors owl-spct">
							<div class="item_zoom">
								<a data-zoom-id="Zoom-1" href="<?= _upload_product_l.$row_detail['photo'] ?>" data-image="<?= _upload_product_l . $row_detail['photo'] ?>" >
								
									<img srcset="<?= _upload_product_l.$row_detail['photo'] ?>" alt="<?=$row_detail["ten"]?>" />
								</a>
							</div>
							<?php foreach ($row_hinhanhsp11 as $k => $v1) { ?>
							<div class="item_zoom">
								<a data-zoom-id="Zoom-1" href="<?= _upload_product_l.$v1['photo'] ?>" data-image="<?= _upload_product_l.$v1['photo'] ?>" >
									<img src="<?=thumb($v1["photo"],_upload_product_l,$v1["tenkhongdau"],125,125,1,80)?>" alt="<?=$v1["ten"]?>" class="img-responsive img-100">
								</a>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
				<div class="spct-info-phai">
					<div>Mã SP : <?=$row_detail['masp']?></div>
					<div class="spct-ten"><?=$row_detail['ten']?></div>
					<?php if ($row_detail['giakm']>0) { ?>
						<div class="gia-bt"><span><?=number_format($row_detail["gia"],"0",",",".")?> đ</span></div>
						<div class="gia-km"><span><?=number_format($row_detail["giakm"],"0",",",".")?> đ</span></div>
					<?php } else { ?>
						<div class="gia-km"><span><?=number_format($row_detail["gia"],"0",",",".")?> đ</span></div>
					<?php } ?>
					<div class="mar-top-10">Dung tích : <?=$row_detail['dung_tich']?></div>
					<div class="mar-top-10">Dòng sản phẩm : <?=$row_detail['dong_sp']?></div>
					<div class="mar-top-10">Thương hiệu : <?=$row_detail['thuong_hieu']?></div>
					<div class="mar-top-10">Nơi sản xuất : <?=$row_detail['noi_sx']?></div>
					<div class="spct-mota"><?=$row_detail['mota']?></div>
					<div class="spct-soluong">Số lượng</div>
					<div class="numbers-row">							
						<input type="text" name="french-hens" id="french-hens" value="1">
					</div>
					<div style="margin:20px 0;"></div>
					<div class="spct-btn spct-mua" data-id="<?=$row_detail['id']?>">Mua ngay</div>
					<div class="spct-btn spct-them" data-id="<?=$row_detail['id']?>">Thêm vào giỏ</div>
					<div class="spct-hot">Hotline hỗ trợ 24/7 <br> <span><?=$row_setting['hotline']?></span></div>
				</div>
			</div>
			<div class="spct-tt">Thông tin sản phẩm</div>
			<div style="margin-bottom:20px;"><?= $row_detail['noidung'] ?></div>
			<div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-width="100%" data-numposts="5"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="spct-qcao">
	<?php
	$d->reset();
	$sql="select * from #_quangcao order by stt";
	$d->query($sql);
	$spct_qcao=$d->result_array();
	foreach($spct_qcao as $v) {
		if($v['mota']==2) {
			echo "<a target='_blank' href=".$v['link']."><img src="._upload_hinhanh_l.$v['photo']." class='img-responsive img-100'></a>";
		}
	}
	?>
</div>
<div class="td-chung">Sản phẩm liên quan</div>
<div style="margin-bottom:80px" class="spkm-owl">
	<?php foreach ($sanpham_khac as $v) { ?>
	<div class="sp-box-con">
		<div class="img-hover-box"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><img src="<?=thumb($v["photo"],_upload_product_l,$v["tenkhongdau"],273,228,2,80)?>" class="img-responsive img-100"></a></div>
		<div class="spkm-ten"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><?=$v['ten']?></a></div>
		<?php if ($v['giakm']>0) { ?>
			<div class="gia-bt"><span><?=number_format($v["gia"],"0",",",".")?> đ</span></div>
			<div class="gia-km"><span><?=number_format($v["giakm"],"0",",",".")?> đ</span></div>
		<?php } else { ?>
			<div class="gia-km"><span><?=number_format($v["gia"],"0",",",".")?> đ</span></div>
		<?php } ?>
		<div class="sp-nut-box">
			<div class="sp-mua nut-mua" data-id="<?=$v['id']?>">Mua ngay</div>
			<div class="sp-them nut-them" data-id="<?=$v['id']?>"></div>
		</div>
		<div class="clear"></div>
	</div>
	<?php } ?>
</div>