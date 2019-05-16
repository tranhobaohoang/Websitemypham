<h3>Hình ảnh</h3>

<form name="frm" method="post" action="default.php?com=doitac&act=save_photo&id=<?= $_REQUEST['id']; ?>&id_photo=<?= $_REQUEST['id_photo'] ?>" enctype="multipart/form-data" class="nhaplieu">

    <b>&nbsp;</b> 

    <img src="<?= _upload_hinhanh . $item['photo'] ?>" width="100" />

    <br />
    <b>Hình ảnh </b> <input type="file" name="file" /> <strong>Width:340px&nbsp; and height: 210px;-&nbsp;.jpg&nbsp;|&nbsp;.gif&nbsp;|&nbsp;png</strong><br />

    <br />
    <b>Tên: </b> <input type="text" name="ten_vi" value="<?= $item['ten_vi'] ?>" class="input" /><br />
    <b><strong style="color:#F00;">Thông tin SEO</strong></b><br/>
	<b>Title</b> <input type="text" name="title_vi" value="<?= $item['title_vi'] ?>" class="input" /><br /> 	 
	<b>Keywords </b>	    
	<div>    
		<textarea name="keywords_vi" cols="50" rows="5" id="keywords_vi" class="form-control input1"><?= @$item['keywords_vi'] ?></textarea>        
	</div>

	<b>Description</b>	    
	<div>    
		<textarea name="description_vi" cols="50" rows="5" id="description_vi" class="form-control input1"><?= @$item['description_vi'] ?></textarea>        
	</div>
    <b>Số thứ tự </b> <input type="text" name="stt" value="<?= $item['stt'] ?>" style="width:30px" />	<br />
    <b>Hiển thị</b> <input type="checkbox" name="hienthi" <?= $item['hienthi'] ? 'checked="checked"' : "" ?> /> <br /><br />

    <input type="hidden" name="id" value="<?= $item['id'] ?>" />
    <input type="submit" value="Lưu" class="btn" />
    <input type="button" value="Thoát" onclick="javascript:window.location = 'default.php?com=doitac&act=man_photo&id_photo=<?=$_REQUEST["id_photo"]?>'" class="btn" />
</form>