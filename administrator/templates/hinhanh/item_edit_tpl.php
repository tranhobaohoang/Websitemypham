<h3>Quản lý hình ảnh</h3>
<form name="frm" method="post" action="default.php?com=img&act=save&curPage=<?=$_REQUEST['curPage']?>" enctype="multipart/form-data" class="nhaplieu">	     
	<?php if ($_REQUEST['act']==edit)
	{?>
	<b>Hình hiện tại:</b><img src="<?=_upload_hinhanh.$item['thumb']?>"  alt="NO PHOTO" /><br />
	<?php }?>
	<b>Hình ảnh:</b> <input type="file" name="file" /> <?=_product_type?><br />
    <br />
	<b>Tiêu đề</b> <input type="text" name="ten" value="<?=$item['ten']?>" class="input" /><br />   
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br>
	<b>Hiển thị tin</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br /><br />
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='default.php?com=img&act=man'" class="btn" />
</form>