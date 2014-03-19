/**
 * (c) 2013-11-19 blog.js
 * based on jQuery
 * author:西风 site:kiwind.cn
 */
var $kb = kiwind_blog = (function($){
	var navFloat = function(){
		var _nav = $("#nav"),
			_cur = _nav.find(".cur"),
			_bar = _nav.find(".nav-buoy"),
			_item = _nav.find("a");

		_bar.css("top",_cur.offset().top -  _nav.offset().top);
		_item.hover(function(){
			var _ntop = _nav.offset().top
			var _t = $(this).offset().top - _ntop - 1;
			_bar.stop().animate({top:_t},100);
		},function(){
			var _ntop = _nav.offset().top
			_bar.stop().animate({top:_cur.offset().top - _ntop},200);
		});
	};

    var gotop = function(){
        var _gobtn = $("#goTop");
        $(window).scroll(function(){
		  	var topHide = $(document).scrollTop(); 
		  	if(topHide>20){
		  		_gobtn.show();
		  	}else{
		  		_gobtn.hide();
		  	}
		});
		_gobtn.bind("click",function(){
			$("html,body").animate({scrollTop:"0"});
		});
    };

    var doAction = function(){
    	var _p = $(".action"),
    		_goodBtns = _p.find(".good");

    	_goodBtns.bind("click",function(){
    		var $this = $(this);
    		var postid = $(this).parent().parent().parent().attr("data-id");
    		var count = parseInt($(this).text())+1;
    		var data = {id:postid,count:count};
    	
    		$.ajax({
				type:'POST',
				data:data,
				dataType:'text',
				url:'http://localhost/work/webapp/kiwind/trunk/blog/addGood',
				error:function (XMLHttpRequest, textStatus, errorThrown) {
					alert("error");
				},
				success:function(msg){
					$this.text(msg);
				}
			})
    	});
    }

    return {
        init:function(){
            gotop();
            navFloat();
            doAction();
        }
    }
})(jQuery);

$(function() {
    $kb.init();
})