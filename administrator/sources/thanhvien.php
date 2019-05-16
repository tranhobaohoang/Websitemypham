<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";

switch ($act) {
    case "man":
        get_items();
        $template = "thanhvien/items";
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
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_member SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=thanhvien&act=man");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_member SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("default.php?com=thanhvien&act=man");		
		}
		
		/* if($multi=='del'){
			for($i=0;$i<$count;$i++){
				
				$sql = "select id,thumb, photo from #_about where id= ".$id_array[$i]."";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_tintuc.$row['photo']);
						delete_file(_upload_tintuc.$row['thumb']);			
					}
				}
				$sql = "delete from table_about where id = ".$id_array[$i]."";
				
				if(mysql_query($sql)){
					
					
				}
							
			}
			redirect("default.php?com=about&act=man&type=".$type);			
		} */
		
		
	}
    $sql = "select * from #_member";
    if ((int) $_REQUEST['id_cat'] != '') {
        $sql.=" and  	id_item=" . $_REQUEST['id_item'] . "";
    }
    $sql.=" order by stt,id desc";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=thanhvien&act=man";
    $maxR = 20;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}


function delete_item() {
    global $d,$type;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);

        $d->reset();
        $sql = "select * from #_member where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_tintuc . $row['photo']);
                delete_file(_upload_tintuc . $row['thumb']);
            }
            $sql = "delete from #_member where id='" . $id . "'";
            $d->query($sql);
        }

        if ($d->query($sql))
            redirect("default.php?com=thanhvien&act=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=thanhvien&act=man");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=thanhvien&act=man");
}

?>