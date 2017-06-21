/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50634
Source Host           : localhost:3306
Source Database       : dangjian

Target Server Type    : MYSQL
Target Server Version : 50634
File Encoding         : 65001

Date: 2017-06-22 02:39:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `dj_article`
-- ----------------------------
DROP TABLE IF EXISTS `dj_article`;
CREATE TABLE `dj_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `intro` varchar(500) DEFAULT NULL,
  `column_id` int(11) NOT NULL DEFAULT '0',
  `cover` varchar(300) DEFAULT NULL,
  `good_count` int(11) NOT NULL DEFAULT '0',
  `question_id` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_article
-- ----------------------------
INSERT INTO `dj_article` VALUES ('3', '0', '阿萨德萨达斯达', '我是傻子用', '3', '/banner/2017-06-22/594aba653a363.jpg', '0', '0', null, null);
INSERT INTO `dj_article` VALUES ('5', '0', '阿萨德萨达斯达1', '', '3', '/banner/2017-06-22/594aba7dd883d.jpg', '0', '0', null, '1497803483');

-- ----------------------------
-- Table structure for `dj_article_column`
-- ----------------------------
DROP TABLE IF EXISTS `dj_article_column`;
CREATE TABLE `dj_article_column` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1为文章，2为问题',
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_article_column
-- ----------------------------
INSERT INTO `dj_article_column` VALUES ('3', '阿德萨德萨德', '1', '0');

-- ----------------------------
-- Table structure for `dj_article_comment`
-- ----------------------------
DROP TABLE IF EXISTS `dj_article_comment`;
CREATE TABLE `dj_article_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL DEFAULT '0',
  `content` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `is_top` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_article_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `dj_article_content`
-- ----------------------------
DROP TABLE IF EXISTS `dj_article_content`;
CREATE TABLE `dj_article_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_article_content
-- ----------------------------
INSERT INTO `dj_article_content` VALUES ('2', '2', 'asdsadasdad');

-- ----------------------------
-- Table structure for `dj_article_praise`
-- ----------------------------
DROP TABLE IF EXISTS `dj_article_praise`;
CREATE TABLE `dj_article_praise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_article_praise
-- ----------------------------

