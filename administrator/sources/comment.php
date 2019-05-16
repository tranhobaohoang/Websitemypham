<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = $_REQUEST['type'];
$urldanhmuc = "";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=" . addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=" . addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=" . addslashes($_REQUEST['id_item']) : "";

$id = $_REQUEST['id'];
switch ($act) {

    case "man":
        get_items();
        $template = "comment/items";
        break;
    case "add":
        $template = "comment/item_add";
        break;
    case "edit":
        get_item();
        $template = "comment/item_add";
        break;
    case "save":
        save_item();
        break;
    case "delete":
        delete_item();
        break;
	#===================================================	
    case "man_danhmuc":
        get_danhmucs();
        $template = "comment/danhmucs";
        break;
    case "add_danhmuc":
        $template = "comment/danhmuc_add";
        break;
    case "edit_danhmuc":
        get_danhmuc();
        $template = "comment/danhmuc_add";
        break;
    case "save_danhmuc":
        save_danhmuc();
        break;
    case "delete_danhmuc":
        delete_danhmuc();
        break;
    #===================================================	
    case "man_photo":
        get_photos();
        $template = "comment/photos";
        break;
    case "add_photo":
        $template = "comment/photo_add";
        break;
    case "edit_photo":
        get_photo();
        $template = "comment/photo_edit";
        break;
    case "save_photo":
        save_photo();
        break;
    case "delete_photo":
        delete_photo();
        break;
    #============================================================
    case "duyetbl":
        get_duyetbl();
        $template = "comment/duyetbl";
        break;
    case "delete_binhluan":
        delete_binhluan();
        $template = "comment/duyetbl";
        break;
    default:
        $template = "index";
}

#====================================

function fns_Rand_digit($min, $max, $num) {
    $result = '';
    for ($i = 0; $i < $num; $i++) {
        $result.=rand($min, $max);
    }
    return $result;
}

function get_items() {
    global $d, $items, $paging, $urldanhmuc, $type;
    
    #-------------------------------------------------------------------------------
    $sql = "select * from #_comment ";
    $sql.=" order by id desc";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=comment&act=man" . $urldanhmuc;
    $maxR = 20;
    $maxP = 20;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_item() {
    global $d, $item, $ds_tags, $type;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man");
    $sql = "select * from #_comment where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=comment&act=man");
    $item = $d->fetch_array();
}

function save_item() {
    global $d, $type;
    $file_name = fns_Rand_digit(0, 9, 12);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";


    if ($id) {
        $data['active'] = isset($_POST['active']) ? 1 : 0;
        $d->setTable('comment');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=comment&act=man&curPage=" . $_REQUEST['curPage'] . "");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=comment&act=man");
    }else {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_comment, $file_name)) {
            $data['photo'] = $photo;
            //$data['thumb'] = create_thumb($data['photo'], 130, 105, _upload_comment, $file_name, 2);
        }

        $data['id_list'] = (int) $_POST['id_list'];
        $data['id_cat'] = (int) $_POST['id_cat'];
        $data['id_item'] = (int) $_POST['id_item'];
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['com'] = $type;
        $data['masp'] = $_POST['masp'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);

        $data['gia'] = (int) $_POST['gia'];
        $data['giakm'] = (int) $_POST['giakm'];

        $data['mota'] = $_POST['mota'];

        $data['chungchi_vi'] = $_POST['chungchi_vi'];
        $data['chungchi_en'] = $_POST['chungchi_en'];
        $data['thongso_vi'] = $_POST['thongso_vi'];
        $data['thongso_en'] = $_POST['thongso_en'];
        $data['noidung_vi'] = $_POST['noidung_vi'];
        $data['noidung_en'] = $_POST['noidung_en'];
        $data['lienhe'] = $_POST['lienhe'];
        $data['spkem'] = $_POST['spkem'];
        $data['giaohang'] = $_POST['giaohang'];

        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];

        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        /* $data['ten_jp'] = $_POST['ten_jp'];
          $data['noidung_jp'] = $_POST['noidung_jp'];
          $data['keywords_jp'] = $_POST['keywords_jp'];
          $data['description_jp'] = $_POST['description_jp'];
          $data['title_jp'] = $_POST['title_jp']; */

        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaytao'] = time();
        $d->setTable('comment');
        if ($d->insert($data)) {
            redirect("default.php?com=comment&act=man");
        } else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=comment&act=man");
    }
}

