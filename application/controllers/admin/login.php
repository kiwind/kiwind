<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Login extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function index()
		{
			$this->load->helper('file');
			delete_files('images/captcha/');
			$this->load->helper('captcha');
			$this->load->database();
			$this->load->library('session');
			$username = $this->session->userdata('username');
			if($username=""||$username==null)
			{
				/*$img =  $this->session->userdata('captcha');
				if($img!=null&&$img!="")
				{
					$imgsrc = $img['imgsrc'];
					if($imgsrc!=null||imgsrc!="")
					{
						unlink($imgsrc);
					}
				}*/
				
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
					'imgsrc'=>$cap['imgsrc'],
					'menu'=>0,
					'smenu'=>0
				    );
				
				$this->session->set_userdata('captcha', $data);
				$data=array('title'=>'后台登陆-'.$this->config->item('title'),
							'cap'=>$cap['image']);
				$this->load->view('admin/login',$data);	
			}
			else 
			{
				header('Location:'.site_url('admin/index'));
			}
		}
		
		function validate()
		{
			$username = $_POST["name"];
			$pwd = md5($_POST["pwd"]);
			$captcha = $_POST["captcha"];
			$this->load->database();
			$query = $this->db->query("select * from admin where name='$username' and pwd='$pwd'");
			$rows=$query->num_rows();
			if($rows)
			{
				$this->load->library('session');
				$img =  $this->session->userdata('captcha');
				if(strtolower($captcha)==strtolower($img['word']))
				{
					$imgsrc = $img['imgsrc'];
					if($imgsrc!=null||imgsrc!="")
					{
						unlink($imgsrc);
					}
					$this->session->set_userdata('username', $username);
					$this->load->model('admin/madmin');
					$this->madmin->updateLogintime(time());
					$this->madmin->updateLoginip($this->input->ip_address());
					header('Location:'.site_url('admin/index'));
				} 
				else
				{
					$this->message->showmessage("验证码错误！",-1,0);
				}
			}
			else
			{
				$this->message->showmessage("用户名或密码错误！",-1,0);
			}
		}
	}
/* End of file login.php */
