<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/******************************image.php*********************************/
//创建Image类
class Image {
	//图片类型
	var $_type = "";
	//图片实际宽度
	var $_width;
	//图片实际高度
	var $_height;
	//改变后的宽度
	var $_resizeWidth;
	//改变后的高度
	var $_resizeHeight;
	//是否裁图
	var $_cut = false;
	//源图象
	var $_source = "";
	//生成后的目标地址
	var $_target = "";
	//存放图形句柄
	var $_im = "";
	//构造函数，设置初始变量
	var $_path = "";
	
	function Image($image, $width, $height, $cut = false) {
		$this->_source = $image;
		$this->_resizeWidth = $width;
		$this->_resizeHeight = $height;
		$this->_cut = $cut;
		$year = date("Y");
		$m = date("m");
		$d = date("d");
		$this->_path = "upload/images/$year/$m/$d/";
		if(!file_exists($this->_path))
		{
			$this->mkdirs($this->_path);
		}
		$this->_source=$this->getImage($this->_source,$this->_path);
	}
	
	function mkdirs($dir)  
	{  
	  if(!is_dir($dir))  
	  {  
		if(!$this->mkdirs(dirname($dir))){  
		  return false;  
	  	}  
		if(!mkdir($dir,0755)){  
		  return false;  
		}  
	  }  
	  return true;  
	}

	function getImage($url,$path) { 
	  if(!$url) return false;
	  $fname=strrchr(strtolower($url),"/"); 
	  $ext=strrchr(strtolower($url),"."); 
	  if($ext!=".gif" && $ext!=".jpg" && $ext!=".png") return false;
	  $fname=$path.$fname;
		
	  ob_start(); 
	  readfile($url); 
	  $img = ob_get_contents(); 
	  ob_end_clean(); 
	  $fp2=@fopen($fname, "a"); 
	  fwrite($fp2,$img); 
	  fclose($fp2); 
	
	  return $fname; 
	} 
	//执行缩放和剪裁过程
	function dosc($name=""){
		if($name == ""){
			$name = time().rand(10,10000);
		}
		//根据图片类型，返回一个图形句柄
		$this->getImageType($this->_source);
		//目标图象地址
		$this->_target = $this->_path.$name. "_thumb." . $this->_type;
		$this->_width = imagesx($this->_im);
		$this->_height = imagesy($this->_im);
		//生成图象
		$this->smallandcut();
		ImageDestroy($this->_im);
	}
	//重新设置缩放参数
	function setsc($image, $width, $height, $cut = false){
		$this->_source = $image;
		$this->_resizeWidth = $width;
		$this->_resizeHeight = $height;
		$this->_cut = $cut;
	}
	//创建缩放和剪裁函数
	function smallandcut() {
		//取得改变后的图形的比例
		$resize = ($this->_resizeWidth) / ($this->_resizeHeight);
		//实际图形的比例
		$normal = ($this->_width) / ($this->_height);
		//进行剪裁
		if (($this->_cut) == true){
			if ($normal >= $resize) {
				$smallImage = imagecreatetruecolor($this->_resizeWidth, $this->_resizeHeight);
				imagecopyresampled($smallImage, $this->_im, 0, 0, 0, 0, $this->_resizeWidth, $this->_resizeHeight, (($this->_height) * $resize), $this->_height);
				ImageJpeg($smallImage, $this->_target);
			}
			if ($normal < $resize) {
				$smallImage = imagecreatetruecolor($this->_resizeWidth, $this->_resizeHeight);
				imagecopyresampled($smallImage, $this->_im, 0, 0, 0, 0, $this->_resizeWidth, $this->_resizeHeight, $this->_width, (($this->_width) / $resize));
				ImageJpeg($smallImage, $this->_target);
			}
		} else {
			//按比例缩放
			if ($normal >= $resize) {
				$smallImage = imagecreatetruecolor($this->_resizeWidth, ($this->_resizeWidth) / $normal);
				imagecopyresampled($smallImage, $this->_im, 0, 0, 0, 0, $this->_resizeWidth, ($this->_resizeWidth) / $normal, $this->_width, $this->_height);
				ImageJpeg($smallImage, $this->_target);
			}
			if ($normal < $resize) {
				$smallImage = imagecreatetruecolor(($this->_resizeHeight) * $normal, $this->_resizeHeight);
				imagecopyresampled($smallImage, $this->_im, 0, 0, 0, 0, ($this->_resizeHeight) * $normal, $this->_resizeHeight, $this->_width, $this->_height);
				ImageJpeg($smallImage, $this->_target);
			}
		}
	}

	//根据文件，返回一个根据对应格式生成的图像。
	function getImageType($file) {
		//使用getimagesize()函数，返回图像相关数据
		file_exists($file) ? $TempImage = getimagesize($file) :die("文件不存在！");
		switch ($TempImage[2]) {
			case 1 :
				$image = imageCreateFromGif($file);
				$this->_type = "gif";
				break;
			case 2 :
				$image = imageCreateFromJpeg($file);
				$this->_type = "jpg";
				break;
			case 3 :
				$image = imageCreateFromPng($file);
				$this->_type = "png";
				break;
			default :
				die("不支持该文件格式,请使用GIF、JPG、PNG格式。");
		}
		unset ($TempImage);
		$this->_im = $image;
	}

	function delimg($file)
	{
		unlink($file);
	}
}
?>