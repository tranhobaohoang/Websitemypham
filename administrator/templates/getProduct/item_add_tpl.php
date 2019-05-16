<?php
	$set_level=$config['subcat'];
	$id_list=$_REQUEST["id_list"];
	if($set_level>0){
		function get_main_list(){
			global $rs_menu,$set_level,$d,$id_list;
			$d->reset();
			$sql="select * from #_product_list where com='1' and type='".$_REQUEST["type"]."' order by stt, id desc";
			$d->query($sql);
			$rs_menu=$d->result_array();
			
			$str.='<label>Danh mục sản phẩm</label>
				<div class="formRight">
					<div class="selector">
						<select name="id_parent[]" class="form-control input level" data-level="1" id="level1" onchange="load_level($(this))" >';
				$str.="<option>Chọn danh mục cấp 1</option>";
				foreach($rs_menu as $v){
					$str.='<option value="'.$v["id"].'" ';
					if($v["id"]==$id_list) $str.='selected'; 
					$str.='>'.$v["ten_vi"].'</option>';
				}
			$str.='</select>
			</div></div>
			</br>';
			$str.='<div class="level_box" id="level2"></div>';
			
			return $str;
		}
	}
	
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        <li><a href="default.php?com=product&act=man&type=<?=$_REQUEST["type"]?>"><span>sản phẩm</span></a></li>
        <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}
	
</script>
<script src="js/jQuery.ajaxQueue.js" type="text/javascript"></script>
<form name="supplier" id="validate" class="form" action="default.php?com=product&act=save&type=<?=$_REQUEST["type"]?>&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nhập dữ liệu</h6>
        </div>
		<ul class="tabs">
			<li>
               <a href="#info">Thông tin chung</a>
			</li>
		</ul>
		<div id="info" class="tab_content">
			<input type="hidden" name="id" id="id_this_product" value="<?=@$item['id']?>" />
            <div class="formRow">
				<?= get_main_list(); ?>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Chọn trang cần lấy:</label>
				<div class="formRight">
					<div class="selector">
						<select name="web" id="web">
							<option value="0">Chọn trang web cần lấy dữ liệu</option>
							<option value="elixircosmetics">elixircosmetics.net</option>
						</select>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>ID hoặc class content:</label>
				<div class="formRight">
					<input type="text" name="id_content" title="nếu id: #tenid, nếu class .tenclass" id="id_content" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>ID hoặc class tên sp content:</label>
				<div class="formRight">
					<input type="text" name="id_ten_sp_content" title="nếu id: #tenid, nếu class .tenclass" id="id_ten_sp_content" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>ID hoặc class hình sp content:</label>
				<div class="formRight">
					<input type="text" name="id_hinh_ct" title="nếu id: #tenid, nếu class .tenclass" id="id_hinh_ct" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Class từng sản phẩm:</label>
				<div class="formRight">
					<input type="text" name="id_sp" title="nếu id: #tenid, nếu class .tenclass" id="id_sp" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label>ID hoặc class content chi tiết:</label>
				<div class="formRight">
					<input type="text" name="id_content_ct" title="nếu id: #tenid, nếu class .tenclass" id="id_content_ct" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>ID hoặc class tên:</label>
				<div class="formRight">
					<input type="text" name="id_ten_sp" title="nếu id: #tenid, nếu class .tenclass" id="id_ten_sp" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<!--<div class="formRow">
				<label>ID hoặc class mã :</label>
				<div class="formRight">
					<input type="text" name="id_ma_sp" title="nếu id: #tenid, nếu class .tenclass" id="id_ma_sp" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>-->
			<div class="formRow">
				<label>ID hoặc class giá:</label>
				<div class="formRight">
					<input type="text" name="id_gia_sp" title="nếu id: #tenid, nếu class .tenclass" id="id_gia_sp" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>ID hoặc class giá KM:</label>
				<div class="formRight">
					<input type="text" name="id_giakm_sp" title="nếu id: #tenid, nếu class .tenclass" id="id_giakm_sp" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Chuỗi tiền tệ:</label>
				<div class="formRight">
					<input type="text" name="tiente" title="Nhập chuỗi tiền tệ từ website cần lấy." id="tiente" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label>ID hoặc class hình:</label>
				<div class="formRight">
					<input type="text" name="id_hinh_sp" title="nếu id: #tenid, nếu class .tenclass" id="id_hinh_sp" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>ID hoặc class mota:</label>
				<div class="formRight">
					<input type="text" name="id_mota_sp" title="nếu id: #tenid, nếu class .tenclass" id="id_mota_sp" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>ID hoặc class nội dung:</label>
				<div class="formRight">
					<input type="text" name="id_nd_sp" title="nếu id: #tenid, nếu class .tenclass" id="id_nd_sp" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Link web gốc:</label>
				<div class="formRight">
					<input type="text" name="link_define" title="Kiểm tra link của web cần lấy nếu không có tên miền thì nhập ô này" id="link_define" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Link cần lấy:</label>
				<div class="formRight">
					<input type="text" name="link" title="Link cần lấy sản phẩm" id="link" class="tipS" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<div class="formRight">
					
					<input type="button" class="blueB" id="get-link" value="Get Link" />
				</div>
				<div class="clear"></div>
			</div>
			<input type="hidden" value="0" id="vitrihinh" name="vitrihinh" />
       </div>
	</div>
