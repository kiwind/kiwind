<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录-风知网后台管理系统</title>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('css/admin/style.css') ?>" />
<script language="javascript" src="<?php echo base_url('js/jquery.js') ?>"></script>
<script language="javascript" src="<?php echo base_url('js/login.js') ?>"></script>
</head>

<body>
<div class="warp">
	<div id="login" class="login">
    	<div class="loginForm">
            <form action="<?php echo site_url('admin/login/validate') ?>"  method="post">
                <ul>
                    <li><span>用户名</span><input type="text" name="name" /></li>
                    <li><span>密&nbsp;&nbsp;码</span><input type="password" name="pwd" /></li>
                    <li><span>验证码</span><input class="verify" type="text" name="captcha" value="" /><div class="captcha"><?php echo $cap  ?></div><a href="javascript:void(0)" onclick="getCaptcha('<?php echo site_url('admin/captcha') ?>')" >看不清？</a></li>
                    <li><span>&nbsp;</span><input class="submit" type="submit" /></li>
                </ul>
            </form>
        </div>
    </div>
</div>
<!--[if IE 6]>
	<script type="text/javascript" src="<?php echo base_url('js/DD_belatedPNG.js') ?>"></script>
	<script type="text/javascript">
	DD_belatedPNG.fix('.login');
	</script>
<![endif]-->

</body>
</html>
