<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mtype extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->table="type";
	}

    function getMaxIdx($table)
    {
        $this->db->select_max("idx")->from($table);
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
    	$this->db->select('id,title,cid,pid')->from($this->table);
    	$query = $this->db->get();
    	return $query->result_array();
    	/*$this->db->select('type.id,type.title,model.title as mtitle,type.pid');
		$this->db->from('type');
		$this->db->join('model', 'model.id =type.mid');
		$this->db->order_by('type.idx','asc');
		$query = $this->db->get();
		return $query->result_array();*/
    }
    
	function getListBycid($cid)
    {
    	$this->db->select('id,title,cid,pid')->from($this->table)->where('cid',$cid);
    	$query = $this->db->get();
    	return $query->result_array();
    }
    
	function getColumnList()
    {
    	$this->db->select('id,title')->from('column')->order_by('idx','asc');
    	$query = $this->db->get();
    	return $query->result();
    }
    
	function getListBypid($pid)
    {
    	$this->db->select('id,title')->from($this->table)->where('pid',$pid);
    	$query = $this->db->get();
    	return $query->result();
    }
    
	function getById($id)
	{
		$this->db->select('id,cid,title,pid,idx')->from($this->table)->where('id',$id); 
		$query = $this->db->get();
		return $query->row();
	}
	
	function updateById($data,$id)
	{
		$this->db->where('id',$id)->update($this->table,$data);
	}
}
/* End of file mtype.php */