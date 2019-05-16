<?php

$d->reset();
$sql = "select * from #_setting limit 0,1";
$d->query($sql);
$row_setting = $d->fetch_array();
function get_province1($province){
	global $d;
	$d->reset();
	$sql="select * from #_place_city where id='".$province."'";
	$d->query($sql);
	$rs_pro=$d->fetch_array();
	
	return $rs_pro['ten'];
}
function get_district1($province){
	global $d;
	$d->reset();
	$sql="select * from #_place_dist where id='".$province."'";
	$d->query($sql);
	$rs_dis=$d->fetch_array();
	
	return $rs_dis['ten'];
}

    if (isset($_POST['continue'])) {
		
        $mahoadon = strtoupper(ChuoiNgauNhien(6));
        $ngaytao = time();
        $tonggia = get_order_total();
        $hoten = $_POST['hoten'];
		$hotennhan = $_POST['hotennhan'];
        $dienthoai = $_POST['dienthoai'];
		$dienthoainhan = $_POST['dienthoainhan'];
        $diachi = $_POST['diachi'].', '. get_district1($_POST['district_chon']).', '. get_province1($_POST['province_chon']);
		$diachinhan = $_POST['diachinhan'].', '. get_district1($_POST['district_nhan']).', '. get_province1($_POST['province_nhan']);
        $email = $_POST['email'];
        $noidung = $_POST['noidung'];
        $httt = $_POST['hinhthuc'];
		//Trường hợp dùng mã coupon
        if($_SESSION["couple"]["gia_vi"]!=''){
			// Đơn hàng
			$donhang.='<div class="table-responsive">';
			$donhang.='<table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:13px;" width="100%">';

			if (is_array($_SESSION['cart'])) {
				$max = count($_SESSION['cart']);
				for ($i = 0; $i < $max; $i++) {
					if($_SESSION['cart'][$i]['user']==$user){
						$donhang.='<tr  style="font-weight:bold;color:#111;font-weight:bold">
								<th style="border-left: none; text-align:left; padding-left: 40px; text-transform:uppercase;">Sản phẩm</th>
								<th align="center" style="text-transform:uppercase;">Số lượng</th>
								<th align="center" style="text-transform:uppercase;">Đơn giá</th>

								<th align="center" style="text-transform:uppercase;">Thành tiền</th>

								</tr>';
						$max1=count($_SESSION['cart'][$i]['product']);
						for($j=0;$j<$max1;$j++){
							$pid = $_SESSION['cart'][$i]['productid'];
							$q = $_SESSION['cart'][$i]['qty'];
							$pname = get_product_name($pid);
							if($q==0) continue;
							
							$donhang.='<tr>
									<td width="30%" style="border-left:none; text-align:left">
										<span><img src="http://'.$config_url.'/'._upload_product_l . get_product_image($pid) .'" width="70px" alt="'. $pname .'" /> '. $pname.'</span>
									</td>
									<td width="10%" align="center">'.$q.'</td>                  
									<td width="10%" align="center">'. number_format(get_price($pid, $size), 0, ',', '.') .'&nbsp;VNĐ</td>

									<td width="10%" align="center" class="price_tt">'. number_format(get_price($pid, $size) * $q, 0, ',', '.') .'&nbsp;VNĐ</td>

								</tr>';
						}
						$donhang.='<tr><td colspan="4"><b>Tổng giá bán:</b> <span>' . number_format(get_order_total(), 0, ',', '.') . '&nbsp;VNĐ</span></td></tr>';
						$donhang.='<tr><td colspan="4"><b><b>Khuyến mãi: </b><span>' . $_SESSION['couple']['gia'] . '&nbsp;VNĐ</span></td></tr>';
						$donhang.='<tr><td colspan="4"><b>Thanh toán:</b> <span id="total_tr">' . number_format($_SESSION['couple']['total'],"0",",",".") . ' VNĐ</span></td></tr>';
					}
					$donhang.='</table> 
					</div>';
					
				}
			}
			// trường hợp không dùng mã coupon
		}else{
			// thiết lập Đơn hàng
			$donhang.='<div class="table-responsive">';
			$donhang.='<table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:13px;" width="100%">';

			if (is_array($_SESSION['cart'])) {
				$donhang.='<tr bgcolor="#4094CF" style="font-weight:bold;color:#FFF">
								<th align="center">STT</th>
								<th>Tên</th>
								<th align="center">Hình ảnh</th>
								<th align="center">Giá</th>
								<th align="center">Số lượng</th>
								<th align="center">Tổng giá</th>
							</tr>';
				$max = count($_SESSION['cart']);
				for ($i = 0; $i < $max; $i++) {
					$pid = $_SESSION['cart'][$i]['productid'];
					$q = $_SESSION['cart'][$i]['qty'];
					$pname = get_product_name($pid);

					if ($q == 0)
						continue;
					$donhang.='<tr';
					if (($i + 1) % 2 == 0) {
						$donhang.=' style="background:rgba(5, 194, 117, 0.61);">';
					} else {
						$donhang.=' style="background:#fff;">';
					}
					$donhang.='<td width="10%" align="center">' . ($i + 1) . '</td>';

					$donhang.='<td width="30%">' . $pname;
					$donhang.='</td>';
					$donhang.='<td width="20%"><img src="' . _upload_product . get_product_image($pid) . '" width="70px"/>';
					$donhang.='</td>';
					$donhang.='<td width="10%">' . number_format(get_price($pid), 0, ',', '.') . '&nbsp;VNĐ</td>';
					$donhang.='<td width="10%">' . $q . '</td>';
					$donhang.='<td width="20%">' . number_format(get_price($pid) * $q, 0, ',', '.') . '&nbsp;VNĐ</td>
							</tr>
							<br/>';
				}
			} else {
				$donhang.='<tr bgColor="#FFFFFF"><td>Không có sản phẩm nào trong giỏ hàng!</td>';
			}

			$donhang.='</table> </div>'; 
			$donhang.='<div class="total-order">
							<strong>Thanh toán:</strong>
							<span id="total_tr">' . number_format((get_order_total())) . ' VNĐ</span>
							<div class="clear"></div>
						</div>
					</div>';
		}
		
        /* if ($httt == 'thanh-toan-bao-kim') {  //thanh toán qua Bảo Kim
			
            $tinhtrang = 7;
            $hinhthuc = 'Bảo Kim';

            include _source . "BaoKimPayment.php";
            $bk = new BaoKimPayment;
            $order_id = $mahoadon;
            $business = $row_setting['email'];
            $total_amount = $tonggia;
            $shipping_fee = 0;
            $tax_fee = 0;
            $order_description = 'Thanh toán đơn hàng ' . $mahoadon;

            function curPageURL() {
                $pageURL = 'http';
                if ($_SERVER["HTTPS"] == "on") {
                    $pageURL .= "s";
                }
                $pageURL .= "://";
                if ($_SERVER["SERVER_PORT"] != "80") {
                    $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/complete.html';
                } else {
                    $pageURL .= $_SERVER["SERVER_NAME"] . '/complete.html';
                }
                return $pageURL;
            }

            $file_xl_succ = curPageURL();


            $url_success = $file_xl_succ;
            $url_cancel = 'http://' . $config_url . '/index.html';
            $url_detail == '';

            // Thêm vào CSDL
            $sql = "INSERT INTO  table_donhang (madonhang,hoten,dienthoai,diachi,email,httt,tonggia,noidung,donhang,ngaytao,trangthai,noinhan, loaithanhtoan, dienthoainhan, tennhan ) 
			  VALUES ('$mahoadon','$hoten','$dienthoai','$diachi','$email','2','$tonggia','$noidung','$donhang','$ngaytao','1','$diachinhan','0','$dienthoainhan','$hotennhan')";
            mysql_query($sql) or die(mysql_error());
            $iduser = mysql_insert_id();

            unset($_SESSION['cart']);
            $url = $bk->createRequestUrl($order_id, $business, $total_amount, $shipping_fee, $tax_fee, $order_description, $url_success, $url_cancel, $url_detail);
            echo "<script>window.location.href = '$url';</script>";
        } else if ($httt == 'thanh-toan-ngan-luong') {
            //thanh toán qua ngân lượng
            include _source . "nganluong.php";
            $nl = new NL_Checkout();

            function curPageURL() {
                $pageURL = 'http';
                if ($_SERVER["HTTPS"] == "on") {
                    $pageURL .= "s";
                }
                $pageURL .= "://";
                if ($_SERVER["SERVER_PORT"] != "80") {
                    $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/complete-nl.html';
                } else {
                    $pageURL .= $_SERVER["SERVER_NAME"] . '/complete-nl.html';
                }
                return $pageURL;
            }

            $return_url = curPageURL();
            $receiver = $row_setting['email'];
            $transaction_info = 'Thanh toán đơn hàng ' . $mahoadon;
            $order_code = $mahoadon;
            $price = $tonggia;

            // Thêm vào CSDL
            $sql = "INSERT INTO  table_donhang (madonhang,hoten,dienthoai,diachi,email,httt,tonggia,noidung,donhang,ngaytao,trangthai,noinhan, loaithanhtoan, dienthoainhan, tennhan ) 
			  VALUES ('$mahoadon','$hoten','$dienthoai','$diachi','$email','2','$tonggia','$noidung','$donhang','$ngaytao','1','$diachinhan','0','$dienthoainhan','$hotennhan')";
            mysql_query($sql) or die(mysql_error());
            $iduser = mysql_insert_id();

            //unset($_SESSION['cart']);

            $url = $nl->buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price);

            echo "<script>window.location.href = '$url';</script>";
        }else if($httt=='thanh-toan-paypal'){
			if(isset($_POST['PAY'])){
				$md5 = session_id();
				$query = '?';
				$i=0;
				foreach($_POST['PAY'] as $k=>$v){
					$query.=$k.'='.$v;
					$i++;		
					if($i < (count($_POST['PAY']))-1){
						$query.='&';
					}

				}
			}
			// Thêm vào CSDL
            $sql = "INSERT INTO  table_donhang (madonhang,hoten,dienthoai,diachi,email,httt,tonggia,noidung,donhang,ngaytao,trangthai,noinhan, loaithanhtoan, dienthoainhan, tennhan ) 
			  VALUES ('$mahoadon','$hoten','$dienthoai','$diachi','$email','2','$tonggia','$noidung','$donhang','$ngaytao','1','$diachinhan','0','$dienthoainhan','$hotennhan')";
            mysql_query($sql) or die(mysql_error());
            $iduser = mysql_insert_id();
			$_SESSION['iddonhang']=$iduser;
			$url='thanh-toan-banking.html';
			redirect("http://www.paypal.com/cgi-bin/webscr".$query);
		}
		else { */


			$sql = "INSERT INTO  table_donhang (madonhang,hoten,dienthoai,diachi,email,httt,tonggia,noidung,donhang,ngaytao,trangthai,noinhan, loaithanhtoan, dienthoainhan, tennhan ) 
				  VALUES ('$mahoadon','$hoten','$dienthoai','$diachi','$email','$httt','$tonggia','$noidung','$donhang','$ngaytao','1','$diachinhan','0','$dienthoainhan','$hotennhan')";
				
				mysql_query($sql) or die(mysql_error());


			if(!empty($_SESSION['login_web'])) {
				$sql = "INSERT INTO  table_donhang (madonhang,hoten,dienthoai,diachi,email,httt,tonggia,noidung,donhang,ngaytao,trangthai,noinhan, loaithanhtoan, dienthoainhan, tennhan,id_dangnhap ) 
				  VALUES ('$mahoadon','$hoten','$dienthoai','$diachi','$email','$httt','$tonggia','$noidung','$donhang','$ngaytao','1','$diachinhan','0','$dienthoainhan','$hotennhan', '".$_SESSION["login_web"]["id"]."')";
				
				mysql_query($sql) or die(mysql_error());
			}
			 //Thêm vào đơn hàng chi tiết
			$iduser = mysql_insert_id();
			$max = count($_SESSION['cart']);
			for ($i = 0; $i < $max; $i++) {
				$pid = $_SESSION['cart'][$i]['productid'];
				$q = $_SESSION['cart'][$i]['qty'];
				$data["ngaytao"] = time();
				$data["id_sp"]=$pid;
				$data["soluong"]=$q;
				$data["id_dh"]=$iduser;
				$d->reset();
				$d->setTable("dhct");
				$d->insert($data);
			}
            $d->query("select * from #_donhang where id='" . $iduser . "'");
            $rs_order = $d->fetch_array();

			/* //update điểm công cho khách hàng
			if($_SESSION["login_web"]["username"]){
				if($_SESSION["shipping"]>0){
					$diem=(get_order_total_percent()-$_SESSION["shipping"])/10000;
				}else{
					$diem=get_order_total()/10000;
				}
				$sql_update="update table_member set rate=rate+$diem where id='".$_SESSION["login_web"]["id"]."'";
				mysql_query($sql_update) or die(mysql_error());
			} */
            require_once ("phpmailer/class.phpmailer.php");
            $subject = "đặt hàng tại $row_setting[website]";
            //thiết lập thư gửi
            $body = '
			Cảm ơn quý khách đã đặt hàng dưới đây là thông tin đơn hàng của quý khách:<br />
			<b>Order ID: <span style="color: #f00">'.$mahoadon.'</span></b>
			<div style="width:50%; float: left">
				<b>Thông tin đặt hàng</b><br />
				Họ tên: <b>'.$hoten.'</b><br />
				Địa chỉ: '.$diachi.'<br />
				Điện thoại: '.$dienthoai.'<br />
				Email: '.$email.'<br />
			</div>
			<div style="width:50%; float: left">
				<b>Thông tin nhận hàng</b><br />
				Họ tên: <b>'.$hotennhan.'</b><br />
				Địa chỉ: '.$diachinhan.'<br />
				Điện thoại: '.$dienthoainhan.'<br />
			</div><div style="clear: both;"></div>';
			$body.='
				<table width="100%" style="border: solid 1px #fff; background: #f7f7f7">
					<tr style="height:30px; background: #CCCCCC">
						<th style="width: 5%">STT</div>
						<th style="width: 20%;">Hình ảnh</th>
						<th style="width:25%;">Tên sản phẩm</th>
						<th style="text-align:center;width:15%;">Số lượng</th>
						<th style="text-align:center;width:15%;">Giá</th>
						<th style="text-align:center; width:20%;">Tổng giá</th>
					</tr>';
            $max = count($_SESSION['cart']);
            for ($i = 0; $i < $max; $i++) {
                $pid = $_SESSION['cart'][$i]['productid'];
                $q = $_SESSION['cart'][$i]['qty'];
                $pname = get_product_name($pid);
                if ($q == 0)
                    continue;
                $body.='<tr>
						<td style="width:5%;">'. ($i+1) .'</td>
						<td style="width:20%;"><img src="http://'.$config_url.'/'._upload_product . get_product_image($pid) .'" width="90px" alt="'. $pname .'" /></td>
						<td style="width:25%;">'. $pname ; $body.='</td>
						<td style="text-align:center;width:15%;">' . $q . '</td>
						<td style="text-align:center;width:15%;">' . number_format(get_price($pid), 0, ',', '.') . '&nbsp;VNĐ</td>
						<td style="text-align:center; width:20%;">' . number_format(get_price($pid) * $q, 0, ',', '.') . '&nbsp;VNĐ</td>
					</tr>';
            }
			$body.='</table>';
				if($_SESSION["shipping"]>0){
					$body.='<div>Phí vận chuyển : ' . number_format($_SESSION["shipping"], 0, ',', '.') . '&nbsp;VNĐ</div>';
				}
				
                $body.='<div>Thanh toán : ' . number_format(get_order_total(), 0, ',', '.') . '&nbsp;VNĐ</div>';
				
            $body.='Mọi yêu cầu giúp đỡ xin liên hệ mail: <br />
			Chúng tôi hân hạnh được phục vụ quý khách';
            // gửi mail
            //Khởi tạo đối tượng
			
            $mail = new PHPMailer();
			
            //Thiet lap thong tin nguoi gui va email nguoi gui
            $mail->IsSMTP(); // Gọi đến class xử lý SMTP
            $mail->SMTPAuth = true;                  // Sử dụng đăng nhập vào account
            $mail->Host = $iphost;     // Thiết lập thông tin của SMPT
            $mail->Username = $userhost; // SMTP account username
            $mail->Password = $passhost;            // SMTP account password
            $mail->SetFrom($userhost, $row_setting['title_vi']);
            //Thiết lập thông tin người nhận
            $mail->AddAddress($row_setting['email'], $_POST['hoten']);
            $mail->AddBCC($email);

            //Thiết lập email nhận email hồi đáp
            //nếu người nhận nhấn nút Reply
            $mail->AddReplyTo($userhost, $row_setting['title_vi']);

            /* =====================================
             * THIET LAP NOI DUNG EMAIL
             * ===================================== */

            //Thiết lập tiêu đề
            $mail->Subject = "đặt hàng tại $row_setting[website]";

            //Thiết lập định dạng font chữ
            $mail->CharSet = "utf-8";

            $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

            //Thiết lập nội dung chính của email
            $mail->MsgHTML($body);

            if (!$mail->Send()) {
                transfer("Có lỗi xảy ra, quý khách vui lòng thực hiện lại thao tác!", "thanh-toan.html");
            } else {
                //update lần mua của khách hàng


                unset($_SESSION['cart']);
                transfer("Đặt hàng thành công!<br/>Mã Đơn Hàng: <span style='color:orange;font-weight:bold'>".$mahoadon."</span> <br>Vui lòng kiểm tra hộp thư đến hoặc hộp thư SPAM của email bạn. Nếu bạn có tài khoản hãy đăng nhập để xem thông tin đã đặt hàng.", "index.html");
            }
        
    }
$d->reset();
$sql = "select tenkhongdau, photo, noidung_$lang as noidung from #_about where type='thanh-toan' and hienthi=1 order by id";
$d->query($sql);
$pt_thanhtoan = $d->result_array();
?>