<?php	if(!defined('_source')) die("Error");
	$user=$_REQUEST['user'];
	
	$d->reset();
	$sql="select * from #_member where username='".$user."' ";
	$d->query($sql);
	$rs_user=$d->fetch_array();
	
	//Xét thông tin kết bạn
	$d->reset();
	$sql="select * from #_add_friend where (username1='".$_SESSION['login_web']['username']."' and username2='".$user."') or (username2='".$_SESSION['login_web']['username']."' and username1='".$user."') ";
	$d->query($sql);
	$rs_check_friend=$d->result_array();
	
	
	//Tin nhắn mới
	$d->reset();
	$sql="select * from #_add_friend where username2='".$user."' and reader=0 ";
	$d->query($sql);
	$rs_messend=$d->result_array();
	
	$d->reset();
	$sql="select * from #_province order by provinceid";
	$d->query($sql);
	$rs_p=$d->result_array();
	
	if($rs_user['province']!=''){ $whe=$rs_user['province'];}else{ $whe=$province;}
	$d->reset();
	$sql="select * from #_district where provinceid='".$whe."' order by districtid";
	$d->query($sql);
	$rs_d=$d->result_array();
	
	if($rs_user['hometown_pro']!=''){ $whe=$rs_user['hometown_pro'];}else{ $whe=$province;}
	$d->reset();
	$sql="select * from #_district where provinceid='".$whe."' order by districtid";
	$d->query($sql);
	$rs_d1=$d->result_array();
	
	
?>