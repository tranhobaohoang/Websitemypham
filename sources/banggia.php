<?php

if (!defined('_source'))
    die("Error");
	$d->reset();
	$sql="select * from #_prices where hienthi=1 order by stt, id desc";
	$d->query($sql);
	$rs_prices= $d->result_array();
	
	$d->reset();
	$sql="select ten_$lang as ten, tenkhongdau, id , noidung_$lang as noidung, title_$lang as title, keywords_$lang as keywords, description_$lang as description from #_time where type='prices'";
	$d->query($sql);
	$rs_noidung=$d->fetch_array();
	
	$title_tcat = $rs_noidung['ten'];
	$title_bar = $rs_noidung['ten'] . ' - ';
    $title_custom = $rs_noidung['title'];
    $keywords_custom = $rs_noidung['keywords'];
    $description_custom = $rs_noidung['description'];
?>