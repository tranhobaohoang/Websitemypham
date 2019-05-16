<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch ($act) {
    case "capnhat":
        get_gioithieu();
        $template = "setting/item_add";
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

    $sql = "select * from #_setting limit 0,1";
    $d->query($sql);
    //if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "default.php");
    $item = $d->fetch_array();
}

function save_gioithieu() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 8);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=setting&act=capnhat");

    $data['title_vi'] = $_POST['title_vi'];
    $data['title_en'] = $_POST['title_en'];

    $data['keywords_vi'] = $_POST['keywords_vi'];
    $data['keywords_en'] = $_POST['keywords_en'];

    $data['description_vi'] = $_POST['description_vi'];
    $data['description_en'] = $_POST['description_en'];

    $data['hotline'] = $_POST['hotline'];
	$data['hotline1'] = $_POST['hotline1'];
	$data['ten_hl1'] = $_POST['ten_hl1'];
	$data['ten_hl2'] = $_POST['ten_hl2'];

    $data['ten_vi'] = $_POST['ten_vi'];
    $data['ten_en'] = $_POST['ten_en'];

    $data['dienthoai_vi'] = $_POST['dienthoai_vi'];
    $data['dienthoai_en'] = $_POST['dienthoai_en'];

    $data['fax_vi'] = $_POST['fax_vi'];
    $data['fax_en'] = $_POST['fax_en'];

    $data['diachi_vi'] = $_POST['diachi_vi'];
    $data['diachi_en'] = $_POST['diachi_en'];
    $data['toado'] = $_POST['toado'];
    $data['email'] = $_POST['email'];
    $data['slogan_vi'] = $_POST['slogan_vi'];
    $data['slogan_en'] = $_POST['slogan_en'];
    $data['website'] = $_POST['website'];
    $data['facebook'] = $_POST['facebook'];
    $data['twitter'] = $_POST['twitter'];
    $data['google'] = $_POST['google'];
    $data['youtube'] = $_POST['youtube'];
    $data['gg'] = $_POST['gg'];
    $data['map'] = $_POST['map'];
    $data['livechat'] = $_POST['livechat'];
    $data['h1_vi'] = $_POST['h1_vi'];
    $data['h1_en'] = $_POST['h1_en'];
    $data['h1_jp'] = $_POST['h1_jp'];
    $data['h2_vi'] = $_POST['h2_vi'];
    $data['h2_en'] = $_POST['h2_en'];
    $data['h2_jp'] = $_POST['h2_jp'];
    $data['h3_vi'] = $_POST['h3_vi'];
    $data['h3_en'] = $_POST['h3_en'];
    $data['h3_jp'] = $_POST['h3_jp'];
    $data['h4_vi'] = $_POST['h4_vi'];
    $data['h4_en'] = $_POST['h4_en'];
    $data['h4_jp'] = $_POST['h4_jp'];
    $data['h5_vi'] = $_POST['h5_vi'];
    $data['h5_en'] = $_POST['h5_en'];
    $data['h5_jp'] = $_POST['h5_jp'];
    $data['h6_vi'] = $_POST['h6_vi'];
    $data['h6_en'] = $_POST['h6_en'];
    $data['h6_jp'] = $_POST['h6_jp'];
	$data['miennam'] = $_POST['miennam'];
	$data['mienbac'] = $_POST['mienbac'];
	$data['duphong'] = $_POST['duphong'];
	$data['luuy1'] = $_POST['luuy1'];
	$data['luuy2'] = $_POST['luuy2'];
	$data['meta'] = $_POST['meta'];
	$data['mst'] = $_POST['mst'];
    
    if ($photo = upload_image("file", 'jpg|png|gif', _upload_hinhanh, $file_name)) {
        $data['fav'] = $photo;
        $d->setTable('setting');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() > 0) {
            $row = $d->fetch_array();
            delete_file(_upload_hinhanh . $row['fav']);
        }
    }
	if ($photo2 = upload_image("file2", 'jpg|png|gif', _upload_hinhanh, $file_name."tu-van")) {
        $data['tuvan'] = $photo2;
        $d->setTable('setting');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() > 0) {
            $row = $d->fetch_array();
            delete_file(_upload_hinhanh . $row['tuvan']);
        }
    }
    $d->reset();
    $d->setTable('setting');
    if ($d->update($data))
        header("Location:default.php?com=setting&act=capnhat");
    else
        transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=setting&act=capnhat");
}

?>