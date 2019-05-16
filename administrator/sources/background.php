<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch ($act) {
    case "capnhat":
        get_gioithieu();
        $template = "background/item_add";
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

    $sql = "select * from #_background limit 0,1";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu chưa khởi tạo.", "default.php");
    $item = $d->fetch_array();
}

function save_gioithieu() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 5);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=background&act=capnhat");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        $id = themdau($_POST['id']);

        if ($photo = upload_image("file", 'jpg|png|gif|JPG|PNG|GIF', _upload_hinhanh, $file_name)) {
            $data['photo'] = $photo;
            $d->setTable('background');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_background . $row['photo']);
            }
        }
        $data['color'] = $_POST['color'];
        $data['repeatbg'] = $_POST['repeatbg'];
        $data['position'] = $_POST['position'];
        $d->reset();
        $d->setTable('background');
        if ($d->update($data))
            transfer("Dữ liệu được cập nhật", "default.php?com=background&act=capnhat");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=background&act=capnhat");
    }
    else {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|PNG|GIF', _upload_hinhanh, $file_name)) {
            $data['photo'] = $photo;
        }

        $data['ten'] = $_POST['ten'];
        $data['mota'] = $_POST['mota'];
        $data['noidung'] = $_POST['noidung'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaytao'] = time();
        $d->setTable('background');
        if ($d->insert($data))
            redirect("default.php?com=background&act=capnhat");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=background&act=capnhat");
    }
}

?>