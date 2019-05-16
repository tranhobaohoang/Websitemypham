<?php
#================================= san pham nổi bật 
$d->reset();
$sql_sp_noibat = "select * from #_product  where spdc!=0 and hienthi=1 order by spdc asc  limit 0,10";
$d->query($sql_sp_noibat);
$row_sp_noibat = $d->result_array();

#=================================Tin tức nổi bật

$d->reset();
$sql_tinnoibat = "select * from #_news  where tinnoibat<>0 and hienthi=1 order by tinnoibat asc  limit 0,8";
$d->query($sql_tinnoibat);
$row_tinnoibat = $d->result_array();

#=====HOTLINE=====================

$d->reset();
$sql_hotline = "select * from #_hotline";
$d->query($sql_hotline);
$row_hotline = $d->result_array();
?>





<td width="198" valign="top" style="padding-left: 7px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="198" height="73" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td height="32" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="17" height="32" background="images/top-left-title.gif"></td>
                                    <td width="163" background="images/top-title.gif" align="center" class="title">DỰ ÁN TIÊU BIỂU</td>
                                    <td width="18" background="images/top-right-title.gif"></td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td height="40" valign="top" style="border-left: 1px solid #245b88; border-right: 1px solid #245b88; border-bottom: 1px solid #245b88; padding: 10px 20px 10px 20px"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                    <td height="80" valign="top">




                                        <div style="height: 300px; width: 171px; font-size: 12px; overflow: hidden" id="marqueebox0">

                                            <div>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td align="center" style="padding-bottom: 10px">

                                                            <?php
                                                            for ($i = 0, $count_sp_noibat = count($row_sp_noibat); $i < $count_sp_noibat; $i++) {
                                                                ?>


                                                                <a href="#"><img src="<?= _upload_sanpham_l . $row_sp_noibat[$i]['photo'] ?>" width="155" height="113"  border="0" /></a>
                                                                <br />

                                                            <?php }
                                                            ?>

                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>



                                        <script>
                                            function startmarquee(lh, speed, delay, index) {
                                                var t;
                                                var p = false;
                                                var o = document.getElementById("marqueebox" + index);
                                                o.innerHTML += o.innerHTML;
                                                o.onmouseover = function () {
                                                    p = true
                                                }
                                                o.onmouseout = function () {
                                                    p = false
                                                }
                                                o.scrollTop = 0;
                                                function start() {
                                                    t = setInterval(scrolling, speed);
                                                    if (!p)
                                                        o.scrollTop += 2;
                                                }
                                                function scrolling() {
                                                    if (o.scrollTop % lh != 0) {
                                                        o.scrollTop += 2;
                                                        if (o.scrollTop >= o.scrollHeight / 2)
                                                            o.scrollTop = 0;
                                                    } else {
                                                        clearInterval(t);
                                                        setTimeout(start, delay);
                                                    }
                                                }
                                                setTimeout(start, delay);
                                            }
                                            startmarquee(300, 30, 2000, 0);


                                            //--> 
                                        </script>  


                                    </td>

                                </tr>
                            </table></td>
                    </tr>
                </table></td>
        </tr>

        <tr>
            <td height="28">&nbsp;</td>
        </tr>

        <tr>
            <td width="198" height="73" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td height="32" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="17" height="32" background="images/top-left-title.gif"></td>
                                    <td width="163" background="images/top-title.gif" align="center" class="title">TIN TỨC NỔI BẬT</td>
                                    <td width="18" background="images/top-right-title.gif"></td>
                                </tr>
                            </table></td>
                    </tr>



                    <tr>
                        <td height="66" valign="top"  style="border-left: 1px solid #245b88; border-right: 1px solid #245b88; border-bottom: 1px solid #245b88; padding: 0 5px 0 15px"><table width="100%" border="0" cellspacing="0" cellpadding="0" >




                                <?php
                                for ($i = 0, $count_tinnoibat = count($row_tinnoibat); $i < $count_tinnoibat; $i++) {
                                    ?>
                                    <tr>
                                        <td height="26" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="16" height="26"  align="left"><img src="images/icon.gif" width="5" height="5" /></td>
                                                    <td width="166" align="left" class="left-menu"><a href="index.php?com=news&id=<?= $row_tinnoibat[$i]['id'] ?>">

                                                            <?= $row_tinnoibat[$i]['ten'] ?>

                                                        </a></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" height="1" background="images/bar-tag.gif"></td>
                                                </tr>
                                            </table>   
                                        </td>
                                    </tr>

                                <?php }
                                ?> 



                            </table></td>
                    </tr>

                    <tr>
                        <td height="28">&nbsp;</td>
                    </tr>


                </table></td>
        </tr>


        <tr>
            <td height="5">&nbsp;</td>
        </tr>

        <tr>
            <td width="198" height="73" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td height="32" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="17" height="32" background="images/top-left-title.gif"></td>
                                    <td width="163" background="images/top-title.gif" align="center" class="title">HOTLINE</td>
                                    <td width="18" background="images/top-right-title.gif"></td>
                                </tr>
                            </table></td>
                    </tr>



                    <tr>
                        <td height="66" valign="top"  style="border-left: 1px solid #245b88; border-right: 1px solid #245b88; border-bottom: 1px solid #245b88; padding: 0 5px 0 15px"><table width="100%" border="0" cellspacing="0" cellpadding="0" >





                                <tr>
                                    <td height="26" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">


                                            <tr>
                                                <td height="122" align="center"><img src="images/ho-tro-img.jpg" width="186" height="122" /></td>
                                            </tr>

                                            <tr>
                                                <td height="26"  align="center"  style="color:#990000; font-size:16px;">

                                                    <?= $row_hotline[0]['dienthoai'] ?>

                                                    </a></td>
                                            </tr>

                                        </table>   
                                    </td>
                                </tr>




                            </table></td>
                    </tr>

                    <tr>
                        <td height="28">&nbsp;</td>
                    </tr>


                </table></td>
        </tr>



    </table></td>