<?php
	class Mmodel extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->table="model";
		}
		
		function get()
		{
			$this->db->select('id,title,table,desc')->from($this->table); 
			$query = $this->db->get();
			return $query->result();
		}
		
		function getList()
		{
			$this->db->select('id,title')->from($this->table); 
			$query = $this->db->get();
			return $query->result();
		}
		
		function getById($id)
		{
			$this->db->select('id,title,table,desc')->from('model')->where('id',$id); 
			$query = $this->db->get();
			return $query->row();
		}
		
		function getTitleById($id)
		{
			$this->db->select('title')->from('model')->where('id',$id); 
			$query = $this->db->get();
			$row = $query->row();
			return $row->title;
		}
		
		function getTablenameById($id)
		{
			$this->db->select('table')->from('model')->where('id',$id); 
			$query = $this->db->get();
			$row = $query->row();
			return $row->table;
		}
		
		function updateLogintime($time,$username)
		{
			$data=array('logintime'=>$time);
			$this->db->update('admin',$data)->where('name',$username);
		}
		
		function updateById($data,$id)
		{
			$this->db->where('id',$id)->update('model',$data);
		}
	}
/* End of file mmodel.php */