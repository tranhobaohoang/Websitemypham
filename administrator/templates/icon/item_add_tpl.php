<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        <li><a href="default.php?com=icon&act=man&type=<?=$_REQUEST["type"]?>"><span>Icon MXH</span></a></li>
        <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}
	
</script>
<h3>Icons</h3>
<form name="supplier" id="validate" class="form" action="default.php?com=icon&act=save&type=<?=$_REQUEST["type"]?>&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nhập dữ liệu</h6>
        </div>
		<ul class="tabs">
           
			<li>
               <a href="#info">Thông tin chung</a>
			</li>
		</ul>
		<div id="info" class="tab_content">
			<input type="hidden" name="id" id="id_this_icon" value="<?=@$item['id']?>" />
            
			<div class="formRow">
				<label>Hình ảnh đại diện: </label>
				<div class="formRight">
					<?php if ($_REQUEST['act']=='edit' && $item['photo']!='' ) { ?>
					<img width="100" src="<?=_upload_icon.$item['photo']?>">
					<!--<a title="Xoá ảnh" href="default.php?com=icon&act=delete_img&id=<?=@$item['id']?>">Xoá ảnh</a>-->
					<br>
					<?php }?>
					<input type="file" id="file" name="file" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình đại diện cho icon (ảnh JPEG, GIF , JPG , PNG)">
				</div>
				<div class="clear"></div>
			</div>
			<?php foreach ($config['lang'] as $key => $value) {?>
			<div class="formRow">
				<label>Tên</label>
				<div class="formRight">
					<input type="text" name="ten_<?=$key?>" title="Nhập tên mxh" id="ten_<?=$key?>" class="tipS" value="<?=@$item['ten_'.$key]?>" />
				</div>
				<div class="clear"></div>
			</div> 
			<?php }?>
			<div class="formRow">
				<label>Link</label>
				<div class="formRight">
					<input type="text" name="url" title="Nhập link mxh" id="url" class="tipS" value="<?=@$item['url']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
				<div class="formRight">
					
					<input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
					<label for="check1">Hiển thị</label>           
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Số thứ tự: </label>
				<div class="formRight">
					<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của sản phẩm, chỉ nhập số">
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<div class="formRight">
					
					<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
				</div>
				<div class="clear"></div>
			</div>
		</div>
		
	</div>
</form>