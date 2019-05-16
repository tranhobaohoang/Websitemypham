<div class="box_content inner">
	<div class="tcat"><div class="icon"><h1><?= $tintuc_detail[0]['ten'] ?></h1></div></div>
	<div class="content nd">    
		<h2 class="title_news"><?= $tintuc_detail[0]['ten'] ?> </h2>
		<?= $tintuc_detail[0]['noidung'] ?>
		<div class="clear" style="height:20px;"></div>
		<div class="post-share" style="margin-top:10px;">
			<div class="addthis_sharing_toolbox"></div>
		</div>
		<div class="clear" style="height:20px;"></div>
		<div class="othernews">
			<div><?= _cacbaivietkhac ?></div>
			<ul>
				<?php foreach ($tintuc_khac as $tinkhac) { ?>
					<li><a href="<?=$_GET["com"]?>/<?= $tinkhac['tenkhongdau'] ?>-<?= $tinkhac['id'] ?>.html" style="text-decoration:none;"><?= $tinkhac['ten'] ?></a> (<?= make_date($tinkhac['ngaytao']) ?>)</li>
					<?php } ?>
			</ul>
		</div>
	</div>
</div>
