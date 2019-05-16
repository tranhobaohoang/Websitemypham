<?php

if (!defined('_source'))
    die("Error");

$image_share='http://' . $config_url .'/'._upload_hinhanh_l.$row_photo["logo"];

$d->reset();
$d->query("select id, ten_$lang as ten, tenkhongdau, photo, mota_$lang as mota, gia, giakm, spkm, masp, spbc, type from #_product where type='san-pham' and hienthi=1 and spkm=1 order by stt, id desc");
$spkm = $d->result_array();

$d->reset();
$d->query("select id, ten_$lang as ten, tenkhongdau, photo, mota_$lang as mota, gia, giakm, spkm, masp, spbc, type from #_product where type='san-pham' and hienthi=1 and spbc=1 order by stt, id desc");
$sp_moi = $d->result_array();

$d->reset();
$d->query("select * from #_quangcao order by stt");
$q_cao = $d->result_array();

$d->reset();
$sql="select ten_$lang as ten, tenkhongdau, id, type from #_product_list where type='san-pham' and com=1 and hienthi=1 order by stt, id desc";
$d->query($sql);
$sp_list=$d->result_array();

$d->reset();
$sql="select ten_$lang as ten, tenkhongdau, id, mota_$lang as mota, photo, type, ngaytao from #_about where type='tin-tuc' and hienthi=1 and noibat=1 order by stt, id desc";
$d->query($sql);
$t_tuc=$d->result_array();

$d->reset();
$sql="select ten_$lang as ten, tenkhongdau, id, noidung_$lang as noidung, photo, type, ngaytao from #_about where type='y-kien' and hienthi=1 and noibat=1 order by stt, id desc";
$d->query($sql);
$y_kien=$d->result_array();
?>