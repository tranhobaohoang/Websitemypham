<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="default.php?com=photo&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Hình ảnh slider</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Sửa hình ảnh</a></li>
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
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Sửa hình ảnh</h6>
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
			
        	        
        <div class="formRow">
            <label>Link liên kết: </label>
            <div class="formRight">
                <input type="text" id="price" name="link" value="<?=@$item['link']?>"  title="Nhập link liên kết cho hình ảnh" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>              
		<div class="formRow">
			<label>Upload hình ảnh:</label>
			<div class="formRight">
            					<input type="file" id="file" name="img" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
			</div>
			<div class="clear"></div>
         </div> 
          
        <div class="formRow">           
            <label>Hình ảnh hiện tại: </label>      
            <div class="formRight">          
            <img src="<?=_upload_hinhanh.$item['photo']?>"  alt="NO PHOTO" width="100" />
            
            <a title="Xoá ảnh" href="default.php?com=photo&act=delete_img&id=<?=@$item['id']?>">Xoá ảnh</a>
            <br />
            </div>
            
            <div class="clear"></div>
		</div>
        
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">           
            <input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>           
          </div>
          <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
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
                <input type="text" name="name_<?=$key?>" title="Nhập tên hình ảnh ( <?=$key?> )" id="name_<?=$key?>" class="tipS validate[required]" value="<?=@$item_lang['ten']?>" />
            </div>
            <div class="clear"></div>
            </div>
        
        
        </div><!-- End content <?=$key?> -->
        
        <?php } ?>

			
	<div class="formRow">
			<div class="formRight">
            <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="hidden" name="id" id="id_this_photo" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>     
		
	</div>
   
</form>   