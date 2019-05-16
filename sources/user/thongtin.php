<?php	if(!defined('_source')) die("Error");
	if($_SESSION['login_web']["username"]==''){
		transfer("Bạn chưa đăng nhập.", "dang-nhap.html");
	}
	$user=$_SESSION['login_web']["username"];
	
	$d->reset();
	$sql="select * from #_member where username='".$user."' ";
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
		$data["province"]=$_POST["province"];
		$data["district"]=$_POST["district"];
		$data["dienthoai"]=$_POST["dienthoai"];
		$d->reset();
		$d->setTable("member");
		$d->setWhere("username",$user);
		if($d->update($data)){
			transfer("Cập nhật thông tin thành công.", getCurrentPageURL());
		}else{
			transfer("Cập nhật thất bại.", getCurrentPageURL());
		}
	}
	
?>