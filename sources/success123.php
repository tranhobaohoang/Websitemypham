<?php
	include_once 'mi_samplecode/rest.client.class.php';
	include_once 'mi_samplecode/common.class.php';
	$url =  getCurrentPageUrl();
	$list = explode("?",$url);
	$list_url = explode("&",$list[1]);
	$url = array();
	foreach($list_url as $k=>$v){
		$md = explode("=",$v);
		$url[$md[0]] = $md[1];
		
	}
	$mTransactionID = $url['transactionID'];
	$aData = array
	(
		'mTransactionID' => $mTransactionID,
		'merchantCode' =>'THOITRANGXAOMINH',
		'clientIP' =>$_SERVER['REMOTE_ADDR'],
		'passcode' =>$row_setting['pass123'],
		'checksum' =>'',
	);
	$aConfig = array
	(
		'url'=><?=$row_setting['url123'],
		'key'=>$row_setting['key123'],
		'passcode'=>$row_setting['pass123'],
	);
	try
	{
		$data = Common::callRest($aConfig, $aData);
		$result = $data->return;
		if($result['httpcode'] ==  200)
		{
			if($result[0]=='1')
			{
				
				//echo 'Order info:<hr>';
				//echo 'mTransactionId:'.$transactionID.'<br>';
				//echo '123PayTransactionId: '.$result[1].'<br>';
				//echo 'Status: '.$result[2].'<br>';
				//echo 'Amount: '.$result[3].'<br>';
				//echo 'Bankcode: '.$result[5].'<br>';
				//dump($result);
			}else{
				echo 'Call service queryOrder fail. Please refer to API document to see error code list';
			}
		}else{
			//do error call service.
			echo 'Call service queryOrder fail. Please refer to API document to see error code list';
		}
	}catch(Exception $e)
	{
		echo '<pre>'; 
		print_r($e);
	}
	// 1 SUCCESS 
	// 11 CANCEL 
	
	
	if($result[2]==1){
		
		//check($_SESSION['iddonhang']); die;
		/*$d->query("select matin from #_donhang where id='".$_SESSION['iddonhang']."'");
		$donhang=$d->fetch_array();
		$sql1 = "UPDATE table_product SET thanhtoan=1 where masp='".$donhang['matin']."'";	
		//echo $sql1;
				mysql_query($sql1) or die(mysql_error());
				
		$sql = "UPDATE table_donhang SET trangthai=1 where id='".$_SESSION['iddonhang']."'";	
				mysql_query($sql) or die(mysql_error());
		
		*/
		$sql = "UPDATE table_donhang SET transaction='$mTransactionID' where id='".$_SESSION['iddonhang']."'";	
				mysql_query($sql) or die(mysql_error());
		$checksum = SHA1($mTransactionID.$result[5].$result[2].time()."MIKEY");
		redirect("http://".$config_url."/notify1/".$mTransactionID."/".$result[5]."/".$result[2]."/".$result[7]."/".time().".html");
		
	}
	else if($result[2]==20){
		redirect("http://".$config_url."/xu-ly.html");
	}
	else{
		transfer("Thanh toán thất bại","http://".$config_url."/thanh-toan.html");
		//redirect("http://".$config_url."/thanh-toan.html");
	}
	
	
	
	
	
			
	
?>