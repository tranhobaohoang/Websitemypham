<?php
/**
 * 123Pay Merchant Service
 * @package		miservice
 * @subpackage 	notify.php
 * @copyright	Copyright (c) 2012 VNG
 * @version 	1.0
 * @author 		quannd3@vng.com.vn (live support; zingchat:kibac2001, yahoo:kibac2001, Tel:0904904402)
 * @created 	01/10/2012
 * @modified 	05/10/2012
 */
//this sample code use both GET and POST method
//You can modify to use one that you like
/*$url =  getCurrentPageUrl();
	$list = explode("?",$url);
	$list_url = explode("&",$list[1]);
	$url = array();
	
	foreach($list_url as $k=>$v){
		$md = explode("=",$v);
		$url[$md[0]] = $md[1];
		
	}
	$mTransactionID = $url['mTransactionID'];
//$mTransactionID = $_REQUEST['mTransactionID'];
$bankCode = $url['bankCode'];
$transactionStatus =  $url['transactionStatus'];
$description = $url['description'];
$ts = $url['ts'];
$checksum = $url['checksum'];*/

$mTransactionID = $_REQUEST['mTransactionID'];
$bankCode = $_REQUEST['bankCode'];
$transactionStatus = $_REQUEST['transactionStatus'];
$description = $_REQUEST['description'];
$ts = $_REQUEST['ts'];
$checksum = $_REQUEST['checksum'];
$sMySecretkey = 'GIUPMUACOMoZn4Zjdu5Jjs';//key use to hash checksum that will be provided by 123Pay
$sRawMyCheckSum = $mTransactionID.$bankCode.$transactionStatus.$ts.$sMySecretkey;
$sMyCheckSum = sha1($sRawMyCheckSum);
if($sMyCheckSum != $checksum)
{
	 response($mTransactionID, '-1', $sMySecretkey);
}
$iCurrentTS = time();
$iTotalSecond = $iCurrentTS - $ts;

$iLimitSecond = 300;//5 min = 5*60 = 300

$processResult = process($mTransactionID, $bankCode, $transactionStatus);
response($mTransactionID, $processResult, $sMySecretkey);


/*===============================Function region=======================================*/
function process($mTransactionID, $bankCode, $transactionStatus)
{
	global $d;
	
	try
	{
		$sqls="select trangthai from table_donhang where transaction='".$mTransactionID."'";
		$d->query($sqls);
		$info=$d->fetch_array();
		if(isset($info['trangthai']) && $info['trangthai']==1)
			return 2;
		//do you update order status process
		if($transactionStatus==1){
			$sqls="select matin from #_donhang where transaction='".$mTransactionID."'";
			$d->query($sqls);
			$donhang=$d->fetch_array();
			
			
					
			$sql = "UPDATE table_donhang SET trangthai=1 where transaction='".$mTransactionID."'";	
					mysql_query($sql) or die(mysql_error());
					
			
		}
		return 1;
		
	}
	catch(Exception $_e)
	{
		return -3;	
	}
}
function response($mTransactionID, $returnCode, $key)
{
	$ts = time();
	$sRawMyCheckSum = $mTransactionID.$returnCode.$ts.$key;
	$checksum = sha1($sRawMyCheckSum);
	$aData = array(
		'mTransactionID' => $mTransactionID,
		'returnCode' => $returnCode,
		'ts' => time(),
		'checksum' => $checksum
	);
	
	echo json_encode($aData);
	exit;
}

/*===============================End Function region=======================================*/
?>