<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Type
{
	var $_res = array();
	var $_index=0;
	function Type()
	{
	}
	
	function listType($arry,$tag,$pid=0)
	{
		$this->CI=&get_instance(); 
		$this->CI->load->database();
		//$this->CI->load->model('admin/mmodel');
		for($i=0;$i<count($arry);$i++)
		 {
		 	if($arry[$i]['id']!=1)
		 	{
			 	if($arry[$i]['pid']==$pid)
			 	{
			 		$this->_res[$this->_index]=array();
			 		$this->_res[$this->_index][0]=$arry[$i]['id'];
			 		$this->_res[$this->_index][1]=$tag.$arry[$i]['title'];
			 		if($arry[$i]['cid']!=0)
			 		{
			 			$this->CI->db->select('title')->from('column')->where('id',$arry[$i]['cid']);
				 		$query = $this->CI->db->get();
				 		$row = $query->row();
				 		$this->_res[$this->_index][2]=$row->title;
			 		}
			 		else
			 		{
			 			$this->_res[$this->_index][2]="";
			 		}
			 		$this->_index++; 
			 		$this->listType($arry,$tag."&nbsp;├─&nbsp;",$arry[$i]['id']);
			 	}
		 	}	
		 	
		 }         
	}
}
?>