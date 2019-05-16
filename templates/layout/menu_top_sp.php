<?php
$d->reset();
$sql_m_dmsp = "select id,ten,tenkhongdau from #_product_cat where hienthi=1 and noibat>0 order by stt,id desc";
$d->query($sql_m_dmsp);
$result_m_dmsp = $d->result_array();

$d->reset();
$sql_tinmoi = "select ten,tenkhongdau,id from #_news where hienthi=1 order by stt,id desc limit 0,5";
$d->query($sql_tinmoi);
$result_tinmoi = $d->result_array();

$d->reset();
$sql_m_kynang = "select id,ten,tenkhongdau from #_product_kynang where hienthi=1 order by stt,id desc";
$d->query($sql_m_kynang);
$result_m_kynang = $d->result_array();
?>
<div class="menu">
    <ul>			
        <li <?php if ($idc == '0') echo 'class="active"' ?>>
            <a href="san-pham.html"><span class="pmenuL"></span><span class="pmenuM">Gian hàng đồ chơi</span><span class="pmenuR"></span></a>
            <ul class="smenu-other">
                <li><img src="images/hotnews.png" />
                <marquee direction="left" scrollamount="3" scrolldelay="5" width="790" onmouseover="stop()" onmouseout="start()">
                    <?php for ($i = 0, $count_tinmoi = count($result_tinmoi); $i < $count_tinmoi; $i++) { ?>			           
                        <a href="tin-tuc/<?= $result_tinmoi[$i]['id'] ?>/<?= $result_tinmoi[$i]['tenkhongdau'] ?>.html"><?= $result_tinmoi[$i]['ten'] ?></a>           
                    <?php } ?></marquee></li>
    </ul>
</li>
<li>
    <a href="san-pham.html"><span class="pmenuL"></span><span class="pmenuM">Theo kỹ năng</span><span class="pmenuR"></span></a>
    <ul class="smenu-other">
        <?php for ($i = 0, $count_kynang = count($result_m_kynang); $i < $count_kynang; $i++) { ?>	
            <li>                 
                <a href="ky-nang/<?= $result_m_kynang[$i]['tenkhongdau'] ?>.html"><?= $result_m_kynang[$i]['ten'] ?></a>           
            </li>
        <?php } ?>
    </ul>
</li>					
<?php for ($i = 0, $count_m_dmsp = count($result_m_dmsp); $i < $count_m_dmsp; $i++) { ?>
    <li <?php if ($result_m_dmsp[$i]['id'] == $idc) echo 'class="active"' ?>><a href="san-pham/<?= $result_m_dmsp[$i]['tenkhongdau'] ?>.html"><span class="pmenuL"></span><span class="pmenuM"><?= $result_m_dmsp[$i]['ten'] ?></span><span class="pmenuR"></span></a>
        <ul class="smenu-other">	
            <?php
            $sql = "select ten,tenkhongdau from #_product_item where hienthi=1 and id_cat='" . $result_m_dmsp[$i]['id'] . "' order by stt,id desc";
            $d->query($sql);
            $reuslt = $d->result_array();
            for ($j = 0, $count = count($reuslt); $j < $count; $j++) {
                ?>
                <li><a href="san-pham/<?= $result_m_dmsp[$i]['tenkhongdau'] ?>/<?= $reuslt[$i]['tenkhongdau'] ?>.html"><?= $reuslt[$j]['ten'] ?></a></li>
            <?php } ?>
        </ul>
    </li>					
<?php } ?>           
</ul>
</div>
