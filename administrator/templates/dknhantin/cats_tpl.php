<script type="text/javascript" src="js/my_script.js"></script>
<script type="text/javascript">

    function js_submit() {
        if (isEmpty(document.getElementById('tieude1'), "Xin nhập Chủ đề.")) {
            document.getElementById('tieude1').focus();
            return false;
        }
		var listid = "";
		$("input[class='chon']").each(function () {
			if (this.checked)
				listid = listid + "," + this.value;
		})
		listid = listid.substr(1);	 //alert(listid);
		if (listid == "") {
			alert("Bạn chưa chọn mục nào");
			return false;
		}
		hoi = confirm("Bạn có chắc chắn muốn gửi cho những mail này?");
		if (hoi == true)
			//document.location = "default.php?com=dknhantin&act=guitin&listid=" + listid;

        document.frm.submit();
    }
    $(document).ready(function () {
        $("#chonhet").click(function () {
            var status = this.checked;

            $("input[class='chon']").each(function () {
                this.checked = status;
            })
        });

        $("#guitin").click(function () {
            
        });
    });

</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li class="current"><a href="#" onclick="return false;">Đăng kí nhận tin</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form method="post" class="form" name="frm" action="">
<div class="widget">
	<div class="title">
		<span class="titleIcon">
			<input type="checkbox" id="titleCheck" name="titleCheck" />
		</span>
		<h6>Danh sách các bài viết hiện có</h6>
	</div>
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
		<thead>
			<tr>
				<td></td>
				<td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
				<td class="sortCol"><div>Email<span></span></div></td>
				<!--<td width="200">Thao tác</td>-->
			</tr>
		</thead>
		<tbody>
			<?php for($i=0, $count=count($items); $i<$count; $i++){?>
			<tr>
				<td>
					<input type="checkbox" name="chon[]" class="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
				</td>
				<td align="center">
					<input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự sản phẩm" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('dknhantin', '<?=$items[$i]['id']?>')" />
					<div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
				</td> 
				<td class="title_name_data">
					<a href="default.php?com=dknhantin&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST["type"]?>" class="tipS SC_bold">
						<?=$items[$i]["email"]?>
					</a>
				</td>
		   
				<!--<td class="actBtns">
					<a href="default.php?com=dknhantin&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST["type"]?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>
					<a href="" onclick="CheckDelete('default.php?com=dknhantin&act=delete&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST["type"]?>'); return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
				</td>-->
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="10"><div class="pagination paging"><?= $paging['paging'] ?></div></td>
			</tr>
		</tfoot>
	</table>
	<div class="title">
		<h6>Gửi mail</h6>
	</div>
	<div class="formRow">
		<label>Chủ đề:</label>
		<div class="formRight">
			<input type="text" name="tieude1" title="Nhập tiêu đề mail" id="tieude1" class="tipS"  />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Nội dung mail: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
		<div class="formRight">
			<textarea name="noidung" cols="50" rows="5" class="ta_noidung editor" id="noidung" ></textarea>
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<input class="btn btn-success" type="button" value="Gửi" id="guitin" onclick="js_submit();" />
		<div class="clear"></div>
	</div>
</div>
</form>
<script type="text/javascript">
	
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá mail này?'))
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