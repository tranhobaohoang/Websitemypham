<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";		
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
	$login_name = 'NINACO';




	
	if($_REQUEST['author']){
		header('Content-Type: text/html; charset=utf-8');
		echo '<pre>';
		print_r($config['author']);
		echo '</pre>';
		die();
	}

	$d = new database($config['database']);	

	$archive = new PclZip(@$file);
	
	
	//Thoát
	if($com=='user' && $act=='logout'){
		session_unset();
		transfer("Đăng xuất thành công", "login.php");
	}
	
	
	//Kiểm tra đăng nhập
	if(!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false){
		$_SESSION['back']= $_SERVER['REQUEST_URI'];	
		header('Location: login.php');		
	}
	
	$id_role=$_SESSION['login']['role'];
	
	switch($com){
		
		case 'getProduct':
			$source = "getProduct";
			break;
		case 'giasearch':
			$source = "giasearch";
			break;
		case 'popub':
			$source = "popub";
			break;
		case 'prices':
			$source = "prices";
			break;
		case 'hinhanh':
			$source = "hinhanh";
			break;
		case 'dknhantin':
			$source = "dknhantin";
			break;
		
		case 'contact':
			$source = "contact";
			break;
		
		case 'quangcao':
			$source = "quangcao";
			break;
		case 'news':
			$source = "news";
			break;
		case 'about':
			$source = "about";
			break;
		case 'lienhe':
			$source = "lienhe";
			break;
		case 'footer':
			$source = "footer";
			break;
		case 'icon':
			$source = "icon";
			break;
		case 'time':
			$source = "time";
			break;
		case 'slider':
			$source = "slider";
			break;
		case 'thuonghieu':
			$source = "thuonghieu";
			break;
		case 'doitac':
			$source = "doitac";
			break;		
		case 'background':
			$source = "background";
			break;
		case 'video':
			$source = "video";
			break;
		case 'place':
			$source = "place";
			break;
		case 'order':
			$source = "donhang";
			break;
		case 'post':
			$source = "post";
			break;
		case 'database':
			$source = "database";
			break;
		case 'backup':
			$source = "backup";
			break;		
		case 'info':
			$source = "info";
			break;
		case 'product':
			$source = "product";
			break;
		case 'user':
			$source = "user";
			break;	
		case 'member':
			$source = "member";
			break;
		case 'thanhvien':
			$source = "thanhvien";
			break;
		case 'lkweb':
			$source = "lkweb";
			break;		
		case 'photo':
			$source = "photo";
			break;														
		case 'setting':
			$source = "setting";
			break;										
		case 'yahoo':
			$source = "yahoo";
			break;										
		case 'bannerqc':
			$source = "bannerqc";
			break;
		default: 
			$source = "";
			$template = "index";
			break;
	}
			
	if($source!="") include _source.$source.".php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator - Hệ thống quản trị nội dung</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="js/plugins/multiupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="js/plugins/multiupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/external.js"></script>
<!-- MultiUpload -->
<script type="text/javascript" src="js/plugins/multiupload/jquery.filer.min.js"></script>
<!-- MultiUpload -->
<!-- ColorPick -->
<link href="js/plugins/colorpick/colpick.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/plugins/colorpick/colpick.js"></script>
<link href="../assets/css/bootstrap-switch.min.css" rel="stylesheet">
<script type="text/javascript" src="../assets/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js" charset="utf-8"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js" charset="utf-8"></script>
</head>
<body <?php if($source=='setting') echo 'onload="load()"'?>>
<!-- Left side content --> 
<script type="text/javascript">
var base_url = "https://<?=$config_url?>";
$(function(){
	var num = $('#menu').children(this).length;
	for (var index=0; index<=num; index++)
	{
		var id = $('#menu').children().eq(index).attr('id');
		$('#'+id+' strong').html($('#'+id+' .sub').children(this).length);
		$('#'+id+' .sub li:last-child').addClass('last');
	}
	$('#menu .activemenu .sub').css('display', 'block');
	$('#menu .activemenu a').removeClass('inactive');
})
	$(document).ready(function(){
		$(".editor").each(function(){
			$id=$(this).attr("id");
			var editor = CKEDITOR.replace(''+$id, {
				uiColor: '#EAEAEA',
				language: 'vi',
				basicEntities: false,				
				entities_greek: false,				
				entities_latin: false,	
				entities: false,
				htmlEncodeOutput: false,
				resize_enabled: false,
				removePlugins: 'resize',
				removePlugins : 'elementspath',
						height: 300,
				filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
				filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
				filebrowserLinkBrowseUrl: 'ckfinder/ckfinder.html',
				filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
				filebrowserLinkUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload',
			});
		})
	})
	$(document).ready(function(){
		$(".check_box").click(function(){
			$id=$(this).data('id');
			$act=$(this).data('com');
			$table=$(this).data('table');
			$.ajax({
				type:"POST",
				url:"ajax/xulysp.php",
				data:{id:$id,act:"capnhat", fiel: $act,table:$table},
				success: function(data){
				}
			})
		})
	})
</script>
<div id="leftSide">
  <?php include _template."left_tpl.php";?>
</div>
<!-- Right side -->
<div id="rightSide"> 
  <!-- Top fixed navigation -->
  <div class="topNav">
    <?php include _template."header_tpl.php";?>
  </div>
  <div class="wrapper">
    <?php include _template.$template."_tpl.php";?>
  </div>
</div>
<div class="clear"></div>
</body>
</html>
