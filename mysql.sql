/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : sign

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-08-18 10:34:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `about` varchar(255) NOT NULL COMMENT '联系我们',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='配置表';

-- ----------------------------
-- Records of config
-- ----------------------------

-- ----------------------------
-- Table structure for feedback
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `content` varchar(2048) NOT NULL DEFAULT '' COMMENT '内容',
  `phone` varchar(11) NOT NULL DEFAULT '' COMMENT '联系电话',
  `user_id` bigint(11) NOT NULL COMMENT '用户id',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='意见反馈表';

-- ----------------------------
-- Records of feedback
-- ----------------------------

-- ----------------------------
-- Table structure for meeting
-- ----------------------------
DROP TABLE IF EXISTS `meeting`;
CREATE TABLE `meeting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `title` varchar(32) NOT NULL COMMENT '会议标题',
  `recording_url` varchar(255) NOT NULL DEFAULT '' COMMENT '录音地址',
  `note` varchar(255) NOT NULL COMMENT '笔记',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会议';

-- ----------------------------
-- Records of meeting
-- ----------------------------

-- ----------------------------
-- Table structure for sign
-- ----------------------------
DROP TABLE IF EXISTS `sign`;
CREATE TABLE `sign` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '活动标题',
  `content` text COMMENT '活动内容',
  `user_id` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `meeting_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会议id',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1签到2签退3补签到4补签退',
  `is_push` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否发布0否1发布',
  `number_people` int(10) NOT NULL DEFAULT '0' COMMENT '参会人数0为无限制',
  `file` varchar(255) NOT NULL DEFAULT '' COMMENT '活动文件',
  `start_time` datetime NOT NULL COMMENT '签到开始时间',
  `end_time` datetime NOT NULL COMMENT '签到结束时间',
  `is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除0未删除1删除',
  `created_at` datetime DEFAULT NULL COMMENT '签到时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `note_id` (`meeting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='签到模板表';

-- ----------------------------
-- Records of sign
-- ----------------------------

-- ----------------------------
-- Table structure for sign_field
-- ----------------------------
DROP TABLE IF EXISTS `sign_field`;
CREATE TABLE `sign_field` (
  `sign_id` int(10) NOT NULL DEFAULT '0' COMMENT '签到id',
  `field_key` varchar(64) NOT NULL DEFAULT '' COMMENT '字段名称',
  `field_des` varchar(64) NOT NULL DEFAULT '' COMMENT '字段描述',
  `is_required` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0选填1必填',
  KEY `sign_id` (`sign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='签到自定义字段';

-- ----------------------------
-- Records of sign_field
-- ----------------------------
INSERT INTO `sign_field` VALUES ('0', 'name', '姓名', '1');
INSERT INTO `sign_field` VALUES ('0', 'phone', '手机号', '1');
INSERT INTO `sign_field` VALUES ('0', 'wechat_code', '微信号', '0');

-- ----------------------------
-- Table structure for sign_user
-- ----------------------------
DROP TABLE IF EXISTS `sign_user`;
CREATE TABLE `sign_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sign_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到id',
  `meeting_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会议id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '签到类型1签到2签退3补签到4补签退',
  `fileld_text` json NOT NULL COMMENT '自定义字段内容',
  `wifi` varchar(255) NOT NULL DEFAULT '' COMMENT 'wifi',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '位置签到',
  `photo` varchar(255) NOT NULL DEFAULT '' COMMENT '拍照签到',
  `qr_code` varchar(255) NOT NULL DEFAULT '' COMMENT '二维码签到',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sign_id` (`sign_id`),
  KEY `user_id` (`user_id`),
  KEY `meeting_id` (`meeting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='用户签到表';

-- ----------------------------
-- Records of sign_user
-- ----------------------------

-- ----------------------------
-- Table structure for sms_code
-- ----------------------------
DROP TABLE IF EXISTS `sms_code`;
CREATE TABLE `sms_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '验证码',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未使用1使用',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='短信记录表';

-- ----------------------------
-- Records of sms_code
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `wechat_code` varchar(64) NOT NULL DEFAULT '' COMMENT '微信号',
  `profession` varchar(64) NOT NULL DEFAULT '' COMMENT '职业',
  `openid` varchar(32) NOT NULL COMMENT 'openid',
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  `email` varchar(32) NOT NULL COMMENT '邮件',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `sex` tinyint(4) NOT NULL DEFAULT '0' COMMENT '性别1男2女',
  `nikename` varchar(32) NOT NULL DEFAULT '' COMMENT '微信昵称',
  `head_img` varchar(255) NOT NULL DEFAULT '' COMMENT '微信头像',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `openid` (`openid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
