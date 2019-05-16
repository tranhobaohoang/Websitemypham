<?php
	if (!defined('_source'))
    die("Error");

	@$id = addslashes($_GET['id']);
	if($_GET["com"]=="hang-moi-ve"){
		$where =' and spmoi=0';
	}else{
		$where =' and spkm=0';
	}
	// break crumb
	$breakcrumb='<a href="http://'.$config_url.'">Trang chủ</a> <span> > </span> Sản phẩm';
	
	$d->reset();
	$sql="select ten_$lang as ten,id,tenkhongdau,thumb,photo,gia,giakm from #_product where find_in_set('".$id."','list_id')>0 and hienthi=1 $where order by stt, id desc";
	$d->query($sql);
    $product = $d->result_array();

    $tongsanpham = count($tintuc);
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR = 12;
    $maxP = 5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
    $product = $paging['source'];
?>