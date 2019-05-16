<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyCLzq8rUsyHQU_t9JGoKqEKJUsi5aYbflc&#038;ver=4.9.8"
      type="text/javascript"></script>
      <script type="text/javascript">

 function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        var center = new GLatLng(<?php if($item['toado']!='') echo $item['toado']; else echo $config['locationdefault']?>);
        map.setCenter(center, 15);
        geocoder = new GClientGeocoder();
        var marker = new GMarker(center, {draggable: true});  
        map.addOverlay(marker);		
        document.getElementById("txt_location").value = center.lat().toFixed(6) +','+center.lng().toFixed(6);
	  GEvent.addListener(marker, "dragend", function() {
       var point = marker.getPoint();
	      map.panTo(point);
		  document.getElementById("txt_location").value = point.lat().toFixed(6) +','+point.lng().toFixed(6);
        });
	 GEvent.addListener(map, "moveend", function() {
		  map.clearOverlays();
    var center = map.getCenter();
		  var marker = new GMarker(center, {draggable: true});
		  map.addOverlay(marker);
		document.getElementById("txt_location").value = center.lat().toFixed(6) +','+center.lng().toFixed(6);
	 GEvent.addListener(marker, "dragend", function() {
      var point =marker.getPoint();
	     map.panTo(point);
      document.getElementById("txt_location").value = point.lat().toFixed(6) +','+point.lng().toFixed(6);
        });
        });
      }
    }
	   function showAddress(address) {
	   var map = new GMap2(document.getElementById("map"));
       map.addControl(new GSmallMapControl());
       map.addControl(new GMapTypeControl());
       if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
				 document.getElementById("txt_location").value = point.lat().toFixed(6) +','+point.lng().toFixed(6);
		 map.clearOverlays()
			map.setCenter(point, 14);
   var marker = new GMarker(point, {draggable: true});  
		 map.addOverlay(marker);

		GEvent.addListener(marker, "dragend", function() {
      var pt = marker.getPoint();
	     map.panTo(pt);
		 document.getElementById("txt_location").value = pt.lat().toFixed(6) +','+pt.lng().toFixed(6);
        });
	 GEvent.addListener(map, "moveend", function() {
		  map.clearOverlays();
    var center = map.getCenter();
		  var marker = new GMarker(center, {draggable: true});
		  map.addOverlay(marker);
		  document.getElementById("txt_location").value = center.lat().toFixed(6) +','+center.lng().toFixed(6);
	 GEvent.addListener(marker, "dragend", function() {
     var pt = marker.getPoint();
	    map.panTo(pt);
		document.getElementById("txt_location").value = pt.lat().toFixed(6) +','+pt.lng().toFixed(6);
        });
 
        });
            }
          }
        );
      }
    }
    </script>
    
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="default.php?com=setting&act=capnhat"><span>Thiết lập hệ thống</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Cấu hình website</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="default.php?com=setting&act=save&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">	
	
    <div class="widget">
		<div class="title"><img src="./images/icons/dark/users.png" alt="" class="titleIcon" />
			<h6>Thông tin công ty</h6>
		</div>		
		<ul class="tabs">
			<?php foreach ($config['lang'] as $key => $value) { ?>
			<li>
               <a href="#content_lang_2<?=$key?>"><?=$value?></a>
			</li>
			<?php } ?>
		</ul>	
		<?php 
			foreach ($config['lang'] as $key => $value) {
        ?>
		
		<div id="content_lang_2<?=$key?>" class="tab_content">       	   
			<div class="formRow">
				<label>Tên</label>
				<div class="formRight">
					<input type="text" value="<?=(@$item['ten_'.$key])?>" name="ten_<?=$key?>" title="Nhập tên công ty" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label>Điện thoại</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['dienthoai_'.$key]?>" name="dienthoai_<?=$key?>" title="Nhập số điện thoại" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			
			
			
			 <div class="formRow">
				<label>Địa chỉ</label>
				<div class="formRight">
					<input type="text" value="<?=(@$item['diachi_'.$key])?>" name="diachi_<?=$key?>" title="Nhập địa chỉ công ty" class="tipS" onblur="showAddress(this.value);" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Slogan</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['slogan_'.$key]?>" name="slogan_<?=$key?>"  title="slogan cho website" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Giờ làm việc</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['h6_'.$key]?>" name="h6_<?=$key?>" title="Giờ làm việc" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
		</div>
			<?php } ?>
        <div class="formRow">
			<label>Website</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['website']?>" name="website" title="Nhập địa chỉ website" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        <div class="formRow">
			<label>Tọa độ bản đồ</label>
			<div class="formRight">
				<input type="text" id="txt_location" value="<?=@$item['toado']?>" name="toado" title="Nhập tọa độ vị trí công ty" class="tipS" />
			</div>
            <div class="clear"></div>
            <div id="map" style="width: 100%;height:400px; margin-top:10px;"></div>
			
		</div>
		
	</div>
    
    <div class="widget">
		<div class="title"><img src="./images/icons/dark/users.png" alt="" class="titleIcon" />
			<h6>Thông tin thêm</h6>
		</div>			
		
        
        <div class="formRow">
			<label>Facebook</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['facebook']?>" name="facebook" title="Nhập địa chỉ facebook" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
         <div class="formRow">
			<label>Twitter</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['twitter']?>" name="twitter" title="Nhập địa chỉ twitter" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Google+</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['google']?>" name="google" title="Nhập địa chỉ google+" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Email</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['email']?>" name="email" title="Nhập địa chỉ emmail" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
			<label>Youtube</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['youtube']?>" name="youtube" title="Nhập địa chỉ youtube" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Mã số thuế</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['mst']?>" name="mst" title="Nhập mã số thuế" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
			<label>Hotline</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['hotline']?>" name="hotline" title="Nhập số điện thoại hotline" class="tipS" />
				<input type="text" value="<?=@$item['ten_hl1']?>" name="ten_hl1" title="Nhập tên hotline" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
        
        <div class="formRow">
			<label>Favicon</label>
			<div class="formRight">
             <?php if ($_REQUEST['act']=='capnhat' && $item['fav']!='' ) { ?>
                    <img width="32" src="<?=_upload_hinhanh.$item['fav']?>">
                    <br>
                    <?php }?>
                    
				<input type="file" id="file" name="file" /> <img src="./images/question-button.png" alt="Upload favicon" class="icon_question tipS" original-title="Tải hình đại diện website (ảnh JPEG, GIF , JPG , PNG)">
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Hình ảnh</label>
			<div class="formRight">
             <?php if ($_REQUEST['act']=='capnhat' && $item['tuvan']!='' ) { ?>
                    <img width="400" src="<?=_upload_hinhanh.$item['tuvan']?>">
                    <br>
                    <?php }?>
                    
				<input type="file" id="file2" name="file2" /> <img src="./images/question-button.png" alt="Upload favicon" class="icon_question tipS" original-title="Tải hình (ảnh JPEG, GIF , JPG , PNG)">
			</div>
			<div class="clear"></div>
		</div>
	</div>
    
    
    
    <div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
			<h6>Nội dung seo</h6>
		</div>			
		<div class="formRow">
			<label>Analytics</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Nội dung google analytics để theo dõi website của bạn" class="tipS" name="gg"><?=@$item['gg']?></textarea>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Meta mastertool</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['meta']?>" name="meta" title="Nhập thẻ meta xác nhận master tool" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<ul class="tabs">
           
         
           <?php foreach ($config['lang'] as $key => $value) { ?>
           <li>
               <a href="#content_lang_3<?=$key?>"><?=$value?></a>
           </li>
           <?php } ?>


       </ul>	
	   <?php 
		
			foreach ($config['lang'] as $key => $value) {
			
        ?>
		
		<div id="content_lang_3<?=$key?>" class="tab_content">       	 
			<div class="formRow">
				<label>Thẻ H1</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['h1_'.$key]?>" name="h1_<?=$key?>" title="Nội dung thẻ h1 dùng để SEO" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Thẻ H2</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['h2_'.$key]?>" name="h2_<?=$key?>" title="Nội dung thẻ h2 dùng để SEO" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Thẻ H3</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['h3_'.$key]?>" name="h3_<?=$key?>" title="Nội dung thẻ h3 dùng để SEO" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Thẻ H4</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['h4_'.$key]?>" name="h4_<?=$key?>" title="Nội dung thẻ h4 dùng để SEO" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Thẻ H5</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['h5_'.$key]?>" name="h5_<?=$key?>" title="Nội dung thẻ h5 dùng để SEO" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label>Title</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['title_'.$key]?>" name="title_<?=$key?>" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label>Keywords</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['keywords_'.$key]?>" name="keywords_<?=$key?>"  title="Từ khóa chính cho website" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label>Description:</label>
				<div class="formRight">
					<textarea rows="8" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS" name="description_<?=$key?>"><?=@$item['description_'.$key]?></textarea>
					<b>(Tốt nhất là 160 ký tự)</b>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php } ?>
        <div class="formRow">
			<div class="formRight">
                <input type="hidden" name="id" id="id_this_setting" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div> 			
	</div>
    
      
</form>   