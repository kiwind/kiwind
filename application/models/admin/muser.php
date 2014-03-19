<?php
	class Muser extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}

		function getGroup()
		{
			$this->db->select('id,title')->from('user_group')->order_by("idx", "asc"); 
			$query = $this->db->get();
			return $query->result();
		}
		
		function getGroupById($id)
		{
			$this->db->select('id,title,idx')->from('user_group')->where('id',$id); 
			$query = $this->db->get();
			return $query->row();
		}
		
		function updateLogintime($time,$username)
		{
			$data=array('logintime'=>$time);
			$this->db->update('admin',$data)->where('name',$username);
		}
		
		function updateGroupById($data,$id)
		{
			$this->db->where('id',$id)->update('user_group',$data);
		}
	}
/* End of file muser.php */