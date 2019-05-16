<h3>Hinh ảnh</h3>

<form name="frm" method="post" action="default.php?com=product&act=save_photo&id=<?= $_REQUEST['id']; ?>&idc=<?= $_REQUEST['idc'] ?>&type1=<?= $_REQUEST['type1'] ?>" enctype="multipart/form-data" class="nhaplieu">

    <b>&nbsp;</b> <img src="<?= _upload_product . $item['photo'] ?>"  width="100" height="100"/><br />
    <b>Hình ảnh </b> <input type="file" name="file" /> <?= _hinhanh_type ?><br />	  
    <b>Vị trí:</b> <select class="form-control input" name="vitri">
		<option value="0"> -- Chọn vị trí ảnh -- </option>
		<option value="1" <?= $item['vitri']==1 ? 'selected="selected"' : "" ?> > Vị trí 1 </option>
		<option value="2" <?= $item['vitri']==2 ? 'selected="selected"' : "" ?>> Vị trí 2 </option>
		<?php if($_REQUEST["type1"]=="anhmenu"){?>
		<option value="3" <?= $item['vitri']==3 ? 'selected="selected"' : "" ?>> Vị trí 3 </option>
		<?php }?>
	</select>
	<br />
	<b>Link: </b><input type="text" name="link" value="<?=$item["link"]?>" class="form-control input" />	<br />
	<b>Số thứ tự </b> <input type="text" name="stt" value="<?= $item['stt'] ?>" style="width:30px" />	<br />
    <b>Hiển thị</b> <input type="checkbox" name="hienthi" <?= $item['hienthi'] ? 'checked="checked"' : "" ?> /> <br /><br />

    <input type="hidden" name="id" value="<?= $item['id'] ?>" />
    <input type="submit" value="Lưu" class="btn" />
    <input type="button" value="Thoát" onclick="javascript:window.location = 'default.php?com=product&act=man_photo&idc=<?= $_REQUEST['idc'] ?>&type1=<?= $_REQUEST['type1'] ?>'" class="btn" />
</form>