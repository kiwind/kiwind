<?php
	class Index extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function Index()
		{
			$this->load->view('index.html');
		}
	}
/* End of file */