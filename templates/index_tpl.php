<div class="container">
	<div class="spkm-tab-box">
		<span class="spkm-tablink spkm-tablink-1 active">Sản phẩm khuyến mãi</span> | 
		<span class="spkm-tablink spkm-tablink-2">Sản phẩm mới</span>
	</div>
	<div class="spkm-tabcontent spkm-tabcontent-1 spkm-turn-on">
		<div class="spkm-owl">
			<?php foreach ($spkm as $v) { ?>
			<div class="box_product spkm-box-con">
				<div class="spkm-left">
					<div class="img-hover-box"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><img src="<?=thumb($v["photo"],_upload_product_l,$v["tenkhongdau"],287,245,2,80)?>" class="img-responsive img-100"></a></div>
				</div>
				<div class="spkm-left">
					<div class="spkm-ten"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><?=$v['ten']?></a></div>
					<?php if ($v['giakm']>0) { ?>
						<div class="spkm-gia-bt"><span><?=number_format($v["gia"],"0",",",".")?> đ</span></div>
						<div class="spkm-gia-km"><span><?=number_format($v["giakm"],"0",",",".")?> đ</span></div>
					<?php } else { ?>
						<div class="spkm-gia-km"><span><?=number_format($v["gia"],"0",",",".")?> đ</span></div>
					<?php } ?>
					<div class="sp-nut-box">
						<div class="sp-mua nut-mua" data-id="<?=$v['id']?>">Mua ngay</div>
						<div class="sp-them nut-them" data-id="<?=$v['id']?>"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="spkm-tabcontent spkm-tabcontent-2">
		<div class="spkm-owl">
			<?php foreach ($sp_moi as $v) { ?>
			<div class="box_product spkm-box-con">
				<div class="spkm-left">
					<div class="img-hover-box"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><img src="<?=thumb($v["photo"],_upload_product_l,$v["tenkhongdau"],287,245,2,80)?>" class="img-responsive img-100"></a></div>
				</div>
				<div class="spkm-left">
					<div class="spkm-ten"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><?=$v['ten']?></a></div>
					<?php if ($v['giakm']>0) { ?>
						<div class="spkm-gia-bt"><span><?=number_format($v["gia"],"0",",",".")?> đ</span></div>
						<div class="spkm-gia-km"><span><?=number_format($v["giakm"],"0",",",".")?> đ</span></div>
					<?php } else { ?>
						<div class="spkm-gia-km"><span><?=number_format($v["gia"],"0",",",".")?> đ</span></div>
					<?php } ?>
					<div class="sp-nut-box">
						<div class="sp-mua nut-mua" data-id="<?=$v['id']?>">Mua ngay</div>
						<div class="sp-them nut-them" data-id="<?=$v['id']?>"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

<div class="quang-cao">
	<div class="container">
		<div class="qcao-box">
			<div>
				<a target="_blank" href="<?=$q_cao[0]["link"]?>"><img src="<?=thumb($q_cao[0]["photo"],_upload_hinhanh_l,"quang-cao-1",780,241,1,80)?>" class="img-responsive"></a>
			</div>
			<div>
				<a target="_blank" href="<?=$q_cao[1]["link"]?>"><img src="<?=thumb($q_cao[1]["photo"],_upload_hinhanh_l,"quang-cao-1",351,241,1,80)?>" class="img-responsive"></a>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<?php foreach($sp_list as $k=>$v) { ?>
		<div class="sp-box-chung">
			<div class="sp-head-box"><div class="sp-td"><?=$v['ten']?></div></div>
			<div class="sp-box sp-tabbox-unique-<?=$k?>">
				<div class="sp-trai">
					<?php
					$d->reset();
					$sql="select ten_$lang as ten, tenkhongdau, id from #_product_list where id_parent=".$v['id']." and hienthi=1 order by stt, id desc";
					$d->query($sql);
					$sp_list2=$d->result_array();
					foreach($sp_list2 as $k2=>$v2) { ?>
						<div class="sp-tablink sp-tablink-<?=$v2['id']?>"><?=$v2['ten']?></div>
					<?php } ?>
					<div class="xem-tat-ca"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>/">Xem tất cả >></a></div>
				</div>
				<div class="sp-phai">
					<?php foreach($sp_list2 as $k2=>$v2) { 
					$d->reset();
					$d->query("select id, ten_$lang as ten, tenkhongdau, photo, mota_$lang as mota, gia, giakm, spkm, masp, spbc, type from #_product where type='san-pham' and hienthi=1 and id_item=".$v2['id']." order by stt, id desc");
					$sp_con=$d->result_array(); ?>
						<?php if (!empty($sp_con)) { ?>
						<div class="sp-tabcontent sp-tabcontent-<?=$v2['id']?>">
							<div class="sp-owl">
							<?php for ($i=0;$i<count($sp_con);$i+=2) { ?>
								<div>
									<div class="sp-box-con">
										<div class="img-hover-box"><a href="<?=$sp_con[$i]['type']?>/<?=$sp_con[$i]['tenkhongdau']?>-<?=$sp_con[$i]['id']?>.html"><img src="<?=thumb($sp_con[$i]["photo"],_upload_product_l,$sp_con[$i]["tenkhongdau"],273,228,2,80)?>" class="img-responsive img-100"></a></div>
										<div class="spkm-ten"><a href="<?=$sp_con[$i]['type']?>/<?=$sp_con[$i]['tenkhongdau']?>-<?=$sp_con[$i]['id']?>.html"><?=$sp_con[$i]['ten']?></a></div>
										<?php if ($sp_con[$i]['giakm']>0) { ?>
											<div class="gia-bt"><span><?=number_format($sp_con[$i]["gia"],"0",",",".")?> đ</span></div>
											<div class="gia-km"><span><?=number_format($sp_con[$i]["giakm"],"0",",",".")?> đ</span></div>
										<?php } else { ?>
											<div class="gia-km"><span><?=number_format($sp_con[$i]["gia"],"0",",",".")?> đ</span></div>
										<?php } ?>
										<div class="sp-nut-box">
											<div class="sp-mua nut-mua" data-id="<?=$sp_con[$i]['id']?>">Mua ngay</div>
											<div class="sp-them nut-them" data-id="<?=$sp_con[$i]['id']?>"></div>
										</div>
										<div class="clear"></div>
									</div>
									<div class="sp-box-con">
										<div class="img-hover-box"><a href="<?=$sp_con[$i+1]['type']?>/<?=$sp_con[$i+1]['tenkhongdau']?>-<?=$sp_con[$i+1]['id']?>.html"><img src="<?=thumb($sp_con[$i+1]["photo"],_upload_product_l,$sp_con[$i+1]["tenkhongdau"],273,228,2,80)?>" class="img-responsive img-100"></a></div>
										<div class="spkm-ten"><a href="<?=$sp_con[$i+1]['type']?>/<?=$sp_con[$i+1]['tenkhongdau']?>-<?=$sp_con[$i+1]['id']?>.html"><?=$sp_con[$i+1]['ten']?></a></div>
										<?php if ($sp_con[$i+1]['giakm']>0) { ?>
											<div class="gia-bt"><span><?=number_format($sp_con[$i+1]["gia"],"0",",",".")?> đ</span></div>
											<div class="gia-km"><span><?=number_format($sp_con[$i+1]["giakm"],"0",",",".")?> đ</span></div>
										<?php } else { ?>
											<div class="gia-km"><span><?=number_format($sp_con[$i+1]["gia"],"0",",",".")?> đ</span></div>
										<?php } ?>
										<div class="sp-nut-box">
											<div class="sp-mua nut-mua" data-id="<?=$sp_con[$i+1]['id']?>">Mua ngay</div>
											<div class="sp-them nut-them" data-id="<?=$sp_con[$i+1]['id']?>"></div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							<?php } ?>
							</div>
						</div>
						<?php } ?>
					<?php } ?>

				</div>
			</div>
		</div>
		<script>
		$(document).ready(function() {
		<?php foreach($sp_list2 as $k2=>$v2) { ?>
			$(".sp-tablink-<?=$v2['id']?>").click(function() {
				$(".sp-tabbox-unique-<?=$k?> .sp-tabcontent").removeClass("spkm-turn-on");
				$(".sp-tabcontent-<?=$v2['id']?>").addClass("spkm-turn-on");
				$(".sp-tabbox-unique-<?=$k?> .sp-tablink").removeClass("active");
				$(this).addClass("active");
			});
		<?php } ?>
		});
		</script>
	<?php } ?>
</div>

<div class="tin-tuc">
	<div class="td-chung">Em đẹp</div>
	<div class="container">
		<div class="owl-tintuc">
			<?php foreach($t_tuc as $k=>$v){ ?>
			<div class="tt-box">
				<div class="img-hover-box"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><img src="<?=thumb($v["photo"],_upload_tintuc_l,$v["tenkhongdau"],256,150,1,80)?>" class="img-responsive img-100"></a></div>
				<div class="tt-mota-box">
					<div class="tt-ngay"><span><?=date("d",$v["ngaytao"])?> Tháng <?=date("m",$v["ngaytao"])?>, <?=date("Y",$v["ngaytao"])?></span></div>
					<div class="tt-ten"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><?=$v['ten']?></a></div>
					<div class="xem-them"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html">Xem thêm</a></div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

<div class="y-kien">
	<div class="td-chung">Chia sẻ từ khách hàng</div>
	<div class="y-kien-box">
		<div class="owl-ykien">
			<?php foreach($y_kien as $k=>$v){ ?>
			<div class="yk-box-con">
				<div class="yk-mota"><?=$v['noidung']?></div>
				<div class="yk-hinh"><img src="<?=thumb($v["photo"],_upload_tintuc_l,$v["tenkhongdau"],150,150,1,80)?>" class="img-responsive"></div>
				<div class="yk-ten"><?=$v['ten']?></div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

