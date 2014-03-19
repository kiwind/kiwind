<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Index extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->library('session');
		}
	
		function index()
		{
			$username = $this->session->userdata('username');
			if($username=""||$username==null)
			{
				header('Location:'.site_url('admin/login'));
			}
			else 
			{
				$this->load->view('admin/index');
			}
		}
		
		function test()
		{
			echo "test";
		}
		
		function logout()
		{
			$this->session->unset_userdata('username');
			header('Location:'.site_url('admin/login'));
		}
		
		function main(){
			$this->load->view('admin/index_main');
		}
	}
/* End of file index.php */
