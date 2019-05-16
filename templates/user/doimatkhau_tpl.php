<link href="assets/css/login_register.css" media="all" rel="stylesheet" type="text/css" />
<div class="content">
	<div class="container_right" id="content">
		<div class="title" >THÔNG TIN TÀI KHOẢN</div>
		<div class="gr_thongtin">
			<form name="frm_update_member" id="frm_update_member" action="" method="post" >
				<div class="form-group">
					<b>Tên truy cập:</b><?= $rs_user['username'] ?>
					<div class="clear"></div>
				</div>
				<div class="form-group">
					<b>Mật khẩu mới:</b><input type="password" name="passNew" value="" id="passNew" class="form-control" />
					<div class="clear"></div>
				</div>
				<div class="form-group">
					<b>Nhập lại mật khẩu mới:</b><input type="password" name="repassNew" value="" id="repassNew" class="form-control" />
					<div class="clear"></div>
				</div>
				<div class="form-group text-center"><input type="button" value="Cập nhật" class="btn btn_start"></div>
			</form>
		</div>
	</div>
	<div class="container_left">
		<?php include_once _template . "user/left.php"; ?> 
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('.btn_start').click(function(){
			var frm = document.frm_update_member;
			if($("#passNew").val()==""){
				alert("Chưa nhập mật khẩu mới.");
				return false;
			}
			if($("#repassNew").val()==""){
				alert("Chưa nhập lại mật khẩu.");
				return false;
			}
			if($("#passNew").val()!=$("#repassNew").val()){
				alert("Nhập lại mật khẩu chưa đúng.");
				return false;
			}
			frm.submit();
		})
    });
</script>