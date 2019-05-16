<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="default.php?com=photo&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Hình ảnh slider</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm hình ảnh</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}	
</script>
<form name="supplier" id="validate" class="form" action="default.php?com=photo&act=save_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	
    <div class="widget">
         <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Thêm Hình Ảnh</h6>
        </div>
        
       <?php for($i=0; $i<1; $i++){?>
        
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
          <input type="hidden" name="id" id="id_this_product" value="<?=@$item['id']?>" />
          
          <div class="formRow">
            <label>Link liên kết:</label>
            <div class="formRight">
                <input type="text" id="code_pro" name="link<?=$i?>" value=""  title="Nhập link liên kết cho hình ảnh" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
		<div class="formRow">
			<label>Upload hình ảnh:</label>
			<div class="formRight">
            					<input type="file" id="file" name="img<?=$i?>" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">           
            <input type="checkbox" name="active<?=$i?>" id="check1" value="1" checked="checked" />
            <label for="check1">Hiển thị</label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="1" name="num<?=$i?>" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
                
        

       </div>
       
       <!-- End info -->
       
       
		<?php foreach ($config['lang'] as $key => $value) {
            $item_lang = get_detail_lang($item['id'],$key);
        ?>
        
        <div id="content_lang_<?=$key?>" class="tab_content">     
        
            <div class="formRow">   
            <label>Tên hình ảnh</label>
            <div class="formRight">
                <input type="text" name="name<?=$i?>_<?=$key?>" title="Nhập tên hình ảnh ( <?=$key?> )" id="name<?=$i?>_<?=$key?>" class="tipS validate[required]" value="" />
            </div>
            <div class="clear"></div>
            </div>
        
        </div><!-- End content <?=$key?> -->
        
        <?php } ?>

                
        
<?php } ?>

	<div class="formRow">
			<div class="formRight">
            	<input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>	
	</div>
   
	
</form>   