function delete_item() {
    global $d, $type;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);

        $d->reset();
        $sql = "select * from #_comment where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_comment . $row['photo']);
                delete_file(_upload_comment . $row['thumb']);
            }
            $sql = "delete from #_comment where id='" . $id . "'";
            $d->query($sql);
        }

        if ($d->query($sql))
            redirect("default.php?com=comment&act=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=comment&act=man");
    }elseif (isset($_GET['listid']) == true) {
        $listid = explode(",", $_GET['listid']);
        for ($i = 0; $i < count($listid); $i++) {
            $idTin = $listid[$i];
            $id = themdau($idTin);
            $d->reset();
            $sql = "select * from #_comment where id='" . $id . "'";
            $d->query($sql);
            if ($d->num_rows() > 0) {
                while ($row = $d->fetch_array()) {
                    delete_file(_upload_comment . $row['photo']);
                    delete_file(_upload_comment . $row['thumb']);
                }
                $sql = "delete from #_comment where id='" . $id . "'";
                $d->query($sql);
            }
        } redirect("default.php?com=comment&act=man");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man");
}

#====================================

function get_cats() {
    global $d, $items, $paging, $type;

    $sql = "select * from #_comment_cat ";

    if ((int) $_REQUEST['id_list'] != '') {
        $sql.=" where id_list=" . $_REQUEST['id_list'] . "";
    }
    $sql.=" order by stt";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=comment&act=man_cat";
    $maxR = 20;
    $maxP = 10;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_cat() {
    global $d, $item;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_cat");

    $sql = "select * from #_comment_cat where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=comment&act=man_cat");
    $item = $d->fetch_array();
}

function save_cat() {
    global $d, $type;
    $file_name = fns_Rand_digit(0, 9, 12);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_cat");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_comment, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 310, 310, _upload_comment, $file_name, 2);
            $d->setTable('comment_cat');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_comment . $row['photo']);
                delete_file(_upload_comment . $row['thumb']);
            }
        }
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['id_list'] = $_POST['id_list'];
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];
        $data['com'] = $type;
        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaysua'] = time();

        $d->setTable('comment_cat');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=comment&act=man_cat&curPage=" . $_REQUEST['curPage'] . "");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=comment&act=man_cat");
    }else {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_comment, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 310, 310, _upload_comment, $file_name, 2);
        }
        $data['id_list'] = $_POST['id_list'];
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];
        $data['com'] = $type;
        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaytao'] = time();

        $d->setTable('comment_cat');
        if ($d->insert($data))
            redirect("default.php?com=comment&act=man_cat");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=comment&act=man_cat");
    }
}

function delete_cat() {
    global $d, $type;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->reset();

        $sql = "delete from #_comment_cat where id='" . $id . "'";
        $d->query($sql);


        if ($d->query($sql))
            redirect("default.php?com=comment&act=man_cat");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=comment&act=man_cat");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_cat");
}

/* --------------------------------- */

function get_loais() {
    global $d, $items, $paging;
    #----------------------------------------------------------------------------------------
    if ($_REQUEST['hienthi'] != '') {
        $id_up = $_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_comment_item where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_comment_item SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_comment_item SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    $sql = "select * from #_comment_item";

    if ((int) $_REQUEST['id_list'] != '') {
        $sql.=" where id_list=" . $_REQUEST['id_list'] . "";
    }
    $sql.=" order by stt";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=comment&act=man_item";
    $maxR = 20;
    $maxP = 10;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_loai() {
    global $d, $item;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_item");

    $sql = "select * from #_comment_item where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=comment&act=man_item");
    $item = $d->fetch_array();
}

function save_loai() {
    global $d, $type;
    $file_name = fns_Rand_digit(0, 9, 12);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_item");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_comment, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 310, 310, _upload_comment, $file_name, 2);
            $d->setTable('comment_item');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_comment . $row['photo']);
                delete_file(_upload_comment . $row['thumb']);
            }
        }
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['id_list'] = $_POST['id_list'];
        $data['id_cat'] = $_POST['id_cat'];
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];

        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaysua'] = time();

        $d->setTable('comment_item');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=comment&act=man_item&curPage=" . $_REQUEST['curPage'] . "");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=comment&act=man_item");
    }else {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_comment, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 310, 310, _upload_comment, $file_name, 2);
        }
        $data['id_list'] = $_POST['id_list'];
        $data['id_cat'] = $_POST['id_cat'];
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];

        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaytao'] = time();

        $d->setTable('comment_item');
        if ($d->insert($data))
            redirect("default.php?com=comment&act=man_item");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=comment&act=man_item");
    }
}

function delete_loai() {
    global $d, $type;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->reset();

        $sql = "delete from #_comment_item where id='" . $id . "'";
        $d->query($sql);


        if ($d->query($sql))
            redirect("default.php?com=comment&act=man_item");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=comment&act=man_item");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_item");
}

/* --------------------------------- */

