<?php

if (!defined('_source'))
    die("Error");
@$id = addslashes($_GET['id']);
if ($id != '') {
	$d->reset();
	$sql="select ten_vi, tenkhongdau, id from #_thuonghieu where id='".$id."'";
	$d->query($sql);
	$rs_price=$d->fetch_array();
	
	
	$title_bar = $rs_price["ten_vi"].' - ';
	$title_tcat = $rs_price["ten_vi"];
	//$where=' and type="'.$type.'"';
	// break crumb
	$breakcrumb='<li><a href="http://'.$config_url.'">Trang chủ</a></li><li class="active">Sản phẩm</li>';
	#share
	$image_share='http://' . $config_url .'/'._upload_hinhanh_l.$row_photo["logo"];
	
	$d->reset();
	$sql = "select ten_$lang as ten,id,tenkhongdau,thumb,photo,gia,giakm,rate, luot_rate from #_product where thuonghieu=".$rs_price["id"]." and hienthi=1 order by stt, id desc";
    $d->query($sql);
    $product = $d->result_array();

    $tongsanpham = count($tintuc);
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR = 12;
    $maxP = 5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
    $product = $paging['source'];
}
?>