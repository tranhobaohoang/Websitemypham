<h3><a href="default.php?com=news&act=add_photo&idc=<?= $_REQUEST['idc']; ?>">Thêm hình ảnh</a></h3>

<table class="blue_table">
    <tr>
        <th style="width:10%;">Stt</th>
        <th style="width:50%;">Hình ảnh</th>
        <th style="width:10%;">Nổi bật</th>
        <th style="width:10%;">Hiển thị</th>
        <th style="width:10%;">Sửa</th>
        <th style="width:10%;">Xóa</th>
    </tr>
    <?php for ($i = 0, $count = count($items); $i < $count; $i++) { ?>
        <tr>
            <td style="width:10%;"><?= $items[$i]['stt'] ?></td>
            <td style="width:50%;">      
                <img src="<?= _upload_tintuc . $items[$i]['photo'] ?>" width="100" height="100" />
            </td>
            <td style="width:10%;">
                <?php
                if (@$items[$i]['noibat'] == 1) {
                    ?>

                    <a href="default.php?com=news&act=man_photo&noibat=<?= $items[$i]['id'] ?><?php if ($_REQUEST['idc'] != '') echo'&idc=' . $_REQUEST['idc']; ?><?php if ($_REQUEST['curPage'] != '') echo'&curPage=' . $_REQUEST['curPage']; ?>"><img src="media/images/active_1.png" border="0" /></a>
                    <? 
                    }
                    else
                    {
                    ?>
                    <a href="default.php?com=news&act=man_photo&noibat=<?= $items[$i]['id'] ?><?php if ($_REQUEST['idc'] != '') echo'&idc=' . $_REQUEST['idc']; ?><?php if ($_REQUEST['curPage'] != '') echo'&curPage=' . $_REQUEST['curPage']; ?>"><img src="media/images/active_0.png"  border="0"/></a>
                <?php }
                ?>   
            </td>
            <td style="width:10%;">
                <?php
                if (@$items[$i]['hienthi'] == 1) {
                    ?>

                    <a href="default.php?com=news&act=man_photo&hienthi=<?= $items[$i]['id'] ?><?php if ($_REQUEST['idc'] != '') echo'&idc=' . $_REQUEST['idc']; ?><?php if ($_REQUEST['curPage'] != '') echo'&curPage=' . $_REQUEST['curPage']; ?>"><img src="media/images/active_1.png" border="0" /></a>
                    <? 
                    }
                    else
                    {
                    ?>
                    <a href="default.php?com=news&act=man_photo&hienthi=<?= $items[$i]['id'] ?><?php if ($_REQUEST['idc'] != '') echo'&idc=' . $_REQUEST['idc']; ?><?php if ($_REQUEST['curPage'] != '') echo'&curPage=' . $_REQUEST['curPage']; ?>"><img src="media/images/active_0.png"  border="0"/></a>
                <?php }
                ?>   
            </td>
            <td style="width:10%;" align="center"><a href="default.php?com=news&act=edit_photo&id_photo=<?= $items[$i]['id_photo'] ?>&id=<?= $items[$i]['id'] ?>"><img src="media/images/edit.png"  border="0"/></a></td>
            <td style="width:10%;"><a href="default.php?com=news&act=delete_photo&idc=<?= $_REQUEST['idc'] ?>&id=<?= $items[$i]['id'] ?>" onClick="if (!confirm('Xác nhận xóa'))
                        return false;"><img src="media/images/delete.png" border="0" /></a></td>
        </tr>
    <?php } ?>
</table>
<a href="default.php?com=news&act=add_photo&idc=<?= $_REQUEST['idc']; ?>"><img src="media/images/add.jpg" border="0"  /></a>
<div class="paging"><?= $paging['paging'] ?></div>