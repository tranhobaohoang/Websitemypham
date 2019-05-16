

<div class="breadcrumb-arrow"><?=$breakcrumb?></div>
<div class="spct-title"><h2><?= $title_tcat ?></h2></div>
<div class="spct-box">
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
	</div>
	<div class="spct-phai">
		<div class="content">
			<?=$tintuc_detail[0]["noidung"]?>
		</div>
	</div>
	<div class="clear"></div>
</div>