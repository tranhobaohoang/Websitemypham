<?php

if (!defined('_source'))
    die("Error");

$title_tcat = _video;
$title_bar .= _video . " - ";

$sql_noibat = "select ten_$lang as ten,photo,link,id from #_video where hienthi=1 and noibat=1  order by stt,ngaytao desc limit 0,1";
$d->query($sql_noibat);
$noibat = $d->fetch_array();


$sql_tintuc = "select ten_$lang as ten,photo,link from #_video where hienthi=1  order by stt,ngaytao desc";
$d->query($sql_tintuc);
$tintuc = $d->result_array();

$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
$url = getCurrentPageURL();
$maxR = 10;
$maxP = 5;
$paging = paging_home($tintuc, $url, $curPage, $maxR, $maxP);
$tintuc = $paging['source'];
?>