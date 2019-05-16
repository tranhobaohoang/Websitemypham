<h3><a href="default.php?com=about&act=add">Thêm giới thiệu</a></h3>
<table class="blue_table">

	<tr>
		<th style="width:5%;">STT</th>
        <th style="width:80%;">Tên</th>
	  	<th style="width:5%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</tr>
    
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;" align="center"><?=$items[$i]['stt']?></td>		        
        <td style="width:80%;" align="center"><a href="default.php?com=about&act=edit&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten']?></a></td>
		<td style="width:5%;">
        
        
		
		<?php 
		if(@$items[$i]['hienthi']==1)
		{
		?>
        <a href="default.php?com=about&act=man&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
		<? 
		}
		else
		{
		?>
         <a href="default.php?com=about&act=man&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
         <?php
		 }?>        </td>
		<td style="width:5%;" align="center"><a href="default.php?com=about&act=edit&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png"  border="0"/></a></td>
		<td style="width:5%;"><a href="default.php?com=about&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>
<a href="default.php?com=about&act=add"><img src="media/images/add.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>