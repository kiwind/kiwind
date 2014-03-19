<?php
	class Admin extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		function getAdminPowerByName($username)
		{
			$query = $this->db->query("select user_power.title as ptitle  from user_power left join admin on admin.name='$username' and user_power.id=admin.pid");
			$row = $query->row();
			return $row->ptitle;
		}
		
		function getNickname($name)
		{
			$this->db->select('nickname')->from('admin')->where('name',$name);
			$query=$this->db->get();
			$row = $query->row();
			return $row->nickname;
		}
		
		function getUserByname($name)
		{
			$this->db->select('name,logintime,loginip')->from('admin')->where('name',$name);
			$query=$this->db->get();
			return $query->row();
		}
		
		function updateLogintime($time)
		{
			$this->db->query("update admin set logintime=$time");
		}
		
		function updateLoginip($ip)
		{
			$this->db->query("update admin set loginip='$ip'");
		}
	}
/* End of file */