<div class="box_content">
	<div class="tcat">
		<div class="icon"><h2><?= $title_tcat ?><h2></div>
	</div>
	<div class="clear"></div>
	<div class="content">
		<div class="content_index">
			<?php $s=0.5; if(!empty($result_image)){ foreach($result_image as $k=>$v){ if(($k)%4==0) $s=0.5;?>
			<div class="col-md-4 col-sm-4 tablet col-xs-12">
			<div class="item_index wow bounceInUp" data-wow-delay="<?=$s?>s">
				<div class="images zoom-img">
					<a href="<?=$com?>/<?=$v["tenkhongdau"]?>-<?=$v["id"]?>.html">
						<img src="<?=thumb($v["photo"],_upload_hinhanh_l,$v["tenkhongdau"],340,255,1,80)?>" alt="<?=$v["ten"]?>" class="img-responsive" onerror="if (this.src != 'no-image.png') this.src = 'assets/images/no-image.png';" />
					</a>
				</div>
				<div class="name name_photo">
					<a href="<?=$com?>/<?=$v["tenkhongdau"]?>-<?=$v["id"]?>.html">
						<?=$v["ten"]?>
					</a>
				</div>
			</div>
			</div>
			<?php $s=$s+0.1; }}?>
			
		</div>
		<div class="phantrang" ><?= $paging['paging'] ?></div>
	</div>
</div>

