<?php
if (!defined('_source'))
    die("Error");
if (isset($_GET['id'])) {
    #tin tuc chi tiet
    $id = addslashes($_GET['id']);

    $sql_lanxem = "UPDATE #_about SET luotxem=luotxem+1  WHERE tenkhongdau ='" . $id . "'";
    $d->query($sql_lanxem);

    $sql = "select ten_$lang as ten,mota_$lang as mota,noidung_vi as noidung,ngaytao,title_$lang as title,keywords_$lang as keywords,description_$lang as description, photo, h1, h2, h3 from #_about where hienthi=1 and id='" . $id . "'";
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
	$breakcrumb="<a href='http://".$config_url."'>Trang chủ </a> <span> > </span>".$title_tcat;
	//share
	if($tintuc_detail[0]["photo"]==''){
		$image_share='http://' . $config_url ._upload_hinhanh_l.$row_photo["logo"];
	}else{
		$image_share='http://' . $config_url .'/'. _upload_tintuc_l.$tintuc_detail[0]["photo"];
	}
	
	
    #các tin cu hon
    $sql_khac = "select ten_$lang as ten,tenkhongdau,ngaytao,id from #_$table where type='".$type."' and hienthi=1 and id <>'" . $id . "' order by stt,ngaytao desc limit 0,5";
    $d->query($sql_khac);
    $tintuc_khac = $d->result_array();
} else {
    $sql_tintuc = "select ten_$lang as ten,tenkhongdau,mota_$lang as mota,thumb,id,ngaytao,luotxem,photo from #_$table where type='".$type."' and hienthi=1 order by stt,ngaytao desc";
    $d->query($sql_tintuc);
    $tintuc1 = $d->result_array();
	
	$sql_tintuc = "select ten_$lang as ten,tenkhongdau,mota_$lang as mota,thumb,id,ngaytao,luotxem,photo from #_$table where type='dich-vu1' and hienthi=1 order by stt,ngaytao desc";
    $d->query($sql_tintuc);
    $tintuc = $d->result_array();
	
	// breakcrumb
	$breakcrumb="<a href='http://".$config_url."'>Trang chủ </a> <span> > </span> ".$title_tcat;
	//share
	$image_share='http://' . $config_url ._upload_hinhanh_l.$row_photo["logo"];
	
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR = 10;
    $maxP = 5;
    $paging = paging_home($tintuc, $url, $curPage, $maxR, $maxP);
    $tintuc = $paging['source'];
}
?>