<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>风知网后台管理系统</title>
<?php $this->load->view('admin/common')?>
<script type="text/javascript">
function dyniframesize(down) { 
    var pTar = null; 
    if (document.getElementById){ 
        pTar = document.getElementById(down); 
    } 
    else{ 
        eval('pTar = ' + down + ';'); 
    } 
    if (pTar && !window.opera){ 
        //begin resizing iframe 
        pTar.style.display="block" 
        if (pTar.contentDocument && pTar.contentDocument.body.offsetHeight){ 
            //ns6 syntax 
            pTar.height = pTar.contentDocument.body.offsetHeight +20; 
           // pTar.width = pTar.contentDocument.body.scrollWidth+20; 
        } 
        else if (pTar.Document && pTar.Document.body.scrollHeight){ 
            //ie5+ syntax 
            pTar.height = pTar.Document.body.scrollHeight; 
            //pTar.width = pTar.Document.body.scrollWidth; 
        } 
    } 
} 
</script>
</head>
<body id="main" style="background:none;">
<div class="warp">
    <div class="header">
        <div class="logo"><img src="<?=base_url('images/logo.gif') ?>" /></div>
        <div class="white"><img src="<?=base_url('images/admin/header-white.png') ?>" /></div>
    </div>
    <div class="contentWarp">
        <div class="menu">
            <div class="title"><h2>MENU >></h2><em></em></div>
            <dl>
                <dt><a href="#" title="用户"><span>用户</span></a></dt>
                <dd><a target="mainfrm" href="<?=site_url('admin/user/changepwd/view') ?>" title="修改密码"><span>修改密码</span></a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="内容发布管理"><span>内容发布管理</span></a></dt>
                <dd class="last"><a target="mainfrm" href="<?=site_url('admin/content') ?>" title="内容管理"><span>内容管理</span></a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="内容相关设置"><span>内容相关设置</span></a></dt>
                <dd><a target="mainfrm" href="<?=site_url('admin/content/column/view') ?>" title="栏目管理"><span>栏目管理</span></a></dd>
                <dd><a target="mainfrm" href="<?=site_url('admin/content/model/view') ?>" title="模型管理"><span>模型管理</span></a></dd>
                <dd class="last"><a target="mainfrm" href="<?=site_url('admin/content/type/view') ?>" title="类别管理"><span>类别管理</span></a></dd>
            </dl>
        </div>
        <div class="content">
            <div class="title"><em></em><h2>HOME >></h2><div class="logout"><a href="<?=site_url('admin/index/logout')?>" title="退出">退出</a></div></div>
            <div id="bread" class="bread"><em></em><label></label></div>
            <div class="main">
                <iframe scrolling="no" width="100%" height="100%" frameborder="0" style="overflow:hidden;" id="mainfrm" name="mainfrm" onload="javascript:dyniframesize('mainfrm');" src="<?=base_url('admin/index/main') ?>"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="footer">欢迎您，
<?php 
    $CI=&get_instance();
    $CI->load->library('session');
    echo $CI->session->userdata("username");
?>
</div>
<!--[if IE 6]>
    <script type="text/javascript" src="<?php echo base_url('js/DD_belatedPNG.js')?>"></script>
    <script type="text/javascript">
    DD_belatedPNG.fix('.login,img');
    </script>
<![endif]-->

</body>
</html>
