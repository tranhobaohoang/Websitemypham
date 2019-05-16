<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
	
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        <li><a href="default.php?com=prices&act=man"><span>Bảng giá</span></a></li>
        <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="default.php?com=prices&act=save&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nhập dữ liệu</h6>
        </div>
		<ul class="tabs">
           
			<li>
               <a href="#info">Thông tin chung</a>
			</li>


		</ul>
		<div id="info" class="tab_content">
			<input type="hidden" name="id" id="id_this_prices" value="<?=@$item['id']?>" />
			<?php foreach ($config['lang'] as $key => $value) { ?>
			<div class="formRow">
				<label>Tên bảng giá (<?=$key?>)</label>
				<div class="formRight">
					<input type="text" name="ten_<?=$key?>" title="Nhập tên bảng giá" id="ten_<?=$key?>" class="tipS" value="<?=@$item['ten_'.$key]?>" />
				</div>
				<div class="clear"></div>
			</div>
			<?php }?>
			<div class="formRow">
				<label>Giá </label>
				<div class="formRight">
					<input type="text" name="gia" title="Nhập giá" id="gia" class="tipS" value="<?=@$item['gia']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Sử dụng phòng họp </label>
				<div class="formRight">
					<input type="text" name="phonghop" title="Nhập Sử dụng phòng họp" id="phonghop" class="tipS" value="<?=@$item['phonghop']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>	In ấn, photo miễn phí </label>
				<div class="formRight">
					<input type="text" name="logo" title="Nhập In ấn, photo miễn phí" id="logo" class="tipS" value="<?=@$item['logo']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Tên miền </label>
				<div class="formRight">
					<input type="text" name="domain" title="Nhập tên miền" id="domain" class="tipS" value="<?=@$item['domain']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>	Thiết kế website giá tự chọn </label>
				<div class="formRight">
					<input type="text" name="website" title="Nhập Thiết kế website giá tự chọn" id="website" class="tipS" value="<?=@$item['website']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
				<div class="formRight">
					<input type="checkbox" name="diachidk" id="diachidk" value="1" <?=(!isset($item['diachidk']) || $item['diachidk']==1)?'checked="checked"':''?> />
					<label for="email">Địa chỉ đăng kí</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="diachinhanthu" id="diachinhanthu" value="1" <?=(!isset($item['diachinhanthu']) || $item['diachinhanthu']==1)?'checked="checked"':''?> />
					<label for="diachinhanthu">Địa chỉ nhận thư</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="kvtiepkhach" id="kvtiepkhach" value="1" <?=(!isset($item['kvtiepkhach']) || $item['kvtiepkhach']==1)?'checked="checked"':''?> />
					<label for="kvtiepkhach">Khu vực tiếp khách</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="letan" id="letan" value="1" <?=(!isset($item['letan']) || $item['letan']==1)?'checked="checked"':''?> />
					<label for="letan">Lễ tân</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="internet" id="internet" value="1" <?=(!isset($item['internet']) || $item['internet']==1)?'checked="checked"':''?> />
					<label for="internet">Internet wifi</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="nuocuong" id="nuocuong" value="1" <?=(!isset($item['nuocuong']) || $item['nuocuong']==1)?'checked="checked"':''?> />
					<label for="nuocuong">Nước uống</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="bao" id="bao" value="1" <?=(!isset($item['bao']) || $item['bao']==1)?'checked="checked"':''?> />
					<label for="bao">Cập nhật các báo tạp chí nổi tiếng</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="bangten" id="bangten" value="1" <?=(!isset($item['bangten']) || $item['bangten']==1)?'checked="checked"':''?> />
					<label for="bangten">Đặt bảng tên</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="sofax" id="sofax" value="1" <?=(!isset($item['sofax']) || $item['sofax']==1)?'checked="checked"':''?> />
					<label for="sofax">Sử dụng số fax chung</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="cafe" id="cafe" value="1" <?=(!isset($item['cafe']) || $item['cafe']==1)?'checked="checked"':''?> />
					<label for="cafe">Nước uống, trà , café miễn phí</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="thutucdkkd" id="thutucdkkd" value="1" <?=(!isset($item['thutucdkkd']) || $item['thutucdkkd']==1)?'checked="checked"':''?> />
					<label for="thutucdkkd">Hỗ trợ thủ tục ĐKKD</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="thutucdkkd1" id="thutucdkkd1" value="1" <?=(!isset($item['thutucdkkd1']) || $item['thutucdkkd1']==1)?'checked="checked"':''?> />
					<label for="thutucdkkd1">Hỗ trợ thủ tục ĐKKD(Bao gồm GP + MST + Dấu hộp tự động) với chi phí 1.200.000 vnđ (bao gồm lệ phí đóng nhà nước)</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="thutucdkkd2" id="thutucdkkd2" value="1" <?=(!isset($item['thutucdkkd2']) || $item['thutucdkkd2']==1)?'checked="checked"':''?> />
					<label for="thutucdkkd2">Hỗ trợ thủ tục ĐKKD( bao gồm tới con dấu ) và báo cáo thuê ban đầu.Chi phí lệ phí 1.400.000 vnđ</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="email" id="email" value="1" <?=(!isset($item['email']) || $item['email']==1)?'checked="checked"':''?> />
					<label for="email">Email với tên miền doanh nghiệp</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="dienthoai" id="dienthoai" value="1" <?=(!isset($item['dienthoai']) || $item['dienthoai']==1)?'checked="checked"':''?> />
					<label for="dienthoai">01 số điện thoại riêng và chuyển cuộc gọi</label>           
				</div>
				<div class="formRight">
					<input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
					<label for="check1">Hiển thị</label>           
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Số thứ tự: </label>
				<div class="formRight">
					<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của prices, chỉ nhập số">
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<div class="formRight">
					
					<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</form>
