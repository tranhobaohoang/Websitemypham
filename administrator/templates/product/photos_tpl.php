<h3><a href="default.php?com=product&act=add_photo&idc=<?= $_REQUEST['idc']; ?>&type1=<?= $_REQUEST['type1']; ?>">Thêm hình ảnh</a></h3>

<table class="blue_table">
    <tr>
        <th style="width:10%;">Stt</th>
        <th style="width:40%;">Hình ảnh</th>
		<th style="width:20%;">Vị trí</th>
        <th style="width:10%;">Hiển thị</th>
		<th style="width:10%;">Sửa</th>
        <th style="width:10%;">Xóa</th>
    </tr>
    <?php for ($i = 0, $count = count($items); $i < $count; $i++) { ?>
        <tr>
            <td style="width:10%;"><?= $items[$i]['stt'] ?></td>
            <td style="width:40%;">      
                <img src="<?= _upload_product . $items[$i]['photo'] ?>" height="100" />
            </td>
			<td style="width:20%;">      
                <?php if($items[$i]["vitri"]==1){ echo "Vị trí 1";}
				else if($items[$i]["vitri"]==2) { echo "Vị trí 2";}
				else { echo "Vị trí 3";}?>
            </td>
            <td style="width:10%;">
                <?php
                if (@$items[$i]['hienthi'] == 1) {
                    ?>

                    <a href="default.php?com=product&act=man_photo&hienthi=<?= $items[$i]['id'] ?><?php if ($_REQUEST['idc'] != '') echo'&idc=' . $_REQUEST['idc']; ?><?php if ($_REQUEST['curPage'] != '') echo'&curPage=' . $_REQUEST['curPage']; ?>&type1=<?= $_REQUEST['type1']; ?>"><img src="media/images/active_1.png" border="0" /></a>
                    <? 
                    }
                    else
                    {
                    ?>
                    <a href="default.php?com=product&act=man_photo&hienthi=<?= $items[$i]['id'] ?><?php if ($_REQUEST['idc'] != '') echo'&idc=' . $_REQUEST['idc']; ?><?php if ($_REQUEST['curPage'] != '') echo'&curPage=' . $_REQUEST['curPage']; ?>&type1=<?= $_REQUEST['type1']; ?>"><img src="media/images/active_0.png"  border="0"/></a>
                <?php }
                ?>   
            </td>
			<td style="width:10%;"><a href="default.php?com=product&act=edit_photo&idc=<?= $_REQUEST['idc'] ?>&id=<?= $items[$i]['id'] ?>&type1=<?= $_REQUEST['type1']; ?>"><img src="media/images/edit.png" border="0" /></a></td>
            <td style="width:10%;"><a href="default.php?com=product&act=delete_photo&idc=<?= $_REQUEST['idc'] ?>&id=<?= $items[$i]['id'] ?>&type1=<?= $_REQUEST['type1']; ?>" onClick="if (!confirm('Xác nhận xóa'))
                        return false;"><img src="media/images/delete.png" border="0" /></a></td>
        </tr>
    <?php } ?>
</table>
<a href="default.php?com=product&act=add_photo&idc=<?= $_REQUEST['idc']; ?>&type1=<?= $_REQUEST['type1']; ?>"><img src="media/images/add.jpg" border="0"  /></a>
<div class="paging"><?= $paging['paging'] ?></div>