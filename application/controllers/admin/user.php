<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mbase');
	}
	
	public function index()
	{
		
	}
	
	function changepwd($action)
	{
		$table = "admin";
		$view="admin/changepwd";
		$this->load->model('admin/muser');
		$url='admin/user/changepwd/view';
		$data=array('action'=>$action);
		switch($action)
		{
			case 'view':
				$this->load->view($view,$data);
				break;
			case 'update':
				$ymm = $this->input->post('ymm',true);
				$this->load->library('session');
				$this->load->model('admin/madmin');
				$username = $this->session->userdata('username');
				$pwd = $this->madmin->getPwdByName($username);
				if(md5($ymm)!= $pwd)
				{
					$this->message->showmessage("原密码错误！",$url);
				}
				else
				{
					$xmm = $this->input->post('xmm',true);
					$this->madmin->updatePwd($username,md5($xmm));
					$this->message->showmessage("修改密码成功！",$url);
				}
				break;
		}
	}
	
	function group($action,$id=0)
	{
		$table="user_group";
		$view="admin/user_group";
		$this->load->model('admin/muser');
		$url='admin/user/group/view';
		$data=array('action'=>$action);
		switch($action)
		{
			case 'view':
				$data['group'] = $this->muser->getGroup();
				$this->load->view($view,$data);
				break;
			case 'add_view':
				$data['midx']=$this->mbase->getMaxIdx($table)+1;
				$this->load->view($view,$data);
				break;
			case 'add':
				$title = $this->input->post('title',true);
				$idx = $this->input->post('idx',true);
				$group=array('title'=>$title,
							 'idx'=>$idx);
				$this->mbase->add($group,$table);
				$this->message->showmessage("添加用户组成功！",$url);
				break;
			case 'update_view':
				$data['item']=$this->muser->getGroupById($id);
				$this->load->view($view,$data);
				break;
			case 'update':
				$title = $this->input->post('title',true);
				$idx = $this->input->post('idx',true);
				$group=array('title'=>$title,
							 'idx'=>$idx);
				$this->muser->updateGroupById($group,$id);
				$this->message->showmessage("修改用户组成功！",$url);
				break;
			case 'delete':
				$id=explode("l",$id);
				for($i=0;$i<sizeof($id);$i++)
				{
					$this->mbase->deleteById($id[$i],$table);
				}
				$this->message->showmessage("删除用户组成功！",$url);
				break;
			default:
				break;
		}
	}
}

/* End of file user.php */