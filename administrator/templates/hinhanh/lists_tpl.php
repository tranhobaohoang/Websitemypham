<h3><a href="default.php?com=img&act=add_list">Thêm danh mục</a></h3>
<table class="blue_table">
	<tr>
		<th style="width:5%;">STT</th>
		<th style="width:80%;">Danh mục </th>	
		<th style="width:5%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;"><?=$items[$i]['stt']?></td>
		<td align="center" style="width:80%;"><?=$items[$i]['ten']?> </td>		
		<td style="width:5%;">
		
        <?php 
		if(@$items[$i]['hienthi']==1)
		{
		?>
        <a href="default.php?com=img&act=man_list&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
		<? 
		}
		else
		{
		?>
         <a href="default.php?com=img&act=man_list&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
         <?php
		 }?>
        
        
        
        </td>
		<td style="width:5%;"><a href="default.php?com=img&act=edit_list&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" border="0" /></a></td>
		<td style="width:5%;"><a href="default.php?com=img&act=delete_list&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>

<a href="default.php?com=img&act=add_list"><img src="media/images/add.jpg" border="0"  /></a>
<div class="paging"><?=$paging['paging']?></div>