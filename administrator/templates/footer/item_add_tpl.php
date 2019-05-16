<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
	
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        <li><a href="default.php?com=footer&act=capnhat"><span>Thông tin footer</span></a></li>
        <li class="current"><a href="#" onclick="return false;">Cập nhật</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="default.php?com=footer&act=save" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nhập dữ liệu</h6>
        </div>
		<ul class="tabs">
			<?php foreach ($config['lang'] as $key => $value) { ?>
			<li>
               <a href="#content_lang_<?=$key?>"><?=$value?></a>
			</li>
			<?php } ?>


		</ul>
		
		<?php foreach ($config['lang'] as $key => $value) {?>

		<div id="content_lang_<?=$key?>" class="tab_content">        
            
            <div class="formRow">
				<label>Nội dung chính: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
				<div class="formRight">
					<textarea name="noidung_<?=$key?>" rows="8" cols="60" class="editor" id="noidung_<?=$key?>"><?=@$item['noidung_'.$key]?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			 <div class="formRow">
				<label>Tài khoản: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
				<div class="formRight">
					<textarea name="chinhanh_<?=$key?>" rows="8" cols="60" class="editor" id="chinhanh_<?=$key?>"><?=@$item['chinhanh_'.$key]?></textarea>
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