<h3><a href="default.php?com=hinhanh&act=add_photo&idc=<?=$_REQUEST['idc'];?>">Thêm hình ảnh</a></h3>

<table class="blue_table">
	<tr>
		<th style="width:5%;">STT</th>
        <th style="width:5%;">ID</th>
		<th style="width:75%;">Hình ảnh</th>
		<th style="width:5%;">Hiển thị</th>
        <th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;"><?=$items[$i]['stt']?></td>
        <td style="width:5%;"><?=$items[$i]['id']?></td>
		<td style="width:75%;">      
        <img src="<?=_upload_hinhanh.$items[$i]['photo']?>" width="100" height="100" />
        </td>
		<td style="width:5%;">
			<?php 
		if(@$items[$i]['hienthi']==1)
		{
		?>
        
        <a href="default.php?com=hinhanh&act=man_photo&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['idc']!='') echo'&idc='. $_REQUEST['idc'];?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_1.png" border="0" /></a>
		<? 
		}
		else
		{
		?>
         <a href="default.php?com=hinhanh&act=man_photo&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['idc']!='') echo'&idc='. $_REQUEST['idc'];?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_0.png"  border="0"/></a>
         <?php
		 }?>   
        </td>
        <td style="width:5%;"><a href="default.php?com=hinhanh&act=edit_photo&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" border="0" /></a></td>
		<td style="width:5%;"><a href="default.php?com=hinhanh&act=delete_photo&idc=<?=$_REQUEST['idc']?>&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>
<a href="default.php?com=hinhanh&act=add_photo&idc=<?=$_REQUEST['idc'];?>"><img src="media/images/add.jpg" border="0"  /></a>
<div class="paging"><?=$paging['paging']?></div>