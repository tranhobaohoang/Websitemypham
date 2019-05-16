<?php
session_start();
$session = session_id();
@define('_template', '../templates/');
@define('_source', '../sources/');
@define('_lib', '../admin/lib/');

include_once _lib . "config.php";
include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "class.database.php";
include_once _lib . "functions_giohang.php";
include_once _lib . "file_requick.php";
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'vi';
}

$lang = $_SESSION['lang']; //Lấy ngỗn ngữ
require_once _source . "lang_$lang.php";
?>

<?php
//PAGE NUMBER, RESULTS PER PAGE, AND OFFSET OF THE RESULTS
if ($_GET["page"]) {
    $pagenum = $_GET["page"];
} else {
    $pagenum = 1;
}

$rowsperpage = 4; //MAXIMUM RESULTS PER PAGE
$offset = ($pagenum - 1) * $rowsperpage; //WHERE THE RESULTS START FROM
//FOR RESULTS OF THE PAGE
$d->reset();
$sql = "select id,ten_$lang as ten,tenkhongdau from #_product_list where hienthi=1 order by stt,id desc LIMIT $offset, $rowsperpage";
$d->query($sql);
$product = $d->result_array();


$sql = "SELECT * FROM #_product_list where hienthi=1";
$total_q = $d->query($sql); //FOR ALL RESULTS
$results = $d->result_array();
$total_nums = count($results); //TOTAL NUMBER OF RESULTS
$total_pages = ceil($total_nums / $rowsperpage); //NUMBER OF PAGES
//IF PAGE NUMBER IS WITHIN THE FIRST AND LAST PAGES...


if ($pagenum >= 1 && $pagenum <= $total_pages) {
    $dem = 0;
    ?>
    <?php
    foreach ($product as $v) {
        $dem++;
        ?>
        <div class="box_content"> 
            <div class="tcat"><div class="icon"><?= $v['ten'] ?></div></div>

            <div class="owl-demo owl-carousel owl-theme">
                <?php
                $sql = "select ten_$lang as ten,id,tenkhongdau,photo,thumb from #_product_cat where hienthi =1 and id_list='" . $v['id'] . "'  order by stt";
                $d->query($sql);
                $result = $d->result_array();

                for ($i = 0, $count = count($result); $i < $count; $i++) {
                    ?>       
                    <div class="item item_product">
                        <div class="images"><a href="c2-<?= $result[$i]['tenkhongdau'] ?>/" ><img src="<?= _upload_product_l . $result[$i]['thumb'] ?>" class="img-responsive" alt="<?= $result[$i]['ten'] ?>" /></a>      
                        </div>          
                        <div class="name"><a href="c2-<?= $result[$i]['tenkhongdau'] ?>/"><?= $result[$i]['ten'] ?></a></div>                                                         
                    </div>
                <?php } ?> 
                <div class="clear"></div>
            </div>

        </div><!---END .wap_item-->  

    <?php } ?>
<?php } ?>
