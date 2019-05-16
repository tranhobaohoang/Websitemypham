<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="default.php?com=about&act=man&type=<?=$_REQUEST["type"]?>"><span>Bài viết</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="f" id="f" method="post">
<?php /*
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='default.php?com=about&act=add&type=<?=$_REQUEST["type"]?>'" />
		<input type="button" class="blueB" value="Hiện" onclick="ChangeAction('default.php?com=about&act=man&type=<?=$_REQUEST["type"]?>&multi=show');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('default.php?com=about&act=man&type=<?=$_REQUEST["type"]?>&multi=hide');return false;" />
        <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('default.php?com=about&act=man&type=<?=$_REQUEST["type"]?>&multi=del');return false;" />
    </div>
	
</div>
*/ ?>



<div class="widget">
	<div class="title">
		<span class="titleIcon">
			<input type="checkbox" id="titleCheck" name="titleCheck" />
		</span>
		<h6>Danh sách các khách hàng đã đăng ký thành công</h6>
	</div>
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
		<thead>
			<tr>
				<td width="100">Tên người đăng ký</td>
				<td width="100">Email người đăng ký</td>
				<td width="100">Ngày đăng ký</td>
				<td width="100">Kích Hoạt / Tắt Kích Hoạt</td>
				<td width="100">Đã xem</td>
				<td width="100">Thao tác</td>
			</tr>
		</thead>
		<tbody>
			<?php for($i=0, $count=count($items); $i<$count; $i++){?>
			<tr>
				<td class="title_name_data">
					<a class="tipS SC_bold">
						<?=$items[$i]["ten_vi"]?>
					</a>
				</td>
				<td class="title_name_data">
					<a class="tipS SC_bold">
						<?=$items[$i]["email"]?>
					</a>
				</td>
				<td align="center">
					<?=date("d/m/Y" ,$items[$i]["ngaytao"])?>
				</td>
				<td align="center">
					<input type="checkbox" data-com="hienthi" data-table="member" data-id="<?=$items[$i]['id']?>" <?php if($items[$i]['hienthi']==1) echo "checked";?> name="hienthi" value="<?=$items[$i]['id']?>" class="check_box" />
				</td>
				<td align="center">
					<input type="checkbox" data-com="view" data-table="member" data-id="<?=$items[$i]['id']?>" <?php if($items[$i]['view']==1) echo "checked";?> name="view" value="<?=$items[$i]['id']?>" class="check_box" />
				</td>
				<td class="actBtns">
					<a href="" onclick="CheckDelete('default.php?com=thanhvien&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa thành viên"><img src="./images/icons/dark/close.png" alt=""></a>
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
	
	function CheckDelete(l){
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