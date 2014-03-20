-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 03 月 19 日 22:40
-- 服务器版本: 5.1.63
-- PHP 版本: 5.2.17p1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `kiwind`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT 'powerid',
  `name` varchar(20) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `logintime` int(10) NOT NULL,
  `loginip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `pid`, `name`, `pwd`, `logintime`, `loginip`) VALUES
(1, 6, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1395063524, '180.111.151.73');

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `thumb` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `good_count` int(11) NOT NULL,
  `comment_count` int(11) NOT NULL,
  `datetime` int(20) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `cid`, `title`, `thumb`, `content`, `good_count`, `comment_count`, `datetime`, `type`) VALUES
(1, 1, '关于swfobject嵌入flash ie浏览器刷新引发的无法获取stage属性问题', '', '<div>\n	问题表现：ie内核浏览器下首次加载无问题，刷新后便无法获取stage.stageWidth和stage.stageHeight.</div>\n<div>\n	swfObject官方给出的解决方案是:</div>\n<div>\n	stage.addEventListener(Event.RESIZE, onResize);</div>\n<div>\n	stage.dispatchEvent(new Event(Event.RESIZE));</div>\n<div>\n	private function onResize(event:Event):void</div>\n<div>\n	{</div>\n<div>\n	if (stage.stageWidth&amp;gt;0 &amp;amp;&amp;amp; stage.stageHeight&amp;gt;0){</div>\n<div>\n	stage.removeEventListener(Event.RESIZE,onResize);</div>\n<div>\n	init();//初始化入口</div>\n<div>\n	}</div>\n<div>\n	}</div>\n', 0, 0, 1392642090, 7),
(2, 1, 'transparent在firefox下的bug', '', '<p>\n	今天做个东西，需要设置wmode为transparent,但问题出现了，ie下鼠标滚轮事件正常，火狐下没反应，后来百度了下发现在火狐下设置transparent确实有这个问题，解决方法可以通过js做中间层，获取鼠标事件然后发消息给flash。不知道有没有其他方法没</p>\n', 0, 0, 1392641858, 7);

-- --------------------------------------------------------

--
-- 表的结构 `column`
--

CREATE TABLE IF NOT EXISTS `column` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `cid` int(6) NOT NULL COMMENT '栏目类别',
  `mid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `idx` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `column`
--

INSERT INTO `column` (`id`, `pid`, `cid`, `mid`, `title`, `idx`) VALUES
(1, 3, 2, 1, '文章', 2),
(2, 3, 2, 2, '友情链接', 3),
(3, 0, 0, 0, '博客', 1);

-- --------------------------------------------------------

--
-- 表的结构 `field`
--

CREATE TABLE IF NOT EXISTS `field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `othername` varchar(50) NOT NULL,
  `length` int(11) NOT NULL,
  `tip` varchar(250) NOT NULL,
  `defaultValue` varchar(50) NOT NULL,
  `ismust` tinyint(1) NOT NULL DEFAULT '1',
  `isshow` tinyint(1) NOT NULL DEFAULT '1',
  `issearch` tinyint(1) NOT NULL DEFAULT '0',
  `idx` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `field`
--

INSERT INTO `field` (`id`, `tid`, `mid`, `name`, `othername`, `length`, `tip`, `defaultValue`, `ismust`, `isshow`, `issearch`, `idx`) VALUES
(1, 1, 1, 'title', '文章标题', 100, '', '', 1, 1, 0, 1),
(2, 4, 1, 'thumb', '缩略图', 200, '', '', 0, 1, 0, 3),
(3, 3, 1, 'content', '文章内容', 0, '', '', 0, 0, 0, 4),
(4, 10, 1, 'good_count', '赞数', 11, '', '', 0, 1, 0, 5),
(5, 10, 1, 'comment_count', '评论数', 11, '', '', 0, 1, 0, 6),
(6, 7, 1, 'datetime', '发布日期', 20, '', '', 1, 1, 0, 7),
(7, 8, 1, 'type', '文章分类', 11, '', '', 1, 1, 0, 2),
(8, 1, 2, 'name', '名称', 20, '', '', 1, 1, 0, 1),
(9, 1, 2, 'title', 'title', 20, '', '', 1, 1, 0, 2),
(10, 1, 2, 'url', '地址', 200, '', '', 1, 1, 0, 3);

-- --------------------------------------------------------

--
-- 表的结构 `field_type`
--

CREATE TABLE IF NOT EXISTS `field_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `text` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `field_type`
--

INSERT INTO `field_type` (`id`, `title`, `text`) VALUES
(1, 'text', '单行文本'),
(2, 'textarea', '多行文本'),
(3, 'editor', '编辑器'),
(4, 'image', '图片'),
(5, 'images', '多图片'),
(10, 'number', '数字'),
(7, 'datetime', '日期和时间'),
(8, 'type', '类别'),
(9, 'file', '文件上传'),
(6, 'date', '日期'),
(11, 'hidden', '隐藏域'),
(12, 'thumb', '缩略图');

-- --------------------------------------------------------

--
-- 表的结构 `friendly_link`
--

CREATE TABLE IF NOT EXISTS `friendly_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `friendly_link`
--

INSERT INTO `friendly_link` (`id`, `cid`, `name`, `title`, `url`) VALUES
(1, 2, 'jeedoo', 'jeedoo', 'http://www.jeedoo.cn');

-- --------------------------------------------------------

--
-- 表的结构 `model`
--

CREATE TABLE IF NOT EXISTS `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET utf8 NOT NULL,
  `table` varchar(20) NOT NULL,
  `desc` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `model`
--

INSERT INTO `model` (`id`, `title`, `table`, `desc`) VALUES
(1, '文章', 'article', ''),
(2, '友情链接', 'friendly_link', '');

-- --------------------------------------------------------

--
-- 表的结构 `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `mid` int(11) NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(20) CHARACTER SET utf8 NOT NULL,
  `idx` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `type`
--

INSERT INTO `type` (`id`, `cid`, `mid`, `pid`, `title`, `idx`) VALUES
(1, 0, 0, 0, '栏目内容类别', 1),
(2, 0, 0, 1, '列表页', 2),
(3, 0, 0, 1, '单网页', 3),
(4, 1, 0, 0, '文章分类', 4),
(5, 1, 0, 4, '前端开发', 5),
(6, 1, 0, 4, 'Web 3D', 6),
(7, 1, 0, 4, 'Flash', 7);

-- --------------------------------------------------------

--
-- 表的结构 `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET utf8 NOT NULL,
  `idx` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `user_group`
--

INSERT INTO `user_group` (`id`, `title`, `idx`) VALUES
(1, '系统用户组', 1),
(2, '会员用户组', 2);

-- --------------------------------------------------------

--
-- 表的结构 `user_power`
--

CREATE TABLE IF NOT EXISTS `user_power` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET utf8 NOT NULL,
  `gid` int(11) NOT NULL,
  `idx` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user_power`
--

