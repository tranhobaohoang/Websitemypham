<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";

switch ($act) {
    case "man":
        get_items();
        $template = "icon/items";
        break;
    case "add":
        $template = "icon/item_add";
        break;
    case "edit":
        get_item();
        $template = "icon/item_add";
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

function fns_Rand_digit($min, $max, $num) {
    $result = '';
    for ($i = 0; $i < $num; $i++) {
        $result.=rand($min, $max);
    }
    return $result;
}

function get_items() {
    global $d,$type, $items, $paging;

    if ($_REQUEST['hienthi'] != '') {
        $id_up = $_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_icon where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_icon SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_icon SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_icon SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=icon&act=man&type=".$type);			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_icon SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=icon&act=man&type=".$type);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				
				$sql = "select id,thumb, photo from #_icon where id= ".$id_array[$i]."";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_icon.$row['photo']);
						delete_file(_upload_icon.$row['thumb']);			
					}
				}
				$sql = "delete from table_icon where id = ".$id_array[$i]."";
				
				if(mysql_query($sql)){
					
					
				}
							
			}
			redirect("default.php?com=icon&act=man&type=".$type);			
		}
		
		
	}
    $sql = "select * from #_icon where com='".$type."' order by stt";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=icon&type=".$type."&act=man";
    $maxR = 10;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_item() {
    global $d,$type, $item;
    @$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=icon&type=".$type."&act=man");

    $sql = "select * from #_icon where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=icon&type=".$type."&act=man");
    $item = $d->fetch_array();
}

function save_item() {
    global $d,$type;
    $file_name = fns_Rand_digit(0, 9, 8);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=icon&type=".$type."&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) {
        $id = themdau($_POST['id']);

        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|PNG|Jpg', _upload_icon, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], _icon_thumb_w, _icon_thumb_h, _upload_icon, $file_name, 1);

            $d->setTable('icon');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_icon . $row['photo']);
                delete_file(_upload_icon . $row['thumb']);
            }
        }


        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['ten_ci'] = $_POST['ten_ci'];
		$data['com'] = $type;
        $data['url'] = $_POST['url'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

        $d->setTable('icon');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("default.php?com=icon&type=".$type."&act=man");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=icon&type=".$type."&act=man");
    }else {

        if ($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|PNG|Jpg', _upload_icon, $file_name)) {
            $data['photo'] = $photo;
            $data['thumb'] = create_thumb($data['photo'], _icon_thumb_w, _icon_thumb_h, _upload_icon, $file_name, 1);
        }

        $data['ten_vi'] = $_POST['ten_vi'];
        $data['ten_en'] = $_POST['ten_en'];
        $data['ten_ci'] = $_POST['ten_ci'];
		$data['com'] = $type;
        $data['url'] = $_POST['url'];
        $data['stt'] = $_POST['stt'];
        $data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

        $d->setTable('icon');
        if ($d->insert($data))
            redirect("default.php?com=icon&type=".$type."&act=man");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=icon&type=".$type."&act=man");
    }
}

function delete_item() {
    global $d,$type;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);
        $d->reset();
        $sql = "select id,thumb, photo from #_icon where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_icon . $row['photo']);
                delete_file(_upload_icon . $row['thumb']);
            }
            $sql = "delete from #_icon where id='" . $id . "'";
            if ($d->query($sql))
                transfer("Dữ liệu đã được xóa", "default.php?com=icon&type=".$type."&act=man");
            else
                transfer("Xóa dữ liệu bị lỗi", "default.php?com=icon&type=".$type."&act=man");
        }
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=icon&type=".$type."&act=man");
}

?>