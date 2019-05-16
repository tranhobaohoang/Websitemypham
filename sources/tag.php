<?php

if (!defined('_source'))
    die("Error");

@$idc = addslashes($_GET['slug']);

    $sql = "select ten_$lang as ten,id,tenkhongdau,thumb,photo,gia,giakm,rate, luot_rate, id_list from #_product where find_in_set('".$idc."',tag_slug_$lang)>0 and hienthi=1 order by stt";
    $d->query($sql);
    $product = $d->result_array();

    $tongsanpham = count($tintuc);
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR = 16;
    $maxP = 5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
    $product = $paging['source'];

?>