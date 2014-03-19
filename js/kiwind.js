/**
 * (c) 2013-09-09 kiwind.js
 * based on jQuery
 * author:西风 site:kiwind.cn
 */
$K.index = {
    init: function() {
        this.showMenu();
        this.resize();
    },
    showMenu: function() {
        this.setPos();
        $(".menu").animate({
            opacity:1
        });
    },
    setPos: function() {
        var _menu = $(".menu"),
            _left = $(window).width() * 0.5 - $(".row").width() * 0.5,
            _top  = $(window).height() * 0.5 - $(".row").height() * 0.5;
        _menu.css({
            "top": _top,
            "left": _left
        });
    },
    resize:function(){
        var _this = this;
        $(window).resize(function(){
            _this.setPos();
        });
    }
}

$(function() {
    $K.index.init();
    webGLStart();
})