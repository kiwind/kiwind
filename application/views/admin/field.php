<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title></title>
<?php $this->load->view('admin/common')?>
</head>
<body style="background:none;">
<div class="contentMain contentColumn">
    <?php $this->load->view('admin/field_'.$action)?>
</div>
</html>
           
