<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";

switch ($act) {
    case "man":
        initAddRss();
        $template = "getProduct/item_add";
        break;
	case "get":
        initAddRss();
        $template = "getProduct/item_add";
        break;
    default:
        $template = "index";
}

function fns_Rand_digit($min, $max, $num) {
    $result = '';
    for ($i = 0; $i < $num; $i++) {
        $result.=rand($min, $max);
    }
    return $result;
}

function initAddRss(){
	global $d,$config_url,$config;
	ini_set('max_execution_time', "-1");
	ini_set('max_limit_size', "-1");
	ini_set("memory_limit","-1"); 
	
	include_once _lib."simplehtmldom/simple_html_dom.php";
	if(isAjaxRequest()){
		if($_GET['method']=='getlist'){
			$id_content=$_GET["id_content"];
			$id_sp=$_GET["id_sp"];
			$id_content_ct=$_GET["id_content_ct"];
			$id_ten_sp=$_GET["id_ten_sp"];
			$id_ma_sp=$_GET["id_ma_sp"];
			$id_gia_sp=$_GET["id_gia_sp"];
			$id_giakm_sp=$_GET["id_giakm_sp"];
			$tiente=$_GET["tiente"];
			$id_hinh_sp=$_GET["id_hinh_sp"];
			$id_nd_sp=$_GET["id_nd_sp"];
			$link_define=$_GET["link_define"];
			$id_hinh_ct=$_GET["id_hinh_ct"];
			$id_ten_sp_content=$_GET["id_ten_sp_content"];
			
			$u = $_GET['url'];
			
			$curl = curl_init(); 
			curl_setopt($curl, CURLOPT_URL, $u);  
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);  
			
			
			
			// Create a DOM object
			$html = new simple_html_dom();
			// Load HTML from a string
			$html->load(curl_exec($curl));
			
			curl_close($curl);  
			
			
			
			$wrap = $html->find("$id_content",0);
			
			
			foreach($wrap->find("$id_sp") as $i=>$item){
				if($i <100){
					
				$rss[$i]['link']  = $link_define.$item->find("a",0)->href;
				$rss[$i]['name'] = strip_tags($item->find("$id_ten_sp_content",0)->outertext);
				///$rss[$i]['host'] = $_GET['type'];
				
				$rss[$i]['image'] = $item->find("$id_hinh_ct",0)->find("img",0)->src;
				$rss[$i]['image'] = "http:".$rss[$i]['image'];
				// $rs = $item->get_item_tags('','summaryImg');
				// if(count($rs)){
						
				// 	$rss[$i]['image'] = (checkValidUrl($rs[0]['data'])) ? $rs[0]['data'] : $url.$rs[0]['data'];
				// }
				}
				$i++;
			}
			$html->clear(); 
			//dump($rss);
			unset($html);
			
			echo json_encode($rss);
		}
		if($_GET['method'] == 'get-item'){
			//dump($_POST);
			$id_content=$_POST["id_content"];
			$id_sp=$_POST["id_sp"];
			$id_content_ct=$_POST["id_content_ct"];
			$id_ten_sp=$_POST["id_ten_sp"];
			$id_ma_sp=$_POST["id_ma_sp"];
			$id_gia_sp=$_POST["id_gia_sp"];
			$id_giakm_sp=$_POST["id_giakm_sp"];
			$tiente=$_POST["tiente"];
			$id_hinh_sp=$_POST["id_hinh_sp"];
			$id_nd_sp=$_POST["id_nd_sp"];
			$link_define=$_POST["link_define"];
			$id_hinh_ct=$_POST["id_hinh_ct"];
			$id_ten_sp_content=$_POST["id_ten_sp_content"];
			$id_mota_sp=$_POST["id_mota_sp"];
			$vitrihinh=$_POST["vitrihinh"];
			//dump($_POST);
			$name = trim($_POST['name']);
			$img = trim($_POST['image']);
			$url = trim($_POST['url']);
			
			$array_repplace=array("http://thegioibepnhapkhau.vn/"=>"<span style='font-size:12px; color:#000000; font-weight:100; vertical-align:middle;'>Giá khuyến mại:</span>");
			
			/* $d->query("select * from #_product where ten_vi = '".magic_quote(strip_tags($name))."' ");
			$data_ = array();
			if($d->num_rows() == 1){
				$data_['cls'] = 'red';
				$data_['stt'] = 'Tin đã tồn tại';
			}else{ */
				$u = $url;
			
				$curl = curl_init(); 
				curl_setopt($curl, CURLOPT_URL, $u);  
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
				curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);  
				
				
				
				// Create a DOM object
				$html = new simple_html_dom();
				// Load HTML from a string
				$html->load(curl_exec($curl));
				
				curl_close($curl);  
				//$html = file_get_html($_POST['url']);
				
				$data['id_list'] = $_REQUEST['id_list'];
				$data['id_cat'] = $_REQUEST['id_cat'];
				$data['id_item'] = $_REQUEST['id_item'];
				$data['list_id'] = $_REQUEST['id_list'].','.$_REQUEST['id_cat'].','.$_REQUEST['id_item'];
				$data['hienthi'] = 1;
				$data['ngaytao'] = time();
				$data['ngaysua'] = time();
				$ten_vi=$html->find("$id_ten_sp",0)->innertext ;
				$data['ten_vi'] = (magic_quote(strip_tags($name)));
				$data['tenkhongdau'] = changeTitle(magic_quote($data['ten_vi']));
				$data['gia'] = ($html->find("$id_gia_sp",0)->innertext );
				$data['gia']=str_replace(".", '', $data['gia']);
				$data['gia']=str_replace("$tiente", '', $data['gia']);
				//$desc = $html->find(".prod_details",0)->find("ul",0)->outertext;
				//$data['mota_vi']=$html->find("$id_mota_sp",0)->innertext;
				
				$data['noidung_vi']=$html->find("$id_nd_sp",0)->innertext;
				//$data2['mota'] = trim(magic_quote(strip_tags($desc)));
				$data['noidung_vi'] = (str_replace("data-original","src",$html->find("$id_nd_sp",0)->innertext));
				
				
				$data['noidung_vi'] = magic_quote(preg_replace('~<noscript(.*?)</noscript>~Usi', "", $data['noidung_vi']));
				$data['noidung_vi'] = (preg_replace('#<a.*?>(.*?)</a>#i', '\1', $data['noidung_vi']));
				//$data2['noidung'].= magic_quote($html->find(".prd-detail-wrapper",1)->find(".product-description__block",0));
				$property = 'data-zoom-image';
				$img2 = $img;
				
				$ar=@end(explode(".",$img2));
				$ar=(explode("&",$ar));
				$ar=(explode("?",$ar[0]));
					
				$photo_name = changeTitle($data['ten_vi'])."-".rand(0,100).".".$ar[0];
				save_image($img2,_upload_product.$photo_name);
				$data['photo'] = $photo_name;
				
				$gallery = $html->find($id_nd_sp,0);
				$list_gallery = array();
				if($gallery){
					foreach($gallery->find("img") as $item){
						$fix_img =$item->src;
						$list_gallery[] = "http:".$fix_img;
						$arr_ex=end(@explode("/",$fix_img));
						$arr_ex1=(@explode("?",$arr_ex));
						$data['noidung_vi']=str_replace($fix_img,"http://myphamelixir.com/upload/images/".$arr_ex1[0],$data['noidung_vi']);
					}
					
				}
				foreach($list_gallery as $k2=>$v2){
					$d->reset();
					$fix_img = explode("?",$v2);
					
					$img = $fix_img[0];
					$img = str_replace("http:https:","https:", $img);
					$rel_img = end(@explode("/",$img));
					save_image($v2,"../upload/images/".$rel_img);
				}
				/* $photo_name = changeTitle($data['ten_vi'])."-".rand(0,100).".".@end(explode(".",$img));
				save_image($img,_upload_product.$photo_name);
				$data['photo'] = $photo_name; */
				$d->query("select id from #_product");
				$data['type'] = "san-pham";
				$data['stt'] = 1;
				$d->reset();
				$d->setTable("product");
				
				//check($data2);die;
				$html->clear(); 
				unset($html);
				if($d->insert($data)){
					$data_['cls'] = 'green';
					$data_['stt'] = 'Thêm thành công';
				}
				
			//}
			echo json_encode($data_);
		}
		die();
	}
}
function save_image($inPath,$outPath)
{ 

	
	//echo 
	//copy($inPath, $outPath);
	//return true;
	

	$url = ($inPath);
	$url = str_replace(' ', '%20', $url);
	$img = $outPath;
	file_put_contents($img, file_get_contents($url));
	
}
//===========================================================
?>