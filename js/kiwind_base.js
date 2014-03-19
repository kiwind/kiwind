var $K = kiwind = {};
$K.fn = function(name,para){
  return new $K.fn[name](para);
};
$K.widget = $K.fn.prototype;
/**
 * [小小的选项卡]
 * @para opt: {object} 传入的对象参数
 * @para uid: {String} 总控制的id，为更好拓展而设，可选，默认为空
 * @para tabBtn: {String} 切换选项卡控制触发容器id，必须存在
 * @para tabBtnElem: {String} 选项卡控制触发器元素，默认为"li"
 * @para tabBtnClass: {String} 选项卡控制触发器当前样式，默认为"cur"
 * @para tabType: {String} 选项卡控制触发器触发事件，默认为"click"
 * @para tabBox: {String} 选项卡内容总控制id，初始为空，建议选项卡所有内容用id包裹
 * @para tabBoxClass: {String} 选项卡每块内容class，默认为".tabBox"
 * @para callback: {Fucntion} 选项卡触发容器元素，即tabBtnElem触发效果回调函数
 * @para ajaxData: {Array} ajax方法参数数组，如有ajax数据抓取，必须存在
 * @para ajaxType: {String} ajax获取数据方法，默认为GET
 * @para ajaxDataType: {String} ajax获取数据的格式，默认为html
 * @para delay: {Boolean} 是否延迟触发，默认false
 * @para delaytTime: {Number} 默认200
 */
$K.widget.tab = function(opt) {
    this.opt          = opt || {};
    this.uid          = this.opt.uid || "";
    this.tabBtn       = this.opt.tabBtn || "#tab";
    this.tabBtnElem   = this.opt.tabBtnElem || "li";
    this.tabBtnClass  = this.opt.tabBtnClass || "cur";
    this.tabType      = this.opt.tabType || "click";
    this.tabBox       = this.opt.tabBox || "";
    this.tabBoxClass  = this.opt.tabBoxClass || ".tabBox";
    this.tabMore      = this.opt.tabMore || ".tab-more";
    this.callback     = this.opt.callback || function() {};
    this.ajaxData     = this.opt.ajaxData || [];
    this.ajaxType     = this.opt.ajaxType || "GET";
    this.ajaxDataType = this.opt.ajaxDataType || "html";
    this.delay        = this.opt.delay || false;
    this.delayTime    = this.opt.delayTime || 200;
    this.eq           = this.opt.eq || 0;
    this.loadingText  = this.opt.loadingText || "";
    this.init();
};

$K.widget.tab.prototype = {
    init: function() {
        this.startFn();
    },
    ajax: function(i) {
        var self = this;
        var ajax_self = this.ajaxPara;
        if (self.ajaxData.length === 0) {
            return;
        }
        var tabBox = $(self.tabBox) || $(self.uid);
        var selectedTab = tabBox.find(self.tabBoxClass).eq(i);
        var ajax_data_cur = self.ajaxData[i - 1];
        if (self.ajaxData.length > 0 && !selectedTab.hasClass("done") && i > 0) {
            $.ajax({
                url: ajax_data_cur.ajaxUrl + "?" + new Date().getTime(),
                type: self.ajaxType,
                data: ajax_data_cur.data,
                dataType: self.ajaxDataType,
                beforeSend: function() {
                    selectedTab.html(self.loadingText).addClass("data-loading");
                },
                success: function(responseText) {
                    if(self.ajaxDataType != "html"){
                        if ( typeof ajax_data_cur.parseFn == "function" ) {
                            ajax_data_cur.parseFn(responseText,selectedTab);
                        }
                    }else{
                        selectedTab.html(responseText);
                    }
                },
                error: function() {
                    alert("网络连接失败，请检测您的网络环境稍后重试");
                },
                complete: function() {
                    selectedTab.addClass("done").removeClass("data-loading"); //.removeClass("loading")
                    if (typeof ajax_data_cur.callback == "function") {
                        ajax_data_cur.callback(selectedTab);
                    }
                }
            });
        }
    },
    startFn: function() {
        this.bind();
        this.eqFn();
    },
    bind: function() {
        if (this.delay) {
            this.delayFn();
            return;
        }
        var self = this;
        var tabBtn = $(self.tabBtn);
        var tabBox = $(self.tabBox) || $(self.uid);
        tabBtn.find(self.tabBtnElem).bind(self.tabType, function(e) {
            var $this = $(this);
            //var e = e.originalEvent;
            function isMouseLeaveOrEnter(_e, handler) {
                if (e.type != 'mouseout' && e.type != 'mouseover') return false;
                var reltg = e.relatedTarget ? e.relatedTarget : e.type == 'mouseout' ? e.toElement : e.fromElement;
                while (reltg && reltg != handler)
                reltg = reltg.parentNode;
                return (reltg != handler);
            }
            if (isMouseLeaveOrEnter(e, this)) {
                self.tabFn(self, $this, tabBox);
            }else{
                self.tabFn(self, $(this), tabBox);
            }
            return false;
        });
    },
    delayFn: function() {
        var self = this;
        var tabBtn = $(self.tabBtn);
        var tabBox = $(self.tabBox) || $(self.uid);
        tabBtn.find(self.tabBtnElem).bind(self.tabType, function() {
            var $this = $(this);
            self.timer = setTimeout(function() {
                self.tabFn(self, $this, tabBox);
            }, self.delayTime);
        });
        tabBtn.find(self.tabBtnElem).mouseout(function() {
            clearTimeout(self.timer);
        });
    },
    tabFn: function(self, $this, _tabBox) {
        var index = $(self.tabBtn).find(self.tabBtnElem).index($this);
        var _tabBox_cur = _tabBox.find(self.tabBoxClass).eq(index);
        $this.addClass(self.tabBtnClass).siblings().removeClass(self.tabBtnClass);
        self.tabMore && $(self.tabBtn).find(self.tabMore).eq(index).show().siblings().hide();
        _tabBox_cur.show().siblings(self.tabBoxClass).hide();
        self.asyncLoad(_tabBox_cur);
        if (self.callback && Object.prototype.toString.call(self.callback) == "[object Function]") {
            self.callback(index, $this);
        }
        self.ajax(index);
    },
    eqFn: function() {
        if (this.eq === 0) {
            return;
        }
        if (this.eq !== 0) {
            var tabBtn = $(this.tabBtn);
            tabBtn.find(this.tabBtnElem).eq(this.eq).trigger(this.tabType);
        }
    },
    asyncLoad: function(_this){
        var _img = _this.find("img");
        _img.each(function(){
            $(this).addClass("blankbg");
            if($(this).attr("src3")){
                $(this).attr("src",$(this).attr("src3")).removeAttr("src3");
            }
        });
    }
};
