<h3>Size</h3>

<form name="frm" method="post" action="default.php?com=product&act=save_size&idc=<?= $_REQUEST['idc'] ?>" enctype="multipart/form-data" class="nhaplieu">

    <b>Tên size </b> <input type="text" name="ten" value="<?= $item['ten'] ?>" class="form-control input" /><br /> 
	<b>Giá </b><input type="text" id="gia" name="gia" class="form-control input" value="<?= $item['gia'] ?>" /> <br />
	
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>" style="width:30px"><br />

    <b>Hiển thị</b> <input type="checkbox" name="hienthi" <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked="checked"' : '' ?>><br />
	<input type="hidden" name="id" id="id" value="<?= @$item['id'] ?>" />
    <input type="submit" value="Lưu" class="btn btn-succes" />
    <input type="button" value="Thoát" onclick="javascript:window.location = 'default.php?com=product&act=man_size'" class="btn btn-danger" />
</form>