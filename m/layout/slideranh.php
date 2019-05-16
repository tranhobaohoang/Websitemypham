<?php
$d->reset();
$sql_slider = "select ten,photo,link, mota from #_slider order by stt,id desc";
$d->query($sql_slider);
$result_slider = $d->result_array();

?>

<div id="center-container">
	<?php if($source=="index"){?>
	<div id="iview">
		<?php for ($i = 0; $i < count($result_slider); $i++) { ?> 
		<div data-iview:image="<?= _upload_hinhanh_l . $result_slider[$i]["photo"] ?>">
			<div class="iview-caption caption7" data-x="300" data-y="200" data-width="600" data-height="200" data-transition="wipeRight">
				<?php if ($result_slider[$i]['mota']!='') {?>
				<div class="slide-ten"><?=$result_slider[$i]["ten"]?></div>
				<?php } ?>
				<?php if ($result_slider[$i]['mota']!='') {?>
				<div class="slide-mota"><?=$result_slider[$i]["mota"]?></div>
				<?php } ?>
				<?php if ($result_slider[$i]['mota']!='') {?>
				<div class="slide-xemthem"><a href="<?=$result_slider[$i]["link"]?>">Mua ngay</a></div>
				<?php } ?>
			</div>
		</div>
		<?php }?>
	</div>
	<?php }?>
</div><!---end #center-container-->