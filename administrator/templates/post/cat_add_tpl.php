<?php
	$result = mysql_query("SELECT c.id,c.id_parents,l.ten FROM table_post_cat as c,table_post_cat_lang as l where  c.id = l.id_post_cat and type='".@$_REQUEST['type']."' group by l.id_post_cat order by stt,id desc");
	$categoryData = array();
	while ($row = mysql_fetch_array($result)) {
		 $categoryData[$row['id_parents']][$row['id']] = $row['ten'];
	}
	mysql_free_result($result);
?>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="default.php?com=post&act=man_cat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Danh mục bài viết</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="default.php?com=post&act=save_cat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
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
        <div class="formRow">
			<label>Danh mục cha</label>
			<div class="formRight">
            	<div class="selector">
					<select name="id_cat" id="id_cat">
                        <option value="0">Danh mục chính</option>
                        <?=getcat_edit($item['id'],$item['id_parents'],$categoryData,'0');?>
                    </select>
                </div>
			</div>
			<div class="clear"></div>
		</div>
		
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">
            <input type="checkbox" name="is_noindex" id="check2"  <?=(!isset($item['is_noindex']) || $item['is_noindex']==1)?'checked="checked"':''?>/>
            <label for="check2">Noindex, nofollow <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Check nếu bạn muốn Google không index danh mục này!" style="float:right; margin-top:0;" /></label>
            <input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>            
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
	</div>

		<?php foreach ($config['lang'] as $key => $value) {
            $item_lang = get_detail_cat_lang($item['id'],$key);
        ?>
			
				
 			<div id="content_lang_<?=$key?>" class="tab_content">        
            <div class="formRow">
            <label>Tên danh mục</label>
            <div class="formRight">
                <input type="text" name="name_<?=$key?>" title="Nhập tên danh mục" id="name_<?=$key?>" class="tipS" value="<?=@$item_lang['ten']?>" />
            </div>
            <div class="clear"></div>
        </div>  

			 <div class="formRow">
            <label>Mô tả ngắn:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Viết mô tả ngắn danh mục sản phẩm" class="tipS" name="short_<?=$key?>" id="short_<?=$key?>"><?=@$item_lang['mota']?></textarea>
            </div>
            <div class="clear"></div>
        </div> 


         <div class="formRow">
            <label>Title</label>
            <div class="formRight">
                <input type="text" value="<?=@$item_lang['title']?>" name="title_<?=$key?>" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <label>Từ khóa</label>
            <div class="formRight">
                <input type="text" value="<?=@$item_lang['keywords']?>" name="keyword_<?=$key?>" title="Từ khóa chính cho danh mục sản phẩm" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <label>Description:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS description_input" rel='<?=$key?>' name="des_<?=$key?>"><?=@$item_lang['description']?></textarea>
                <input readonly="readonly" type="text" style="width:25px; margin-top:10px; text-align:center;" id="number_desc_<?=$key?>" name="des_char_<?=$key?>" value="<?=@$item_lang['des_char']?>" /> ký tự <b>(Tốt nhất là 160 ký tự)</b>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <div class="formRight">
                 <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>


			 </div>
		<?php } ?>
		
	</div>
</form>