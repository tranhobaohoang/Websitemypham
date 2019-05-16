<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="default.php?com=member&act=man_list&type=<?=$_REQUEST["type"]?>"><span>Thành viên</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script src="js/datetimpicker/jquery.datetimepicker.js"></script>
<link href="js/datetimpicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
  $(document).ready(function() {
    $(".datetimepicker").datetimepicker({
      yearOffset:0,
      lang:'vi',
      timepicker:false,
      format:'m/d/Y',
      formatDate:'Y/m/d',
      minDate:'-1970/01/02', // yesterday is minimum date
      maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
  });
</script>
<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='default.php?com=member&act=add_list&type=<?=$_REQUEST["type"]?>'" />
        <!--<input type="button" class="blueB" value="Hiện" onclick="ChangeAction('default.php?com=product&act=man_list&type=<?=$_REQUEST["type"]?>&multi=show');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('default.php?com=product&act=man_list&type=<?=$_REQUEST["type"]?>&multi=hide');return false;" />
        <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('default.php?com=product&act=man_list&type=<?=$_REQUEST["type"]?>&multi=del');return false;" />-->
    </div>
	
</div>
<div class="widget">
	<div class="titlee" style="padding-bottom:5px;">

    <div class="timkiem" >
    <form name="search" action="default.php" method="GET" class="form giohang_ser">
      <input name="com" value="member" type="hidden"  />
      <input name="act" value="man_list" type="hidden" />
      <input name="p" value="<?=($_GET['p']=='')?'1':$_GET['p']?>" type="hidden" />

      <input class="form_or" name="keyword" placeholder="Nhập username.." value="<?=$_REQUEST['keyword']?>" type="text" />
	  <input class="form_or" name="email" placeholder="Nhập email.." value="<?=$_REQUEST['email']?>" type="text" />
      <input class="form_or datetimepicker" name="ngaybd" id="datefm" type="text" value="<?=$_REQUEST['ngaybd']?>" placeholder="Từ ngày.."/>
      <input class="form_or datetimepicker" name="ngaykt" id="dateto" type="text" value="<?=$_REQUEST['ngaykt']?>" placeholder="Đến ngày.." />
      <input type="submit" class="blueB" value="Tìm kiếm" style="width:100px; margin:0px 0px 0px 10px;"  />
    </form>
    </div><!--end tim kiem-->
  </div>
</div>


<div class="widget">
	<div class="title">
		<span class="titleIcon">
			<input type="checkbox" id="titleCheck" name="titleCheck" />
		</span>
		<h6>Danh sách các thành viên hiện có</h6>
	</div>
	<table cellpadd_listing="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
		<thead>
			<tr>
				<td></td>
				<td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
				<td width="150">Tên</td>
				<td class="sortCol"><div>Thông tin<span></span></div></td>
				<td width="150">Số dư</td>
				<td class="tb_data_small">Kích hoạt</td>
				<td width="100">Thao tác</td>
			</tr>
		</thead>
		<tbody>
			<?php for($i=0, $count=count($items); $i<$count; $i++){?>
			<tr>
				<td>
					<input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
				</td>
				<td align="center">
					<input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự sản phẩm" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('member', '<?=$items[$i]['id']?>')" />
					<div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
				</td> 
				<td align="center">
					<?= $items[$i]['ten_vi'] ?>
				</td>
				<td class="title_name_data">
					Địa chỉ: <?=$items[$i]['diachi']?>, <?=get_district($items[$i]['district'])?>, <?=get_province($items[$i]['province'])?><br />
					Điện thoai: <?=$items[$i]['dienthoai']?><br />
					Email: <?php if($items[$i]['email']!=''){ echo $items[$i]['email'];} else { echo 'chưa có email';}?> <br />
				</td>
				<td align="center">
					<?= number_format($items[$i]['sodu'],"0",",",".") ?>
				</td>
				<td align="center">
					<input type="checkbox" data-com="hienthi" data-table="member" data-id="<?=$items[$i]['id']?>" <?php if($items[$i]['hienthi']==1) echo "checked";?> name="hienthi" value="<?=$items[$i]['id']?>" class="check_box" />
				</td>
				<td class="actBtns">
					<a href="default.php?com=member&act=edit_list&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST["type"]?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>
					<a href="" onclick="Checkdelete_list('default.php?com=member&act=delete_list&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST["type"]?>'); return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="10"><div class="pagination paging"><?= $paging['paging'] ?></div></td>
			</tr>
		</tfoot>
	</table>
</div>
</form>
<script type="text/javascript">
	
	function Checkdelete_list(l){
		if(confirm('Bạn có chắc muốn xoá bài viết này?'))
		{
			location.href = l;	
		}
	}	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn?"))
		{
			document.f.action = str;
			document.f.submit();
		}
	}
</script>