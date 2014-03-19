<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Content extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mbase');
	}
	
	function index()
	{
		$this->load->model('admin/mcolumn');
		$arry=$this->mcolumn->getList();
        $this->load->library('column');
        $this->column->listColumn($arry,'',0);
        $data=array('action'=>'view');
        $data['res'] = $this->column->_res;
        $this->load->view('admin/content',$data);
	}

	function manage($action,$cid,$id=0)
	{
		$this->load->library('session');
		$data=array('action'=>$action);
		$view="admin/content";
		$this->load->model('admin/mcolumn');
		$this->load->model('admin/mcontent');
		$column = $this->mcolumn->getById($cid);
		$data['title']=$column->title;
		$data['cid']=$cid;
		$data['id']=$id;
		$url = 'admin/content/manage/list';
		switch($action)
		{
			case 'search':
				$mid = $column->mid;
				$this->load->model('admin/mmodel');
				$tablename = $this->mmodel->getTablenameById($mid);
				$fieldname = $this->mcontent->getFieldnameIsshowByMid($mid);
				$fieldtype = $this->mcontent->getFieldtypeIsshowByMid($mid);
				$like = array();
				$key="";
				foreach($fieldname as $item)
				{
					if($item['issearch']==1)
					{
						$like[$item['name']]=$this->input->get($item['name'],true);
						$key.=$item['name']."=".$like[$item['name']]."&";
					}
				}
				$key=substr($key,0,strlen($key)-1);
				$this->load->library('pagebar');
				$config['page_query_string'] = true;
				$config['query_string_segment'] = 'p';
		    	$config['base_url'] = site_url().'admin/content/manage/search/'.$cid."?".$key;
				$pn=$this->input->get('p',true);
				$this->session->set_userdata('page',$pn);
				$pagen=($pn==0?1:$pn);
				$config['cur_page'] = $pagen; 
				$config['num_links'] = 3;
			    $config['first_link'] = '首页';
			    $config['next_link'] = '下一页';
			    $config['prev_link'] = '上一页';
			    $config['last_link'] = '尾页';
			    $config['per_page'] = 10;
				if($pagen==0)
			    {
			      	$pagen=0;
			    }
			    else
			    {
			      	$pagen=$pagen-1;
			    }
			    $select="id";
				foreach($fieldname as $item)
				{
					$select.=",".$item['name'];
				}
				$where=array('cid'=>$data['cid']);
				$arry=$this->mcontent->getSearchList($select,$tablename,$where,$like,$pagen,$config['per_page']);
				$config['total_rows'] = $this->mcontent->getSearchTotal($tablename,$where,$like);
				$this->pagebar->initialize($config);
				$pages =  $config['total_rows']%$config['per_page']==0?($config['total_rows']/$config['per_page']):($config['total_rows']/$config['per_page'])+1;
				if($pagen>$pages)
				{
					$pagen=$pagen-1;
				}
				$this->load->library('field');
				$data['fieldothername'] = $this->mcontent->getFieldOthernameByMid($mid);
				$data['fieldname']=$fieldname;
				$data['res']=$this->field->praseContent($arry,$fieldname,$fieldtype);
				$data['searchstr']=$this->field->_searchStr;
				$data['pagebar']=$this->pagebar->create_links();
				$this->load->view($view,$data);break;
				break;
			case 'list':
				$mid = $column->mid;
				$ccid = $column->cid;
				$this->load->model('admin/mmodel');
				$tablename = $this->mmodel->getTablenameById($mid);
				if($ccid==2)
				{
					$pagen=($id==0?1:$id);
					$this->session->set_userdata('page',$pagen);
					$this->load->library('pagebar');
				   	$config['base_url'] = site_url().'admin/content/manage/list/'.$cid;
				    $config['total_rows'] = $this->mcontent->getTotal($tablename);
				    $config['per_page'] = 10;
				    $pages =  $config['total_rows']%$config['per_page']==0?($config['total_rows']/$config['per_page']):($config['total_rows']/$config['per_page'])+1;
				    if($pagen>$pages)
				    {
				    	$pagen=$pagen-1;
				    }
				    $config['cur_page'] = $pagen; 
				    $config['num_links'] = 3;
			      	$config['first_link'] = '首页';
			      	$config['next_link'] = '下一页';
			      	$config['prev_link'] = '上一页';
			      	$config['last_link'] = '尾页';
			      	$this->pagebar->initialize($config);
			      	if($pagen==0)
			      	{
			      		$pagen=0;
			      	}
			      	else
			      	{
			      		$pagen=$pagen-1;
			      	}
					$fieldname = $this->mcontent->getFieldnameIsshowByMid($mid);
					$fieldtype = $this->mcontent->getFieldtypeIsshowByMid($mid);
					$data['fieldothername'] = $this->mcontent->getFieldOthernameByMid($mid);
					$data['fieldname']=$fieldname;
					$select="id";
					foreach($fieldname as $item)
					{
						$select.=",".$item['name'];
					}
					$where=array('cid'=>$data['cid']);
					$arry=$this->mcontent->getList($select,$tablename,$where,$pagen,$config['per_page']);
					$this->load->library('field');
					$data['res']=$this->field->praseContent($arry,$fieldname,$fieldtype);
					$data['searchstr']=$this->field->_searchStr;
					$data['pagebar']=$this->pagebar->create_links();
					$this->load->view($view,$data);break;
				}
				if($ccid==3)
				{
					$item = $this->mcontent->getItemByCid($tablename,$cid);
					if(sizeof($item)==0)
					{
						redirect(site_url('admin/content/manage/add_view/'.$data['cid']));
					}
					else
					{
						redirect(site_url('admin/content/manage/update_view/'.$data['cid']));
					}
				}
                break;
			case 'add_view':
                $mid = $column->mid;
                $this->load->model('admin/mmodel');
				$tablename = $this->mmodel->getTablenameById($mid);
                $fields = $this->mcontent->getFieldByMid($mid);
                $this->load->library('field');
                $data['res']=$this->field->prase($fields,$tablename,$cid);
                $data['jsstr']=$this->field->_jsStr;
                $this->load->view($view,$data);
                break;
			case 'add':
				$mid = $column->mid;
				$this->load->model('admin/mmodel');
				$tablename = $this->mmodel->getTablenameById($mid);
				$fieldname = $this->mcontent->getFieldnameByMid($mid);
				$adddata = array();
				foreach ($fieldname as $item)
				{
					$ftypeid = $this->mcontent->getFieldTypeByMid($mid,$item->name);
					$ftype = $this->mcontent->getFieldtypeTitle($ftypeid);
					if($ftype=='date'||$ftype=='datetime')
					{
						$adddata[$item->name]=time($this->input->post($item->name,true));
					}
					else if($ftype=="editor")
					{
						$adddata[$item->name]=$this->input->post($item->name);
					}
					else
					{
						$adddata[$item->name]=$this->input->post($item->name,true);
					}
				}
				$adddata['cid']=$data['cid'];
				$this->mbase->add($adddata,$tablename);
				$this->message->showmessage("添加".$data['title']."成功！",$url."/".$cid);
				break;
			case 'update_view':
				$mid = $column->mid;
				$ccid = $column->cid;
				$this->load->model('admin/mmodel');
				$tablename = $this->mmodel->getTablenameById($mid);
                $fields = $this->mcontent->getFieldByMid($mid);
                if($ccid==3)
                {
                	$item = $this->mcontent->getItemByCid($tablename,$cid);
                }
                else
                {
                	$item = $this->mcontent->getItem($tablename,$id);
                }
                $this->load->library('field');
                $data['res']=$this->field->praseUpdate($fields,$item,$tablename,$cid);
                $data['jsstr']=$this->field->_jsStr;
                $this->load->view($view,$data);
				break;
			case 'update':
				$mid = $column->mid;
				$this->load->model('admin/mmodel');
				$tablename = $this->mmodel->getTablenameById($mid);
				$fieldname = $this->mcontent->getFieldnameByMid($mid);
				$updatedata = array();
				foreach ($fieldname as $item)
				{
					$ftypeid = $this->mcontent->getFieldTypeByMid($mid,$item->name);
					$ftype = $this->mcontent->getFieldtypeTitle($ftypeid);
					if($ftype=='date'||$ftype=='datetime')
					{
						$updatedata[$item->name]=time($this->input->post($item->name,true));
					}
					else if($ftype=="editor")
					{
						$updatedata[$item->name]=$this->input->post($item->name);
					}
					else
					{
						$updatedata[$item->name]=$this->input->post($item->name,true);
					}
				}
				$ccid = $column->cid;
				if($ccid==3)
                {
                	$this->mcontent->updateBycid($updatedata,$tablename,$cid);
                }
                else
                {
                	$this->mcontent->update($updatedata,$tablename,$id);
                }
				$this->message->showmessage("修改".$data['title']."成功！",$url."/".$cid);
				break;
			case 'delete':
				$mid = $column->mid;
				$this->load->model('admin/mmodel');
				$tablename = $this->mmodel->getTablenameById($mid);
				$id=explode("l",$id);
				for($i=0;$i<sizeof($id);$i++)
				{
					$this->mbase->deleteById($id[$i],$tablename);
				}
				$this->message->showmessage("删除".$data['title']."成功！",$url."/".$cid);
				break;
			default:break;
		}
	}
	
	function column($action,$id=0)
	{
		$table="column";
		$view="admin/column";
		$this->load->model('admin/mcolumn');
		$url = 'admin/content/column/view';
		$data=array('action'=>$action);
		switch($action)
		{
			case 'view':
				$arry=$this->mcolumn->getList();
                $this->load->library('column');
                $this->column->listColumn($arry,'',0);
                $data['res'] = $this->column->_res;
                $this->load->view($view,$data);break;
			case 'add_view':
                $data['midx']=$this->mcolumn->getMaxIdx()+1;
                $this->load->model('admin/mmodel');
                $this->load->model('admin/mtype');
                $data['mlist']=$this->mmodel->getList();
                $data['clist']=$this->mtype->getListBypid(1);
                $arry=$this->mcolumn->getList();
                $this->load->library('column');
                $this->column->listColumn($arry,'',0);
                $data['res'] = $this->column->_res;
                $this->load->view($view,$data);
                break;
			case 'add':
				$title = $this->input->post('title',true);
				$pid = $this->input->post('pid',true);
				$cid = $this->input->post('cid',true);
				$mid = $this->input->post('mid',true);
				$idx = $this->input->post('idx',true);
				$adddata=array('title'=>$title,
							   'pid'=>$pid,
							   'cid'=>$cid,
							   'mid'=>$mid,
							   'idx'=>$idx);
				$this->mbase->add($adddata,$table);
				$this->message->showmessage("添加栏目成功！",$url);
				break;
			case 'update_view':
				$arry=$this->mcolumn->getList();
                $this->load->library('column');
                $this->column->listColumn($arry,'',0);
                $data['res'] = $this->column->_res;
				$data['item']=$this->mcolumn->getById($id);
				$this->load->model('admin/mmodel');
                $this->load->model('admin/mtype');
				$data['mlist']=$this->mmodel->getList();
				$data['clist']=$this->mtype->getListBypid(1);
				$this->load->view($view,$data);
				break;
			case 'update':
				$title = $this->input->post('title',true);
				$pid = $this->input->post('pid',true);
				$cid = $this->input->post('cid',true);
				$mid = $this->input->post('mid',true);
				$idx = $this->input->post('idx',true);
				$updatedata=array('title'=>$title,
							   'pid'=>$pid,
							   'cid'=>$cid,
							   'mid'=>$mid,
							   'idx'=>$idx);
				$this->mcolumn->updateById($updatedata,$id);
				$this->message->showmessage("修改栏目成功！",$url);
				break;
			case 'delete':
				$id=explode("l",$id);
				for($i=0;$i<sizeof($id);$i++)
				{
					$this->mbase->deleteById($id[$i],$table);
				}
				$this->message->showmessage("删除栏目成功！",$url);
				break;
			case 'sort':
				$id=explode("l",$id);
				for($i=0;$i<sizeof($id);$i++)
				{
					$iditem = explode("_",$id[$i]);
					$sdata=array('idx'=>$iditem[0]);
					$this->mcolumn->updateById($sdata,$iditem[1]);
				}
				$this->message->showmessage("排序成功！",$url);
				break;
			default:break;
		}
	}
	
	function model($action,$id=0)
	{
		$table="model";
		$view="admin/model";
		$this->load->model('admin/mmodel');
		$url = 'admin/content/model/view';
		$data=array('action'=>$action);
		switch($action)
		{
			case 'view':
				$list = $this->mmodel->get();
				$data['list']=$list;
				$this->load->view($view,$data);
				break;
			case 'add_view':
				$this->load->view($view,$data);
				break;
			case 'add':
				$this->load->dbforge();
				$title = $this->input->post('title',true);
				$tablename = $this->input->post('table',true);
				$desc = $this->input->post('desc',true);
				$model=array('title'=>$title,
							 'table'=>$tablename,
							 'desc'=>$desc);
				$this->mbase->add($model,$table);
				$fields = array('id'=>array('type'=>'INT',
											'constraint'=>11,
											'auto_increment' => TRUE),
								'cid'=>array('type'=>'INT',
											'constraint'=>11)     
                );
                $this->dbforge->add_field($fields);
				$this->dbforge->add_key('id', TRUE);
				$this->dbforge->create_table($tablename,true);
				$this->load->library('myfile');
				$this->myfile->mkdir("upload/".$tablename);
				$this->message->showmessage("添加模型成功！",$url);
				break;
			case 'update_view':
				$data['item']=$this->mmodel->getById($id);
				$this->load->view($view,$data);
				break;
			case 'update':
				$title = $this->input->post('title',true);
				$table = $this->input->post('table',true);
				$desc = $this->input->post('desc',true);
				$model=array('title'=>$title,
							 'desc'=>$desc);
				$this->mmodel->updateById($model,$id);
				$this->message->showmessage("修改模型成功！",$url);
				break;
			case 'delete':
				$this->load->dbforge();
				$this->load->library('myfile');
				$this->load->model('admin/mcolumn');
				$this->load->model('admin/mfield');
				$id=explode("l",$id);
				for($i=0;$i<sizeof($id);$i++)
				{
					$tablename = $this->mmodel->getTablenameById($id[$i]);
					$this->dbforge->drop_table($tablename);
					$this->mbase->deleteById($id[$i],$table);
					$this->myfile->deldir("upload/".$tablename);
					$this->mcolumn->clearModel($id[$i]);
					$this->mfield->deleteByMid($id[$i]);
				}
				$this->message->showmessage("删除模型成功！",$url);
				break;
			default:
				break;
		}
	}
	
	function field($action,$mid=0,$id=0)
	{
		$table="field";
		$view="admin/field";
		$this->load->model('admin/mmodel');
		$this->load->model('admin/mfield');
		$url = 'admin/content/field/view';
		$data=array('action'=>$action);
		$data['title'] = $this->mmodel->getTitleById($mid);
		$data['mid'] = $mid;
		switch($action)
		{
			case 'view':
				$data['fieldtype'] = $this->mfield->getFieldType();
				$data['fields']=$this->mfield->getByMid($mid);
				$this->load->view($view,$data);
				break;
			case 'add_view':
				$data['midx']=$this->mbase->getMaxIdx($table,$mid)+1;
                $data['fieldtype'] = $this->mfield->getFieldType();
                $this->load->view($view,$data);
                break;
			case 'add':
				$tid = $this->input->post('tid',true);
				$name = $this->input->post('name',true);
				$othername = $this->input->post('othername',true);
				$length = $this->input->post('length',true);
				if($length=="") $length=0;
				$tip = $this->input->post('tip',true);
				$defaultValue = $this->input->post('defaultValue',true);
				$ismust = $this->input->post('ismust',true);
				$isshow = $this->input->post('isshow',true);
				$issearch = $this->input->post('issearch',true);
				$idx = $this->input->post('idx',true);
				$addData=array('tid'=>$tid,
							'mid'=>$mid,
							'name'=>$name,
							'othername'=>$othername,
							'length'=>$length,
							'tip'=>$tip,
							'defaultValue'=>$defaultValue,
							'ismust'=>$ismust,
							'isshow'=>$isshow,
							'issearch'=>$issearch,
							'idx'=>$idx);
				$typetitle = $this->mfield->getFieldTypeTitle($tid);
				$this->load->library('field');
				$columnType = $this->field->praseType($typetitle);
				$tablename = $this->mmodel->getTablenameById($mid);
				if($length!=0)
				{
					$fields = array(
	                        $name=>array('type' => $columnType,
	                        			 'constraint' => $length,
	                        )
					);
				}
				else
				{
					$addData['length']=$columnTypeLen = $this->field->praseTypeDefaultLen($typetitle);
					if($columnType=="text")
					{
						$fields = array(
		                        $name=>array('type' => $columnType
		                        )
						);
					}
					else
					{
						$fields = array(
		                        $name=>array('type' => $columnType,
		                        			 'constraint' => $columnTypeLen
		                        )
						);
					}
					
				}
				$this->mbase->add($addData,$table);
				$this->load->dbforge();
				$this->dbforge->add_column($tablename, $fields);
				$this->message->showmessage("添加字段成功！",$url."/".$mid);
				break;
			case 'update_view':
				$data['fieldtype'] = $this->mfield->getFieldType();
				$data['field']=$this->mfield->getFieldById($id);
				$this->load->view($view,$data);
				break;
			case 'update':
				$tid = $this->input->post('tid',true);
				$name = $this->input->post('name',true);
				$othername = $this->input->post('othername',true);
				$length = $this->input->post('length',true);
				$tip = $this->input->post('tip',true);
				$defaultValue = $this->input->post('defaultValue',true);
				$ismust = $this->input->post('ismust',true);
				$isshow = $this->input->post('isshow',true);
				$issearch = $this->input->post('issearch',true);
				$idx = $this->input->post('idx',true);
				$updateData=array('tid'=>$tid,
							'mid'=>$mid,
							'name'=>$name,
							'othername'=>$othername,
							'length'=>$length,
							'tip'=>$tip,
							'defaultValue'=>$defaultValue,
							'ismust'=>$ismust,
							'isshow'=>$isshow,
							'issearch'=>$issearch,
							'idx'=>$idx);
				$this->mfield->updateById($updateData,$id);
				$typetitle = $this->mfield->getFieldTypeTitle($tid);
				$this->load->library('field');
				$columnType = $this->field->praseType($typetitle);
				$tablename = $this->mmodel->getTablenameById($mid);
				if($length!=0)
				{
					$fields = array(
	                        $name=>array('type' => $columnType,
	                        			 'constraint' => $length,
	                        )
					);
				}
				else
				{
					$updateData['length']=$columnTypeLen = $this->field->praseTypeDefaultLen($typetitle);
					if($columnType=="text")
					{
						$fields = array(
		                        $name=>array('type' => $columnType
		                        )
						);
					}
					else
					{
						$fields = array(
		                        $name=>array('type' => $columnType,
		                        			 'constraint' => $columnTypeLen,
		                        )
						);
					}
					
				}
				$this->load->dbforge();
				$this->dbforge->modify_column($tablename, $fields);
				$this->message->showmessage("修改字段成功！",$url."/".$mid);
				break;
			case 'delete':
				$id=explode("l",$id);
				$tablename = $this->mmodel->getTablenameById($mid);
				$this->load->dbforge();
				for($i=0;$i<sizeof($id);$i++)
				{
					$fieldName = $this->mfield->getFieldName($id[$i]);
					$this->dbforge->drop_column($tablename, $fieldName);
					$this->mbase->deleteById($id[$i],$table);
				}
				$this->message->showmessage("删除字段成功！",$url."/".$mid);
				break;
			case 'sort':
				$id=explode("l",$id);
				for($i=0;$i<sizeof($id);$i++)
				{
					$iditem = explode("_",$id[$i]);
					$sdata=array('idx'=>$iditem[0]);
					$array = array('id' => $iditem[1], 'mid' => $mid);
					$this->mfield->updateById($sdata,$array);
				}
				$this->message->showmessage("排序成功！",$url."/".$mid);
				break;
			default:break;
		}
	}
	
	function type($action,$id=0)
	{
		$table="type";
		$view="admin/type";
		$this->load->model('admin/mtype');
		$url = 'admin/content/type/view';
		$data=array('action'=>$action);
		switch($action)
		{
			case 'view':
				$arry=$this->mtype->getList();
                $this->load->library('type');
                $this->type->listType($arry,'',0);
                $data['res'] = $this->type->_res;
                $this->load->view($view,$data);break;
			case 'add_view':
                $data['midx']=$this->mtype->getMaxIdx($table)+1;
                $arry=$this->mtype->getList();
                $this->load->library('type');
                $this->type->listType($arry,'',0);
                $data['res'] = $this->type->_res;
                $this->load->model('admin/mmodel');
               	$data['mlist']=$this->mmodel->getList();
               	$data['clist']=$this->mtype->getColumnList();
                $this->load->view($view,$data);
                break;
			case 'add':
				$title = $this->input->post('title',true);
				$cid = $this->input->post('cid',true);
				$pid = $this->input->post('pid',true);
				$idx = $this->input->post('idx',true);
				$type=array('title'=>$title,
							'cid'=>$cid,
							'pid'=>$pid,
							 'idx'=>$idx);
				$this->mbase->add($type,$table);
				$this->message->showmessage("添加分类成功！",$url);
				break;
			case 'update_view':
				$arry=$this->mtype->getList();
                $this->load->library('type');
                $this->type->listType($arry,'',0);
                $data['res'] = $this->type->_res;
				$data['item']=$this->mtype->getById($id);
				$data['clist']=$this->mtype->getColumnList();
				$this->load->view($view,$data);
				break;
			case 'update':
				$title = $this->input->post('title',true);
				$cid = $this->input->post('cid',true);
				$pid = $this->input->post('pid',true);
				$idx = $this->input->post('idx',true);
				$type=array('title'=>$title,
							'cid'=>$cid,
							'pid'=>$pid,
							'idx'=>$idx);
				$this->mtype->updateById($type,$id);
				$this->message->showmessage("修改分类成功！",$url);
				break;
			case 'delete':
				$id=explode("l",$id);
				for($i=0;$i<sizeof($id);$i++)
				{
					$this->mbase->deleteById($id[$i],$table);
				}
				$this->message->showmessage("删除分类成功！",$url);
				break;
			default:break;
		}
	}
}

/* End of file content.php */