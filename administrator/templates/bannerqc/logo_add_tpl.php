<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
	
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        <li><a href="default.php?com=bannerqc&act=capnhat"><span>Banner - logo</span></a></li>
        <li class="current"><a href="#" onclick="return false;">Cập nhật</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="default.php?com=bannerqc&act=save" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" id="id_this_product" value="<?=@$item['id']?>" />
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nhập dữ liệu</h6>
        </div>
		<div class="formRow">
			<label>Logo: </label>
			<div class="formRight">
				<?php if ($_REQUEST['act']=='capnhat' && $item['logo']!='' ) { ?>
				<img width="100" src="<?=_upload_hinhanh.$item['logo']?>">
				<!--<a title="Xoá ảnh" href="default.php?com=about&act=delete_img&id=<?=@$item['id']?>">Xoá ảnh</a>-->
				<br>
				<?php }?>
				<input type="file" id="file" name="file2" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải logo cho website (ảnh JPEG, GIF , JPG , PNG)">
			</div>
			<div class="clear"></div>
		</div>
		<?php foreach ($config['lang'] as $key => $value) { ?>
		<div class="formRow">
			<label>Banner (<?=$key?>): </label>
			<div class="formRight">
				<?php if ($_REQUEST['act']=='capnhat' && $item['photo_'.$key]!='' ) { ?>
				<img width="100" src="<?=_upload_hinhanh.$item['photo_'.$key]?>">
				<!--<a title="Xoá ảnh" href="default.php?com=about&act=delete_img&id=<?=@$item['id']?>">Xoá ảnh</a>-->
				<br>
				<?php }?>
				<input type="file" id="file<?=$key?>" name="file<?=$key?>" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải banner cho website (ảnh JPEG, GIF , JPG , PNG)">
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		<div class="formRow">
			<div class="formRight">
				
				<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>