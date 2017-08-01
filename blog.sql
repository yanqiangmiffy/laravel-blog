/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-08-01 15:45:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_category
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `cate_title` varchar(255) DEFAULT NULL COMMENT '分类标题',
  `cate_keywords` varchar(255) DEFAULT NULL COMMENT '关键字描述',
  `cate_description` varchar(255) DEFAULT NULL COMMENT '分类描述',
  `cate_view` int(10) DEFAULT '0' COMMENT '查看次数',
  `cate_order` tinyint(4) DEFAULT '0',
  `cate_pid` int(11) DEFAULT '0' COMMENT '父级id',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='文章分类';

-- ----------------------------
-- Records of blog_category
-- ----------------------------
INSERT INTO `blog_category` VALUES ('1', '新闻', '搜集国内外体育新闻', null, null, '0', '1', '0');
INSERT INTO `blog_category` VALUES ('2', '体育', '发展体育事业，增强国民体质', '体育', '发展体育事业，增强国民体质', '0', '2', '0');
INSERT INTO `blog_category` VALUES ('3', '娱乐', '人人都有自己的娱乐圈', null, null, '0', '3', '0');
INSERT INTO `blog_category` VALUES ('4', '今日头条', '你关心的,才是头条! - ', null, null, '0', '2', '1');
INSERT INTO `blog_category` VALUES ('5', '军事新闻', '最新军事新闻_中国军事新闻_国际军事新闻军情网站', null, null, '0', '1', '1');
INSERT INTO `blog_category` VALUES ('6', '虎扑篮球', 'NBA|虎扑篮球 - 最篮球的世界', null, null, '0', '2', '2');
INSERT INTO `blog_category` VALUES ('7', 'pptv体育', '.赛事视频24小时在线直播-聚力视频 ', null, null, '0', '1', '2');
INSERT INTO `blog_category` VALUES ('8', '娱乐之荒野食神', '连载 最新章节官网第一时间更新 起点中文网', null, null, '0', '1', '3');
INSERT INTO `blog_category` VALUES ('9', '小刀娱乐网', '免费资源分享平台,干货共分享-好东西不私藏!', null, null, '0', '2', '3');
INSERT INTO `blog_category` VALUES ('10', '游戏', '欢迎来到游戏联盟', '英雄联盟、CF、炉石传说', '娱乐开心', '0', '4', '0');
INSERT INTO `blog_category` VALUES ('12', '英雄联盟', '摧毁敌方高地', 'LOL', '', '0', '2', '10');

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员用户表';

-- ----------------------------
-- Records of blog_user
-- ----------------------------
INSERT INTO `blog_user` VALUES ('1', 'admin', 'eyJpdiI6InFKS3FcL0RNK1RDMFN6cnJDYUZWb3RnPT0iLCJ2YWx1ZSI6IjJxVktLdE9MaytPM28xc2xRXC96VXNBPT0iLCJtYWMiOiI4OWQ2MjVmYjAyZTgwYWFmMGVkMjBkNjEyMWMyMGI3MmE3Y2U5ODZjZjhjMDcwYjQwZmViMzZiZDRlNTA0MjkyIn0=');
