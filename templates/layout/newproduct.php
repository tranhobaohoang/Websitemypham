<?php
//-------- Lay san pham ban chay
$d->reset();
$sql_spbanchay = "select id,ten,mota,photo,giaban from #_product  where hienthi='1' and spbanchay >0 order by id desc";
$d->query($sql_spbanchay);
$spbanchay = $d->result_array();
?>
<div class="box">
    <div class="tcat">Sản phẩm bán chạy</div>
    <div class="content" style="padding:5px;">
        <div id="ctsdiv" style="text-align:center; position:relative; height:230px; overflow:hidden">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="ctstbl" style="position:relative; margin:0px">
                <tr>

                    <?php for ($i = 0, $count_banchay = count($spbanchay); $i < $count_banchay; $i++) { ?>       
                        <td valign="top">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td valign="top">

                                        <div class="box_sp" style="margin-right:10px; margin-left:10px;">
                                            <a href="?com=product&id=<?= $spbanchay[$i]['id'] ?>"><img src="<?= _upload_sanpham_l . $spbanchay[$i]['photo'] ?>" border="0" width="200" height="175" /><br/>
                                                <?= $spbanchay[$i]['ten'] ?><br/></a>
                                            Giá: <span><?php
                                                if ($spbanchay[$i]['giaban'] == 0)
                                                    echo 'Liên hệ';
                                                else
                                                    echo number_format($spbanchay[$i]['giaban'], 0, ",", ".") . " VNĐ";
                                                ?></span>
                                        </div>                            
                                    </td>
                                </tr>
                            </table>
                        </td>
                    <?php } ?> 
                </tr>       
            </table>
        </div>
        <script type="text/javascript" src="js/ImageScroller.js"></script>
        <script type="text/javascript">createScroller("myScroller", "ctsdiv", "ctstbl", 1, 20, 1, 0, 1);</script>  
        <div class="clear"></div>
    </div>
</div>