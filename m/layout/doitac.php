<?php
$d->reset();
$sql_doitac1 = "select ten_$lang as ten,tenkhongdau,id, photo,mota_$lang as mota from #_about where type='y-kien' and hienthi =1 and noibat>0 order by stt,id desc";
$d->query($sql_doitac1);
$result_doitac1 = $d->result_array();

?>
<div class="box_partner">
<div class="container">
	<div class="title"><?=_ykienkhachhang?></div>
	<div class="content">
		<div id="owl-demo-dt1">
			<?php foreach ($result_doitac1 as $v) { ?>
				<div class="item_doitac">
					<img src="<?=thumb($v["photo"],_upload_tintuc_l,$v["tenkhongdau"],110,110,1,80)?>" alt="<?=$v["ten"]?>" class="img-responsive" onerror="if (this.src != 'no-image.png') this.src = 'assets/images/no-image.png';" />
					<div class="name"><?=$v["ten"]?></div>
					<div class="desc"><img src="assets/images/icon_cmt.png" style="display: inline-block;" /><?=$v["mota"]?></div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
</div>