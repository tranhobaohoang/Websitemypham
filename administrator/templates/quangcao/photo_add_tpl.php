<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
	
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        <li><a href="default.php?com=quangcao&act=man_photo"><span>Hình ảnh</span></a></li>
        <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="default.php?com=quangcao&act=save_photo" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nhập dữ liệu</h6>
        </div>
		<?php for ($i = 0; $i < 1; $i++) { ?>
		<div class="formRow">
			<label>Hình ảnh: </label>
			<div class="formRight">
				<?php if ($_REQUEST['act']=='edit_photo' && $item['photo']!='' ) { ?>
				<img width="100" src="<?=_upload_hinhanh.$item['photo']?>">
				<!--<a title="Xoá ảnh" href="default.php?com=product&act=delete_img&id=<?=@$item['id']?>">Xoá ảnh</a>-->
				<br>
				<?php }?>
				<input type="file" id="file<?=$i?>" name="file<?=$i?>" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Vị trí: </label>
			<div class="formRight">
				<div class="selector">
					<select class="form-control input" name="mota<?=$i?>">
						<option value="1">Bên trái</option>
						<option value="2">Bên phải</option>
					</select><br />
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Link: </label>
			<div class="formRight">
				<input type="text" id="link<?=$i?>" name="link<?=$i?>" value="<?=@$item['link']?>"  title="Nhập thẻ heading 1" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
			<div class="formRight">
				<input type="checkbox" name="hienthi<?=$i?>" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
				<label for="check1">Hiển thị</label>           
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Số thứ tự: </label>
			<div class="formRight">
				<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt<?=$i?>" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh">
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>
		<div class="formRow">
			<div class="formRight">
				
				<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>