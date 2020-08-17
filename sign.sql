/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : sign

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-08-17 17:41:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for si_config
-- ----------------------------
DROP TABLE IF EXISTS `si_config`;
CREATE TABLE `si_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `about` varchar(255) NOT NULL COMMENT '联系我们',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='配置表';

-- ----------------------------
-- Records of si_config
-- ----------------------------

-- ----------------------------
-- Table structure for si_note
-- ----------------------------
DROP TABLE IF EXISTS `si_note`;
CREATE TABLE `si_note` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
  `title` varchar(32) NOT NULL COMMENT '会议标题',
  `recording_url` varchar(255) NOT NULL DEFAULT '' COMMENT '录音地址',
  `note` varchar(255) NOT NULL COMMENT '笔记',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会议笔记';

-- ----------------------------
-- Records of si_note
-- ----------------------------

-- ----------------------------
-- Table structure for si_propose
-- ----------------------------
DROP TABLE IF EXISTS `si_propose`;
CREATE TABLE `si_propose` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COMMENT '内容',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='意见反馈表';

-- ----------------------------
-- Records of si_propose
-- ----------------------------

-- ----------------------------
-- Table structure for si_sign
-- ----------------------------
DROP TABLE IF EXISTS `si_sign`;
CREATE TABLE `si_sign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `note_id` int(10) NOT NULL DEFAULT '0' COMMENT '会议id',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1签到2签退',
  `photo` varchar(255) NOT NULL COMMENT '照片',
  `address` varchar(255) NOT NULL COMMENT '位置',
  `wifi` varchar(255) NOT NULL COMMENT 'wifi签到',
  `created_at` datetime DEFAULT NULL COMMENT '签到时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `note_id` (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='签到表';

-- ----------------------------
-- Records of si_sign
-- ----------------------------

-- ----------------------------
-- Table structure for si_sms_code
-- ----------------------------
DROP TABLE IF EXISTS `si_sms_code`;
CREATE TABLE `si_sms_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '验证码',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未使用1使用',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='短信记录表';

-- ----------------------------
-- Records of si_sms_code
-- ----------------------------

-- ----------------------------
-- Table structure for si_user
-- ----------------------------
DROP TABLE IF EXISTS `si_user`;
CREATE TABLE `si_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(32) NOT NULL DEFAULT '' COMMENT 'openid',
  `phone` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `email` varchar(32) NOT NULL DEFAULT '' COMMENT '邮件',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `sex` tinyint(4) NOT NULL DEFAULT '0' COMMENT '性别1男2女',
  `nikename` varchar(32) NOT NULL DEFAULT '' COMMENT '微信昵称',
  `head_img` varchar(255) NOT NULL DEFAULT '' COMMENT '微信头像',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `openid` (`openid`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

-- ----------------------------
-- Records of si_user
-- ----------------------------
