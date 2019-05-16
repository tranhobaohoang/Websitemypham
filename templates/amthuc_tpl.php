
<div class="box_content">
    <div class="tcat"><div class="icon"><?= $title_tcat ?></div><div class="tcat_right">&nbsp;</div></div>
    <div class="content">
		<div class="row">
			<div class="box_product">
				<?php foreach($tintuc as $k=>$v){?>
				<div class="col-md-3 col-sm-4 tablet col-xs-12">
					<div class="item_catogy">
							<div class="images">
								<a href="<?=$_GET["com"]?>/<?=$v["tenkhongdau"]?>-<?=$v["id"]?>.html">
								<img src="<?=thumb($v["photo"],_upload_tintuc_l,$v["tenkhongdau"],475,485,1,80)?>" alt="<?=$v["ten"]?>" class="img-responsive" />
								</a>
							</div>
							<div class="shop-html">
								<a href="<?=$_GET["com"]?>/<?=$v["tenkhongdau"]?>-<?=$v["id"]?>.html"><div class="name"><?=$v["ten"]?></div></a>
								<div class="cat"><?=catchuoi($v["mota"],100)?></div>
								
								<div class="btn btn_shopnow hidden">Shop now</div>
							</div>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
        <div class="clear"></div>
        <div class="pagination"><div class="phantrang" ><?= $paging['paging'] ?></div></div>
    </div> 
</div>

