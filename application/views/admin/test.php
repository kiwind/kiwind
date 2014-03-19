<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title></title>
<?php $this->load->view('admin/common')?>
</head>
<body style="background:none;">
<div class="contentMain contentColumn">
	<ul>
		<li><span>内容</span><textarea cols="40" rows="10" id="content" name="content">cftea</textarea></li>
	</ul>
	
<script type="text/javascript" src="<?=base_url('ckeditor/ckeditor.js')?>"></script>
<script type="text/javascript">
<!--
CKEDITOR.replace("content");
//-->
</script> 
</div>
</html>
           
