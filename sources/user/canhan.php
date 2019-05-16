<?php	if(!defined('_source')) die("Error");
	if($_SESSION['login_web']["username"]==''){
		transfer("Bạn chưa đăng nhập.", "dang-nhap.html");
	}
	$user=$_SESSION['login_web']["username"];
	
	$d->reset();
	$sql="select * from #_member where email='".$user."' ";
	$d->query($sql);
	$rs_user=$d->fetch_array();

	
	$d->reset();
	$sql="select * from #_place_city order by stt, id";
	$d->query($sql);
	$rs_p=$d->result_array();
	
	if($rs_user['province']!=''){ $whe=$rs_user['province'];}else{ $whe=$province;}
	$d->reset();
	$sql="select * from #_place_dist where id_city='".$whe."' order by stt, id";
	$d->query($sql);
	$rs_d=$d->result_array();
	
	if($rs_user['hometown_pro']!=''){ $whe=$rs_user['hometown_pro'];}else{ $whe=$province;}
	$d->reset();
	$sql="select * from #_place_dist where id_city='".$whe."' order by stt, id";
	$d->query($sql);
	$rs_d1=$d->result_array();
	
	if(!empty($_POST)){
		$data["ten_vi"]=$_POST["ten_vi"];
		$data["gioitinh"]=$_POST["sex"];
		$ngaysinh = $_POST['ngaysinh'];
		$Ngay_arr = explode("-", $ngaysinh); // array(17,11,2010)
		if (count($Ngay_arr) == 3) {
			$thang = $Ngay_arr[1]; //17
			$ngay = $Ngay_arr[2]; //11
			$nam = $Ngay_arr[0]; //2010
			if (checkdate($thang, $ngay, $nam) == false) {
				$coloi = true;
				$error_ngaysinh = "Bạn nhập chưa đúng ngày cấp<br>";
			} else
				$ngaycap = $thang . "/" . $ngay . "/" . $nam;
		}
		$data["ngaysinh"] = (int) strtotime($ngaycap);
		$data["province"]=$_POST["province"];
		$data["district"]=$_POST["district"];
		$data["diachi"]=$_POST["diachi"];
		$data["dienthoai"]=$_POST["dienthoai"];
		if($_POST["password"]!=''){
			$data["password"]=md5($_POST["password"]);
			$data["old_password"]=$_POST["password"];
		}
		$d->reset();
		$d->setTable("member");
		$d->setWhere("email",$_POST["email"]);
		if($d->update($data)){
			transfer("Cập nhật thông tin thành công.", getCurrentPageURL());
		}else{
			transfer("Cập nhật thất bại.", getCurrentPageURL());
		}
	}
	
?>