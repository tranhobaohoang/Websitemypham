<?php 
	$username = $_POST['username'];
    $email = $_POST['email'];
    $capt = $_POST['capt'];



    //validate dữ liệu
    $username = trim(strip_tags($username));
    $email = trim(strip_tags($email));
    $capt = trim(strip_tags($capt));
    $_SESSION['email_reg'] = $email;

    
    $coloi = false;
    
    if ($_SESSION['captcha_code'] != $capt) {
        $coloi = true;
        echo "<br/><i>Sai mã bảo vệ</i>"; // xử lý lỗi
    }
    

    if ($coloi == FALSE) {
		$d->reset();
		$sql="select old_password from #_member where username='".$username."'";
		$d->query($sql);
		$result=$d->result_array();
		
		if(count($result)>0){
			$pas='Mật khẩu của bạn là: '.$result[0]["old_password"];
		}else{
			$pas='Chúng tôi rất tiếc vì tài khoản bạn đăng kí không tồn tại trên hệ thống của chúng tôi.';
		}
		
        include_once "../phpmailer/class.phpmailer.php";
        //Khởi tạo đối tượng
        $mail = new PHPMailer();
        //Thiet lap thong tin nguoi gui va email nguoi gui
        $mail->IsSMTP(); // Gọi đến class xử lý SMTP
        $mail->SMTPAuth = true;                  // Sử dụng đăng nhập vào account
        $mail->Host = $host;     // Thiết lập thông tin của SMPT
        $mail->Username = $userhost; // SMTP account username
        $mail->Password = $passhost;            // SMTP account password

        $mail->SetFrom($userhost, $row_setting['website']);

        //Thiết lập thông tin người nhận
        $mail->AddAddress("$email", $row_setting['website']);

        /* =====================================
         * THIET LAP NOI DUNG EMAIL
         * ===================================== */

        //Thiết lập tiêu đề
        $mail->Subject = 'Đăng kí lấy lại mật khẩu từ website ' . $row_setting['website'];

        //Thiết lập định dạng font chữ
        $mail->CharSet = "utf-8";

        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

        $body = _xinchao . " $username.<br/>" . '.Bạn đã đăng ký lấy lại mật khẩu từ website ' . $row_setting['website'];
		
		$body = '<table>';
			$body .= '
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				<tr>
					<th colspan="2">Đăng ký lấy lại mật khẩu từ website '.$row_setting['website'].'</th>
				</tr>
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				<tr>
					'.$row_setting['website'].' chào bạn .<br />
					Bạn đã đăng ký lấy lại mật khẩu từ website '.$row_setting['website'].$pas.' . 
					Cảm ơn bạn đã sử dụng dịch vụ của '.$row_setting['website'].'<br />
					Mọi thắc mắc hoặc quan tâm về tài khoản, xin vui lòng liên hệ:<br />
					 
					'.$row_setting['website'].'<br />
					Địa Chỉ : '.$row_setting['diachi_vi'].'<br />
					Hotline : '.$row_setting['hotline'].' Email : '.$row_setting['email'].' Website : '.$row_setting['website'].'<br />
					Lưu ý: Đây chỉ là thư thông báo. Các hồi đáp lại thông báo này sẽ không được theo dõi hoặc giải đáp.<br />
				</tr>
				<tr>';
			$body .= '</table>';
        //Thiết lập nội dung chính của email
        $mail->MsgHTML($body);

        if (!$mail->Send()) {
            echo "<span style='color:red;'>Có lỗi xảy! </span>";
            //transfer( "Xin lỗi em chịu ko nỗi! ","index.html");
        } else {
           
            echo "<span style='color:red;'>Đăng ký thành công!. Hệ thống sẽ chuyển trang trong giây lát. </span>";
        }
    } else {
        echo $thongbao;
    }
?>