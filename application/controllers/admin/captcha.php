<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Captcha extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function index()
		{
			$this->load->helper('captcha');
			$this->load->library('session');
			$img =  $this->session->userdata('captcha');
			if($img!=null)
			{
				$imgsrc = $img['imgsrc'];
				if($imgsrc!=null||imgsrc!="")
				{
					unlink($imgsrc);
				}
			}
			$vals = array(
			    'img_path' => 'images/captcha/',
			    'img_url' => base_url('images/captcha').'/',
			    'img_width' => '60',
    			'img_height' => '32'
			    );
			
			$cap = create_captcha($vals);
			
			$data = array(
			    'image' => $cap['image'],
			    'word' => $cap['word'],
				'imgsrc'=>$cap['imgsrc']
			    );
			
			
			$this->session->set_userdata('captcha', $data);
			echo $cap['image'];
		}
	}
/* End of file captcha.php */
