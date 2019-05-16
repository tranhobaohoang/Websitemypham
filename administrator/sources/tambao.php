<?php

if (!defined('_source'))
    die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch ($act) {
    case "capnhat":
        get_gioithieu();
        $template = "tambao/item_add";
        break;
    case "save":
        save_gioithieu();
        break;


    default:
        $template = "index";
}

function fns_Rand_digit($min, $max, $num) {
    $result = '';
    for ($i = 0; $i < $num; $i++) {
        $result.=rand($min, $max);
    }
    return $result;
}

function get_gioithieu() {
    global $d, $item;

    $sql = "select * from #_tambao limit 0,1";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu chưa khởi tạo.", "default.php");
    $item = $d->fetch_array();
}

function save_gioithieu() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 5);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=tambao&act=capnhat");
    if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh, $file_name)) {
        $data['photo'] = $photo;
        $d->setTable('tambao');
        $d->select();
        if ($d->num_rows() > 0) {
            $row = $d->fetch_array();
            delete_file(_upload_hinhanh . $row['photo']);
        }
    }
    $data['ten_vi'] = $_POST['ten_vi'];
    $data['ten_en'] = $_POST['ten_en'];
	$data['mota'] = $_POST['mota'];
    $data['ten_jp'] = $_POST['ten_jp'];
    $data['noidung_vi'] = mysql_escape_string($_POST['noidung_vi']);
    $data['noidung_en'] = mysql_escape_string($_POST['noidung_en']);
    $data['noidung_jp'] = mysql_escape_string($_POST['noidung_jp']);
    //echo $data['noidung_jp']; die;
    $d->reset();
    $d->setTable('tambao');
    $d->setWhere('id', '4');
    if ($d->update($data))
        transfer("Dữ liệu được cập nhật", "default.php?com=tambao&act=capnhat");
    else
        transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=tambao&act=capnhat");
}

?>