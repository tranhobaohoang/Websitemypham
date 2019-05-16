<?php 
	$d->reset();
	$sql="select ten_vi as ten, id from #_place_city where hienthi=1 order by id";
	$d->query($sql);
	$rs_province1=$d->result_array();
	
	$d->reset();
	$sql="select * from #_place_dist where id_city='".$rs_province1[0]["id"]."' order by stt, id";
	$d->query($sql);
	$rs_district=$d->result_array();
?>