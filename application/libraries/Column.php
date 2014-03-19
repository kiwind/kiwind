<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Column
{
	var $_res = array();
	var $_index=0;
	function listColumn($arry,$tag,$pid=0)
	{
		$this->CI=&get_instance(); 
		$this->CI->load->database();
		$this->CI->load->model('admin/mmodel');
		for($i=0;$i<count($arry);$i++)
		 {
		 	if($arry[$i]['pid']==$pid)
		 	{
		 		$this->_res[$this->_index]=array();
		 		$this->_res[$this->_index][0]=$arry[$i]['id'];
		 		$this->_res[$this->_index][1]=$tag.$arry[$i]['title'];
		 		if($arry[$i]['mid']!=0)
		 		{
		 			$this->CI->db->select('title')->from('model')->where('id',$arry[$i]['mid']);
		 			$query = $this->CI->db->get();
		 			$row = $query->row();
		 			$this->_res[$this->_index][2]=$row->title;
		 		}
		 		else
		 		{
		 			$this->_res[$this->_index][2]="";
		 		}
		 		if($arry[$i]['cid']!=0)
		 		{
		 			$this->CI->db->select('title')->from('type')->where('id',$arry[$i]['cid']);
			 		$query = $this->CI->db->get();
			 		$row = $query->row();
			 		$this->_res[$this->_index][3]=$row->title;
		 		}
		 		else
		 		{
		 			$this->_res[$this->_index][3]="";
		 		}
		 		$this->_res[$this->_index][4]=$arry[$i]['idx'];
		 		$this->_index++; 
		 		$this->listColumn($arry,$tag."&nbsp;├─&nbsp;",$arry[$i]['id']);
		 	}
		 	
		 }         
	}
}
?>