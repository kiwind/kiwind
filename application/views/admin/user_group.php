<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title></title>
<?php $this->load->view('admin/common')?>
</head>
<body style="background:none;">
<div class="contentMain contentUser">
    <?php $this->load->view('admin/user_group_'.$action)?>
</div>
</html>
           
