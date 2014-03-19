<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('utf8_substr'))
{
	function utf8_substr($str, $from, $len = 180, $suffix = '') { 
		$str     = trim($str);
		$str     = strip_tags($str);
		$pre_len = strlen($str);
		$str     = preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'. $from .'}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'. $len .'}).*#s', '$1', $str);
		if ($pre_len != strlen($str)) {
			$str .= $suffix;
		}
		return $str;
	}
}



/* End of file common_helper.php */
/* Location: ./application/helpers/common_helper.php */