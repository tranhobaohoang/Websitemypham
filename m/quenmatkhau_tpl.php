<script type="text/javascript" src="assets/js/check_login.js"></script>
<link href="assets/css/login_register.css" media="all" rel="stylesheet" type="text/css" />
<div class="box_content">
	<div class="content">
		<div class="box_login_acoun">
			<div class="head">Quên mật khẩu</div>
			<div class="content">
						<form role="form" action="" method="post" enctype="multipart/form-data" name="resetpass" id="resetpass" onsubmit="return reset_check();">				
							<div class="form-group clear">
								<label for="recipient-name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Username</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
									<input type="text" name="username_reset" id="username_reset" class="form-control" placeholder="Username"> 
									<span id="userlLoading" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
									<span id="userResult"></span>
								</div>
							</div>
							<div class="form-group clear">
								<label for="recipient-name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Email</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
									<input type="email" name="email_reset" id="email_reset" class="form-control" placeholder="Email"> 
									<span id="emailLoading" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
									<span id="emailResult"></span>
								</div>
							</div>
							

							<div class="form-group clear">
								<label for="message-text" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Mã bảo vệ</label>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
									<input type="text" name="capt_reset" id="capt_reset" class="input">
									<span class="error">
									</span><br>
									<img src="captcha_image.php">
								</div>
							</div>
							<div class="clear"></div>
							
						</form>
						<div class="modal-footer">
							<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
								<span id="ResetLoading" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
								<span id="ResetResult"></span>
							</div>
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
								<button type="button" class="btn btn-primary" onclick="return reset_check();" >Lấy lại mật khẩu</button>
							</div>
						</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		  
	</div>
</div>