<?php 
	$d->reset();
	$sql="select ten_vi as ten, id from #_place_city order by stt";
	$d->query($sql);
	$rs_province=$d->result_array();
	
	$d->reset();
	$sql="select * from #_place_dist where id_city='".$rs_province[0]["id"]."' order by stt";
	$d->query($sql);
	$rs_district=$d->result_array();
?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="text-align:left">
    <div class="modal-dialog modal-lg">
        <div class="modal-content Regis">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Đăng ký</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="" method="post" enctype="multipart/form-data" name="formdktv" id="formdktv" onsubmit="return check();">
					<div class="form-group clear">
						<label for="recipient-name" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Email</label>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<input type="email" name="email" id="email" class="form-control" placeholder="Email"> 
							<span id="emailLoading" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
							<span id="emailResult"></span>
						</div>
					</div>
					<div class="form-group clear">
						<label for="recipient-name" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Mật khẩu</label>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<input type="password" class="form-control" name="matkhau" id="matkhau_tv" placeholder="Mật khẩu">
							<span id="matkhauLoading_tv" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
							<span id="matkhauResult_tv"></span>
						</div>
					</div>
					<div class="form-group clear">
						<label for="recipient-name" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Gõ lại mật khẩu</label>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<input type="password" class="form-control" name="golaimatkhau" id="golaimatkhau_tv" placeholder="Gõ lại mật khẩu">
							<span id="golaimatkhauLoading_tv" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
							<span id="golaimatkhauResult_tv"></span>
						</div>
					</div>
					<div class="form-group clear">
						<label for="recipient-name" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Họ và Tên</label>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<input type="text" class="form-control" name="ten" id="ten" placeholder="Họ và Tên">
						</div>
					</div>
					<div class="form-group clear">
						<label for="recipient-name" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Giới tính</label>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<input type="radio" class="" name="sex" value="1" id="nam" checked="" style="width:13px; display: initial; margin-left: 20px"> <label for="nam">Nam</label>
							<input type="radio" class="" name="sex" value="0" id="nu" style="width:13px; display: initial; margin-left: 10px"> <label for="nu">Nữ</label> 
						</div>
					</div>
					<div class="form-group clear">
						<label for="recipient-name" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Ngày sinh</label>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<input type="date" name="ngaysinh" id="ngaysinh" max="2100-12-31" min="1970-12-31" style="line-height: 20px;" class="">
						</div> 
					</div>
					<div class="form-group clear">
						<label for="recipient-name" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Số điện thoại</label>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<input type="text" name="sodt" id="sodt" class="form-control" placeholder="Số điện thoại">
						</div> 
					</div>

					<div class="form-group clear">
						<label for="message-text" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Địa chỉ</label>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<select name="province" id="province" class="input form-control">
								<option value='0'> --- Chọn tỉnh thành phố ---</option>
								<?php foreach($rs_province as $v){?>
								<option value="<?=$v['id']?>" <?php if($v['id']==$item['province']) echo "selected"; ?> ><?=$v["ten"]?></option>
								<?php }?>
							</select>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<select name="district" id="district" class="input form-control">
								<option value='0'> --- Chọn Quận huyện ---</option>
							</select>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<input class="form-control" id="diachi" name="diachi" placeholder="Số nhà, đường phố,.." />
						</div>
					</div>

					<div class="blue">Chúng tôi sẽ gửi đến hộp thư của bạn 1 email xác nhận đăng ký thành viên sau khi đăng ký thành viên hoàn tất.</div>
					<div class="clear"></div>
				</form>
            </div>
            <div class="modal-footer">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                    <span id="RegLoading" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
                    <span id="RegResult"></span>	
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="return check();">Đăng ký</button>
                </div>
            </div>  
        </div>
    </div>
</div>

<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="text-align: left; display: none;">
    <div class="modal-dialog">
        <div class="modal-content Login">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="assets/images/close.png" alt="close" /></span><span class="sr-only">Close</span></button>
                <h4 class="modal-title white-color" id="myModalLabel">MỜI BẠN ĐĂNG NHẬP</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="" method="post" enctype="multipart/form-data" name="dangnhap" id="dangnhap" onsubmit="return login_check();">
                    <div class="form-group clear">
                        <label for="recipient-name" class="col-xs-12 control-label">Email đăng nhập</label>
                        <div class="col-xs-12">
                            <input type="text" class="form-control" name="login_username" id="login_username" placeholder="Email đăng nhập">

                        </div>
                    </div>
                    <div class="form-group clear">
                        <label for="recipient-name" class="col-xs-12 control-label">Mật khẩu</label>
                        <div class="col-xs-12">
                            <input type="password" class="form-control" name="matkhau" id="login_matkhau" placeholder="Mật khẩu" onkeypress="dologin(event);">
                        </div>

                    </div>

                    <div class="clear"></div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 ">
                    <span id="LoginLoading" style="display: none;"><img src="assets/images/ajax-loader.gif" width="16"></span>
                    <span id="LoginResult"></span>	
                </div>
                <div class="col-xs-12">
                    <button type="button" class="btn btn-default" onclick="javascript:window.location = 'quen-mat-khau.html'">Quên mật khẩu</button>
                    <button type="button" class="btn btn-danger" onclick="return login_check();">Đăng nhập</button>
                </div>
            </div>  
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(e) {
        $('#province').change(function(){
			var pro = $(this).val();
			$('#district').load("ajax/xuly.php?act=load-quan&id="+$(this).val());
		})
    });
</script>