<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="default.php?com=photo&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Hình ảnh</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xóa hình ảnh này?'))
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
<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='default.php?com=photo&act=add_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('default.php?com=photo&act=man_photo&multi=show<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
        <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('default.php?com=photo&act=man_photo&multi=hide<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
        <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('default.php?com=photo&act=man_photo&multi=del<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
    </div>  
    <div style="float:right;">
        <div class="selector">
			
        </div>  
    </div>      	  
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách các hình ảnh hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>       
        <td width="150">Hình ảnh</td>
        <td class="sortCol"><div>Tên hình<span></span></div></td>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10"><div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?>     </div></td>
      </tr>
    </tfoot>
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự hình ảnh" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('photo', '<?=$items[$i]['id']?>')" />
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
        <td align="center">
                <img src="<?=_upload_hinhanh.$items[$i]['photo']?>" width="100" border="0" />
                </td>
      
        <td class="title_name_data">
            <a href="default.php?com=photo&act=edit_photo&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold">
			<?php
                    $d->reset();
                    $sql="select ten from #_photo_lang where id_photo = '".$items[$i]['id']."' order by id asc";
                    $d->query($sql);
                    $result = $d->fetch_array();
                    echo $result['ten']
                  ?>
            
            </a>
        </td>
       
        <td align="center">
           <?php 
			if(@$items[$i]['hienthi']==1)
				{
		?>
            <a href="default.php?com=photo&act=man_photo&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
            <?php } else { ?>
         <a href="default.php?com=photo&act=man_photo&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
         <?php } ?>
        </td>       
        <td class="actBtns">
            <a href="default.php?com=photo&act=edit_photo&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa hình ảnh"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <a href="" onclick="CheckDelete('default.php?com=photo&act=delete_photo&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'); return false;" title="" class="smallButton tipS" original-title="Xóa hình ảnh"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>      