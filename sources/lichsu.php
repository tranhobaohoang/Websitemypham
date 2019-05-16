<?php  if(!defined('_source')) die("Error");
		
		$sql_lichsu = "select * from #_lichsu order by moclichsu asc";
		$d->query($sql_lichsu);
		$lichsu = $d->result_array();
		
		
		$title_bar = _lichsu." ";
		
?>