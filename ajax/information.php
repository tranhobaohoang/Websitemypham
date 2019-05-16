<?php
include ("configajax.php");

$act=$_REQUEST['act'];
//dump($_POST);
switch ($act){
	case "thongtinuser":
		capnhat_user();
		break;
	case "addfriend":
		add_friend();
		break;
	case "answer":
		answer();
		break;
	case "check-binhluan":
		checkbinhluan();
		break;
}
function checkbinhluan(){
	global $d;
	$username=$_POST['user'];
	$d->reset();
	$sql="select * from #_member where username='".$username."' and trangthai=1 ";
	$d->query($sql);
	$result=$d->result_array();

	if($d->num_rows()==0){
		$rs["thongbao"]="Bạn cần đăng nhập trước khi bình luận / <a href='http://".$config_url."/dang-nhap.html'>Đăng nhập</a>";
		$rs["result"]=0;
	}else{
		$rs["result"]=1;
	}
	echo json_encode($rs);
}
function answer(){
	global $d;
	$id=$_POST['id'];
	$d->query("select * from #_add_friend where id='".$id."' ");
	$row=$d->fetch_array();
	
	$d->query("select * from #_member where username='".$row['username1']."' ");
	$rs_user=$d->fetch_array();
	
	$action=$_POST['action'];
	if($action=='yes'){
		$data['active']=1;
		$data['reader']=1;
		$d->setTable("add_friend");
		$d->update($data);
		
		$rs['id']=md5($id);
		$rs['mes']="Bạn và ".$rs_user['ten_vi']." đã trở thành bạn của nhau.";
	}else{
		$sql="delete from #_add_friend where id='".$id."' ";
		$d->query($sql);
		
		$rs['id']=md5($id);
		$rs['mes']="Bạn đã hủy yêu cầu kết bạn.";
	}
	echo json_encode($rs);
}
function capnhat_user(){
	global $d;
	$arr=$_POST['arr'];
	$id=$_POST['id'];
	foreach($arr as $v){
		$data[$v["name"]]=$v['val'];
	}
	$d->setTable("member");
	$d->setWhere("email",$_SESSION['login_web']['username']);
	if($d->update($data)){
		$res['thongbao']="Cập nhật thông tin thành công!";
		$res['check']='1';
		$res['id']=$id;
	}else{
		$res['thongbao']="Cập nhật thông tin thất bại!";
		$res['check']='0';
		$res['id']=$id;
	}
	echo json_encode($res);
}
function add_friend(){
	global $d;
	
	$action=$_POST['action'];
	$from_user=$_POST['from_user'];
	$to_user=$_POST['to_user'];
	
	$d->reset();
	$sql="select * from #_add_friend where username1='".$from_user."' and username2='".$to_user."' and active=0 ";
	$d->query($sql);
	$rs=$d->result_array();
	
	$d->reset();
	$sql="select * from #_member where username='".$from_user."' ";
	$d->query($sql);
	$rs_user=$d->fetch_array();
	
	$d->reset();
	$sql="select * from #_member where username='".$to_user."' ";
	$d->query($sql);
	$rs_user1=$d->fetch_array();
	
	if(count($rs)>0){
		$sql="delete from #_add_friend where id='".$rs[0]['id']."' ";
		$d->query($sql);
		
		$thongbao='Kết bạn';
	}else {
		$data['username1']=$from_user;
		$data['username2']=$to_user;
		$data['active']=0;
		$data['reader']=0;
		$data['messend']=$rs_user['ten_vi']." đã gửi cho bạn một lời mời kết bạn";
		$d->setTable("add_friend");
		$d->insert($data);
		$thongbao='Đã gửi lời kết bạn';
	}
	echo $thongbao;
}
?>