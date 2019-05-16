<?php
	
	$d->reset();
	$sql="select noidung_$lang as noidung, chinhanh_$lang as chinhanh from #_footer";
	$d->query($sql);
	$footer=$d->fetch_array();
	
	$d->reset();
	$sql="select * from #_icon where com='footer' and hienthi=1 order by stt";
	$d->query($sql);
	$ft_mxh=$d->result_array();
	
	$d->reset();
	$sql="select * from #_icon where com='top' and hienthi=1 order by stt";
	$d->query($sql);
	$left_mxh=$d->result_array();
	
	$d->reset();
	$sql="select ten_$lang as ten, tenkhongdau, id, type from #_about where type='chinh-sach' and hienthi=1 and noibat=1 order by stt, id desc";
	$d->query($sql);
	$c_sach=$d->result_array();
?>
<div class="my-footer">
	<div class="container">
		<div class="row ft-line-height">
			<div class="col-md-6 col-sm-12 col-xs-12">
				<a href="http://<?=$config_url?>" >
					<img src="<?=_upload_hinhanh_l.$row_photo['logo']?>" alt="<?=$row_setting['ten_'.$lang]?>" class="img-responsive" />
				</a>
				<div class="ft-noidung"><?=$footer["noidung"]?></div>
			</div>
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="ft-hot">Hotline hỗ trợ 24/7 - <span><?=$row_setting['hotline']?></span></div>
			</div>
		</div>
		<div style="margin-top:20px;" class="row ft-line-height">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="ft-td">Về Napie Skin</div>
				<div><a href="about.html">Giới thiệu</a></div>
				<div><a href="lien-he.html">Liên hệ</a></div>
				<div><a href="bao-mat-thong-tin.html">Bảo mật thông tin</a></div>
				<div><a href="dieu-khoan-su-dung.html">Điều khoản sử dụng</a></div>
				<div id="ft-mxh-box">
					<?php foreach($ft_mxh as $v){?>
						<a href="<?=$v["url"]?>" target="_blank" rel="nofollow">
							<img src="<?=_upload_icon_l.$v["photo"]?>" alt="<?=$v["ten_vi"]?>"/>
						</a>
					<?php }?>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="ft-td">Hỗ trợ khách hàng</div>
				<?php foreach($c_sach as $v){ ?>
				<div><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><?=$v['ten']?></a></div>
				<?php } ?>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="ft-td">Thông tin liên hệ</div>
				<div class="ft-ten"><?=$row_setting['ten_vi']?></div>
				<div class="ft-dc"><?=$row_setting['diachi_vi']?></div>
				<div class="ft-dt"><?=$row_setting['hotline']?></div>
				<div class="ft-mail"><?=$row_setting['email']?></div>
				<div>MST : <?=$row_setting['mst']?></div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="bando-box">
					<div id="map_canvas"></div>
					<div class="fb-like-box" data-href="<?=$row_setting["facebook"]?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="mxh-trai">
	<?php foreach($left_mxh as $v){
		if ($v['id']==27) { ?>
			<a href="tel:<?=$row_setting['hotline']?>" rel="nofollow">
				<img src="<?=_upload_icon_l.$v["photo"]?>" alt="<?=$v["ten_vi"]?>" class="img-responsive">
			</a>
	<?php } else { ?>
			<a href="<?=$v["url"]?>" target="_blank" rel="nofollow">
				<img src="<?=_upload_icon_l.$v["photo"]?>" alt="<?=$v["ten_vi"]?>" class="img-responsive">
			</a>
	<?php } } ?>
</div>