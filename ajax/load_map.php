<?php
   @define ( '_lib' , '../libraries/');
   include_once _lib."config.php";
   include_once _lib."constant.php";
   include_once _lib."class.database.php";
   $d = new database($config['database']);
   $lang = "vi";
   $d->reset();
   $sql_setting = "select * from #_setting limit 0,1";
   $d->query($sql_setting);
   $row_setting= $d->fetch_array();
?>
   
<script type="text/javascript">
$(document).ready(function() {var map;var infowindow;var marker= new Array();var old_id= 0;
var infoWindowArray= new Array();
var infowindow_array= new Array();
function initialize(){var defaultLatLng = new google.maps.LatLng("<?=($_GET["coor"]!='')?$_GET["coor"]:$row_setting['toado']?>");var myOptions= {zoom: <?=$_GET["zoom"]?>,center: defaultLatLng,scrollwheel : true,mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);map.setCenter(defaultLatLng);var arrLatLng = new google.maps.LatLng(<?=($_GET["coor"]!='')?$_GET["coor"]:$row_setting['toado']?>);infoWindowArray[7895] = '<div class="map_description"><div class="map_title"><h2 style="color:green;font-size:16px;font-weight:bold;"><?=$row_setting["ten_$lang"]?></h2></div><b>Địa Chỉ :</b> <?=$row_setting["diachi_$lang"]?><br><b> Điện Thoại: </b><?=$row_setting["dienthoai"]?><br><b> Email : </b><?=$row_setting["email"]?></div>';loadMarker(arrLatLng, infoWindowArray[7895], 7895);moveToMaker(7895);}
function loadMarker(myLocation, myInfoWindow, id){marker[id] = new google.maps.Marker({position: myLocation, map: map, visible:true});
var popup = myInfoWindow;infowindow_array[id] = new google.maps.InfoWindow({ content: popup});
google.maps.event.addListener(marker[id], 'mouseover', function() {if (id == old_id) return;if (old_id > 0) infowindow_array[old_id].close();infowindow_array[id].open(map, marker[id]);old_id = id;});
google.maps.event.addListener(infowindow_array[id], 'closeclick', function() {old_id = 0;});}
function moveToMaker(id){var location = marker[id].position;map.setCenter(location);if (old_id > 0) infowindow_array[old_id].close();infowindow_array[id].open(map, marker[id]);old_id = id;}
initialize();
});
</script>