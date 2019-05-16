<?php if(!defined('_lib')) die("Error");
class Base
{
	public $db;
	private $_setting;
	public $lang;

	function __construct($d){ // construct 
		$this->db = $d;		
		$this->setSetting();		
		$this->lang = $this->getSetting("default_lang");		
	}	
	private function setSetting(){ //  gan du lieu setting vao 1 bien de goi ra cho tien
		$this->db->query("select * from #_setting");
		$this->_setting = $this->db->fetch_array();
	}
	function getSetting($key){
		$rs = $this->_setting[$key]; // lay noi dung ung voi tu khoa tuong ung
		if($this->isJson($rs)){// kiem tra neu la json
			$tmp = json_decode($rs,true); // decode chuoi json
			$rs = $tmp[$this->lang]; // tra ve du lieu tuong ung voi ngon ngu
		}
		return $rs;		
	}
	function isJson($string) {// ham kiem tra json
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}
	function getLang(){
		return $this->lang;
	}
	function setLang($lang){
		$this->lang = $lang;	
	} 	
}