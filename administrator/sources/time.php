<?php

if (!defined('_source'))
    die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
switch ($act) {
    case "capnhat":
        get_gioithieu();
        $template = "time/item_add";
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
    global $d, $item, $type;

    $sql = "select * from #_time where type='".$type."' limit 0,1";
    $d->query($sql);
    if ($d->num_rows() == 0){
		$data["type"]=$type;
		$d->setTable("time");
		$d->insert($data);
		$d->reset();
		$sql = "select * from #_time where type='".$type."' limit 0,1";
		$d->query($sql);
		$item = $d->fetch_array();
	}else{
		$item = $d->fetch_array();
	}
}

function save_gioithieu() {
    global $d,$type;
    $file_name = fns_Rand_digit(0, 9, 5);
	$id=$_POST["id"];
	
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=time&act=capnhat&type=".$type);
    if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh, $file_name)) {
        $data['photo'] = $photo;
        $data['thumb'] = create_thumb($data['photo'], 290, 230, _upload_hinhanh, $file_name);
        $d->setTable('time');
        $d->select();
        if ($d->num_rows() > 0) {
            $row = $d->fetch_array();
            delete_file(_upload_hinhanh . $row['photo']);
            delete_file(_upload_hinhanh . $row['thumb']);
        }
    }
	$data['type'] = $type;
    $data['ten_vi'] = $_POST['ten_vi'];
	$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
    $data['ten_en'] = $_POST['ten_en'];
    $data['ten_jp'] = $_POST['ten_jp'];
	$data['mota_vi'] = $_POST['mota_vi'];
    $data['mota_en'] = $_POST['mota_en'];
    $data['mota_jp'] = $_POST['mota_jp'];
    $data['title_vi'] = $_POST['title_vi'];
    $data['title_en'] = $_POST['title_en'];
    $data['title_jp'] = $_POST['title_jp'];
    $data['keywords_vi'] = $_POST['keywords_vi'];
    $data['keywords_en'] = $_POST['keywords_en'];
    $data['keywords_jp'] = $_POST['keywords_jp'];

    $data['description_vi'] = $_POST['description_vi'];
    $data['description_en'] = $_POST['description_en'];
    $data['description_jp'] = $_POST['description_jp'];
    $data['noidung_vi'] = $_POST['noidung_vi'];
    $data['noidung_en'] = $_POST['noidung_en'];
    $data['noidung_jp'] = $_POST['noidung_jp'];
	$data['h1'] = $_POST['h1'];
	$data['h2'] = $_POST['h2'];
	$data['h3'] = $_POST['h3'];
	$data['video'] = $_POST['video'];

    $d->reset();
    $d->setTable('time');
	$d->setWhere("id",$id);
    if ($d->update($data))
        transfer("Dữ liệu được cập nhật", "default.php?com=time&act=capnhat&type=".$type);
    else
        transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=time&act=capnhat&type=".$type);
}

?>