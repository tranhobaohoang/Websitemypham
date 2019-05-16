<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
	
</script>
<?php
	
	$d->reset();
	$sql="select * from #_place_city order by stt";
	$d->query($sql);
	$rs_province=$d->result_array();
	
	$d->reset();
	$sql="select * from #_place_dist where id_city='".$item['province']."' order by stt";
	$d->query($sql);
	$rs_district=$d->result_array();
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        <li><a href="default.php?com=member&act=man_list&type=<?=$_REQUEST["type"]?>"><span>Thành viên</span></a></li>
        <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="default.php?com=member&act=save_list&type=<?=$_REQUEST["type"]?>&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
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
			<input type="hidden" name="id" id="id_this_member" value="<?=@$item['id']?>" />
			<div class="formRow">
				<label>Tên: </label>
				<div class="formRight">
					<input type="text" id="ten_vi" name="ten_vi" value="<?=@$item['ten_vi']?>"  title="Tên thành viên" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Điện thoại: </label>
				<div class="formRight">
					<input type="text" id="dienthoai" name="dienthoai" value="<?=@$item['dienthoai']?>"  title="Điện thoại thành viên" class="tipS" />
				</div>
				<div class="clear"></div>
			</div> 
			<div class="formRow">
				<label>Email: </label>
				<div class="formRight">
					<input type="text" id="email" name="email" value="<?=@$item['email']?>"  title="Eamil thành viên" readonly class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Tỉnh thành phố: </label>
				<div class="formRight">
					<div class="selector">
						<select name="province" id="province">
							<option>Chọn tỉnh thành phố</option>
							<?php foreach($rs_province as $v){?>
							<option value="<?=$v["id"]?>" <?=($item["province"]==$v["id"]) ? "selected" : "";?> ><?=$v["ten"]?></option> 
							<?php }?>
						</select>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Quận huyện: </label>
				<div class="formRight">
					<div class="selector">
						<select name="district" id="district">
							<option>Chọn quận huyện</option>
							<?php foreach($rs_district as $v){?>
							<option value="<?=$v["id"]?>" <?=($item["district"]==$v["id"]) ? "selected" : "";?> ><?=$v["ten"]?></option> 
							<?php }?>
						</select>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label>Địa chỉ: </label>
				<div class="formRight">
					<input type="text" id="diachi" name="diachi" value="<?=@$item['diachi']?>"  title="Địa chỉ thành viên" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label>Hình ảnh đại diện: </label>
				<div class="formRight">
					<?php if ($_REQUEST['act']=='edit_list' && $item['photo']!='' ) { ?>
					<img width="100" src="<?=_upload_member.$item['photo']?>">
					<!--<a title="Xoá ảnh" href="default.php?com=member&act=delete_img&id=<?=@$item['id']?>">Xoá ảnh</a>-->
					<br>
					<?php }?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
				<div class="formRight">
					<input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
					<label for="check1">Kích hoạt</label>           
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Số thứ tự: </label>
				<div class="formRight">
					<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của bài viết, chỉ nhập số">
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


<script type="text/javascript">
	$(document).ready(function(e) {
        $('#province').change(function(){
			var pro = $(this).val();
			$('#district').load("ajax/ajax_admin.php?pro="+ pro+"&act=province");
		})
    });
</script>
<script type="text/javascript">
	$(document).ready(function(e) {
		$('.datetimepicker1').datetimepicker({
			yearOffset:0,
			lang:'vi',
			timepicker:false,
			format:'d/m/Y',
			formatDate:'Y/m/d',
			minDate:'-1970/01/02', // yesterday is minimum date
			maxDate:'+1970/01/02' // and tommorow is maximum date calendar
		});
	});
</script>