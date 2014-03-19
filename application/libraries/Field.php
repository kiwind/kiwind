<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Field
{
	var $_res = array();
	var $_index=0;
	var $_jsStr="";
	var $_searchStr="";
	function prase($res,$table,$cid)
	{
		$jsStr="<script type='text/javascript'>
					var form = $('#contentForm')[0];
					var url=$('#contentSumbitBtn').attr('href');
					$('#contentSumbitBtn').click(function(){
						
						if(false)
						{
						  	return false;
						}";
		
		foreach($res as $item)
		{
			$mstr=$item->ismust==0?"":"<em>*</em>";
			$pre="<li><b>".$mstr.$item->othername."</b>";
			$next="<label class='tip'>".$item->tip."</label></li>";
			$formtype="";
			if($item->ismust==1)
			{
				$jsStr.="else if(!checkFormObj1(form.".$item->name.",'".$item->othername."不能为空!'))
						{
							form.".$item->name.".focus();	
							return false;
						}";	
			}
			if($item->length>0)
			{
				$jsStr.="else if(!checkFormObj2(form.".$item->name.",".$item->length.",'".$item->othername."不能超过".$item->length."个字符!'))
						{
							form.".$item->name.".focus();	
							return false;
						}";	
			}
			switch ($item->type)
			{
				case 'text':
					$formtype="<input class='uiText' style='width:200px;' type='text' name='".$item->name."' />";
					break;
				case 'textarea':
					$formtype="<textarea cols='60' rows='5' name='".$item->name."'></textarea>";
					break;
				case 'editor':
					$formtype="<textarea cols='90' rows='24' id='content' name='".$item->name."'></textarea>
							<script type='text/javascript' src='".base_url('ckeditor/ckeditor.js')."'></script>
							<script type='text/javascript'>
							<!--
							CKEDITOR.replace( '".$item->name."', {
								filebrowserBrowseUrl:'".base_url('ckfinder/ckfinder.html')."',
								filebrowserImageBrowseUrl:'".base_url('ckfinder/ckfinder.html?Type=Images')."',
								filebrowserFlashBrowseUrl:'".base_url('ckfinder/ckfinder.html?Type=Flash')."',
								filebrowserUploadUrl:'".base_url('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')."',
								filebrowserImageUploadUrl:'".base_url('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')."',
								filebrowserFlashUploadUrl:'".base_url('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')."'
							});
							//-->
							</script>";
					$formtype.="<script type='text/javascript' src='".base_url('ckeditor/plugins/syntaxhighlighter/scripts/shCore.js')."></script>";
					$formtype.="<script type='text/javascript' src='".base_url('ckeditor/plugins/syntaxhighlighter/scripts/shBrushAll.js')."></script>";			
					$formtype.="
								<script type='text/javascript'>
								SyntaxHighlighter.defaults['toolbar'] = false;  // 不显示syntaxhighlighter工具栏
								SyntaxHighlighter.all();
								</script>";
					$formtype.="<link href='".base_url('ckeditor/plugins/syntaxhighlighter/styles/shCoreDefault.css')."' rel='stylesheet' type='text/css' />";			
					$formtype.="<i class='clear'></i>";
					break;
				case 'image':
					$formtype="<script type='text/javascript' src='".base_url('js/ajaxfileupload.js')."'></script>";
					$formtype.="<input id='fileUpload' class='uiText' style='width:260px;' type='text' name='".$item->name."' />";
					$formtype.="<input id='fileUploadFolder' type='hidden' value='".$table."' />";
					$formtype.="<input id='weburl' type='hidden' value='".site_url()."' />";
					$formtype.="<a class='uiUpload' href='javascript:;' title='选择本地文件'><span>选择本地文件</span><input id='fileToUpload' class='uiFileBtn' fileType='image' name='fileToUpload' type='file' /></a>";
					$formtype.="<img id='fileUploadImg' style='padding-left:15px;' src='".base_url('images/blank.gif')."' />";
					break;
				case 'images':return 'varchar';break;
				case 'number':
					$formtype="<input class='uiText' type='text' name='".$item->name."' value='0' />";
					break;
				case 'date':
					$formtype="<input class='uiText' type='text' value='".date("Y-m-d")."' name='".$item->name."' />";
					break;
				case 'datetime':
					$formtype="<input class='uiText' type='text' value='".date("Y-m-d H:i:s")."' name='".$item->name."' />";
					break;
				case 'type':
					$this->CI=&get_instance();
					$this->CI->load->model('admin/mtype');
					$arry=$this->CI->mtype->getListBycid($cid);
	                $this->CI->load->library('type');
	                $this->CI->type->listType($arry,'',0);
	                $res = $this->CI->type->_res;
	                $formtype="<select name='".$item->name."'>";
	                foreach($res as $titem)
	                {
	                	$formtype.="<option value='".$titem[0]."'>".$titem[1]."</option>";
	                }
	                $formtype.="</select>";
					break;
				case 'file':
					$formtype="<input type='file' name='".$item->name."' />";
					break;
				case 'author':
					$this->CI=&get_instance();
					$this->CI->load->library('session');
					$this->CI->load->model('admin/admin');
					$authorname = $this->CI->session->userdata('username');
					$authornickname = $this->CI->admin->getNickname($authorname);
					$formtype="<input class='uiText' style='width:200px;' value='".$authornickname."' type='text' name='".$item->name."' />";
					break;
				case 'hidden':
					$pre="<li class='hide'><b>".$mstr.$item->othername."</b>";
					$formtype="<input class='uiText' type='hidden' name='".$item->name."' />";
					break;
				default:break;
			}
			$this->_res[$this->_index]=$pre.$formtype.$next;
			$this->_index++;
		}
		$jsStr.="
				else{
					form.action=url;
					form.submit();
				}
				return false;});
				</script>		
		";
		$this->_jsStr=$jsStr;
		return $this->_res;
	}
	
	function praseUpdate($res,$row,$table,$cid)
	{
		$CI = &get_instance();
		$jsStr="<script type='text/javascript'>
					var form = $('#contentForm')[0];
					var url=$('#contentSumbitBtn').attr('href');
					$('#contentSumbitBtn').click(function(){
						
						if(false)
						{
						  	return false;
						}";
		foreach($res as $item)
		{
			$mstr=$item->ismust==0?"":"<em>*</em>";
			$pre="<b>".$mstr.$item->othername."</b>";
			$next="<label class='tip'>".$item->tip."</label>";
			$value=sizeof($row)==0?"":$row[$item->name];
			$formtype="";
			if($item->ismust==1)
			{
				$jsStr.="else if(!checkFormObj1(form.".$item->name.",'".$item->othername."不能为空!'))
						{
							form.".$item->name.".focus();	
							return false;
						}";	
			}
			if($item->length>0)
			{
				$jsStr.="else if(!checkFormObj2(form.".$item->name.",".$item->length.",'".$item->othername."不能超过".$item->length."个字符!'))
						{
							form.".$item->name.".focus();	
							return false;
						}";	
			}
			switch ($item->type)
			{
				case 'text':
					$formtype="<input class='uiText' style='width:200px;' type='text' value='".$value."' name='".$item->name."' />";
					break;
				case 'textarea':
					$formtype="<textarea cols='60' rows='5' name='".$item->name."'>".$value."</textarea>";
					break;
				case 'editor':
				$formtype="<textarea cols='90' rows='24' id='content' name='".$item->name."'>".$value."</textarea>
							<script type='text/javascript' src='".base_url('ckeditor/ckeditor.js')."'></script>
							<script type='text/javascript'>
							<!--
							CKEDITOR.replace( '".$item->name."', {
								filebrowserBrowseUrl:'".base_url('ckfinder/ckfinder.html')."',
								filebrowserImageBrowseUrl:'".base_url('ckfinder/ckfinder.html?Type=Images')."',
								filebrowserFlashBrowseUrl:'".base_url('ckfinder/ckfinder.html?Type=Flash')."',
								filebrowserUploadUrl:'".base_url('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')."',
								filebrowserImageUploadUrl:'".base_url('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')."',
								filebrowserFlashUploadUrl:'".base_url('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')."'
							});
							//-->
							</script>";
				$formtype.="<script type='text/javascript' src='".base_url('ckeditor/plugins/syntaxhighlighter/scripts/shCore.js')."></script>";
				$formtype.="<script type='text/javascript' src='".base_url('ckeditor/plugins/syntaxhighlighter/scripts/shBrushAll.js')."></script>";			
				$formtype.="
							<script type='text/javascript'>
							SyntaxHighlighter.defaults['toolbar'] = false;  // 不显示syntaxhighlighter工具栏
							SyntaxHighlighter.all();
							</script>";
				$formtype.="<link href='".base_url('ckeditor/plugins/syntaxhighlighter/styles/shCoreDefault.css')."' rel='stylesheet' type='text/css' />";			
				$formtype.="<i class='clear'></i>";
				break;
				case 'image':
					$formtype="<div style='float:left;'>";
					$formtype.="<script type='text/javascript' src='".base_url('js/ajaxfileupload.js')."'></script>";
					//$formtype.="<input id='upType' style='vertical-align:middle;' type='radio' name='upType' checked='checked' /><label>本地上传</label><input id='upType' style='vertical-align:middle;' type='radio' name='upType' /><label>网络图片</label><br /><br />";
					$formtype.="<input id='fileUpload' class='uiText' style='width:260px;' value='".$row[$item->name]."' type='text' name='".$item->name."' />";
					$formtype.="<input id='fileUploadFolder' type='hidden' value='".$table."' />";
					$formtype.="<input id='weburl' type='hidden' value='".site_url()."' />";
					$formtype.="<a class='uiUpload' href='javascript:;' title='选择本地文件'><span>选择本地文件</span><input id='fileToUpload' class='uiFileBtn' fileType='image' name='fileToUpload' type='file' /></a>";
					if($value=="")
					{
						$formtype.="<img id='fileUploadImg' style='padding-left:15px;' height='40' src='".base_url('images/blank.gif')."' />";
					}
					else
					{
						$formtype.="<img id='fileUploadImg' style='padding-left:15px;' height='40' src='".base_url($value)."' />";
					}
					$formtype.="</div>";
					$formtype.="<i class='clear'></i>";
					break;
				case 'images':return 'varchar';break;
				case 'number':
					$formtype="<input class='uiText' type='text' value='".$value."' name='".$item->name."' />";
					break;
				case 'date':
					$formtype="<input class='uiText' type='text' value='".date("Y-m-d",$value)."' name='".$item->name."' />";
					break;
				case 'datetime':
					$formtype="<input class='uiText' type='text' value='".date("Y-m-d H:i:s",$value)."' name='".$item->name."' />";
					break;
				case 'type':
					$this->CI=&get_instance();
					$this->CI->load->model('admin/mtype');
					$arry=$this->CI->mtype->getListBycid($cid);
	                $this->CI->load->library('type');
	                $this->CI->type->listType($arry,'',0);
	                $res = $this->CI->type->_res;
	                $formtype="<select name='".$item->name."'>";
	                foreach($res as $titem)
	                {
	                	if($titem[0]==$value)
	                	{
	                		$formtype.="<option selected='selected' value='".$titem[0]."'>".$titem[1]."</option>";
	                	}
	                	else
	                	{
	                		$formtype.="<option value='".$titem[0]."'>".$titem[1]."</option>";
	                	}
	                }
	                $formtype.="</select>";
					break;
				case 'file':
					$formtype="<input type='file' value='".$value."' name='".$item->name."' />";
					break;
				case 'author':
					$formtype="<input class='uiText' style='width:200px;' value='".$value."'  type='text' name='".$item->name."' />";
					break;
				case 'hidden':
					$formtype="<input class='uiText' type='hidden' value='".$value."' name='".$item->name."' />";
					break;
				default:break;
			}
			$this->_res[$this->_index]=$pre.$formtype.$next;
			$this->_index++;
		}
		$jsStr.="
				else{
					form.action=url;
					form.submit();
				}
				return false;});
				</script>		
		";
		$this->_jsStr=$jsStr;
		return $this->_res;
	}
	
	function praseType($type)//字段所对应表字段类型
	{
		switch ($type)
		{
			case 'text':return 'varchar';break;
			case 'textarea':return 'text';break;
			case 'editor':return 'text';break;
			case 'image':return 'varchar';break;
			case 'images':return 'text';break;
			case 'number':return 'int';break;
			case 'date':return 'int';break;
			case 'datetime':return 'int';break;
			case 'type':return 'int';break;
			case 'file':return 'varchar';break;
			case 'author':return 'varchar';break;
			case 'hidden':return 'varchar';break;
			default:break;
		}
	}
	
	function praseTypeDefaultLen($type)//字段所对应表字段类型
	{
		switch ($type)
		{
			case 'text':return 200;break;
			case 'textarea':return 0;break;
			case 'editor':return 0;break;
			case 'image':return 200;break;
			case 'images':return 0;break;
			case 'number':return 11;break;
			case 'date':return 20;break;
			case 'datetime':return 20;break;
			case 'type':return 11;break;
			case 'file':return 200;break;
			case 'author':return 50;break;
			case 'hidden':return 200;break;
			default:break;
		}
	}
	
	function praseContent($res,$fname,$ftype)
	{
		$searchstr="";
		for($i=0;$i<sizeof($fname);$i++)
		{
			if($fname[$i]['issearch']==1)
			{
				if($ftype[$i]['type']=="type")
				{
					
				}
				else 
				{
					$searchstr.=$fname[$i]['othername']."：<input type='text' name='".$fname[$i]['name']."' />";
				}
			}
		}
		
		foreach($res as $item)
		{
			$this->_res[$this->_index]=array();
			$this->_res[$this->_index]['id']=$item['id'];
			$this->_res[$this->_index]['content']="";
			$i=0;
			for($i;$i<sizeof($fname);$i++)
			{
				if($ftype[$i]['type']=="date")
				{
					$this->_res[$this->_index]['content'].="<td>".date("Y-m-d",$item[$fname[$i]['name']])."</td>";
				}
				else if($ftype[$i]['type']=="datetime")
				{
					$this->_res[$this->_index]['content'].="<td>".date("Y-m-d H:i:s",$item[$fname[$i]['name']])."</td>";
				}
				else if($ftype[$i]['type']=="type")
				{
					$this->CI=&get_instance();
					$this->CI->load->model('admin/mtype');
					if($item[$fname[$i]['name']]==0)
					{
						$this->_res[$this->_index]['content'].="<td>&nbsp;</td>";
					}
					else
					{
						$row = $this->CI->mtype->getById($item[$fname[$i]['name']]);
						$title = $row->title;
						$this->_res[$this->_index]['content'].="<td>".$title."</td>";
					}
				}
				else if($ftype[$i]['type']=="image")
				{
					$this->_res[$this->_index]['content'].="<td><a href='".base_url($item[$fname[$i]['name']])."' target='_blank'><img height='30' src='".base_url($item[$fname[$i]['name']])."'/></a></td>";
				}
				else
				{
					
					$this->_res[$this->_index]['content'].="<td>".$item[$fname[$i]['name']]."</td>";
				}
			}
			$this->_index++;
		}
		if($searchstr != "")
		{
			$searchstr.="<input class='searchbtn' type='submit' value='搜索' />";
		}
		$this->_searchStr = $searchstr;
		return $this->_res;
	}
}
?>