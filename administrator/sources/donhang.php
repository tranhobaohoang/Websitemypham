<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$id = $_REQUEST['id'];
switch ($act) {

    case "man":
        get_items();
        $template = "donhang/items";
        break;
    case "add":
        $template = "donhang/item_add";
        break;
    case "edit":
        get_item();
        $template = "donhang/item_add";
        break;
    case "save":
        save_item();
        break;
    case "delete":
        delete_item();
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
    global $d, $items, $paging;

    $sql = "select * from #_donhang where id>0 ";
    if (($_REQUEST['keyword']!='')) {

        $keyword = $_REQUEST['keyword'];
        $sql.=" and hoten LIKE '%$keyword%'";
		$code = $_REQUEST['keyword'];
        $sql.=" or madonhang LIKE '%$code%'";
    }
	if (($_REQUEST['tinhtrang']>0)) {

        $tinhtrang = $_REQUEST['tinhtrang'];
        

        $sql.=" and trangthai = '".$tinhtrang."'";
    }
	if($_REQUEST["sotien"]>0){
		$price = (int) $_REQUEST['sotien'];
        $sql_price = '';
        if ($price == 1)
            $sql_price = " and tonggia < 3000000";
        elseif ($price == 2)
            $sql_price = " and tonggia >= 3000000 and tonggia < 7000000";
        elseif ($price == 3)
            $sql_price = " and tonggia >= 7000000 and tonggia < 10000000";
        elseif ($price == 4)
            $sql_price = " and tonggia >= 10000000";
		$sql.="$sql_price";
	}
	if($_REQUEST["ngaybd"]!=''){
		$start = $_REQUEST['ngaybd'];
		$Ngay_arr = explode("/", $start); // array(17,11,2010)
		if (count($Ngay_arr) == 3) {
			$thang = $Ngay_arr[0]; //17
			$ngay = $Ngay_arr[1]; //11
			$nam = $Ngay_arr[2]; //2010
			if (checkdate($thang, $ngay, $nam) == false) {
				$coloi = true;
				$error_ngaysinh = "Bạn nhập chưa đúng ngày cấp<br>";
			} else
				$ngaycap = $thang . "/" . $ngay . "/" . $nam;
		}
		$start = (int) strtotime($ngaycap);
		$end = $_REQUEST['ngaykt'];
		$Ngay_arr = explode("/", $end); // array(17,11,2010)
		if (count($Ngay_arr) == 3) {
			$thang = $Ngay_arr[0]; //17
			$ngay = $Ngay_arr[1]; //11
			$nam = $Ngay_arr[2]; //2010
			if (checkdate($thang, $ngay, $nam) == false) {
				$coloi = true;
				$error_ngaysinh = "Bạn nhập chưa đúng ngày cấp<br>";
			} else
				$ngaycap = $thang . "/" . $ngay . "/" . $nam;
		}
		$end = (int) strtotime($ngaycap);
        $sql.=" and ngaytao>'".$start."' and ngaytao<'".$end."'";
	}
    $sql.=" order by id desc";
	
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=order&act=man";
    $maxR = 20;
    $maxP = 20;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_item() {
    global $d, $item, $result_ctdonhang;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=order&act=man");

    $sql = "select * from #_donhang where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=order&act=man");
    $item = $d->fetch_array();
	
	$d->reset();
	$sql="select * from #_dhct where id_dh='".$id."'";
	$d->query($sql);
	$result_ctdonhang = $d->result_array();
}

function save_item() {
    global $d;
    $file_name = fns_Rand_digit(0, 9, 12);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=order&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";


    if ($id) {
        $id = themdau($_POST['id']);

        $data['ghichu'] = $_POST['ghichu'];
        $data['trangthai'] = $_POST['id_tinhtrang'];
        $d->setTable('donhang');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=order&act=man&curPage=" . $_REQUEST['curPage'] . "");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=order&act=man");
    }else {


        $data['ghichu'] = $_POST['ghichu'];
        $data['trangthai'] = $_POST['id_tinhtrang'];
        $d->setTable('donhang');
        if ($d->insert($data))
            redirect("default.php?com=order&act=man");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=order&act=man");
    }
}

function delete_item() {
    global $d;
    if ($_REQUEST['id_cat'] != '') {
        $id_catt = "&id_cat=" . $_REQUEST['id_cat'];
    }
    if ($_REQUEST['curPage'] != '') {
        $id_catt.="&curPage=" . $_REQUEST['curPage'];
    }


    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->reset();
        $sql = "delete from #_donhang where id='" . $id . "'";
        $d->query($sql);
        $d->reset();
        $sql = "delete from #_dhct where id_dh='" . $id . "'";
        $d->query($sql);
        if ($d->query($sql))
            redirect("default.php?com=order&act=man" . $id_catt . "");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=order&act=man");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=order&act=man");

}

?>