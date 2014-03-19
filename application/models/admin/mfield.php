<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mfield extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->table="field";
	}
	
	function getFieldType()
	{
		$this->db->select('id,text')->from('field_type')->order_by('id','asc');
		$query=$this->db->get();
		return $query->result_array();
	}
	
	function getByMid($mid)
	{
		$this->db->select('field.idx,field.id,field.name,field.othername,field_type.text as type');
		$this->db->from('field');
		$this->db->join('field_type', 'field_type.id =field.tid');
		$this->db->where('field.mid',$mid);
		$this->db->order_by('idx','asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getFieldTypeTitle($id)
	{
		$this->db->select('title')->from('field_type')->where('id',$id);
		$query=$this->db->get();
		$row = $query->row();
		return $row->title;
	}
	
	function getFieldById($id)
	{
		$this->db->select('id,tid,mid,name,othername,length,tip,defaultValue,ismust,isshow,issearch,idx')
				 ->from($this->table)
				 ->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	function getFieldName($id)
	{
		$this->db->select('name')->from($this->table)->where('id',$id);
		$query = $this->db->get();
		$row = $query->row();
		return $row->name;
	}
	
	function updateById($data,$where)
	{
		$this->db->where($where)->update($this->table,$data);
	}
	
	function deleteByMid($mid)
    {
    	$this->db->from($this->table)->where('mid',$mid);
    	$this->db->delete();
    }
}
/* End of file mtype.php */