-- ----------------------------
-- Table structure for `dj_auth_admin`
-- ----------------------------
DROP TABLE IF EXISTS `dj_auth_admin`;
CREATE TABLE `dj_auth_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `lastip` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_auth_admin
-- ----------------------------
INSERT INTO `dj_auth_admin` VALUES ('2', 'bintao', 'eabfcc06dd69dec5a232336854b4f7965a1c6798', 'fb7f6rOOT14bamJ5I0vyaOkQZZaO0K6DRrlAxIe9GXo=', '1603346915@qq.com', '15084969151', '', '1497374930', '1497892633');
INSERT INTO `dj_auth_admin` VALUES ('3', 'maoji', 'a87fc48360729d980efe99bf6db9c5f13360ac2d', 'OTFQUoiEOVZi9Gq/eiOAT265KiuKmJ9QQDuZYP9hHMU=', 'haah', '231321321313', '', '1497375167', '1497892799');
INSERT INTO `dj_auth_admin` VALUES ('4', 'tanyong', '3e4f45dd0cd7fa296c02841e9bf3c578f461614b', '9oFaYhLlh+vCXhPYQLIDWSW8dti4fWxbS1RjJsaPPlg=', '', '', '', '1497450394', '0');

-- ----------------------------
-- Table structure for `dj_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `dj_auth_group`;
CREATE TABLE `dj_auth_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text COMMENT '规则id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户组表';

-- ----------------------------
-- Records of dj_auth_group
-- ----------------------------
INSERT INTO `dj_auth_group` VALUES ('1', '超级管理员', '1', '6,96,20,1,2,3,4,5,64,21,7,8,9,10,11,12,13,14,15,16,123,124,125,19,104,105,106,107,108,118,109,110,111,112,117');
INSERT INTO `dj_auth_group` VALUES ('2', '产品管理员', '1', '6,96,1,2,3,4,56,57,60,61,63,71,72,65,67,74,75,66,68,69,70,73,77,78,82,83,88,89,90,99,91,92,97,98,104,105,106,107,108,118,109,110,111,112,117,113,114');
INSERT INTO `dj_auth_group` VALUES ('4', '文章管理员', '1', '6,96,57,60,61,63,71,72,65,67,74,75,66,68,69,73,79,80,78,82,83,88,89,90,99,100,97,98,104,105,106,107,108,118,109,110,111,112,117,113,114');

-- ----------------------------
-- Table structure for `dj_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `dj_auth_group_access`;
CREATE TABLE `dj_auth_group_access` (
  `uid` int(11) unsigned NOT NULL COMMENT '用户id',
  `group_id` int(11) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

-- ----------------------------
-- Records of dj_auth_group_access
-- ----------------------------
INSERT INTO `dj_auth_group_access` VALUES ('2', '1');
INSERT INTO `dj_auth_group_access` VALUES ('3', '1');

-- ----------------------------
-- Table structure for `dj_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `dj_auth_rule`;
CREATE TABLE `dj_auth_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of dj_auth_rule
-- ----------------------------
INSERT INTO `dj_auth_rule` VALUES ('1', '20', 'Admin/ShowNav/nav', '菜单管理', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('2', '1', 'Admin/Nav/index', '菜单列表', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('3', '1', 'Admin/Nav/add', '添加菜单', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('4', '1', 'Admin/Nav/edit', '修改菜单', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('5', '1', 'Admin/Nav/delete', '删除菜单', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('21', '0', 'Admin/ShowNav/rule', '权限控制', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('7', '21', 'Admin/Rule/index', '权限管理', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('8', '7', 'Admin/Rule/add', '添加权限', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('9', '7', 'Admin/Rule/edit', '修改权限', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('10', '7', 'Admin/Rule/delete', '删除权限', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('11', '21', 'Admin/Rule/group', '用户组管理', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('12', '11', 'Admin/Rule/add_group', '添加用户组', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('13', '11', 'Admin/Rule/edit_group', '修改用户组', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('14', '11', 'Admin/Rule/delete_group', '删除用户组', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('15', '11', 'Admin/Rule/rule_group', '分配权限', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('16', '11', 'Admin/Rule/check_user', '添加成员', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('19', '21', 'Admin/Rule/admin_user_list', '管理员列表', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('20', '0', 'Admin/ShowNav/config', '系统设置', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('6', '0', 'Admin/Index/index', '后台首页', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('64', '1', 'Admin/Nav/order', '菜单排序', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('96', '6', '/Admin/Index/welcome', '欢迎界面', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('104', '0', 'Admin/ShowNav/posts', '文章管理', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('105', '104', 'Admin/Posts/index', '文章列表', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('106', '105', 'Admin/Posts/add_posts', '添加文章', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('107', '105', 'Admin/Posts/edit_posts', '修改文章', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('108', '105', 'Admin/Posts/delete_posts', '删除文章', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('109', '104', 'Admin/Posts/category_list', '分类列表', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('110', '109', 'Admin/Posts/add_category', '添加分类', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('111', '109', 'Admin/Posts/edit_category', '修改分类', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('112', '109', 'Admin/Posts/delete_category', '删除分类', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('117', '109', 'Admin/Posts/order_category', '分类排序', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('118', '105', 'Admin/Posts/order_posts', '文章排序', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('123', '11', 'Admin/Rule/add_user_to_group', '设置为管理员', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('124', '11', 'Admin/Rule/add_admin', '添加管理员', '1', '1', '');
INSERT INTO `dj_auth_rule` VALUES ('125', '11', 'Admin/Rule/edit_admin', '修改管理员', '1', '1', '');

-- ----------------------------
-- Table structure for `dj_banner`
-- ----------------------------
DROP TABLE IF EXISTS `dj_banner`;
CREATE TABLE `dj_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imgurl` varchar(255) DEFAULT NULL,
  `linkurl` varchar(255) DEFAULT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_banner
-- ----------------------------
INSERT INTO `dj_banner` VALUES ('3', '/banner/2017-06-22/594aba653a363.jpg', 'http://www.baidu.com', '0');
INSERT INTO `dj_banner` VALUES ('4', '/banner/2017-06-22/594aba70c48e8.jpg', 'http://www.baidu.com', '0');
INSERT INTO `dj_banner` VALUES ('5', '/banner/2017-06-22/594aba7dd883d.jpg', 'http://www.baidu.com', '0');

-- ----------------------------
-- Table structure for `dj_paper_question_map`
-- ----------------------------
DROP TABLE IF EXISTS `dj_paper_question_map`;
CREATE TABLE `dj_paper_question_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) NOT NULL DEFAULT '0',
  `question_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_paper_question_map
-- ----------------------------

-- ----------------------------
-- Table structure for `dj_question`
-- ----------------------------
DROP TABLE IF EXISTS `dj_question`;
CREATE TABLE `dj_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL DEFAULT '0',
  `content` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1单选，2多选',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_question
-- ----------------------------

-- ----------------------------
-- Table structure for `dj_question_option`
-- ----------------------------
DROP TABLE IF EXISTS `dj_question_option`;
CREATE TABLE `dj_question_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL DEFAULT '0',
  `letter` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `sort` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_question_option
-- ----------------------------

-- ----------------------------
-- Table structure for `dj_question_paper`
-- ----------------------------
DROP TABLE IF EXISTS `dj_question_paper`;
CREATE TABLE `dj_question_paper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `info` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_question_paper
-- ----------------------------

-- ----------------------------
-- Table structure for `dj_question_result`
-- ----------------------------
DROP TABLE IF EXISTS `dj_question_result`;
CREATE TABLE `dj_question_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `question_id` int(11) NOT NULL DEFAULT '0',
  `option_id` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_question_result
-- ----------------------------

-- ----------------------------
-- Table structure for `dj_user`
-- ----------------------------
DROP TABLE IF EXISTS `dj_user`;
CREATE TABLE `dj_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcard` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) DEFAULT NULL,
  `uuid` varchar(255) NOT NULL DEFAULT '',
  `check_id` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为关注用户，1已审核用户，2审核中用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_user
-- ----------------------------
INSERT INTO `dj_user` VALUES ('1', '1', '', '', 'asdsadsa', null, 'adsadsdadadad', '0', null, '1');

-- ----------------------------
-- Table structure for `dj_wx_config`
-- ----------------------------
DROP TABLE IF EXISTS `dj_wx_config`;
CREATE TABLE `dj_wx_config` (
  `id` int(11) NOT NULL,
  `token` varchar(600) DEFAULT NULL,
  `expires_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dj_wx_config
-- ----------------------------
INSERT INTO `dj_wx_config` VALUES ('1', 'NgnMnQuGwZNFRrELPY7uNC5SOChy9OOA9mqXNohzPIqkJKHSMnBPGo6W0Pg0PzJSgOVwwzq16OvrXW_L7nuH49GAluKukJFPIGpBl4bIoNCHGxPzkbqo3LFgcLxD42VVOFJdAGAULP', null);
