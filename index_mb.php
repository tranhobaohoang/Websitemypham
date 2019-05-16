<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="vi">
    <head>
        <base href="http://<?= $config_url ?>/"  />
		<title><?= ($title_custom != '') ? $title_custom : $title_bar . $row_setting['title_' . $lang] ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="<?= ($keywords_custom != '') ? $keywords_custom : $row_setting['keywords_' . $lang] ?>" />
        <meta name="description" content="<?= ($description_custom != '') ? $description_custom : $row_setting['description_' . $lang] ?>" />
        <meta name="author" content="<?=$row_setting["ten_vi"]?>" />
        <meta name="copyright" content="<?=$row_setting["ten_vi"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="DC.title" content="<?= ($title_custom != '') ? $title_custom : $title_bar . $row_setting['title_' . $lang] ?>" />
		<meta name="DC.language" scheme="utf-8" content="vi" />
		<meta name="DC.identifier" content="<?= $row_setting['website'] ?>" />
		<meta name="robots" content="noodp,index,follow" />
		<meta name='revisit-after' content='1 days' />
		<meta http-equiv="content-language" content="vi" />
		<meta property="og:site_name" content="<?= ($title_custom != '') ? $title_custom : $title_bar . $row_setting['title_' . $lang] ?>" />
		<meta property="og:url" content="<?= getCurrentPageUrl() ?>" />
		<meta type="og:url" content="<?= getCurrentPageUrl(); ?>" >
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?= ($title_custom != '') ? $title_custom : $title_bar . $row_setting['title_' . $lang] ?>" />
		<meta property="og:image" content="<?php echo (isset($image_share) ? $image_share : '')?>" />
		<meta property="og:description" content="<?= ($description_custom != '') ? $description_custom : $row_setting['description_' . $lang] ?>" />
		<link href="<?= _upload_hinhanh_l . $row_setting['fav'] ?>" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="assets/font/font-awesome-4.2.0/css/font-awesome.css"/>
		<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.2.0/css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/font.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/animate.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/popup.css"/>
		<link rel="stylesheet" type="text/css" href="assets/js/aos/aos.css"/>
		<link rel="stylesheet" type="text/css" href="assets/js/owlcarousel/owl.carousel_mb.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="assets/js/menu/menumaker.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/style_mobile.css"/>
		<link rel="stylesheet" type="text/css" href="assets/js/magiczoomplus/magiczoomplus.css"/>
		<link rel="stylesheet" type="text/css" href="assets/js/ivewslider/style.css"/>
		<link rel="stylesheet" type="text/css" href="assets/js/ivewslider/iview.css"/>
		<link rel="stylesheet" type="text/css" href="assets/js/sweet-alert/sweet-alert.css"/>
		<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<style>
			<?php //echo file_get_contents('http://'.$config_url.'/css.php');?>
		</style>
		
		<!-- xuất mã google analytics -->
		<?= $row_setting['gg'] ?>
		<!-- end xuất mã google analytics -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ba0a8961ca8dc12"></script>
	</head>
	<body onLoad="initialize()">
		
		<div id="fb-root"></div>
		<script>(function (d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id))
				return;
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=362166527297572&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div id="bg_page"> <!-- MOBILE VERSION -->
			<header >
				<article class="heading">
					<h1><?= (isset($h1_custom) && $h1_custom != '') ? $h1_custom : $row_setting['h1_' . $lang] ?></h1>
					<h2><?= (isset($h2_custom) && $h2_custom != '') ? $h2_custom : $row_setting['h2_' . $lang] ?></h2>
				</article>       	             			           
				<article class="banner">
					<?php include _template . "layout/banner.php"; ?>
				</article>
				
			</header><!-- End header -->
			
			<section id="main">
				<article>
					<div class="box_slider" >
						<?php include _template . "layout/slideranh.php"; ?>
					</div>
					<div class="bg_container">
						<?php if($source=="index"){?>
						<div class="container_mid" id="content">
						<?php include _template . $template . "_tpl.php"; ?> 
						</div>
						<?php } else { ?>
						<div id="trang-con">
							<div class="container">
							<?php include _template . $template . "_tpl.php"; ?> 
							</div>
						</div>
						<?php }?>
					</div><!-- End container right -->
					
				</article>
			</section>		
			<article class="heading">
				<h3><?= (isset($h3_custom) && $h3_custom != '') ? $h3_custom : $row_setting['h3_' . $lang] ?></h3>
				<h4><?= $row_setting['h4_' . $lang] ?></h4>
				<h5><?= $row_setting['h5_' . $lang] ?></h5>
				<h6><?= $row_setting['h6_' . $lang] ?></h6>
			</article>
		</div>
		<footer class="wow fadeInUp">
			<?php include _template . "layout/footer.php"; ?>
		</footer><!-- End footer --> 
		
		<script type="text/javascript" src="assets/bootstrap-3.2.0/js/bootstrap.js"></script>
		<script type="text/javascript" src="assets/js/script_mobile.js"></script>
		<script type="text/javascript" src="assets/js/owlcarousel/owl.carousel.js"></script>
		<script type="text/javascript" src="assets/js/menu/menumaker.js"></script>
		<script src="assets/js/plugin-scroll/plugins-scroll.js" type="text/javascript" ></script>
		<script>var base_url = 'http://<?=$config_url?>';  </script>
		<script type="text/javascript" src="assets/js/ivewslider/raphael-min.js"></script>
		<script type="text/javascript" src="assets/js/ivewslider/jquery.easing.js"></script>
		<script src="assets/js/ivewslider/iview.js"></script>
		<script src="assets/js/magiczoomplus/magiczoomplus.js"></script>
		<script type="text/javascript" src="assets/js/aos/aos.js"></script>
		<script type="text/javascript" src="assets/js/sweet-alert/sweet-alert.js"></script>
		<script>
		  AOS.init();
		</script>
		<!-- Init Plugin -->
		<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCLzq8rUsyHQU_t9JGoKqEKJUsi5aYbflc&#038;ver=4.9.8'>
		</script>
        <script type="text/javascript">
			var map;
			var infowindow;
			var marker = new Array();
			var old_id = 0;
			var infoWindowArray = new Array();
			var infowindow_array = new Array();
			function initialize() {
				var defaultLatLng = new google.maps.LatLng(<?= $row_setting['toado'] ?>);
				var myOptions = {
					zoom: 16,
					center: defaultLatLng,
					scrollwheel: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				map.setCenter(defaultLatLng);
				var arrLatLng = new google.maps.LatLng(<?= $row_setting['toado'] ?>);
				infoWindowArray[7895] = '<div class="map_description"><div class="map_title"><?= $row_setting['ten_' . $lang] ?></div><div><?= $row_setting['diachi_' . $lang] ?></div></div>';
				loadMarker(arrLatLng, infoWindowArray[7895], 7895);

				moveToMaker(7895);
			}
			function loadMarker(myLocation, myInfoWindow, id) {
				marker[id] = new google.maps.Marker({position: myLocation, map: map, visible: true});
				var popup = myInfoWindow;
				infowindow_array[id] = new google.maps.InfoWindow({content: popup});
				google.maps.event.addListener(marker[id], 'mouseover', function () {
					if (id == old_id)
						return;
					if (old_id > 0)
						infowindow_array[old_id].close();
					infowindow_array[id].open(map, marker[id]);
					old_id = id;
				});
				google.maps.event.addListener(infowindow_array[id], 'closeclick', function () {
					old_id = 0;
				});
			}
			function moveToMaker(id) {
				var location = marker[id].position;
				map.setCenter(location);
				if (old_id > 0)
					infowindow_array[old_id].close();
				infowindow_array[id].open(map, marker[id]);
				old_id = id;
			}</script>
		<?php include _template . "layout/back_to_top.php"; ?>
		
		<!-- Modal Search -->
	  <div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
		  <div id="tk-modal-box" class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div id="timkiem-box">
					<input id="keywords" class="nhap-tim" type="text" placeholder="Nhập từ khóa hoặc mã sản phẩm" name="search">
					<img style="cursor:pointer;" id="tim-search" src="assets/images/ic_search2.png" onclick="onSearchs()"></img>
				</div>
			</div>
		  </div>
		</div>
	  </div>
		<script type="text/javascript">
			var myKey = document.getElementById("keywords");
			myKey.addEventListener("keyup", function(event) {
				event.preventDefault();
				if (event.keyCode == 13) {
					document.getElementById("tim-search").click();
				}
			});

			function onSearchs() 
			{
				
				var keyword = document.getElementById("keywords").value;
				if (keyword=='')
					alert('Bạn chưa nhập từ khóa!');
				else {
					//var encoded = Base64.encode(keyword);
					location.href = "tim-kiem.html/keyword="+keyword;		
				}
			}	
		</script>
	</body>
</html>