<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Message
{
	function showmessage($content, $continue=-1, $status = 1) {
		$continue = ($continue == -1) ? 'history.go(-1)' : 'window.location="'.site_url($continue).'"';
		$waits = ($status == 0) ? 'setTimeout("thisUrl()", 4000)' : 'setTimeout("thisUrl()", 1000)';
		$status = ($status == 0) ? 'color:#FF0000' : 'color:#009900';
		$string = "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
		$string .= "<div class='box' style='width:400px;margin:0 auto;border:1px solid #ddd;'>\n<h5 style='height:30px;line-height:30px;padding:0;margin:0;text-align:center;border-bottom:1px solid #ddd;background-color:#F8F8F8;'>提示信息</h5>\n<p class='content' style='text-align:center;font-size:12px;".$status."'>".$content."</p>\n<p class='clickUrl' style='font-size:12px;text-align:center;'>
			如果浏览器没有自动跳转，请 <a href='javascript:;' onClick='".$continue."'>点击这里</a></p>\n</div>"; 
		$html = "<script type='text/javascript'>function thisUrl(){".$continue."}".$waits."</script>".$string;
		exit($html);
	}

	function showAlert($s,$continue=-1){

		$continue = ($continue == -1) ? 'history.go(-1)' : 'window.location="'.site_url($continue).'"';
		$html = "<script type='text/javascript'>alert('$s');$continue</script>";
		exit($html);
	}

	function jmsg($no,$msg,$idx = 0){
		$msg = array("no"=>$no,"msg"=>$msg,"idx"=>$idx);
		echo json_encode($msg);
		die();
	}
}
/**
 * 信息提示页面
 * @$content 要提示的文字
 * @$continue 即将跳往的页面，返回用“-1”
 * @$status 提示状态，值为0,1或其它，0为错误提示(红色)，1为正常提示（绿色）
 */


?>