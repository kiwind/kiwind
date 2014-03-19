<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
define('ALLOWED_HTMLTAGS', '<a><p><br><hr><h1><h2><h3><h4><h5><h6><font><u><i><b><strong><div><span><ol><ul><li><img><table><tr><td><map>'); 
class Common
{
	function htm2text($text="")
	{
		$text = filter_xss($text,ALLOWED_HTMLTAGS);
		return str_replace(array('&', '<', '>', '"', "'"), array('&amp;', '&lt;', '&gt;', '&quot;', '&#039;'), $text);
	}
	
	function html_convert($array)
	{
		if (is_array($array))
		{
			foreach($array as $key=>$value)
			{
				if(is_array($value))
					$array[$key]	= html_convert($value);
				else
					$array[$key]	= htm2text($value);
			}
		}
		else
			$array	= htm2text($array);
		return $array;
	}
	
}
?>