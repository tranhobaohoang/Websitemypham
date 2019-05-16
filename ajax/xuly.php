<?php

include ("configajax.php");

$act = $_REQUEST['act'];
switch ($act) {
    case "comment":
        comment();
        break;
	case "step1":
        step1();
        break;
	case "load-quan":
        loadquan();
        break;
	case 'answer_comment':
		answer_comment();
		break;
    
}
function answer_comment(){
	global $d;
	
	$ten=$_POST['hoten'];
	$email=$_POST['email'];
	$noidung=$_POST['noidung'];
	
	$ten = trim(strip_tags($ten));
	$noidung = trim(strip_tags($noidung));
	
	$ngaytao=time();
	$data['hoten']=$ten;
	$data['noidung']=$noidung;
	$data['email']=$email;
	$data['active']=1;
	$data["id_parent"]=$_POST["id_parent"];
	$data["ngaytao"]=$ngaytao;
	
	$d->reset();
	$d->setTable("comment");
	if($d->insert($data)){
		$id=$d->insert_id;
		$d->reset();
		$sql="select * from #_comment where id='".$id."'";
		$d->query($sql);
		$v1=$d->fetch_array();
		$kq='<div class="result_comment" id="'.md5($v1["id"]).'">
				<div class="content_comment">
					<div class="name"><span>'.$v1['hoten'].'</span> - '.date("h:i:s d/m/Y",$v1["ngaytao"]).'</div>';
					
					$kq.='<div class="noidung">'.$v1['noidung'].'</div>
				</div>
			</div>';
			$rs["kq"]=$kq;
			$rs["stt"]=1;
	}else{
		$rs["stt"]=0;
	}
	echo json_encode($rs);
}
function comment() {
    global $config_url, $d,$row_setting;
	
    $ten = $_POST['hoten'];
    $email = $_POST['email'];
	$noidung = $_POST['noidung'];
	$id_sp = $_POST['id_sp'];


    //validate dữ liệu
    $sodt = trim(strip_tags($sodt));
    $ten = trim(strip_tags($ten));
    $email = trim(strip_tags($email));
    $tieude = trim(strip_tags($tieude));
	$noidung = trim(strip_tags($noidung));
    $_SESSION['email_reg'] = $email;

    $coloi = false;
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
        $coloi = true;
        $error_email = "Email không đúng định dạng <br>";
    }

    
    if ($ten == NULL) {
        $coloi = true;
        $error_ten = "Chưa nhập họ tên <br>";
    }

    if ($email == NULL) {
        $coloi = true;
        $error_email = "Chưa nhập địa chỉ email <br>";
    }
	if ($noidung == NULL) {
        $coloi = true;
        $error_username = "Chưa nhập nội dung bình luận <br>";
    }

    $thongbao = ' <div class="error_mess">' . $error_hoten . $error_username . $error_diachi . $error_sodt . '</div>';
	
    if ($coloi == FALSE) {
		$d->reset();
        $data["ngaytao"] = time();
		$data["hoten"]=$ten;
		$data["email"]=$email;
		$data["noidung"]=$noidung;
		$data["id_sp"]=$id_sp;
		$d->setTable("comment");
		if($d->insert($data)){
			$rs["id"]=1;
			$rs["thongbao"]="<span style='color:red;'>Cảm ơn bạn đã nhận xét sản phẩm này. Nhận xét của bạn sẽ được duyệt và đăng lên trong thời gian sớm nhất. </span>";
		}
		else{
			$rs["id"]=0;
			$rs["thongbao"]= "<span style='color:red;'>Nhận xét thất bại. </span>";
		}
    } else {
        $rs["id"]=0;
		$rs["thongbao"]= $thongbao;
    }
	echo json_encode($rs);
}
function step1(){
	global $d, $row_setting;
	
	$chon = $_POST['chon'];
	$username = $_POST['email'];
    $password = $_POST['pass'];
	if($chon==2){
		$_SESSION["thanhtoan"]["email"]=$username;
		$rs["id"]=1;
		$rs["thongbao"]="";
		$rs["url"]="thanh-toan.html";
	}else{
		/* $username = mysql_real_escape_string($username); */
		$matkhau = mysql_real_escape_string($matkhau);
		$sql = "select * from #_member where email='" . $username . "'";
		$d->query($sql);
		if ($d->num_rows() == 1) {
			$row = $d->fetch_array();
			if ($row['hienthi'] ==1) {
				if ($row['password'] == md5($password)) {
					$_SESSION[$login_name] = true;
					$_SESSION['login_web']['id'] = $row['id'];
					$_SESSION['login_web']['username'] = $row['email'];
					$_SESSION['login_web']['ten'] = $row['ten_vi'];
					$_SESSION['login_web']['com'] = $row['com'];
					$rs["id"]=1;
					$rs["thongbao"]="<span style='color:#f00;'>Đăng nhập thành công!. Hệ thống sẽ chuyển trang trong giây lát. </span>";
					$rs["url"]="thanh-toan.html";
				} else{
					$rs["id"]=0;
					$rs["thongbao"]="<span style='color:#f00'>Mật khẩu đăng nhập chưa đúng.</span><a href='quen-mat-khau.html'>Quên mật khẩu</a>";
				}
			} else{
				$rs["id"]=0;
				$rs["thongbao"]="<span style='color:#f00'>" . _taikhoanchuakichhoat . "</span>";
			}
		} else{
			$rs["id"]=0;
			$rs["thongbao"]="<span style='color:#f00'>Tài khoản không tồn tại </span>";
		}
	}
	echo json_encode($rs);
}
function loadquan(){
	global $d;
	
	$province=$_REQUEST["id"];
	$district=$_REQUEST["idi"];
	
	$d->reset();
	$sql="select * from #_place_dist where id_city='".$province."' order by stt, id";
	$d->query($sql);
	$rs=$d->result_array();
	
	$data='<option value=""> -- Chọn quận huyên -- </option>';
	foreach($rs as $v){
		$data.='<option value="'.$v["id"].'"'; if($v["id"]==$district) $data.="selected";$data.= '>'.$v["ten"].'</option>';
	}
	
	echo $data;
}
?>