<script type="text/javascript" src="admin/media/scripts/my_script.js"></script>
<?php
include_once 'mi_samplecode/rest.client.class.php';
include_once 'mi_samplecode/common.class.php';
function createUniqueOrderId($orderIdPrefix)
{
	return $orderIdPrefix.time();
}
$mTransactionID = $_SESSION['iddonhang'];
$orderIdPrefix = 'THOITRANGXAOMINH';

$result = null;
$resultMessage = '';
if($_POST)
{
	$mTransactionID=$_POST['mTransactionID'];
	$resultMessage = 'Current order id: <strong>'.$mTransactionID.'</strong><br>';
	$aData = array
	(
		'mTransactionID' => $mTransactionID,
		'merchantCode' =>$_POST['merchantCode'],
		'bankCode' =>$_POST['bankCode'],
		'totalAmount' =>$_POST['totalAmount'],
		'clientIP' =>$_POST['clientIP'],
		'custName' =>$_POST['custName'],
		'custAddress' =>$_POST['custAddress'],
		'custGender' =>$_POST['custGender'],
		'custDOB' =>$_POST['custDOB'],
		'custPhone' =>$_POST['custPhone'],
		'custMail' =>$_POST['custMail'],
		'description' =>$_POST['description'],
		'cancelURL' => $_POST['cancelURL'],
        'redirectURL' => $_POST['redirectURL'],
        'errorURL' => $_POST['errorURL'],
		'passcode' =>$_POST['passcode'],
		'checksum' =>'',
		'addInfo' =>''
	);
	
	$aConfig = array
	(
		'url'=>$row_setting['url123'],
		'key'=>$row_setting['key123'],
		'passcode'=>$row_setting['pas123'],
		'cancelURL' => 'http://'.$config_url.'/success123.html',
        'redirectURL' => 'http://'.$config_url.'/success123.html',
        'errorURL' => 'http://'.$config_url.'/success123.html',
	);
	
	try
	{
		$data = Common::callRest($aConfig, $aData);//call 123Pay service
		$result = $data->return;
		if($result['httpcode'] ==  200)
		{
			//call service success do success flow
			if($result[0]=='1')//service return success
			{
				//re-create checksum
				$rawReturnValue = '1'.$result[1].$result[2];
				$reCalChecksumValue = sha1($rawReturnValue.$aConfig['key']);
				if($reCalChecksumValue == $result[3])//check checksum
				{
					redirect($result[2]);
					$resultMessage .= 'Call service result:<hr>';
					$resultMessage .=  'mTransactionID='.$mTransactionID.'<br>';
					$resultMessage .=  '123PayTransactionID='.$result[1].'<br>';
					$resultMessage .=  'URL='.$result[2].'<br>';
					//call php header to redirect to input card page
					$resultMessage .= '<a style="color:red;font-weight:bold;" href="'.$result[2].'" target="_parent">Click here to go to payment process</a><br>';
				}else
				{
					//Call 123Pay service create order fail, return checksum is invalid
					$resultMessage .=  'Return data is invalid<br>';
				}
			}else{
				//Call 123Pay service create order fail, please refer to API document to understand error code list
				//$result[0]=error code, $result[1] = error description
				$resultMessage .=  $result[0].': '.$result[1];
			}
		}else{
			//call service fail, do error flow
			$resultMessage .=  'Chuyển đến trang thanh toán 123pay thất bại. Bạn vui lòng kiểm tra lại kết nối internet của mình<br>';
		}
	}catch(Exception $e)
	{
		$resultMessage .=  '<pre>';
		$resultMessage .= $e->getMessage();
	}
	//create new orderid
}
$mTransactionID = createUniqueOrderId($orderIdPrefix);
?>
<div class="box_content box-shadow">
	<div class="tcat"><div class="icon"><?=_thanhtoan?></div></div>
    <div class="content">
        <div class="content-donhang">
        <form method="post" name="frm" class="forms" action="" onsubmit="return onSubmit();">
        	<input type="hidden" name="mTransactionID" size="20" value="<?php echo $mTransactionID ?>">
            <input type="hidden" name="merchantCode" size="20" value="THOITRANGXAOMINH" >
            <input type="hidden" name="totalAmount" size="20" value="<?=$donhang['tonggia']?>" >
            <input type="hidden" name="clientIP" size="20" value="<?=$_SERVER['REMOTE_ADDR']?>" >
            <input type="hidden" name="custGender" size="20" value="M" >
            <input type="hidden" name="custDOB" size="20" value="20/10/1982" >
            <input type="hidden" name="description" size="20" value="thanh toan don hang <?=$donhang['madonhang']?>" >
            <input type="hidden" name="cancelURL" size="1000" value="http://<?=$config_url?>/success123.html" >
            <input type="hidden" name="redirectURL" size="1000" value="http://<?=$config_url?>/success123.html" >
            <input type="hidden" name="errorURL" size="1000" value="http://<?=$config_url?>/success123.html" >
            <input type="hidden" name="passcode" size="20" value="<?=$row_setting['pass123']?>" >    
            <div class="tbl-contact">
                <div class="row pad-contact">
                    <div class="col-md-4 col-sm-4 col-xs-12"><?=_hovaten?><span>*</span></div>
                    <div class="col-md-8 col-sm-8 col-xs-12"><input value="<?=$donhang['hoten']?>" disabled type="text" class="form-control" name="custName" id="ten" placeholder="<?=_hovaten?>" required oninvalid="this.setCustomValidity('Nhập họ tên của bạn')" oninput="setCustomValidity('')"></div>
            </div>                        
                <div class="row pad-contact">
                    <div class="col-md-4 col-sm-4 col-xs-12"><?=_diachi?><span>*</span></div>
                    <div class="col-md-8 col-sm-8 col-xs-12"><input value="<?=$donhang['diachi']?>" disabled type="text" class="form-control" name="custAddress" id="diachi" placeholder="<?=_diachi?>" required oninvalid="this.setCustomValidity('Nhập địa chỉ của bạn')" oninput="setCustomValidity('')"></div>
                </div>
                <div class="row pad-contact">
                    <div class="col-md-4 col-sm-4 col-xs-12"><?=_sodienthoai?><span>*</span></div>
                    <div class="col-md-8 col-sm-8 col-xs-12"><input class="form-control" value="<?=$donhang['dienthoai']?>" disabled name="custPhone" id="dienthoai" placeholder="<?=_sodienthoai?>"  type="tel" pattern="[0][0-9]{9,10}" min="10" max="13" required oninvalid="this.setCustomValidity('Nhập điện thoại của bạn')" oninput="setCustomValidity('')"></div>
                </div>
                <div class="row pad-contact">
                    <div class="col-md-4 col-sm-4 col-xs-12">Email<span>*</span></div>
                    <div class="col-md-8 col-sm-8 col-xs-12"><input type="email" class="form-control" value="<?=$donhang['email']?>" disabled name="custMail" id="email" placeholder="Email" required oninvalid="this.setCustomValidity('Nhập email của bạn')" oninput="setCustomValidity('')"></div>
                </div>
                
                <div class="row pad-contact">
                    <div class="col-md-4 col-sm-4 col-xs-12"><?=_chonnganhang?>:<span>*</span></div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                    	<select name="bankCode" class="form-control" id="bank" style="width:100%">
                        	<option value="123PCC">Master Card, Visa Card, JCB</option>
                        	<option value="123PVCB">Ngân hàng Ngoại Thương Việt Nam (Vietcombank)</option>
                            <option value="123PDAB">Ngân hàng Đông Á (DAB)</option>
                            <option value="123PVTB">Ngân hàng Công Thương Việt Nam (Vietinbank)</option>
                            <option value="123PAGB">Ngân hàng Nông nghiệp và Phát triển Nông thôn Việt Nam (Agribank)</option>
                            <option value="123PTCB">Ngân hàng Kỹ Thương Việt Nam (Techcombank)</option>
                            <option value="123PEIB">Ngân hàng Xuất Nhập Khẩu Việt Nam (Eximbank)</option>
                            <option value="123PSCB">Ngân hàng Sài Gòn Thương Tín(Sacombank)</option>
                            <option value="123PVIB">Ngân hàng quốc tế (VIB)</option>
                            <option value="123PBIDV">Ngân hàng đầu tư và phát triển Việt Nam (BIDV)</option>
                            <option value="123PMB">Ngân hàng quân đội (MB)</option>
                            <option value="123PACB">Ngân hàng Á Châu (ACB)</option>
                            <option value="123PMRTB">Ngân hàng TMCP Hàng Hải(Maritime Bank)</option>
                            <option value="123PGPB">Ngân Hàng Dầu Khí Toàn Cầu (GPBank)</option>
                            <option value="123PHDB">Ngân Hàng TMCP Phát Triển TPHCM (HDBank)</option>
                            <option value="123PNVB">Ngân hàng TMCP Nam Việt(NaviBank)</option>
                            <option value="123PVAB">Ngân hàng TMCP Việt Á</option>
                            <option value="123PVPB">Ngân hàng Việt Nam Thịnh Vượng(VPBank)</option>
                            <option value="123POCEB">Ngân hàng TMCP Đại Dương(OceanBank)</option>
                            <option value="123PABB">Ngân hàng TMCP An Bình (ABB)</option>
                            <option value="123PNAB">Ngân hàng TMCP Nam Á (Nam A Bank)</option>
                            <option value="123PSGB">Ngân hàng TMCP Sài Gòn Công Thương (SaigonBank)</option>
                            <option value="123PPGB">Ngân hàng Dầu Khí(PG Bank)</option>
                            <option value="123POCB">Ngân hàng TMCP Phương Đông (OCB)</option>
                            
                        </select>
                    </div>
            </div>                                                 
                <div class="row pad-contact">
                    <div class="col-md-4 col-sm-4 col-xs-12"><?=_noidung?><span>*</span></div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea name="noidung" id="noidung" class="form-control" rows="3" required oninvalid="this.setCustomValidity('Nhập nội dung bạn muốn gửi')" oninput="setCustomValidity('')"></textarea>
                    </div>
                </div>
                <div class="row pad-contact">
                    <div class="col-md-4 col-sm-4 col-xs-12">&nbsp;</div>
                    <div class="col-md-8 col-sm-8 col-xs-12"> 
                        <button type="submit"  class="btn btn-default button" onclick="">
        <?=_thanhtoan?></button>
				
                        
                    </div>
                </div>
            </div>
    
        </form>
		</div>
        <hr>
        <div class="clear"></div>
    </div>
</div>
