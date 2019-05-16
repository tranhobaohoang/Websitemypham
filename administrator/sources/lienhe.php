<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch ($act) {
    case "capnhat":
        get_gioithieu();
        $template = "lienhe/item_add";
        break;
    case "save":
        save_gioithieu();
        break;

    default:
        $template = "index";
}

function get_gioithieu() {
    global $d, $item;

    $sql = "select * from #_lienhe limit 0,1";
    $d->query($sql);
    //if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "default.php");
    $item = $d->fetch_array();
}

function save_gioithieu() {
    global $d;
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=lienhe&act=capnhat");

    $data['noidung_vi'] = magic_quote($_POST['noidung_vi']);
    $data['noidung_en'] = $_POST['noidung_en'];
    $data['noidung_jp'] = $_POST['noidung_jp'];
    $d->reset();
    $d->setTable('lienhe');
    if ($d->update($data))
        header("Location:default.php?com=lienhe&act=capnhat");
    else
        transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=lienhe&act=capnhat");
}

?>