<?php
$d->reset();
$sql="select ten_$lang as ten, tenkhongdau, id, photo, mota_$lang as mota from #_about where type='huong-dan' and hienthi=1 order by stt, id desc limit 0,3";
$d->query($sql);
$rs_hd=$d->result_array();

$d->reset();
$sql="select ten_$lang as ten, tenkhongdau, id, photo, mota_$lang as mota from #_time where type='ho-tro'";
$d->query($sql);
$rs_sp= $d->fetch_array();
?>
<div id="top_footer">
	<div class="container">
		<div class="title"><span>Thực phẩm hỗ trợ</span></div>
		<div class="tieude"><?=$rs_sp["ten"]?></div>
		<div class="content">
			<?=$rs_sp["mota"]?>
			<div class="xemthem"><a href="thuc-pham-ho-tro.html">Tìm hiểu thêm</a></div>
		</div>
		<div class="row">
			<?php foreach($rs_hd as $v){?>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<a href="huong-dan/<?=$v["tenkhongdau"]?>-<?=$v["id"]?>.html">
					<img src="<?=thumb($v["photo"],_upload_tintuc_l,$v["tenkhongdau"],370,160,1,80)?>" alt="<?=$v["ten"]?>" class="img-responsive" />
				</a>
			</div>
			<?php }?>
		</div>
	</div>
</div>