<?php
	session_start();	
	@define ( '_lib' , '../../libraries/');

	include_once _lib."config.php";
	include_once _lib."class.database.php";		
	$login_name = 'Gaconlonton';
	
	$d = new database($config['database']);
	
	$id=$_GET['id'];
	settype($id,'int');
	echo '<option value="0">Chọn tỉnh/thành </option>';
	$sql="select id,ten from #_place_province where id_country='$id' order by ten";
	$d->query($sql);
	$result=$d->result_array();
	for($i=0,$count=count($result);$i<$count;$i++) { 
		echo '<option value="'.$result[$i]['id'].'">'.$result[$i]['ten'].'</option>';
	}
?>