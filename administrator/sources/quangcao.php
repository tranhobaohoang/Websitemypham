<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch ($act) {
    case "man_photo":
        get_photos();
        $template = "quangcao/photos";
        break;
    case "add_photo":
        $template = "quangcao/photo_add";
        break;
    case "edit_photo":
        get_photo();
        $template = "quangcao/photo_edit";
        break;
    case "save_photo":
        save_photo();
        break;
    case "delete_photo":
        delete_photo();
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

function get_photos() {
    global $d, $items, $paging;

    #----------------------------------------------------------------------------------------
    if ($_REQUEST['hienthi'] != '') {
        $id_up = $_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_quangcao where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_quangcao SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_quangcao SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }
    #-------------------------------------------------------------------------------

    $d->setTable('quangcao');
    $d->setOrder('stt,id desc');
    $d->select('*');
    $d->query();
    $items = $d->result_array();
    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=quangcao&act=man_photo";
    $maxR = 10;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_photo() {
    global $d, $item, $list_cat;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=quangcao&act=man_photo");
    $d->setTable('quangcao');
    $d->setWhere('id', $id);
    $d->select();
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=quangcao&act=man_photo");
    $item = $d->fetch_array();
}

function save_photo() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 15);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=quangcao&act=man_photo");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        if ($photo = upload_image("file", 'jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh, $file_name)) {
            $data['photo'] = $photo;
            #$data['thumb'] = create_thumb($data['photo'], 960, 200, _upload_hinhanh,$file_name,1);
            $d->setTable('quangcao');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_hinhanh . $row['photo']);
                #delete_file(_upload_hinhanh.$row['thumb']);
            }
        }

        $data['stt'] = $_POST['stt'];
        $data['link'] = $_POST['link'];
        $data['ten'] = $_POST['ten'];
		$data['mota'] = $_POST['mota'];
        $data['alt_img'] = $_POST['alt_img'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $d->reset();
        $d->setTable('quangcao');
        $d->setWhere('id', $id);
        if (!$d->update($data))
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=quangcao&act=man_photo");
        redirect("default.php?com=quangcao&act=man_photo");
    }else {
        for ($i = 0; $i < 5; $i++) {
            if ($data['photo'] = upload_image("file" . $i, 'jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh, $file_name . $i)) {
                #$data['thumb'] = create_thumb($data['photo'], 960, 200, _upload_hinhanh,$file_name.$i,1);	
                $data['stt'] = $_POST['stt' . $i];
                $data['ten'] = $_POST['ten' . $i];
				$data['mota'] = $_POST['mota' . $i];
                $data['alt_img'] = $_POST['alt_img' . $i];
                $data['link'] = $_POST['link' . $i];
                $data['hienthi'] = isset($_POST['hienthi' . $i]) ? 1 : 0;
                $d->setTable('quangcao');
                if (!$d->insert($data))
                    transfer("Lưu dữ liệu bị lỗi", "default.php?com=quangcao&act=man_photo");
            }
        }

        redirect("default.php?com=quangcao&act=man_photo");
    }
}

function delete_photo() {
    global $d;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->setTable('quangcao');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() == 0)
            transfer("Dữ liệu không có thực", "default.php?com=quangcao&act=man_photo");
        $row = $d->fetch_array();
        delete_file(_upload_hinhanh . $row['photo']);
        #delete_file(_upload_hinhanh.$row['thumb']);
        if ($d->delete())
            redirect("default.php?com=quangcao&act=man_photo");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=quangcao&act=man_photo");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=quangcao&act=man_photo");
}
?>


