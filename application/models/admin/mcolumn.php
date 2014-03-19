<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mcolumn extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->table="column";
	}

	function getMaxIdx()
	{
        $this->db->select_max("idx")->from($this->table);
        $query = $this->db->get();
		$row = $query->row();
		return $row->idx;
	}

    function getParent()
    {
        $this->db->select('id,title,pid')->from($this->table)->where('pid',0);
        $query=$this->db->get();
        return $query->result();
    }
    
	function getList()
    {
    	$this->db->select('id,title,pid,cid,mid,idx')->from($this->table)->order_by('idx','asc');
    	$query = $this->db->get();
    	return $query->result_array();
    }
    
	function getById($id)
	{
		$this->db->select('id,title,pid,cid,mid,idx')->from($this->table)->where('id',$id); 
		$query = $this->db->get();
		return $query->row();
	}
	
	function getTitle($id)
	{
		$this->db->select('title')->from($this->table)->where('id',$id);
		$query = $this->db->get();
		$row = $query->row();
		return $row->title;
	}
	
	function updateById($data,$id)
	{
		$this->db->where('id',$id)->update($this->table,$data);
	}
	
	function clearModel($mid)
	{
		$data=array('mid'=>0);
		$this->db->where('mid',$mid)->update($this->table,$data);
	}
}
/* End of file mtype.php */