<?php

if (!defined('_source'))
    die("Error");
if (isset($_GET['id'])) {
    #tin tuc chi tiet
    $id = addslashes($_GET['id']);

    $sql_lanxem = "UPDATE #_khuyenmai SET luotxem=luotxem+1  WHERE id ='" . $id . "'";
    $d->query($sql_lanxem);

    $sql = "select ten_$lang as ten,mota_$lang as mota,noidung_$lang as noidung,ngaytao,title_$lang as title,keywords_$lang as keywords,description_$lang as description from #_khuyenmai where hienthi=1 and id='" . $id . "'";
    $d->query($sql);
    $tintuc_detail = $d->result_array();
    $title_bar = $tintuc_detail[0]['ten'] . ' - ';
	$title_tcat = $tintuc_detail[0]['ten'];
    $title_custom = $tintuc_detail[0]['title'];
    $keywords_custom = $tintuc_detail[0]['keywords'];
    $description_custom = $tintuc_detail[0]['description'];
	
	// breakcrumb
	$breakcrumb="<a href='http://".$config_url."'>Trang chủ </a> <span> > </span> Giới thiệu";
    #các tin cu hon
    $sql_khac = "select ten_$lang as ten,tenkhongdau,ngaytao,id from #_about where hienthi=1 and id <'" . $id . "' order by stt,ngaytao desc limit 0,5";
    $d->query($sql_khac);
    $tintuc_khac = $d->result_array();
} else {

    $sql_tintuc = "select mota_$lang as mota,noidung_$lang as noidung,ngaytao,title_$lang as title,keywords_$lang as keywords,description_$lang as description, photo, h1,h2,h3 from #_time where type='".$type."'";
    $d->query($sql_tintuc);
    $tintuc_detail = $d->result_array();
    $title_custom = $tintuc_detail[0]['title'];
    $keywords_custom = $tintuc_detail[0]['keywords'];
    $description_custom = $tintuc_detail[0]['description'];
	
	$h1_custom=$tintuc_detail[0]['h1'];
	$h2_custom=$tintuc_detail[0]['h2'];
	$h3_custom=$tintuc_detail[0]['h3'];
	
	// breakcrumb
	$breakcrumb="<li><a href='http://".$config_url."'>Trang chủ </a></li><li class='active'>Giới thiệu</li>";
	//share
	$image_share='http://' . $config_url.'/' ._upload_hinhanh_l.$row_photo["logo"];
    
	
	if($com=="khuyen-mai"){
		$d->reset();
		$sql = "select ten_$lang as ten,id,tenkhongdau,thumb,photo,gia,giakm,rate, luot_rate, id_list, mota_$lang as mota, spkm, masp from #_product where spkm>0 and hienthi=1 order by stt, id desc";
		$d->query($sql);
		$product = $d->result_array();

		$tongsanpham = count($tintuc);
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url = getCurrentPageURL();
		$maxR = 16;
		$maxP = 5;
		$paging = paging_home($product, $url, $curPage, $maxR, $maxP);
		$product = $paging['source'];
	}
}
?>