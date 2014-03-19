var checkFormObj1 = function(field,alerttxt){
	if (field.value==null||field.value=="")
    {
		alert(alerttxt);
		return false;
	}
  	else{
		return true;
	}
}

var checkFormObj2 = function(field,len,alerttxt){
	if (field.value.length>len)
    {
		alert(alerttxt);
		return false;
	}
  	else {
		return true;
	}
}
;var yywind = yywind||{};
yywind.namespace=function(str){
	var arr = str.split("."),o=yywind;
	for (i=(arr[0]=="yywind")?1:0; i<arr.length; i++) {
		o[arr[i]]=o[arr[i]]||{};
		o=o[arr[i]];
	};
}
yywind.namespace("dom");
yywind.dom.addclass=function(){
	$(".contentList tr:even").addClass("alt-row");
	$(".menu dd").bind('click',function(){
		$(this).parent().siblings().find("dd").removeClass("on");
		var $b = $(".bread").find("label");
		$b.empty();
		$(this).addClass("on").siblings().removeClass("on");
		var bread1="<span>"+$(this).parent().find("dt a").attr("title")+"</span>";
		var bread2="<span>"+$(this).find("a").attr("title")+"</span>";
		var bread=bread1+">"+bread2;
		$b.append(bread);
	});
};
yywind.dom.toggleMenuClass=function(o){
	o.toggle(function(){
		$(this).parent().addClass("on");
	},function(){
		$(this).parent().removeClass("on");
	});

}
yywind.dom.postForm=function(id,formClass){
	var o=$(id);
	var url=o.attr("href");
    var form=$(formClass)[0];
    var fid=$(form).attr("id");
	o.click(function(e){
		//var data=form.serializeArray();
		if(fid=="typeForm")
		{
			if(!checkFormObj1(form.title,"分类名称不能为空!"))
			{
				form.title.focus();	
				return false;
			}	
			else if(!checkFormObj2(form.title,20,"分类名称不能超过20个字符!"))
			{
				form.title.focus();	
				return false;
			}	
			else
			{
				form.action=url;
				form.submit();
			}
		}
		else if(fid=="columnForm")
		{
			if(!checkFormObj1(form.title,"栏目名称不能为空!"))
			{
				form.title.focus();	
				return false;
			}	
			else if(!checkFormObj2(form.title,20,"栏目名称不能超过20个字符!"))
			{
				form.title.focus();	
				return false;
			}	
			else
			{
				form.action=url;
				form.submit();
			}
		}
		else if(fid=="modelForm")
		{
			if(!checkFormObj1(form.title,"模型名称不能为空!"))
			{
				form.title.focus();	
				return false;
			}	
			else if(!checkFormObj2(form.title,20,"模型名称不能超过20个字符!"))
			{
				form.title.focus();	
				return false;
			}	
			else if(!checkFormObj1(form.table,"数据表不能为空!"))
			{
				form.table.focus();	
				return false;
			}	
			else if(!checkFormObj2(form.table,20,"数据表不能超过20个字符!"))
			{
				form.table.focus();	
				return false;
			}
			else if(!checkFormObj2(form.desc,100,"描述不能超过100个字符!"))
			{
				form.desc.focus();	
				return false;
			}
			else
			{
				form.action=url;
				form.submit();
			}
		}
		else if(fid=="fieldForm")
		{
			if(!checkFormObj1(form.name,"字段名不能为空!"))
			{
				form.name.focus();	
				return false;
			}	
			else if(!checkFormObj2(form.name,20,"字段名不能超过20个字符!"))
			{
				form.name.focus();	
				return false;
			}	
			else if(!checkFormObj1(form.othername,"字段别名不能为空!"))
			{
				form.othername.focus();	
				return false;
			}	
			else if(!checkFormObj2(form.othername,20,"字段别名不能超过20个字符!"))
			{
				form.othername.focus();	
				return false;
			}
			else if(!checkFormObj2(form.tip,100,"提示不能超过100个字符!"))
			{
				form.tip.focus();	
				return false;
			}
			else
			{
				form.action=url;
				form.submit();
			}
		}
		else
		{
			form.action=url;
			form.submit();
		}	
		return false;
	});
	
};
yywind.dom.checkedAll=function(){
	$(".check-all").click(function(){
		$(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));
	});
};
yywind.dom.deleteAction=function(o){
	$(o).click(function(){
		var url = $(this).attr("href");
		var id ="";
		$("tbody input:checked").each(function(){
			id+=$(this).val()+"l";	
		});
		var a = id.split("l");
		var l = a.length -1;
		if(l<1)
		{
			alert('请勾选你所要删除的项！');	
		}
		else
		{
			var r=confirm("确定要删除所选项吗？");
			if (r==true)
			{
				id = id.substr(0,id.length-1);
				url = url+"/"+id;
				window.location = url;
			}
		}
		return false;
	});
};
yywind.dom.sortAction=function(o){
	$(o).click(function(){
		var url = $(this).attr("href");
		var id ="";
		$("#listTable").find("tr").each(function(){
			var _id = $(this).find("td.ck").find("input").val();
			var _idx = $(this).find("input.uiText").val();
			id+=_idx+"_"+_id+"l";
		});
		id = id.substr(0,id.length-1);
		url = url+"/"+id;
		window.location = url;
		return false;
	});
};
yywind.dom.selectTimeType = function(){
	var $f = $("#fieldForm");
	var $t = $f.find("select");
	$t.change(function(){
		var $inputName = $f.find("input[name=name]");
		if($t.val()==6)
		{
			$inputName.val("date").attr("readonly","readonly");
		}
		else if($t.val()==7)
		{
			$inputName.val("datetime").attr("readonly","readonly");
		}
		else
		{
			if($inputName.val()=="date"||$inputName.val()=="datetime")
			{
				$inputName.val("").removeAttr("readonly");
			}
		}
	});
};
yywind.dom.selectFile = function(){
	$("#fileToUpload").live("change",function(){
		var url = $("#weburl").val();
		var folder = $("#fileUploadFolder").val();
		var data = {folder:folder};
		$("#fileUploadImg").attr("src",url+"images/loading.gif");
		$.ajaxFileUpload
		(
			{
				type:'POST',
				url:url+"admin/upload/doUpload",
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				data:data,
				success: function (msg)
				{
					if(msg.no==0)
					{
						alert(msg.msg);
					}
					else
					{
						$("#fileUpload").val(msg.msg);
						$("#fileUploadImg").attr("src",url+msg.msg).css({"height":40});
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
	});
};

$(function(){
	yywind.dom.addclass();
	yywind.dom.toggleMenuClass($(".menu dl dt"));
	yywind.dom.postForm("#submitBtn",".postForm");
	yywind.dom.checkedAll();
	yywind.dom.deleteAction("#deleteLotBtn");
	yywind.dom.sortAction("#sortBtn");
	yywind.dom.selectTimeType();
	yywind.dom.selectFile();
})