</form>
<div class="widget">
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="tbl">
		<thead>
			<tr>
				<td><input type="checkbox" id="titleCheck" name="titleCheck" /></td>
				<td class="tb_data_small">Hình ảnh</td>
				<td class="sortCol"><div>Tên sản phẩm<span></span></div></td>
				<td width="200">Trạng thái</td>
			</tr>
		</thead>
		<tbody>
		
		</tbody>
	</table>
	<div class="formRow">
		<div class="formRight">
			<input type="button" class="blueB" id="get-item" value="Lấy dữ liệu" />
		</div>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var elixircosmetics={
			id_content:".section-product-wrapper",
			id_ten_sp_content:".product-name",
			id_hinh_ct:".product-img",
			id_sp:".grid-item-sp2",
			id_content_ct:".product-detail",
			id_ten_sp:"h1.product-name",
			id_ma_sp:"",
			id_gia_sp:"p.price",
			id_giakm_sp:"price_box",
			tiente:"₫",
			id_hinh_sp:".product-big",
			id_mota_sp:".briefContent",
			id_nd_sp:"#features",
			link_define:"http://elixircosmetics.net",
			vitrihinh:0,
		};
		//console.log(lazada);
		$("#web").change(function(){
			var val=eval($(this).val());
			//alert(val);
			$.each(val, function(index, value){
				$("#"+index).val(value);
			})
		})
		load_level($(".level"));
		$("#get-link").click(function(){
		
			$("#tbl tbody").empty();
			if($("#link").val()){
			$.ajax({
				url:base_url+"/administrator/default.php?com=<?=$_GET['com']?>&type=<?=$_REQUEST['type']?>&act=man&method=getlist",
				type:'get',
				data:{url:$("#link").val(),id_content:$("#id_content").val(),id_sp:$("#id_sp").val(),id_content_ct:$("#id_content_ct").val(),id_ten_sp:$("#id_ten_sp").val(),id_ma_sp:$("#id_ma_sp").val(),id_gia_sp:$("#id_gia_sp").val(),id_giakm_sp:$("#id_giakm_sp").val(),tiente:$("#tiente").val(),id_hinh_sp:$("#id_hinh_sp").val(),id_nd_sp:$("#id_nd_sp").val(),link_define:$("#link_define").val(),id_ten_sp_content:$("#id_ten_sp_content").val(),id_hinh_ct:$("#id_hinh_ct").val(),id_mota_sp:$("#id_mota_sp").val(),vitrihinh:$("#vitrihinh").val()},
				success:function(data){
					
					$jdata = $.parseJSON(data);
					$.each($jdata,function(i,item){
						//console.log(item);
						$content = "<tr data-type='<?=$_REQUEST["type"]?>'><td><input type='checkbox' class='chon'></input></td><td><img width=50 src='"+item.image+"' /></td><td><a href='"+item.link+"'>"+item.name+"</a></td><td>Đang chờ</td></tr>";
						$("#tbl tbody").append($content);
						$("#tbl").removeClass("hide");
					})
					return false;
				}
			})
			}else{
				alert("Nhập link lazada cho có nhiều sp nha!");
				$("#link").focus();
			}
			return false;
		})
		$("#titleCheck").click(function(){
			var status = this.checked;

            $("input[class='chon']").each(function () {
                this.checked = status;
            })
		})
		$("#get-item").click(function(){
			$i=0;
			$("#tbl tr").each(function(){	
				
				var $obj = $(this);
				
				if($obj.find("a").length){
					if($obj.find("input[type=checkbox]").is(":checked")){
						
						jQuery.ajaxQueue({
							url:base_url+"/administrator/default.php?com=<?=$_GET['com']?>&type=<?=$_REQUEST['type']?>&act=get&method=get-item",
							data:{type2:$obj.data("type"),"id_list":$("#level1").val(),"id_cat":$(".level2").val(),"url":$obj.find("a").attr("href"),'image':$obj.find("img").attr("src"),"name":$obj.find("a").html(),id_content:$("#id_content").val(),id_sp:$("#id_sp").val(),id_content_ct:$("#id_content_ct").val(),id_ten_sp:$("#id_ten_sp").val(),id_ma_sp:$("#id_ma_sp").val(),id_gia_sp:$("#id_gia_sp").val(),id_giakm_sp:$("#id_giakm_sp").val(),tiente:$("#tiente").val(),id_hinh_sp:$("#id_hinh_sp").val(),id_nd_sp:$("#id_nd_sp").val(),link_define:$("#link_define").val(),id_ten_sp_content:$("#id_ten_sp_content").val(),id_hinh_ct:$("#id_hinh_ct").val(),id_mota_sp:$("#id_mota_sp").val(),vitrihinh:$("#vitrihinh").val()},
							type:'post',
							dataType: "json",
							beforeSend:function(){
								$obj.addClass("is-process");
								$("tr.is-process").find("td").last().addClass("orange").html("Đang xử lý");
								
							},
							
						}).done(function( data ) {
							$obj = $("tr.is-process");
							$obj.find("td").last().attr("class","");
							$obj.find("td").last().addClass(data.cls).html(data.stt);
							
						});
					}
				}
			})
			
			return false;
		})
	})
	function load_level($obj){
		$level=$obj.data("level");
		$id=$obj.val();
		if($id!=0){
		$.ajax({
			type:"POST",
			url:"ajax/ajax.php",
			data:{max_level:<?=$config['subcat']?>,level:$level,id:$id, act: "load_level_sp", id_parent: "<?=$_REQUEST["id_parent"]?>",id_sp:"<?= ($_REQUEST["id"]!='') ? $_REQUEST["id"] : '0'?>"},
			success: function(data){
				
				$("#level"+($level+1)).html(data);
			}
		})
		}
	}
</script>