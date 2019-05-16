<?php
session_start();
@define('_source', '../sources/');
@define ( '_lib' , '../../libraries/');
error_reporting(-1);
include_once _lib . "config.php";
include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "library.php";
include_once _lib . "class.database.php";

$d = new database($config['database']);

$act=$_REQUEST['act'];
//dump($_POST);
switch ($act){
	case 'capnhat':
		update_voucher();
		break;
	case 'coupon':
		update_coupon();
		break;
	case 'update-giakm':
		update_giakm();
		break;
	case 'load_search':
		load_search();
		break;
	case 'active':
		update_active_cm();
		break;
}
function update_active_cm(){
	global $d;
	$id=$_POST['id'];
	$d->reset();
	$sql="select active from #_comment where id='".$id."' ";
	$d->query($sql);
	$rs=$d->fetch_array();
	
	if($rs["active"]==1){
		$data["active"]=0;
	}else{
		$data["active"]=1;
	}
	$d->setTable("comment");
	$d->setWhere("id",$id);
	$d->update($data);
	echo $data["active"];
}
function update_voucher(){
		global $d;
		$id=$_POST['id'];
		$fiel=$_POST['fiel'];
		$table=$_POST['table'];
		$d->reset();
		$sql="select $fiel from #_$table where id='".$id."' ";
		$d->query($sql);
		$rs=$d->fetch_array();
		if($rs["$fiel"]==1){
			$data["$fiel"]=0;
		}else{
			$data["$fiel"]=1;
		}
		$d->setTable($table);
		$d->setWhere("id",$id);
		$d->update($data);
		echo $data["$fiel"];
	}
function update_active_dm(){
	global $d;
	$id=$_POST['id'];
	$d->reset();
	$sql="select active from #_comment where id='".$id."' ";
	$d->query($sql);
	$rs=$d->fetch_array();
	
	if($rs["active"]==1){
		$data["active"]=0;
	}else{
		$data["active"]=1;
	}
	$d->setTable("comment");
	$d->setWhere("id",$id);
	$d->update($data);
	echo $data["active"];
}
function update_coupon(){
		global $d;
		$id=$_POST['id'];
		$d->reset();
		$sql="select coupon from #_product where id='".$id."' ";
		$d->query($sql);
		$rs=$d->fetch_array();
		
		if($rs["coupon"]==1){
			$data["coupon"]=0;
		}else{
			$data["coupon"]=1;
		}
		$d->setTable("product");
		$d->setWhere("id",$id);
		$d->update($data);
		echo $data["coupon"];
	}
	function update_giakm(){
		global $d;
		$id=$_POST["id"];
		if($_POST["func"]=="giakm"){
			$data["giakm"]=$_POST["gia"];
		}else {
			$data["gia_cou"]=$_POST["gia"];
		}
		$d->setTable("product");
		$d->setWhere("id",$id);
		if($d->update($data)){
			echo "Cập nhật thành công!";
		}else{
			echo "Cập nhật thất bại!";
		}
	}
	
	function load_search(){
		global $d;
		$val=$_POST["val"];
		$user=$_POST["user"];
		
		$d->reset();
		$sql="select * from #_voucher where code='".$val."' order by id desc";
		$d->query($sql);
		$result_items=$d->result_array();
		
		$kq='';
		if(count($result_items)>0){
		$kq.='<tr>
			<th width="10%">STT</th>
			<th width="10%">Mã đơn hàng</th>
			<th width="20%">Họ tên</th>
			<th width="10%">Ngày đặt</th>
			<th width="10%">Số tiền</th>
			<th width="10%">Mã voucher</th>
			<th width="10%">Httt</th>
			<th width="5%">Sửa</th>
			<th width="5%">Xóa</th>
		</tr>';
		for($i=0;$i<count($result_items);$i++){
		$kq.='<tr class="'; if($result_items[$i]["view"]==0) $kq.='bgblue'; $kq.='">
			<td width="10%">'.($i+1) .'</td>
			<td width="10%">'.$result_items[$i]['madh'].'</td>
			<td width="20%">'.$result_items[$i]['ten'].'</td>
			<td width="10%">'.date("d/m/Y",$result_items[$i]['ngaytao']).'</td>
			<td width="10%">
				'.number_format($result_items[$i]['tonggia'],"0",",",".").' VNĐ
			</td>
			<td width="10%">
				'.$result_items[$i]['code'].'
			</td>
			<td width="10%">';
				if($result_items[$i]['httt']==1){
					$kq.= 'Thanh toán trực tiếp';
				}else{ $kq.= 'Thanh toán online';
				}
			$kq.='</td>
			<td width="5%">
				<a href="doanhnghiep/'.$user.'/sua-voucher/'.$result_items[$i]['id'].'.html">
					<i class="glyphicon glyphicon-pencil green-color"></i>
				</a>
			</td>
			<td width="5%"><img src="image/icon_del.png" alt="Xóa đơn hàng" class="delete" onclick="dels('.$result_items[$i]['id'].');" /></td>
		</tr>';
		}
		}else{
			$kq.="Không có đơn hàng nào có mã voucher là: $val";
		}
		echo $kq;
	}