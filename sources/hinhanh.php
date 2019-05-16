<?php

if (!defined('_source'))
    die("Error");

@$id = addslashes($_GET['id']);
if ($id != '') {
	$d->reset();
	$sql="select ten_$lang as ten, tenkhongdau, id, title_$lang as title,keywords_$lang as keywords,description_$lang as description from #_hinhanh where id='".$id." '";
	$d->query($sql);
	$rs_title=$d->fetch_array();
	
    $d->reset();
    $sql_detail = "select photo,thumb,ten_$lang as ten,tenkhongdau from #_hinhanh_hinhanh where  id_photo='" . $rs_title["id"] . "' and hienthi=1 order by stt, id desc";
    $d->query($sql_detail);
    $result_image = $d->result_array();

    $title_tcat = $rs_title['ten'] ;
	$title_bar = $rs_title['ten'] . ' - ';
    $title_custom = $rs_title['title'];
    $keywords_custom = $rs_title['keywords'];
    $description_custom = $rs_title['description'];
} else {

    $title_bar = 'Hình ảnh - ';
    $title_tcat = 'Hình ảnh';

    $d->reset();
    $sql_1 = "select ten_$lang as ten, id, tenkhongdau, photo, thumb from #_hinhanh where hienthi=1 order by stt,id desc";
    $d->query($sql_1);
    $result_image = $d->result_array();
	
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR = 20;
    $maxP = 2;
    $paging = paging_home($result_image, $url, $curPage, $maxR, $maxP);
    $result_image = $paging['source'];
}
?>