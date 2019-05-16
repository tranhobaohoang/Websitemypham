<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
	
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        <li><a href="default.php?com=about&act=man&type=<?=$_REQUEST["type"]?>"><span>Bài viết</span></a></li>
        <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="default.php?com=about&act=save&type=<?=$_REQUEST["type"]?>&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nhập dữ liệu</h6>
        </div>
		<ul class="tabs">
           
			<li>
               <a href="#info">Thông tin chung</a>
			</li>
			<?php foreach ($config['lang'] as $key => $value) { ?>
			<li>
               <a href="#content_lang_<?=$key?>"><?=$value?></a>
			</li>
			<?php } ?>


		</ul>
		<div id="info" class="tab_content">
			<input type="hidden" name="id" id="id_this_about" value="<?=@$item['id']?>" />
			<div class="formRow">
				<label>Thẻ H1: </label>
				<div class="formRight">
					<input type="text" id="h1" name="h1" value="<?=@$item['h1']?>"  title="Nhập thẻ heading 1" class="tipS" />
				</div>
				<div class="clear"></div>
			</div> 
			<div class="formRow">
				<label>Thẻ H2: </label>
				<div class="formRight">
					<input type="text" id="h2" name="h2" value="<?=@$item['h2']?>"  title="Nhập thẻ heading 2" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Thẻ H3: </label>
				<div class="formRight">
					<input type="text" id="h3" name="h3" value="<?=@$item['h3']?>"  title="Nhập thẻ heading 3" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Hình ảnh đại diện: </label>
				<div class="formRight">
					<?php if ($_REQUEST['act']=='edit' && $item['photo']!='' ) { ?>
					<img width="100" src="<?=_upload_tintuc.$item['photo']?>">
					<!--<a title="Xoá ảnh" href="default.php?com=about&act=delete_img&id=<?=@$item['id']?>">Xoá ảnh</a>-->
					<br>
					<?php }?>
					<input type="file" id="file" name="file" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình đại diện cho bài viết (ảnh JPEG, GIF , JPG , PNG)">
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
				<div class="formRight">
					<input type="checkbox" name="noibat" id="check2" <?=(!isset($item['noibat']) || $item['noibat']==1)?'checked="checked"':''?> />
					<label for="check2">Nổi bật <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Check nếu bạn muốn tin này nổi bật!" style="float:right; margin-top:0;" /></label>
					<input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
					<label for="check1">Hiển thị</label>           
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Số thứ tự: </label>
				<div class="formRight">
					<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của bài viết, chỉ nhập số">
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
		<?php foreach ($config['lang'] as $key => $value) {?>

		<div id="content_lang_<?=$key?>" class="tab_content">        
            <div class="formRow">
				<label>Tên bài viết</label>
				<div class="formRight">
					<input type="text" name="ten_<?=$key?>" title="Nhập tên bài viết" id="ten_<?=$key?>" class="tipS" value="<?=@$item['ten_'.$key]?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Mô tả ngắn:</label>
				<div class="formRight">
					<textarea rows="8" cols="" title="Viết mô tả ngắn bài viết" class="tipS" name="mota_<?=$key?>" id="mota_<?=$key?>"><?=@$item['mota_'.$key]?></textarea>
				</div>
				<div class="clear"></div>
			</div>
            <div class="formRow">
				<label>Nội dung chính: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
				<div class="formRight">
					<textarea name="noidung_<?=$key?>" rows="8" cols="60" class="editor" id="noidung_<?=$key?>"><?=@$item['noidung_'.$key]?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Title</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['title_'.$key]?>" name="title_<?=$key?>" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
        
			<div class="formRow">
				<label>Từ khóa</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['keywords_'.$key]?>" name="keywords_<?=$key?>" title="Từ khóa chính cho bài viết" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
        
			<div class="formRow">
				<label>Description:</label>
				<div class="formRight">
					<textarea rows="8" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS description_input" name="description_<?=$key?>"><?=@$item['description_'.$key]?></textarea>(Tốt nhất là 160 ký tự)</b>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="formRight">
					
					<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
				</div>
				<div class="clear"></div>
			</div>

       </div><!-- End content <?=$key?> -->
      
     <?php } ?>
	</div>
</form>
