# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.30)
# Database: sign
# Generation Time: 2020-09-07 10:01:08 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table config
# ------------------------------------------------------------

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `about` varchar(255) NOT NULL COMMENT '联系我们',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='配置表';



# Dump of table feedback
# ------------------------------------------------------------

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `content` varchar(2048) NOT NULL DEFAULT '' COMMENT '内容',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '联系电话',
  `user_id` bigint(11) NOT NULL COMMENT '用户id',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='意见反馈表';



# Dump of table meeting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `meeting`;

CREATE TABLE `meeting` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '活动标题',
  `content` text COMMENT '活动内容',
  `sign_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1签到2签退3签到签退',
  `user_limit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '参会人数0为无限制',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否发布0否1发布',
  `sign_in_btime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到开始时间',
  `sign_in_etime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到结束时间',
  `sign_out_btime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签退开始时间',
  `sign_out_etime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签退结束时间',
  `created_at` datetime DEFAULT NULL COMMENT '签到时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='签到模板表';



# Dump of table meeting_template
# ------------------------------------------------------------

DROP TABLE IF EXISTS `meeting_template`;

CREATE TABLE `meeting_template` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `meeting_id` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '相关会议ID',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '活动标题',
  `content` text COMMENT '活动内容',
  `sign_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1签到2签退3签到签退',
  `sign_fields` json DEFAULT NULL COMMENT '签到所需字段',
  `sign_rules` json DEFAULT NULL COMMENT '签到规则',
  `user_limit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '参会人数0为无限制',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否发布0否1发布',
  `created_at` datetime DEFAULT NULL COMMENT '签到时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='签到模板表';



# Dump of table sign
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sign`;

CREATE TABLE `sign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meeting_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会议id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '签到类型1签到2签退3补签到4补签退',
  `nickname` varchar(32) NOT NULL DEFAULT '' COMMENT '姓名',
  `mobile` varchar(32) NOT NULL DEFAULT '' COMMENT '手机号',
  `wechat_code` varchar(64) NOT NULL DEFAULT '' COMMENT '微信号',
  `data` json NOT NULL COMMENT '自定义字段内容',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `meeting_id` (`meeting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户签到表';



# Dump of table sign_field
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sign_field`;

CREATE TABLE `sign_field` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '会议ID',
  `key` varchar(32) NOT NULL DEFAULT '' COMMENT '签到KEY',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '字段标题',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0填写1图片',
  `required` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='签到所需字段';



# Dump of table sign_rule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sign_rule`;

CREATE TABLE `sign_rule` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `meeting_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '会议ID',
  `sign_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '1签到 2签退',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '签到类型 0访问1Wifi2geo',
  `data` json DEFAULT NULL COMMENT '签到相关数据',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='签到规则';



# Dump of table sms_code
# ------------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='短信记录表';



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(128) NOT NULL DEFAULT '' COMMENT '密码',
  `nikename` varchar(32) NOT NULL DEFAULT '' COMMENT '姓名',
  `mobile` varchar(16) NOT NULL DEFAULT '' COMMENT '手机号',
  `wechat_code` varchar(64) NOT NULL DEFAULT '' COMMENT '微信号',
  `profession` varchar(64) NOT NULL DEFAULT '' COMMENT '职业',
  `gender` tinyint(4) NOT NULL DEFAULT '0' COMMENT '性别0未知1男2女',
  `head_img` varchar(256) NOT NULL DEFAULT '' COMMENT '头像',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `password`, `nikename`, `mobile`, `wechat_code`, `profession`, `gender`, `head_img`, `created_at`, `updated_at`)
VALUES
	(1,'tester','$2y$10$72SSS541tnAif684UbbVvONnMJUArGF7xgEmV/nl0fX/aqV6Hu88C','','','','',0,'','2020-08-25 14:53:16','2020-08-25 14:53:16');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_oauth
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_oauth`;

CREATE TABLE `user_oauth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '授权类型 0微信 1手机 2邮箱',
  `oauth` varchar(128) NOT NULL DEFAULT '' COMMENT '授权信息',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `oauth` (`oauth`,`type`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户授权表';




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
