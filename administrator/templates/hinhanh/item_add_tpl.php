<?php
	$set_level=$config['subcat'];
	$id_list=$_REQUEST["id_list"];
	if($set_level>0){
		function get_main_list(){
			global $rs_menu,$set_level,$d,$id_list;
			$d->reset();
			$sql="select * from #_hinhanh_list where com='1' and type='".$_REQUEST["type"]."' order by stt, id desc";
			$d->query($sql);
			$rs_menu=$d->result_array();
			
			$str.='<label>Danh mục album</label>
				<div class="formRight">
					<div class="selector">
						<select name="id_parent[]" class="form-control input level" data-level="1" id="level1" onchange="load_level($(this))" >';
				$str.="<option>Chọn danh mục cấp 1</option>";
				foreach($rs_menu as $v){
					$str.='<option value="'.$v["id"].'" ';
					if($v["id"]==$id_list) $str.='selected'; 
					$str.='>'.$v["ten_vi"].'</option>';
				}
			$str.='</select>
			</div></div>
			</br>';
			$str.='<div class="level_box" id="level2"></div>';
			
			return $str;
		}
	}
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        <li><a href="default.php?com=hinhanh&act=man"><span>album</span></a></li>
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
<form name="supplier" id="validate" class="form" action="default.php?com=hinhanh&act=save&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
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
			<input type="hidden" name="id" id="id_this_hinhanh" value="<?=@$item['id']?>" />
           
			<div class="formRow">
				<label>Hình ảnh đại diện: </label>
				<div class="formRight">
					<?php if ($_REQUEST['act']=='edit' && $item['photo']!='' ) { ?>
					<img width="100" src="<?=_upload_hinhanh.$item['photo']?>">
					<!--<a title="Xoá ảnh" href="default.php?com=hinhanh&act=delete_img&id=<?=@$item['id']?>">Xoá ảnh</a>-->
					<br>
					<?php }?>
					<input type="file" id="file" name="file" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình đại diện cho album (ảnh JPEG, GIF , JPG , PNG)">Width:430px & height: 245px
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Hình ảnh kèm theo: </label>
				<div class="formRight">
					<a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><i class="fa fa-paperclip"></i> Thêm ảnh</a>
					<?php if($act=='edit'){?>
						<?php if(count($ds_photo)!=0){?>       
							<?php for($i=0;$i<count($ds_photo);$i++){?>
							<div class="item_trich trich<?=$ds_photo[$i]['id']?>">
								<img class="img_trich" width="100px" height="80px" src="<?=_upload_hinhanh.$ds_photo[$i]['photo']?>" />
								<input type="text" id="stt_trich<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['stt']?>" onkeypress="return OnlyNumber(event)" class="tipS" onchange="return updateStthinh('hasp', '<?=$ds_photo[$i]['id']?>')" />
								<a href="javascript:void(0)" class="change_stt" rel="<?=$ds_photo[$i]['id']?>"><i class="fa fa-trash-o"></i></a>
								<div id="loader<?=$ds_photo[$i]['id']?>" class="loader_trich"><img src="images/loader.gif" /></div>
							</div>
							<?php }?>
						<?php }?>
					<?php }?>
				</div>
				<div class="clear"></div>
			</div> 
			<div class="formRow">
				<label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
				<div class="formRight">
					<input type="checkbox" name="noibat" id="check2" <?=(!isset($item['noibat']) || $item['noibat']==1)?'checked="checked"':''?> />
					<label for="check2">Nổi bật <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Check nếu bạn muốn album này hiển thị ngoài trang chủ!" style="float:right; margin-top:0;" /></label>
					<input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
					<label for="check1">Hiển thị</label>           
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Số thứ tự: </label>
				<div class="formRight">
					<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của album, chỉ nhập số">
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
				<label>Tên album</label>
				<div class="formRight">
					<input type="text" name="ten_<?=$key?>" title="Nhập tên album" id="ten_<?=$key?>" class="tipS" value="<?=@$item['ten_'.$key]?>" />
				</div>
				<div class="clear"></div>
			</div>  

			<div class="formRow">
				<label>Mô tả ngắn:</label>
				<div class="formRight">
					<textarea rows="8" cols="" title="Viết mô tả ngắn album" class="tipS" name="mota_<?=$key?>" id="mota_<?=$key?>"><?=@$item['mota_'.$key]?></textarea>
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
					<input type="text" value="<?=@$item['keywords_'.$key]?>" name="keywords_<?=$key?>" title="Từ khóa chính cho album" class="tipS" />
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
<script>
	function updateStthinh($act,$id){
		$val=$("#stt_trich"+$id).val();
		$.ajax({
			url:"ajax/ajax.php",
			type:"POST",
			data:{act: $act,id: $id,val: $val},
			success:function(data){
				if(data==1){
					alert("Cập nhật thành công");
				}else{
					alert("Cập nhật thất bại");
				}
				
			}
		})
	}
	$(document).ready(function() {
		$(".change_stt").click(function(){
			$id=$(this).attr("rel");
			if(confirm("Bạn có chắc chắn là muốn xóa ảnh này!")==true){
				$.ajax({
					url:"ajax/xuly_admin_dn.php",
					type:"POST",
					data:{act:"remove_image1", id:$id},
					success: function(data){
						$(".trich"+$id).fadeOut();
					}
				})
			}
		})
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
<script type="text/javascript">
	$(document).ready(function(){
		
		$('.remove_image').click(function(){
			var id=$(this).data("id");
			$.ajax({
				type: "POST",
				url: "ajax/xuly_admin_dn.php",
				data: {id:id, act: 'remove_image'},
				success:function(data){
					$jdata = $.parseJSON(data);					
					$("#"+$jdata.md5).fadeOut(500);
					setTimeout(function(){
						$("#"+$jdata.md5).remove();
					}, 1000)
				}
			})
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		load_level($(".level"));
		//load_option($(".level"));
		$(".level").change(function(){
			$id=$(this).val();
			if($id!=0){
			$.ajax({
				type:"POST",
				url:"ajax/ajax.php",
				data:{id:$id, act: "load_option_select",id_sp:"<?= ($_REQUEST["id"]!='') ? $_REQUEST["id"] : '0'?>"},
				success: function(data){
					$("#option").html(data);
					$(".option").click();
				}
			})
			}
		})
	})
	function load_level($obj){
		$level=$obj.data("level");
		$id=$obj.val();
		if($id!=0){
		$.ajax({
			type:"POST",
			url:"ajax/ajax.php",
			data:{max_level:<?=$config['subcat']?>,level:$level,id:$id, act: "load_level_sp", id_parent: "<?=$_REQUEST["id_parent"]?>",id_sp:"<?= ($_REQUEST["id"]!='') ? $_REQUEST["id"] : '0'?>"},
			success: function(data){
				
				$("#level"+($level+1)).html(data);
			}
		})
		}
	}
</script>