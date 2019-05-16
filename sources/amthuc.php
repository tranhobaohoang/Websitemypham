<?php

if (!defined('_source'))
    die("Error");
if (isset($_GET['id'])) {
    #tin tuc chi tiet
    $id = addslashes($_GET['id']);

    $sql_lanxem = "UPDATE #_".$table." SET luotxem=luotxem+1  WHERE id ='" . $id . "'";
    $d->query($sql_lanxem);

    $sql = "select ten_$lang as ten,mota_$lang as mota,noidung_$lang as noidung,ngaytao,title_$lang as title,keywords_$lang as keywords,description_$lang as description, photo, h1, h2, h3 from #_$table where hienthi=1 and id='" . $id . "'";
    $d->query($sql);
    $tintuc_detail = $d->result_array();
    $title_bar = $tintuc_detail[0]['ten'] . ' - ';
    $title_custom = $tintuc_detail[0]['title'];
    $keywords_custom = $tintuc_detail[0]['keywords'];
    $description_custom = $tintuc_detail[0]['description'];
	
	$h1_custom=$tintuc_detail[0]['h1'];
	$h2_custom=$tintuc_detail[0]['h2'];
	$h3_custom=$tintuc_detail[0]['h3'];
	
	// breakcrumb
	$breakcrumb="<li><a href='http://".$config_url."'>Trang chủ </a></li><li><a href='".$com."'>".$title_tcat." </a></li><li class='active'>".$tintuc_detail[0]["ten"];
	$title_tcat=$tintuc_detail[0]["ten"];
	//share
	if($tintuc_detail[0]["photo"]==''){
		$image_share='http://' . $config_url.'/' ._upload_hinhanh_l.$row_photo["logo"];
	}else{
		$image_share='http://' . $config_url .'/'. _upload_tintuc_l.$tintuc_detail[0]["photo"];
	}
	
	
    #các tin cu hon
    $sql_khac = "select ten_$lang as ten,tenkhongdau,ngaytao,id from #_$table where type='".$type."' and hienthi=1 and id <>'" . $id . "' order by stt,ngaytao desc limit 0,5";
    $d->query($sql_khac);
    $tintuc_khac = $d->result_array();
} else {
	$d->reset();
	$sql="select ten_$lang as ten, tenkhongdau, id , noidung_$lang as noidung, title_$lang as title, keywords_$lang as keywords, description_$lang as description from #_time where type='".$type."'";
	$d->query($sql);
	$rs_noidung=$d->fetch_array();
	if(!empty($rs_noidung)){
	$title_tcat = $rs_noidung['ten'];
	$title_bar = $rs_noidung['ten'] . ' - ';
    $title_custom = $rs_noidung['title'];
    $keywords_custom = $rs_noidung['keywords'];
    $description_custom = $rs_noidung['description'];
	}
    $sql_tintuc = "select ten_$lang as ten,tenkhongdau,mota_$lang as mota,thumb,id,ngaytao,luotxem,photo from #_$table where type='".$type."' and hienthi=1 order by stt,ngaytao desc";
    $d->query($sql_tintuc);
    $tintuc = $d->result_array();
	
	// breakcrumb
	$breakcrumb="<li><a href='http://".$config_url."'>Trang chủ </a></li><li class='active'>".$title_tcat;
	//share
	$image_share='http://' . $config_url.'/' ._upload_hinhanh_l.$row_photo["logo"];
	
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR = 10;
    $maxP = 5;
    $paging = paging_home($tintuc, $url, $curPage, $maxR, $maxP);
    $tintuc = $paging['source'];
}
?>