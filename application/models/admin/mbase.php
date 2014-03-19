<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mbase extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function getMaxIdx($table,$mid)
	{
        $this->db->select_max("idx")->from($table)->where("mid",$mid);
        $query = $this->db->get();
		$row = $query->row();
		return $row->idx;
	}
    
	function getList($table)
    {
    	$query = $this->db->get($table);
    	return $query->result();
    }
	
    function getById($table)
    {
    	$this->db->from($table)->where('id',$id); 
		$query = $this->db->get();
		return $query->row();
    }

    function add($data,$table)
    {
        $this->db->insert($table,$data);
    }

    function deleteById($id,$table)
    {
    	$this->db->from($table)->where('id',$id);
    	$this->db->delete();
    }
}
/* End of file mbase.php */