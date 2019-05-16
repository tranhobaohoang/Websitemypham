<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$d->reset();
$sql_setting = "select * from #_setting limit 0,1";
$d->query($sql_setting);
$row_setting = $d->fetch_array();

$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
$url_back=$_SERVER['HTTP_REFERER'];
$id=@$_REQUEST['id'];
switch($act){

	case "man":
		get_items();
		$template = "couple/items";
		break;
	case "add":		
		$template = "couple/item_add";
		break;
	case "edit":		
		get_item();
		$template = "couple/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	#=======================================================
	default:
		$template = "index";
}

#====================================
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}
function get_items(){
	global $d, $items, $paging, $url_back;
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_couple where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_couple SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_couple SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	redirect($url_back);
	}
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['noibat']!='')
	{
	$id_up = $_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_couple where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['noibat'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_couple SET noibat ='$time' WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_couple SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	redirect($url_back);
	}
	#-------------------------------------------------------------------------------
	
	$sql = "select * from #_couple";			
	$sql.=" order by id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="default.php?com=couple&act=man";
	$maxR=20;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item, $url_back;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $url_back);	
	$sql = "select * from #_couple where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $url_back);
	$item = $d->fetch_array();	
}

function save_item(){
	global $d, $url_back,$row_setting,$userhost, $host, $passhost;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "default.php?com=couple&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$data['couple_code'] = $_POST['couple_code'];
		$data['gia_vi'] = (int)$_POST['gia_vi'];
		$data['gia_en'] = (int)$_POST['gia_en'];
		$data['gia_ge'] = (int)$_POST['gia_ge'];
		$data['lansd'] = (int)$_POST['lansd'];
		$data['dadung'] = (int)$_POST['dadung'];
		$data['loai'] = (int)$_POST['loai'];
		$data['gtri'] = (int)$_POST['gtri'];
		$data['khuvuc'] = implode('|',$_POST['khuvuc']);
		if($_POST['thoigian']!=''){
			$data['thoigian'] = strtotime($_POST['thoigian']);
		}
		$data['vothoihan'] = isset($_POST['vothoihan']) ? 1 : 0;
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		$d->setTable('couple');
		$d->setWhere('id', $id);
		if($d->update($data)){
			if(isset($_POST['referer_link']))
				redirect($_POST['referer_link']);
			else
				redirect("default.php?com=couple&act=man&curPage=".$_REQUEST['curPage']."");
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=couple&act=man");
	}else{		
		$data['couple_code'] = $_SESSION['captcha_code'];
		$data['gia_vi'] = (int)$_POST['gia_vi'];
		$data['gia_en'] = (int)$_POST['gia_en'];
		$data['gia_ge'] = (int)$_POST['gia_ge'];
		$data['lansd'] = (int)$_POST['lansd'];
		$data['loai'] = (int)$_POST['loai'];
		$data['gtri'] = (int)$_POST['gtri'];
		$data['username'] = $_REQUEST['username'];
		$data['khuvuc'] = implode('|',$_POST['khuvuc']);
		if($_POST['thoigian']!=''){
			$data['thoigian'] = strtotime($_POST['thoigian']);
		}
		$data['vothoihan'] = isset($_POST['vothoihan']) ? 1 : 0;
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('couple');
		if($d->insert($data))
		{
			$d->reset();
			$sql="select * from #_donhang where id='".$_REQUEST["id_dh"]."'";
			$d->query($sql);
			$rs_dh=$d->fetch_array();
			
			$data1["ten"]=$rs_dh["hoten"];
			$data1["diachi"]=$rs_dh["diachi"];
			$data1["email"]=$rs_dh["email"];
			$data1["dienthoai"]=$rs_dh["dienthoai"];
			$data1["id_product"]=$rs_dh["id_product"];
			$data1["code"]=$rs_dh["code"];
			$data1["httt"]=$rs_dh["httt"];
			$data1["donhang"]=$rs_dh["donhang"];
			$data1["tonggia"]=$rs_dh["tonggia"];
			$data1["madh"]=$rs_dh["madonhang"];
			$data1["id_dh"]=$rs_dh["id"];
			$data1["username"]=$rs_dh["username"];
			$data1["ngaytao"]=time();
			$d->setTable("coupon");
			$d->insert($data1);
			
			$d->reset();
			$sql="select ten_vi from #_member where username='".$rs_dh["username"]."'";
			$d->query($sql);
			$rs_member=$d->fetch_array();
			
			$subject = "Code voucher từ website " . $row_setting['website'];
			$body = '<table>';
			$body .= '
						<tr>
							<th colspan="2">&nbsp;</th>
						</tr>
						<tr>
							<th colspan="2">Code voucher từ website ' . $row_setting['website'] . '</th>
						</tr>
						<tr>
							<th colspan="2">&nbsp;</th>
						</tr>
						<tr>
						'.$row_setting['website'].' chào bạn .<br />
						Bạn đã đăng ký mua coupon từ website '.$row_setting['website'].' .<br/>
						Mã coupon của bạn là:'.$_SESSION['captcha_code'].' sử dụng cho đến ngày '.$_POST["thoigian"].' tại '.$rs_member["ten_vi"].'.<br/>
						Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi<br />
						Mọi thắc mắc hoặc quan tâm về tài khoản, xin vui lòng liên hệ:<br />
						 
						'.$row_setting['website'].'<br />
						Địa Chỉ : '.$row_setting['diachi_vi'].'<br />
						Hotline : '.$row_setting['hotline'].' Email : '.$row_setting['email'].' Website : '.$row_setting['website'].'<br />
						Lưu ý: Đây chỉ là thư thông báo. Các hồi đáp lại thông báo này sẽ không được theo dõi hoặc giải đáp.<br />
					</tr>';
			$body .= '</table>';

			include_once "../phpmailer/class.phpmailer.php";
			//Khởi tạo đối tượng
			$mail = new PHPMailer();
			//Thiet lap thong tin nguoi gui va email nguoi gui
			$mail->IsSMTP(); // Gọi đến class xử lý SMTP
			$mail->SMTPAuth = true;                  // Sử dụng đăng nhập vào account
			$mail->Host = $host;     // Thiết lập thông tin của SMPT
			$mail->Username = $userhost; // SMTP account username
			$mail->Password = $passhost;            // SMTP account password
			$mail->SetFrom($userhost, $row_setting['title_vi']);
			//Thiết lập thông tin người nhận
			$mail->AddAddress($rs_dh["email"], $rs_dh["hoten"]);
			$mail->AddBCC($email);

			//Thiết lập email nhận email hồi đáp
			//nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($userhost, $row_setting['title_vi']);


			/* =====================================
			 * THIET LAP NOI DUNG EMAIL
			 * ===================================== */

			//Thiết lập tiêu đề
			$mail->Subject = "Thông tin liên hệ";

			//Thiết lập định dạng font chữ
			$mail->CharSet = "utf-8";

			$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

			//Thiết lập nội dung chính của email
			$mail->MsgHTML($body);

			if (!$mail->Send()) {
				transfer("Có lỗi xảy ra!", "default.php?com=couple&act=man");
			} else {
				$data2["active"]=1;
				$d->setTable("donhang_coupon");
				$d->setWhere("id",$rs_dh["id"]);
				$d->update($data2);
				unset($_SESSION["captcha_code"]);
				transfer("Gửi coupon cho khách hàng và doanh nghiệp thành công!<br/>", "default.php?com=order&act=man");
			}
			
			redirect("default.php?com=couple&act=man");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "default.php?com=couple&act=man");
	}
}

function delete_item(){
	global $d, $url_back;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$sql = "delete from #_couple where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
			redirect($url_back);
		else
			transfer("Xóa dữ liệu bị lỗi", $url_back);
	}else if(isset($_GET['listid'])){
		$listid = explode(",",$_GET['listid']);
		foreach($listid as $listid_item){
			$d->reset();
			$d->setTable('couple');
			$d->setWhere('id', $listid_item);
			$d->delete();
		}
		redirect($url_back);
	}else transfer("Không nhận được dữ liệu", $url_back);
}
?>