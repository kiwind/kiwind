<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>风知网后台管理系统</title>
<link type="text/css" rel="stylesheet" href="<?=base_url('css/admin/style.css') ?>" />
<script type="text/javascript" src="<?=base_url('js/jquery.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('js/admin.js') ?>"></script>
</head>
<body>
<div class="menu">
   <div class="title"><h2>MENU >></h2><em></em></div>
   <dl>
       <dt><a href="#" title="站点设置">站点设置</a></dt>
       <dd class="on"><a href="<?=site_url('admin/setting') ?>" title="功能管理">功能管理</a></dd>
       <dd><a href="#" title="项目管理">项目管理</a></dd>
       <dd id="last"><a href="#" title="文件顺序">文件顺序</a></dd>
   </dl>
   <dl>
       <dt><a href="#" title="用户">用户</a></dt>
       <dd><a href="<?=site_url('admin/user/group/view') ?>" title="用户组">用户组</a></dd>
       <dd id="last"><a href="<?=site_url('admin/user/manage') ?>" title="用户管理">用户管理</a></dd>
   </dl>
</div>
</body>
</html>