<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Upload extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		}
	
		function doUpload()
		{
			$this->load->library('message');
			$folder = $this->input->post('folder',true);
			$tp = array("jpg","gif","png","JPG","GIF","PNG"); 
			$pathinfo = pathinfo($_FILES['fileToUpload']['name']);
			if(!isset($pathinfo['extension']) || !in_array($pathinfo['extension'],$tp)) { 
				$this->message->jmsg(0,"只能上传格式为jpg,gif,png的文件！");
			}
			if($_FILES['fileToUpload']['size']>8000000){
				$this->message->jmsg(0,"图片大小不能超过8M！");
			}
			$path="upload/".$folder."/".date("YmdHis")."_".rand(10000,99999).".".$pathinfo['extension'];
			$ok=@move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$path);
			if($ok === FALSE){
			    $this->message->jmsg(0,"上传失败");
			}else{
			    $this->message->jmsg(1,$path);
			}	
		}
	}
