<?php
	function get_list_role($id=0){
		
		$sql="select * from table_user_role order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_role" name="id_role" class="main_font">
			<option>Chọn nhóm thành viên</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$id)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
		
	}
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="default.php?com=user&act=man"><span>Danh sách thành viên</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Chỉnh sửa thành viên</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="default.php?com=user&act=save" method="post" enctype="multipart/form-data">	        
    <div class="widget">
		<div class="title"><img src="./images/icons/dark/pencil.png" alt="" class="titleIcon" />
			<h6>Thông tin tài khoản</h6>
		</div>			
		<div class="formRow">
			<label>Tên đăng nhập</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['username']?>" <?=@$item['id'] != "" ? "disabled" : "" ?> name="username" title="Tên đăng nhập quản trị" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
			<label>Mật khẩu</label>
			<div class="formRight">
				<input type="password" value="" name="password" title="Nhập mật khẩu" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
               		
		<div class="formRow">
			<label>Họ tên</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten']?>" name="ten" title="Nhập họ tên của bạn" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        <div class="formRow">
			<label>Email</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['email']?>" name="email" title="Nhập email của bạn" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        <div class="formRow">
			<label>Điện thoại</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Nhập điện thoại của bạn" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Địa chỉ</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['diachi']?>" name="diachi" title="Nhập địa chỉ của bạn" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
			<label>Nhóm thành viên</label>
			<div class="formRight">
				<div class="selector"><?=get_list_role($item['id_role'])?></div>
			</div>
			<div class="clear"></div>
		</div>
		
        <div class="formRow">
			<div class="formRight">
               <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div> 			
	</div>
    
      
</form>   