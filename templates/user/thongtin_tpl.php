<link href="assets/css/login_register.css" media="all" rel="stylesheet" type="text/css" />
<div class="content">
	<div class="container_right" id="content">
		<div class="title" >THÔNG TIN TÀI KHOẢN</div>
		<div class="gr_thongtin">
			<div class="table-responsive">
				<table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:13px; border: none;" width="100%" >
					<tr style=" border: none;">
						<td style="width:50%; border: none;" align="right">Tên truy cập:</td>
						<td style="width:50%; border: none;" align="left"><?= $rs_user['username'] ?></td>
					</tr>
					<tr style=" border: none;">
						<td style="width:50%; border: none;" align="right">Ngày đăng ký:</td>
						<td style="width:50%; border: none;" align="left"><?=date("d/m/Y",$rs_user['ngaytao']) ?></td>
					</tr>
					<tr style=" border: none;">
						<td style="width:50%; border: none;" align="right">Trạng thái hoạt động:</td>
						<td style="width:50%; border: none;" align="left">Đang hoạt động</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="title" >THÔNG TIN LIÊN HỆ</div>
		<form name="frm_update_member" id="frm_update_member" action="" method="post" >
			<div class="form-group">
				<b>Họ tên</b><input type="text" name="ten_vi" value="<?=$rs_user["ten_vi"]?>" class="form-control" />
				<div class="clear"></div>
			</div>
			<div class="form-group">
				<b>Tỉnh thành</b>
				<select name="province" id="province1" class="input form-control">
					<option value='0'> --- Chọn tỉnh thành phố ---</option>
					<?php foreach($rs_p as $v){?>
					<option value="<?=$v['id']?>" <?php if($v['id']==$rs_user['province']) echo "selected"; ?> ><?=$v["ten"]?></option>
					<?php }?>
				</select>
				<div class="clear"></div>
			</div>
			<div class="form-group">
				<b>Quận huyện</b>
				<select name="district" id="district1" class="input form-control">
					<option value='0'> --- Chọn Quận huyện ---</option>
					<?php foreach($rs_d as $v){?>
					<option value="<?=$v['id']?>" <?php if($v['id']==$rs_user['district']) echo "selected"; ?> > <?=$v["ten"]?></option>
					<?php }?>
				</select>
				<div class="clear"></div>
			</div>
			
			<div class="form-group">
				<b>Email</b><input type="email" name="email" value="<?=$rs_user["email"]?>" class="form-control" />
				<div class="clear"></div>
			</div>
			<div class="form-group">
				<b>Điện thoại</b><input type="tel" pattern="[0][0-9]{9,10}" min="10" max="13" required oninvalid="this.setCustomValidity('Số điện thoại của bạn không đúng định dạng')" oninput="setCustomValidity('')" name="dienthoai" value="<?=$rs_user["dienthoai"]?>" class="form-control" />
				<div class="clear"></div>
			</div>
			<div class="form-group text-center"><input type="submit" value="Cập nhật" class="btn btn_start"></div>
		</form>
	</div>
	<div class="container_left">
		<?php include_once _template . "user/left.php"; ?> 
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('#province1').change(function(){
			var pro = $(this).val();
			$('#district1').load("ajax/xuly.php?act=load-quan&id="+$(this).val());
		})
    });
</script>