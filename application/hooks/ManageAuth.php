<?php
class ManageAuth{
	private $CI;
	function __construct()
	{
		$this->CI=&get_instance();
	}
	
	function auth()
	{
		$url = uri_string();
		if(preg_match("/admin.*/i", $url)&&!strstr($url, "login"))
		{
			 $this->CI->load->library('session');
			 if(!$this->CI->session->userdata('username') )
			 {
			 	redirect("admin/login");
			 }
		}
	}
}
?>