function get_lists() {
    global $d, $items, $paging, $type;
    #----------------------------------------------------------------------------------------
    if ($_REQUEST['noibat'] != '') {
        $id_up = $_REQUEST['noibat'];
        $sql_sp = "SELECT id,noibat FROM table_comment_list where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $time = time();
        $hienthi = $cats[0]['noibat'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_comment_list SET noibat ='$time' WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_comment_list SET noibat =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    #----------------------------------------------------------------------------------------
    if ($_REQUEST['hienthi'] != '') {
        $id_up = $_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_comment_list where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_comment_list SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_comment_list SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    $sql = "select * from #_comment_list ";
	if($_REQUEST["id_doanhnghiep"])
		$sql.=" where id_doanhnghiep='".$_REQUEST["id_doanhnghiep"]."'";
    $sql.=" order by id_doanhnghiep,stt,id desc";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=comment&act=man_list";
    $maxR = 20;
    $maxP = 10;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_list() {
    global $d, $item, $type;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_list");
    $sql = "select * from #_comment_list where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=comment&act=man_list");
    $item = $d->fetch_array();
}

function save_list() {
    global $d, $type;
    $file_name = fns_Rand_digit(0, 9, 12);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_list");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_comment, $file_name)) {
            $data['photo'] = $photo;
            $d->setTable('comment_list');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_comment . $row['photo']);
            }
        }
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['keywords_jp'] = $_POST['keywords_jp'];
        $data['description_jp'] = $_POST['description_jp'];
        $data['title_jp'] = $_POST['title_jp'];
        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['stt'] = $_POST['stt'];
        $data['com'] = $type;
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaysua'] = time();

        $d->setTable('comment_list');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=comment&act=man_list&curPage=" . $_REQUEST['curPage'] . "");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=comment&act=man_list");
    }else {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_comment, $file_name)) {
            $data['photo'] = $photo;
        }
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['keywords_jp'] = $_POST['keywords_jp'];
        $data['description_jp'] = $_POST['description_jp'];
        $data['title_jp'] = $_POST['title_jp'];
        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['com'] = $type;
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaytao'] = time();

        $d->setTable('comment_list');
        if ($d->insert($data))
            redirect("default.php?com=comment&act=man_list");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=comment&act=man_list");
    }
}

function delete_list() {
    global $d, $type;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->reset();
        $sql = "select * from #_comment_list where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_comment . $row['photo']);
                delete_file(_upload_comment . $row['thumb']);
            }
            $sql = "delete from #_comment_list where id='" . $id . "'";
            $d->query($sql);
        }
        if ($d->query($sql))
            redirect("default.php?com=comment&act=man_list");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=comment&act=man_list");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_list");
}

/* --------------------------------------------- */
/* --------------------------------- */

function get_danhmucs() {
    global $d, $items, $paging, $type;
    #----------------------------------------------------------------------------------------
    if ($_REQUEST['noibat'] != '') {
        $id_up = $_REQUEST['noibat'];
        $sql_sp = "SELECT id,noibat FROM table_comment_danhmuc where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $time = time();
        $hienthi = $cats[0]['noibat'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_comment_danhmuc SET noibat ='$time' WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_comment_danhmuc SET noibat =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    #----------------------------------------------------------------------------------------
    if ($_REQUEST['hienthi'] != '') {
        $id_up = $_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_comment_danhmuc where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_comment_danhmuc SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_comment_danhmuc SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    $sql = "select * from #_comment_danhmuc ";
    $sql.=" order by stt,id desc";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=comment&act=man_danhmuc";
    $maxR = 20;
    $maxP = 10;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_danhmuc() {
    global $d, $item, $type;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_danhmuc");
    $sql = "select * from #_comment_danhmuc where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=comment&act=man_danhmuc");
    $item = $d->fetch_array();
}

function save_danhmuc() {
    global $d, $type;
    $file_name = fns_Rand_digit(0, 9, 12);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_danhmuc");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_comment, $file_name)) {
            $data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 20, 20, _upload_comment, $file_name . $i, 2);
            $d->setTable('comment_danhmuc');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_comment . $row['photo']);
				delete_file(_upload_comment . $row['thumb']);
            }
        }
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['keywords_jp'] = $_POST['keywords_jp'];
        $data['description_jp'] = $_POST['description_jp'];
        $data['title_jp'] = $_POST['title_jp'];
        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['stt'] = $_POST['stt'];
        $data['com'] = $type;
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaysua'] = time();

        $d->setTable('comment_danhmuc');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=comment&act=man_danhmuc&curPage=" . $_REQUEST['curPage'] . "");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=comment&act=man_danhmuc");
    }else {
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_comment, $file_name)) {
            $data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 20, 20, _upload_comment, $file_name, 2);
        }
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
        $data['title_vi'] = $_POST['title_vi'];
        $data['title_en'] = $_POST['title_en'];
        $data['keywords_vi'] = $_POST['keywords_vi'];
        $data['keywords_en'] = $_POST['keywords_en'];
        $data['ten_jp'] = $_POST['ten_jp'];
        $data['keywords_jp'] = $_POST['keywords_jp'];
        $data['description_jp'] = $_POST['description_jp'];
        $data['title_jp'] = $_POST['title_jp'];
        $data['description_vi'] = $_POST['description_vi'];
        $data['description_en'] = $_POST['description_en'];
        $data['com'] = $type;
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaytao'] = time();

        $d->setTable('comment_danhmuc');
        if ($d->insert($data))
            redirect("default.php?com=comment&act=man_danhmuc");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=comment&act=man_danhmuc");
    }
}

