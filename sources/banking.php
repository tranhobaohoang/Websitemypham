<?php
	$d->reset();
	$sql_support="select * from #_donhang where id='".$_SESSION['iddonhang']."'";
	$d->query($sql_support);
	$donhang=$d->fetch_array();
	
	
?>
