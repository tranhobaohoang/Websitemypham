<table class="blue_table">

    <tr>
        <th style="width:5%;">ID</th>
        <th style="width:60%;">Nội dung</th>
        <th style="width:20%;">Bài viết</th>	 	
        <th style="width:5%;">Hiển thị</th>	
        <th style="width:5%;">Xóa</th>
    </tr>

    <?php for ($i = 0, $count = count($items); $i < $count; $i++) { ?>
        <tr>		
            <td style="width:5%;" align="center"><?= $items[$i]['id'] ?></td>		        
            <td style="width:60%; text-align:left">
                <b>Tiêu đề:</b> <?= $items[$i]['tieude'] ?><br/>
                <b>Họ tên:</b> <?= $items[$i]['hoten'] ?><br/>
                <b>Email:</b> <?= $items[$i]['email'] ?><br/>
                <b>Nội dung:</b> <?= $items[$i]['noidung'] ?>

            </td>		                          
            <td style="width:20%;">
                <?php
                $sql_danhmuc = "select tenkhongdau,id from table_product where id='" . $items[$i]['id_product'] . "'";
                $result = mysql_query($sql_danhmuc);
                $item_danhmuc = mysql_fetch_array($result);
                $item_danhmuc['tenkhongdau'];
                ?>  
                <a href="http://<?= $config_url ?>/san-pham/<?= $item_danhmuc['tenkhongdau'] ?>-<?= $item_danhmuc['id'] ?>.html" target="_blank">Sản phẩm</a>
            </td>
            <td style="width:5%;">
                <?php
                if (@$items[$i]['hienthi'] == 1) {
                    ?>
                    <a href="default.php?com=product&act=duyetbl&hienthi=<?= $items[$i]['id'] ?>"><img src="media/images/active_1.png"  border="0"/></a>
                    <? 
                    }
                    else
                    {
                    ?>
                    <a href="default.php?com=product&act=duyetbl&hienthi=<?= $items[$i]['id'] ?>"><img src="media/images/active_0.png" border="0" /></a>
                <?php }
                ?>        </td>		
            <td style="width:5%;"><a href="default.php?com=product&act=delete_binhluan&id=<?= $items[$i]['id'] ?>" onClick="if (!confirm('Xác nhận xóa'))
                        return false;"><img src="media/images/delete.png" border="0" /></a></td>
        </tr>
    <?php } ?>
</table>
<div class="paging"><?= $paging['paging'] ?></div>