function delete_danhmuc() {
    global $d, $type;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->reset();
        $sql = "select * from #_comment_danhmuc where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_comment . $row['photo']);
                delete_file(_upload_comment . $row['thumb']);
            }
            $sql = "delete from #_comment_danhmuc where id='" . $id . "'";
            $d->query($sql);
        }
        if ($d->query($sql))
            redirect("default.php?com=comment&act=man_danhmuc");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=comment&act=man_danhmuc");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_danhmuc");
}

/* --------------------------------------------- */

function get_photos() {
    global $d, $items, $paging;
    #----------------------------------------------------------------------------------------
    if ($_REQUEST['hienthi'] != '') {
        $id_up = $_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_comment_hinhanh where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_comment_hinhanh SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_comment_hinhanh SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }



    $sql = "select * from #_comment_hinhanh where ( id_photo = '" . $_REQUEST['idc'] . "' OR '" . $_REQUEST['idc'] . "'=0  ) order by stt,id desc ";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "";
    $maxR = 10;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_photo() {
    global $d, $item, $list_cat;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "");

    $d->setTable('comment_hinhanh');
    $d->setWhere('com', 'comment');
    $d->setWhere('id', $id);
    $d->select();
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "");
    $item = $d->fetch_array();
    $d->reset();
}

function save_photo() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 10);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "");

    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) { // cap nhat
        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|Jpg|JPEG', _upload_comment, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], 300, 300, _upload_comment, $file_name . $i, 1);
            $d->setTable('comment_hinhanh');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload . $row['photo']);
                delete_file(_upload . $row['thumb']);
            }
        }
        $data['id'] = $_REQUEST['id'];
        $data['mota'] = $_POST['mota'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['com'] = 'comment';
        $d->reset();
        $d->setTable('comment_hinhanh');
        $d->setWhere('id', $id);
        if (!$d->update($data))
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "");
        redirect("default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "");
    } { // them moi
        for ($i = 0; $i < 5; $i++) {
            if ($photo = upload_image("file" . $i, 'jpg|png|gif|JPG|jpeg|Jpg|JPEG', _upload_comment, $file_name . $i)) {
                $data['photo'] = $photo;
                $data['thumb'] = create_thumb($data['photo'], 300, 300, _upload_comment, $file_name . $i, 1);

                $data['mota'] = "mota :" . $i;

                $data['stt'] = $_POST['stt' . $i];
                $data['mota'] = $_POST['mota' . $i];

                $data['hienthi'] = isset($_POST['hienthi' . $i]) ? 1 : 0;
                $data['com'] = 'comment';

                $data['id_photo'] = $_REQUEST['idc'];

                $d->setTable('comment_hinhanh');
                if (!$d->insert($data))
                    transfer("Lưu dữ liệu bị lỗi", "default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "");
            }
        }
        redirect("default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "");
    }
}

function delete_photo() {
    global $d;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->setTable('comment_hinhanh');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() == 0)
            transfer("Dữ liệu không có thực", "default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "");
        $row = $d->fetch_array();
        delete_file(_upload_comment . $row['photo']);
        delete_file(_upload_comment . $row['thumb']);
        if ($d->delete())
            redirect("default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=man_photo&idc=" . $_REQUEST['idc'] . "");
}

function get_duyetbl() {
    global $d, $items, $paging;
    if (@$_REQUEST['hienthi'] != '') {
        $id_up = @$_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_comment_bl where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        //echo "id:". $spdc1;
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_comment_bl SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_comment_bl SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    $sql = "select * from #_comment_bl";
    $sql.=" order by id desc";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=comment&act=duyetbl";
    $maxR = 20;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function delete_binhluan() {
    global $d;
    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $sql = "delete from #_comment_bl where id='" . $id . "'";
        if ($d->query($sql))
            redirect("default.php?com=comment&act=duyetbl");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=comment&act=duyetbl");
    }elseif (isset($_GET['listid']) == true) {
        $listid = explode(",", $_GET['listid']);
        for ($i = 0; $i < count($listid); $i++) {
            $idTin = $listid[$i];
            $id = themdau($idTin);
            $d->reset();

            $sql = "delete from #_comment_bl where id='" . $id . "'";
            $d->query($sql);
        }redirect("default.php?com=comment&act=duyetbl");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=comment&act=duyetbl");
}

?>