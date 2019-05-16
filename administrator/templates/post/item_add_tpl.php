<?php
	$result = mysql_query("SELECT c.id,c.id_parents,l.ten FROM table_post_cat as c,table_post_cat_lang as l where  c.id = l.id_post_cat group by l.id_post_cat order by stt,id desc");
	$categoryData = array();
	while ($row = mysql_fetch_array($result)) {
		 $categoryData[$row['id_parents']][$row['id']] = $row['ten'];
	}
	mysql_free_result($result);

?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="default.php?com=post&act=mam"><span>bài viết</span></a></li>
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
<form name="supplier" id="validate" class="form" action="default.php?com=post&act=save&curPage=<?=$_REQUEST['curPage']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	

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
          <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
            <div class="formRow">
            <label>Danh mục bài viết</label>
            <div class="formRight">
                <div class="selector">
                    <select name="id_cat" id="id_cat">
                        <option value="0">Danh mục chính</option>
                        <?=getcat_edit_all(0,$item['id_cat'],$categoryData,'0');?>
                    </select>
                </div>
            </div>
            <div class="clear"></div>
        </div>
         
        <div class="formRow">
            <label>Hình ảnh đại diện: </label>
            <div class="formRight">
                                 <?php if ($_REQUEST['act']=='edit' && $item['thumb']!='' ) { ?>
                                  <img width="100" src="<?=_upload_post.$item['thumb']?>">
                    <a title="Xoá ảnh" href="default.php?com=post&act=delete_img&id=<?=@$item['id']?>">Xoá ảnh</a>
                    <br>
                    <?php }?>
                    
                                <input type="file" id="file" name="img" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình đại diện cho bài viết (ảnh JPEG, GIF , JPG , PNG)">
                               
            </div>
            <div class="clear"></div>
        </div>
 
           <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">
            <input type="checkbox" name="is_noindex" id="check2" <?=(!isset($item['is_noindex']) || $item['is_noindex']==1)?'checked="checked"':''?> />
            <label for="check2">Noindex, nofollow <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Check nếu bạn muốn Google không index bài viết này!" style="float:right; margin-top:0;" /></label>
            <input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của bài viết, chỉ nhập số">
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
       <!-- End info -->
        <?php foreach ($config['lang'] as $key => $value) {
            $item_lang = get_detail_lang($item['id'],$key);
        ?>

       <div id="content_lang_<?=$key?>" class="tab_content">        
            <div class="formRow">
            <label>Tên bài viết</label>
            <div class="formRight">
                <input type="text" name="name_<?=$key?>" title="Nhập tên bài viết" id="name_<?=$key?>" class="tipS" value="<?=@$item_lang['ten']?>" />
            </div>
            <div class="clear"></div>
        </div>  

        <div class="formRow">
            <label>Mô tả ngắn:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Viết mô tả ngắn bài viết" class="tipS" name="short_<?=$key?>" id="short_<?=$key?>"><?=@$item_lang['mota']?></textarea>
            </div>
            <div class="clear"></div>
        </div>  

            <div class="formRow">
            <label>Nội dung chính: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
            <div class="formRight"><textarea name="content_<?=$key?>" rows="8" cols="60"><?=@$item_lang['noidung']?></textarea>
<script type="text/javascript">//<![CDATA[
window.CKEDITOR_BASEPATH='ckeditor/';
//]]></script>
<script type="text/javascript" src="ckeditor/ckeditor.js?t=B5GJ5GG"></script>
<script type="text/javascript">//<![CDATA[
CKEDITOR.replace('content_<?=$key?>', {"width":890,"height":300});
//]]></script>
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
                <input type="text" value="<?=@$item_lang['keywords']?>" name="keyword_<?=$key?>" title="Từ khóa chính cho bài viết" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <label>Description:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS description_input" name="des_<?=$key?>"><?=@$item_lang['description']?></textarea>
                <input readonly="readonly" type="text" style="width:25px; margin-top:10px; text-align:center;" calss="number_desc" name="des_char_<?=$key?>" value="<?=@$item_lang['des_char']?>" /> ký tự <b>(Tốt nhất là 160 ký tự)</b>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <div class="formRight">
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>

       </div><!-- End content <?=$key?> -->
      
     <?php } ?>
 

    </div>




   
</form>   
<script>
  $(document).ready(function() {
    $('.file_input').filer({
            showThumbs: true,
            templates: {
                box: '<ul class="jFiler-item-list"></ul>',
                item: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" />\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" />\
                                </div>\
                            </div>\
                        </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: true,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-item-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action',
                }
            },
            addMore: true
        });
  });
</script>