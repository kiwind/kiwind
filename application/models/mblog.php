<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mblog extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->table="article";
	}
    
    function getTotal()
    {
        return $this->db->count_all_results( $this->table);
    }

    function getTotalByTid($tid)
    {
        $this->db->select('id')->from($this->table)->where('type',$tid);
        $query = $this->db->get();
        $res = $query->result();
        return sizeof($res);
    }

    function getList($page,$perpage)
    {
        $this->db->select('*')->from($this->table)->order_by('id','desc')->limit($perpage,$page*$perpage);
        $query = $this->db->get();
        return $query->result();
    }

    function getListByType($tid,$page,$perpage)
    {
        $this->db->select('*')->from($this->table)->where('type',$tid)->order_by('id','desc')->limit($perpage,$page*$perpage);
        $query = $this->db->get();
        return $query->result();
    }

    function getArticles()
    {
    	$this->db->select("id,title,thumb,content,good_count,comment_count,datetime")->from($this->table)->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }
    
	function getArticlesByCat($catid)
    {
    	$this->db->select("id,title,thumb,content,good_count,comment_count,datetime")->from($this->table)->where("type",$catid)->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }
    
    function getArticle($id)
    {
    	$this->db->select("*")->from($this->table)->where('id',$id);
    	$query = $this->db->get();
    	return $query->row();
    }
    
    function getType()
    {
    	$this->db->select("id,title")->from('type')->where('pid',4)->order_by('idx','asc');
		$query = $this->db->get();
		return $query->result();
    }

    function getFriendlyLink()
    {
        $this->db->select("id,name,title,url")->from('friendly_link');
        $query = $this->db->get();
        return $query->result();
    }
    
    function updateGoodCount($id,$count)
    {
        /*$data = array(
               'good_count' => $count
            );

$this->db->where('id', $id);
$this->db->update($this->table, $data); */

    	//$this->db->update($this->table)->set("good_count",$count)->where("id",$id);
    }
}
/* End of file Mblog */