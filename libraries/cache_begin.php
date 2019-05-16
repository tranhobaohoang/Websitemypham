<?php
$bd = (float) array_sum(explode(' ',microtime()));
$cachedir = _cache_folder; // folder lưu các file cache
$cachetime = _cache_time*60; // Thời gian (Số giây) lưu files cache 
$cacheext = 'cache'; // phần mở rộng của file được cache 
$page ='http://'. $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
$pathfile = $cachedir . md5($page) . '.' . $cacheext; 
$file_created =(file_exists($pathfile))? filemtime($pathfile):0;
//clearstatcache();
if (time() - $cachetime < $file_created) {
    ob_start('ob_gzhandler');
    readfile($pathfile);   //đọc 1 file và echo nội dung ra buffer  
	$kt = (float) array_sum(explode(' ',microtime()));
	echo "Xử lý trong cache: ". sprintf("%.4f", ($kt-$bd))." giây";     
  
    ob_end_flush();
    exit();
}
ob_start('ob_gzhandler');
?>
