
<link href="assets/css/login_register.css" media="all" rel="stylesheet" type="text/css" />
<div class="box_content">
	<div class="content">
		<div class="box_login_acoun">
			<div class="head">Đổi mật khẩu</div>
			<div class="content">
				<form role="form" action="" method="post" enctype="multipart/form-data" name="formdoipass" id="formdoipass">
					<div class="form-group clear">
						<label for="recipient-name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Mật khẩu cũ</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
							<input type="password" class="form-control" name="matkhau_cu" id="matkhau_cu" >
							
							<span id="matkhauResult_tv"></span>
						</div>
					</div>
					<div class="form-group clear">
						<label for="recipient-name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Mật khẩu mới</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
							<input type="password" class="form-control" name="matkhau_moi" id="matkhau_moi" >

							<span id="matkhauResult_tv"></span>
						</div>
					</div>
					<div class="form-group clear">
						<label for="recipient-name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Gõ lại mật khẩu mới</label>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
							<input type="password" class="form-control" name="golaimatkhau_moi" id="golaimatkhau_moi" >

							<span id="golaimatkhauResult_tv"></span>
						</div>
					</div>
					<div class="clear"></div>
				</form>
				<div class="modal-footer">
					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">

						<span id="RegResult"></span>
					</div>
					<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
						<button type="button" class="btn btn-primary" onclick="changePass(<?=$_SESSION['login_web']['id']?>)">Đổi mật khẩu</button>
					</div>
				</div>
			</div>
				<div class="clear"></div>
			</div>
		</div>
		  
	</div>
</div>