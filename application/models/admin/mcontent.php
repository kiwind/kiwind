<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mcontent extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function getTotal($table)
	{
		return $this->db->count_all_results($table);
	}
	
	function getSearchTotal($table,$where,$like)
	{
		$this->db->select('id')->from($table)->where($where)->like($like);
		$query = $this->db->get();
		$res = $query->result();
		return sizeof($res);
	}

	function getFieldByMid($mid)
	{
		$this->db->select('field.name,field.mid,field.othername,field_type.title as type,field.tip,field.length,field.defaultValue,field.isshow,field.ismust,field.issearch');
		$this->db->from('field');
		$this->db->join('field_type', 'field_type.id =field.tid');
		$this->db->where('field.mid',$mid);
		$this->db->order_by('field.idx','asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getFieldnameByMid($mid)
	{
		$this->db->select('name')->from('field')->where('mid',$mid);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getFieldTypeByMid($mid,$name)
	{
		$array = array('mid' => $mid, 'name' =>$name);
		$this->db->select('tid')->from('field')->where($array);
		$query = $this->db->get();
		$row = $query->row();
		return $row->tid;
	}
	
	function getFieldtypeTitle($id)
	{
		$this->db->select('title')->from('field_type')->where('id',$id);
		$query = $this->db->get();
		$row = $query->row();
		return $row->title;
	}
	
	function getFieldnameIsshowByMid($mid)
	{
		$array = array('mid' => $mid, 'isshow' => 1);
		$this->db->select('name,issearch,othername')->from('field')->where($array)->order_by("idx","asc");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getFieldtypeIsshowByMid($mid)
	{
		$array = array('field.mid' => $mid, 'field.isshow' => 1);
		$this->db->select('field_type.title as type');
		$this->db->from('field');
		$this->db->join('field_type', 'field_type.id =field.tid');
		$this->db->where($array);
		$this->db->order_by('field.idx','asc');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getFieldOthernameByMid($mid)
	{
		$array = array('mid' => $mid, 'isshow' => 1);
		$this->db->select('othername')->from('field')->where($array)->order_by("idx","asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function getList($select,$table,$where,$page,$perpage)
	{
		$this->db->select($select)->from($table)->where($where)->order_by('id','desc')->limit($perpage,$page*$perpage);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getSearchList($select,$table,$where,$like,$page,$perpage)
	{
		$this->db->select($select)->from($table)->where($where)->like($like)->order_by('id','desc')->limit($perpage,$page*$perpage);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getItem($table,$id)
	{
		$this->db->from($table)->where('id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	function getItemByCid($table,$cid)
	{
		$this->db->from($table)->where('cid',$cid);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	function update($data,$table,$id)
	{
		$this->db->where('id',$id)->update($table,$data);
	}
	function updateBycid($data,$table,$cid)
	{
		$this->db->where('cid',$cid)->update($table,$data);
	}
}
/* End of file mcontent.php */