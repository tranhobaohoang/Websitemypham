<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="default.php?com=video&act=man"><span>Video</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá Video này?'))
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
function select_onchange()
	{
		var a=document.getElementById("id_cat");
		window.location ="default.php?com=video&act=man&id_cat="+a.value;	
		return true;
	}					
</script>
<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='default.php?com=video&act=add'" />
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('default.php?com=video&act=man&multi=show');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('default.php?com=video&act=man&multi=hide');return false;" />
        <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('default.php?com=video&act=man&multi=del');return false;" />
    </div>  
      
    	   
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách các Video hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>       
        <td width="150">Hình ảnh</td>
        <td class="sortCol"><div>Tên Video<span></span></div></td>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="100">Nổi bật</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
   
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự Video" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('video', '<?=$items[$i]['id']?>')" />
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
        <td align="center">
                <?php if($items[$i]['photo']!=''){ ?>
                <img src="<?=_upload_hinhanh.$items[$i]['photo']?>" width="100" border="0" />
                <?php } else { ?>
                <img src="images/no_image.jpg"  />
                <?php } ?>
                </td>
      
				<td class="title_name_data">
					<a href="default.php?com=video&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold">
						<?=$items[$i]['ten_vi']?>
					</a>
				</td>
       
				<td align="center">
					<input type="checkbox" data-com="hienthi" data-table="video" data-id="<?=$items[$i]['id']?>" <?php if($items[$i]['hienthi']==1) echo "checked";?> name="hienthi" value="<?=$items[$i]['id']?>" class="check_box" />
				</td>
				<td align="center">
					<input type="checkbox" data-com="noibat" data-table="video" data-id="<?=$items[$i]['id']?>" <?php if($items[$i]['noibat']==1) echo "checked";?> name="noibat" value="<?=$items[$i]['id']?>" class="check_box" />
				</td>
				<td class="actBtns">
					<a href="default.php?com=video&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa Video"><img src="./images/icons/dark/pencil.png" alt=""></a>
					<a href="" onclick="CheckDelete('default.php?com=video&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa Video"><img src="./images/icons/dark/close.png" alt=""></a>
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