var checkForm = function(form){
	if(!checkFormObj(form.name,"用户名不能为空!"))
	{
		form.username.focus();	
		return false;
	}	
	else if(!checkFormObj(form.pwd,"密码不能为空!"))
	{
		form.pwd.focus();	
		return false;
	}
	else if(!checkFormObj(form.captcha,"验证码不能为空!"))
	{
		form.captcha.focus();	
		return false;
	}
	else
	{
		form.submit();
	}
	return false;
};

var checkFormObj = function(field,alerttxt){
	if (field.value==null||field.value=="")
    {alert(alerttxt);return false}
  	else {return true}
}

var getCaptcha = function(url){
	$.get(url, function(data){
        $('.captcha').html(data);
    });
};

$(function(){
	//登录-输入框
	$(".loginForm input").focus(function(){
		$(this).css({"border-color":"#ce0808"});
	});
	$(".loginForm input").blur(function(){
		$(this).css({"border-color":"#d0d0d0"});
	});
})