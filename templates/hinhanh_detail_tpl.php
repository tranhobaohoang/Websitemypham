<link rel="stylesheet" type="text/css" href="assets/js/lightslider/lightslider.css" media="screen" />
<script type="text/javascript" src="assets/js/lightslider/lightslider.js"></script>
<script>
	$(document).ready(function(){
		$('#image-gallery').lightSlider({
			gallery:true,
			item:1,
			thumbItem:5,
			slideMargin: 0,
			speed:500,
			auto:false,
			loop:true,
			onSliderLoad: function() {
				$('#image-gallery').removeClass('cS-hidden');
			}  
		});
	})
</script>
<div class="container_left">
	<?php include_once _template ."layout/left.php";?>
</div>
<div class="container_right">
	<div class="box_content">
		<div class="tcat">
			<div class="icon"><h2><?= $title_tcat ?><h2></div>
		</div>
		<div class="content">
			<ul id="image-gallery" class="gallery list-unstyled cS-hidden">
				<?php for ($i = 0; $i < count($result_image); $i++) { ?>
				<li data-thumb="<?=thumb($result_image[$i]["photo"],_upload_hinhanh_l,rand(6,9999),200,200,1,80)?>">
					<img src="<?=_upload_hinhanh_l.$result_image[$i]["photo"]?>" alt="<?=$result_image["ten"]?>"/>
				</li>
				<?php }?>
			</ul>
		</div>
	</div>
</div>
