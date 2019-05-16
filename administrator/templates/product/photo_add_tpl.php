<h3>Hinh ảnh</h3>
<?php
	if($_REQUEST["type1"]=="anhmenu"){?>
	<a href="media/images/huongdan1.png" class="fancybox" id="fixed">
		Xem hướng dẫn nhập hình
		<img src="media/images/huongdan1.png" class="img-responsive" />
	</a>
	<?php }else{
		echo "<a href='media/images/huongdan2.png' class='fancybox' id='fixed'>
		Xem hướng dẫn nhập hình
		<img src='media/images/huongdan2.png' class='img-responsive' />
	</a>";
	}
?>
<div style="clear: both; height: 20px;"></div>
<form name="frm" method="post" action="default.php?com=product&act=save_photo&idc=<?= $_REQUEST['idc'] ?>&type1=<?= $_REQUEST['type1'] ?>" enctype="multipart/form-data" class="nhaplieu">

    <?php for ($i = 0; $i < 5; $i++) { ?>

        <b>Hình ảnh <?= $i + 1 ?></b> <input type="file" name="file<?= $i ?>" /> <?= _hinhanh_type ?><br />	 
		<b>Vị trí:</b> <select class="form-control input" name="vitri<?=$i?>">
			<option value="0"> -- Chọn vị trí ảnh -- </option>
			<option value="1"> Vị trí 1 </option>
			<option value="2"> Vị trí 2 </option>
			<?php if($_REQUEST["type1"]=="anhmenu"){?>
			<option value="3"> Vị trí 3 </option>
			<?php }?>
		</select>
		<br />
		<b>Link: </b><input type="text" name="link<?= $i ?>" class="form-control input" />	<br />
        <b>Số thứ tự </b> <input type="text" name="stt<?= $i ?>" value="1" style="width:30px" />	<br />
        <b>Hiển thị</b> <input type="checkbox" name="hienthi<?= $i ?>" checked="checked" /> <br /><br />
	<div style="height: 1px; width: 100%; background: #000; margin: 10px 0px;"></div>
    <? }?>

    <input type="submit" value="Lưu" class="btn" />
    <input type="button" value="Thoát" onclick="javascript:window.location = 'default.php?com=product&idc=<?= $_REQUEST['idc'] ?>&act=man_photo&type1=<?= $_REQUEST['type1'] ?>'" class="btn" />
</form>