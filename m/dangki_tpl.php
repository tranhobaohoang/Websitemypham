
<link href="assets/css/login_register.css" media="all" rel="stylesheet" type="text/css" />
<div class="box_content">
	<div class="content">
		<div class="box_login_acoun">
			<div class="head">Đăng ký tài khoản</div>
			<div class="content">
						<form role="form" action="" method="post" enctype="multipart/form-data" name="formdktv" id="formdktv" onsubmit="return check();">
							<div class="form-group clear">
								<label for="recipient-name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Họ và Tên</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
									<input type="text" class="form-control" name="ten" id="ten" placeholder="Họ và Tên">
								</div>
							</div>
							<div class="form-group clear">
								<label for="recipient-name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Username</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
									<input type="text" name="username" id="username" class="form-control" placeholder="Username"> 
									<span id="usernameLoading" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
									<span id="usernameResult"></span>
								</div>
							</div>
							<div class="form-group clear">
								<label for="recipient-name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Mật khẩu</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
									<input type="password" class="form-control" name="matkhau" id="matkhau_tv" placeholder="Mật khẩu">
									<span id="matkhauLoading_tv" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
									<span id="matkhauResult_tv"></span>
								</div>
							</div>
							<div class="form-group clear">
								<label for="recipient-name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Gõ lại mật khẩu</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
									<input type="password" class="form-control" name="golaimatkhau" id="golaimatkhau_tv" placeholder="Gõ lại mật khẩu">
									<span id="golaimatkhauLoading_tv" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
									<span id="golaimatkhauResult_tv"></span>
								</div>
							</div>
							<div class="form-group clear">
								<label for="recipient-name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Email</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
									<input type="email" name="email" id="email" class="form-control" placeholder="Email"> 
									<span id="emailLoading" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
									<span id="emailResult"></span>
								</div>
							</div><div class="form-group clear">
								<label for="message-text" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Mã bảo vệ</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
									<input type="text" name="capt" id="capt" class="input">
									<span id="capcharLoading" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
									<span id="capcharResult"></span>
									<br />
									<img src="captcha_image.php" id="vimg"><span><img src="assets/images/Refresh-icon.png" alt="" width="35px" onclick="re_capcha()" /></span>
								</div>
							</div>
							<div class="clear"></div>
							<div class="form-group clear text-center">Nếu bạn đã có tài khoản, xin vui lòng chuyển qua trang <a href="dang-nhap.html" style="color: #10a9dd; font-weight: bold">đăng nhập.</a></div>
						</form>
						<div class="modal-footer">
							<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
								<span id="RegLoading" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
								<span id="RegResult"></span>	
							</div>
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
								
								<button type="button" class="btn btn-primary" onclick="return check();">Đăng ký</button>
							</div>
						</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		  
	</div>
</div>