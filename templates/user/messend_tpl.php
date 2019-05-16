<div class="box_content">
	<div class="view-title">
		<a class="active" href="user/<?=$rs_user['username']?>/thong-tin-ca-nhan.html">
			<?php if($_SESSION['login_web']['username']!=$rs_user['username']){ 
				echo $rs_user['ten_vi']; 
			}else { echo 'Trang cá nhân';}?>
		</a>
		<a href="user/<?=$rs_user['username']?>/gioi-thieu.html">Giới thiệu</a>
		<a href="user/<?=$rs_user['username']?>/binh-luan.html">Bình luận - nhận xét</a>
		<a href="user/<?=$rs_user['username']?>/friend.html">Bạn bè</a>
		<?php
			if($_SESSION['login_web']['username']!=$rs_user['username']){
			if(count($rs_check_friend)>0 and $rs_check_friend['active']==0){?>
			<div class="addfriend" data-action="huy" data-from="<?=$_SESSION['login_web']['username']?>" data-to="<?=$rs_user['username']?>"><i class="glyphicon glyphicon-plus green-color"></i> <span>Đã gửi lời kết bạn</span></div>
		<?php } else if(count($rs_check_friend)>0 and $rs_check_friend['active']==1){ }else {?>
			<div class="addfriend" data-action="add"  data-from="<?=$_SESSION['login_web']['username']?>" data-to="<?=$rs_user['username']?>"><i class="glyphicon glyphicon-plus green-color"></i><span>Kết bạn</span></div>
		<?php }}?>
	</div>
	<div class="content">
		<div class="content-left">
			<div class="box_child info">
				<?php if($_SESSION['login_web']['username']==$rs_user['username']){ ?>
				<div class="messend_box">
					<a href="user/<?=$rs_user['username']?>/messend.html"><i class="glyphicon glyphicon-envelope green-color"></i>Bạn có (<span class="red-color"><?=count($rs_messend)?></span>) tin nhắn mới</a>
				</div>
				<?php }?>
				<div class="item work">
					<i class="glyphicon glyphicon-briefcase"></i>Làm việc tại: 
					<span><?php is_empty($rs_user['work'],'Chưa có')?></span>
					<?php if($_SESSION['login_web']['username']==$rs_user['username']){ ?><i class="glyphicon glyphicon-pencil edit" data-id="work"></i><?php }?>
					<div class="result_notice"></div>
					<div id="work" class="form ">
						<input type="text" class="form-control" name="work" value="<?=$rs_user['work']?>" placeholder="Công việc hiện tại" />
						<a class="save savework" data-id="work">Lưu</a>
					</div>
				</div>
				<div class="item student">
					<i class="glyphicon glyphicon-book"></i>Từng học tại: 
					<span><?php is_empty($rs_user['student'],'Chưa có')?></span>
					<?php if($_SESSION['login_web']['username']==$rs_user['username']){ ?><i class="glyphicon glyphicon-pencil edit" data-id="student"></i><?php }?>
					<div class="result_notice"></div>
					<div id="student" class="form ">
						<input type="text" class="form-control" name="student" value="<?=$rs_user['student']?>" placeholder="" />
						<a class="save savestudent" data-id="student">Lưu</a>
					</div>
				</div>
				<div class="item live"><i class="glyphicon glyphicon-home"></i>Sống tại: 
					<span>
					<?php
						if($rs_user['diachi']==''){
							echo 'Chưa có';
						}else{
							echo $rs_user['diachi'].', '; get_district($rs_user['district']); echo ', '; get_province($rs_user['province']);
						}
					?>
					</span>
					<?php if($_SESSION['login_web']['username']==$rs_user['username']){ ?><i class="glyphicon glyphicon-pencil edit" data-id="live"></i><?php }?>
					<div class="result_notice"></div>
					<div id="live" class="form ">
						
						<select name="province" id="province" class="input form-control">
							<option value='0'> --- Chọn tỉnh thành phố ---</option>
							<?php foreach($rs_p as $v){?>
							<option value="<?=$v['provinceid']?>" <?php if($v['provinceid']==$rs_user['province']) echo "selected"; ?> ><?=$v['type']?> <?=$v["name"]?></option>
							<?php }?>
						</select>
						<select name="district" id="district" class="input form-control">
							<option value='0'> --- Chọn tỉnh Quận huyện ---</option>
							<?php foreach($rs_d as $v){?>
							<option value="<?=$v['districtid']?>" <?php if($v['districtid']==$rs_user['district']) echo "selected"; ?> ><?=$v['type']?> <?=$v["name"]?></option>
							<?php }?>
						</select>
						<input class="form-control" id="diachi" value="<?=$rs_user['diachi']?>" name="diachi" placeholder="Số nhà, đường phố,.." />
						<a class="save savelive" data-id="live">Lưu</a>
					</div>
				</div>
				<div class="item hometown"> <i class="glyphicon glyphicon-map-marker"></i>Đến từ: <span>
					<?php
						if($rs_user['hometown']==''){
							echo 'Chưa có';
						}else{
							echo  $rs_user['hometown'].', '; get_district($rs_user['hometown_dis']); echo ', '; get_province($rs_user['hometown_pro']);
						}
					?>
					</span>
					<?php if($_SESSION['login_web']['username']==$rs_user['username']){ ?><i class="glyphicon glyphicon-pencil edit" data-id="hometown"></i><?php }?>
					<div class="result_notice"></div>
					<div id="hometown" class="form ">
						
						<select name="hometown_pro" id="hometown_province" class="input form-control">
							<option value='0'> --- Chọn tỉnh thành phố ---</option>
							<?php foreach($rs_p as $v){?>
							<option value="<?=$v['provinceid']?>" <?php if($v['provinceid']==$rs_user['hometown_pro']) echo "selected"; ?> ><?=$v['type']?> <?=$v["name"]?></option>
							<?php }?>
						</select>
						<select name="hometown_dis" id="hometown_district" class="input form-control">
							<option value='0'> --- Chọn tỉnh Quận huyện ---</option>
							<?php foreach($rs_d1 as $v){?>
							<option value="<?=$v['districtid']?>" <?php if($v['districtid']==$rs_user['hometown_dis']) echo "selected"; ?> ><?=$v['type']?> <?=$v["name"]?></option>
							<?php }?>
						</select>
						<input class="form-control" name="hometown" value="<?=$rs_user['hometown']?>" placeholder="Số nhà, đường phố,.." />
						<a class="save savehome" data-id="hometown">Lưu</a>
					</div>
				</div>
			</div>
			<div class="box_child  friend">
				
			</div>
			<div class="box_child  album">
				
			</div>
		</div>
		<div class="content-right">
			<?php 
			if(count($rs_messend)>0){
			foreach($rs_messend as $v){?>
			<div class="box_me" id="<?=md5($v['id'])?>">
				<div class="result-messend green-color"></div>
				<div class="row show-messend">
					<div class="col-md-8 col-sm-8 col-xs-12">
						<?=$v['messend']?>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-6">
						<div class="yes_add click-messend" data-action="yes" data-id="<?=$v['id']?>">Chấp nhận</div>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-6">
						<div class="no_add click-messend" data-action="no" data-id="<?=$v['id']?>">Hủy yêu cầu</div>
					</div>
				</div>
			</div>
			<?php } } else{ echo "không có thư mới nào trong hộp thư của bạn.";}?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(e) {
		$('.click-messend').click(function(){
			var action=$(this).data("action");
			var id=$(this).data("id");
			
			$.ajax({
				url: "ajax/information.php",
				type:"POST",
				dataType:"html",
				data:{act: "answer",action:action,id: id},
				success: function(data){
					var k=$.parseJSON(data);
					$("#"+k.id+" .result-messend").html(k.mes);
					$("#"+k.id+" .result-messend").fadeIn(1000);
					$("#"+k.id+" .show-messend").fadeOut(1000);
					
				}
			})
		})
        $('#province').change(function(){
			var pro = $(this).val();
			$('#district').load("admin/ajax/ajax_admin.php?pro="+ pro+"&act=province");
		})
		$('#hometown_province').change(function(){
			var pro = $(this).val();
			$('#hometown_district').load("admin/ajax/ajax_admin.php?pro="+ pro+"&act=province");
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
						$(".result_notice").show();
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