<script type="text/javascript" src="assets/js/jquery.idTabs.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
		jQuery("#info_deals ul").idTabs();
	})
</script>
<div class="box_content">
	<div class="content">
		<div class="content-left">
			<div class="box_child info">
				<div id="info_deals" class="usual"> 
                    <ul id="tab_content">
                        <li><a href="#tab1" class="<?php if($_GET["com"]!='kiem-tra-don-hang') echo 'selected';?>">Thông tin tài khoản</a></li>
						<li><a href="#tab2" class="<?php if($_GET["com"]=='kiem-tra-don-hang') echo 'selected';?>">Thông kê đơn hàng</a></li>
                    </ul>
                    <div id="tab1" class="content_tab">
						<div class="item live"><i class="glyphicon glyphicon-play"></i>Username: <span><?=$user?></span></div>
						<div class="item live"><i class="glyphicon glyphicon-play"></i>Điểm tích lũy: <span><?=$rs_user['rate']?></span></div>
						<div class="item live"><i class="glyphicon glyphicon-play"></i>Tên: <span><?=$rs_user["ten_vi"]?></span>
							<?php if($_SESSION['login_web']['username']==$rs_user['email']){ ?><i class="glyphicon glyphicon-pencil edit" data-id="ten_vi"></i><?php }?>
							<div class="result_notice"></div>
							<div id="ten_vi" class="form ">
								<input class="form-control"  value="<?=$rs_user['ten_vi']?>" name="ten_vi" />
								<a class="save savelive" data-id="ten_vi">Lưu</a>
							</div>
						</div>
						<div class="item live"><i class="glyphicon glyphicon-play"></i>Mật khẩu 
							<?php if($_SESSION['login_web']['username']==$rs_user['email']){ ?><i class="glyphicon glyphicon-pencil edit" data-id="password"></i><?php }?>
							<div class="result_notice"></div>
							<div id="password" class="form ">
								<input class="form-control" value="<?=$rs_user['old_password']?>" name="password" />
								<a class="save savelive" data-id="password">Lưu</a>
							</div>
						</div>
						<div class="item live"><i class="glyphicon glyphicon-play"></i>Email: <span><?=$rs_user["email"]?></span>
							<?php if($_SESSION['login_web']['username']==$rs_user['email']){ ?><i class="glyphicon glyphicon-pencil edit" data-id="email_p"></i><?php }?>
							<div class="result_notice"></div>
							<div id="email_p" class="form ">
								<input class="form-control" value="<?=$rs_user['email']?>" name="email" />
								<a class="save savelive" data-id="email_p">Lưu</a>
							</div>
						</div>
						<div class="item live"><i class="glyphicon glyphicon-play"></i>Địa chỉ: 
							<span>
							<?php
								if($rs_user['diachi']==''){
									echo 'Chưa có';
								}else{
									echo $rs_user['diachi'].', '.get_district($rs_user['district']).', '.get_province($rs_user['province']);
								}
							?>
							</span>
							<?php if($_SESSION['login_web']['username']==$rs_user['email']){ ?><i class="glyphicon glyphicon-pencil edit" data-id="live"></i><?php }?>
							<div class="result_notice"></div>
							<div id="live" class="form ">
								
								<select name="province" id="province1" class="input form-control">
									<option value='0'> --- Chọn tỉnh thành phố ---</option>
									<?php foreach($rs_p as $v){?>
									<option value="<?=$v['id']?>" <?php if($v['id']==$rs_user['province']) echo "selected"; ?> ><?=$v["ten_vi"]?></option>
									<?php }?>
								</select>
								<select name="district" id="district1" class="input form-control">
									<option value='0'> --- Chọn Quận huyện ---</option>
									<?php foreach($rs_d as $v){?>
									<option value="<?=$v['id']?>" <?php if($v['id']==$rs_user['district']) echo "selected"; ?> > <?=$v["ten"]?></option>
									<?php }?>
								</select>
								<input class="form-control" id="diachi" value="<?=$rs_user['diachi']?>" name="diachi" placeholder="Số nhà, đường phố,.." />
								<a class="save savelive" data-id="live">Lưu</a>
							</div>
						</div>
					</div> 
					<div id="tab2" class="content_tab">
						<div class="table-responsive">
						<table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:13px;" width="100%">

							<tr>
								<th style="width:5%" align="center">ID</th>
								<th style="width:10%;">Mã đơn hàng</th>	
								<th style="width:20%;">Họ tên</th>
								<th style="width:20%;">Ngày đặt</th>
								<th style="width:10%;">Số tiền</th>
								<th style="width:15%;">Tình trạng</th>     
							</tr>

							<?php
							for ($i = 0, $count = count($items_dh); $i < $count; $i++) {
								$tongthu = $tongthu + $items_dh[$i]['tonggia'];
								?>
								<tr>
									<td style="width:5%;" align="center"><?= $items_dh[$i]['id'] ?></td>
									<td style="width:10%;" align="center"><?= $items_dh[$i]['madonhang'] ?></td>       
									<td style="width:20%;" align="center"><a href="index.php?com=order&act=edit&id=<?= $items_dh[$i]['id'] ?>" style="text-decoration:none;"><?= $items_dh[$i]['hoten'] ?></a></td>
									<td style="width:20%;" align="center"><?= date('d/m/Y', $items_dh[$i]['ngaytao']) ?></td>          
									<td style="width:10%;" align="center"><?= number_format($items_dh[$i]['tonggia'], 0, ',', '.') ?>&nbsp;VNĐ</td>
									
									<td style="width:15%;" align="center">
										<?php
										$sql = "select trangthai from #_tinhtrang where id= '" . $items_dh[$i]['trangthai'] . "' ";
										$d->query($sql);
										$result = $d->fetch_array();
										echo $result['trangthai'];
										?>

									</td>         
									
								</tr>
							<?php } ?>
						</table>
						</div>
						Tổng giá trị danh sách: <b><?= number_format($tongthu, 0, ",", ".") . " VNĐ"; ?></b>
					</div> 
                </div>
			</div>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
	function del($id){
		var frm = document.del;
		frm.id.val($id);
		if(confirm("Bạn có muốn xóa tin đăng này!")==true){
			frm.submit();
		}else{
			return false;
		}
		
	}
	$(document).ready(function(e) {
        $('#province1').change(function(){
			var pro = $(this).val();
			$('#district1').load("ajax/xuly.php?act=load-quan&id="+$(this).val());
		})
		$('.edit').click(function(){
			var id=$(this).data("id");
			if($("#"+id).hasClass("active")){
				$("#"+id).removeClass("active");
				$("#"+id).slideUp(500);
			}else{
				$("#"+id).addClass("active");
				$("#"+id).slideDown(500);
			}
			return false;
		})
		$(".save").click(function(){
			$root  = $(this).parents(".form");
			$arr = new Array();
			$id=$(this).data("id");
			if($root.find("input").length){
				$root.find("input").each(function(){
					var name=$(this).attr("name");
					var val=$(this).val();
					$arr.push({name, val});
				})
				
			}
			if($root.find("select").length){
				$root.find("select").each(function(){
					var name=$(this).attr("name");
					var val=$(this).val();
					$arr.push({name, val});
				})
				
			}
			//$arr.push({"act","capnhatuser"});
			$.ajax({
				url: 'ajax/information.php',
				type: 'POST',
				dataType: 'html',
				data: {act: 'thongtinuser',id:$id,arr: $arr},
				success: function(result){
					var kh = $.parseJSON(result);
					console.log(kh);
					if(kh.check==1){
						$("."+kh.id).find(".result_notice").show();
						$('.form').removeClass("active");
						$('.form').slideUp(500);
						$("."+kh.id).find(".result_notice").html(kh.thongbao).fadeIn(800);
						$("."+kh.id).find(".result_notice").fadeOut(3500);

					}
				}
		
			})
			
		})
		
    });
</script>