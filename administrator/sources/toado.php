<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$idc = (isset($_REQUEST['idc'])) ? addslashes($_REQUEST['idc']) : "";

switch ($act) {
    case "man":
        get_items();
        $template = "toado/items";
        break;
    case "add":
        $template = "toado/item_add";
        break;
    case "edit":
        get_item();
        $template = "toado/item_add";
        break;
    case "save":
        save_item();
        break;
    case "delete":
        delete_item();
        break;
    #===================================================	
    case "man_cat":
        get_cats();
        $template = "toado/cats";
        break;
    case "add_cat":
        $template = "toado/cat_add";
        break;
    case "edit_cat":
        get_cat();
        $template = "toado/cat_add";
        break;
    case "save_cat":
        save_cat();
        break;
    case "delete_cat":
        delete_cat();
        break;
    default:
        $template = "index";

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

function get_items() {
    global $d,$idc, $items, $paging;

    if (@$_REQUEST['update'] != '') {
        $id_up = @$_REQUEST['update'];

        $tinnoibat = time();

        $sql_sp = "SELECT id,tinnoibat FROM table_toado where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $spdc1 = $cats[0]['tinnoibat'];
        //echo "id:". $spdc1;
        if ($spdc1 == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_toado SET tinnoibat ='" . $tinnoibat . "' WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_toado SET tinnoibat =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    if (@$_REQUEST['hienthi'] != '') {
        $id_up = @$_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_toado where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        //echo "id:". $spdc1;
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_toado SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_toado SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    $sql = "select * from #_toado ";
    if ((int) $_REQUEST['idc'] != '') {
        $sql.=" where  	idc=" . $_REQUEST['idc'] . "";
    }
    $sql.=" order by stt";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=toado&idc=".$idc."&act=man";
    $maxR = 20;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_item() {
    global $d,$idc, $item;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=toado&idc=".$idc."&act=man");

    $sql = "select * from #_toado where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=toado&idc=".$idc."&act=man");
    $item = $d->fetch_array();
}

function save_item() {
    global $d,$idc;
    $file_name = fns_Rand_digit(0, 9, 8);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=toado&idc=".$idc."&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        $id = themdau($_POST['id']);
		$data['idc'] = $idc;
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
		$data['diachi'] = $_POST['AddressNumber'];
		$data['noidung_vi'] = $_POST['noidung_vi'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		if($_POST['Latitude']!=0 and $_POST['Longitude']!=0){
			$toado=$_POST['Latitude'].','.$_POST['Longitude'];
			$data['toado'] = $toado;
		}

        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaysua'] = time();

        $d->setTable('toado');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=toado&idc=".$idc."&act=man");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=toado&idc=".$idc."&act=man");
    }else {
		$data['idc'] = $idc;
        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['diachi'] = $_POST['AddressNumber'];
		$data['noidung_vi'] = $_POST['noidung_vi'];
		if($_POST['Latitude']!=0 and $_POST['Longitude']!=0){
			$toado=$_POST['Latitude'].','.$_POST['Longitude'];
			$data['toado'] = $toado;
		}

        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
        $data['ngaysua'] = time();
		
        $d->setTable('toado');
        if ($d->insert($data))
            redirect("default.php?com=toado&idc=".$idc."&act=man");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=toado&idc=".$idc."&act=man");
    }
}

function delete_item() {
    global $d,$idc;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);

        $d->reset();
        $sql = "select * from #_toado where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_tintuc . $row['photo']);
                delete_file(_upload_tintuc . $row['thumb']);
            }
            $sql = "delete from #_toado where id='" . $id . "'";
            $d->query($sql);
        }

        if ($d->query($sql))
            redirect("default.php?com=toado&idc=".$idc."&act=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=toado&idc=".$idc."&act=man");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=toado&idc=".$idc."&act=man");
}

//===========================================================
?>