# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.15)
# Database: phpfox_v5
# Generation Time: 2017-05-20 02:26:02 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table pf5_acl_action
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_acl_action`;

CREATE TABLE `pf5_acl_action` (
  `action_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_type` enum('site','type','entry') DEFAULT 'site',
  `package_id` varchar(32) NOT NULL DEFAULT 'core',
  `group_id` varchar(32) NOT NULL DEFAULT '',
  `form_id` varchar(50) NOT NULL DEFAULT 'core',
  `name` varchar(50) NOT NULL DEFAULT '',
  `ordering` tinyint(3) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`action_id`),
  UNIQUE KEY `group_id` (`group_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pf5_acl_action` WRITE;
/*!40000 ALTER TABLE `pf5_acl_action` DISABLE KEYS */;

INSERT INTO `pf5_acl_action` (`action_id`, `action_type`, `package_id`, `group_id`, `form_id`, `name`, `ordering`, `is_active`)
VALUES
	(1,'site','core','core','core_general','clear_cache',0,1),
	(3,'site','core','core','core_general','manage_package',0,1),
	(4,'site','core','core','core_general','install_package',0,1),
	(5,'site','core','core','core_general','access_admin',0,1),
	(6,'site','core','core','core_general','manage_layout',0,1),
	(7,'site','core','core','core_general','manage_site_setting',0,1),
	(10,'site','core','core','core_general','manage_acl_setting',0,1),
	(11,'site','core','core','core_general','moderate_content',0,1),
	(12,'site','core','core','core_general','manage_cache',0,1),
	(13,'site','core','core','core_general','clear_log',0,1),
	(14,'site','core','core','core_general','manage_log',0,1),
	(15,'site','core','core','core_general','manage_admin',0,1),
	(16,'site','core','core','core_general','manage_theme',0,1),
	(17,'site','core','core','core_general','manage_acl_role',0,1);

/*!40000 ALTER TABLE `pf5_acl_action` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_acl_form
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_acl_form`;

CREATE TABLE `pf5_acl_form` (
  `form_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `package_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `form_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `ordering` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `is_active` tinyint(4) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_acl_form` WRITE;
/*!40000 ALTER TABLE `pf5_acl_form` DISABLE KEYS */;

INSERT INTO `pf5_acl_form` (`form_id`, `package_id`, `title`, `form_name`, `description`, `ordering`, `is_active`)
VALUES
	('core_general','core','Edit Settings','Neutron\\Core\\Form\\Admin\\Settings\\EditGeneralPermissions','',1,1);

/*!40000 ALTER TABLE `pf5_acl_form` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_acl_level
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_acl_level`;

CREATE TABLE `pf5_acl_level` (
  `level_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `inherit_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `item_count` int(11) unsigned NOT NULL DEFAULT '0',
  `is_special` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_super` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_moderator` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_staff` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_registered` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_banned` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_guest` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`level_id`),
  KEY `user_group_id` (`level_id`),
  KEY `is_special` (`is_special`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pf5_acl_level` WRITE;
/*!40000 ALTER TABLE `pf5_acl_level` DISABLE KEYS */;

INSERT INTO `pf5_acl_level` (`level_id`, `inherit_id`, `title`, `item_count`, `is_special`, `is_super`, `is_admin`, `is_moderator`, `is_staff`, `is_registered`, `is_banned`, `is_guest`)
VALUES
	(1,0,'Super',0,1,1,1,1,1,1,0,0),
	(2,0,'Administrator',0,1,0,1,1,1,1,0,0),
	(3,0,'Moderator',0,1,0,0,1,1,1,0,0),
	(4,0,'Staff',0,1,0,0,0,1,1,0,0),
	(5,0,'Registered',0,1,0,0,0,0,1,0,0),
	(6,2,'Banned',0,0,0,0,0,0,1,1,0),
	(7,0,'Guest',0,1,0,0,0,0,0,0,1);

/*!40000 ALTER TABLE `pf5_acl_level` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_acl_value
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_acl_value`;

CREATE TABLE `pf5_acl_value` (
  `value_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(11) unsigned NOT NULL,
  `level_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `value_actual` mediumtext,
  PRIMARY KEY (`value_id`),
  UNIQUE KEY `action_id` (`action_id`,`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table pf5_activity_action
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_activity_action`;

CREATE TABLE `pf5_activity_action` (
  `action_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `poster_uid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `parent_uid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `about_uid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `privacy_uid` int(11) unsigned NOT NULL DEFAULT '0',
  `privacy_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `about_id` int(11) unsigned NOT NULL,
  `about_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `poster_id` int(11) unsigned NOT NULL,
  `poster_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_id` int(11) unsigned NOT NULL,
  `parent_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_activity_hide
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_activity_hide`;

CREATE TABLE `pf5_activity_hide` (
  `user_id` int(11) NOT NULL,
  `hide_resource_type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `hide_resource_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`hide_resource_type`,`hide_resource_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_activity_setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_activity_setting`;

CREATE TABLE `pf5_activity_setting` (
  `user_id` int(11) unsigned NOT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_activity_stream
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_activity_stream`;

CREATE TABLE `pf5_activity_stream` (
  `parent_uid` bigint(20) unsigned NOT NULL,
  `action_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`parent_uid`,`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_activity_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_activity_type`;

CREATE TABLE `pf5_activity_type` (
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `displayable` tinyint(1) NOT NULL DEFAULT '3',
  `attachable` tinyint(1) NOT NULL DEFAULT '1',
  `commentable` tinyint(1) NOT NULL DEFAULT '1',
  `shareable` tinyint(1) NOT NULL DEFAULT '1',
  `is_generated` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_activity_wall
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_activity_wall`;

CREATE TABLE `pf5_activity_wall` (
  `parent_uid` bigint(20) NOT NULL,
  `action_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_announcement
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_announcement`;

CREATE TABLE `pf5_announcement` (
  `announcement_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `title` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `photo_file_id` int(11) unsigned NOT NULL DEFAULT '0',
  `description` tinytext COLLATE utf8_unicode_ci,
  `is_active` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `type_id` tinyint(4) NOT NULL DEFAULT '0',
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `publish_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`announcement_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_announcement` WRITE;
/*!40000 ALTER TABLE `pf5_announcement` DISABLE KEYS */;

INSERT INTO `pf5_announcement` (`announcement_id`, `user_id`, `title`, `photo_file_id`, `description`, `is_active`, `type_id`, `content`, `created_at`, `updated_at`, `publish_at`, `expires_at`)
VALUES
	(4,0,'[annoucement title]',0,NULL,0,0,'','2012-00-00 00:00:00','2013-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(5,0,'[annoucement title]',0,NULL,0,0,'','2012-00-00 00:00:00','2013-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(6,0,'[annoucement title]',0,NULL,0,0,'','2012-00-00 00:00:00','2013-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(7,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(8,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(9,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(10,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(11,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(12,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(13,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(14,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(15,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(16,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(17,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(18,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(19,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(20,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(21,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(22,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(23,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(24,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(25,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00'),
	(26,0,'[annoucement title]',22,'[annoucement description]',1,0,'[annoucement content]','0000-00-00 00:00:00','0000-00-00 00:00:00','2014-00-00 00:00:00','2015-00-00 00:00:00');

/*!40000 ALTER TABLE `pf5_announcement` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_announcement_exclude
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_announcement_exclude`;

CREATE TABLE `pf5_announcement_exclude` (
  `exclude_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `announcement_id` int(11) unsigned NOT NULL,
  `exclude_type` varchar(56) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `exclude_value` int(11) unsigned NOT NULL,
  PRIMARY KEY (`exclude_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_auth_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_auth_history`;

CREATE TABLE `pf5_auth_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `remote_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `device_name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_auth_history` WRITE;
/*!40000 ALTER TABLE `pf5_auth_history` DISABLE KEYS */;

INSERT INTO `pf5_auth_history` (`id`, `user_id`, `remote_address`, `device_name`, `created_at`)
VALUES
	(1,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 01:15:18'),
	(2,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 10:45:04'),
	(3,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 11:36:42'),
	(4,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 13:39:02'),
	(5,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 14:25:42'),
	(6,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 15:04:01'),
	(7,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 19:36:15'),
	(8,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 19:59:27'),
	(9,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 19:59:32'),
	(10,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 19:59:37'),
	(11,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 19:59:44'),
	(12,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-18 20:00:07'),
	(13,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 00:09:51'),
	(14,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 15:19:44'),
	(15,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:06:51'),
	(16,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:07:55'),
	(17,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:10:43'),
	(18,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:10:56'),
	(19,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:11:02'),
	(20,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:11:13'),
	(21,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:11:53'),
	(22,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:12:24'),
	(23,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:12:47'),
	(24,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:12:55'),
	(25,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:13:00'),
	(26,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:13:12'),
	(27,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:47:13'),
	(28,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:47:19'),
	(29,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 16:47:25'),
	(30,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:09:03'),
	(31,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:09:24'),
	(32,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:10:24'),
	(33,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:13:13'),
	(34,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:16:01'),
	(35,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:17:05'),
	(36,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:20:49'),
	(37,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:22:36'),
	(38,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:22:42'),
	(39,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:23:44'),
	(40,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:23:54'),
	(41,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:24:49'),
	(42,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:26:24'),
	(43,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:27:23'),
	(44,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:28:03'),
	(45,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:28:19'),
	(46,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:28:39'),
	(47,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:29:26'),
	(48,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:30:18'),
	(49,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:31:35'),
	(50,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:31:39'),
	(51,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:31:47'),
	(52,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:34:16'),
	(53,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:37:35'),
	(54,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:37:45'),
	(55,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:37:59'),
	(56,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:38:28'),
	(57,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:38:56'),
	(58,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:39:14'),
	(59,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:39:31'),
	(60,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:39:55'),
	(61,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:39:59'),
	(62,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:40:25'),
	(63,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:41:25'),
	(64,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:41:31'),
	(65,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:41:41'),
	(66,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:44:19'),
	(67,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:44:30'),
	(68,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:44:42'),
	(69,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:45:13'),
	(70,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:45:31'),
	(71,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:45:35'),
	(72,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:46:26'),
	(73,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:46:35'),
	(74,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:47:17'),
	(75,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:47:53'),
	(76,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:48:21'),
	(77,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:48:39'),
	(78,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:50:11'),
	(79,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:50:21'),
	(80,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:56:37'),
	(81,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:56:43'),
	(82,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:57:01'),
	(83,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:57:22'),
	(84,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:57:37'),
	(85,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:57:41'),
	(86,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:58:00'),
	(87,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:58:04'),
	(88,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:58:11'),
	(89,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:58:47'),
	(90,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:58:57'),
	(91,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:59:19'),
	(92,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 17:59:28'),
	(93,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:01:02'),
	(94,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:01:06'),
	(95,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:01:24'),
	(96,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:02:26'),
	(97,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:03:15'),
	(98,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:03:42'),
	(99,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:04:57'),
	(100,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:05:22'),
	(101,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:05:44'),
	(102,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:06:34'),
	(103,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:07:02'),
	(104,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:08:08'),
	(105,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:08:20'),
	(106,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 18:09:26'),
	(107,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-19 19:12:49'),
	(108,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 00:03:47'),
	(109,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 00:04:50'),
	(110,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 00:06:52'),
	(111,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 00:07:39'),
	(112,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 00:12:00'),
	(113,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 00:59:57'),
	(114,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 02:32:28'),
	(115,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 10:14:34'),
	(116,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 10:14:40'),
	(117,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 10:15:15'),
	(118,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 10:15:20'),
	(119,2,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36','2017-05-20 10:15:57');

/*!40000 ALTER TABLE `pf5_auth_history` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_auth_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_auth_log`;

CREATE TABLE `pf5_auth_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `updated` datetime NOT NULL,
  `level` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_auth_password
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_auth_password`;

CREATE TABLE `pf5_auth_password` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `hashed` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `static_salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `source_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pf5',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_auth_password` WRITE;
/*!40000 ALTER TABLE `pf5_auth_password` DISABLE KEYS */;

INSERT INTO `pf5_auth_password` (`id`, `user_id`, `hashed`, `salt`, `static_salt`, `source_id`, `created_at`)
VALUES
	(27,806,'$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e','OJ$','','pf4',NULL),
	(28,807,'$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e','OJ$','','pf4',NULL),
	(32,2,'8ce23dde946c448076fd29f77a25cd6f93bd9e6a','kup','','pf5','2017-02-16 07:41:09');

/*!40000 ALTER TABLE `pf5_auth_password` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_auth_remote
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_auth_remote`;

CREATE TABLE `pf5_auth_remote` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `remote_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `remote_uid` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_id` int(11) unsigned NOT NULL,
  `remote_token` mediumtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_auth_token
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_auth_token`;

CREATE TABLE `pf5_auth_token` (
  `id` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_id` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_blog_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_blog_category`;

CREATE TABLE `pf5_blog_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_blog_category` WRITE;
/*!40000 ALTER TABLE `pf5_blog_category` DISABLE KEYS */;

INSERT INTO `pf5_blog_category` (`category_id`, `is_active`, `name`, `description`)
VALUES
	(1,1,'Business',NULL),
	(2,1,'Education','Education network should be blank in this case please do not update.'),
	(3,1,'Entertainment',NULL),
	(4,1,'Family & Home',NULL),
	(5,1,'Health',NULL),
	(6,1,'Recreation',NULL),
	(7,1,'Shopping',NULL),
	(8,1,'Society',NULL),
	(10,1,'Sports',NULL),
	(11,1,'Technology',NULL);

/*!40000 ALTER TABLE `pf5_blog_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_blog_post
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_blog_post`;

CREATE TABLE `pf5_blog_post` (
  `blog_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `parent_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `poster_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `poster_id` int(11) unsigned NOT NULL,
  `publish_at` datetime NOT NULL,
  `view_count` int(11) unsigned NOT NULL DEFAULT '0',
  `comment_count` int(11) unsigned NOT NULL DEFAULT '0',
  `privacy_id` int(11) unsigned NOT NULL DEFAULT '0',
  `status_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`),
  KEY `owner_type` (`parent_type`,`parent_id`),
  KEY `search` (`privacy_id`,`created_at`),
  KEY `owner_id` (`parent_id`,`status_id`),
  KEY `draft` (`status_id`,`privacy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_blog_post` WRITE;
/*!40000 ALTER TABLE `pf5_blog_post` DISABLE KEYS */;

INSERT INTO `pf5_blog_post` (`blog_id`, `title`, `content`, `parent_type`, `description`, `parent_id`, `category_id`, `created_at`, `updated_at`, `poster_type`, `poster_id`, `publish_at`, `view_count`, `comment_count`, `privacy_id`, `status_id`, `is_approved`, `is_featured`, `user_id`)
VALUES
	(1,'dddd','ddd','','dddd',0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'0000-00-00 00:00:00',0,0,1,1,0,1,0),
	(2,'dddd','ddd','','dddd',0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'0000-00-00 00:00:00',0,0,1,1,0,1,0),
	(3,'dddd','ddd','','dddd',0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'0000-00-00 00:00:00',0,0,1,1,0,1,0);

/*!40000 ALTER TABLE `pf5_blog_post` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_comment`;

CREATE TABLE `pf5_comment` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `about_id` int(11) unsigned NOT NULL,
  `about_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `poster_id` int(11) unsigned NOT NULL,
  `poster_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_id` int(11) unsigned NOT NULL,
  `parent_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  `content` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_contact_department
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_contact_department`;

CREATE TABLE `pf5_contact_department` (
  `department_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_contact_department` WRITE;
/*!40000 ALTER TABLE `pf5_contact_department` DISABLE KEYS */;

INSERT INTO `pf5_contact_department` (`department_id`, `name`, `email`, `description`, `is_active`, `is_default`)
VALUES
	(1,'Support Departments','info@younet.co','',1,1),
	(2,'Sales Departments','info@younet.co','',1,1),
	(3,'Account Department','account@younet.co','',1,0);

/*!40000 ALTER TABLE `pf5_contact_department` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_core_adapter
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_core_adapter`;

CREATE TABLE `pf5_core_adapter` (
  `adapter_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `driver_type` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `driver_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_required` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `container_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `params` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `title` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`adapter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_core_adapter` WRITE;
/*!40000 ALTER TABLE `pf5_core_adapter` DISABLE KEYS */;

INSERT INTO `pf5_core_adapter` (`adapter_id`, `driver_type`, `driver_id`, `is_active`, `is_default`, `is_required`, `container_id`, `params`, `title`, `description`)
VALUES
	(2,'mailer','smtp',1,0,1,'shared.mailer','{\"title\":\"SMTP 127.0.0.1:25\",\"host\":\"127.0.0.1\",\"secure\":\"none\",\"port\":\"25\",\"auth\":\"0\",\"username\":\"\",\"password\":\"\",\"fromAddress\":\"namnv@younetco.com\",\"fromName\":\"nam nguyen\",\"replyAddress\":\"namnv@younetco.com\",\"replyName\":\"nam nguyen\"}','SMTP 127.0.0.1:25',''),
	(3,'captcha','recaptcha',1,1,1,'shared.captcha','{\"site_key\":\"6LdY8r4SAAAAABnDygUSdkPwu4gNtMDfalwsb7n6\",\"secret_key\":\"6LdY8r4SAAAAAO4BD4ZRMm6i19MaQLIovEi3weGr\",\"title\":\"Google ReCaptcha\"}','Google ReCaptcha',''),
	(4,'cache','files',1,0,1,'shared.cache','[]','Files',''),
	(5,'session','files',1,0,1,'shared.session','[]','Filesystem',''),
	(6,'session','database',1,0,1,'shared.session','[]','Database',''),
	(9,'session','redis',1,0,0,'shared.session','{\"host\":\"127.0.0.1\",\"port\":\"6379\",\"protocol\":\"tcp\",\"auth\":\"\",\"title\":\"Redis 127.0.0.1:6379\"}','Redis 127.0.0.1:6379',''),
	(10,'cache','redis',1,0,0,'shared.cache','{\"title\":\"Redis 127.0.0.1:6379\",\"host\":\"127.0.0.1\",\"port\":\"6379\",\"protocol\":\"tcp\",\"auth\":\"\"}','Redis 127.0.0.1:6379',''),
	(11,'cache','memcache',1,1,0,'shared.cache','{\"host\":\"127.0.0.1\",\"port\":\"11211\",\"persistent\":\"1\",\"compression\":\"1\",\"prefix\":\"_\",\"title\":\"Memcache 127.0.0.1:11211\"}','Memcache 127.0.0.1:11211',''),
	(12,'log','files',1,1,1,'main.log','{\"level\":\"notice\",\"title\":\"Files Logger\"}','File logger',''),
	(13,'log','files',1,1,1,'mail.log','{\"level\":\"notice\",\"title\":\"Files Logger\"}','File logger',''),
	(14,'log','files',1,1,1,'debug.log','{\"level\":\"notice\",\"title\":\"Files Logger\"}','File logger','');

/*!40000 ALTER TABLE `pf5_core_adapter` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_core_driver
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_core_driver`;

CREATE TABLE `pf5_core_driver` (
  `driver_identity` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `driver_type` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `form_settings_class` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordering` tinyint(4) unsigned NOT NULL DEFAULT '9',
  `package_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'core',
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `dependency` mediumtext CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`driver_identity`),
  UNIQUE KEY `driver_name` (`driver_id`,`driver_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_core_driver` WRITE;
/*!40000 ALTER TABLE `pf5_core_driver` DISABLE KEYS */;

INSERT INTO `pf5_core_driver` (`driver_identity`, `driver_id`, `driver_type`, `form_settings_class`, `is_active`, `ordering`, `package_id`, `title`, `description`, `dependency`)
VALUES
	(2,'memcache','cache','Neutron\\Core\\Form\\Admin\\CacheDriver\\EditMemcacheSettings',1,2,'core','Memcached','Memcached is an in-memory key-value store for small chunks of arbitrary data (strings, objects) from results of database calls, API calls, or page rendering. Memcached is simple yet powerful. Its simple design promotes quick deployment, ease of development, and solves many problems facing large data caches.','[{\"type\":\"class\",\"value\":\"Memcache\",\"error\":\"<strong>Memcache<\\/strong> extension is required to active this option\"}]'),
	(3,'redis','cache','Neutron\\Core\\Form\\Admin\\CacheDriver\\EditRedisSettings',1,3,'core','Redis','Redis is an in-memory data structure store, used as a database, cache and message broker. Redis support clustering and top recommended cache storage.','[{\"type\":\"class\",\"value\":\"\\\\Redis\",\"error\":\"<strong>Redis<\\/strong> extension is required to active this option\"}]'),
	(4,'smtp','mail','Neutron\\Core\\Form\\Admin\\MailDriver\\EditSmtpSettings',1,2,'core','SMTP Mail','Alternatively you can have emails sent out using SMTP, usually requiring a username and password, and optionally using an external mail server.',''),
	(5,'system','mail','Neutron\\Core\\Form\\Admin\\MailDriver\\EditSystemSettings',1,1,'core','Mail System','Emails typically get sent through the web server using the PHP mail() function. PHP mail uses the settings in PHP.ini to send email through sendmail. Sendmail is a direct path that just hands over the mail you generated to the system’s SMTP',''),
	(7,'db','log','Neutron\\Core\\Form\\Admin\\LogDriver\\EditDatabaseSettings',1,2,'core','Database Logger','Log to file system',''),
	(8,'files','log','Neutron\\Core\\Form\\Admin\\LogDriver\\EditFilesSettings',1,1,'core','Files Logger','Log to file system',''),
	(10,'ftp','storage','Neutron\\Core\\Form\\Admin\\StorageDriver\\EditFtpSettings',1,2,'core','FTP, FTPs - Virual File System','FTP/FTPs - Virual File System',''),
	(11,'local','storage','Neutron\\Core\\Form\\Admin\\StorageDriver\\EditLocalSettings',1,1,'core','Local File System','Local File System',''),
	(12,'s3','storage','Neutron\\Core\\Form\\Admin\\StorageDriver\\EditAmazonS3Settings',1,4,'core','Amazon S3','Amazon S3',''),
	(13,'ssh','storage','Neutron\\Core\\Form\\Admin\\StorageDriver\\EditSshSettings',1,3,'core','SSH, SCP - Virual File System','SSH/SCP - Virual File System',''),
	(17,'database','session','Neutron\\Core\\Form\\Admin\\SessionDriver\\EditDatabaseSettings',0,2,'core','Database','description',''),
	(18,'files','session','Neutron\\Core\\Form\\Admin\\SessionDriver\\EditFilesSettings',0,1,'core','Filesystem','description',''),
	(19,'memcache','session','Neutron\\Core\\Form\\Admin\\SessionDriver\\EditMemcacheSettings',1,3,'core','Memcache extension','Memcached is an in-memory key-value store for small chunks of arbitrary data (strings, objects) from results of database calls, API calls, or page rendering. Memcached is simple yet powerful. Its simple design promotes quick deployment, ease of development, and solves many problems facing large data caches.','[{\"type\":\"extension\",\"value\":\"memcached\",\"error\":\"<strong>Memcache<\\/strong> extension is required to active this option\"}]'),
	(20,'redis','session','Neutron\\Core\\Form\\Admin\\SessionDriver\\EditRedisSettings',1,4,'core','Redis','Redis is an in-memory data structure store, used as a database, cache and message broker. Redis is super fast and is very suitable to store session data.','[{\"type\":\"class\",\"value\":\"\\\\Redis\",\"error\":\"<strong>Redis<\\/strong> extension is required to active this option\"}]'),
	(24,'recaptcha','captcha','Neutron\\Core\\Form\\Admin\\CaptchaDriver\\EditRecaptchaSettings',1,9,'core','ReCaptcha','reCAPTCHA is a free service that protects your website from spam and abuse. reCAPTCHA uses an advanced risk analysis engine and adaptive CAPTCHAs to keep automated software from engaging in abusive activities on your site. It does this while letting your valid users pass through with ease.',''),
	(25,'twilio','sms','Neutron\\Core\\Form\\Admin\\SmsDriver\\EditTwilioSettings',1,2,'core','Twilio Service Provider','Twilio provide apis for SMS, Voice and Phone verifications.',''),
	(26,'nextmo','sms','Neutron\\Core\\Form\\Admin\\SmsDriver\\EditNextmoSettings',1,1,'core','Nextmo Service Provider','Nextmo provide APIs for SMS, Voice and Phone verifications.',''),
	(27,'sns','message','Neutron\\Core\\Form\\Admin\\MessageDriver\\EditSnsSettings',1,1,'core','Amazon Simple Notification Service (SNS)','Fully managed and highly scalable push messaging','');

/*!40000 ALTER TABLE `pf5_core_driver` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_core_event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_core_event`;

CREATE TABLE `pf5_core_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `listener_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `priority` int(11) unsigned NOT NULL DEFAULT '10',
  `package_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'core',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_event_name_listener_name` (`event_name`,`listener_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_core_event` WRITE;
/*!40000 ALTER TABLE `pf5_core_event` DISABLE KEYS */;

INSERT INTO `pf5_core_event` (`id`, `event_name`, `listener_name`, `priority`, `package_id`)
VALUES
	(1,'onBeforeJavascriptRender','theme_galaxy.listener',10,'theme_galaxy'),
	(2,'onSiteStatistics','core.listener',10,'core'),
	(3,'onSystemHealthCheck','core.listener',10,'core'),
	(4,'onBootstrap','core.listener',10,'core'),
	(5,'onRebuildFiles','core.listener',10,'core'),
	(6,'onLoginUser','acl',10,'core'),
	(7,'onUserLogin','user.auth_history',10,'user'),
	(8,'onSettingsChanged','core.listener',100,'core');

/*!40000 ALTER TABLE `pf5_core_event` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_core_job_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_core_job_log`;

CREATE TABLE `pf5_core_job_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `updated` datetime NOT NULL,
  `level` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_core_job_message
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_core_job_message`;

CREATE TABLE `pf5_core_job_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default',
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `expiration` int(11) unsigned NOT NULL DEFAULT '600',
  `status_id` tinyint(1) NOT NULL DEFAULT '0',
  `delivered_at` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_core_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_core_log`;

CREATE TABLE `pf5_core_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `updated` datetime NOT NULL,
  `level` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_core_log` WRITE;
/*!40000 ALTER TABLE `pf5_core_log` DISABLE KEYS */;

INSERT INTO `pf5_core_log` (`id`, `ip`, `updated`, `level`, `message`, `created`)
VALUES
	(120,'::1','2017-05-20 01:02:58','warning','[2] chmod(): Operation not permitted (/Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php) [23]\nError Code: ecf2b9\nStack trace:\n#0 /Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php(23): chmod(\'/Users/namnv/Sites/pf5/package/c...\', 511)\n#1 /Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php(324): Neutron\\Dev\\AbstractGenerator->putContents(\'package/core/src/Model/CoreAdapt...\', \'<?php\nnamespace Neutron\\Core\\Mod...\')\n#2 /Users/namnv/Sites/pf5/package/dev/src/Service/CodeGenerator.php(139): Neutron\\Dev\\ModelGenerator->process()\n#3 /Users/namnv/Sites/pf5/package/dev/src/Controller/AdminDevController.php(91): Neutron\\Dev\\Service\\CodeGenerator->generateFromActionMetaIds(Array)\n#4 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionController.php(90): Neutron\\Dev\\Controller\\AdminDevController->actionIndex()\n#5 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionDispatcher.php(130): Phpfox\\Support\\ActionController->dispatch(\'index\')\n#6 /Users/namnv/Sites/pf5/index.php(13): Phpfox\\Support\\ActionDispatcher->run()\n#7 {main}\n','2017-05-20 01:02:58'),
	(121,'::1','2017-05-20 01:04:19','warning','[2] chmod(): Operation not permitted (/Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php) [23]\nError Code: da52f9\nStack trace:\n#0 /Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php(23): chmod(\'/Users/namnv/Sites/pf5/package/c...\', 511)\n#1 /Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php(324): Neutron\\Dev\\AbstractGenerator->putContents(\'package/core/src/Model/CoreAdapt...\', \'<?php\nnamespace Neutron\\Core\\Mod...\')\n#2 /Users/namnv/Sites/pf5/package/dev/src/Service/CodeGenerator.php(139): Neutron\\Dev\\ModelGenerator->process()\n#3 /Users/namnv/Sites/pf5/package/dev/src/Controller/AdminDevController.php(91): Neutron\\Dev\\Service\\CodeGenerator->generateFromActionMetaIds(Array)\n#4 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionController.php(90): Neutron\\Dev\\Controller\\AdminDevController->actionIndex()\n#5 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionDispatcher.php(130): Phpfox\\Support\\ActionController->dispatch(\'index\')\n#6 /Users/namnv/Sites/pf5/index.php(13): Phpfox\\Support\\ActionDispatcher->run()\n#7 {main}\n','2017-05-20 01:04:19'),
	(122,'::1','2017-05-20 01:12:23','warning','[2] unlink(package/core/config/model/core_adapter.php): No such file or directory (/Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php) [322]\nError Code: 2286a5\nStack trace:\n#0 /Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php(322): unlink(\'package/core/config/model/core_a...\')\n#1 /Users/namnv/Sites/pf5/package/dev/src/Service/CodeGenerator.php(139): Neutron\\Dev\\ModelGenerator->process()\n#2 /Users/namnv/Sites/pf5/package/dev/src/Controller/AdminDevController.php(91): Neutron\\Dev\\Service\\CodeGenerator->generateFromActionMetaIds(Array)\n#3 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionController.php(90): Neutron\\Dev\\Controller\\AdminDevController->actionIndex()\n#4 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionDispatcher.php(130): Phpfox\\Support\\ActionController->dispatch(\'index\')\n#5 /Users/namnv/Sites/pf5/index.php(13): Phpfox\\Support\\ActionDispatcher->run()\n#6 {main}\n','2017-05-20 01:12:23'),
	(123,'::1','2017-05-20 01:12:23','warning','[2] chmod(): Operation not permitted (/Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php) [23]\nError Code: 7bc671\nStack trace:\n#0 /Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php(23): chmod(\'/Users/namnv/Sites/pf5/package/c...\', 511)\n#1 /Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php(324): Neutron\\Dev\\AbstractGenerator->putContents(\'package/core/src/Model/CoreAdapt...\', \'<?php\nnamespace Neutron\\Core\\Mod...\')\n#2 /Users/namnv/Sites/pf5/package/dev/src/Service/CodeGenerator.php(139): Neutron\\Dev\\ModelGenerator->process()\n#3 /Users/namnv/Sites/pf5/package/dev/src/Controller/AdminDevController.php(91): Neutron\\Dev\\Service\\CodeGenerator->generateFromActionMetaIds(Array)\n#4 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionController.php(90): Neutron\\Dev\\Controller\\AdminDevController->actionIndex()\n#5 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionDispatcher.php(130): Phpfox\\Support\\ActionController->dispatch(\'index\')\n#6 /Users/namnv/Sites/pf5/index.php(13): Phpfox\\Support\\ActionDispatcher->run()\n#7 {main}\n','2017-05-20 01:12:23'),
	(124,'::1','2017-05-20 01:12:24','warning','[2] unlink(package/core/config/model/core_adapter.php): No such file or directory (/Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php) [322]\nError Code: b466da\nStack trace:\n#0 /Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php(322): unlink(\'package/core/config/model/core_a...\')\n#1 /Users/namnv/Sites/pf5/package/dev/src/Service/CodeGenerator.php(139): Neutron\\Dev\\ModelGenerator->process()\n#2 /Users/namnv/Sites/pf5/package/dev/src/Controller/AdminDevController.php(91): Neutron\\Dev\\Service\\CodeGenerator->generateFromActionMetaIds(Array)\n#3 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionController.php(90): Neutron\\Dev\\Controller\\AdminDevController->actionIndex()\n#4 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionDispatcher.php(130): Phpfox\\Support\\ActionController->dispatch(\'index\')\n#5 /Users/namnv/Sites/pf5/index.php(13): Phpfox\\Support\\ActionDispatcher->run()\n#6 {main}\n','2017-05-20 01:12:24'),
	(125,'::1','2017-05-20 01:12:24','warning','[2] chmod(): Operation not permitted (/Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php) [23]\nError Code: b927c3\nStack trace:\n#0 /Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php(23): chmod(\'/Users/namnv/Sites/pf5/package/c...\', 511)\n#1 /Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php(324): Neutron\\Dev\\AbstractGenerator->putContents(\'package/core/src/Model/CoreAdapt...\', \'<?php\nnamespace Neutron\\Core\\Mod...\')\n#2 /Users/namnv/Sites/pf5/package/dev/src/Service/CodeGenerator.php(139): Neutron\\Dev\\ModelGenerator->process()\n#3 /Users/namnv/Sites/pf5/package/dev/src/Controller/AdminDevController.php(91): Neutron\\Dev\\Service\\CodeGenerator->generateFromActionMetaIds(Array)\n#4 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionController.php(90): Neutron\\Dev\\Controller\\AdminDevController->actionIndex()\n#5 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionDispatcher.php(130): Phpfox\\Support\\ActionController->dispatch(\'index\')\n#6 /Users/namnv/Sites/pf5/index.php(13): Phpfox\\Support\\ActionDispatcher->run()\n#7 {main}\n','2017-05-20 01:12:24'),
	(126,'::1','2017-05-20 01:13:03','warning','[2] chmod(): Operation not permitted (/Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php) [23]\nError Code: dcd369\nStack trace:\n#0 /Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php(23): chmod(\'/Users/namnv/Sites/pf5/package/c...\', 511)\n#1 /Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php(324): Neutron\\Dev\\AbstractGenerator->putContents(\'package/core/src/Model/CoreAdapt...\', \'<?php\nnamespace Neutron\\Core\\Mod...\')\n#2 /Users/namnv/Sites/pf5/package/dev/src/Service/CodeGenerator.php(139): Neutron\\Dev\\ModelGenerator->process()\n#3 /Users/namnv/Sites/pf5/package/dev/src/Controller/AdminDevController.php(91): Neutron\\Dev\\Service\\CodeGenerator->generateFromActionMetaIds(Array)\n#4 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionController.php(90): Neutron\\Dev\\Controller\\AdminDevController->actionIndex()\n#5 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionDispatcher.php(130): Phpfox\\Support\\ActionController->dispatch(\'index\')\n#6 /Users/namnv/Sites/pf5/index.php(13): Phpfox\\Support\\ActionDispatcher->run()\n#7 {main}\n','2017-05-20 01:13:03'),
	(127,'::1','2017-05-20 01:15:22','warning','[2] unlink(package/core/config/model/core_adapter.php): No such file or directory (/Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php) [322]\nError Code: ff94da\nStack trace:\n#0 /Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php(322): unlink(\'package/core/config/model/core_a...\')\n#1 /Users/namnv/Sites/pf5/package/dev/src/Service/CodeGenerator.php(139): Neutron\\Dev\\ModelGenerator->process()\n#2 /Users/namnv/Sites/pf5/package/dev/src/Controller/AdminDevController.php(91): Neutron\\Dev\\Service\\CodeGenerator->generateFromActionMetaIds(Array)\n#3 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionController.php(90): Neutron\\Dev\\Controller\\AdminDevController->actionIndex()\n#4 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionDispatcher.php(130): Phpfox\\Support\\ActionController->dispatch(\'index\')\n#5 /Users/namnv/Sites/pf5/index.php(13): Phpfox\\Support\\ActionDispatcher->run()\n#6 {main}\n','2017-05-20 01:15:22'),
	(128,'::1','2017-05-20 01:15:22','warning','[2] chmod(): Operation not permitted (/Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php) [23]\nError Code: 86a90e\nStack trace:\n#0 /Users/namnv/Sites/pf5/package/dev/src/AbstractGenerator.php(23): chmod(\'/Users/namnv/Sites/pf5/package/c...\', 511)\n#1 /Users/namnv/Sites/pf5/package/dev/src/ModelGenerator.php(324): Neutron\\Dev\\AbstractGenerator->putContents(\'package/core/src/Model/CoreAdapt...\', \'<?php\nnamespace Neutron\\Core\\Mod...\')\n#2 /Users/namnv/Sites/pf5/package/dev/src/Service/CodeGenerator.php(139): Neutron\\Dev\\ModelGenerator->process()\n#3 /Users/namnv/Sites/pf5/package/dev/src/Controller/AdminDevController.php(91): Neutron\\Dev\\Service\\CodeGenerator->generateFromActionMetaIds(Array)\n#4 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionController.php(90): Neutron\\Dev\\Controller\\AdminDevController->actionIndex()\n#5 /Users/namnv/Sites/pf5/library/phpfox-support/src/ActionDispatcher.php(130): Phpfox\\Support\\ActionController->dispatch(\'index\')\n#6 /Users/namnv/Sites/pf5/index.php(13): Phpfox\\Support\\ActionDispatcher->run()\n#7 {main}\n','2017-05-20 01:15:22');

/*!40000 ALTER TABLE `pf5_core_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_core_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_core_menu`;

CREATE TABLE `pf5_core_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ordering` smallint(6) NOT NULL DEFAULT '100',
  `menu` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `package_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `label` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `params` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `extra` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '[]',
  `acl` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plugin` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_custom` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('route','separator') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'route',
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu` (`menu`,`name`),
  KEY `LOOKUP` (`name`,`ordering`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_core_menu` WRITE;
/*!40000 ALTER TABLE `pf5_core_menu` DISABLE KEYS */;

INSERT INTO `pf5_core_menu` (`id`, `ordering`, `menu`, `name`, `parent_name`, `package_id`, `label`, `route`, `params`, `extra`, `acl`, `event`, `plugin`, `is_active`, `is_custom`, `type`)
VALUES
	(1,1,'admin','dashboard',NULL,'core','Dashboard','admin','','[]',NULL,'',NULL,1,0,'route'),
	(2,1,'admin','packages','','core','Packages','admin.core.package','','[]',NULL,'',NULL,1,0,'route'),
	(3,1,'admin','members',NULL,'core','Members','admin.user.user','{\"action\":\"index\"}','[]',NULL,'',NULL,1,0,'route'),
	(4,1,'admin','settings',NULL,'core','Settings','admin','','[]',NULL,'',NULL,1,0,'route'),
	(5,5,'admin','mail','settings','core','Mail Settings','admin.core.mail.adapter','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(7,4,'admin','i18n','settings','core','International','admin.core.i18n.settings','','[]',NULL,'',NULL,1,0,'route'),
	(8,2,'admin','core-site','settings','core','General Settings','admin.core.settings.edit','{\"setting_group\":\"core_general\"}','[]',NULL,'',NULL,1,0,'route'),
	(9,6,'admin','status','','core','Status','admin','','[]',NULL,'',NULL,1,0,'route'),
	(10,2,'admin','statistics','status','core','Site Statistics','admin.core.status.*','{\"action\":\"statistics\"}','[]',NULL,'',NULL,1,0,'route'),
	(12,1,'admin','overview','status','core','System Overview','admin.core.status','','[]',NULL,'',NULL,1,0,'route'),
	(15,3,'admin','health','status','core','Health Check','admin.core.status.*','{\"action\":\"health-check\"}','[]',NULL,'',NULL,1,0,'route'),
	(16,5,'admin','license','settings','core','License Key','admin.core.settings.edit','{\"setting_group\":\"core_license\"}','[]',NULL,'',NULL,1,0,'route'),
	(19,7,'admin','acl','settings','core','User Groups','admin.core.acl.role','{\"action\":\"index\"}','[]',NULL,'',NULL,1,0,'route'),
	(20,1,'main','home','','core','Home','home','','[]',NULL,'',NULL,1,0,'route'),
	(21,1,'main','photos','','photo','Photos','photos','','[]',NULL,'',NULL,1,0,'route'),
	(22,1,'main','videos','','video','Videos','videos','','[]',NULL,'',NULL,1,0,'route'),
	(23,1,'main','blogs','','blog','Blogs','blogs','','[]',NULL,'',NULL,1,0,'route'),
	(28,1,'main','members','','core','Members','members','','[]',NULL,'',NULL,1,0,'route'),
	(29,1,'main.mini','login','','core','Login','login','','[]','is_guest','',NULL,1,0,'route'),
	(31,1,'main.mini','register','','core','Register','register','','[]','is_guest','',NULL,1,0,'route'),
	(32,1,'main.mini','profile',NULL,'core','@name','@name','','[]','is_registered',NULL,NULL,1,0,'route'),
	(34,999,'main.mini','account',NULL,'core','Account','@account','','[]','is_registered',NULL,NULL,1,0,'route'),
	(35,1,'main.mini','requests',NULL,'core','#','@request','','[]','is_registered',NULL,NULL,1,0,'route'),
	(36,2,'main.mini','messages',NULL,'core','#','@messages','','[]','is_registered',NULL,NULL,1,0,'route'),
	(37,3,'main.mini','notification',NULL,'core','#','@notifications','','[]','is_registered',NULL,NULL,1,0,'route'),
	(38,2,'main.mini','settings','account','core','Account Settings','@settings','','[]','is_registered',NULL,NULL,1,0,'route'),
	(39,6,'main.mini','logout','account','core','Logout','logout','','[]','is_registered','',NULL,1,0,'route'),
	(40,1,'main.mini','edit-profile','account','core','Edit Profile','@edit','','[]','is_registered',NULL,NULL,1,0,'route'),
	(41,3,'main.mini','separator','account','core','','#','','[]','is_registered',NULL,NULL,1,0,'separator'),
	(43,4,'main.mini','feedback','account','core','Feedback','feedback','','[]','is_registered','',NULL,1,0,'route'),
	(45,5,'main.mini','help','account','core','Help Center','feedback','','[]','is_registered','',NULL,1,0,'route'),
	(47,4,'main.mini','login-history','account','core','Login History','settings.login-history','','[]','is_registered','',NULL,1,0,'route'),
	(48,1,'main.mini','admincp','account','core','Admin Control Panel','admin','','[]','is_admin',NULL,NULL,1,0,'route'),
	(50,4,'main.mini','subscriptions','account','core','Subscriptions','settings.subscriptions','','[]','is_registered','',NULL,1,0,'route'),
	(51,4,'admin','manage','','core','Manage','#','','[]',NULL,'',NULL,1,0,'route'),
	(52,1,'admin','contact-us','manage','contact','Contacts','admin.contact','','[]',NULL,'',NULL,1,0,'route'),
	(53,5,'_mini','profile',NULL,'core','@name','@name','','[]','is_admin',NULL,NULL,1,0,'route'),
	(54,1,'admin','report','manage','report','Reports','admin.report.category','','[]',NULL,'',NULL,1,0,'route'),
	(55,1,'admin','media-library','manage','core','Media Library','admin','','[]',NULL,'',NULL,1,0,'route'),
	(57,9,'admin','layout','settings','core','Layout Editor','admin.core.layout','','[]',NULL,'',NULL,1,0,'route'),
	(58,8,'admin','storage','settings','core','Storage System','admin.core.storage','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(59,1,'_core.layout','manage-action','','core','Manage Pages','admin.core.layout','[]','[]',NULL,'',NULL,1,0,'route'),
	(62,1,'_core.layout','manage-theme','','core','Manage Themes','admin.core.layout.theme','[]','[]',NULL,'',NULL,1,0,'route'),
	(64,1,'_core.layout','manage-component','','core','Manage Components','admin.core.layout.component','[]','[]',NULL,'',NULL,1,0,'route'),
	(68,0,'_core.mail','manage-settings','','core','Mail Settings','admin.core.mail.adapter','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(71,3,'_core.mail','manage-template','','core','Templates','admin.core.mail.template','[]','[]',NULL,'',NULL,1,0,'route'),
	(72,1,'_core.mail.template.buttons','add-template','','core','Add Template','admin.core.mail.template','{\"action\":\"add\"}','{\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(73,2,'_core.i18n','manage-locale','','core','Locales','admin.core.i18n.locale','[]','[]',NULL,'',NULL,1,0,'route'),
	(74,1,'_core.i18n','manage-message','','core','Messages','admin.core.i18n','[]','[]',NULL,'',NULL,1,0,'route'),
	(75,1,'_core.i18n.message.buttons','add-message','','core','Add Message','admin.core.i18n.message','{\"action\":\"add\"}','{\"data-cmd\":\"modal\",\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(76,1,'_core.acl','manage-role','','core','Manage Groups','admin.core.acl','[]','[]',NULL,'',NULL,1,0,'route'),
	(77,1,'_core.acl.buttons','add-role','','core','Add Groups','admin.core.acl','{\"action\":\"add\"}','{\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(78,2,'_core.status','statistics','','core','Site Statistics','admin.core.status.*','{\"action\":\"statistics\"}','[]',NULL,'',NULL,1,0,'route'),
	(79,1,'_core.status','overview','','core','System Overview','admin.core.status','','[]',NULL,'',NULL,1,0,'route'),
	(80,3,'_core.status','health','','core','Health Check','admin.core.status.*','{\"action\":\"health-check\"}','[]',NULL,'',NULL,1,0,'route'),
	(82,5,'_contact','manage-deparment','','contact','Departments','admin.contact.department','[]','[]',NULL,'',NULL,1,0,'route'),
	(83,5,'_contact.buttons','add-deparment','','contact','Add Department','admin.contact.department','{\"action\":\"add\"}','{\"data-cmd\":\"modal\",\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(86,1,'_report','manage-report','','report','Reports','admin.report.item','{\"action\":\"index\"}','[]',NULL,'','',1,0,'route'),
	(87,1,'_report','manage-category','','core','Categories','admin.report.category','[]','[]',NULL,'',NULL,1,0,'route'),
	(88,1,'_report','add-category','','core','Add Category','admin.report.category','{\"action\":\"add\"}','{\"data-cmd\":\"modal\"}',NULL,'','',1,0,'route'),
	(89,9,'_video','manage-category','','video','Categories','admin.video.category','[]','[]',NULL,'',NULL,1,0,'route'),
	(90,5,'_video','manage-video','','video','Videos','admin.video','[]','[]',NULL,'',NULL,1,0,'route'),
	(91,6,'_video','settings','','video','Settings','admin.video.settings','[]','[]',NULL,'',NULL,1,0,'route'),
	(92,7,'_video','utility','','video','Utilities','admin.video.utility','[]','[]',NULL,'',NULL,1,0,'route'),
	(93,10,'_video','add-category','','video','Add Category','admin.video.category','{\"action\":\"add\"}','{\"data-cmd\":\"modal\"}',NULL,'',NULL,1,0,'route'),
	(95,5,'_poll','manage-poll','','poll','Polls','admin.poll','[]','[]',NULL,'',NULL,1,0,'route'),
	(96,6,'_poll','settings','','poll','Settings','admin.poll.settings','[]','[]',NULL,'',NULL,1,0,'route'),
	(98,9,'_event','manage-category','','event','Categories','admin.event.category','[]','[]',NULL,'',NULL,1,0,'route'),
	(99,5,'_event','manage-event','','event','Events','admin.event','[]','[]',NULL,'',NULL,1,0,'route'),
	(100,6,'_event','settings','','event','Settings','admin.event.settings','[]','[]',NULL,'',NULL,1,0,'route'),
	(101,10,'_event','add-category','','event','Add Category','admin.event.category','{\"action\":\"add\"}','{\"data-cmd\":\"modal\"}',NULL,'',NULL,1,0,'route'),
	(106,2,'_blog','manage-category','','blog','Manage Categories','admin.blog.category','[]','[]',NULL,'',NULL,1,0,'route'),
	(107,1,'_blog','manage-post','','blog','Manage Posts','admin.blog.post','{\"action\":\"index\"}','[]',NULL,'',NULL,1,0,'route'),
	(108,3,'_blog','site-setting','','blog','Site Settings','admin.blog.settings','[]','[]',NULL,'',NULL,1,0,'route'),
	(109,10,'_blog.category.buttons','add-category','','blog','Add Category','admin.blog.category','{\"action\":\"add\"}','{\"data-cmd\":\"modal\",\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(110,4,'_blog','acl-setting','','blog','User Settings','admin.blog.acl','[]','[]',NULL,'',NULL,1,0,'route'),
	(111,6,'_video','acl','','video','User Settings','admin.video.acl','[]','[]',NULL,'',NULL,1,0,'route'),
	(112,6,'_poll','acl','','poll','User Settings','admin.poll.acl','[]','[]',NULL,'',NULL,1,0,'route'),
	(113,999,NULL,'',NULL,'','',NULL,'','[]',NULL,NULL,NULL,1,0,'route'),
	(114,9,'_photo','manage-category','','photo','Categories','admin.photo.category','[]','[]',NULL,'',NULL,1,0,'route'),
	(115,5,'_photo','manage-photo','','photo','Photos','admin.photo','[]','[]',NULL,'',NULL,1,0,'route'),
	(116,6,'_photo','settings','','photo','Settings','admin.photo.settings','[]','[]',NULL,'',NULL,1,0,'route'),
	(117,10,'_photo','add-category','','photo','Add Category','admin.photo.category','{\"action\":\"add\"}','{\"data-cmd\":\"modal\"}',NULL,'',NULL,1,0,'route'),
	(118,6,'_photo','acl','','photo','User Settings','admin.photo.acl','[]','[]',NULL,'',NULL,1,0,'route'),
	(120,5,'_photo','manage-album','','photo','Albums','admin.photo','[]','[]',NULL,'',NULL,1,0,'route'),
	(121,9,'_group','manage-category','','group','Categories','admin.group.category','[]','[]',NULL,'',NULL,1,0,'route'),
	(122,5,'_group','manage-group','','group','Groups','admin.group','[]','[]',NULL,'',NULL,1,0,'route'),
	(123,6,'_group','settings','','group','Settings','admin.group.settings','[]','[]',NULL,'',NULL,1,0,'route'),
	(125,10,'_group','add-category','','group','Add Category','admin.group.category','{\"action\":\"add\"}','{\"data-cmd\":\"modal\"}',NULL,'',NULL,1,0,'route'),
	(126,6,'_group','acl','','group','User Settings','admin.group.acl','[]','[]',NULL,'',NULL,1,0,'route'),
	(127,9,'_pages','manage-category','','pages','Categories','admin.pages.category','[]','[]',NULL,'',NULL,1,0,'route'),
	(128,5,'_pages','manage-pages','','pages','Pages','admin.pages','[]','[]',NULL,'',NULL,1,0,'route'),
	(129,6,'_pages','settings','','pages','Settings','admin.pages.settings','[]','[]',NULL,'',NULL,1,0,'route'),
	(130,10,'_pages','add-category','','pages','Add Category','admin.pages.category','{\"action\":\"add\"}','{\"data-cmd\":\"modal\"}',NULL,'',NULL,1,0,'route'),
	(131,6,'_pages','acl','','pages','User Settings','admin.pages.acl','[]','[]',NULL,'',NULL,1,0,'route'),
	(132,6,'_event','acl','','event','User Settings','admin.event.acl','[]','[]',NULL,'',NULL,1,0,'route'),
	(133,4,'_core.mail','bulk-email','','core','Bulk Email','admin.core.mail.bulk','[]','[]',NULL,'',NULL,1,0,'route'),
	(135,1,'admin','all-settings','settings','core','All Settings','admin.core.settings','','[]',NULL,'',NULL,1,0,'route'),
	(144,3,'admin','core-seo','settings','core','SEO Settings','admin.core.settings.edit','{\"setting_group\":\"core_seo\"}','[]',NULL,'',NULL,1,0,'route'),
	(145,6,'admin','user-register','settings','core','Registration Settings','admin.core.settings.edit','{\"setting_group\":\"user_register\"}','[]',NULL,'',NULL,1,0,'route'),
	(146,5,'admin','user-login','settings','core','Login Settings','admin.core.settings.edit','{\"setting_group\":\"user_login\"}','[]',NULL,'',NULL,1,0,'route'),
	(147,4,'_core.i18n','manage-timezone','','core','Timezones','admin.core.i18n.timezone','[]','[]',NULL,'',NULL,1,0,'route'),
	(148,3,'_core.i18n','manage-currency','','core','Currencies','admin.core.i18n.currency','[]','[]',NULL,'',NULL,1,0,'route'),
	(149,2,'_dev','add-action','','dev','Form & Models','admin.dev.form','[]','[]',NULL,'',NULL,1,0,'route'),
	(150,1,'admin','dev','','dev','Developer Tools','admin.dev.form','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(151,1,'_core.layout.component.buttons','add-component','','core','Add Component','admin.core.layout.component','{\"action\":\"add\"}','{\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(153,1,'_core.layout.page.buttons','add-page','','core','Add Page','admin.core.layout.page','{\"action\":\"add\"}','{\"class\":\"btn btn-danger\",\"data-cmd\":\"modal\"}',NULL,'',NULL,1,0,'route'),
	(154,1,'_core.i18n.currency.buttons','add-currency','','core','Add Currency','admin.core.i18n.currency','{\"action\":\"add\"}','{\"data-cmd\":\"modal\",\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(155,1,'_core.i18n.timezone.buttons','add-timezone','','core','Add Timezone','admin.core.i18n.timezone','{\"action\":\"add\"}','{\"data-cmd\":\"modal\",\"class\":\"btn btn-danger dev-only\"}',NULL,'',NULL,1,0,'route'),
	(156,1,'_core.i18n.locale.buttons','add-locale','','core','Add Locale','admin.core.i18n.locale','{\"action\":\"add\"}','{\"data-cmd\":\"modal\",\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(260,999,'admin','blogs','manage','blog','Blogs','admin.blog.post','{\"action\":\"index\"}','[]',NULL,NULL,NULL,1,0,'route'),
	(262,999,'admin','polls','manage','poll','Polls','admin.poll.poll','{\"action\":\"index\"}','[]',NULL,NULL,NULL,1,0,'route'),
	(263,999,'admin','videos','manage','video','Videos','admin.video.video','{\"action\":\"index\"}','[]',NULL,NULL,NULL,1,0,'route'),
	(264,999,'admin','photos','manage','photo','Photos','admin.photo.photo','{\"action\":\"index\"}','[]',NULL,NULL,NULL,1,0,'route'),
	(265,999,'admin','quizzes','manage','quiz','Quizzes','admin.quiz.quiz','{\"action\":\"index\"}','[]',NULL,NULL,NULL,1,0,'route'),
	(266,999,'admin','marketplaces','manage','marketplace','Marketplaces','admin.marketplace.listing','{\"action\":\"index\"}','[]',NULL,NULL,NULL,1,0,'route'),
	(267,999,'admin','groups','manage','group','Groups','admin.group.group','{\"action\":\"index\"}','[]',NULL,NULL,NULL,1,0,'route'),
	(268,999,'admin','forum','manage','forum','Forums','admin.forum.forum','{\"action\":\"index\"}','[]',NULL,NULL,NULL,1,0,'route'),
	(269,999,'admin','event','manage','event','Events','admin.event.event','{\"action\":\"index\"}','[]',NULL,NULL,NULL,1,0,'route'),
	(270,999,'admin','contacts','manage','contact','Contacts','admin.contact.department','{\"action\":\"index\"}','[]',NULL,NULL,NULL,1,0,'route'),
	(272,999,'admin','announcement','manage','announcement','Announcements','admin.announcement.post','{\"action\":\"index\"}','[]',NULL,NULL,NULL,1,0,'route'),
	(273,2,'_core.storage','manage-storage','','core','Manage Storage','admin.core.storage','[]','[]',NULL,'',NULL,1,0,'route'),
	(274,1,'_core.storage.buttons','add-storage','','core','Add Storage','admin.core.storage','{\"action\":\"add\"}','{\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(278,1,'_core.mail','manage-adapter','','core','Mail Transports','admin.core.mail.adapter','[]','[]',NULL,'',NULL,1,0,'route'),
	(279,999,NULL,'',NULL,'','',NULL,'','[]',NULL,NULL,NULL,1,0,'route'),
	(280,4,'_core.i18n','settings','settings','core','Settings','admin.core.i18n.settings','','[]',NULL,'',NULL,1,0,'route'),
	(281,1,'_core.storage','settings','','core','Settings','admin.core.storage','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(282,5,'admin','cache','settings','core','Cache Settings','admin.core.cache','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(283,5,'admin','log','settings','core','Log Settings','admin.core.log','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(284,3,'_core.cache','settings','','core','Manage Settings','admin.core.cache','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(285,3,'_core.cache','manage-adapter','','core','Manage Caches','admin.core.cache','[]','[]',NULL,'',NULL,1,0,'route'),
	(287,3,'_core.cache.buttons','add-adapter','','core','Add Cache','admin.core.cache','{\"action\":\"add\"}','{\"class\":\"btn btn-danger\",\"data-cmd\":\"modal\"}',NULL,'',NULL,1,0,'route'),
	(288,3,'_core.log','settings','','core','Settings','admin.core.log','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(290,3,'_core.log','manage-adapter','','core','Log Containers','admin.core.log','[]','[]',NULL,'',NULL,1,0,'route'),
	(293,1,'_dev.buttons','scan','','dev','Scan Tables','admin.dev.form','{\"action\":\"scan\"}','{\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(294,1,'_dev','dev','','dev','Settings','admin.dev.form','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(296,1,'_core.mail.buttons','add-adapter','','core','Add Transport','admin.core.mail.adapter','{\"action\":\"add\"}','{\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(297,2,'_core.acl','settings','','core','Manage Settings','admin.core.acl','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(298,2,'_core.captcha','manage-adapter','','core','Manage Captchas','admin.core.captcha','[]','[]',NULL,'',NULL,1,0,'route'),
	(299,1,'_core.captcha','settings','','core','Captcha Settings','admin.core.captcha','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(300,3,'_core.captcha.buttons','add-adapter','','core','Add Captcha','admin.core.captcha','{\"action\":\"add\"}','{\"class\":\"btn btn-danger\",\"data-cmd\":\"modal\",\"data-size\":\"md\"}',NULL,'',NULL,1,0,'route'),
	(301,5,'admin','captcha','settings','core','Captcha Settings','admin.core.captcha','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(302,5,'admin','sms','settings','core','SMS Settings','admin.core.sms','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(303,3,'_core.sms.buttons','add-adapter','','core','More Services','admin.core.sms','{\"action\":\"add\"}','{\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(304,3,'_core.sms','settings','','core','Service Settings','admin.core.sms','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(305,3,'_core.sms','manage-adapter','','core','Manage Services','admin.core.sms','[]','[]',NULL,'',NULL,1,0,'route'),
	(306,2,'_core.session','manage-adapter','','core','Manage Sessions','admin.core.session','[]','[]',NULL,'',NULL,1,0,'route'),
	(307,1,'_core.session','settings','','core','Settings','admin.core.session','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(308,3,'_core.session.buttons','add-adapter','','core','Add Sessions','admin.core.session','{\"action\":\"add\"}','{\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(310,5,'admin','session','settings','core','Session &amp; Cookies','admin.core.session','{\"action\":\"settings\"}','[]',NULL,'',NULL,1,0,'route'),
	(316,1,'_dev','manage-table','','dev','Tables','admin.dev.table','[]','[]',NULL,'',NULL,1,0,'route'),
	(317,1,'_dev.table.buttons','add-table','','dev','Add Table','admin.dev.table','{\"action\":\"add\"}','{\"class\":\"btn btn-danger\"}',NULL,'',NULL,1,0,'route'),
	(318,1,'_dev','_models','','dev','Models','admin.dev.model','[]','[]',NULL,'',NULL,1,0,'route'),
	(319,1,'_core.package','packages','','core','Manage Packages','admin.core.package','','[]',NULL,'',NULL,1,0,'route'),
	(320,1,'_core.package.buttons','add-package','','core','+ Import','admin.core.package','{\"action\":\"upload\"}','{\"class\":\"btn btn-info\",\"data-cmd\":\"modal\"}',NULL,'',NULL,1,0,'route'),
	(322,1,'_core.package.buttons','explorer','','core','More Packages','admin.core.package','{\"action\":\"explorer\"}','{\"class\":\"btn btn-success\",\"target\":\"_blank\",\"href\":\"https://store.phpfox.com/\"}',NULL,'',NULL,1,0,'route');

/*!40000 ALTER TABLE `pf5_core_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_core_package
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_core_package`;

CREATE TABLE `pf5_core_package` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` enum('library','app','theme','language') NOT NULL DEFAULT 'app',
  `is_required` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `theme_id` varchar(50) DEFAULT '',
  `priority` tinyint(11) unsigned DEFAULT '1',
  `title` varchar(250) DEFAULT NULL,
  `version` varchar(32) NOT NULL DEFAULT '4.0.1',
  `latest_version` varchar(32) DEFAULT NULL,
  `author` varchar(255) NOT NULL DEFAULT 'n/a',
  `description` text,
  `apps_icon` varchar(255) DEFAULT '',
  `name` varchar(32) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pf5_core_package` WRITE;
/*!40000 ALTER TABLE `pf5_core_package` DISABLE KEYS */;

INSERT INTO `pf5_core_package` (`id`, `type_id`, `is_required`, `is_active`, `theme_id`, `priority`, `title`, `version`, `latest_version`, `author`, `description`, `apps_icon`, `name`, `path`)
VALUES
	(1,'app',1,1,NULL,200,'Core','5.0.1',NULL,'phpFox',NULL,'','core','package/core'),
	(2,'app',1,1,NULL,201,'Members','5.0.1',NULL,'phpFox',NULL,'','user','package/user'),
	(4,'app',1,1,NULL,202,'Messages','5.0.1',NULL,'phpFox',NULL,'','message','package/messages'),
	(5,'app',0,0,NULL,203,'Blogs','5.0.1',NULL,'phpFox',NULL,'','blog','package/blog'),
	(7,'theme',0,0,'galaxy',204,'Theme Galaxy','5.0.1',NULL,'phpFox',NULL,'','theme-galaxy','package/theme-galaxy'),
	(8,'app',0,1,NULL,205,'Pages','5.0.1',NULL,'phpFox',NULL,'','pages','package/pages'),
	(10,'app',0,0,NULL,206,'Groups','5.0.1',NULL,'phpFox',NULL,'','groups','package/group'),
	(11,'app',0,1,NULL,207,'Events','5.0.1',NULL,'phpFox',NULL,'','events','package/event'),
	(12,'app',0,0,NULL,208,'Photos','5.0.1',NULL,'phpFox',NULL,'','photos','package/photo'),
	(13,'app',0,1,NULL,209,'Videos','5.0.1',NULL,'phpFox',NULL,'','videos','package/video'),
	(14,'theme',0,0,'default',210,'Theme Default','5.0.1',NULL,'phpFox',NULL,'','theme-default','package/theme-default'),
	(15,'app',0,1,'',211,'Contact Us','5.0.1',NULL,'phpFox',NULL,'','contact','package/contact'),
	(16,'app',0,1,'',212,'Reports','5.0.1',NULL,'phpFox',NULL,'','report','package/report'),
	(17,'app',0,1,'',213,'Announcements','5.0.1',NULL,'phpFox',NULL,'','announcement','package/announcement'),
	(19,'app',0,1,'',214,'Friendship','5.0.1',NULL,'phpFox',NULL,'','friend','package/friend'),
	(20,'app',0,1,'',215,'Likes','5.0.1',NULL,'phpFox',NULL,'','like','package/like'),
	(21,'app',0,0,'',216,'Comment','5.0.1',NULL,'phpFox',NULL,'','comment','package/comment'),
	(22,'app',0,0,'',217,'Share','5.0.1',NULL,'phpFox',NULL,'','share','package/share'),
	(23,'app',0,1,'',218,'Activity','5.0.1',NULL,'phpFox',NULL,'','activity','package/activity'),
	(24,'app',0,1,'',219,'Notifications','5.0.1',NULL,'phpFox',NULL,'','notification','package/notification'),
	(25,'app',0,1,'',220,'Requests','5.0.1',NULL,'phpFox',NULL,'','request','package/request'),
	(26,'app',0,1,'',221,'Poll','5.0.1',NULL,'phpFox',NULL,'','poll','package/poll'),
	(27,'app',0,1,'',222,'Quiz','5.0.1',NULL,'phpFox',NULL,'','quiz','package/quiz'),
	(28,'app',0,1,'',223,'Marketplace','5.0.1',NULL,'phpFox',NULL,'','marketplace','package/marketplace'),
	(29,'app',0,1,'',224,'Invite','5.0.1',NULL,'phpFox',NULL,'','invite','package/invite'),
	(30,'app',0,1,'',225,'Subscribe','5.0.1',NULL,'phpFox',NULL,'','subscribe','package/subscribe'),
	(31,'app',0,1,'',226,'Forum','5.0.1',NULL,'phpFox',NULL,'','forum','package/forum'),
	(32,'app',0,1,'',227,'Links','5.0.1',NULL,'phpFox',NULL,'','link','package/link'),
	(33,'app',0,1,'',228,'Development Tools','5.0.1',NULL,'phpFox',NULL,'','dev','package/dev'),
	(36,'library',1,1,'',3,'Authentication Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-auth','library/phpfox-auth'),
	(38,'library',1,1,'',5,'Caching Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-cache','library/phpfox-cache'),
	(40,'library',1,1,'',7,'Database Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-db','library/phpfox-db'),
	(41,'library',1,1,'',8,'Errors Handler Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-errors','library/phpfox-errors'),
	(43,'library',1,1,'',10,'International Support Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-i18n','library/phpfox-i18n'),
	(44,'library',1,1,'',11,'Message Queue Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-jobs','library/phpfox-jobs'),
	(45,'library',1,1,'',12,'Log Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-logger','library/phpfox-logger'),
	(46,'library',1,1,'',13,'Mail Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-mailer','library/phpfox-mailer'),
	(47,'library',1,1,'',14,'Models Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-models','library/phpfox-models'),
	(48,'library',1,1,'',15,'MySQLi Support Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-mysqli','library/phpfox-mysqli'),
	(49,'library',1,1,'',16,'Navigation Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-navigation','library/phpfox-navigation'),
	(50,'library',1,1,'',17,'Package Control Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-packages','library/phpfox-packages'),
	(51,'library',1,1,'',18,'Pagination Libarary','5.0.1',NULL,'phpFox',NULL,'','phpfox-pagination','library/phpfox-paging'),
	(52,'library',1,1,'',19,'Payment Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-payments','library/phpfox-payments'),
	(53,'library',1,1,'',20,'Push Notification Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-realm','library/phpfox-realm'),
	(54,'library',1,1,'',21,'Routing Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-routing','library/phpfox-routing'),
	(55,'library',1,1,'',22,'Session Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-session','library/phpfox-session'),
	(56,'library',1,1,'',23,'Storage Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-storage','library/phpfox-storage'),
	(57,'library',1,1,'',24,'Core Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-kernel','library/phpfox-support'),
	(58,'library',1,1,'',25,'Validae Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-validate','library/phpfox-validate'),
	(59,'library',1,1,'',26,'View/Template Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-view','library/phpfox-view'),
	(60,'app',0,1,'',229,'Layout Library','5.0.1',NULL,'phpFox',NULL,'','layouts','library/phpfox-layouts'),
	(62,'library',1,1,'',28,'Log Library','5.0.1',NULL,'phpFox',NULL,'','phpfox-form','library/phpfox-form');

/*!40000 ALTER TABLE `pf5_core_package` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_core_permission
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_core_permission`;

CREATE TABLE `pf5_core_permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `group_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `action_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `params` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_dev_action
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_dev_action`;

CREATE TABLE `pf5_dev_action` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_type` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_id` enum('default','skip','delete','create') COLLATE utf8_unicode_ci DEFAULT 'skip',
  `text_domain` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_info` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_submit` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancel_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'c',
  `action_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_domain` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info_domain` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `submit_label` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_enctype` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'multipart/form-data',
  `form_method` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'post',
  PRIMARY KEY (`meta_id`),
  UNIQUE KEY `table_name` (`table_name`,`action_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_dev_action` WRITE;
/*!40000 ALTER TABLE `pf5_dev_action` DISABLE KEYS */;

INSERT INTO `pf5_dev_action` (`meta_id`, `package_id`, `table_name`, `action_type`, `action_id`, `text_domain`, `form_title`, `form_info`, `data_submit`, `cancel_url`, `action_url`, `title_domain`, `info_domain`, `submit_label`, `form_enctype`, `form_method`)
VALUES
	(10,'core','acl_level','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(11,'core','acl_action','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(13,'core','acl_value','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(14,'undefined','activity_action','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(15,'undefined','activity_hide','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(16,'undefined','activity_setting','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(17,'undefined','activity_stream','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(18,'undefined','activity_type','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(19,'undefined','activity_wall','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(20,'announcement','announcement','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(21,'announcement','announcement_exclude','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(23,'user','auth_history','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(24,'user','auth_log','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(25,'user','auth_password','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(26,'user','auth_remote','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(27,'user','auth_token','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(28,'blog','blog_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(29,'blog','blog_post','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(32,'undefined','comment','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(33,'contact','contact_department','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(34,'core','core_event','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(36,'core','core_job_log','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(37,'core','core_job_message','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(38,'core','core_log','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(39,'core','core_menu','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(40,'core','core_package','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(41,'core','core_permission','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(43,'event','event','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(44,'event','event_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(45,'event','event_member','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(46,'event','event_member_item','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(47,'event','event_member_list','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(48,'event','event_member_request','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(49,'friend','friend','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(50,'friend','friend_forward','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(51,'friend','friend_item','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(52,'friend','friend_list','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(53,'friend','friend_request','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(54,'group','group','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(55,'group','group_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(56,'group','group_member','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(57,'group','group_member_item','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(58,'group','group_member_list','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(59,'group','group_member_request','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(60,'core','i18n_currency','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(61,'core','i18n_locale','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(62,'core','i18n_message','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(63,'core','i18n_timezone','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(64,'invite','invite','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(65,'core','layout_action','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(66,'core','layout_block','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(67,'core','layout_component','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(68,'core','layout_container','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(69,'core','layout_grid','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(70,'core','layout_location','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(71,'core','layout_page','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(72,'core','layout_theme','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(73,'core','layout_theme_params','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(74,'like','like','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(75,'link','link','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(76,'core','log_adapter','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(80,'core','mail_template','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(81,'marketplace','marketplace_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(82,'undefined','messages','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(83,'undefined','notification','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(84,'undefined','notification_setting','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(85,'undefined','notification_type','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(86,'pages','pages','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(87,'pages','pages_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(88,'pages','pages_member','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(89,'pages','pages_member_item','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(90,'pages','pages_member_list','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(91,'pages','pages_member_request','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(92,'photo','photo','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(93,'photo','photo_album','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(94,'photo','photo_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(95,'poll','poll_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(96,'undefined','privacy','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(97,'quiz','quiz_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(100,'report','report_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(101,'report','report_item','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(102,'undefined','request','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(103,'undefined','request_setting','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(104,'undefined','request_type','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(105,'core','session','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(108,'core','setting_value','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(109,'core','storage_adapter','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(111,'core','storage_file','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(112,'undefined','subject','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(113,'user','user','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(114,'user','user_verify_token','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(115,'video','video','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(116,'video','video_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(117,'video','video_channel','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(118,'video','video_provider','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(120,'core','acl_level','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(121,'core','acl_action','admin_edit','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(123,'core','acl_value','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(124,'undefined','activity_action','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(125,'undefined','activity_hide','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(126,'undefined','activity_setting','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(127,'undefined','activity_stream','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(128,'undefined','activity_type','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(129,'undefined','activity_wall','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(130,'announcement','announcement','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(131,'announcement','announcement_exclude','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(133,'user','auth_history','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(134,'user','auth_log','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(135,'user','auth_password','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(136,'user','auth_remote','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(137,'user','auth_token','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(138,'blog','blog_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(139,'blog','blog_post','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(142,'undefined','comment','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(143,'contact','contact_department','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(144,'core','core_event','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(146,'core','core_job_log','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(147,'core','core_job_message','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(148,'core','core_log','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(149,'core','core_menu','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(150,'core','core_package','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(151,'core','core_permission','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(153,'event','event','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(154,'event','event_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(155,'event','event_member','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(156,'event','event_member_item','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(157,'event','event_member_list','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(158,'event','event_member_request','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(159,'friend','friend','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(160,'friend','friend_forward','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(161,'friend','friend_item','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(162,'friend','friend_list','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(163,'friend','friend_request','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(164,'group','group','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(165,'group','group_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(166,'group','group_member','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(167,'group','group_member_item','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(168,'group','group_member_list','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(169,'group','group_member_request','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(170,'core','i18n_currency','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(171,'core','i18n_locale','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(172,'core','i18n_message','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(173,'core','i18n_timezone','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(174,'invite','invite','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(175,'core','layout_action','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(176,'core','layout_block','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(177,'core','layout_component','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(178,'core','layout_container','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(179,'core','layout_grid','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(180,'core','layout_location','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(181,'core','layout_page','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(182,'core','layout_theme','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(183,'core','layout_theme_params','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(184,'like','like','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(185,'link','link','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(186,'core','log_adapter','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(190,'core','mail_template','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(191,'marketplace','marketplace_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(192,'undefined','messages','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(193,'undefined','notification','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(194,'undefined','notification_setting','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(195,'undefined','notification_type','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(196,'pages','pages','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(197,'pages','pages_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(198,'pages','pages_member','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(199,'pages','pages_member_item','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(200,'pages','pages_member_list','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(201,'pages','pages_member_request','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(202,'photo','photo','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(203,'photo','photo_album','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(204,'photo','photo_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(205,'poll','poll_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(206,'undefined','privacy','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(207,'quiz','quiz_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(210,'report','report_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(211,'report','report_item','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(212,'undefined','request','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(213,'undefined','request_setting','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(214,'undefined','request_type','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(215,'core','session','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(218,'core','setting_value','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(219,'core','storage_adapter','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(221,'core','storage_file','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(222,'undefined','subject','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(223,'user','user','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(224,'user','user_verify_token','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(225,'video','video','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(226,'video','video_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(227,'video','video_channel','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(228,'video','video_provider','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(230,'core','acl_level','admin_delete','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(231,'core','acl_action','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(233,'core','acl_value','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(234,'undefined','activity_action','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(235,'undefined','activity_hide','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(236,'undefined','activity_setting','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(237,'undefined','activity_stream','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(238,'undefined','activity_type','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(239,'undefined','activity_wall','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(240,'announcement','announcement','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(241,'announcement','announcement_exclude','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(243,'user','auth_history','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(244,'user','auth_log','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(245,'user','auth_password','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(246,'user','auth_remote','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(247,'user','auth_token','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(248,'blog','blog_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(249,'blog','blog_post','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(252,'undefined','comment','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(253,'contact','contact_department','admin_delete','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(254,'core','core_event','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(256,'core','core_job_log','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(257,'core','core_job_message','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(258,'core','core_log','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(259,'core','core_menu','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(260,'core','core_package','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(261,'core','core_permission','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(263,'event','event','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(264,'event','event_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(265,'event','event_member','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(266,'event','event_member_item','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(267,'event','event_member_list','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(268,'event','event_member_request','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(269,'friend','friend','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(270,'friend','friend_forward','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(271,'friend','friend_item','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(272,'friend','friend_list','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(273,'friend','friend_request','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(274,'group','group','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(275,'group','group_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(276,'group','group_member','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(277,'group','group_member_item','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(278,'group','group_member_list','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(279,'group','group_member_request','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(280,'core','i18n_currency','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(281,'core','i18n_locale','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(282,'core','i18n_message','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(283,'core','i18n_timezone','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(284,'invite','invite','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(285,'core','layout_action','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(286,'core','layout_block','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(287,'core','layout_component','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(288,'core','layout_container','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(289,'core','layout_grid','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(290,'core','layout_location','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(291,'core','layout_page','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(292,'core','layout_theme','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(293,'core','layout_theme_params','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(294,'like','like','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(295,'link','link','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(296,'core','log_adapter','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(300,'core','mail_template','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(301,'marketplace','marketplace_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(302,'undefined','messages','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(303,'undefined','notification','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(304,'undefined','notification_setting','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(305,'undefined','notification_type','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(306,'pages','pages','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(307,'pages','pages_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(308,'pages','pages_member','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(309,'pages','pages_member_item','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(310,'pages','pages_member_list','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(311,'pages','pages_member_request','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(312,'photo','photo','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(313,'photo','photo_album','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(314,'photo','photo_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(315,'poll','poll_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(316,'undefined','privacy','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(317,'quiz','quiz_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(320,'report','report_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(321,'report','report_item','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(322,'undefined','request','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(323,'undefined','request_setting','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(324,'undefined','request_type','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(325,'core','session','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(328,'core','setting_value','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(329,'core','storage_adapter','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(331,'core','storage_file','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(332,'undefined','subject','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(333,'user','user','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(334,'user','user_verify_token','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(335,'video','video','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(336,'video','video_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(337,'video','video_channel','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(338,'video','video_provider','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(340,'core','acl_level','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(341,'core','acl_action','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(343,'core','acl_value','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(344,'undefined','activity_action','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(345,'undefined','activity_hide','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(346,'undefined','activity_setting','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(347,'undefined','activity_stream','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(348,'undefined','activity_type','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(349,'undefined','activity_wall','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(350,'announcement','announcement','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(351,'announcement','announcement_exclude','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(353,'user','auth_history','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(354,'user','auth_log','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(355,'user','auth_password','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(356,'user','auth_remote','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(357,'user','auth_token','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(358,'blog','blog_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(359,'blog','blog_post','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(362,'undefined','comment','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(363,'contact','contact_department','admin_filter','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(364,'core','core_event','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(366,'core','core_job_log','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(367,'core','core_job_message','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(368,'core','core_log','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(369,'core','core_menu','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(370,'core','core_package','admin_filter','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(371,'core','core_permission','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(373,'event','event','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(374,'event','event_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(375,'event','event_member','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(376,'event','event_member_item','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(377,'event','event_member_list','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(378,'event','event_member_request','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(379,'friend','friend','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(380,'friend','friend_forward','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(381,'friend','friend_item','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(382,'friend','friend_list','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(383,'friend','friend_request','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(384,'group','group','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(385,'group','group_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(386,'group','group_member','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(387,'group','group_member_item','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(388,'group','group_member_list','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(389,'group','group_member_request','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(390,'core','i18n_currency','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(391,'core','i18n_locale','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(392,'core','i18n_message','admin_filter','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(393,'core','i18n_timezone','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(394,'invite','invite','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(395,'core','layout_action','admin_filter','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(396,'core','layout_block','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(397,'core','layout_component','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(398,'core','layout_container','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(399,'core','layout_grid','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(400,'core','layout_location','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(401,'core','layout_page','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(402,'core','layout_theme','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(403,'core','layout_theme_params','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(404,'like','like','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(405,'link','link','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(406,'core','log_adapter','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(410,'core','mail_template','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(411,'marketplace','marketplace_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(412,'undefined','messages','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(413,'undefined','notification','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(414,'undefined','notification_setting','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(415,'undefined','notification_type','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(416,'pages','pages','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(417,'pages','pages_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(418,'pages','pages_member','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(419,'pages','pages_member_item','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(420,'pages','pages_member_list','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(421,'pages','pages_member_request','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(422,'photo','photo','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(423,'photo','photo_album','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(424,'photo','photo_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(425,'poll','poll_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(426,'undefined','privacy','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(427,'quiz','quiz_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(430,'report','report_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(431,'report','report_item','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(432,'undefined','request','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(433,'undefined','request_setting','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(434,'undefined','request_type','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(435,'core','session','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(438,'core','setting_value','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(439,'core','storage_adapter','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(441,'core','storage_file','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(442,'undefined','subject','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(443,'user','user','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(444,'user','user_verify_token','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(445,'video','video','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(446,'video','video_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(447,'video','video_channel','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(448,'video','video_provider','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(450,'core','acl_level','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(451,'core','acl_action','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(453,'core','acl_value','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(456,'core','core_event','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(458,'core','core_job_log','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(459,'core','core_job_message','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(460,'core','core_log','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(461,'core','core_menu','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(462,'core','core_package','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(463,'core','core_permission','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(465,'core','i18n_currency','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(466,'core','i18n_locale','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(467,'core','i18n_message','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(468,'core','i18n_timezone','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(469,'core','log_adapter','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(473,'core','mail_template','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(475,'core','setting_value','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(476,'core','storage_adapter','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(478,'core','storage_file','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(487,'undefined','activity_action','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(488,'undefined','activity_hide','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(489,'undefined','activity_setting','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(490,'undefined','activity_stream','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(491,'undefined','activity_type','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(492,'undefined','activity_wall','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(493,'announcement','announcement','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(494,'announcement','announcement_exclude','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(496,'user','auth_history','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(497,'user','auth_log','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(498,'user','auth_password','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(499,'user','auth_remote','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(500,'user','auth_token','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(501,'blog','blog_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(502,'blog','blog_post','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(503,'undefined','comment','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(504,'contact','contact_department','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(507,'event','event','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(508,'event','event_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(509,'event','event_member','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(510,'event','event_member_item','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(511,'event','event_member_list','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(512,'event','event_member_request','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(513,'friend','friend','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(514,'friend','friend_forward','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(515,'friend','friend_item','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(516,'friend','friend_list','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(517,'friend','friend_request','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(518,'group','group','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(519,'group','group_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(520,'group','group_member','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(521,'group','group_member_item','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(522,'group','group_member_list','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(523,'group','group_member_request','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(524,'invite','invite','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(525,'core','layout_action','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(526,'core','layout_block','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(527,'core','layout_component','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(528,'core','layout_container','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(529,'core','layout_grid','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(530,'core','layout_location','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(531,'core','layout_page','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(532,'core','layout_theme','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(533,'core','layout_theme_params','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(534,'like','like','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(535,'link','link','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(536,'marketplace','marketplace_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(537,'undefined','messages','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(538,'undefined','notification','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(539,'undefined','notification_setting','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(540,'undefined','notification_type','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(541,'pages','pages','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(542,'pages','pages_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(543,'pages','pages_member','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(544,'pages','pages_member_item','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(545,'pages','pages_member_list','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(546,'pages','pages_member_request','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(547,'photo','photo','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(548,'photo','photo_album','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(549,'photo','photo_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(550,'poll','poll_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(551,'undefined','privacy','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(552,'quiz','quiz_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(553,'report','report_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(554,'report','report_item','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(555,'undefined','request','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(556,'undefined','request_setting','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(557,'undefined','request_type','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(558,'core','session','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(560,'undefined','subject','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(561,'user','user','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(562,'user','user_verify_token','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(563,'video','video','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(564,'video','video_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(565,'video','video_channel','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(566,'video','video_provider','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(570,'dev','dev_action','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(571,'dev','dev_element','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(572,'dev','dev_table','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(573,'dev','dev_action','admin_edit','create','_dev.edit_action','Edit Dev Action','',NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(574,'dev','dev_element','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(575,'dev','dev_table','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(576,'dev','dev_action','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(577,'dev','dev_element','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(578,'dev','dev_table','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(579,'dev','dev_action','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(580,'dev','dev_element','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(581,'dev','dev_table','admin_filter','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(582,'dev','dev_action','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(583,'dev','dev_element','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(584,'dev','dev_table','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(621,'core','core_driver','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(622,'core','core_driver','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(623,'core','core_driver','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(624,'core','core_driver','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(625,'core','core_driver','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(626,'core','core_adapter','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(628,'core','core_adapter','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(630,'core','core_adapter','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(632,'core','core_adapter','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(634,'core','core_adapter','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(637,'core','setting_form','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(638,'core','setting_form','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(639,'core','setting_form','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(640,'core','setting_form','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(641,'core','setting_form','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(662,'blog','blog','admin_site_settings','skip','_blog.settings','Edit Blog Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(664,'core','core_cache','admin_site_settings','create','_core.cache_settings','Edit Cache Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(665,'core','core_captcha','admin_site_settings','create','_core.captcha','Edit Captcha Settings','[Edit Captcha Settings Info]',NULL,'admin.core.captcha',NULL,NULL,'_core','Save Changes','','post'),
	(666,'core','core_i18n','admin_site_settings','create','_core.i18n_settings','Edit International Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(667,'core','core_license','admin_site_settings','create','_core.license_settings','Edit License Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(668,'core','core_log','admin_site_settings','create','_core.logs','Edit Log Settings','[Edit Site Settings Info]',NULL,'admin.core.log',NULL,NULL,'_core','Save Changes','','post'),
	(669,'core','core_mail','admin_site_settings','create','_core.mail_settings','Edit Mail Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(670,'core','core_seo','admin_site_settings','create','_core.seo_settings','Edit SEO Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(671,'core','core_storage','admin_site_settings','create','_core.storage','Edit Storage Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(672,'core','core_sms','admin_site_settings','create','_core.sms','Edit SMS Service Settings','[Edit Site Settings Info]',NULL,'admin.core.sms',NULL,NULL,'_core','Save Changes','','post'),
	(673,'dev','dev','admin_site_settings','skip','_dev.settings','Edit Development Tool Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(674,'user','user_login','admin_site_settings','skip','_user.login_setting','Edit User Login Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(675,'user','user_register','admin_site_settings','create','_user.register','Edit Registration Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(676,'core','core_general','admin_acl_settings','create','admin.core_acl',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(677,'core','core_session','admin_site_settings','create','_core.session','Edit Session Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(679,'core','core_message','admin_site_settings','create','_core.message_settings','Edit Message Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(680,'dev','dev_form','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(681,'dev','dev_model','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(682,'dev','dev_form','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(683,'dev','dev_model','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(684,'dev','dev_form','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(685,'dev','dev_model','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(686,'dev','dev_form','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(687,'dev','dev_model','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(688,'dev','dev_form','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(689,'dev','dev_model','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post'),
	(690,'core','core_general','admin_site_settings','create','_core.general_settings','Edit General Settings','[Edit Site Settings Info]',NULL,NULL,NULL,NULL,'_core','Save Changes','','post'),
	(691,'core','acl_form','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','post');

/*!40000 ALTER TABLE `pf5_dev_action` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_dev_element
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_dev_element`;

CREATE TABLE `pf5_dev_element` (
  `element_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `element_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `factory_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_require` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ordering` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `default_value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `has_note` tinyint(1) unsigned DEFAULT '0',
  `note_domain` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `has_info` tinyint(1) unsigned DEFAULT '0',
  `info_domain` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_domain` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `placeholder` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `max_length` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rows` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cols` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_readonly` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `class_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `is_primary` tinyint(1) unsigned DEFAULT '0',
  `is_identity` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `data_cmd` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `meta_id` int(11) NOT NULL,
  `primary_length` tinyint(4) unsigned DEFAULT '0',
  `options_text` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`element_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_dev_element` WRITE;
/*!40000 ALTER TABLE `pf5_dev_element` DISABLE KEYS */;

INSERT INTO `pf5_dev_element` (`element_id`, `element_name`, `factory_id`, `is_require`, `label`, `ordering`, `is_active`, `default_value`, `note`, `has_note`, `note_domain`, `info`, `has_info`, `info_domain`, `text_domain`, `placeholder`, `max_length`, `rows`, `cols`, `is_readonly`, `is_disabled`, `class_name`, `is_primary`, `is_identity`, `data_cmd`, `meta_id`, `primary_length`, `options_text`)
VALUES
	(15,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',9,1,NULL),
	(16,'resource_type','text',0,'Resource Type',8,1,'','[Resource Type Note]',0,NULL,'[Resource Type Info]',0,NULL,NULL,'Resource Type',NULL,NULL,NULL,0,0,'',0,0,'',9,1,NULL),
	(17,'resource_id','text',0,'Resource Id',9,1,'','[Resource Id Note]',0,NULL,'[Resource Id Info]',0,NULL,NULL,'Resource Id',NULL,NULL,NULL,0,0,'',0,0,'',9,1,NULL),
	(18,'role_id','text',1,'Role Id',10,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',9,1,NULL),
	(19,'action_id','text',1,'Action Id',11,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',9,1,NULL),
	(20,'value_id','text',1,'Value Id',12,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',0,0,'',9,1,NULL),
	(21,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',229,1,NULL),
	(22,'resource_type','text',0,'Resource Type',8,1,'','[Resource Type Note]',0,NULL,'[Resource Type Info]',0,NULL,NULL,'Resource Type',NULL,NULL,NULL,0,0,'',0,0,'',229,1,NULL),
	(23,'resource_id','text',0,'Resource Id',9,1,'','[Resource Id Note]',0,NULL,'[Resource Id Info]',0,NULL,NULL,'Resource Id',NULL,NULL,NULL,0,0,'',0,0,'',229,1,NULL),
	(24,'role_id','text',1,'Role Id',10,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',229,1,NULL),
	(25,'action_id','text',1,'Action Id',11,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',229,1,NULL),
	(26,'value_id','text',1,'Value Id',12,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',0,0,'',229,1,NULL),
	(27,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',119,1,NULL),
	(28,'resource_type','text',0,'Resource Type',8,1,'','[Resource Type Note]',0,NULL,'[Resource Type Info]',0,NULL,NULL,'Resource Type',NULL,NULL,NULL,0,0,'',0,0,'',119,1,NULL),
	(29,'resource_id','text',0,'Resource Id',9,1,'','[Resource Id Note]',0,NULL,'[Resource Id Info]',0,NULL,NULL,'Resource Id',NULL,NULL,NULL,0,0,'',0,0,'',119,1,NULL),
	(30,'role_id','text',1,'Role Id',10,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',119,1,NULL),
	(31,'action_id','text',1,'Action Id',11,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',119,1,NULL),
	(32,'value_id','text',1,'Value Id',12,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',0,0,'',119,1,NULL),
	(33,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',339,1,NULL),
	(34,'resource_type','text',0,'Resource Type',8,1,'','[Resource Type Note]',0,NULL,'[Resource Type Info]',0,NULL,NULL,'Resource Type',NULL,NULL,NULL,0,0,'',0,0,'',339,1,NULL),
	(35,'resource_id','text',0,'Resource Id',9,1,'','[Resource Id Note]',0,NULL,'[Resource Id Info]',0,NULL,NULL,'Resource Id',NULL,NULL,NULL,0,0,'',0,0,'',339,1,NULL),
	(36,'role_id','text',1,'Role Id',10,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',339,1,NULL),
	(37,'action_id','text',1,'Action Id',11,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',339,1,NULL),
	(38,'value_id','text',1,'Value Id',12,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',0,0,'',339,1,NULL),
	(39,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',449,1,NULL),
	(40,'resource_type','text',0,'Resource Type',8,1,'','[Resource Type Note]',0,NULL,'[Resource Type Info]',0,NULL,NULL,'Resource Type',NULL,NULL,NULL,0,0,'',0,0,'',449,1,NULL),
	(41,'resource_id','text',0,'Resource Id',9,1,'','[Resource Id Note]',0,NULL,'[Resource Id Info]',0,NULL,NULL,'Resource Id',NULL,NULL,NULL,0,0,'',0,0,'',449,1,NULL),
	(42,'role_id','text',1,'Role Id',10,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',449,1,NULL),
	(43,'action_id','text',1,'Action Id',11,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',449,1,NULL),
	(44,'value_id','text',1,'Value Id',12,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',0,0,'',449,1,NULL),
	(45,'role_id','text',1,'Role Id',13,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',1,1,'',10,1,NULL),
	(46,'inherit_id','text',1,'Inherit Id',14,1,'0','[Inherit Id Note]',0,NULL,'[Inherit Id Info]',0,NULL,NULL,'Inherit Id',NULL,NULL,NULL,0,0,'',0,0,'',10,1,NULL),
	(47,'title','text',1,'Title',15,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',10,1,NULL),
	(48,'item_count','text',1,'Item Count',16,0,'0','[Item Count Note]',0,NULL,'[Item Count Info]',0,NULL,NULL,'Item Count',NULL,NULL,NULL,0,0,'',0,0,'',10,1,NULL),
	(49,'is_special','yesno',1,'Is Special',17,1,'0','[Is Special Note]',0,NULL,'[Is Special Info]',0,NULL,NULL,'Is Special',NULL,NULL,NULL,0,0,'',0,0,'',10,1,NULL),
	(50,'is_super','yesno',1,'Is Super',18,1,'0','[Is Super Note]',0,NULL,'[Is Super Info]',0,NULL,NULL,'Is Super',NULL,NULL,NULL,0,0,'',0,0,'',10,1,NULL),
	(51,'is_admin','yesno',1,'Is Admin',19,1,'0','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',10,1,NULL),
	(52,'is_moderator','yesno',1,'Is Moderator',20,1,'0','[Is Moderator Note]',0,NULL,'[Is Moderator Info]',0,NULL,NULL,'Is Moderator',NULL,NULL,NULL,0,0,'',0,0,'',10,1,NULL),
	(53,'is_staff','yesno',1,'Is Staff',21,1,'0','[Is Staff Note]',0,NULL,'[Is Staff Info]',0,NULL,NULL,'Is Staff',NULL,NULL,NULL,0,0,'',0,0,'',10,1,NULL),
	(54,'is_registered','yesno',1,'Is Registered',22,1,'0','[Is Registered Note]',0,NULL,'[Is Registered Info]',0,NULL,NULL,'Is Registered',NULL,NULL,NULL,0,0,'',0,0,'',10,1,NULL),
	(55,'is_banned','yesno',1,'Is Banned',23,1,'0','[Is Banned Note]',0,NULL,'[Is Banned Info]',0,NULL,NULL,'Is Banned',NULL,NULL,NULL,0,0,'',0,0,'',10,1,NULL),
	(56,'is_guest','yesno',1,'Is Guest',24,1,'0','[Is Guest Note]',0,NULL,'[Is Guest Info]',0,NULL,NULL,'Is Guest',NULL,NULL,NULL,0,0,'',0,0,'',10,1,NULL),
	(57,'role_id','text',1,'Role Id',13,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',1,1,'',230,1,NULL),
	(58,'inherit_id','text',1,'Inherit Id',14,1,'0','[Inherit Id Note]',0,NULL,'[Inherit Id Info]',0,NULL,NULL,'Inherit Id',NULL,NULL,NULL,0,0,'',0,0,'',230,1,NULL),
	(59,'title','text',1,'Title',15,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',230,1,NULL),
	(60,'item_count','text',1,'Item Count',16,0,'0','[Item Count Note]',0,NULL,'[Item Count Info]',0,NULL,NULL,'Item Count',NULL,NULL,NULL,0,0,'',0,0,'',230,1,NULL),
	(61,'is_special','yesno',1,'Is Special',17,1,'0','[Is Special Note]',0,NULL,'[Is Special Info]',0,NULL,NULL,'Is Special',NULL,NULL,NULL,0,0,'',0,0,'',230,1,NULL),
	(62,'is_super','yesno',1,'Is Super',18,1,'0','[Is Super Note]',0,NULL,'[Is Super Info]',0,NULL,NULL,'Is Super',NULL,NULL,NULL,0,0,'',0,0,'',230,1,NULL),
	(63,'is_admin','yesno',1,'Is Admin',19,1,'0','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',230,1,NULL),
	(64,'is_moderator','yesno',1,'Is Moderator',20,1,'0','[Is Moderator Note]',0,NULL,'[Is Moderator Info]',0,NULL,NULL,'Is Moderator',NULL,NULL,NULL,0,0,'',0,0,'',230,1,NULL),
	(65,'is_staff','yesno',1,'Is Staff',21,1,'0','[Is Staff Note]',0,NULL,'[Is Staff Info]',0,NULL,NULL,'Is Staff',NULL,NULL,NULL,0,0,'',0,0,'',230,1,NULL),
	(66,'is_registered','yesno',1,'Is Registered',22,1,'0','[Is Registered Note]',0,NULL,'[Is Registered Info]',0,NULL,NULL,'Is Registered',NULL,NULL,NULL,0,0,'',0,0,'',230,1,NULL),
	(67,'is_banned','yesno',1,'Is Banned',23,1,'0','[Is Banned Note]',0,NULL,'[Is Banned Info]',0,NULL,NULL,'Is Banned',NULL,NULL,NULL,0,0,'',0,0,'',230,1,NULL),
	(68,'is_guest','yesno',1,'Is Guest',24,1,'0','[Is Guest Note]',0,NULL,'[Is Guest Info]',0,NULL,NULL,'Is Guest',NULL,NULL,NULL,0,0,'',0,0,'',230,1,NULL),
	(69,'role_id','text',1,'Role Id',13,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',1,1,'',120,1,NULL),
	(70,'inherit_id','text',1,'Inherit Id',14,1,'0','[Inherit Id Note]',0,NULL,'[Inherit Id Info]',0,NULL,NULL,'Inherit Id',NULL,NULL,NULL,0,0,'',0,0,'',120,1,NULL),
	(71,'title','text',1,'Title',15,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',120,1,NULL),
	(72,'item_count','text',1,'Item Count',16,0,'0','[Item Count Note]',0,NULL,'[Item Count Info]',0,NULL,NULL,'Item Count',NULL,NULL,NULL,0,0,'',0,0,'',120,1,NULL),
	(73,'is_special','yesno',1,'Is Special',17,1,'0','[Is Special Note]',0,NULL,'[Is Special Info]',0,NULL,NULL,'Is Special',NULL,NULL,NULL,0,0,'',0,0,'',120,1,NULL),
	(74,'is_super','yesno',1,'Is Super',18,1,'0','[Is Super Note]',0,NULL,'[Is Super Info]',0,NULL,NULL,'Is Super',NULL,NULL,NULL,0,0,'',0,0,'',120,1,NULL),
	(75,'is_admin','yesno',1,'Is Admin',19,1,'0','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',120,1,NULL),
	(76,'is_moderator','yesno',1,'Is Moderator',20,1,'0','[Is Moderator Note]',0,NULL,'[Is Moderator Info]',0,NULL,NULL,'Is Moderator',NULL,NULL,NULL,0,0,'',0,0,'',120,1,NULL),
	(77,'is_staff','yesno',1,'Is Staff',21,1,'0','[Is Staff Note]',0,NULL,'[Is Staff Info]',0,NULL,NULL,'Is Staff',NULL,NULL,NULL,0,0,'',0,0,'',120,1,NULL),
	(78,'is_registered','yesno',1,'Is Registered',22,1,'0','[Is Registered Note]',0,NULL,'[Is Registered Info]',0,NULL,NULL,'Is Registered',NULL,NULL,NULL,0,0,'',0,0,'',120,1,NULL),
	(79,'is_banned','yesno',1,'Is Banned',23,1,'0','[Is Banned Note]',0,NULL,'[Is Banned Info]',0,NULL,NULL,'Is Banned',NULL,NULL,NULL,0,0,'',0,0,'',120,1,NULL),
	(80,'is_guest','yesno',1,'Is Guest',24,1,'0','[Is Guest Note]',0,NULL,'[Is Guest Info]',0,NULL,NULL,'Is Guest',NULL,NULL,NULL,0,0,'',0,0,'',120,1,NULL),
	(81,'role_id','text',1,'Role Id',13,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',1,1,'',340,1,NULL),
	(82,'inherit_id','text',1,'Inherit Id',14,1,'0','[Inherit Id Note]',0,NULL,'[Inherit Id Info]',0,NULL,NULL,'Inherit Id',NULL,NULL,NULL,0,0,'',0,0,'',340,1,NULL),
	(83,'title','text',1,'Title',15,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',340,1,NULL),
	(84,'item_count','text',1,'Item Count',16,0,'0','[Item Count Note]',0,NULL,'[Item Count Info]',0,NULL,NULL,'Item Count',NULL,NULL,NULL,0,0,'',0,0,'',340,1,NULL),
	(85,'is_special','yesno',1,'Is Special',17,1,'0','[Is Special Note]',0,NULL,'[Is Special Info]',0,NULL,NULL,'Is Special',NULL,NULL,NULL,0,0,'',0,0,'',340,1,NULL),
	(86,'is_super','yesno',1,'Is Super',18,1,'0','[Is Super Note]',0,NULL,'[Is Super Info]',0,NULL,NULL,'Is Super',NULL,NULL,NULL,0,0,'',0,0,'',340,1,NULL),
	(87,'is_admin','yesno',1,'Is Admin',19,1,'0','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',340,1,NULL),
	(88,'is_moderator','yesno',1,'Is Moderator',20,1,'0','[Is Moderator Note]',0,NULL,'[Is Moderator Info]',0,NULL,NULL,'Is Moderator',NULL,NULL,NULL,0,0,'',0,0,'',340,1,NULL),
	(89,'is_staff','yesno',1,'Is Staff',21,1,'0','[Is Staff Note]',0,NULL,'[Is Staff Info]',0,NULL,NULL,'Is Staff',NULL,NULL,NULL,0,0,'',0,0,'',340,1,NULL),
	(90,'is_registered','yesno',1,'Is Registered',22,1,'0','[Is Registered Note]',0,NULL,'[Is Registered Info]',0,NULL,NULL,'Is Registered',NULL,NULL,NULL,0,0,'',0,0,'',340,1,NULL),
	(91,'is_banned','yesno',1,'Is Banned',23,1,'0','[Is Banned Note]',0,NULL,'[Is Banned Info]',0,NULL,NULL,'Is Banned',NULL,NULL,NULL,0,0,'',0,0,'',340,1,NULL),
	(92,'is_guest','yesno',1,'Is Guest',24,1,'0','[Is Guest Note]',0,NULL,'[Is Guest Info]',0,NULL,NULL,'Is Guest',NULL,NULL,NULL,0,0,'',0,0,'',340,1,NULL),
	(93,'role_id','text',1,'Role Id',13,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',1,1,'',450,1,NULL),
	(94,'inherit_id','text',1,'Inherit Id',14,1,'0','[Inherit Id Note]',0,NULL,'[Inherit Id Info]',0,NULL,NULL,'Inherit Id',NULL,NULL,NULL,0,0,'',0,0,'',450,1,NULL),
	(95,'title','text',1,'Title',15,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',450,1,NULL),
	(96,'item_count','text',1,'Item Count',16,0,'0','[Item Count Note]',0,NULL,'[Item Count Info]',0,NULL,NULL,'Item Count',NULL,NULL,NULL,0,0,'',0,0,'',450,1,NULL),
	(97,'is_special','yesno',1,'Is Special',17,1,'0','[Is Special Note]',0,NULL,'[Is Special Info]',0,NULL,NULL,'Is Special',NULL,NULL,NULL,0,0,'',0,0,'',450,1,NULL),
	(98,'is_super','yesno',1,'Is Super',18,1,'0','[Is Super Note]',0,NULL,'[Is Super Info]',0,NULL,NULL,'Is Super',NULL,NULL,NULL,0,0,'',0,0,'',450,1,NULL),
	(99,'is_admin','yesno',1,'Is Admin',19,1,'0','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',450,1,NULL),
	(100,'is_moderator','yesno',1,'Is Moderator',20,1,'0','[Is Moderator Note]',0,NULL,'[Is Moderator Info]',0,NULL,NULL,'Is Moderator',NULL,NULL,NULL,0,0,'',0,0,'',450,1,NULL),
	(101,'is_staff','yesno',1,'Is Staff',21,1,'0','[Is Staff Note]',0,NULL,'[Is Staff Info]',0,NULL,NULL,'Is Staff',NULL,NULL,NULL,0,0,'',0,0,'',450,1,NULL),
	(102,'is_registered','yesno',1,'Is Registered',22,1,'0','[Is Registered Note]',0,NULL,'[Is Registered Info]',0,NULL,NULL,'Is Registered',NULL,NULL,NULL,0,0,'',0,0,'',450,1,NULL),
	(103,'is_banned','yesno',1,'Is Banned',23,1,'0','[Is Banned Note]',0,NULL,'[Is Banned Info]',0,NULL,NULL,'Is Banned',NULL,NULL,NULL,0,0,'',0,0,'',450,1,NULL),
	(104,'is_guest','yesno',1,'Is Guest',24,1,'0','[Is Guest Note]',0,NULL,'[Is Guest Info]',0,NULL,NULL,'Is Guest',NULL,NULL,NULL,0,0,'',0,0,'',450,1,NULL),
	(105,'action_id','text',1,'Action Id',8,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',1,1,'',11,1,NULL),
	(106,'action_type','text',0,'Action Type',9,1,'site','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',11,1,NULL),
	(107,'package_id','select',1,'Package Id',10,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',11,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(108,'group_id','text',1,'Group Id',11,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',0,0,'',11,1,NULL),
	(109,'name','text',1,'Name',12,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',11,1,NULL),
	(110,'ordering','text',1,'Sort Order',13,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',11,1,NULL),
	(111,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',11,1,NULL),
	(112,'action_id','text',1,'Action Id',8,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',1,1,'',231,1,NULL),
	(113,'action_type','text',0,'Action Type',9,1,'site','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',231,1,NULL),
	(114,'package_id','select',1,'Package Id',10,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',231,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(115,'group_id','text',1,'Group Id',11,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',0,0,'',231,1,NULL),
	(116,'name','text',1,'Name',12,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',231,1,NULL),
	(117,'ordering','text',1,'Sort Order',13,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',231,1,NULL),
	(118,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',231,1,NULL),
	(119,'action_id','text',1,'Action Id',8,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',1,1,'',121,1,NULL),
	(120,'action_type','text',0,'Action Type',9,1,'site','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',121,1,NULL),
	(121,'package_id','select',1,'Package Id',10,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',121,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(122,'group_id','text',1,'Group Id',11,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',0,0,'',121,1,NULL),
	(123,'name','text',1,'Name',12,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',121,1,NULL),
	(124,'ordering','text',1,'Sort Order',13,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',121,1,NULL),
	(125,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',121,1,NULL),
	(126,'action_id','text',1,'Action Id',8,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',1,1,'',341,1,NULL),
	(127,'action_type','text',0,'Action Type',9,1,'site','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',341,1,NULL),
	(128,'package_id','select',1,'Package Id',10,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',341,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(129,'group_id','text',1,'Group Id',11,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',0,0,'',341,1,NULL),
	(130,'name','text',1,'Name',12,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',341,1,NULL),
	(131,'ordering','text',1,'Sort Order',13,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',341,1,NULL),
	(132,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',341,1,NULL),
	(133,'action_id','text',1,'Action Id',8,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',1,1,'',451,1,NULL),
	(134,'action_type','text',0,'Action Type',9,1,'site','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',451,1,NULL),
	(135,'package_id','select',1,'Package Id',10,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',451,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(136,'group_id','text',1,'Group Id',11,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',0,0,'',451,1,NULL),
	(137,'name','text',1,'Name',12,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',451,1,NULL),
	(138,'ordering','text',1,'Sort Order',13,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',451,1,NULL),
	(139,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',451,1,NULL),
	(140,'group_id','text',1,'Group Id',8,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',1,0,'',12,1,NULL),
	(141,'package_id','select',1,'Package Id',9,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',12,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(142,'title','text',1,'Title',10,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',12,1,NULL),
	(143,'form_name','text',1,'Form Name',11,1,'','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',12,1,NULL),
	(144,'description','textarea',1,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',12,1,NULL),
	(145,'ordering','text',1,'Sort Order',13,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',12,1,NULL),
	(146,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',12,1,NULL),
	(147,'group_id','text',1,'Group Id',8,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',1,0,'',232,1,NULL),
	(148,'package_id','select',1,'Package Id',9,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',232,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(149,'title','text',1,'Title',10,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',232,1,NULL),
	(150,'form_name','text',1,'Form Name',11,1,'','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',232,1,NULL),
	(151,'description','textarea',1,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',232,1,NULL),
	(152,'ordering','text',1,'Sort Order',13,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',232,1,NULL),
	(153,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',232,1,NULL),
	(154,'group_id','text',1,'Group Id',8,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',1,0,'',122,1,NULL),
	(155,'package_id','select',1,'Package Id',9,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',122,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(156,'title','text',1,'Title',10,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',122,1,NULL),
	(157,'form_name','text',1,'Form Name',11,1,'','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',122,1,NULL),
	(158,'description','textarea',1,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',122,1,NULL),
	(159,'ordering','text',1,'Sort Order',13,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',122,1,NULL),
	(160,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',122,1,NULL),
	(161,'level_id','select',1,'Group Id',8,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',1,0,'',342,1,'\Phpfox::get(\'core.roles\')->getFormIdOptions()'),
	(162,'package_id','select',1,'Package Id',9,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',342,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(163,'title','text',1,'Title',10,0,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',342,1,NULL),
	(164,'form_name','text',1,'Form Name',11,0,'','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',342,1,NULL),
	(165,'description','textarea',1,'Description',12,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',342,1,NULL),
	(166,'ordering','text',1,'Sort Order',13,0,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',342,1,NULL),
	(167,'is_active','yesno',1,'Is Active',14,0,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',342,1,NULL),
	(168,'group_id','text',1,'Group Id',8,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',1,0,'',452,1,NULL),
	(169,'package_id','select',1,'Package Id',9,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',452,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(170,'title','text',1,'Title',10,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',452,1,NULL),
	(171,'form_name','text',1,'Form Name',11,1,'','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',452,1,NULL),
	(172,'description','textarea',1,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',452,1,NULL),
	(173,'ordering','text',1,'Sort Order',13,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',452,1,NULL),
	(174,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',452,1,NULL),
	(175,'value_id','text',1,'Value Id',6,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',1,1,'',13,1,NULL),
	(176,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',13,1,NULL),
	(177,'role_id','text',1,'Role Id',8,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',13,1,NULL),
	(178,'name','text',1,'Name',9,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',13,1,NULL),
	(179,'value_actual','textarea',0,'Value Actual',10,1,'','[Value Actual Note]',0,NULL,'[Value Actual Info]',0,NULL,NULL,'Value Actual',NULL,NULL,NULL,0,0,'',0,0,'',13,1,NULL),
	(180,'value_id','text',1,'Value Id',6,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',1,1,'',233,1,NULL),
	(181,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',233,1,NULL),
	(182,'role_id','text',1,'Role Id',8,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',233,1,NULL),
	(183,'name','text',1,'Name',9,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',233,1,NULL),
	(184,'value_actual','textarea',0,'Value Actual',10,1,'','[Value Actual Note]',0,NULL,'[Value Actual Info]',0,NULL,NULL,'Value Actual',NULL,NULL,NULL,0,0,'',0,0,'',233,1,NULL),
	(185,'value_id','text',1,'Value Id',6,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',1,1,'',123,1,NULL),
	(186,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',123,1,NULL),
	(187,'role_id','text',1,'Role Id',8,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',123,1,NULL),
	(188,'name','text',1,'Name',9,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',123,1,NULL),
	(189,'value_actual','textarea',0,'Value Actual',10,1,'','[Value Actual Note]',0,NULL,'[Value Actual Info]',0,NULL,NULL,'Value Actual',NULL,NULL,NULL,0,0,'',0,0,'',123,1,NULL),
	(190,'value_id','text',1,'Value Id',6,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',1,1,'',343,1,NULL),
	(191,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',343,1,NULL),
	(192,'role_id','text',1,'Role Id',8,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',343,1,NULL),
	(193,'name','text',1,'Name',9,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',343,1,NULL),
	(194,'value_actual','textarea',0,'Value Actual',10,1,'','[Value Actual Note]',0,NULL,'[Value Actual Info]',0,NULL,NULL,'Value Actual',NULL,NULL,NULL,0,0,'',0,0,'',343,1,NULL),
	(195,'value_id','text',1,'Value Id',6,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',1,1,'',453,1,NULL),
	(196,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',453,1,NULL),
	(197,'role_id','text',1,'Role Id',8,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',453,1,NULL),
	(198,'name','text',1,'Name',9,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',453,1,NULL),
	(199,'value_actual','textarea',0,'Value Actual',10,1,'','[Value Actual Note]',0,NULL,'[Value Actual Info]',0,NULL,NULL,'Value Actual',NULL,NULL,NULL,0,0,'',0,0,'',453,1,NULL),
	(260,'id','text',1,'Id',5,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',34,1,NULL),
	(261,'event_name','text',1,'Event Name',6,1,'','[Event Name Note]',0,NULL,'[Event Name Info]',0,NULL,NULL,'Event Name',NULL,NULL,NULL,0,0,'',0,0,'',34,1,NULL),
	(262,'listener_name','text',1,'Listener Name',7,1,'','[Listener Name Note]',0,NULL,'[Listener Name Info]',0,NULL,NULL,'Listener Name',NULL,NULL,NULL,0,0,'',0,0,'',34,1,NULL),
	(263,'priority','text',1,'Priority',8,1,'10','[Priority Note]',0,NULL,'[Priority Info]',0,NULL,NULL,'Priority',NULL,NULL,NULL,0,0,'',0,0,'',34,1,NULL),
	(264,'id','text',1,'Id',5,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',254,1,NULL),
	(265,'event_name','text',1,'Event Name',6,1,'','[Event Name Note]',0,NULL,'[Event Name Info]',0,NULL,NULL,'Event Name',NULL,NULL,NULL,0,0,'',0,0,'',254,1,NULL),
	(266,'listener_name','text',1,'Listener Name',7,1,'','[Listener Name Note]',0,NULL,'[Listener Name Info]',0,NULL,NULL,'Listener Name',NULL,NULL,NULL,0,0,'',0,0,'',254,1,NULL),
	(267,'priority','text',1,'Priority',8,1,'10','[Priority Note]',0,NULL,'[Priority Info]',0,NULL,NULL,'Priority',NULL,NULL,NULL,0,0,'',0,0,'',254,1,NULL),
	(268,'id','text',1,'Id',5,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',144,1,NULL),
	(269,'event_name','text',1,'Event Name',6,1,'','[Event Name Note]',0,NULL,'[Event Name Info]',0,NULL,NULL,'Event Name',NULL,NULL,NULL,0,0,'',0,0,'',144,1,NULL),
	(270,'listener_name','text',1,'Listener Name',7,1,'','[Listener Name Note]',0,NULL,'[Listener Name Info]',0,NULL,NULL,'Listener Name',NULL,NULL,NULL,0,0,'',0,0,'',144,1,NULL),
	(271,'priority','text',1,'Priority',8,1,'10','[Priority Note]',0,NULL,'[Priority Info]',0,NULL,NULL,'Priority',NULL,NULL,NULL,0,0,'',0,0,'',144,1,NULL),
	(272,'id','text',1,'Id',5,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',364,1,NULL),
	(273,'event_name','text',1,'Event Name',6,1,'','[Event Name Note]',0,NULL,'[Event Name Info]',0,NULL,NULL,'Event Name',NULL,NULL,NULL,0,0,'',0,0,'',364,1,NULL),
	(274,'listener_name','text',1,'Listener Name',7,1,'','[Listener Name Note]',0,NULL,'[Listener Name Info]',0,NULL,NULL,'Listener Name',NULL,NULL,NULL,0,0,'',0,0,'',364,1,NULL),
	(275,'priority','text',1,'Priority',8,1,'10','[Priority Note]',0,NULL,'[Priority Info]',0,NULL,NULL,'Priority',NULL,NULL,NULL,0,0,'',0,0,'',364,1,NULL),
	(276,'id','text',1,'Id',5,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',456,1,NULL),
	(277,'event_name','text',1,'Event Name',6,1,'','[Event Name Note]',0,NULL,'[Event Name Info]',0,NULL,NULL,'Event Name',NULL,NULL,NULL,0,0,'',0,0,'',456,1,NULL),
	(278,'listener_name','text',1,'Listener Name',7,1,'','[Listener Name Note]',0,NULL,'[Listener Name Info]',0,NULL,NULL,'Listener Name',NULL,NULL,NULL,0,0,'',0,0,'',456,1,NULL),
	(279,'priority','text',1,'Priority',8,1,'10','[Priority Note]',0,NULL,'[Priority Info]',0,NULL,NULL,'Priority',NULL,NULL,NULL,0,0,'',0,0,'',456,1,NULL),
	(310,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',36,1,NULL),
	(311,'ip','text',1,'Ip',7,1,'','[Ip Note]',0,NULL,'[Ip Info]',0,NULL,NULL,'Ip',NULL,NULL,NULL,0,0,'',0,0,'',36,1,NULL),
	(312,'updated','text',1,'Updated',8,1,'','[Updated Note]',0,NULL,'[Updated Info]',0,NULL,NULL,'Updated',NULL,NULL,NULL,0,0,'',0,0,'',36,1,NULL),
	(313,'level','text',1,'Level',9,1,'','[Level Note]',0,NULL,'[Level Info]',0,NULL,NULL,'Level',NULL,NULL,NULL,0,0,'',0,0,'',36,1,NULL),
	(314,'message','textarea',1,'Message',10,1,'','[Message Note]',0,NULL,'[Message Info]',0,NULL,NULL,'Message',NULL,NULL,NULL,0,0,'',0,0,'',36,1,NULL),
	(315,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',256,1,NULL),
	(316,'ip','text',1,'Ip',7,1,'','[Ip Note]',0,NULL,'[Ip Info]',0,NULL,NULL,'Ip',NULL,NULL,NULL,0,0,'',0,0,'',256,1,NULL),
	(317,'updated','text',1,'Updated',8,1,'','[Updated Note]',0,NULL,'[Updated Info]',0,NULL,NULL,'Updated',NULL,NULL,NULL,0,0,'',0,0,'',256,1,NULL),
	(318,'level','text',1,'Level',9,1,'','[Level Note]',0,NULL,'[Level Info]',0,NULL,NULL,'Level',NULL,NULL,NULL,0,0,'',0,0,'',256,1,NULL),
	(319,'message','textarea',1,'Message',10,1,'','[Message Note]',0,NULL,'[Message Info]',0,NULL,NULL,'Message',NULL,NULL,NULL,0,0,'',0,0,'',256,1,NULL),
	(320,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',146,1,NULL),
	(321,'ip','text',1,'Ip',7,1,'','[Ip Note]',0,NULL,'[Ip Info]',0,NULL,NULL,'Ip',NULL,NULL,NULL,0,0,'',0,0,'',146,1,NULL),
	(322,'updated','text',1,'Updated',8,1,'','[Updated Note]',0,NULL,'[Updated Info]',0,NULL,NULL,'Updated',NULL,NULL,NULL,0,0,'',0,0,'',146,1,NULL),
	(323,'level','text',1,'Level',9,1,'','[Level Note]',0,NULL,'[Level Info]',0,NULL,NULL,'Level',NULL,NULL,NULL,0,0,'',0,0,'',146,1,NULL),
	(324,'message','textarea',1,'Message',10,1,'','[Message Note]',0,NULL,'[Message Info]',0,NULL,NULL,'Message',NULL,NULL,NULL,0,0,'',0,0,'',146,1,NULL),
	(325,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',366,1,NULL),
	(326,'ip','text',1,'Ip',7,1,'','[Ip Note]',0,NULL,'[Ip Info]',0,NULL,NULL,'Ip',NULL,NULL,NULL,0,0,'',0,0,'',366,1,NULL),
	(327,'updated','text',1,'Updated',8,1,'','[Updated Note]',0,NULL,'[Updated Info]',0,NULL,NULL,'Updated',NULL,NULL,NULL,0,0,'',0,0,'',366,1,NULL),
	(328,'level','text',1,'Level',9,1,'','[Level Note]',0,NULL,'[Level Info]',0,NULL,NULL,'Level',NULL,NULL,NULL,0,0,'',0,0,'',366,1,NULL),
	(329,'message','textarea',1,'Message',10,1,'','[Message Note]',0,NULL,'[Message Info]',0,NULL,NULL,'Message',NULL,NULL,NULL,0,0,'',0,0,'',366,1,NULL),
	(330,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',458,1,NULL),
	(331,'ip','text',1,'Ip',7,1,'','[Ip Note]',0,NULL,'[Ip Info]',0,NULL,NULL,'Ip',NULL,NULL,NULL,0,0,'',0,0,'',458,1,NULL),
	(332,'updated','text',1,'Updated',8,1,'','[Updated Note]',0,NULL,'[Updated Info]',0,NULL,NULL,'Updated',NULL,NULL,NULL,0,0,'',0,0,'',458,1,NULL),
	(333,'level','text',1,'Level',9,1,'','[Level Note]',0,NULL,'[Level Info]',0,NULL,NULL,'Level',NULL,NULL,NULL,0,0,'',0,0,'',458,1,NULL),
	(334,'message','textarea',1,'Message',10,1,'','[Message Note]',0,NULL,'[Message Info]',0,NULL,NULL,'Message',NULL,NULL,NULL,0,0,'',0,0,'',458,1,NULL),
	(335,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',37,1,NULL),
	(336,'queue','text',1,'Queue',8,1,'default','[Queue Note]',0,NULL,'[Queue Info]',0,NULL,NULL,'Queue',NULL,NULL,NULL,0,0,'',0,0,'',37,1,NULL),
	(337,'data','textarea',1,'Data',9,1,'','[Data Note]',0,NULL,'[Data Info]',0,NULL,NULL,'Data',NULL,NULL,NULL,0,0,'',0,0,'',37,1,NULL),
	(338,'expiration','text',1,'Expiration',10,1,'600','[Expiration Note]',0,NULL,'[Expiration Info]',0,NULL,NULL,'Expiration',NULL,NULL,NULL,0,0,'',0,0,'',37,1,NULL),
	(339,'status_id','text',1,'Status Id',11,1,'0','[Status Id Note]',0,NULL,'[Status Id Info]',0,NULL,NULL,'Status Id',NULL,NULL,NULL,0,0,'',0,0,'',37,1,NULL),
	(340,'delivered_at','text',1,'Delivered At',12,1,'0','[Delivered At Note]',0,NULL,'[Delivered At Info]',0,NULL,NULL,'Delivered At',NULL,NULL,NULL,0,0,'',0,0,'',37,1,NULL),
	(341,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',257,1,NULL),
	(342,'queue','text',1,'Queue',8,1,'default','[Queue Note]',0,NULL,'[Queue Info]',0,NULL,NULL,'Queue',NULL,NULL,NULL,0,0,'',0,0,'',257,1,NULL),
	(343,'data','textarea',1,'Data',9,1,'','[Data Note]',0,NULL,'[Data Info]',0,NULL,NULL,'Data',NULL,NULL,NULL,0,0,'',0,0,'',257,1,NULL),
	(344,'expiration','text',1,'Expiration',10,1,'600','[Expiration Note]',0,NULL,'[Expiration Info]',0,NULL,NULL,'Expiration',NULL,NULL,NULL,0,0,'',0,0,'',257,1,NULL),
	(345,'status_id','text',1,'Status Id',11,1,'0','[Status Id Note]',0,NULL,'[Status Id Info]',0,NULL,NULL,'Status Id',NULL,NULL,NULL,0,0,'',0,0,'',257,1,NULL),
	(346,'delivered_at','text',1,'Delivered At',12,1,'0','[Delivered At Note]',0,NULL,'[Delivered At Info]',0,NULL,NULL,'Delivered At',NULL,NULL,NULL,0,0,'',0,0,'',257,1,NULL),
	(347,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',147,1,NULL),
	(348,'queue','text',1,'Queue',8,1,'default','[Queue Note]',0,NULL,'[Queue Info]',0,NULL,NULL,'Queue',NULL,NULL,NULL,0,0,'',0,0,'',147,1,NULL),
	(349,'data','textarea',1,'Data',9,1,'','[Data Note]',0,NULL,'[Data Info]',0,NULL,NULL,'Data',NULL,NULL,NULL,0,0,'',0,0,'',147,1,NULL),
	(350,'expiration','text',1,'Expiration',10,1,'600','[Expiration Note]',0,NULL,'[Expiration Info]',0,NULL,NULL,'Expiration',NULL,NULL,NULL,0,0,'',0,0,'',147,1,NULL),
	(351,'status_id','text',1,'Status Id',11,1,'0','[Status Id Note]',0,NULL,'[Status Id Info]',0,NULL,NULL,'Status Id',NULL,NULL,NULL,0,0,'',0,0,'',147,1,NULL),
	(352,'delivered_at','text',1,'Delivered At',12,1,'0','[Delivered At Note]',0,NULL,'[Delivered At Info]',0,NULL,NULL,'Delivered At',NULL,NULL,NULL,0,0,'',0,0,'',147,1,NULL),
	(353,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',367,1,NULL),
	(354,'queue','text',1,'Queue',8,1,'default','[Queue Note]',0,NULL,'[Queue Info]',0,NULL,NULL,'Queue',NULL,NULL,NULL,0,0,'',0,0,'',367,1,NULL),
	(355,'data','textarea',1,'Data',9,1,'','[Data Note]',0,NULL,'[Data Info]',0,NULL,NULL,'Data',NULL,NULL,NULL,0,0,'',0,0,'',367,1,NULL),
	(356,'expiration','text',1,'Expiration',10,1,'600','[Expiration Note]',0,NULL,'[Expiration Info]',0,NULL,NULL,'Expiration',NULL,NULL,NULL,0,0,'',0,0,'',367,1,NULL),
	(357,'status_id','text',1,'Status Id',11,1,'0','[Status Id Note]',0,NULL,'[Status Id Info]',0,NULL,NULL,'Status Id',NULL,NULL,NULL,0,0,'',0,0,'',367,1,NULL),
	(358,'delivered_at','text',1,'Delivered At',12,1,'0','[Delivered At Note]',0,NULL,'[Delivered At Info]',0,NULL,NULL,'Delivered At',NULL,NULL,NULL,0,0,'',0,0,'',367,1,NULL),
	(359,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',459,1,NULL),
	(360,'queue','text',1,'Queue',8,1,'default','[Queue Note]',0,NULL,'[Queue Info]',0,NULL,NULL,'Queue',NULL,NULL,NULL,0,0,'',0,0,'',459,1,NULL),
	(361,'data','textarea',1,'Data',9,1,'','[Data Note]',0,NULL,'[Data Info]',0,NULL,NULL,'Data',NULL,NULL,NULL,0,0,'',0,0,'',459,1,NULL),
	(362,'expiration','text',1,'Expiration',10,1,'600','[Expiration Note]',0,NULL,'[Expiration Info]',0,NULL,NULL,'Expiration',NULL,NULL,NULL,0,0,'',0,0,'',459,1,NULL),
	(363,'status_id','text',1,'Status Id',11,1,'0','[Status Id Note]',0,NULL,'[Status Id Info]',0,NULL,NULL,'Status Id',NULL,NULL,NULL,0,0,'',0,0,'',459,1,NULL),
	(364,'delivered_at','text',1,'Delivered At',12,1,'0','[Delivered At Note]',0,NULL,'[Delivered At Info]',0,NULL,NULL,'Delivered At',NULL,NULL,NULL,0,0,'',0,0,'',459,1,NULL),
	(365,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',38,1,NULL),
	(366,'ip','text',1,'Ip',8,1,'','[Ip Note]',0,NULL,'[Ip Info]',0,NULL,NULL,'Ip',NULL,NULL,NULL,0,0,'',0,0,'',38,1,NULL),
	(367,'updated','text',1,'Updated',9,1,'','[Updated Note]',0,NULL,'[Updated Info]',0,NULL,NULL,'Updated',NULL,NULL,NULL,0,0,'',0,0,'',38,1,NULL),
	(368,'level','text',1,'Level',10,1,'','[Level Note]',0,NULL,'[Level Info]',0,NULL,NULL,'Level',NULL,NULL,NULL,0,0,'',0,0,'',38,1,NULL),
	(369,'message','textarea',1,'Message',11,1,'','[Message Note]',0,NULL,'[Message Info]',0,NULL,NULL,'Message',NULL,NULL,NULL,0,0,'',0,0,'',38,1,NULL),
	(370,'created','text',1,'Created',12,1,'','[Created Note]',0,NULL,'[Created Info]',0,NULL,NULL,'Created',NULL,NULL,NULL,0,0,'',0,0,'',38,1,NULL),
	(371,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',258,1,NULL),
	(372,'ip','text',1,'Ip',8,1,'','[Ip Note]',0,NULL,'[Ip Info]',0,NULL,NULL,'Ip',NULL,NULL,NULL,0,0,'',0,0,'',258,1,NULL),
	(373,'updated','text',1,'Updated',9,1,'','[Updated Note]',0,NULL,'[Updated Info]',0,NULL,NULL,'Updated',NULL,NULL,NULL,0,0,'',0,0,'',258,1,NULL),
	(374,'level','text',1,'Level',10,1,'','[Level Note]',0,NULL,'[Level Info]',0,NULL,NULL,'Level',NULL,NULL,NULL,0,0,'',0,0,'',258,1,NULL),
	(375,'message','textarea',1,'Message',11,1,'','[Message Note]',0,NULL,'[Message Info]',0,NULL,NULL,'Message',NULL,NULL,NULL,0,0,'',0,0,'',258,1,NULL),
	(376,'created','text',1,'Created',12,1,'','[Created Note]',0,NULL,'[Created Info]',0,NULL,NULL,'Created',NULL,NULL,NULL,0,0,'',0,0,'',258,1,NULL),
	(377,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',148,1,NULL),
	(378,'ip','text',1,'Ip',8,1,'','[Ip Note]',0,NULL,'[Ip Info]',0,NULL,NULL,'Ip',NULL,NULL,NULL,0,0,'',0,0,'',148,1,NULL),
	(379,'updated','text',1,'Updated',9,1,'','[Updated Note]',0,NULL,'[Updated Info]',0,NULL,NULL,'Updated',NULL,NULL,NULL,0,0,'',0,0,'',148,1,NULL),
	(380,'level','text',1,'Level',10,1,'','[Level Note]',0,NULL,'[Level Info]',0,NULL,NULL,'Level',NULL,NULL,NULL,0,0,'',0,0,'',148,1,NULL),
	(381,'message','textarea',1,'Message',11,1,'','[Message Note]',0,NULL,'[Message Info]',0,NULL,NULL,'Message',NULL,NULL,NULL,0,0,'',0,0,'',148,1,NULL),
	(382,'created','text',1,'Created',12,1,'','[Created Note]',0,NULL,'[Created Info]',0,NULL,NULL,'Created',NULL,NULL,NULL,0,0,'',0,0,'',148,1,NULL),
	(383,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',368,1,NULL),
	(384,'ip','text',1,'Ip',8,1,'','[Ip Note]',0,NULL,'[Ip Info]',0,NULL,NULL,'Ip',NULL,NULL,NULL,0,0,'',0,0,'',368,1,NULL),
	(385,'updated','text',1,'Updated',9,1,'','[Updated Note]',0,NULL,'[Updated Info]',0,NULL,NULL,'Updated',NULL,NULL,NULL,0,0,'',0,0,'',368,1,NULL),
	(386,'level','text',1,'Level',10,1,'','[Level Note]',0,NULL,'[Level Info]',0,NULL,NULL,'Level',NULL,NULL,NULL,0,0,'',0,0,'',368,1,NULL),
	(387,'message','textarea',1,'Message',11,1,'','[Message Note]',0,NULL,'[Message Info]',0,NULL,NULL,'Message',NULL,NULL,NULL,0,0,'',0,0,'',368,1,NULL),
	(388,'created','text',1,'Created',12,1,'','[Created Note]',0,NULL,'[Created Info]',0,NULL,NULL,'Created',NULL,NULL,NULL,0,0,'',0,0,'',368,1,NULL),
	(389,'id','text',1,'Id',7,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',460,1,NULL),
	(390,'ip','text',1,'Ip',8,1,'','[Ip Note]',0,NULL,'[Ip Info]',0,NULL,NULL,'Ip',NULL,NULL,NULL,0,0,'',0,0,'',460,1,NULL),
	(391,'updated','text',1,'Updated',9,1,'','[Updated Note]',0,NULL,'[Updated Info]',0,NULL,NULL,'Updated',NULL,NULL,NULL,0,0,'',0,0,'',460,1,NULL),
	(392,'level','text',1,'Level',10,1,'','[Level Note]',0,NULL,'[Level Info]',0,NULL,NULL,'Level',NULL,NULL,NULL,0,0,'',0,0,'',460,1,NULL),
	(393,'message','textarea',1,'Message',11,1,'','[Message Note]',0,NULL,'[Message Info]',0,NULL,NULL,'Message',NULL,NULL,NULL,0,0,'',0,0,'',460,1,NULL),
	(394,'created','text',1,'Created',12,1,'','[Created Note]',0,NULL,'[Created Info]',0,NULL,NULL,'Created',NULL,NULL,NULL,0,0,'',0,0,'',460,1,NULL),
	(395,'id','text',1,'Id',17,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',39,1,NULL),
	(396,'ordering','text',1,'Sort Order',18,1,'100','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(397,'menu','text',0,'Menu',19,1,'','[Menu Note]',0,NULL,'[Menu Info]',0,NULL,NULL,'Menu',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(398,'name','text',1,'Name',20,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(399,'parent_name','text',0,'Parent Name',21,1,'','[Parent Name Note]',0,NULL,'[Parent Name Info]',0,NULL,NULL,'Parent Name',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(400,'package_id','select',1,'Package Id',22,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',39,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(401,'label','text',1,'Label',23,1,'','[Label Note]',0,NULL,'[Label Info]',0,NULL,NULL,'Label',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(402,'route','text',0,'Route',24,1,'','[Route Note]',0,NULL,'[Route Info]',0,NULL,NULL,'Route',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(403,'params','text',1,'Params',25,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(404,'extra','text',1,'Extra',26,1,'[]','[Extra Note]',0,NULL,'[Extra Info]',0,NULL,NULL,'Extra',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(405,'acl','text',0,'Acl',27,1,'','[Acl Note]',0,NULL,'[Acl Info]',0,NULL,NULL,'Acl',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(406,'event','text',0,'Event',28,1,'','[Event Note]',0,NULL,'[Event Info]',0,NULL,NULL,'Event',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(407,'plugin','text',0,'Plugin',29,1,'','[Plugin Note]',0,NULL,'[Plugin Info]',0,NULL,NULL,'Plugin',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(408,'is_active','yesno',1,'Is Active',30,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(409,'is_custom','yesno',1,'Is Custom',31,1,'0','[Is Custom Note]',0,NULL,'[Is Custom Info]',0,NULL,NULL,'Is Custom',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(410,'type','text',1,'Type',32,1,'route','[Type Note]',0,NULL,'[Type Info]',0,NULL,NULL,'Type',NULL,NULL,NULL,0,0,'',0,0,'',39,1,NULL),
	(411,'id','text',1,'Id',17,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',259,1,NULL),
	(412,'ordering','text',1,'Sort Order',18,1,'100','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(413,'menu','text',0,'Menu',19,1,'','[Menu Note]',0,NULL,'[Menu Info]',0,NULL,NULL,'Menu',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(414,'name','text',1,'Name',20,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(415,'parent_name','text',0,'Parent Name',21,1,'','[Parent Name Note]',0,NULL,'[Parent Name Info]',0,NULL,NULL,'Parent Name',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(416,'package_id','select',1,'Package Id',22,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',259,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(417,'label','text',1,'Label',23,1,'','[Label Note]',0,NULL,'[Label Info]',0,NULL,NULL,'Label',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(418,'route','text',0,'Route',24,1,'','[Route Note]',0,NULL,'[Route Info]',0,NULL,NULL,'Route',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(419,'params','text',1,'Params',25,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(420,'extra','text',1,'Extra',26,1,'[]','[Extra Note]',0,NULL,'[Extra Info]',0,NULL,NULL,'Extra',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(421,'acl','text',0,'Acl',27,1,'','[Acl Note]',0,NULL,'[Acl Info]',0,NULL,NULL,'Acl',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(422,'event','text',0,'Event',28,1,'','[Event Note]',0,NULL,'[Event Info]',0,NULL,NULL,'Event',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(423,'plugin','text',0,'Plugin',29,1,'','[Plugin Note]',0,NULL,'[Plugin Info]',0,NULL,NULL,'Plugin',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(424,'is_active','yesno',1,'Is Active',30,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(425,'is_custom','yesno',1,'Is Custom',31,1,'0','[Is Custom Note]',0,NULL,'[Is Custom Info]',0,NULL,NULL,'Is Custom',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(426,'type','text',1,'Type',32,1,'route','[Type Note]',0,NULL,'[Type Info]',0,NULL,NULL,'Type',NULL,NULL,NULL,0,0,'',0,0,'',259,1,NULL),
	(427,'id','text',1,'Id',17,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',149,1,NULL),
	(428,'ordering','text',1,'Sort Order',18,1,'100','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(429,'menu','text',0,'Menu',19,1,'','[Menu Note]',0,NULL,'[Menu Info]',0,NULL,NULL,'Menu',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(430,'name','text',1,'Name',20,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(431,'parent_name','text',0,'Parent Name',21,1,'','[Parent Name Note]',0,NULL,'[Parent Name Info]',0,NULL,NULL,'Parent Name',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(432,'package_id','select',1,'Package Id',22,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',149,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(433,'label','text',1,'Label',23,1,'','[Label Note]',0,NULL,'[Label Info]',0,NULL,NULL,'Label',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(434,'route','text',0,'Route',24,1,'','[Route Note]',0,NULL,'[Route Info]',0,NULL,NULL,'Route',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(435,'params','text',1,'Params',25,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(436,'extra','text',1,'Extra',26,1,'[]','[Extra Note]',0,NULL,'[Extra Info]',0,NULL,NULL,'Extra',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(437,'acl','text',0,'Acl',27,1,'','[Acl Note]',0,NULL,'[Acl Info]',0,NULL,NULL,'Acl',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(438,'event','text',0,'Event',28,1,'','[Event Note]',0,NULL,'[Event Info]',0,NULL,NULL,'Event',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(439,'plugin','text',0,'Plugin',29,1,'','[Plugin Note]',0,NULL,'[Plugin Info]',0,NULL,NULL,'Plugin',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(440,'is_active','yesno',1,'Is Active',30,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(441,'is_custom','yesno',1,'Is Custom',31,1,'0','[Is Custom Note]',0,NULL,'[Is Custom Info]',0,NULL,NULL,'Is Custom',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(442,'type','text',1,'Type',32,1,'route','[Type Note]',0,NULL,'[Type Info]',0,NULL,NULL,'Type',NULL,NULL,NULL,0,0,'',0,0,'',149,1,NULL),
	(443,'id','text',1,'Id',17,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',369,1,NULL),
	(444,'ordering','text',1,'Sort Order',18,1,'100','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(445,'menu','text',0,'Menu',19,1,'','[Menu Note]',0,NULL,'[Menu Info]',0,NULL,NULL,'Menu',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(446,'name','text',1,'Name',20,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(447,'parent_name','text',0,'Parent Name',21,1,'','[Parent Name Note]',0,NULL,'[Parent Name Info]',0,NULL,NULL,'Parent Name',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(448,'package_id','select',1,'Package Id',22,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',369,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(449,'label','text',1,'Label',23,1,'','[Label Note]',0,NULL,'[Label Info]',0,NULL,NULL,'Label',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(450,'route','text',0,'Route',24,1,'','[Route Note]',0,NULL,'[Route Info]',0,NULL,NULL,'Route',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(451,'params','text',1,'Params',25,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(452,'extra','text',1,'Extra',26,1,'[]','[Extra Note]',0,NULL,'[Extra Info]',0,NULL,NULL,'Extra',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(453,'acl','text',0,'Acl',27,1,'','[Acl Note]',0,NULL,'[Acl Info]',0,NULL,NULL,'Acl',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(454,'event','text',0,'Event',28,1,'','[Event Note]',0,NULL,'[Event Info]',0,NULL,NULL,'Event',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(455,'plugin','text',0,'Plugin',29,1,'','[Plugin Note]',0,NULL,'[Plugin Info]',0,NULL,NULL,'Plugin',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(456,'is_active','yesno',1,'Is Active',30,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(457,'is_custom','yesno',1,'Is Custom',31,1,'0','[Is Custom Note]',0,NULL,'[Is Custom Info]',0,NULL,NULL,'Is Custom',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(458,'type','text',1,'Type',32,1,'route','[Type Note]',0,NULL,'[Type Info]',0,NULL,NULL,'Type',NULL,NULL,NULL,0,0,'',0,0,'',369,1,NULL),
	(459,'id','text',1,'Id',17,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',461,1,NULL),
	(460,'ordering','text',1,'Sort Order',18,1,'100','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(461,'menu','text',0,'Menu',19,1,'','[Menu Note]',0,NULL,'[Menu Info]',0,NULL,NULL,'Menu',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(462,'name','text',1,'Name',20,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(463,'parent_name','text',0,'Parent Name',21,1,'','[Parent Name Note]',0,NULL,'[Parent Name Info]',0,NULL,NULL,'Parent Name',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(464,'package_id','select',1,'Package Id',22,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',461,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(465,'label','text',1,'Label',23,1,'','[Label Note]',0,NULL,'[Label Info]',0,NULL,NULL,'Label',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(466,'route','text',0,'Route',24,1,'','[Route Note]',0,NULL,'[Route Info]',0,NULL,NULL,'Route',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(467,'params','text',1,'Params',25,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(468,'extra','text',1,'Extra',26,1,'[]','[Extra Note]',0,NULL,'[Extra Info]',0,NULL,NULL,'Extra',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(469,'acl','text',0,'Acl',27,1,'','[Acl Note]',0,NULL,'[Acl Info]',0,NULL,NULL,'Acl',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(470,'event','text',0,'Event',28,1,'','[Event Note]',0,NULL,'[Event Info]',0,NULL,NULL,'Event',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(471,'plugin','text',0,'Plugin',29,1,'','[Plugin Note]',0,NULL,'[Plugin Info]',0,NULL,NULL,'Plugin',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(472,'is_active','yesno',1,'Is Active',30,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(473,'is_custom','yesno',1,'Is Custom',31,1,'0','[Is Custom Note]',0,NULL,'[Is Custom Info]',0,NULL,NULL,'Is Custom',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(474,'type','text',1,'Type',32,1,'route','[Type Note]',0,NULL,'[Type Info]',0,NULL,NULL,'Type',NULL,NULL,NULL,0,0,'',0,0,'',461,1,NULL),
	(475,'id','text',1,'Id',15,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',40,1,NULL),
	(476,'type_id','text',1,'Type Id',16,1,'app','[Type Id Note]',0,NULL,'[Type Id Info]',0,NULL,NULL,'Type Id',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(477,'is_required','yesno',1,'Is Required',17,0,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(478,'is_active','yesno',1,'Is Active',18,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(479,'theme_id','text',0,'Theme Id',19,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(480,'priority','text',0,'Priority',20,1,'1','[Priority Note]',0,NULL,'[Priority Info]',0,NULL,NULL,'Priority',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(481,'title','text',0,'Title',21,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(482,'version','text',1,'Version',22,1,'4.0.1','[Version Note]',0,NULL,'[Version Info]',0,NULL,NULL,'Version',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(483,'latest_version','text',0,'Latest Version',23,1,'','[Latest Version Note]',0,NULL,'[Latest Version Info]',0,NULL,NULL,'Latest Version',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(484,'author','text',1,'Author',24,1,'n/a','[Author Note]',0,NULL,'[Author Info]',0,NULL,NULL,'Author',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(485,'description','textarea',0,'Description',25,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(486,'apps_icon','text',0,'Apps Icon',26,1,'','[Apps Icon Note]',0,NULL,'[Apps Icon Info]',0,NULL,NULL,'Apps Icon',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(487,'name','text',0,'Name',27,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(488,'path','text',0,'Path',28,1,'','[Path Note]',0,NULL,'[Path Info]',0,NULL,NULL,'Path',NULL,NULL,NULL,0,0,'',0,0,'',40,1,NULL),
	(489,'id','text',1,'Id',15,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',260,1,NULL),
	(490,'type_id','text',1,'Type Id',16,1,'app','[Type Id Note]',0,NULL,'[Type Id Info]',0,NULL,NULL,'Type Id',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(491,'is_required','yesno',1,'Is Required',17,0,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(492,'is_active','yesno',1,'Is Active',18,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(493,'theme_id','text',0,'Theme Id',19,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(494,'priority','text',0,'Priority',20,1,'1','[Priority Note]',0,NULL,'[Priority Info]',0,NULL,NULL,'Priority',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(495,'title','text',0,'Title',21,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(496,'version','text',1,'Version',22,1,'4.0.1','[Version Note]',0,NULL,'[Version Info]',0,NULL,NULL,'Version',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(497,'latest_version','text',0,'Latest Version',23,1,'','[Latest Version Note]',0,NULL,'[Latest Version Info]',0,NULL,NULL,'Latest Version',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(498,'author','text',1,'Author',24,1,'n/a','[Author Note]',0,NULL,'[Author Info]',0,NULL,NULL,'Author',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(499,'description','textarea',0,'Description',25,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(500,'apps_icon','text',0,'Apps Icon',26,1,'','[Apps Icon Note]',0,NULL,'[Apps Icon Info]',0,NULL,NULL,'Apps Icon',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(501,'name','text',0,'Name',27,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(502,'path','text',0,'Path',28,1,'','[Path Note]',0,NULL,'[Path Info]',0,NULL,NULL,'Path',NULL,NULL,NULL,0,0,'',0,0,'',260,1,NULL),
	(503,'id','text',1,'Id',15,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',150,1,NULL),
	(504,'type_id','text',1,'Type Id',16,1,'app','[Type Id Note]',0,NULL,'[Type Id Info]',0,NULL,NULL,'Type Id',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(505,'is_required','yesno',1,'Is Required',17,0,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(506,'is_active','yesno',1,'Is Active',18,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(507,'theme_id','text',0,'Theme Id',19,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(508,'priority','text',0,'Priority',20,1,'1','[Priority Note]',0,NULL,'[Priority Info]',0,NULL,NULL,'Priority',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(509,'title','text',0,'Title',21,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(510,'version','text',1,'Version',22,1,'4.0.1','[Version Note]',0,NULL,'[Version Info]',0,NULL,NULL,'Version',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(511,'latest_version','text',0,'Latest Version',23,1,'','[Latest Version Note]',0,NULL,'[Latest Version Info]',0,NULL,NULL,'Latest Version',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(512,'author','text',1,'Author',24,1,'n/a','[Author Note]',0,NULL,'[Author Info]',0,NULL,NULL,'Author',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(513,'description','textarea',0,'Description',25,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(514,'apps_icon','text',0,'Apps Icon',26,1,'','[Apps Icon Note]',0,NULL,'[Apps Icon Info]',0,NULL,NULL,'Apps Icon',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(515,'name','text',0,'Name',27,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(516,'path','text',0,'Path',28,1,'','[Path Note]',0,NULL,'[Path Info]',0,NULL,NULL,'Path',NULL,NULL,NULL,0,0,'',0,0,'',150,1,NULL),
	(517,'id','text',1,'Id',15,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',370,1,NULL),
	(518,'type_id','text',1,'Type Id',16,1,'app','[Type Id Note]',0,NULL,'[Type Id Info]',0,NULL,NULL,'Type Id',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(519,'is_required','yesno',1,'Is Required',17,0,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(520,'is_active','yesno',1,'Is Active',18,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(521,'theme_id','text',0,'Theme Id',19,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(522,'priority','text',0,'Priority',20,1,'1','[Priority Note]',0,NULL,'[Priority Info]',0,NULL,NULL,'Priority',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(523,'title','text',0,'Title',21,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(524,'version','text',1,'Version',22,1,'4.0.1','[Version Note]',0,NULL,'[Version Info]',0,NULL,NULL,'Version',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(525,'latest_version','text',0,'Latest Version',23,1,'','[Latest Version Note]',0,NULL,'[Latest Version Info]',0,NULL,NULL,'Latest Version',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(526,'author','text',1,'Author',24,1,'n/a','[Author Note]',0,NULL,'[Author Info]',0,NULL,NULL,'Author',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(527,'description','textarea',0,'Description',25,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(528,'apps_icon','text',0,'Apps Icon',26,1,'','[Apps Icon Note]',0,NULL,'[Apps Icon Info]',0,NULL,NULL,'Apps Icon',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(529,'name','text',0,'Name',27,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(530,'path','text',0,'Path',28,1,'','[Path Note]',0,NULL,'[Path Info]',0,NULL,NULL,'Path',NULL,NULL,NULL,0,0,'',0,0,'',370,1,NULL),
	(531,'id','text',1,'Id',15,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',462,1,NULL),
	(532,'type_id','text',1,'Type Id',16,1,'app','[Type Id Note]',0,NULL,'[Type Id Info]',0,NULL,NULL,'Type Id',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(533,'is_required','yesno',1,'Is Required',17,0,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(534,'is_active','yesno',1,'Is Active',18,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(535,'theme_id','text',0,'Theme Id',19,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(536,'priority','text',0,'Priority',20,1,'1','[Priority Note]',0,NULL,'[Priority Info]',0,NULL,NULL,'Priority',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(537,'title','text',0,'Title',21,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(538,'version','text',1,'Version',22,1,'4.0.1','[Version Note]',0,NULL,'[Version Info]',0,NULL,NULL,'Version',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(539,'latest_version','text',0,'Latest Version',23,1,'','[Latest Version Note]',0,NULL,'[Latest Version Info]',0,NULL,NULL,'Latest Version',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(540,'author','text',1,'Author',24,1,'n/a','[Author Note]',0,NULL,'[Author Info]',0,NULL,NULL,'Author',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(541,'description','textarea',0,'Description',25,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(542,'apps_icon','text',0,'Apps Icon',26,1,'','[Apps Icon Note]',0,NULL,'[Apps Icon Info]',0,NULL,NULL,'Apps Icon',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(543,'name','text',0,'Name',27,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(544,'path','text',0,'Path',28,1,'','[Path Note]',0,NULL,'[Path Info]',0,NULL,NULL,'Path',NULL,NULL,NULL,0,0,'',0,0,'',462,1,NULL),
	(545,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',41,1,NULL),
	(546,'role_id','text',1,'Role Id',7,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',41,1,NULL),
	(547,'group_name','text',1,'Group Name',8,1,'','[Group Name Note]',0,NULL,'[Group Name Info]',0,NULL,NULL,'Group Name',NULL,NULL,NULL,0,0,'',0,0,'',41,1,NULL),
	(548,'action_name','text',1,'Action Name',9,1,'','[Action Name Note]',0,NULL,'[Action Name Info]',0,NULL,NULL,'Action Name',NULL,NULL,NULL,0,0,'',0,0,'',41,1,NULL),
	(549,'params','textarea',1,'Params',10,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',41,1,NULL),
	(550,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',261,1,NULL),
	(551,'role_id','text',1,'Role Id',7,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',261,1,NULL),
	(552,'group_name','text',1,'Group Name',8,1,'','[Group Name Note]',0,NULL,'[Group Name Info]',0,NULL,NULL,'Group Name',NULL,NULL,NULL,0,0,'',0,0,'',261,1,NULL),
	(553,'action_name','text',1,'Action Name',9,1,'','[Action Name Note]',0,NULL,'[Action Name Info]',0,NULL,NULL,'Action Name',NULL,NULL,NULL,0,0,'',0,0,'',261,1,NULL),
	(554,'params','textarea',1,'Params',10,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',261,1,NULL),
	(555,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',151,1,NULL),
	(556,'role_id','text',1,'Role Id',7,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',151,1,NULL),
	(557,'group_name','text',1,'Group Name',8,1,'','[Group Name Note]',0,NULL,'[Group Name Info]',0,NULL,NULL,'Group Name',NULL,NULL,NULL,0,0,'',0,0,'',151,1,NULL),
	(558,'action_name','text',1,'Action Name',9,1,'','[Action Name Note]',0,NULL,'[Action Name Info]',0,NULL,NULL,'Action Name',NULL,NULL,NULL,0,0,'',0,0,'',151,1,NULL),
	(559,'params','textarea',1,'Params',10,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',151,1,NULL),
	(560,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',371,1,NULL),
	(561,'role_id','text',1,'Role Id',7,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',371,1,NULL),
	(562,'group_name','text',1,'Group Name',8,1,'','[Group Name Note]',0,NULL,'[Group Name Info]',0,NULL,NULL,'Group Name',NULL,NULL,NULL,0,0,'',0,0,'',371,1,NULL),
	(563,'action_name','text',1,'Action Name',9,1,'','[Action Name Note]',0,NULL,'[Action Name Info]',0,NULL,NULL,'Action Name',NULL,NULL,NULL,0,0,'',0,0,'',371,1,NULL),
	(564,'params','textarea',1,'Params',10,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',371,1,NULL),
	(565,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',463,1,NULL),
	(566,'role_id','text',1,'Role Id',7,1,'','[Role Id Note]',0,NULL,'[Role Id Info]',0,NULL,NULL,'Role Id',NULL,NULL,NULL,0,0,'',0,0,'',463,1,NULL),
	(567,'group_name','text',1,'Group Name',8,1,'','[Group Name Note]',0,NULL,'[Group Name Info]',0,NULL,NULL,'Group Name',NULL,NULL,NULL,0,0,'',0,0,'',463,1,NULL),
	(568,'action_name','text',1,'Action Name',9,1,'','[Action Name Note]',0,NULL,'[Action Name Info]',0,NULL,NULL,'Action Name',NULL,NULL,NULL,0,0,'',0,0,'',463,1,NULL),
	(569,'params','textarea',1,'Params',10,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',463,1,NULL),
	(600,'meta_id','text',1,'Meta Id',7,1,'','[Meta Id Note]',0,NULL,'[Meta Id Info]',0,NULL,NULL,'Meta Id',NULL,NULL,NULL,0,0,'',1,1,'',570,1,NULL),
	(601,'package_id','select',0,'Package Id',8,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',570,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(602,'table_name','text',0,'Table Name',9,1,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',0,0,'',570,1,NULL),
	(603,'action_type','text',0,'Action Type',10,1,'','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',570,1,NULL),
	(604,'action_id','text',0,'Action Id',11,1,'skip','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',570,1,NULL),
	(605,'text_domain','text',0,'Text Domain',12,1,'','[Text Domain Note]',0,NULL,'[Text Domain Info]',0,NULL,NULL,'Text Domain',NULL,NULL,NULL,0,0,'',0,0,'',570,1,NULL),
	(606,'meta_id','text',1,'Meta Id',7,1,'','[Meta Id Note]',0,NULL,'[Meta Id Info]',0,NULL,NULL,'Meta Id',NULL,NULL,NULL,0,0,'',1,1,'',576,1,NULL),
	(607,'package_id','select',0,'Package Id',8,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',576,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(608,'table_name','text',0,'Table Name',9,1,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',0,0,'',576,1,NULL),
	(609,'action_type','text',0,'Action Type',10,1,'','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',576,1,NULL),
	(610,'action_id','text',0,'Action Id',11,1,'skip','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',576,1,NULL),
	(611,'text_domain','text',0,'Text Domain',12,1,'','[Text Domain Note]',0,NULL,'[Text Domain Info]',0,NULL,NULL,'Text Domain',NULL,NULL,NULL,0,0,'',0,0,'',576,1,NULL),
	(612,'meta_id','text',1,'Meta Id',7,0,'','[Meta Id Note]',0,NULL,'[Meta Id Info]',0,NULL,NULL,'Meta Id',NULL,NULL,NULL,0,0,'',1,1,'',573,1,NULL),
	(613,'package_id','select',0,'Package Id',8,0,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',573,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(614,'table_name','text',0,'Table Name',9,0,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',0,0,'',573,1,NULL),
	(615,'action_type','text',0,'Action Type',10,0,'','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',573,1,NULL),
	(616,'action_id','text',0,'Action Id',11,0,'skip','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',573,1,NULL),
	(617,'text_domain','text',0,'Text Domain',12,1,'','',0,NULL,'',0,NULL,NULL,'Text Domain',NULL,NULL,NULL,0,0,'',0,0,'',573,1,NULL),
	(618,'meta_id','text',1,'Meta Id',7,1,'','[Meta Id Note]',0,NULL,'[Meta Id Info]',0,NULL,NULL,'Meta Id',NULL,NULL,NULL,0,0,'',1,1,'',579,1,NULL),
	(619,'package_id','select',0,'Package Id',8,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',579,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(620,'table_name','text',0,'Table Name',9,1,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',0,0,'',579,1,NULL),
	(621,'action_type','text',0,'Action Type',10,1,'','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',579,1,NULL),
	(622,'action_id','text',0,'Action Id',11,1,'skip','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',579,1,NULL),
	(623,'text_domain','text',0,'Text Domain',12,1,'','[Text Domain Note]',0,NULL,'[Text Domain Info]',0,NULL,NULL,'Text Domain',NULL,NULL,NULL,0,0,'',0,0,'',579,1,NULL),
	(624,'meta_id','text',1,'Meta Id',7,1,'','[Meta Id Note]',0,NULL,'[Meta Id Info]',0,NULL,NULL,'Meta Id',NULL,NULL,NULL,0,0,'',1,1,'',582,1,NULL),
	(625,'package_id','select',0,'Package Id',8,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',582,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(626,'table_name','text',0,'Table Name',9,1,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(627,'action_type','text',0,'Action Type',10,1,'','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(628,'action_id','text',0,'Action Id',11,1,'skip','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(629,'text_domain','text',0,'Text Domain',12,1,'','[Text Domain Note]',0,NULL,'[Text Domain Info]',0,NULL,NULL,'Text Domain',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(630,'element_id','text',1,'Element Id',23,1,'','[Element Id Note]',0,NULL,'[Element Id Info]',0,NULL,NULL,'Element Id',NULL,NULL,NULL,0,0,'',1,1,'',571,1,NULL),
	(631,'meta_id','text',1,'Meta Id',24,1,'','[Meta Id Note]',0,NULL,'[Meta Id Info]',0,NULL,NULL,'Meta Id',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(632,'is_identity','yesno',1,'Is Identity',25,1,'0','[Is Identity Note]',0,NULL,'[Is Identity Info]',0,NULL,NULL,'Is Identity',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(633,'is_primary','yesno',0,'Is Primary',26,1,'0','[Is Primary Note]',0,NULL,'[Is Primary Info]',0,NULL,NULL,'Is Primary',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(634,'element_name','text',0,'Element Name',27,1,'','[Element Name Note]',0,NULL,'[Element Name Info]',0,NULL,NULL,'Element Name',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(635,'factory_id','text',1,'Factory Id',28,1,'','[Factory Id Note]',0,NULL,'[Factory Id Info]',0,NULL,NULL,'Factory Id',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(636,'label','text',1,'Label',29,1,'','[Label Note]',0,NULL,'[Label Info]',0,NULL,NULL,'Label',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(637,'ordering','text',1,'Sort Order',30,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(638,'is_active','yesno',1,'Is Active',31,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(639,'default_value','text',0,'Default Value',32,1,'','[Default Value Note]',0,NULL,'[Default Value Info]',0,NULL,NULL,'Default Value',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(640,'note','text',1,'Note',33,1,'','[Note Note]',0,NULL,'[Note Info]',0,NULL,NULL,'Note',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(641,'info','text',1,'Info',34,1,'','[Info Note]',0,NULL,'[Info Info]',0,NULL,NULL,'Info',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(642,'placeholder','text',1,'Placeholder',35,1,'','[Placeholder Note]',0,NULL,'[Placeholder Info]',0,NULL,NULL,'Placeholder',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(643,'max_length','text',0,'Max Length',36,1,'','[Max Length Note]',0,NULL,'[Max Length Info]',0,NULL,NULL,'Max Length',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(644,'rows','text',0,'Rows',37,1,'','[Rows Note]',0,NULL,'[Rows Info]',0,NULL,NULL,'Rows',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(645,'cols','text',0,'Cols',38,1,'','[Cols Note]',0,NULL,'[Cols Info]',0,NULL,NULL,'Cols',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(646,'is_require','yesno',1,'Is Require',39,1,'0','[Is Require Note]',0,NULL,'[Is Require Info]',0,NULL,NULL,'Is Require',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(647,'is_readonly','yesno',1,'Is Readonly',40,1,'0','[Is Readonly Note]',0,NULL,'[Is Readonly Info]',0,NULL,NULL,'Is Readonly',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(648,'is_disabled','yesno',1,'Is Disabled',41,1,'0','[Is Disabled Note]',0,NULL,'[Is Disabled Info]',0,NULL,NULL,'Is Disabled',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(649,'class_name','text',0,'Class Name',42,1,'','[Class Name Note]',0,NULL,'[Class Name Info]',0,NULL,NULL,'Class Name',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(650,'data_cmd','text',0,'Data Cmd',43,1,'','[Data Cmd Note]',0,NULL,'[Data Cmd Info]',0,NULL,NULL,'Data Cmd',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(651,'primary_length','text',0,'Primary Length',44,1,'0','[Primary Length Note]',0,NULL,'[Primary Length Info]',0,NULL,NULL,'Primary Length',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(652,'element_id','text',1,'Element Id',23,1,'','[Element Id Note]',0,NULL,'[Element Id Info]',0,NULL,NULL,'Element Id',NULL,NULL,NULL,0,0,'',1,1,'',577,1,NULL),
	(653,'meta_id','text',1,'Meta Id',24,1,'','[Meta Id Note]',0,NULL,'[Meta Id Info]',0,NULL,NULL,'Meta Id',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(654,'is_identity','yesno',1,'Is Identity',25,1,'0','[Is Identity Note]',0,NULL,'[Is Identity Info]',0,NULL,NULL,'Is Identity',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(655,'is_primary','yesno',0,'Is Primary',26,1,'0','[Is Primary Note]',0,NULL,'[Is Primary Info]',0,NULL,NULL,'Is Primary',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(656,'element_name','text',0,'Element Name',27,1,'','[Element Name Note]',0,NULL,'[Element Name Info]',0,NULL,NULL,'Element Name',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(657,'factory_id','text',1,'Factory Id',28,1,'','[Factory Id Note]',0,NULL,'[Factory Id Info]',0,NULL,NULL,'Factory Id',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(658,'label','text',1,'Label',29,1,'','[Label Note]',0,NULL,'[Label Info]',0,NULL,NULL,'Label',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(659,'ordering','text',1,'Sort Order',30,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(660,'is_active','yesno',1,'Is Active',31,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(661,'default_value','text',0,'Default Value',32,1,'','[Default Value Note]',0,NULL,'[Default Value Info]',0,NULL,NULL,'Default Value',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(662,'note','text',1,'Note',33,1,'','[Note Note]',0,NULL,'[Note Info]',0,NULL,NULL,'Note',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(663,'info','text',1,'Info',34,1,'','[Info Note]',0,NULL,'[Info Info]',0,NULL,NULL,'Info',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(664,'placeholder','text',1,'Placeholder',35,1,'','[Placeholder Note]',0,NULL,'[Placeholder Info]',0,NULL,NULL,'Placeholder',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(665,'max_length','text',0,'Max Length',36,1,'','[Max Length Note]',0,NULL,'[Max Length Info]',0,NULL,NULL,'Max Length',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(666,'rows','text',0,'Rows',37,1,'','[Rows Note]',0,NULL,'[Rows Info]',0,NULL,NULL,'Rows',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(667,'cols','text',0,'Cols',38,1,'','[Cols Note]',0,NULL,'[Cols Info]',0,NULL,NULL,'Cols',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(668,'is_require','yesno',1,'Is Require',39,1,'0','[Is Require Note]',0,NULL,'[Is Require Info]',0,NULL,NULL,'Is Require',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(669,'is_readonly','yesno',1,'Is Readonly',40,1,'0','[Is Readonly Note]',0,NULL,'[Is Readonly Info]',0,NULL,NULL,'Is Readonly',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(670,'is_disabled','yesno',1,'Is Disabled',41,1,'0','[Is Disabled Note]',0,NULL,'[Is Disabled Info]',0,NULL,NULL,'Is Disabled',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(671,'class_name','text',0,'Class Name',42,1,'','[Class Name Note]',0,NULL,'[Class Name Info]',0,NULL,NULL,'Class Name',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(672,'data_cmd','text',0,'Data Cmd',43,1,'','[Data Cmd Note]',0,NULL,'[Data Cmd Info]',0,NULL,NULL,'Data Cmd',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(673,'primary_length','text',0,'Primary Length',44,1,'0','[Primary Length Note]',0,NULL,'[Primary Length Info]',0,NULL,NULL,'Primary Length',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(674,'element_id','text',1,'Element Id',23,1,'','[Element Id Note]',0,NULL,'[Element Id Info]',0,NULL,NULL,'Element Id',NULL,NULL,NULL,0,0,'',1,1,'',574,1,NULL),
	(675,'meta_id','text',1,'Meta Id',24,1,'','[Meta Id Note]',0,NULL,'[Meta Id Info]',0,NULL,NULL,'Meta Id',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(676,'is_identity','yesno',1,'Is Identity',25,1,'0','[Is Identity Note]',0,NULL,'[Is Identity Info]',0,NULL,NULL,'Is Identity',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(677,'is_primary','yesno',0,'Is Primary',26,1,'0','[Is Primary Note]',0,NULL,'[Is Primary Info]',0,NULL,NULL,'Is Primary',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(678,'element_name','text',0,'Element Name',27,1,'','[Element Name Note]',0,NULL,'[Element Name Info]',0,NULL,NULL,'Element Name',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(679,'factory_id','text',1,'Factory Id',28,1,'','[Factory Id Note]',0,NULL,'[Factory Id Info]',0,NULL,NULL,'Factory Id',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(680,'label','text',1,'Label',29,1,'','[Label Note]',0,NULL,'[Label Info]',0,NULL,NULL,'Label',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(681,'ordering','text',1,'Sort Order',30,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(682,'is_active','yesno',1,'Is Active',31,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(683,'default_value','text',0,'Default Value',32,1,'','[Default Value Note]',0,NULL,'[Default Value Info]',0,NULL,NULL,'Default Value',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(684,'note','text',1,'Note',33,1,'','[Note Note]',0,NULL,'[Note Info]',0,NULL,NULL,'Note',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(685,'info','text',1,'Info',34,1,'','[Info Note]',0,NULL,'[Info Info]',0,NULL,NULL,'Info',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(686,'placeholder','text',1,'Placeholder',35,1,'','[Placeholder Note]',0,NULL,'[Placeholder Info]',0,NULL,NULL,'Placeholder',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(687,'max_length','text',0,'Max Length',36,1,'','[Max Length Note]',0,NULL,'[Max Length Info]',0,NULL,NULL,'Max Length',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(688,'rows','text',0,'Rows',37,1,'','[Rows Note]',0,NULL,'[Rows Info]',0,NULL,NULL,'Rows',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(689,'cols','text',0,'Cols',38,1,'','[Cols Note]',0,NULL,'[Cols Info]',0,NULL,NULL,'Cols',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(690,'is_require','yesno',1,'Is Require',39,1,'0','[Is Require Note]',0,NULL,'[Is Require Info]',0,NULL,NULL,'Is Require',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(691,'is_readonly','yesno',1,'Is Readonly',40,1,'0','[Is Readonly Note]',0,NULL,'[Is Readonly Info]',0,NULL,NULL,'Is Readonly',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(692,'is_disabled','yesno',1,'Is Disabled',41,1,'0','[Is Disabled Note]',0,NULL,'[Is Disabled Info]',0,NULL,NULL,'Is Disabled',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(693,'class_name','text',0,'Class Name',42,1,'','[Class Name Note]',0,NULL,'[Class Name Info]',0,NULL,NULL,'Class Name',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(694,'data_cmd','text',0,'Data Cmd',43,1,'','[Data Cmd Note]',0,NULL,'[Data Cmd Info]',0,NULL,NULL,'Data Cmd',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(695,'primary_length','text',0,'Primary Length',44,1,'0','[Primary Length Note]',0,NULL,'[Primary Length Info]',0,NULL,NULL,'Primary Length',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(696,'element_id','text',1,'Element Id',23,1,'','[Element Id Note]',0,NULL,'[Element Id Info]',0,NULL,NULL,'Element Id',NULL,NULL,NULL,0,0,'',1,1,'',580,1,NULL),
	(697,'meta_id','text',1,'Meta Id',24,1,'','[Meta Id Note]',0,NULL,'[Meta Id Info]',0,NULL,NULL,'Meta Id',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(698,'is_identity','yesno',1,'Is Identity',25,1,'0','[Is Identity Note]',0,NULL,'[Is Identity Info]',0,NULL,NULL,'Is Identity',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(699,'is_primary','yesno',0,'Is Primary',26,1,'0','[Is Primary Note]',0,NULL,'[Is Primary Info]',0,NULL,NULL,'Is Primary',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(700,'element_name','text',0,'Element Name',27,1,'','[Element Name Note]',0,NULL,'[Element Name Info]',0,NULL,NULL,'Element Name',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(701,'factory_id','text',1,'Factory Id',28,1,'','[Factory Id Note]',0,NULL,'[Factory Id Info]',0,NULL,NULL,'Factory Id',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(702,'label','text',1,'Label',29,1,'','[Label Note]',0,NULL,'[Label Info]',0,NULL,NULL,'Label',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(703,'ordering','text',1,'Sort Order',30,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(704,'is_active','yesno',1,'Is Active',31,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(705,'default_value','text',0,'Default Value',32,1,'','[Default Value Note]',0,NULL,'[Default Value Info]',0,NULL,NULL,'Default Value',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(706,'note','text',1,'Note',33,1,'','[Note Note]',0,NULL,'[Note Info]',0,NULL,NULL,'Note',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(707,'info','text',1,'Info',34,1,'','[Info Note]',0,NULL,'[Info Info]',0,NULL,NULL,'Info',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(708,'placeholder','text',1,'Placeholder',35,1,'','[Placeholder Note]',0,NULL,'[Placeholder Info]',0,NULL,NULL,'Placeholder',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(709,'max_length','text',0,'Max Length',36,1,'','[Max Length Note]',0,NULL,'[Max Length Info]',0,NULL,NULL,'Max Length',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(710,'rows','text',0,'Rows',37,1,'','[Rows Note]',0,NULL,'[Rows Info]',0,NULL,NULL,'Rows',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(711,'cols','text',0,'Cols',38,1,'','[Cols Note]',0,NULL,'[Cols Info]',0,NULL,NULL,'Cols',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(712,'is_require','yesno',1,'Is Require',39,1,'0','[Is Require Note]',0,NULL,'[Is Require Info]',0,NULL,NULL,'Is Require',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(713,'is_readonly','yesno',1,'Is Readonly',40,1,'0','[Is Readonly Note]',0,NULL,'[Is Readonly Info]',0,NULL,NULL,'Is Readonly',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(714,'is_disabled','yesno',1,'Is Disabled',41,1,'0','[Is Disabled Note]',0,NULL,'[Is Disabled Info]',0,NULL,NULL,'Is Disabled',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(715,'class_name','text',0,'Class Name',42,1,'','[Class Name Note]',0,NULL,'[Class Name Info]',0,NULL,NULL,'Class Name',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(716,'data_cmd','text',0,'Data Cmd',43,1,'','[Data Cmd Note]',0,NULL,'[Data Cmd Info]',0,NULL,NULL,'Data Cmd',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(717,'primary_length','text',0,'Primary Length',44,1,'0','[Primary Length Note]',0,NULL,'[Primary Length Info]',0,NULL,NULL,'Primary Length',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(718,'element_id','text',1,'Element Id',23,1,'','[Element Id Note]',0,NULL,'[Element Id Info]',0,NULL,NULL,'Element Id',NULL,NULL,NULL,0,0,'',1,1,'',583,1,NULL),
	(719,'meta_id','text',1,'Meta Id',24,1,'','[Meta Id Note]',0,NULL,'[Meta Id Info]',0,NULL,NULL,'Meta Id',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(720,'is_identity','yesno',1,'Is Identity',25,1,'0','[Is Identity Note]',0,NULL,'[Is Identity Info]',0,NULL,NULL,'Is Identity',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(721,'is_primary','yesno',0,'Is Primary',26,1,'0','[Is Primary Note]',0,NULL,'[Is Primary Info]',0,NULL,NULL,'Is Primary',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(722,'element_name','text',0,'Element Name',27,1,'','[Element Name Note]',0,NULL,'[Element Name Info]',0,NULL,NULL,'Element Name',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(723,'factory_id','text',1,'Factory Id',28,1,'','[Factory Id Note]',0,NULL,'[Factory Id Info]',0,NULL,NULL,'Factory Id',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(724,'label','text',1,'Label',29,1,'','[Label Note]',0,NULL,'[Label Info]',0,NULL,NULL,'Label',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(725,'ordering','text',1,'Sort Order',30,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(726,'is_active','yesno',1,'Is Active',31,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(727,'default_value','text',0,'Default Value',32,1,'','[Default Value Note]',0,NULL,'[Default Value Info]',0,NULL,NULL,'Default Value',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(728,'note','text',1,'Note',33,1,'','[Note Note]',0,NULL,'[Note Info]',0,NULL,NULL,'Note',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(729,'info','text',1,'Info',34,1,'','[Info Note]',0,NULL,'[Info Info]',0,NULL,NULL,'Info',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(730,'placeholder','text',1,'Placeholder',35,1,'','[Placeholder Note]',0,NULL,'[Placeholder Info]',0,NULL,NULL,'Placeholder',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(731,'max_length','text',0,'Max Length',36,1,'','[Max Length Note]',0,NULL,'[Max Length Info]',0,NULL,NULL,'Max Length',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(732,'rows','text',0,'Rows',37,1,'','[Rows Note]',0,NULL,'[Rows Info]',0,NULL,NULL,'Rows',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(733,'cols','text',0,'Cols',38,1,'','[Cols Note]',0,NULL,'[Cols Info]',0,NULL,NULL,'Cols',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(734,'is_require','yesno',1,'Is Require',39,1,'0','[Is Require Note]',0,NULL,'[Is Require Info]',0,NULL,NULL,'Is Require',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(735,'is_readonly','yesno',1,'Is Readonly',40,1,'0','[Is Readonly Note]',0,NULL,'[Is Readonly Info]',0,NULL,NULL,'Is Readonly',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(736,'is_disabled','yesno',1,'Is Disabled',41,1,'0','[Is Disabled Note]',0,NULL,'[Is Disabled Info]',0,NULL,NULL,'Is Disabled',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(737,'class_name','text',0,'Class Name',42,1,'','[Class Name Note]',0,NULL,'[Class Name Info]',0,NULL,NULL,'Class Name',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(738,'data_cmd','text',0,'Data Cmd',43,1,'','[Data Cmd Note]',0,NULL,'[Data Cmd Info]',0,NULL,NULL,'Data Cmd',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(739,'primary_length','text',0,'Primary Length',44,1,'0','[Primary Length Note]',0,NULL,'[Primary Length Info]',0,NULL,NULL,'Primary Length',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(740,'table_name','text',1,'Table Name',4,1,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',1,0,'',572,1,NULL),
	(741,'package_id','select',1,'Package Id',5,1,'undefined','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',572,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(742,'action_id','text',1,'Action Id',6,1,'default','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',572,1,NULL),
	(743,'table_name','text',1,'Table Name',4,1,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',1,0,'',578,1,NULL),
	(744,'package_id','select',1,'Package Id',5,1,'undefined','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',578,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(745,'action_id','text',1,'Action Id',6,1,'default','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',578,1,NULL),
	(746,'table_name','text',1,'Table Name',4,1,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',1,0,'',575,1,NULL),
	(747,'package_id','select',1,'Package Id',5,1,'undefined','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',575,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(748,'action_id','text',1,'Action Id',6,1,'default','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',575,1,NULL),
	(749,'table_name','text',1,'Table Name',4,1,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',1,0,'',581,1,NULL),
	(750,'package_id','select',1,'Package Id',5,1,'undefined','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',581,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(751,'action_id','text',1,'Action Id',6,1,'default','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',581,1,NULL),
	(752,'table_name','text',1,'Table Name',4,1,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',1,0,'',584,1,NULL),
	(753,'package_id','select',1,'Package Id',5,1,'undefined','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',584,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(754,'action_id','text',1,'Action Id',6,1,'default','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',584,1,NULL),
	(755,'currency_id','text',1,'Currency Id',6,1,'','[Currency Id Note]',0,NULL,'[Currency Id Info]',0,NULL,NULL,'Currency Id',NULL,NULL,NULL,0,0,'',1,0,'',60,1,NULL),
	(756,'symbol','text',1,'Symbol',7,1,'','[Symbol Note]',0,NULL,'[Symbol Info]',0,NULL,NULL,'Symbol',NULL,NULL,NULL,0,0,'',0,0,'',60,1,NULL),
	(757,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',60,1,NULL),
	(758,'ordering','text',1,'Sort Order',9,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',60,1,NULL),
	(759,'is_active','yesno',1,'Is Active',10,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',60,1,NULL),
	(760,'currency_id','text',1,'Currency Id',6,1,'','[Currency Id Note]',0,NULL,'[Currency Id Info]',0,NULL,NULL,'Currency Id',NULL,NULL,NULL,0,0,'',1,0,'',280,1,NULL),
	(761,'symbol','text',1,'Symbol',7,1,'','[Symbol Note]',0,NULL,'[Symbol Info]',0,NULL,NULL,'Symbol',NULL,NULL,NULL,0,0,'',0,0,'',280,1,NULL),
	(762,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',280,1,NULL),
	(763,'ordering','text',1,'Sort Order',9,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',280,1,NULL),
	(764,'is_active','yesno',1,'Is Active',10,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',280,1,NULL),
	(765,'currency_id','text',1,'Currency Id',6,1,'','[Currency Id Note]',0,NULL,'[Currency Id Info]',0,NULL,NULL,'Currency Id',NULL,NULL,NULL,0,0,'',1,0,'',170,1,NULL),
	(766,'symbol','text',1,'Symbol',7,1,'','[Symbol Note]',0,NULL,'[Symbol Info]',0,NULL,NULL,'Symbol',NULL,NULL,NULL,0,0,'',0,0,'',170,1,NULL),
	(767,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',170,1,NULL),
	(768,'ordering','text',1,'Sort Order',9,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',170,1,NULL),
	(769,'is_active','yesno',1,'Is Active',10,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',170,1,NULL),
	(770,'currency_id','text',1,'Currency Id',6,1,'','[Currency Id Note]',0,NULL,'[Currency Id Info]',0,NULL,NULL,'Currency Id',NULL,NULL,NULL,0,0,'',1,0,'',390,1,NULL),
	(771,'symbol','text',1,'Symbol',7,1,'','[Symbol Note]',0,NULL,'[Symbol Info]',0,NULL,NULL,'Symbol',NULL,NULL,NULL,0,0,'',0,0,'',390,1,NULL),
	(772,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',390,1,NULL),
	(773,'ordering','text',1,'Sort Order',9,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',390,1,NULL),
	(774,'is_active','yesno',1,'Is Active',10,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',390,1,NULL),
	(775,'currency_id','text',1,'Currency Id',6,1,'','[Currency Id Note]',0,NULL,'[Currency Id Info]',0,NULL,NULL,'Currency Id',NULL,NULL,NULL,0,0,'',1,0,'',465,1,NULL),
	(776,'symbol','text',1,'Symbol',7,1,'','[Symbol Note]',0,NULL,'[Symbol Info]',0,NULL,NULL,'Symbol',NULL,NULL,NULL,0,0,'',0,0,'',465,1,NULL),
	(777,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',465,1,NULL),
	(778,'ordering','text',1,'Sort Order',9,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',465,1,NULL),
	(779,'is_active','yesno',1,'Is Active',10,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',465,1,NULL),
	(780,'locale_id','text',1,'Locale Id',7,1,'','[Locale Id Note]',0,NULL,'[Locale Id Info]',0,NULL,NULL,'Locale Id',NULL,NULL,NULL,0,0,'',1,0,'',61,1,NULL),
	(781,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',61,1,NULL),
	(782,'native_name','text',0,'Native Name',9,1,'','[Native Name Note]',0,NULL,'[Native Name Info]',0,NULL,NULL,'Native Name',NULL,NULL,NULL,0,0,'',0,0,'',61,1,NULL),
	(783,'code_6391','text',1,'Code 6391',10,1,'','[Code 6391 Note]',0,NULL,'[Code 6391 Info]',0,NULL,NULL,'Code 6391',NULL,NULL,NULL,0,0,'',0,0,'',61,1,NULL),
	(784,'direction_id','text',1,'Direction Id',11,1,'ltr','[Direction Id Note]',0,NULL,'[Direction Id Info]',0,NULL,NULL,'Direction Id',NULL,NULL,NULL,0,0,'',0,0,'',61,1,NULL),
	(785,'is_active','yesno',1,'Is Active',12,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',61,1,NULL),
	(786,'locale_id','text',1,'Locale Id',7,1,'','[Locale Id Note]',0,NULL,'[Locale Id Info]',0,NULL,NULL,'Locale Id',NULL,NULL,NULL,0,0,'',1,0,'',281,1,NULL),
	(787,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',281,1,NULL),
	(788,'native_name','text',0,'Native Name',9,1,'','[Native Name Note]',0,NULL,'[Native Name Info]',0,NULL,NULL,'Native Name',NULL,NULL,NULL,0,0,'',0,0,'',281,1,NULL),
	(789,'code_6391','text',1,'Code 6391',10,1,'','[Code 6391 Note]',0,NULL,'[Code 6391 Info]',0,NULL,NULL,'Code 6391',NULL,NULL,NULL,0,0,'',0,0,'',281,1,NULL),
	(790,'direction_id','text',1,'Direction Id',11,1,'ltr','[Direction Id Note]',0,NULL,'[Direction Id Info]',0,NULL,NULL,'Direction Id',NULL,NULL,NULL,0,0,'',0,0,'',281,1,NULL),
	(791,'is_active','yesno',1,'Is Active',12,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',281,1,NULL),
	(792,'locale_id','text',1,'Locale Id',7,1,'','[Locale Id Note]',0,NULL,'[Locale Id Info]',0,NULL,NULL,'Locale Id',NULL,NULL,NULL,0,0,'',1,0,'',171,1,NULL),
	(793,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',171,1,NULL),
	(794,'native_name','text',0,'Native Name',9,1,'','[Native Name Note]',0,NULL,'[Native Name Info]',0,NULL,NULL,'Native Name',NULL,NULL,NULL,0,0,'',0,0,'',171,1,NULL),
	(795,'code_6391','text',1,'Code 6391',10,1,'','[Code 6391 Note]',0,NULL,'[Code 6391 Info]',0,NULL,NULL,'Code 6391',NULL,NULL,NULL,0,0,'',0,0,'',171,1,NULL),
	(796,'direction_id','text',1,'Direction Id',11,1,'ltr','[Direction Id Note]',0,NULL,'[Direction Id Info]',0,NULL,NULL,'Direction Id',NULL,NULL,NULL,0,0,'',0,0,'',171,1,NULL),
	(797,'is_active','yesno',1,'Is Active',12,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',171,1,NULL),
	(798,'locale_id','text',1,'Locale Id',7,1,'','[Locale Id Note]',0,NULL,'[Locale Id Info]',0,NULL,NULL,'Locale Id',NULL,NULL,NULL,0,0,'',1,0,'',391,1,NULL),
	(799,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',391,1,NULL),
	(800,'native_name','text',0,'Native Name',9,1,'','[Native Name Note]',0,NULL,'[Native Name Info]',0,NULL,NULL,'Native Name',NULL,NULL,NULL,0,0,'',0,0,'',391,1,NULL),
	(801,'code_6391','text',1,'Code 6391',10,1,'','[Code 6391 Note]',0,NULL,'[Code 6391 Info]',0,NULL,NULL,'Code 6391',NULL,NULL,NULL,0,0,'',0,0,'',391,1,NULL),
	(802,'direction_id','text',1,'Direction Id',11,1,'ltr','[Direction Id Note]',0,NULL,'[Direction Id Info]',0,NULL,NULL,'Direction Id',NULL,NULL,NULL,0,0,'',0,0,'',391,1,NULL),
	(803,'is_active','yesno',1,'Is Active',12,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',391,1,NULL),
	(804,'locale_id','text',1,'Locale Id',7,1,'','[Locale Id Note]',0,NULL,'[Locale Id Info]',0,NULL,NULL,'Locale Id',NULL,NULL,NULL,0,0,'',1,0,'',466,1,NULL),
	(805,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',466,1,NULL),
	(806,'native_name','text',0,'Native Name',9,1,'','[Native Name Note]',0,NULL,'[Native Name Info]',0,NULL,NULL,'Native Name',NULL,NULL,NULL,0,0,'',0,0,'',466,1,NULL),
	(807,'code_6391','text',1,'Code 6391',10,1,'','[Code 6391 Note]',0,NULL,'[Code 6391 Info]',0,NULL,NULL,'Code 6391',NULL,NULL,NULL,0,0,'',0,0,'',466,1,NULL),
	(808,'direction_id','text',1,'Direction Id',11,1,'ltr','[Direction Id Note]',0,NULL,'[Direction Id Info]',0,NULL,NULL,'Direction Id',NULL,NULL,NULL,0,0,'',0,0,'',466,1,NULL),
	(809,'is_active','yesno',1,'Is Active',12,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',466,1,NULL),
	(810,'message_id','text',1,'Message Id',9,1,'','[Message Id Note]',0,NULL,'[Message Id Info]',0,NULL,NULL,'Message Id',NULL,NULL,NULL,0,0,'',1,1,'',62,1,NULL),
	(811,'package_id','select',1,'Package Id',10,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',62,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(812,'locale_id','text',1,'Locale Id',11,1,'','[Locale Id Note]',0,NULL,'[Locale Id Info]',0,NULL,NULL,'Locale Id',NULL,NULL,NULL,0,0,'',0,0,'',62,1,NULL),
	(813,'domain_id','text',1,'Domain Id',12,1,'','[Domain Id Note]',0,NULL,'[Domain Id Info]',0,NULL,NULL,'Domain Id',NULL,NULL,NULL,0,0,'',0,0,'',62,1,NULL),
	(814,'message_name','text',1,'Message Name',13,1,'','[Message Name Note]',0,NULL,'[Message Name Info]',0,NULL,NULL,'Message Name',NULL,NULL,NULL,0,0,'',0,0,'',62,1,NULL),
	(815,'message_value','textarea',0,'Message Value',14,1,'','[Message Value Note]',0,NULL,'[Message Value Info]',0,NULL,NULL,'Message Value',NULL,NULL,NULL,0,0,'',0,0,'',62,1,NULL),
	(816,'is_json','yesno',1,'Is Json',15,0,'0','[Is Json Note]',0,NULL,'[Is Json Info]',0,NULL,NULL,'Is Json',NULL,NULL,NULL,0,0,'',0,0,'',62,1,NULL),
	(817,'is_updated','yesno',1,'Is Updated',16,0,'0','[Is Updated Note]',0,NULL,'[Is Updated Info]',0,NULL,NULL,'Is Updated',NULL,NULL,NULL,0,0,'',0,0,'',62,1,NULL),
	(818,'message_id','text',1,'Message Id',9,1,'','[Message Id Note]',0,NULL,'[Message Id Info]',0,NULL,NULL,'Message Id',NULL,NULL,NULL,0,0,'',1,1,'',282,1,NULL),
	(819,'package_id','select',1,'Package Id',10,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',282,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(820,'locale_id','text',1,'Locale Id',11,1,'','[Locale Id Note]',0,NULL,'[Locale Id Info]',0,NULL,NULL,'Locale Id',NULL,NULL,NULL,0,0,'',0,0,'',282,1,NULL),
	(821,'domain_id','text',1,'Domain Id',12,1,'','[Domain Id Note]',0,NULL,'[Domain Id Info]',0,NULL,NULL,'Domain Id',NULL,NULL,NULL,0,0,'',0,0,'',282,1,NULL),
	(822,'message_name','text',1,'Message Name',13,1,'','[Message Name Note]',0,NULL,'[Message Name Info]',0,NULL,NULL,'Message Name',NULL,NULL,NULL,0,0,'',0,0,'',282,1,NULL),
	(823,'message_value','textarea',0,'Message Value',14,1,'','[Message Value Note]',0,NULL,'[Message Value Info]',0,NULL,NULL,'Message Value',NULL,NULL,NULL,0,0,'',0,0,'',282,1,NULL),
	(824,'is_json','yesno',1,'Is Json',15,0,'0','[Is Json Note]',0,NULL,'[Is Json Info]',0,NULL,NULL,'Is Json',NULL,NULL,NULL,0,0,'',0,0,'',282,1,NULL),
	(825,'is_updated','yesno',1,'Is Updated',16,0,'0','[Is Updated Note]',0,NULL,'[Is Updated Info]',0,NULL,NULL,'Is Updated',NULL,NULL,NULL,0,0,'',0,0,'',282,1,NULL),
	(826,'message_id','text',1,'Message Id',9,1,'','[Message Id Note]',0,NULL,'[Message Id Info]',0,NULL,NULL,'Message Id',NULL,NULL,NULL,0,0,'',1,1,'',172,1,NULL),
	(827,'package_id','select',1,'Package Id',10,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',172,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(828,'locale_id','text',1,'Locale Id',11,1,'','[Locale Id Note]',0,NULL,'[Locale Id Info]',0,NULL,NULL,'Locale Id',NULL,NULL,NULL,0,0,'',0,0,'',172,1,NULL),
	(829,'domain_id','text',1,'Domain Id',12,1,'','[Domain Id Note]',0,NULL,'[Domain Id Info]',0,NULL,NULL,'Domain Id',NULL,NULL,NULL,0,0,'',0,0,'',172,1,NULL),
	(830,'message_name','text',1,'Message Name',13,1,'','[Message Name Note]',0,NULL,'[Message Name Info]',0,NULL,NULL,'Message Name',NULL,NULL,NULL,0,0,'',0,0,'',172,1,NULL),
	(831,'message_value','textarea',0,'Message Value',14,1,'','[Message Value Note]',0,NULL,'[Message Value Info]',0,NULL,NULL,'Message Value',NULL,NULL,NULL,0,0,'',0,0,'',172,1,NULL),
	(832,'is_json','yesno',1,'Is Json',15,0,'0','[Is Json Note]',0,NULL,'[Is Json Info]',0,NULL,NULL,'Is Json',NULL,NULL,NULL,0,0,'',0,0,'',172,1,NULL),
	(833,'is_updated','yesno',1,'Is Updated',16,0,'0','[Is Updated Note]',0,NULL,'[Is Updated Info]',0,NULL,NULL,'Is Updated',NULL,NULL,NULL,0,0,'',0,0,'',172,1,NULL),
	(834,'message_id','text',1,'Message Id',0,0,'','[Message Id Note]',0,NULL,'[Message Id Info]',0,NULL,NULL,'Message Id',NULL,NULL,NULL,0,0,'',1,1,'',392,1,NULL),
	(835,'package_id','select',1,'Package Id',10,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',392,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(836,'locale_id','select',1,'Locale Id',11,1,'','[Locale Id Note]',0,NULL,'[Locale Id Info]',0,NULL,NULL,'Locale Id',NULL,NULL,NULL,0,0,'',0,0,'',392,1,'\Phpfox::get(\'core.i18n\')->getDirectionIdOptions()'),
	(837,'domain_id','text',1,'Domain Id',12,1,'','[Domain Id Note]',0,NULL,'[Domain Id Info]',0,NULL,NULL,'Domain Id',NULL,NULL,NULL,0,0,'',0,0,'',392,1,NULL),
	(838,'message_name','text',1,'Message Name',13,0,'','[Message Name Note]',0,NULL,'[Message Name Info]',0,NULL,NULL,'Message Name',NULL,NULL,NULL,0,0,'',0,0,'',392,1,NULL),
	(839,'message_value','textarea',0,'Message Value',14,0,'','[Message Value Note]',0,NULL,'[Message Value Info]',0,NULL,NULL,'Message Value',NULL,NULL,NULL,0,0,'',0,0,'',392,1,NULL),
	(840,'is_json','yesno',1,'Is Json',15,0,'0','[Is Json Note]',0,NULL,'[Is Json Info]',0,NULL,NULL,'Is Json',NULL,NULL,NULL,0,0,'',0,0,'',392,1,NULL),
	(841,'is_updated','yesno',1,'Is Updated',16,0,'0','[Is Updated Note]',0,NULL,'[Is Updated Info]',0,NULL,NULL,'Is Updated',NULL,NULL,NULL,0,0,'',0,0,'',392,1,NULL),
	(842,'message_id','text',1,'Message Id',9,1,'','[Message Id Note]',0,NULL,'[Message Id Info]',0,NULL,NULL,'Message Id',NULL,NULL,NULL,0,0,'',1,1,'',467,1,NULL),
	(843,'package_id','select',1,'Package Id',10,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',467,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(844,'locale_id','text',1,'Locale Id',11,1,'','[Locale Id Note]',0,NULL,'[Locale Id Info]',0,NULL,NULL,'Locale Id',NULL,NULL,NULL,0,0,'',0,0,'',467,1,NULL),
	(845,'domain_id','text',1,'Domain Id',12,1,'','[Domain Id Note]',0,NULL,'[Domain Id Info]',0,NULL,NULL,'Domain Id',NULL,NULL,NULL,0,0,'',0,0,'',467,1,NULL),
	(846,'message_name','text',1,'Message Name',13,1,'','[Message Name Note]',0,NULL,'[Message Name Info]',0,NULL,NULL,'Message Name',NULL,NULL,NULL,0,0,'',0,0,'',467,1,NULL),
	(847,'message_value','textarea',0,'Message Value',14,1,'','[Message Value Note]',0,NULL,'[Message Value Info]',0,NULL,NULL,'Message Value',NULL,NULL,NULL,0,0,'',0,0,'',467,1,NULL),
	(848,'is_json','yesno',1,'Is Json',15,0,'0','[Is Json Note]',0,NULL,'[Is Json Info]',0,NULL,NULL,'Is Json',NULL,NULL,NULL,0,0,'',0,0,'',467,1,NULL),
	(849,'is_updated','yesno',1,'Is Updated',16,0,'0','[Is Updated Note]',0,NULL,'[Is Updated Info]',0,NULL,NULL,'Is Updated',NULL,NULL,NULL,0,0,'',0,0,'',467,1,NULL),
	(850,'timezone_id','text',1,'Timezone Id',7,1,'','[Timezone Id Note]',0,NULL,'[Timezone Id Info]',0,NULL,NULL,'Timezone Id',NULL,NULL,NULL,0,0,'',1,0,'',63,1,NULL),
	(851,'timezone_location','text',1,'Timezone Location',8,1,'','[Timezone Location Note]',0,NULL,'[Timezone Location Info]',0,NULL,NULL,'Timezone Location',NULL,NULL,NULL,0,0,'',0,0,'',63,1,NULL),
	(852,'is_active','yesno',1,'Is Active',9,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',63,1,NULL),
	(853,'ordering','text',1,'Sort Order',10,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',63,1,NULL),
	(854,'timezone_code','text',1,'Timezone Code',11,1,'','[Timezone Code Note]',0,NULL,'[Timezone Code Info]',0,NULL,NULL,'Timezone Code',NULL,NULL,NULL,0,0,'',0,0,'',63,1,NULL),
	(855,'timezone_offset','text',1,'Timezone Offset',12,1,'','[Timezone Offset Note]',0,NULL,'[Timezone Offset Info]',0,NULL,NULL,'Timezone Offset',NULL,NULL,NULL,0,0,'',0,0,'',63,1,NULL),
	(856,'timezone_id','text',1,'Timezone Id',7,1,'','[Timezone Id Note]',0,NULL,'[Timezone Id Info]',0,NULL,NULL,'Timezone Id',NULL,NULL,NULL,0,0,'',1,0,'',283,1,NULL),
	(857,'timezone_location','text',1,'Timezone Location',8,1,'','[Timezone Location Note]',0,NULL,'[Timezone Location Info]',0,NULL,NULL,'Timezone Location',NULL,NULL,NULL,0,0,'',0,0,'',283,1,NULL),
	(858,'is_active','yesno',1,'Is Active',9,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',283,1,NULL),
	(859,'ordering','text',1,'Sort Order',10,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',283,1,NULL),
	(860,'timezone_code','text',1,'Timezone Code',11,1,'','[Timezone Code Note]',0,NULL,'[Timezone Code Info]',0,NULL,NULL,'Timezone Code',NULL,NULL,NULL,0,0,'',0,0,'',283,1,NULL),
	(861,'timezone_offset','text',1,'Timezone Offset',12,1,'','[Timezone Offset Note]',0,NULL,'[Timezone Offset Info]',0,NULL,NULL,'Timezone Offset',NULL,NULL,NULL,0,0,'',0,0,'',283,1,NULL),
	(862,'timezone_id','text',1,'Timezone Id',7,1,'','[Timezone Id Note]',0,NULL,'[Timezone Id Info]',0,NULL,NULL,'Timezone Id',NULL,NULL,NULL,0,0,'',1,0,'',173,1,NULL),
	(863,'timezone_location','text',1,'Timezone Location',8,1,'','[Timezone Location Note]',0,NULL,'[Timezone Location Info]',0,NULL,NULL,'Timezone Location',NULL,NULL,NULL,0,0,'',0,0,'',173,1,NULL),
	(864,'is_active','yesno',1,'Is Active',9,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',173,1,NULL),
	(865,'ordering','text',1,'Sort Order',10,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',173,1,NULL),
	(866,'timezone_code','text',1,'Timezone Code',11,1,'','[Timezone Code Note]',0,NULL,'[Timezone Code Info]',0,NULL,NULL,'Timezone Code',NULL,NULL,NULL,0,0,'',0,0,'',173,1,NULL),
	(867,'timezone_offset','text',1,'Timezone Offset',12,1,'','[Timezone Offset Note]',0,NULL,'[Timezone Offset Info]',0,NULL,NULL,'Timezone Offset',NULL,NULL,NULL,0,0,'',0,0,'',173,1,NULL),
	(868,'timezone_id','text',1,'Timezone Id',7,1,'','[Timezone Id Note]',0,NULL,'[Timezone Id Info]',0,NULL,NULL,'Timezone Id',NULL,NULL,NULL,0,0,'',1,0,'',393,1,NULL),
	(869,'timezone_location','text',1,'Timezone Location',8,1,'','[Timezone Location Note]',0,NULL,'[Timezone Location Info]',0,NULL,NULL,'Timezone Location',NULL,NULL,NULL,0,0,'',0,0,'',393,1,NULL),
	(870,'is_active','yesno',1,'Is Active',9,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',393,1,NULL),
	(871,'ordering','text',1,'Sort Order',10,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',393,1,NULL),
	(872,'timezone_code','text',1,'Timezone Code',11,1,'','[Timezone Code Note]',0,NULL,'[Timezone Code Info]',0,NULL,NULL,'Timezone Code',NULL,NULL,NULL,0,0,'',0,0,'',393,1,NULL),
	(873,'timezone_offset','text',1,'Timezone Offset',12,1,'','[Timezone Offset Note]',0,NULL,'[Timezone Offset Info]',0,NULL,NULL,'Timezone Offset',NULL,NULL,NULL,0,0,'',0,0,'',393,1,NULL),
	(874,'timezone_id','text',1,'Timezone Id',7,1,'','[Timezone Id Note]',0,NULL,'[Timezone Id Info]',0,NULL,NULL,'Timezone Id',NULL,NULL,NULL,0,0,'',1,0,'',468,1,NULL),
	(875,'timezone_location','text',1,'Timezone Location',8,1,'','[Timezone Location Note]',0,NULL,'[Timezone Location Info]',0,NULL,NULL,'Timezone Location',NULL,NULL,NULL,0,0,'',0,0,'',468,1,NULL),
	(876,'is_active','yesno',1,'Is Active',9,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',468,1,NULL),
	(877,'ordering','text',1,'Sort Order',10,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',468,1,NULL),
	(878,'timezone_code','text',1,'Timezone Code',11,1,'','[Timezone Code Note]',0,NULL,'[Timezone Code Info]',0,NULL,NULL,'Timezone Code',NULL,NULL,NULL,0,0,'',0,0,'',468,1,NULL),
	(879,'timezone_offset','text',1,'Timezone Offset',12,1,'','[Timezone Offset Note]',0,NULL,'[Timezone Offset Info]',0,NULL,NULL,'Timezone Offset',NULL,NULL,NULL,0,0,'',0,0,'',468,1,NULL),
	(880,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',1,0,'',65,1,NULL),
	(881,'parent_action_id','text',0,'Parent Action Id',8,1,'','[Parent Action Id Note]',0,NULL,'[Parent Action Id Info]',0,NULL,NULL,'Parent Action Id',NULL,NULL,NULL,0,0,'',0,0,'',65,1,NULL),
	(882,'action_name','text',1,'Action Name',9,1,'','[Action Name Note]',0,NULL,'[Action Name Info]',0,NULL,NULL,'Action Name',NULL,NULL,NULL,0,0,'',0,0,'',65,1,NULL),
	(883,'package_id','select',1,'Package Id',10,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',65,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(884,'is_admin','yesno',1,'Is Admin',11,1,'1','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',65,1,NULL),
	(885,'description','textarea',0,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',65,1,NULL),
	(886,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',1,0,'',285,1,NULL),
	(887,'parent_action_id','text',0,'Parent Action Id',8,1,'','[Parent Action Id Note]',0,NULL,'[Parent Action Id Info]',0,NULL,NULL,'Parent Action Id',NULL,NULL,NULL,0,0,'',0,0,'',285,1,NULL),
	(888,'action_name','text',1,'Action Name',9,1,'','[Action Name Note]',0,NULL,'[Action Name Info]',0,NULL,NULL,'Action Name',NULL,NULL,NULL,0,0,'',0,0,'',285,1,NULL),
	(889,'package_id','select',1,'Package Id',10,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',285,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(890,'is_admin','yesno',1,'Is Admin',11,1,'1','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',285,1,NULL),
	(891,'description','textarea',0,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',285,1,NULL),
	(892,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',1,0,'',175,1,NULL),
	(893,'parent_action_id','text',0,'Parent Action Id',8,1,'','[Parent Action Id Note]',0,NULL,'[Parent Action Id Info]',0,NULL,NULL,'Parent Action Id',NULL,NULL,NULL,0,0,'',0,0,'',175,1,NULL),
	(894,'action_name','text',1,'Action Name',9,1,'','[Action Name Note]',0,NULL,'[Action Name Info]',0,NULL,NULL,'Action Name',NULL,NULL,NULL,0,0,'',0,0,'',175,1,NULL),
	(895,'package_id','select',1,'Package Id',10,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',175,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(896,'is_admin','yesno',1,'Is Admin',11,1,'1','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',175,1,NULL),
	(897,'description','textarea',0,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',175,1,NULL),
	(898,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',1,0,'',395,1,NULL),
	(899,'parent_action_id','text',0,'Parent Action Id',8,1,'','[Parent Action Id Note]',0,NULL,'[Parent Action Id Info]',0,NULL,NULL,'Parent Action Id',NULL,NULL,NULL,0,0,'',0,0,'',395,1,NULL),
	(900,'action_name','text',1,'Action Name',9,1,'','[Action Name Note]',0,NULL,'[Action Name Info]',0,NULL,NULL,'Action Name',NULL,NULL,NULL,0,0,'',0,0,'',395,1,NULL),
	(901,'package_id','select',1,'Package Id',10,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',395,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(902,'is_admin','yesno',1,'Is Admin',11,1,'1','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',395,1,NULL),
	(903,'description','textarea',0,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',395,1,NULL),
	(904,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',1,0,'',525,1,NULL),
	(905,'parent_action_id','text',0,'Parent Action Id',8,1,'','[Parent Action Id Note]',0,NULL,'[Parent Action Id Info]',0,NULL,NULL,'Parent Action Id',NULL,NULL,NULL,0,0,'',0,0,'',525,1,NULL),
	(906,'action_name','text',1,'Action Name',9,1,'','[Action Name Note]',0,NULL,'[Action Name Info]',0,NULL,NULL,'Action Name',NULL,NULL,NULL,0,0,'',0,0,'',525,1,NULL),
	(907,'package_id','select',1,'Package Id',10,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',525,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(908,'is_admin','yesno',1,'Is Admin',11,1,'1','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',525,1,NULL),
	(909,'description','textarea',0,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',525,1,NULL),
	(910,'block_id','text',1,'Block Id',9,1,'','[Block Id Note]',0,NULL,'[Block Id Info]',0,NULL,NULL,'Block Id',NULL,NULL,NULL,0,0,'',1,1,'',66,1,NULL),
	(911,'parent_id','text',1,'Parent Id',10,0,'0','[Parent Id Note]',0,NULL,'[Parent Id Info]',0,NULL,NULL,'Parent Id',NULL,NULL,NULL,0,0,'',0,0,'',66,1,NULL),
	(912,'container_id','text',1,'Container Id',11,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',0,0,'',66,1,NULL),
	(913,'location_id','text',1,'Location Id',12,1,'main','[Location Id Note]',0,NULL,'[Location Id Info]',0,NULL,NULL,'Location Id',NULL,NULL,NULL,0,0,'',0,0,'',66,1,NULL),
	(914,'component_id','text',1,'Component Id',13,1,'','[Component Id Note]',0,NULL,'[Component Id Info]',0,NULL,NULL,'Component Id',NULL,NULL,NULL,0,0,'',0,0,'',66,1,NULL),
	(915,'ordering','text',1,'Sort Order',14,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',66,1,NULL),
	(916,'is_active','yesno',1,'Is Active',15,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',66,1,NULL),
	(917,'params','textarea',1,'Params',16,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',66,1,NULL),
	(918,'block_id','text',1,'Block Id',9,1,'','[Block Id Note]',0,NULL,'[Block Id Info]',0,NULL,NULL,'Block Id',NULL,NULL,NULL,0,0,'',1,1,'',286,1,NULL),
	(919,'parent_id','text',1,'Parent Id',10,0,'0','[Parent Id Note]',0,NULL,'[Parent Id Info]',0,NULL,NULL,'Parent Id',NULL,NULL,NULL,0,0,'',0,0,'',286,1,NULL),
	(920,'container_id','text',1,'Container Id',11,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',0,0,'',286,1,NULL),
	(921,'location_id','text',1,'Location Id',12,1,'main','[Location Id Note]',0,NULL,'[Location Id Info]',0,NULL,NULL,'Location Id',NULL,NULL,NULL,0,0,'',0,0,'',286,1,NULL),
	(922,'component_id','text',1,'Component Id',13,1,'','[Component Id Note]',0,NULL,'[Component Id Info]',0,NULL,NULL,'Component Id',NULL,NULL,NULL,0,0,'',0,0,'',286,1,NULL),
	(923,'ordering','text',1,'Sort Order',14,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',286,1,NULL),
	(924,'is_active','yesno',1,'Is Active',15,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',286,1,NULL),
	(925,'params','textarea',1,'Params',16,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',286,1,NULL),
	(926,'block_id','text',1,'Block Id',9,1,'','[Block Id Note]',0,NULL,'[Block Id Info]',0,NULL,NULL,'Block Id',NULL,NULL,NULL,0,0,'',1,1,'',176,1,NULL),
	(927,'parent_id','text',1,'Parent Id',10,0,'0','[Parent Id Note]',0,NULL,'[Parent Id Info]',0,NULL,NULL,'Parent Id',NULL,NULL,NULL,0,0,'',0,0,'',176,1,NULL),
	(928,'container_id','text',1,'Container Id',11,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',0,0,'',176,1,NULL),
	(929,'location_id','text',1,'Location Id',12,1,'main','[Location Id Note]',0,NULL,'[Location Id Info]',0,NULL,NULL,'Location Id',NULL,NULL,NULL,0,0,'',0,0,'',176,1,NULL),
	(930,'component_id','text',1,'Component Id',13,1,'','[Component Id Note]',0,NULL,'[Component Id Info]',0,NULL,NULL,'Component Id',NULL,NULL,NULL,0,0,'',0,0,'',176,1,NULL),
	(931,'ordering','text',1,'Sort Order',14,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',176,1,NULL),
	(932,'is_active','yesno',1,'Is Active',15,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',176,1,NULL),
	(933,'params','textarea',1,'Params',16,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',176,1,NULL),
	(934,'block_id','text',1,'Block Id',9,1,'','[Block Id Note]',0,NULL,'[Block Id Info]',0,NULL,NULL,'Block Id',NULL,NULL,NULL,0,0,'',1,1,'',396,1,NULL),
	(935,'parent_id','text',1,'Parent Id',10,0,'0','[Parent Id Note]',0,NULL,'[Parent Id Info]',0,NULL,NULL,'Parent Id',NULL,NULL,NULL,0,0,'',0,0,'',396,1,NULL),
	(936,'container_id','text',1,'Container Id',11,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',0,0,'',396,1,NULL),
	(937,'location_id','text',1,'Location Id',12,1,'main','[Location Id Note]',0,NULL,'[Location Id Info]',0,NULL,NULL,'Location Id',NULL,NULL,NULL,0,0,'',0,0,'',396,1,NULL),
	(938,'component_id','text',1,'Component Id',13,1,'','[Component Id Note]',0,NULL,'[Component Id Info]',0,NULL,NULL,'Component Id',NULL,NULL,NULL,0,0,'',0,0,'',396,1,NULL),
	(939,'ordering','text',1,'Sort Order',14,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',396,1,NULL),
	(940,'is_active','yesno',1,'Is Active',15,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',396,1,NULL),
	(941,'params','textarea',1,'Params',16,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',396,1,NULL),
	(942,'block_id','text',1,'Block Id',9,1,'','[Block Id Note]',0,NULL,'[Block Id Info]',0,NULL,NULL,'Block Id',NULL,NULL,NULL,0,0,'',1,1,'',526,1,NULL),
	(943,'parent_id','text',1,'Parent Id',10,0,'0','[Parent Id Note]',0,NULL,'[Parent Id Info]',0,NULL,NULL,'Parent Id',NULL,NULL,NULL,0,0,'',0,0,'',526,1,NULL),
	(944,'container_id','text',1,'Container Id',11,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',0,0,'',526,1,NULL),
	(945,'location_id','text',1,'Location Id',12,1,'main','[Location Id Note]',0,NULL,'[Location Id Info]',0,NULL,NULL,'Location Id',NULL,NULL,NULL,0,0,'',0,0,'',526,1,NULL),
	(946,'component_id','text',1,'Component Id',13,1,'','[Component Id Note]',0,NULL,'[Component Id Info]',0,NULL,NULL,'Component Id',NULL,NULL,NULL,0,0,'',0,0,'',526,1,NULL),
	(947,'ordering','text',1,'Sort Order',14,1,'0','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',526,1,NULL),
	(948,'is_active','yesno',1,'Is Active',15,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',526,1,NULL),
	(949,'params','textarea',1,'Params',16,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',526,1,NULL),
	(950,'component_id','text',1,'Component Id',9,1,'','[Component Id Note]',0,NULL,'[Component Id Info]',0,NULL,NULL,'Component Id',NULL,NULL,NULL,0,0,'',1,0,'',67,1,NULL),
	(951,'component_name','text',1,'Component Name',10,1,'','[Component Name Note]',0,NULL,'[Component Name Info]',0,NULL,NULL,'Component Name',NULL,NULL,NULL,0,0,'',0,0,'',67,1,NULL),
	(952,'component_class','text',0,'Component Class',11,1,'','[Component Class Note]',0,NULL,'[Component Class Info]',0,NULL,NULL,'Component Class',NULL,NULL,NULL,0,0,'',0,0,'',67,1,NULL),
	(953,'form_name','text',1,'Form Name',12,1,'none','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',67,1,NULL),
	(954,'package_id','select',1,'Package Id',13,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',67,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(955,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',67,1,NULL),
	(956,'ordering','text',1,'Sort Order',15,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',67,1,NULL),
	(957,'description','textarea',0,'Description',16,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',67,1,NULL),
	(958,'component_id','text',1,'Component Id',9,1,'','[Component Id Note]',0,NULL,'[Component Id Info]',0,NULL,NULL,'Component Id',NULL,NULL,NULL,0,0,'',1,0,'',287,1,NULL),
	(959,'component_name','text',1,'Component Name',10,1,'','[Component Name Note]',0,NULL,'[Component Name Info]',0,NULL,NULL,'Component Name',NULL,NULL,NULL,0,0,'',0,0,'',287,1,NULL),
	(960,'component_class','text',0,'Component Class',11,1,'','[Component Class Note]',0,NULL,'[Component Class Info]',0,NULL,NULL,'Component Class',NULL,NULL,NULL,0,0,'',0,0,'',287,1,NULL),
	(961,'form_name','text',1,'Form Name',12,1,'none','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',287,1,NULL),
	(962,'package_id','select',1,'Package Id',13,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',287,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(963,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',287,1,NULL),
	(964,'ordering','text',1,'Sort Order',15,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',287,1,NULL),
	(965,'description','textarea',0,'Description',16,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',287,1,NULL),
	(966,'component_id','text',1,'Component Id',9,1,'','[Component Id Note]',0,NULL,'[Component Id Info]',0,NULL,NULL,'Component Id',NULL,NULL,NULL,0,0,'',1,0,'',177,1,NULL),
	(967,'component_name','text',1,'Component Name',10,1,'','[Component Name Note]',0,NULL,'[Component Name Info]',0,NULL,NULL,'Component Name',NULL,NULL,NULL,0,0,'',0,0,'',177,1,NULL),
	(968,'component_class','text',0,'Component Class',11,1,'','[Component Class Note]',0,NULL,'[Component Class Info]',0,NULL,NULL,'Component Class',NULL,NULL,NULL,0,0,'',0,0,'',177,1,NULL),
	(969,'form_name','text',1,'Form Name',12,1,'none','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',177,1,NULL),
	(970,'package_id','select',1,'Package Id',13,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',177,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(971,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',177,1,NULL),
	(972,'ordering','text',1,'Sort Order',15,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',177,1,NULL),
	(973,'description','textarea',0,'Description',16,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',177,1,NULL),
	(974,'component_id','text',1,'Component Id',9,1,'','[Component Id Note]',0,NULL,'[Component Id Info]',0,NULL,NULL,'Component Id',NULL,NULL,NULL,0,0,'',1,0,'',397,1,NULL),
	(975,'component_name','text',1,'Component Name',10,1,'','[Component Name Note]',0,NULL,'[Component Name Info]',0,NULL,NULL,'Component Name',NULL,NULL,NULL,0,0,'',0,0,'',397,1,NULL),
	(976,'component_class','text',0,'Component Class',11,1,'','[Component Class Note]',0,NULL,'[Component Class Info]',0,NULL,NULL,'Component Class',NULL,NULL,NULL,0,0,'',0,0,'',397,1,NULL),
	(977,'form_name','text',1,'Form Name',12,1,'none','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',397,1,NULL),
	(978,'package_id','select',1,'Package Id',13,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',397,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(979,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',397,1,NULL),
	(980,'ordering','text',1,'Sort Order',15,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',397,1,NULL),
	(981,'description','textarea',0,'Description',16,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',397,1,NULL),
	(982,'component_id','text',1,'Component Id',9,1,'','[Component Id Note]',0,NULL,'[Component Id Info]',0,NULL,NULL,'Component Id',NULL,NULL,NULL,0,0,'',1,0,'',527,1,NULL),
	(983,'component_name','text',1,'Component Name',10,1,'','[Component Name Note]',0,NULL,'[Component Name Info]',0,NULL,NULL,'Component Name',NULL,NULL,NULL,0,0,'',0,0,'',527,1,NULL),
	(984,'component_class','text',0,'Component Class',11,1,'','[Component Class Note]',0,NULL,'[Component Class Info]',0,NULL,NULL,'Component Class',NULL,NULL,NULL,0,0,'',0,0,'',527,1,NULL),
	(985,'form_name','text',1,'Form Name',12,1,'none','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',527,1,NULL),
	(986,'package_id','select',1,'Package Id',13,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',527,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(987,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',527,1,NULL),
	(988,'ordering','text',1,'Sort Order',15,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',527,1,NULL),
	(989,'description','textarea',0,'Description',16,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',527,1,NULL),
	(990,'container_id','text',1,'Container Id',8,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',1,1,'',68,1,NULL),
	(991,'page_id','text',1,'Page Id',9,1,'','[Page Id Note]',0,NULL,'[Page Id Info]',0,NULL,NULL,'Page Id',NULL,NULL,NULL,0,0,'',0,0,'',68,1,NULL),
	(992,'grid_id','text',1,'Grid Id',10,1,'simple','[Grid Id Note]',0,NULL,'[Grid Id Info]',0,NULL,NULL,'Grid Id',NULL,NULL,NULL,0,0,'',0,0,'',68,1,NULL),
	(993,'type_id','text',1,'Type Id',11,1,'container','[Type Id Note]',0,NULL,'[Type Id Info]',0,NULL,NULL,'Type Id',NULL,NULL,NULL,0,0,'',0,0,'',68,1,NULL),
	(994,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',68,1,NULL),
	(995,'ordering','text',1,'Sort Order',13,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',68,1,NULL),
	(996,'params','textarea',0,'Params',14,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',68,1,NULL),
	(997,'container_id','text',1,'Container Id',8,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',1,1,'',288,1,NULL),
	(998,'page_id','text',1,'Page Id',9,1,'','[Page Id Note]',0,NULL,'[Page Id Info]',0,NULL,NULL,'Page Id',NULL,NULL,NULL,0,0,'',0,0,'',288,1,NULL),
	(999,'grid_id','text',1,'Grid Id',10,1,'simple','[Grid Id Note]',0,NULL,'[Grid Id Info]',0,NULL,NULL,'Grid Id',NULL,NULL,NULL,0,0,'',0,0,'',288,1,NULL),
	(1000,'type_id','text',1,'Type Id',11,1,'container','[Type Id Note]',0,NULL,'[Type Id Info]',0,NULL,NULL,'Type Id',NULL,NULL,NULL,0,0,'',0,0,'',288,1,NULL),
	(1001,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',288,1,NULL),
	(1002,'ordering','text',1,'Sort Order',13,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',288,1,NULL),
	(1003,'params','textarea',0,'Params',14,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',288,1,NULL),
	(1004,'container_id','text',1,'Container Id',8,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',1,1,'',178,1,NULL),
	(1005,'page_id','text',1,'Page Id',9,1,'','[Page Id Note]',0,NULL,'[Page Id Info]',0,NULL,NULL,'Page Id',NULL,NULL,NULL,0,0,'',0,0,'',178,1,NULL),
	(1006,'grid_id','text',1,'Grid Id',10,1,'simple','[Grid Id Note]',0,NULL,'[Grid Id Info]',0,NULL,NULL,'Grid Id',NULL,NULL,NULL,0,0,'',0,0,'',178,1,NULL),
	(1007,'type_id','text',1,'Type Id',11,1,'container','[Type Id Note]',0,NULL,'[Type Id Info]',0,NULL,NULL,'Type Id',NULL,NULL,NULL,0,0,'',0,0,'',178,1,NULL),
	(1008,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',178,1,NULL),
	(1009,'ordering','text',1,'Sort Order',13,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',178,1,NULL),
	(1010,'params','textarea',0,'Params',14,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',178,1,NULL),
	(1011,'container_id','text',1,'Container Id',8,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',1,1,'',398,1,NULL),
	(1012,'page_id','text',1,'Page Id',9,1,'','[Page Id Note]',0,NULL,'[Page Id Info]',0,NULL,NULL,'Page Id',NULL,NULL,NULL,0,0,'',0,0,'',398,1,NULL),
	(1013,'grid_id','text',1,'Grid Id',10,1,'simple','[Grid Id Note]',0,NULL,'[Grid Id Info]',0,NULL,NULL,'Grid Id',NULL,NULL,NULL,0,0,'',0,0,'',398,1,NULL),
	(1014,'type_id','text',1,'Type Id',11,1,'container','[Type Id Note]',0,NULL,'[Type Id Info]',0,NULL,NULL,'Type Id',NULL,NULL,NULL,0,0,'',0,0,'',398,1,NULL),
	(1015,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',398,1,NULL),
	(1016,'ordering','text',1,'Sort Order',13,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',398,1,NULL),
	(1017,'params','textarea',0,'Params',14,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',398,1,NULL),
	(1018,'container_id','text',1,'Container Id',8,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',1,1,'',528,1,NULL),
	(1019,'page_id','text',1,'Page Id',9,1,'','[Page Id Note]',0,NULL,'[Page Id Info]',0,NULL,NULL,'Page Id',NULL,NULL,NULL,0,0,'',0,0,'',528,1,NULL),
	(1020,'grid_id','text',1,'Grid Id',10,1,'simple','[Grid Id Note]',0,NULL,'[Grid Id Info]',0,NULL,NULL,'Grid Id',NULL,NULL,NULL,0,0,'',0,0,'',528,1,NULL),
	(1021,'type_id','text',1,'Type Id',11,1,'container','[Type Id Note]',0,NULL,'[Type Id Info]',0,NULL,NULL,'Type Id',NULL,NULL,NULL,0,0,'',0,0,'',528,1,NULL),
	(1022,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',528,1,NULL),
	(1023,'ordering','text',1,'Sort Order',13,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',528,1,NULL),
	(1024,'params','textarea',0,'Params',14,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',528,1,NULL),
	(1025,'grid_id','text',1,'Grid Id',6,1,'','[Grid Id Note]',0,NULL,'[Grid Id Info]',0,NULL,NULL,'Grid Id',NULL,NULL,NULL,0,0,'',1,0,'',69,1,NULL),
	(1026,'title','text',1,'Title',7,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',69,1,NULL),
	(1027,'ordering','text',1,'Sort Order',8,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',69,1,NULL),
	(1028,'description','textarea',0,'Description',9,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',69,1,NULL),
	(1029,'locations','textarea',0,'Locations',10,1,'','[Locations Note]',0,NULL,'[Locations Info]',0,NULL,NULL,'Locations',NULL,NULL,NULL,0,0,'',0,0,'',69,1,NULL),
	(1030,'grid_id','text',1,'Grid Id',6,1,'','[Grid Id Note]',0,NULL,'[Grid Id Info]',0,NULL,NULL,'Grid Id',NULL,NULL,NULL,0,0,'',1,0,'',289,1,NULL),
	(1031,'title','text',1,'Title',7,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',289,1,NULL),
	(1032,'ordering','text',1,'Sort Order',8,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',289,1,NULL),
	(1033,'description','textarea',0,'Description',9,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',289,1,NULL),
	(1034,'locations','textarea',0,'Locations',10,1,'','[Locations Note]',0,NULL,'[Locations Info]',0,NULL,NULL,'Locations',NULL,NULL,NULL,0,0,'',0,0,'',289,1,NULL),
	(1035,'grid_id','text',1,'Grid Id',6,1,'','[Grid Id Note]',0,NULL,'[Grid Id Info]',0,NULL,NULL,'Grid Id',NULL,NULL,NULL,0,0,'',1,0,'',179,1,NULL),
	(1036,'title','text',1,'Title',7,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',179,1,NULL),
	(1037,'ordering','text',1,'Sort Order',8,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',179,1,NULL),
	(1038,'description','textarea',0,'Description',9,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',179,1,NULL),
	(1039,'locations','textarea',0,'Locations',10,1,'','[Locations Note]',0,NULL,'[Locations Info]',0,NULL,NULL,'Locations',NULL,NULL,NULL,0,0,'',0,0,'',179,1,NULL),
	(1040,'grid_id','text',1,'Grid Id',6,1,'','[Grid Id Note]',0,NULL,'[Grid Id Info]',0,NULL,NULL,'Grid Id',NULL,NULL,NULL,0,0,'',1,0,'',399,1,NULL),
	(1041,'title','text',1,'Title',7,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',399,1,NULL),
	(1042,'ordering','text',1,'Sort Order',8,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',399,1,NULL),
	(1043,'description','textarea',0,'Description',9,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',399,1,NULL),
	(1044,'locations','textarea',0,'Locations',10,1,'','[Locations Note]',0,NULL,'[Locations Info]',0,NULL,NULL,'Locations',NULL,NULL,NULL,0,0,'',0,0,'',399,1,NULL),
	(1045,'grid_id','text',1,'Grid Id',6,1,'','[Grid Id Note]',0,NULL,'[Grid Id Info]',0,NULL,NULL,'Grid Id',NULL,NULL,NULL,0,0,'',1,0,'',529,1,NULL),
	(1046,'title','text',1,'Title',7,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',529,1,NULL),
	(1047,'ordering','text',1,'Sort Order',8,1,'1','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',529,1,NULL),
	(1048,'description','textarea',0,'Description',9,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',529,1,NULL),
	(1049,'locations','textarea',0,'Locations',10,1,'','[Locations Note]',0,NULL,'[Locations Info]',0,NULL,NULL,'Locations',NULL,NULL,NULL,0,0,'',0,0,'',529,1,NULL),
	(1050,'container_id','text',1,'Container Id',4,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',1,0,'',70,2,NULL),
	(1051,'location_id','text',1,'Location Id',5,1,'','[Location Id Note]',0,NULL,'[Location Id Info]',0,NULL,NULL,'Location Id',NULL,NULL,NULL,0,0,'',1,0,'',70,2,NULL),
	(1052,'params','textarea',1,'Params',6,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',70,2,NULL),
	(1053,'container_id','text',1,'Container Id',4,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',1,0,'',290,2,NULL),
	(1054,'location_id','text',1,'Location Id',5,1,'','[Location Id Note]',0,NULL,'[Location Id Info]',0,NULL,NULL,'Location Id',NULL,NULL,NULL,0,0,'',1,0,'',290,2,NULL),
	(1055,'params','textarea',1,'Params',6,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',290,2,NULL),
	(1056,'container_id','text',1,'Container Id',4,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',1,0,'',180,2,NULL),
	(1057,'location_id','text',1,'Location Id',5,1,'','[Location Id Note]',0,NULL,'[Location Id Info]',0,NULL,NULL,'Location Id',NULL,NULL,NULL,0,0,'',1,0,'',180,2,NULL),
	(1058,'params','textarea',1,'Params',6,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',180,2,NULL),
	(1059,'container_id','text',1,'Container Id',4,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',1,0,'',400,2,NULL),
	(1060,'location_id','text',1,'Location Id',5,1,'','[Location Id Note]',0,NULL,'[Location Id Info]',0,NULL,NULL,'Location Id',NULL,NULL,NULL,0,0,'',1,0,'',400,2,NULL),
	(1061,'params','textarea',1,'Params',6,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',400,2,NULL),
	(1062,'container_id','text',1,'Container Id',4,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',1,0,'',530,2,NULL),
	(1063,'location_id','text',1,'Location Id',5,1,'','[Location Id Note]',0,NULL,'[Location Id Info]',0,NULL,NULL,'Location Id',NULL,NULL,NULL,0,0,'',1,0,'',530,2,NULL),
	(1064,'params','textarea',1,'Params',6,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',530,2,NULL),
	(1065,'page_id','text',1,'Page Id',6,1,'','[Page Id Note]',0,NULL,'[Page Id Info]',0,NULL,NULL,'Page Id',NULL,NULL,NULL,0,0,'',1,1,'',71,1,NULL),
	(1066,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',71,1,NULL),
	(1067,'theme_id','text',1,'Theme Id',8,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',71,1,NULL),
	(1068,'is_active','yesno',1,'Is Active',9,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',71,1,NULL),
	(1069,'params','textarea',1,'Params',10,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',71,1,NULL),
	(1070,'page_id','text',1,'Page Id',6,1,'','[Page Id Note]',0,NULL,'[Page Id Info]',0,NULL,NULL,'Page Id',NULL,NULL,NULL,0,0,'',1,1,'',291,1,NULL),
	(1071,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',291,1,NULL),
	(1072,'theme_id','text',1,'Theme Id',8,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',291,1,NULL),
	(1073,'is_active','yesno',1,'Is Active',9,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',291,1,NULL),
	(1074,'params','textarea',1,'Params',10,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',291,1,NULL),
	(1075,'page_id','text',1,'Page Id',6,1,'','[Page Id Note]',0,NULL,'[Page Id Info]',0,NULL,NULL,'Page Id',NULL,NULL,NULL,0,0,'',1,1,'',181,1,NULL),
	(1076,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',181,1,NULL),
	(1077,'theme_id','text',1,'Theme Id',8,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',181,1,NULL),
	(1078,'is_active','yesno',1,'Is Active',9,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',181,1,NULL),
	(1079,'params','textarea',1,'Params',10,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',181,1,NULL),
	(1080,'page_id','text',1,'Page Id',6,1,'','[Page Id Note]',0,NULL,'[Page Id Info]',0,NULL,NULL,'Page Id',NULL,NULL,NULL,0,0,'',1,1,'',401,1,NULL),
	(1081,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',401,1,NULL),
	(1082,'theme_id','text',1,'Theme Id',8,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',401,1,NULL),
	(1083,'is_active','yesno',1,'Is Active',9,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',401,1,NULL),
	(1084,'params','textarea',1,'Params',10,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',401,1,NULL),
	(1085,'page_id','text',1,'Page Id',6,1,'','[Page Id Note]',0,NULL,'[Page Id Info]',0,NULL,NULL,'Page Id',NULL,NULL,NULL,0,0,'',1,1,'',531,1,NULL),
	(1086,'action_id','text',1,'Action Id',7,1,'','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',531,1,NULL),
	(1087,'theme_id','text',1,'Theme Id',8,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',531,1,NULL),
	(1088,'is_active','yesno',1,'Is Active',9,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',531,1,NULL),
	(1089,'params','textarea',1,'Params',10,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',531,1,NULL),
	(1090,'theme_id','text',1,'Theme Id',8,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',1,0,'',72,1,NULL),
	(1091,'title','text',1,'Title',9,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',72,1,NULL),
	(1092,'parent_id','text',0,'Parent Id',10,0,'','[Parent Id Note]',0,NULL,'[Parent Id Info]',0,NULL,NULL,'Parent Id',NULL,NULL,NULL,0,0,'',0,0,'',72,1,NULL),
	(1093,'is_default','yesno',1,'Is Default',11,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',72,1,NULL),
	(1094,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',72,1,NULL),
	(1095,'is_editing','yesno',1,'Is Editing',13,1,'0','[Is Editing Note]',0,NULL,'[Is Editing Info]',0,NULL,NULL,'Is Editing',NULL,NULL,NULL,0,0,'',0,0,'',72,1,NULL),
	(1096,'is_admin','yesno',1,'Is Admin',14,1,'0','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',72,1,NULL),
	(1097,'theme_id','text',1,'Theme Id',8,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',1,0,'',292,1,NULL),
	(1098,'title','text',1,'Title',9,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',292,1,NULL),
	(1099,'parent_id','text',0,'Parent Id',10,0,'','[Parent Id Note]',0,NULL,'[Parent Id Info]',0,NULL,NULL,'Parent Id',NULL,NULL,NULL,0,0,'',0,0,'',292,1,NULL),
	(1100,'is_default','yesno',1,'Is Default',11,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',292,1,NULL),
	(1101,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',292,1,NULL),
	(1102,'is_editing','yesno',1,'Is Editing',13,1,'0','[Is Editing Note]',0,NULL,'[Is Editing Info]',0,NULL,NULL,'Is Editing',NULL,NULL,NULL,0,0,'',0,0,'',292,1,NULL),
	(1103,'is_admin','yesno',1,'Is Admin',14,1,'0','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',292,1,NULL),
	(1104,'theme_id','text',1,'Theme Id',8,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',1,0,'',182,1,NULL),
	(1105,'title','text',1,'Title',9,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',182,1,NULL),
	(1106,'parent_id','text',0,'Parent Id',10,0,'','[Parent Id Note]',0,NULL,'[Parent Id Info]',0,NULL,NULL,'Parent Id',NULL,NULL,NULL,0,0,'',0,0,'',182,1,NULL),
	(1107,'is_default','yesno',1,'Is Default',11,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',182,1,NULL),
	(1108,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',182,1,NULL),
	(1109,'is_editing','yesno',1,'Is Editing',13,1,'0','[Is Editing Note]',0,NULL,'[Is Editing Info]',0,NULL,NULL,'Is Editing',NULL,NULL,NULL,0,0,'',0,0,'',182,1,NULL),
	(1110,'is_admin','yesno',1,'Is Admin',14,1,'0','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',182,1,NULL),
	(1111,'theme_id','text',1,'Theme Id',8,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',1,0,'',402,1,NULL),
	(1112,'title','text',1,'Title',9,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',402,1,NULL),
	(1113,'parent_id','text',0,'Parent Id',10,0,'','[Parent Id Note]',0,NULL,'[Parent Id Info]',0,NULL,NULL,'Parent Id',NULL,NULL,NULL,0,0,'',0,0,'',402,1,NULL),
	(1114,'is_default','yesno',1,'Is Default',11,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',402,1,NULL),
	(1115,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',402,1,NULL),
	(1116,'is_editing','yesno',1,'Is Editing',13,1,'0','[Is Editing Note]',0,NULL,'[Is Editing Info]',0,NULL,NULL,'Is Editing',NULL,NULL,NULL,0,0,'',0,0,'',402,1,NULL),
	(1117,'is_admin','yesno',1,'Is Admin',14,1,'0','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',402,1,NULL),
	(1118,'theme_id','text',1,'Theme Id',8,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',1,0,'',532,1,NULL),
	(1119,'title','text',1,'Title',9,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',532,1,NULL),
	(1120,'parent_id','text',0,'Parent Id',10,0,'','[Parent Id Note]',0,NULL,'[Parent Id Info]',0,NULL,NULL,'Parent Id',NULL,NULL,NULL,0,0,'',0,0,'',532,1,NULL),
	(1121,'is_default','yesno',1,'Is Default',11,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',532,1,NULL),
	(1122,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',532,1,NULL),
	(1123,'is_editing','yesno',1,'Is Editing',13,1,'0','[Is Editing Note]',0,NULL,'[Is Editing Info]',0,NULL,NULL,'Is Editing',NULL,NULL,NULL,0,0,'',0,0,'',532,1,NULL),
	(1124,'is_admin','yesno',1,'Is Admin',14,1,'0','[Is Admin Note]',0,NULL,'[Is Admin Info]',0,NULL,NULL,'Is Admin',NULL,NULL,NULL,0,0,'',0,0,'',532,1,NULL),
	(1125,'params_id','text',1,'Params Id',4,1,'','[Params Id Note]',0,NULL,'[Params Id Info]',0,NULL,NULL,'Params Id',NULL,NULL,NULL,0,0,'',1,1,'',73,1,NULL),
	(1126,'theme_id','text',1,'Theme Id',5,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',73,1,NULL),
	(1127,'params','textarea',1,'Params',6,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',73,1,NULL),
	(1128,'params_id','text',1,'Params Id',4,1,'','[Params Id Note]',0,NULL,'[Params Id Info]',0,NULL,NULL,'Params Id',NULL,NULL,NULL,0,0,'',1,1,'',293,1,NULL),
	(1129,'theme_id','text',1,'Theme Id',5,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',293,1,NULL),
	(1130,'params','textarea',1,'Params',6,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',293,1,NULL),
	(1131,'params_id','text',1,'Params Id',4,1,'','[Params Id Note]',0,NULL,'[Params Id Info]',0,NULL,NULL,'Params Id',NULL,NULL,NULL,0,0,'',1,1,'',183,1,NULL),
	(1132,'theme_id','text',1,'Theme Id',5,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',183,1,NULL),
	(1133,'params','textarea',1,'Params',6,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',183,1,NULL),
	(1134,'params_id','text',1,'Params Id',4,1,'','[Params Id Note]',0,NULL,'[Params Id Info]',0,NULL,NULL,'Params Id',NULL,NULL,NULL,0,0,'',1,1,'',403,1,NULL),
	(1135,'theme_id','text',1,'Theme Id',5,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',403,1,NULL),
	(1136,'params','textarea',1,'Params',6,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',403,1,NULL),
	(1137,'params_id','text',1,'Params Id',4,1,'','[Params Id Note]',0,NULL,'[Params Id Info]',0,NULL,NULL,'Params Id',NULL,NULL,NULL,0,0,'',1,1,'',533,1,NULL),
	(1138,'theme_id','text',1,'Theme Id',5,1,'','[Theme Id Note]',0,NULL,'[Theme Id Info]',0,NULL,NULL,'Theme Id',NULL,NULL,NULL,0,0,'',0,0,'',533,1,NULL),
	(1139,'params','textarea',1,'Params',6,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',533,1,NULL),
	(1140,'adapter_id','text',1,'Adapter Id',7,1,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',76,1,NULL),
	(1141,'container_id','text',1,'Container Id',8,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',0,0,'',76,1,NULL),
	(1142,'adapter_name','text',1,'Adapter Name',9,1,'','[Adapter Name Note]',0,NULL,'[Adapter Name Info]',0,NULL,NULL,'Adapter Name',NULL,NULL,NULL,0,0,'',0,0,'',76,1,NULL),
	(1143,'driver_id','text',1,'Driver Id',10,1,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',76,1,NULL),
	(1144,'params','textarea',1,'Params',11,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',76,1,NULL),
	(1145,'description','textarea',1,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',76,1,NULL),
	(1146,'adapter_id','text',1,'Adapter Id',7,1,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',296,1,NULL),
	(1147,'container_id','text',1,'Container Id',8,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',0,0,'',296,1,NULL),
	(1148,'adapter_name','text',1,'Adapter Name',9,1,'','[Adapter Name Note]',0,NULL,'[Adapter Name Info]',0,NULL,NULL,'Adapter Name',NULL,NULL,NULL,0,0,'',0,0,'',296,1,NULL),
	(1149,'driver_id','text',1,'Driver Id',10,1,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',296,1,NULL),
	(1150,'params','textarea',1,'Params',11,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',296,1,NULL),
	(1151,'description','textarea',1,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',296,1,NULL),
	(1152,'adapter_id','text',1,'Adapter Id',7,1,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',186,1,NULL),
	(1153,'container_id','text',1,'Container Id',8,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',0,0,'',186,1,NULL),
	(1154,'adapter_name','text',1,'Adapter Name',9,1,'','[Adapter Name Note]',0,NULL,'[Adapter Name Info]',0,NULL,NULL,'Adapter Name',NULL,NULL,NULL,0,0,'',0,0,'',186,1,NULL),
	(1155,'driver_id','text',1,'Driver Id',10,1,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',186,1,NULL),
	(1156,'params','textarea',1,'Params',11,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',186,1,NULL),
	(1157,'description','textarea',1,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',186,1,NULL),
	(1158,'adapter_id','text',1,'Adapter Id',7,1,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',406,1,NULL),
	(1159,'container_id','text',1,'Container Id',8,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',0,0,'',406,1,NULL),
	(1160,'adapter_name','text',1,'Adapter Name',9,1,'','[Adapter Name Note]',0,NULL,'[Adapter Name Info]',0,NULL,NULL,'Adapter Name',NULL,NULL,NULL,0,0,'',0,0,'',406,1,NULL),
	(1161,'driver_id','text',1,'Driver Id',10,1,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',406,1,NULL),
	(1162,'params','textarea',1,'Params',11,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',406,1,NULL),
	(1163,'description','textarea',1,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',406,1,NULL),
	(1164,'adapter_id','text',1,'Adapter Id',7,1,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',469,1,NULL),
	(1165,'container_id','text',1,'Container Id',8,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',0,0,'',469,1,NULL),
	(1166,'adapter_name','text',1,'Adapter Name',9,1,'','[Adapter Name Note]',0,NULL,'[Adapter Name Info]',0,NULL,NULL,'Adapter Name',NULL,NULL,NULL,0,0,'',0,0,'',469,1,NULL),
	(1167,'driver_id','text',1,'Driver Id',10,1,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',469,1,NULL),
	(1168,'params','textarea',1,'Params',11,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',469,1,NULL),
	(1169,'description','textarea',1,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',469,1,NULL),
	(1260,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',80,1,NULL),
	(1261,'language_id','text',1,'Language Id',7,1,'','[Language Id Note]',0,NULL,'[Language Id Info]',0,NULL,NULL,'Language Id',NULL,NULL,NULL,0,0,'',0,0,'',80,1,NULL),
	(1262,'code','text',1,'Code',8,1,'','[Code Note]',0,NULL,'[Code Info]',0,NULL,NULL,'Code',NULL,NULL,NULL,0,0,'',0,0,'',80,1,NULL),
	(1263,'package_id','select',1,'Package Id',9,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',80,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(1264,'vars','textarea',1,'Vars',10,1,'','[Vars Note]',0,NULL,'[Vars Info]',0,NULL,NULL,'Vars',NULL,NULL,NULL,0,0,'',0,0,'',80,1,NULL),
	(1265,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',300,1,NULL),
	(1266,'language_id','text',1,'Language Id',7,1,'','[Language Id Note]',0,NULL,'[Language Id Info]',0,NULL,NULL,'Language Id',NULL,NULL,NULL,0,0,'',0,0,'',300,1,NULL),
	(1267,'code','text',1,'Code',8,1,'','[Code Note]',0,NULL,'[Code Info]',0,NULL,NULL,'Code',NULL,NULL,NULL,0,0,'',0,0,'',300,1,NULL),
	(1268,'package_id','select',1,'Package Id',9,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',300,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(1269,'vars','textarea',1,'Vars',10,1,'','[Vars Note]',0,NULL,'[Vars Info]',0,NULL,NULL,'Vars',NULL,NULL,NULL,0,0,'',0,0,'',300,1,NULL),
	(1270,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',190,1,NULL),
	(1271,'language_id','text',1,'Language Id',7,1,'','[Language Id Note]',0,NULL,'[Language Id Info]',0,NULL,NULL,'Language Id',NULL,NULL,NULL,0,0,'',0,0,'',190,1,NULL),
	(1272,'code','text',1,'Code',8,1,'','[Code Note]',0,NULL,'[Code Info]',0,NULL,NULL,'Code',NULL,NULL,NULL,0,0,'',0,0,'',190,1,NULL),
	(1273,'package_id','select',1,'Package Id',9,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',190,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(1274,'vars','textarea',1,'Vars',10,1,'','[Vars Note]',0,NULL,'[Vars Info]',0,NULL,NULL,'Vars',NULL,NULL,NULL,0,0,'',0,0,'',190,1,NULL),
	(1275,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',410,1,NULL),
	(1276,'language_id','text',1,'Language Id',7,1,'','[Language Id Note]',0,NULL,'[Language Id Info]',0,NULL,NULL,'Language Id',NULL,NULL,NULL,0,0,'',0,0,'',410,1,NULL),
	(1277,'code','text',1,'Code',8,1,'','[Code Note]',0,NULL,'[Code Info]',0,NULL,NULL,'Code',NULL,NULL,NULL,0,0,'',0,0,'',410,1,NULL),
	(1278,'package_id','select',1,'Package Id',9,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',410,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(1279,'vars','textarea',1,'Vars',10,1,'','[Vars Note]',0,NULL,'[Vars Info]',0,NULL,NULL,'Vars',NULL,NULL,NULL,0,0,'',0,0,'',410,1,NULL),
	(1280,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',473,1,NULL),
	(1281,'language_id','text',1,'Language Id',7,1,'','[Language Id Note]',0,NULL,'[Language Id Info]',0,NULL,NULL,'Language Id',NULL,NULL,NULL,0,0,'',0,0,'',473,1,NULL),
	(1282,'code','text',1,'Code',8,1,'','[Code Note]',0,NULL,'[Code Info]',0,NULL,NULL,'Code',NULL,NULL,NULL,0,0,'',0,0,'',473,1,NULL),
	(1283,'package_id','select',1,'Package Id',9,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',473,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(1284,'vars','textarea',1,'Vars',10,1,'','[Vars Note]',0,NULL,'[Vars Info]',0,NULL,NULL,'Vars',NULL,NULL,NULL,0,0,'',0,0,'',473,1,NULL),
	(1285,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,0,'',105,1,NULL),
	(1286,'name','text',1,'Name',7,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',105,1,NULL),
	(1287,'modified','text',1,'Modified',8,1,'0','[Modified Note]',0,NULL,'[Modified Info]',0,NULL,NULL,'Modified',NULL,NULL,NULL,0,0,'',0,0,'',105,1,NULL),
	(1288,'lifetime','text',1,'Lifetime',9,1,'0','[Lifetime Note]',0,NULL,'[Lifetime Info]',0,NULL,NULL,'Lifetime',NULL,NULL,NULL,0,0,'',0,0,'',105,1,NULL),
	(1289,'data','textarea',1,'Data',10,1,'','[Data Note]',0,NULL,'[Data Info]',0,NULL,NULL,'Data',NULL,NULL,NULL,0,0,'',0,0,'',105,1,NULL),
	(1290,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,0,'',325,1,NULL),
	(1291,'name','text',1,'Name',7,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',325,1,NULL),
	(1292,'modified','text',1,'Modified',8,1,'0','[Modified Note]',0,NULL,'[Modified Info]',0,NULL,NULL,'Modified',NULL,NULL,NULL,0,0,'',0,0,'',325,1,NULL),
	(1293,'lifetime','text',1,'Lifetime',9,1,'0','[Lifetime Note]',0,NULL,'[Lifetime Info]',0,NULL,NULL,'Lifetime',NULL,NULL,NULL,0,0,'',0,0,'',325,1,NULL),
	(1294,'data','textarea',1,'Data',10,1,'','[Data Note]',0,NULL,'[Data Info]',0,NULL,NULL,'Data',NULL,NULL,NULL,0,0,'',0,0,'',325,1,NULL),
	(1295,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,0,'',215,1,NULL),
	(1296,'name','text',1,'Name',7,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',215,1,NULL),
	(1297,'modified','text',1,'Modified',8,1,'0','[Modified Note]',0,NULL,'[Modified Info]',0,NULL,NULL,'Modified',NULL,NULL,NULL,0,0,'',0,0,'',215,1,NULL),
	(1298,'lifetime','text',1,'Lifetime',9,1,'0','[Lifetime Note]',0,NULL,'[Lifetime Info]',0,NULL,NULL,'Lifetime',NULL,NULL,NULL,0,0,'',0,0,'',215,1,NULL),
	(1299,'data','textarea',1,'Data',10,1,'','[Data Note]',0,NULL,'[Data Info]',0,NULL,NULL,'Data',NULL,NULL,NULL,0,0,'',0,0,'',215,1,NULL),
	(1300,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,0,'',435,1,NULL),
	(1301,'name','text',1,'Name',7,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',435,1,NULL),
	(1302,'modified','text',1,'Modified',8,1,'0','[Modified Note]',0,NULL,'[Modified Info]',0,NULL,NULL,'Modified',NULL,NULL,NULL,0,0,'',0,0,'',435,1,NULL),
	(1303,'lifetime','text',1,'Lifetime',9,1,'0','[Lifetime Note]',0,NULL,'[Lifetime Info]',0,NULL,NULL,'Lifetime',NULL,NULL,NULL,0,0,'',0,0,'',435,1,NULL),
	(1304,'data','textarea',1,'Data',10,1,'','[Data Note]',0,NULL,'[Data Info]',0,NULL,NULL,'Data',NULL,NULL,NULL,0,0,'',0,0,'',435,1,NULL),
	(1305,'id','text',1,'Id',6,1,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,0,'',558,1,NULL),
	(1306,'name','text',1,'Name',7,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',558,1,NULL),
	(1307,'modified','text',1,'Modified',8,1,'0','[Modified Note]',0,NULL,'[Modified Info]',0,NULL,NULL,'Modified',NULL,NULL,NULL,0,0,'',0,0,'',558,1,NULL),
	(1308,'lifetime','text',1,'Lifetime',9,1,'0','[Lifetime Note]',0,NULL,'[Lifetime Info]',0,NULL,NULL,'Lifetime',NULL,NULL,NULL,0,0,'',0,0,'',558,1,NULL),
	(1309,'data','textarea',1,'Data',10,1,'','[Data Note]',0,NULL,'[Data Info]',0,NULL,NULL,'Data',NULL,NULL,NULL,0,0,'',0,0,'',558,1,NULL),
	(1375,'value_id','text',1,'Value Id',8,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',1,1,'',108,1,NULL),
	(1376,'package_id','select',1,'Package Id',9,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',108,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(1377,'group_id','text',1,'Group Id',10,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',0,0,'',108,1,NULL),
	(1378,'name','text',1,'Name',11,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',108,1,NULL),
	(1379,'value_actual','textarea',0,'Value Actual',12,1,'','[Value Actual Note]',0,NULL,'[Value Actual Info]',0,NULL,NULL,'Value Actual',NULL,NULL,NULL,0,0,'',0,0,'',108,1,NULL),
	(1380,'ordering','text',1,'Sort Order',13,1,'99','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',108,1,NULL),
	(1381,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',108,1,NULL),
	(1382,'value_id','text',1,'Value Id',8,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',1,1,'',328,1,NULL),
	(1383,'package_id','select',1,'Package Id',9,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',328,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(1384,'group_id','text',1,'Group Id',10,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',0,0,'',328,1,NULL),
	(1385,'name','text',1,'Name',11,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',328,1,NULL),
	(1386,'value_actual','textarea',0,'Value Actual',12,1,'','[Value Actual Note]',0,NULL,'[Value Actual Info]',0,NULL,NULL,'Value Actual',NULL,NULL,NULL,0,0,'',0,0,'',328,1,NULL),
	(1387,'ordering','text',1,'Sort Order',13,1,'99','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',328,1,NULL),
	(1388,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',328,1,NULL),
	(1389,'value_id','text',1,'Value Id',8,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',1,1,'',218,1,NULL),
	(1390,'package_id','select',1,'Package Id',9,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',218,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(1391,'group_id','text',1,'Group Id',10,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',0,0,'',218,1,NULL),
	(1392,'name','text',1,'Name',11,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',218,1,NULL),
	(1393,'value_actual','textarea',0,'Value Actual',12,1,'','[Value Actual Note]',0,NULL,'[Value Actual Info]',0,NULL,NULL,'Value Actual',NULL,NULL,NULL,0,0,'',0,0,'',218,1,NULL),
	(1394,'ordering','text',1,'Sort Order',13,1,'99','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',218,1,NULL),
	(1395,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',218,1,NULL),
	(1396,'value_id','text',1,'Value Id',8,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',1,1,'',438,1,NULL),
	(1397,'package_id','select',1,'Package Id',9,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',438,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(1398,'group_id','text',1,'Group Id',10,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',0,0,'',438,1,NULL),
	(1399,'name','text',1,'Name',11,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',438,1,NULL),
	(1400,'value_actual','textarea',0,'Value Actual',12,1,'','[Value Actual Note]',0,NULL,'[Value Actual Info]',0,NULL,NULL,'Value Actual',NULL,NULL,NULL,0,0,'',0,0,'',438,1,NULL),
	(1401,'ordering','text',1,'Sort Order',13,1,'99','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',438,1,NULL),
	(1402,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',438,1,NULL),
	(1403,'value_id','text',1,'Value Id',8,1,'','[Value Id Note]',0,NULL,'[Value Id Info]',0,NULL,NULL,'Value Id',NULL,NULL,NULL,0,0,'',1,1,'',475,1,NULL),
	(1404,'package_id','select',1,'Package Id',9,1,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',475,1,'\Phpfox::get(\'core.packages\')->getPackageIdOptions()'),
	(1405,'group_id','text',1,'Group Id',10,1,'','[Group Id Note]',0,NULL,'[Group Id Info]',0,NULL,NULL,'Group Id',NULL,NULL,NULL,0,0,'',0,0,'',475,1,NULL),
	(1406,'name','text',1,'Name',11,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',475,1,NULL),
	(1407,'value_actual','textarea',0,'Value Actual',12,1,'','[Value Actual Note]',0,NULL,'[Value Actual Info]',0,NULL,NULL,'Value Actual',NULL,NULL,NULL,0,0,'',0,0,'',475,1,NULL),
	(1408,'ordering','text',1,'Sort Order',13,1,'99','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',475,1,NULL),
	(1409,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',475,1,NULL),
	(1410,'adapter_id','text',1,'Adapter Id',8,1,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',109,1,NULL),
	(1411,'adapter_name','text',1,'Adapter Name',9,1,'','[Adapter Name Note]',0,NULL,'[Adapter Name Info]',0,NULL,NULL,'Adapter Name',NULL,NULL,NULL,0,0,'',0,0,'',109,1,NULL),
	(1412,'driver_id','text',1,'Driver Id',10,1,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',109,1,NULL),
	(1413,'params','textarea',1,'Params',11,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',109,1,NULL),
	(1414,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',109,1,NULL),
	(1415,'is_required','yesno',1,'Is Required',13,0,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',109,1,NULL),
	(1416,'description','textarea',1,'Description',14,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',109,1,NULL),
	(1417,'adapter_id','text',1,'Adapter Id',8,1,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',329,1,NULL),
	(1418,'adapter_name','text',1,'Adapter Name',9,1,'','[Adapter Name Note]',0,NULL,'[Adapter Name Info]',0,NULL,NULL,'Adapter Name',NULL,NULL,NULL,0,0,'',0,0,'',329,1,NULL),
	(1419,'driver_id','text',1,'Driver Id',10,1,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',329,1,NULL),
	(1420,'params','textarea',1,'Params',11,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',329,1,NULL),
	(1421,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',329,1,NULL),
	(1422,'is_required','yesno',1,'Is Required',13,0,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',329,1,NULL),
	(1423,'description','textarea',1,'Description',14,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',329,1,NULL),
	(1424,'adapter_id','text',1,'Adapter Id',8,1,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',219,1,NULL),
	(1425,'adapter_name','text',1,'Adapter Name',9,1,'','[Adapter Name Note]',0,NULL,'[Adapter Name Info]',0,NULL,NULL,'Adapter Name',NULL,NULL,NULL,0,0,'',0,0,'',219,1,NULL),
	(1426,'driver_id','text',1,'Driver Id',10,1,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',219,1,NULL),
	(1427,'params','textarea',1,'Params',11,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',219,1,NULL),
	(1428,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',219,1,NULL),
	(1429,'is_required','yesno',1,'Is Required',13,0,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',219,1,NULL),
	(1430,'description','textarea',1,'Description',14,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',219,1,NULL),
	(1431,'adapter_id','text',1,'Adapter Id',8,1,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',439,1,NULL),
	(1432,'adapter_name','text',1,'Adapter Name',9,1,'','[Adapter Name Note]',0,NULL,'[Adapter Name Info]',0,NULL,NULL,'Adapter Name',NULL,NULL,NULL,0,0,'',0,0,'',439,1,NULL),
	(1433,'driver_id','text',1,'Driver Id',10,1,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',439,1,NULL),
	(1434,'params','textarea',1,'Params',11,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',439,1,NULL),
	(1435,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',439,1,NULL),
	(1436,'is_required','yesno',1,'Is Required',13,0,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',439,1,NULL),
	(1437,'description','textarea',1,'Description',14,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',439,1,NULL),
	(1438,'adapter_id','text',1,'Adapter Id',8,1,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',476,1,NULL),
	(1439,'adapter_name','text',1,'Adapter Name',9,1,'','[Adapter Name Note]',0,NULL,'[Adapter Name Info]',0,NULL,NULL,'Adapter Name',NULL,NULL,NULL,0,0,'',0,0,'',476,1,NULL),
	(1440,'driver_id','text',1,'Driver Id',10,1,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',476,1,NULL),
	(1441,'params','textarea',1,'Params',11,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',476,1,NULL),
	(1442,'is_active','yesno',1,'Is Active',12,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',476,1,NULL),
	(1443,'is_required','yesno',1,'Is Required',13,0,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',476,1,NULL),
	(1444,'description','textarea',1,'Description',14,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',476,1,NULL),
	(1475,'file_id','text',1,'File Id',8,1,'','[File Id Note]',0,NULL,'[File Id Info]',0,NULL,NULL,'File Id',NULL,NULL,NULL,0,0,'',1,1,'',111,1,NULL),
	(1476,'adapter_id','text',1,'Adapter Id',9,1,'0','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',0,0,'',111,1,NULL),
	(1477,'file_size','text',1,'File Size',10,1,'0','[File Size Note]',0,NULL,'[File Size Info]',0,NULL,NULL,'File Size',NULL,NULL,NULL,0,0,'',0,0,'',111,1,NULL),
	(1478,'user_id','text',1,'User Id',11,0,'0','[User Id Note]',0,NULL,'[User Id Info]',0,NULL,NULL,'User Id',NULL,NULL,NULL,0,0,'',0,0,'',111,1,NULL),
	(1479,'file_mime','text',1,'File Mime',12,1,'','[File Mime Note]',0,NULL,'[File Mime Info]',0,NULL,NULL,'File Mime',NULL,NULL,NULL,0,0,'',0,0,'',111,1,NULL),
	(1480,'paths','textarea',1,'Paths',13,1,'','[Paths Note]',0,NULL,'[Paths Info]',0,NULL,NULL,'Paths',NULL,NULL,NULL,0,0,'',0,0,'',111,1,NULL),
	(1481,'created_at','text',1,'Created At',14,0,'','[Created At Note]',0,NULL,'[Created At Info]',0,NULL,NULL,'Created At',NULL,NULL,NULL,0,0,'',0,0,'',111,1,NULL),
	(1482,'file_id','text',1,'File Id',8,1,'','[File Id Note]',0,NULL,'[File Id Info]',0,NULL,NULL,'File Id',NULL,NULL,NULL,0,0,'',1,1,'',331,1,NULL),
	(1483,'adapter_id','text',1,'Adapter Id',9,1,'0','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',0,0,'',331,1,NULL),
	(1484,'file_size','text',1,'File Size',10,1,'0','[File Size Note]',0,NULL,'[File Size Info]',0,NULL,NULL,'File Size',NULL,NULL,NULL,0,0,'',0,0,'',331,1,NULL),
	(1485,'user_id','text',1,'User Id',11,0,'0','[User Id Note]',0,NULL,'[User Id Info]',0,NULL,NULL,'User Id',NULL,NULL,NULL,0,0,'',0,0,'',331,1,NULL),
	(1486,'file_mime','text',1,'File Mime',12,1,'','[File Mime Note]',0,NULL,'[File Mime Info]',0,NULL,NULL,'File Mime',NULL,NULL,NULL,0,0,'',0,0,'',331,1,NULL),
	(1487,'paths','textarea',1,'Paths',13,1,'','[Paths Note]',0,NULL,'[Paths Info]',0,NULL,NULL,'Paths',NULL,NULL,NULL,0,0,'',0,0,'',331,1,NULL),
	(1488,'created_at','text',1,'Created At',14,0,'','[Created At Note]',0,NULL,'[Created At Info]',0,NULL,NULL,'Created At',NULL,NULL,NULL,0,0,'',0,0,'',331,1,NULL),
	(1489,'file_id','text',1,'File Id',8,1,'','[File Id Note]',0,NULL,'[File Id Info]',0,NULL,NULL,'File Id',NULL,NULL,NULL,0,0,'',1,1,'',221,1,NULL),
	(1490,'adapter_id','text',1,'Adapter Id',9,1,'0','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',0,0,'',221,1,NULL),
	(1491,'file_size','text',1,'File Size',10,1,'0','[File Size Note]',0,NULL,'[File Size Info]',0,NULL,NULL,'File Size',NULL,NULL,NULL,0,0,'',0,0,'',221,1,NULL),
	(1492,'user_id','text',1,'User Id',11,0,'0','[User Id Note]',0,NULL,'[User Id Info]',0,NULL,NULL,'User Id',NULL,NULL,NULL,0,0,'',0,0,'',221,1,NULL),
	(1493,'file_mime','text',1,'File Mime',12,1,'','[File Mime Note]',0,NULL,'[File Mime Info]',0,NULL,NULL,'File Mime',NULL,NULL,NULL,0,0,'',0,0,'',221,1,NULL),
	(1494,'paths','textarea',1,'Paths',13,1,'','[Paths Note]',0,NULL,'[Paths Info]',0,NULL,NULL,'Paths',NULL,NULL,NULL,0,0,'',0,0,'',221,1,NULL),
	(1495,'created_at','text',1,'Created At',14,0,'','[Created At Note]',0,NULL,'[Created At Info]',0,NULL,NULL,'Created At',NULL,NULL,NULL,0,0,'',0,0,'',221,1,NULL),
	(1496,'file_id','text',1,'File Id',8,1,'','[File Id Note]',0,NULL,'[File Id Info]',0,NULL,NULL,'File Id',NULL,NULL,NULL,0,0,'',1,1,'',441,1,NULL),
	(1497,'adapter_id','text',1,'Adapter Id',9,1,'0','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',0,0,'',441,1,NULL),
	(1498,'file_size','text',1,'File Size',10,1,'0','[File Size Note]',0,NULL,'[File Size Info]',0,NULL,NULL,'File Size',NULL,NULL,NULL,0,0,'',0,0,'',441,1,NULL),
	(1499,'user_id','text',1,'User Id',11,0,'0','[User Id Note]',0,NULL,'[User Id Info]',0,NULL,NULL,'User Id',NULL,NULL,NULL,0,0,'',0,0,'',441,1,NULL),
	(1500,'file_mime','text',1,'File Mime',12,1,'','[File Mime Note]',0,NULL,'[File Mime Info]',0,NULL,NULL,'File Mime',NULL,NULL,NULL,0,0,'',0,0,'',441,1,NULL),
	(1501,'paths','textarea',1,'Paths',13,1,'','[Paths Note]',0,NULL,'[Paths Info]',0,NULL,NULL,'Paths',NULL,NULL,NULL,0,0,'',0,0,'',441,1,NULL),
	(1502,'created_at','text',1,'Created At',14,0,'','[Created At Note]',0,NULL,'[Created At Info]',0,NULL,NULL,'Created At',NULL,NULL,NULL,0,0,'',0,0,'',441,1,NULL),
	(1503,'file_id','text',1,'File Id',8,1,'','[File Id Note]',0,NULL,'[File Id Info]',0,NULL,NULL,'File Id',NULL,NULL,NULL,0,0,'',1,1,'',478,1,NULL),
	(1504,'adapter_id','text',1,'Adapter Id',9,1,'0','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',0,0,'',478,1,NULL),
	(1505,'file_size','text',1,'File Size',10,1,'0','[File Size Note]',0,NULL,'[File Size Info]',0,NULL,NULL,'File Size',NULL,NULL,NULL,0,0,'',0,0,'',478,1,NULL),
	(1506,'user_id','text',1,'User Id',11,0,'0','[User Id Note]',0,NULL,'[User Id Info]',0,NULL,NULL,'User Id',NULL,NULL,NULL,0,0,'',0,0,'',478,1,NULL),
	(1507,'file_mime','text',1,'File Mime',12,1,'','[File Mime Note]',0,NULL,'[File Mime Info]',0,NULL,NULL,'File Mime',NULL,NULL,NULL,0,0,'',0,0,'',478,1,NULL),
	(1508,'paths','textarea',1,'Paths',13,1,'','[Paths Note]',0,NULL,'[Paths Info]',0,NULL,NULL,'Paths',NULL,NULL,NULL,0,0,'',0,0,'',478,1,NULL),
	(1509,'created_at','text',1,'Created At',14,0,'','[Created At Note]',0,NULL,'[Created At Info]',0,NULL,NULL,'Created At',NULL,NULL,NULL,0,0,'',0,0,'',478,1,NULL),
	(1510,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',339,0,NULL),
	(1511,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',340,0,NULL),
	(1512,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',341,0,NULL),
	(1513,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',342,0,NULL),
	(1514,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',343,0,NULL),
	(1517,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',364,0,NULL),
	(1519,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',366,0,NULL),
	(1520,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',367,0,NULL),
	(1521,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',368,0,NULL),
	(1522,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',369,0,NULL),
	(1523,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',370,0,NULL),
	(1524,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',371,0,NULL),
	(1526,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',579,0,NULL),
	(1527,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',580,0,NULL),
	(1528,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',581,0,NULL),
	(1529,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',390,0,NULL),
	(1530,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',391,0,NULL),
	(1531,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',392,0,NULL),
	(1532,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',393,0,NULL),
	(1533,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',395,0,NULL),
	(1534,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',396,0,NULL),
	(1535,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',397,0,NULL),
	(1536,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',398,0,NULL),
	(1537,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',399,0,NULL),
	(1538,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',400,0,NULL),
	(1539,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',401,0,NULL),
	(1540,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',402,0,NULL),
	(1541,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',403,0,NULL),
	(1542,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',406,0,NULL),
	(1546,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',410,0,NULL),
	(1547,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',435,0,NULL),
	(1550,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',438,0,NULL),
	(1551,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',439,0,NULL),
	(1553,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',441,0,NULL),
	(1619,'options_text','text',0,'Options Text',24,0,'','[Options Text Note]',0,NULL,'[Options Text Info]',0,NULL,NULL,'Options Text',NULL,NULL,NULL,0,0,'',0,0,'',571,1,NULL),
	(1620,'options_text','text',0,'Options Text',24,0,'','[Options Text Note]',0,NULL,'[Options Text Info]',0,NULL,NULL,'Options Text',NULL,NULL,NULL,0,0,'',0,0,'',577,1,NULL),
	(1621,'options_text','text',0,'Options Text',24,0,'','[Options Text Note]',0,NULL,'[Options Text Info]',0,NULL,NULL,'Options Text',NULL,NULL,NULL,0,0,'',0,0,'',574,1,NULL),
	(1622,'options_text','text',0,'Options Text',24,0,'','[Options Text Note]',0,NULL,'[Options Text Info]',0,NULL,NULL,'Options Text',NULL,NULL,NULL,0,0,'',0,0,'',580,1,NULL),
	(1623,'options_text','text',0,'Options Text',24,0,'','[Options Text Note]',0,NULL,'[Options Text Info]',0,NULL,NULL,'Options Text',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(1798,'driver_id','text',1,'Driver Id',10,0,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',1,1,'',621,1,NULL),
	(1799,'driver_name','text',1,'Driver Name',11,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',621,1,NULL),
	(1800,'driver_type','text',1,'Driver Type',12,0,'','[Driver Type Note]',0,NULL,'[Driver Type Info]',0,NULL,NULL,'Driver Type',NULL,NULL,NULL,0,0,'',0,0,'',621,1,NULL),
	(1801,'title','text',1,'Title',13,0,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',621,1,NULL),
	(1802,'description','textarea',1,'Description',14,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',621,1,NULL),
	(1803,'form_name','text',1,'Form Name',15,0,'','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',621,1,NULL),
	(1804,'is_active','yesno',1,'Is Active',16,0,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',621,1,NULL),
	(1805,'package_id','text',1,'Package Id',17,0,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',621,1,NULL),
	(1806,'ordering','text',1,'Sort Order',18,0,'9','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',621,1,NULL),
	(1807,'driver_id','text',1,'Driver Id',10,0,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',1,1,'',623,1,NULL),
	(1808,'driver_name','text',1,'Driver Name',11,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',623,1,NULL),
	(1809,'driver_type','text',1,'Driver Type',12,0,'','[Driver Type Note]',0,NULL,'[Driver Type Info]',0,NULL,NULL,'Driver Type',NULL,NULL,NULL,0,0,'',0,0,'',623,1,NULL),
	(1810,'title','text',1,'Title',13,0,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',623,1,NULL),
	(1811,'description','textarea',1,'Description',14,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',623,1,NULL),
	(1812,'form_name','text',1,'Form Name',15,0,'','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',623,1,NULL),
	(1813,'is_active','yesno',1,'Is Active',16,0,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',623,1,NULL),
	(1814,'package_id','text',1,'Package Id',17,0,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',623,1,NULL),
	(1815,'ordering','text',1,'Sort Order',18,0,'9','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',623,1,NULL),
	(1816,'driver_id','text',1,'Driver Id',10,0,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',1,1,'',622,1,NULL),
	(1817,'driver_name','text',1,'Driver Name',11,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',622,1,NULL),
	(1818,'driver_type','text',1,'Driver Type',12,0,'','[Driver Type Note]',0,NULL,'[Driver Type Info]',0,NULL,NULL,'Driver Type',NULL,NULL,NULL,0,0,'',0,0,'',622,1,NULL),
	(1819,'title','text',1,'Title',13,0,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',622,1,NULL),
	(1820,'description','textarea',1,'Description',14,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',622,1,NULL),
	(1821,'form_name','text',1,'Form Name',15,0,'','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',622,1,NULL),
	(1822,'is_active','yesno',1,'Is Active',16,0,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',622,1,NULL),
	(1823,'package_id','text',1,'Package Id',17,0,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',622,1,NULL),
	(1824,'ordering','text',1,'Sort Order',18,0,'9','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',622,1,NULL),
	(1825,'driver_id','text',1,'Driver Id',10,0,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',1,1,'',624,1,NULL),
	(1826,'driver_name','text',1,'Driver Name',11,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',624,1,NULL),
	(1827,'driver_type','text',1,'Driver Type',12,0,'','[Driver Type Note]',0,NULL,'[Driver Type Info]',0,NULL,NULL,'Driver Type',NULL,NULL,NULL,0,0,'',0,0,'',624,1,NULL),
	(1828,'title','text',1,'Title',13,0,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',624,1,NULL),
	(1829,'description','textarea',1,'Description',14,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',624,1,NULL),
	(1830,'form_name','text',1,'Form Name',15,0,'','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',624,1,NULL),
	(1831,'is_active','yesno',1,'Is Active',16,0,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',624,1,NULL),
	(1832,'package_id','text',1,'Package Id',17,0,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',624,1,NULL),
	(1833,'ordering','text',1,'Sort Order',18,0,'9','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',624,1,NULL),
	(1834,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',624,0,NULL),
	(1835,'driver_id','text',1,'Driver Id',10,0,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',1,1,'',625,1,NULL),
	(1836,'driver_name','text',1,'Driver Name',11,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',625,1,NULL),
	(1837,'driver_type','text',1,'Driver Type',12,0,'','[Driver Type Note]',0,NULL,'[Driver Type Info]',0,NULL,NULL,'Driver Type',NULL,NULL,NULL,0,0,'',0,0,'',625,1,NULL),
	(1838,'title','text',1,'Title',13,0,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',625,1,NULL),
	(1839,'description','textarea',1,'Description',14,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',625,1,NULL),
	(1840,'form_name','text',1,'Form Name',15,0,'','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',625,1,NULL),
	(1841,'is_active','yesno',1,'Is Active',16,0,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',625,1,NULL),
	(1842,'package_id','text',1,'Package Id',17,0,'core','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',625,1,NULL),
	(1843,'ordering','text',1,'Sort Order',18,0,'9','[Sort Order Note]',0,NULL,'[Sort Order Info]',0,NULL,NULL,'Sort Order',NULL,NULL,NULL,0,0,'',0,0,'',625,1,NULL),
	(1849,'adapter_id','text',1,'Adapter Id',9,0,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',626,1,NULL),
	(1850,'driver_type','text',1,'Driver Type',10,0,'','[Driver Type Note]',0,NULL,'[Driver Type Info]',0,NULL,NULL,'Driver Type',NULL,NULL,NULL,0,0,'',0,0,'',626,1,NULL),
	(1851,'driver_name','text',1,'Driver Name',11,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',626,1,NULL),
	(1852,'params','textarea',1,'Params',12,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',626,1,NULL),
	(1853,'is_active','yesno',1,'Is Active',13,0,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',626,1,NULL),
	(1854,'is_required','yesno',1,'Is Required',14,1,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',626,1,NULL),
	(1855,'title','text',1,'Title',15,0,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',626,1,NULL),
	(1856,'description','textarea',1,'Description',16,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',626,1,NULL),
	(1857,'adapter_id','text',1,'Adapter Id',9,0,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',630,1,NULL),
	(1858,'driver_type','text',1,'Driver Type',10,0,'','[Driver Type Note]',0,NULL,'[Driver Type Info]',0,NULL,NULL,'Driver Type',NULL,NULL,NULL,0,0,'',0,0,'',630,1,NULL),
	(1859,'driver_name','text',1,'Driver Name',11,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',630,1,NULL),
	(1860,'params','textarea',1,'Params',12,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',630,1,NULL),
	(1861,'is_active','yesno',1,'Is Active',13,0,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',630,1,NULL),
	(1862,'is_required','yesno',1,'Is Required',14,1,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',630,1,NULL),
	(1863,'title','text',1,'Title',15,0,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',630,1,NULL),
	(1864,'description','textarea',1,'Description',16,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',630,1,NULL),
	(1865,'adapter_id','text',1,'Adapter Id',9,0,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',628,1,NULL),
	(1866,'driver_type','text',1,'Driver Type',10,0,'','[Driver Type Note]',0,NULL,'[Driver Type Info]',0,NULL,NULL,'Driver Type',NULL,NULL,NULL,0,0,'',0,0,'',628,1,NULL),
	(1867,'driver_name','text',1,'Driver Name',11,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',628,1,NULL),
	(1868,'params','textarea',1,'Params',12,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',628,1,NULL),
	(1869,'is_active','yesno',1,'Is Active',13,0,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',628,1,NULL),
	(1870,'is_required','yesno',1,'Is Required',14,1,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',628,1,NULL),
	(1871,'title','text',1,'Title',15,0,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',628,1,NULL),
	(1872,'description','textarea',1,'Description',16,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',628,1,NULL),
	(1873,'adapter_id','text',1,'Adapter Id',9,0,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',632,1,NULL),
	(1874,'driver_type','text',1,'Driver Type',10,0,'','[Driver Type Note]',0,NULL,'[Driver Type Info]',0,NULL,NULL,'Driver Type',NULL,NULL,NULL,0,0,'',0,0,'',632,1,NULL),
	(1875,'driver_name','text',1,'Driver Name',11,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',632,1,NULL),
	(1876,'params','textarea',1,'Params',12,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',632,1,NULL),
	(1877,'is_active','yesno',1,'Is Active',13,0,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',632,1,NULL),
	(1878,'is_required','yesno',1,'Is Required',14,1,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',632,1,NULL),
	(1879,'title','text',1,'Title',15,0,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',632,1,NULL),
	(1880,'description','textarea',1,'Description',16,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',632,1,NULL),
	(1881,'q','text',0,'Keywords',1,1,'','',0,NULL,'',0,NULL,NULL,'Keywords',NULL,NULL,NULL,0,0,'',0,0,'',632,0,NULL),
	(1882,'adapter_id','text',1,'Adapter Id',9,0,'','[Adapter Id Note]',0,NULL,'[Adapter Id Info]',0,NULL,NULL,'Adapter Id',NULL,NULL,NULL,0,0,'',1,1,'',634,1,NULL),
	(1883,'driver_type','text',1,'Driver Type',10,0,'','[Driver Type Note]',0,NULL,'[Driver Type Info]',0,NULL,NULL,'Driver Type',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(1884,'driver_name','text',1,'Driver Name',11,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(1885,'params','textarea',1,'Params',12,0,'','[Params Note]',0,NULL,'[Params Info]',0,NULL,NULL,'Params',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(1886,'is_active','yesno',1,'Is Active',13,0,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(1887,'is_required','yesno',1,'Is Required',14,1,'0','[Is Required Note]',0,NULL,'[Is Required Info]',0,NULL,NULL,'Is Required',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(1888,'title','text',1,'Title',15,0,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(1889,'description','textarea',1,'Description',16,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(1890,'driver_name','text',1,'Driver Name',7,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',76,1,NULL),
	(1891,'driver_name','text',1,'Driver Name',7,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',296,1,NULL),
	(1892,'driver_name','text',1,'Driver Name',7,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',186,1,NULL),
	(1893,'driver_name','text',1,'Driver Name',7,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',406,1,NULL),
	(1894,'driver_name','text',1,'Driver Name',7,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',469,1,NULL),
	(1900,'driver_name','text',1,'Driver Name',8,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',109,1,NULL),
	(1901,'driver_name','text',1,'Driver Name',8,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',329,1,NULL),
	(1902,'driver_name','text',1,'Driver Name',8,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',219,1,NULL),
	(1903,'driver_name','text',1,'Driver Name',8,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',439,1,NULL),
	(1904,'driver_name','text',1,'Driver Name',8,0,'','[Driver Name Note]',0,NULL,'[Driver Name Info]',0,NULL,NULL,'Driver Name',NULL,NULL,NULL,0,0,'',0,0,'',476,1,NULL),
	(1905,'driver_id','text',1,'Driver Id',9,0,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',626,1,NULL),
	(1906,'driver_id','text',1,'Driver Id',9,0,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',630,1,NULL),
	(1907,'driver_id','text',1,'Driver Id',9,0,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',628,1,NULL),
	(1908,'driver_id','text',1,'Driver Id',9,0,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',632,1,NULL),
	(1909,'driver_id','text',1,'Driver Id',9,0,'','[Driver Id Note]',0,NULL,'[Driver Id Info]',0,NULL,NULL,'Driver Id',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(1916,'driver_identity','text',1,'Driver Identity',10,0,'','[Driver Identity Note]',0,NULL,'[Driver Identity Info]',0,NULL,NULL,'Driver Identity',NULL,NULL,NULL,0,0,'',1,1,'',621,1,NULL),
	(1917,'form_settings_class','text',1,'Form Settings Class',11,0,'','[Form Settings Class Note]',0,NULL,'[Form Settings Class Info]',0,NULL,NULL,'Form Settings Class',NULL,NULL,NULL,0,0,'',0,0,'',621,1,NULL),
	(1918,'driver_identity','text',1,'Driver Identity',10,0,'','[Driver Identity Note]',0,NULL,'[Driver Identity Info]',0,NULL,NULL,'Driver Identity',NULL,NULL,NULL,0,0,'',1,1,'',623,1,NULL),
	(1919,'form_settings_class','text',1,'Form Settings Class',11,0,'','[Form Settings Class Note]',0,NULL,'[Form Settings Class Info]',0,NULL,NULL,'Form Settings Class',NULL,NULL,NULL,0,0,'',0,0,'',623,1,NULL),
	(1920,'driver_identity','text',1,'Driver Identity',10,0,'','[Driver Identity Note]',0,NULL,'[Driver Identity Info]',0,NULL,NULL,'Driver Identity',NULL,NULL,NULL,0,0,'',1,1,'',622,1,NULL),
	(1921,'form_settings_class','text',1,'Form Settings Class',11,0,'','[Form Settings Class Note]',0,NULL,'[Form Settings Class Info]',0,NULL,NULL,'Form Settings Class',NULL,NULL,NULL,0,0,'',0,0,'',622,1,NULL),
	(1922,'driver_identity','text',1,'Driver Identity',10,0,'','[Driver Identity Note]',0,NULL,'[Driver Identity Info]',0,NULL,NULL,'Driver Identity',NULL,NULL,NULL,0,0,'',1,1,'',624,1,NULL),
	(1923,'form_settings_class','text',1,'Form Settings Class',11,0,'','[Form Settings Class Note]',0,NULL,'[Form Settings Class Info]',0,NULL,NULL,'Form Settings Class',NULL,NULL,NULL,0,0,'',0,0,'',624,1,NULL),
	(1924,'driver_identity','text',1,'Driver Identity',10,0,'','[Driver Identity Note]',0,NULL,'[Driver Identity Info]',0,NULL,NULL,'Driver Identity',NULL,NULL,NULL,0,0,'',1,1,'',625,1,NULL),
	(1925,'form_settings_class','text',1,'Form Settings Class',11,0,'','[Form Settings Class Note]',0,NULL,'[Form Settings Class Info]',0,NULL,NULL,'Form Settings Class',NULL,NULL,NULL,0,0,'',0,0,'',625,1,NULL),
	(1932,'core__clear_cache','yesno',0,'Clear Cache',0,1,NULL,'[Clear Cache Note]',0,NULL,'[Clear Cache Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1933,'core__manage_package','yesno',0,'Manage Package',0,1,NULL,'[Manage Package Note]',0,NULL,'[Manage Package Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1934,'core__install_package','yesno',0,'Install Package',0,1,NULL,'[Install Package Note]',0,NULL,'[Install Package Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1935,'core__access_admin','yesno',0,'Access Admin',0,1,NULL,'[Access Admin Note]',0,NULL,'[Access Admin Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1936,'core__manage_layout','yesno',0,'Manage Layout',0,1,NULL,'[Manage Layout Note]',0,NULL,'[Manage Layout Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1937,'core__manage_site_setting','yesno',0,'Manage Site Setting',0,1,NULL,'[Manage Site Setting Note]',0,NULL,'[Manage Site Setting Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1938,'core__manage_acl_setting','yesno',0,'Manage Acl Setting',0,1,NULL,'[Manage Acl Setting Note]',0,NULL,'[Manage Acl Setting Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1939,'core__moderate_content','yesno',0,'Moderate Content',0,1,NULL,'[Moderate Content Note]',0,NULL,'[Moderate Content Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1940,'core__manage_cache','yesno',0,'Manage Cache',0,1,NULL,'[Manage Cache Note]',0,NULL,'[Manage Cache Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1941,'core__clear_log','yesno',0,'Clear Log',0,1,NULL,'[Clear Log Note]',0,NULL,'[Clear Log Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1942,'core__manage_log','yesno',0,'Manage Log',0,1,NULL,'[Manage Log Note]',0,NULL,'[Manage Log Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1943,'core__manage_admin','yesno',0,'Manage Admin',0,1,NULL,'[Manage Admin Note]',0,NULL,'[Manage Admin Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1944,'core__manage_theme','yesno',0,'Manage Theme',0,1,NULL,'[Manage Theme Note]',0,NULL,'[Manage Theme Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1945,'core__manage_acl_role','yesno',0,'Manage Acl Role',0,1,NULL,'[Manage Acl Role Note]',0,NULL,'[Manage Acl Role Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',676,0,NULL),
	(1946,'core__default_captcha_id','select',0,'Default Captcha Id',1,1,NULL,'[Default Captcha Id Note]',0,NULL,'[Default Captcha Id Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',665,0,NULL),
	(1947,'core__license_key','text',0,'License Key',1,1,NULL,'[License Key Note]',0,NULL,'[License Key Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',667,0,NULL),
	(1948,'core__license_email','text',0,'License Email',1,1,NULL,'[License Email Note]',0,NULL,'[License Email Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',667,0,NULL),
	(1949,'core__license_package','text',0,'License Package',1,1,NULL,'[License Package Note]',0,NULL,'[License Package Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',667,0,NULL),
	(1951,'core__cookie_path','text',1,'Cookie Path',6,1,'/','[experience_only]',1,'_core','[Cookie Path Info]',0,'',NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',677,0,NULL),
	(1952,'core__cookie_domain','text',0,'Cookie Domain',5,1,'','[experience_only]',1,'_core','[Cookie Domain Info]',0,'',NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',677,0,NULL),
	(1953,'core__cookie_httponly','yesno',1,'Http Only',8,1,'1','[experience_only]',1,'_core','[Http Only Info]',0,'',NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',677,0,NULL),
	(1954,'department_id','text',1,'Department Id',7,0,'','[Department Id Note]',0,NULL,'[Department Id Info]',0,NULL,NULL,'Department Id',NULL,NULL,NULL,0,0,'',1,1,'',143,1,NULL),
	(1955,'name','text',1,'Name',8,0,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',143,1,NULL),
	(1956,'email','text',1,'Email',9,0,'','[Email Note]',0,NULL,'[Email Info]',0,NULL,NULL,'Email',NULL,NULL,NULL,0,0,'',0,0,'',143,1,NULL),
	(1957,'description','textarea',1,'Description',10,0,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',143,1,NULL),
	(1958,'is_active','yesno',1,'Is Active',11,0,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',143,1,NULL),
	(1959,'is_default','yesno',1,'Is Default',12,1,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',143,1,NULL),
	(1960,'form_title','text',0,'Form Title',9,0,'','[Form Title Note]',0,NULL,'[Form Title Info]',0,NULL,NULL,'Form Title',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(1961,'form_info','text',0,'Form Info',10,0,'','[Form Info Note]',0,NULL,'[Form Info Info]',0,NULL,NULL,'Form Info',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(1962,'form_title','text',0,'Form Title',9,1,'','',0,NULL,'',0,NULL,NULL,'Form Title',NULL,NULL,NULL,0,0,'',0,0,'',573,1,NULL),
	(1963,'form_info','text',0,'Form Info',10,1,'','',0,NULL,'',0,NULL,NULL,'Form Info',NULL,NULL,NULL,0,0,'',0,0,'',573,1,NULL),
	(1964,'data_submit','text',0,'Data Submit',12,1,'','[Data Submit Note]',0,NULL,'[Data Submit Info]',0,NULL,NULL,'Data Submit',NULL,NULL,NULL,0,0,'',0,0,'',573,1,NULL),
	(1965,'cancel_url','text',0,'Cancel Url',13,1,'','[Cancel Url Note]',0,NULL,'[Cancel Url Info]',0,NULL,NULL,'Cancel Url',NULL,NULL,NULL,0,0,'',0,0,'',573,1,NULL),
	(1966,'action_url','text',0,'Action Url',14,1,'','[Action Url Note]',0,NULL,'[Action Url Info]',0,NULL,NULL,'Action Url',NULL,NULL,NULL,0,0,'',0,0,'',573,1,NULL),
	(1967,'id','text',1,'Id',12,0,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',688,1,NULL),
	(1968,'package_id','text',0,'Package Id',13,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',688,1,NULL),
	(1969,'table_name','text',0,'Table Name',14,1,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',0,0,'',688,1,NULL),
	(1970,'action_type','text',0,'Action Type',15,1,'','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',688,1,NULL),
	(1971,'action_id','text',0,'Action Id',16,1,'skip','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',688,1,NULL),
	(1972,'text_domain','text',0,'Text Domain',17,1,'','[Text Domain Note]',0,NULL,'[Text Domain Info]',0,NULL,NULL,'Text Domain',NULL,NULL,NULL,0,0,'',0,0,'',688,1,NULL),
	(1973,'form_title','text',0,'Form Title',18,1,'','[Form Title Note]',0,NULL,'[Form Title Info]',0,NULL,NULL,'Form Title',NULL,NULL,NULL,0,0,'',0,0,'',688,1,NULL),
	(1974,'form_info','text',0,'Form Info',19,1,'','[Form Info Note]',0,NULL,'[Form Info Info]',0,NULL,NULL,'Form Info',NULL,NULL,NULL,0,0,'',0,0,'',688,1,NULL),
	(1975,'data_submit','text',0,'Data Submit',20,1,'','[Data Submit Note]',0,NULL,'[Data Submit Info]',0,NULL,NULL,'Data Submit',NULL,NULL,NULL,0,0,'',0,0,'',688,1,NULL),
	(1976,'cancel_url','text',0,'Cancel Url',21,1,'','[Cancel Url Note]',0,NULL,'[Cancel Url Info]',0,NULL,NULL,'Cancel Url',NULL,NULL,NULL,0,0,'',0,0,'',688,1,NULL),
	(1977,'action_url','text',0,'Action Url',22,1,'','[Action Url Note]',0,NULL,'[Action Url Info]',0,NULL,NULL,'Action Url',NULL,NULL,NULL,0,0,'',0,0,'',688,1,NULL),
	(1978,'meta_id','text',1,'Meta Id',12,0,'','[Meta Id Note]',0,NULL,'[Meta Id Info]',0,NULL,NULL,'Meta Id',NULL,NULL,NULL,0,0,'',1,1,'',689,1,NULL),
	(1979,'package_id','text',0,'Package Id',13,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',689,1,NULL),
	(1980,'table_name','text',0,'Table Name',14,1,'','[Table Name Note]',0,NULL,'[Table Name Info]',0,NULL,NULL,'Table Name',NULL,NULL,NULL,0,0,'',0,0,'',689,1,NULL),
	(1981,'action_type','text',0,'Action Type',15,1,'','[Action Type Note]',0,NULL,'[Action Type Info]',0,NULL,NULL,'Action Type',NULL,NULL,NULL,0,0,'',0,0,'',689,1,NULL),
	(1982,'action_id','text',0,'Action Id',16,1,'skip','[Action Id Note]',0,NULL,'[Action Id Info]',0,NULL,NULL,'Action Id',NULL,NULL,NULL,0,0,'',0,0,'',689,1,NULL),
	(1983,'text_domain','text',0,'Text Domain',17,1,'','[Text Domain Note]',0,NULL,'[Text Domain Info]',0,NULL,NULL,'Text Domain',NULL,NULL,NULL,0,0,'',0,0,'',689,1,NULL),
	(1984,'form_title','text',0,'Form Title',18,1,'','[Form Title Note]',0,NULL,'[Form Title Info]',0,NULL,NULL,'Form Title',NULL,NULL,NULL,0,0,'',0,0,'',689,1,NULL),
	(1985,'form_info','text',0,'Form Info',19,1,'','[Form Info Note]',0,NULL,'[Form Info Info]',0,NULL,NULL,'Form Info',NULL,NULL,NULL,0,0,'',0,0,'',689,1,NULL),
	(1986,'data_submit','text',0,'Data Submit',20,1,'','[Data Submit Note]',0,NULL,'[Data Submit Info]',0,NULL,NULL,'Data Submit',NULL,NULL,NULL,0,0,'',0,0,'',689,1,NULL),
	(1987,'cancel_url','text',0,'Cancel Url',21,1,'','[Cancel Url Note]',0,NULL,'[Cancel Url Info]',0,NULL,NULL,'Cancel Url',NULL,NULL,NULL,0,0,'',0,0,'',689,1,NULL),
	(1988,'action_url','text',0,'Action Url',22,1,'','[Action Url Note]',0,NULL,'[Action Url Info]',0,NULL,NULL,'Action Url',NULL,NULL,NULL,0,0,'',0,0,'',689,1,NULL),
	(1989,'id','text',1,'Id',12,0,'','[Id Note]',0,NULL,'[Id Info]',0,NULL,NULL,'Id',NULL,NULL,NULL,0,0,'',1,1,'',689,1,NULL),
	(1990,'department_id','text',1,'Department Id',7,0,'','[Department Id Note]',0,NULL,'[Department Id Info]',0,NULL,NULL,'Department Id',NULL,NULL,NULL,0,0,'',1,1,'',504,1,NULL),
	(1991,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',504,1,NULL),
	(1992,'email','text',1,'Email',9,1,'','[Email Note]',0,NULL,'[Email Info]',0,NULL,NULL,'Email',NULL,NULL,NULL,0,0,'',0,0,'',504,1,NULL),
	(1993,'description','textarea',1,'Description',10,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',504,1,NULL),
	(1994,'is_active','yesno',1,'Is Active',11,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',504,1,NULL),
	(1995,'is_default','yesno',1,'Is Default',12,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',504,1,NULL),
	(1996,'department_id','text',1,'Department Id',7,0,'','[Department Id Note]',0,NULL,'[Department Id Info]',0,NULL,NULL,'Department Id',NULL,NULL,NULL,0,0,'',1,1,'',253,1,NULL),
	(1997,'name','text',1,'Name',8,1,'','[Name Note]',0,NULL,'[Name Info]',0,NULL,NULL,'Name',NULL,NULL,NULL,0,0,'',0,0,'',253,1,NULL),
	(1998,'email','text',1,'Email',9,1,'','[Email Note]',0,NULL,'[Email Info]',0,NULL,NULL,'Email',NULL,NULL,NULL,0,0,'',0,0,'',253,1,NULL),
	(1999,'description','textarea',1,'Description',10,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',253,1,NULL),
	(2000,'is_active','yesno',1,'Is Active',11,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',253,1,NULL),
	(2001,'is_default','yesno',1,'Is Default',12,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',253,1,NULL),
	(2034,'data_submit','text',0,'Data Submit',14,1,'','[Data Submit Note]',0,NULL,'[Data Submit Info]',0,NULL,NULL,'Data Submit',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(2035,'cancel_url','text',0,'Cancel Url',15,1,'','[Cancel Url Note]',0,NULL,'[Cancel Url Info]',0,NULL,NULL,'Cancel Url',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(2036,'action_url','text',0,'Action Url',16,1,'','[Action Url Note]',0,NULL,'[Action Url Info]',0,NULL,NULL,'Action Url',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(2037,'title_domain','text',0,'Title Domain',17,1,'','[Title Domain Note]',0,NULL,'[Title Domain Info]',0,NULL,NULL,'Title Domain',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(2038,'info_domain','text',0,'Info Domain',18,1,'','[Info Domain Note]',0,NULL,'[Info Domain Info]',0,NULL,NULL,'Info Domain',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(2039,'submit_label','text',0,'Submit Label',17,1,'','[Submit Label Note]',0,NULL,'[Submit Label Info]',0,NULL,NULL,'Submit Label',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(2040,'form_enctype','text',0,'Form Enctype',18,1,'multipart/form-data','[Form Enctype Note]',0,NULL,'[Form Enctype Info]',0,NULL,NULL,'Form Enctype',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(2041,'form_method','text',0,'Form Method',19,1,'post','[Form Method Note]',0,NULL,'[Form Method Info]',0,NULL,NULL,'Form Method',NULL,NULL,NULL,0,0,'',0,0,'',582,1,NULL),
	(2117,'core__site_title','text',1,'Site Title',1,1,NULL,'[Site Title Note]',0,NULL,'[Site Title Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2118,'core__title_separator','text',1,'Title Separator',4,1,'&#187;','[Title Separator Note]',0,NULL,'[Title Separator Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2119,'core__site_description','textarea',0,'Site Description',7,1,NULL,'[Site Description Note]',0,NULL,'[Site Description Info]',0,NULL,NULL,'',NULL,'3',NULL,0,0,'',0,0,'',670,0,NULL),
	(2120,'core__description_limit','text',1,'Description Limit',9,1,NULL,'[Description Limit Note]',0,NULL,'[Description Limit Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2121,'core__site_keyword','textarea',0,'Site Keyword',10,1,NULL,'[Site Keyword Note]',0,NULL,'[Site Keyword Info]',0,NULL,NULL,'',NULL,'3',NULL,0,0,'',0,0,'',670,0,NULL),
	(2122,'core__keyword_limit','text',1,'Keyword Limit',11,1,NULL,'[Keyword Limit Note]',0,NULL,'[Keyword Limit Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2123,'core__enable_facebook','yesno',1,'Enable Facebook',12,1,NULL,'[Enable Facebook Note]',0,NULL,'[Enable Facebook Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2124,'core__facebook_app_id','text',0,'Facebook App Id',13,1,NULL,'[Facebook App Id Note]',0,NULL,'[Facebook App Id Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2125,'core__facebook_app_secret','text',0,'Facebook App Secret',14,1,NULL,'[Facebook App Secret Note]',0,NULL,'[Facebook App Secret Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2126,'core__facebook_app_name','text',0,'Facebook App Name',15,1,NULL,'[Facebook App Name Note]',0,NULL,'[Facebook App Name Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2127,'core__enable_google_plus','yesno',1,'Enable Google Plus',16,1,NULL,'[Enable Google Plus Note]',0,NULL,'[Enable Google Plus Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2128,'core__google_plus_id','select',0,'Google Plus ID',17,1,NULL,'[Google Plus Id Note]',0,NULL,'[Google Plus Id Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2129,'core__enable_google_analytic','yesno',1,'Enable Google Analytic',18,1,NULL,'[Enable Google Analytic Note]',0,NULL,'[Enable Google Analytic Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2130,'core__google_analytic_id','text',0,'Google Analytic ID',19,1,NULL,'[Google Analytic Id Note]',0,NULL,'[Google Analytic Id Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2131,'core__enable_open_graph','yesno',1,'Enable Open Graph',20,1,NULL,'[Enable Open Graph Note]',0,NULL,'[Enable Open Graph Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',670,0,NULL),
	(2132,'core__bundle_js','yesno',1,'Use Bundle JS',9,1,NULL,'[Bundle Js Note]',0,NULL,'[Bundle Js Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',690,0,NULL),
	(2133,'core__bundle_css','yesno',1,'Use Bundle CSS',10,1,NULL,'[Bundle Css Note]',0,NULL,'[Bundle Css Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',690,0,NULL),
	(2134,'core__ajax_mode','radio',1,'Ajax Mode',6,1,NULL,'[Ajax Mode Note]',0,NULL,'[Ajax Mode Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',690,0,'\Phpfox::get(\'core.setting\')->getAjaxModeIdOptions()'),
	(2135,'core__force_https','yesno',1,'Force to Https',7,1,NULL,'[Force Https Note]',0,NULL,'[Force Https Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',690,0,NULL),
	(2136,'core__secure_img','yesno',1,'Secure Image',8,1,NULL,'[Secure Img Note]',0,NULL,'[Secure Img Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',690,0,NULL),
	(2137,'core__google_api_key','text',0,'Google Api Key',10,1,NULL,'[Google Api Key Note]',0,NULL,'[Google Api Key Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',690,0,NULL),
	(2138,'info_domain','text',0,'Info Domain',25,1,'','[Info Domain Note]',0,NULL,'[Info Domain Info]',0,NULL,NULL,'Info Domain',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(2139,'text_domain','text',0,'Text Domain',26,1,'','[Text Domain Note]',0,NULL,'[Text Domain Info]',0,NULL,NULL,'Text Domain',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(2140,'note_domain','text',0,'Note Domain',27,1,'','[Note Domain Note]',0,NULL,'[Note Domain Info]',0,NULL,NULL,'Note Domain',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(2141,'core__cookie_secure','yesno',1,'Cookie Secure',7,1,'0','[experience_only]',1,'_core','[Cookie Secure Info]',0,'',NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',677,0,NULL),
	(2142,'core__default_session_id','select',1,'Default Session Id',2,1,'files','[Default Session Id Note]',0,NULL,'[Default Session Id Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',677,0,'\Phpfox::get(\'core.adapter\')->getAdapterIdOptions(\'session\')'),
	(2143,'core__session_name','text',1,'Session Name',3,1,'PHPSESSID','[Session Name Note]',0,NULL,'[Session Name Info]',0,NULL,NULL,'','16',NULL,NULL,0,0,'',0,0,'',677,0,NULL),
	(2144,'has_note','text',0,'Has Note',28,1,'0','[Has Note Note]',0,NULL,'[Has Note Info]',0,NULL,NULL,'Has Note',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(2145,'has_info','text',0,'Has Info',29,1,'0','[Has Info Note]',0,NULL,'[Has Info Info]',0,NULL,NULL,'Has Info',NULL,NULL,NULL,0,0,'',0,0,'',583,1,NULL),
	(2146,'title','text',1,'Title',7,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',469,1,NULL),
	(2147,'title','text',1,'Title',8,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',476,1,NULL),
	(2148,'core__default_storage_id','select',1,'Default Storage Id',1,1,NULL,'[Default Storage Id Note]',0,NULL,'[Default Storage Id Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',671,0,'\Phpfox::get(\'core.storage\')->getAdapterIdOptions()'),
	(2149,'core__setting_version','text',1,'Setting Version',102,0,NULL,'[Setting Version Note]',0,NULL,'[Setting Version Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',690,0,NULL),
	(2150,'core__static_version','text',1,'Static Version',102,0,NULL,'[Static Version Note]',0,NULL,'[Static Version Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',690,0,NULL),
	(2151,'core__offline_code','text',1,'Offline Code',2,1,NULL,'[Offline Code Note]',0,NULL,'[Offline Code Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',690,0,NULL),
	(2152,'core__private_mode','radio',1,'Private Site',4,1,NULL,'[Private Site Note]',0,NULL,'[Private Site Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',690,0,'\Phpfox::get(\'core.setting\')->getPrivateSiteIdOptions()'),
	(2153,'user_register__show_dob','text',1,'Show Dob',5,1,NULL,'[Show Dob Note]',0,NULL,'[Show Dob Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2154,'user_register__show_gender','text',1,'Show Gender',5,1,NULL,'[Show Gender Note]',0,NULL,'[Show Gender Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2155,'user_register__show_displayname','text',1,'Show Displayname',5,1,NULL,'[Show Displayname Note]',0,NULL,'[Show Displayname Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2156,'user_register__show_locale','text',1,'Show Locale',5,1,NULL,'[Show Locale Note]',0,NULL,'[Show Locale Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2157,'user_register__show_location','text',1,'Show Location',5,1,NULL,'[Show Location Note]',0,NULL,'[Show Location Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2158,'user_register__show_timezone','text',1,'Show Timezone',5,1,NULL,'[Show Timezone Note]',0,NULL,'[Show Timezone Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2159,'user_register__show_captcha','text',1,'Show Captcha',5,1,NULL,'[Show Captcha Note]',0,NULL,'[Show Captcha Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2160,'user_register__show_username','text',1,'Show Username',5,1,NULL,'[Show Username Note]',0,NULL,'[Show Username Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2161,'user_register__show_email','text',1,'Show Email',5,1,NULL,'[Show Email Note]',0,NULL,'[Show Email Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2162,'user_register__show_reenter_email','text',1,'Show Reenter Email',5,1,NULL,'[Show Reenter Email Note]',0,NULL,'[Show Reenter Email Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2163,'user_register__show_password','text',1,'Show Password',5,1,NULL,'[Show Password Note]',0,NULL,'[Show Password Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2164,'user_register__show_reenter_password','text',1,'Show Reenter Password',5,1,NULL,'[Show Reenter Password Note]',0,NULL,'[Show Reenter Password Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2165,'user_register__show_terms','text',1,'Show Terms',5,1,NULL,'[Show Terms Note]',0,NULL,'[Show Terms Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2166,'user_register__show_invite_code','text',1,'Show Invite Code',5,1,NULL,'[Show Invite Code Note]',0,NULL,'[Show Invite Code Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2167,'user_register__show_currency','text',1,'Show Currency',5,1,NULL,'[Show Currency Note]',0,NULL,'[Show Currency Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2168,'user_register__successful_url','text',1,'Successful Url',5,1,NULL,'[Successful Url Note]',0,NULL,'[Successful Url Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2169,'user_register__send_welcome_email','text',1,'Send Welcome Email',5,1,NULL,'[Send Welcome Email Note]',0,NULL,'[Send Welcome Email Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2170,'user_register__send_verify_email','text',1,'Send Verify Email',5,1,NULL,'[Send Verify Email Note]',0,NULL,'[Send Verify Email Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2171,'user_register__login_after_success','text',1,'Login After Success',5,1,NULL,'[Login After Success Note]',0,NULL,'[Login After Success Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2172,'dependency','textarea',1,'Dependency',11,1,'','[Dependency Note]',0,NULL,'[Dependency Info]',0,NULL,NULL,'Dependency',NULL,NULL,NULL,0,0,'',0,0,'',625,1,NULL),
	(2173,'core__shared_cache_cache_id','select',1,'Default Cache Id',10,1,NULL,'[Default Cache Id Note]',0,NULL,'[Default Cache Id Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',664,0,'\Phpfox::get(\'core.adapter\')->getAdapterIdOptions(\'cache\')'),
	(2174,'core__default_locale_id','select',1,'Default Locale Id',9,1,NULL,'[Default Locale Id Note]',0,NULL,'[Default Locale Id Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',666,0,NULL),
	(2175,'core__default_timezone_id','select',1,'Default Timezone Id',9,1,NULL,'[Default Timezone Id Note]',0,NULL,'[Default Timezone Id Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',666,0,NULL),
	(2176,'core__default_currency_id','select',1,'Default Currency Id',9,1,NULL,'[Default Currency Id Note]',0,NULL,'[Default Currency Id Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',666,0,NULL),
	(2177,'core__default_mailer_id','select',1,'Default Mail Id',9,1,NULL,'[Default Mail Id Note]',0,NULL,'[Default Mail Id Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',669,0,NULL),
	(2178,'user_register__auto_login','text',1,'Auto Login',5,1,NULL,'[Auto Login Note]',0,NULL,'[Auto Login Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2179,'user_register__auto_approve','text',1,'Auto Approve',5,1,NULL,'[Auto Approve Note]',0,NULL,'[Auto Approve Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2180,'user_register__notify_admin','text',1,'Notify Admin',5,1,NULL,'[Notify Admin Note]',0,NULL,'[Notify Admin Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2181,'user_register__verify_email_timeout','text',1,'Verify Email Timeout',5,1,NULL,'[Verify Email Timeout Note]',0,NULL,'[Verify Email Timeout Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2182,'user_register__show_subscriptions','text',1,'Show Subscriptions',5,1,NULL,'[Show Subscriptions Note]',0,NULL,'[Show Subscriptions Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',675,0,NULL),
	(2183,'core__offline_mode','radio',1,'Offline Mode',1,1,NULL,'[Offline Mode Note]',0,NULL,'[Offline Mode Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',690,0,'\Phpfox::get(\'core.setting\')->getSiteModeIdOptions()'),
	(2184,'is_active','yesno',1,'Is Active',8,1,'0','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',469,1,NULL),
	(2185,'core__log_level','select',1,'Log Level',1,1,NULL,'[Log Level Note]',0,NULL,'[Log Level Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',668,0,'\Phpfox::get(\'core.setting\')->getLogLevelOptions()'),
	(2186,'is_default','yesno',1,'Is Default',10,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(2187,'is_default','yesno',1,'Is Default',8,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',466,1,NULL),
	(2188,'is_default','yesno',1,'Is Default',7,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',465,1,NULL),
	(2189,'is_default','yesno',1,'Is Default',8,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',468,1,NULL),
	(2190,'is_default','yesno',1,'Is Default',9,0,'0','[Is Default Note]',0,NULL,'[Is Default Info]',0,NULL,NULL,'Is Default',NULL,NULL,NULL,0,0,'',0,0,'',476,1,NULL),
	(2191,'core__default_sms_id','select',1,'Default SMS Service',1,1,NULL,'[Default SMS Id Note]',0,NULL,'[Default SMS Id Info]',0,'_core.sms',NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',672,0,'\Phpfox::get(\'core.adapter\')->getAdapterIdOptions(\'sms\')'),
	(2192,'core__session_maxlifetime','text',1,'Session Maxlifetime',4,1,'1440','[Session Maxlifetime Note]',0,NULL,'[Session Maxlifetime Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',677,0,NULL),
	(2193,'core__cookie_lifetime','text',1,'Session Lifetime',5,1,'0','[Session Lifetime Note]',0,NULL,'[Session Lifetime Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',677,0,NULL),
	(2194,'core__cookie_php_ini_only','yesno',1,'Use Php Ini',1,1,NULL,'[Use Php Ini Note]',0,NULL,'[Use Php Ini Info]',0,NULL,NULL,'',NULL,NULL,NULL,0,0,'',0,0,'',677,0,NULL),
	(2195,'cotnainer_id','text',1,'Cotnainer Id',11,1,'','[Cotnainer Id Note]',0,NULL,'[Cotnainer Id Info]',0,NULL,NULL,'Cotnainer Id',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(2196,'container_id','text',1,'Container Id',11,1,'','[Container Id Note]',0,NULL,'[Container Id Info]',0,NULL,NULL,'Container Id',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(2197,'service_id','text',1,'Service Id',11,1,'','[Service Id Note]',0,NULL,'[Service Id Info]',0,NULL,NULL,'Service Id',NULL,NULL,NULL,0,0,'',0,0,'',634,1,NULL),
	(2198,'level_id','text',1,'Level Id',13,0,'','[Level Id Note]',0,NULL,'[Level Id Info]',0,NULL,NULL,'Level Id',NULL,NULL,NULL,0,0,'',1,1,'',450,1,NULL),
	(2199,'level_id','text',1,'Level Id',6,1,'','[Level Id Note]',0,NULL,'[Level Id Info]',0,NULL,NULL,'Level Id',NULL,NULL,NULL,0,0,'',0,0,'',453,1,NULL),
	(2200,'form_id','text',1,'Form Id',8,1,'','[Form Id Note]',0,NULL,'[Form Id Info]',0,NULL,NULL,'Form Id',NULL,NULL,NULL,0,0,'',1,0,'',691,1,NULL),
	(2201,'package_id','text',1,'Package Id',9,1,'','[Package Id Note]',0,NULL,'[Package Id Info]',0,NULL,NULL,'Package Id',NULL,NULL,NULL,0,0,'',0,0,'',691,1,NULL),
	(2202,'title','text',1,'Title',10,1,'','[Title Note]',0,NULL,'[Title Info]',0,NULL,NULL,'Title',NULL,NULL,NULL,0,0,'',0,0,'',691,1,NULL),
	(2203,'form_name','text',1,'Form Name',11,1,'','[Form Name Note]',0,NULL,'[Form Name Info]',0,NULL,NULL,'Form Name',NULL,NULL,NULL,0,0,'',0,0,'',691,1,NULL),
	(2204,'description','textarea',1,'Description',12,1,'','[Description Note]',0,NULL,'[Description Info]',0,NULL,NULL,'Description',NULL,NULL,NULL,0,0,'',0,0,'',691,1,NULL),
	(2205,'ordering','text',1,'Ordering',13,1,'1','[Ordering Note]',0,NULL,'[Ordering Info]',0,NULL,NULL,'Ordering',NULL,NULL,NULL,0,0,'',0,0,'',691,1,NULL),
	(2206,'is_active','yesno',1,'Is Active',14,1,'1','[Is Active Note]',0,NULL,'[Is Active Info]',0,NULL,NULL,'Is Active',NULL,NULL,NULL,0,0,'',0,0,'',691,1,NULL),
	(2207,'form_id','text',1,'Form Id',9,1,'core','[Form Id Note]',0,NULL,'[Form Id Info]',0,NULL,NULL,'Form Id',NULL,NULL,NULL,0,0,'',0,0,'',451,1,NULL);

/*!40000 ALTER TABLE `pf5_dev_element` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_dev_form
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_dev_form`;

CREATE TABLE `pf5_dev_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_type` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_id` enum('default','skip','delete','create') COLLATE utf8_unicode_ci DEFAULT 'skip',
  `text_domain` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_info` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_submit` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancel_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'c',
  `action_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `table_name` (`table_name`,`action_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_dev_form` WRITE;
/*!40000 ALTER TABLE `pf5_dev_form` DISABLE KEYS */;

INSERT INTO `pf5_dev_form` (`id`, `package_id`, `table_name`, `action_type`, `action_id`, `text_domain`, `form_title`, `form_info`, `data_submit`, `cancel_url`, `action_url`)
VALUES
	(9,'core','acl_perm_allow','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(10,'core','acl_role','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(11,'core','acl_setting_action','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(12,'core','acl_setting_group','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(13,'core','acl_setting_value','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(14,'undefined','activity_action','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(15,'undefined','activity_hide','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(16,'undefined','activity_setting','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(17,'undefined','activity_stream','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(18,'undefined','activity_type','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(19,'undefined','activity_wall','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(20,'announcement','announcement','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(21,'announcement','announcement_exclude','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(23,'user','auth_history','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(24,'user','auth_log','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(25,'user','auth_password','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(26,'user','auth_remote','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(27,'user','auth_token','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(28,'blog','blog_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(29,'blog','blog_post','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(32,'undefined','comment','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(33,'contact','contact_department','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(34,'core','core_event','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(36,'core','core_job_log','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(37,'core','core_job_message','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(38,'core','core_log','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(39,'core','core_menu','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(40,'core','core_package','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(41,'core','core_permission','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(43,'event','event','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(44,'event','event_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(45,'event','event_member','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(46,'event','event_member_item','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(47,'event','event_member_list','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(48,'event','event_member_request','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(49,'friend','friend','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(50,'friend','friend_forward','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(51,'friend','friend_item','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(52,'friend','friend_list','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(53,'friend','friend_request','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(54,'group','group','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(55,'group','group_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(56,'group','group_member','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(57,'group','group_member_item','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(58,'group','group_member_list','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(59,'group','group_member_request','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(60,'core','i18n_currency','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(61,'core','i18n_locale','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(62,'core','i18n_message','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(63,'core','i18n_timezone','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(64,'invite','invite','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(65,'core','layout_action','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(66,'core','layout_block','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(67,'core','layout_component','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(68,'core','layout_container','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(69,'core','layout_grid','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(70,'core','layout_location','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(71,'core','layout_page','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(72,'core','layout_theme','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(73,'core','layout_theme_params','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(74,'like','like','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(75,'link','link','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(76,'core','log_adapter','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(80,'core','mail_template','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(81,'marketplace','marketplace_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(82,'undefined','messages','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(83,'undefined','notification','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(84,'undefined','notification_setting','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(85,'undefined','notification_type','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(86,'pages','pages','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(87,'pages','pages_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(88,'pages','pages_member','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(89,'pages','pages_member_item','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(90,'pages','pages_member_list','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(91,'pages','pages_member_request','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(92,'photo','photo','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(93,'photo','photo_album','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(94,'photo','photo_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(95,'poll','poll_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(96,'undefined','privacy','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(97,'quiz','quiz_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(100,'report','report_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(101,'report','report_item','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(102,'undefined','request','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(103,'undefined','request_setting','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(104,'undefined','request_type','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(105,'core','session','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(108,'core','site_setting_value','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(109,'core','storage_adapter','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(111,'core','storage_file','admin_add','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(112,'undefined','subject','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(113,'user','user','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(114,'user','user_verify_token','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(115,'video','video','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(116,'video','video_category','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(117,'video','video_channel','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(118,'video','video_provider','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(119,'core','acl_perm_allow','admin_edit','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(120,'core','acl_role','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(121,'core','acl_setting_action','admin_edit','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(122,'core','acl_setting_group','admin_edit','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(123,'core','acl_setting_value','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(124,'undefined','activity_action','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(125,'undefined','activity_hide','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(126,'undefined','activity_setting','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(127,'undefined','activity_stream','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(128,'undefined','activity_type','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(129,'undefined','activity_wall','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(130,'announcement','announcement','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(131,'announcement','announcement_exclude','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(133,'user','auth_history','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(134,'user','auth_log','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(135,'user','auth_password','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(136,'user','auth_remote','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(137,'user','auth_token','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(138,'blog','blog_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(139,'blog','blog_post','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(142,'undefined','comment','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(143,'contact','contact_department','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(144,'core','core_event','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(146,'core','core_job_log','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(147,'core','core_job_message','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(148,'core','core_log','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(149,'core','core_menu','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(150,'core','core_package','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(151,'core','core_permission','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(153,'event','event','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(154,'event','event_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(155,'event','event_member','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(156,'event','event_member_item','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(157,'event','event_member_list','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(158,'event','event_member_request','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(159,'friend','friend','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(160,'friend','friend_forward','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(161,'friend','friend_item','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(162,'friend','friend_list','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(163,'friend','friend_request','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(164,'group','group','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(165,'group','group_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(166,'group','group_member','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(167,'group','group_member_item','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(168,'group','group_member_list','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(169,'group','group_member_request','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(170,'core','i18n_currency','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(171,'core','i18n_locale','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(172,'core','i18n_message','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(173,'core','i18n_timezone','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(174,'invite','invite','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(175,'core','layout_action','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(176,'core','layout_block','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(177,'core','layout_component','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(178,'core','layout_container','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(179,'core','layout_grid','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(180,'core','layout_location','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(181,'core','layout_page','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(182,'core','layout_theme','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(183,'core','layout_theme_params','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(184,'like','like','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(185,'link','link','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(186,'core','log_adapter','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(190,'core','mail_template','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(191,'marketplace','marketplace_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(192,'undefined','messages','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(193,'undefined','notification','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(194,'undefined','notification_setting','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(195,'undefined','notification_type','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(196,'pages','pages','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(197,'pages','pages_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(198,'pages','pages_member','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(199,'pages','pages_member_item','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(200,'pages','pages_member_list','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(201,'pages','pages_member_request','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(202,'photo','photo','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(203,'photo','photo_album','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(204,'photo','photo_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(205,'poll','poll_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(206,'undefined','privacy','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(207,'quiz','quiz_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(210,'report','report_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(211,'report','report_item','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(212,'undefined','request','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(213,'undefined','request_setting','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(214,'undefined','request_type','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(215,'core','session','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(218,'core','site_setting_value','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(219,'core','storage_adapter','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(221,'core','storage_file','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(222,'undefined','subject','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(223,'user','user','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(224,'user','user_verify_token','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(225,'video','video','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(226,'video','video_category','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(227,'video','video_channel','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(228,'video','video_provider','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(229,'core','acl_perm_allow','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(230,'core','acl_role','admin_delete','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(231,'core','acl_setting_action','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(232,'core','acl_setting_group','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(233,'core','acl_setting_value','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(234,'undefined','activity_action','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(235,'undefined','activity_hide','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(236,'undefined','activity_setting','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(237,'undefined','activity_stream','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(238,'undefined','activity_type','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(239,'undefined','activity_wall','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(240,'announcement','announcement','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(241,'announcement','announcement_exclude','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(243,'user','auth_history','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(244,'user','auth_log','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(245,'user','auth_password','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(246,'user','auth_remote','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(247,'user','auth_token','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(248,'blog','blog_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(249,'blog','blog_post','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(252,'undefined','comment','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(253,'contact','contact_department','admin_delete','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(254,'core','core_event','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(256,'core','core_job_log','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(257,'core','core_job_message','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(258,'core','core_log','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(259,'core','core_menu','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(260,'core','core_package','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(261,'core','core_permission','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(263,'event','event','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(264,'event','event_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(265,'event','event_member','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(266,'event','event_member_item','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(267,'event','event_member_list','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(268,'event','event_member_request','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(269,'friend','friend','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(270,'friend','friend_forward','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(271,'friend','friend_item','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(272,'friend','friend_list','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(273,'friend','friend_request','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(274,'group','group','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(275,'group','group_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(276,'group','group_member','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(277,'group','group_member_item','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(278,'group','group_member_list','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(279,'group','group_member_request','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(280,'core','i18n_currency','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(281,'core','i18n_locale','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(282,'core','i18n_message','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(283,'core','i18n_timezone','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(284,'invite','invite','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(285,'core','layout_action','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(286,'core','layout_block','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(287,'core','layout_component','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(288,'core','layout_container','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(289,'core','layout_grid','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(290,'core','layout_location','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(291,'core','layout_page','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(292,'core','layout_theme','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(293,'core','layout_theme_params','admin_delete','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(294,'like','like','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(295,'link','link','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(296,'core','log_adapter','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(300,'core','mail_template','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(301,'marketplace','marketplace_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(302,'undefined','messages','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(303,'undefined','notification','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(304,'undefined','notification_setting','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(305,'undefined','notification_type','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(306,'pages','pages','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(307,'pages','pages_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(308,'pages','pages_member','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(309,'pages','pages_member_item','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(310,'pages','pages_member_list','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(311,'pages','pages_member_request','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(312,'photo','photo','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(313,'photo','photo_album','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(314,'photo','photo_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(315,'poll','poll_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(316,'undefined','privacy','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(317,'quiz','quiz_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(320,'report','report_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(321,'report','report_item','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(322,'undefined','request','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(323,'undefined','request_setting','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(324,'undefined','request_type','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(325,'core','session','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(328,'core','site_setting_value','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(329,'core','storage_adapter','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(331,'core','storage_file','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(332,'undefined','subject','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(333,'user','user','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(334,'user','user_verify_token','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(335,'video','video','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(336,'video','video_category','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(337,'video','video_channel','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(338,'video','video_provider','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(339,'core','acl_perm_allow','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(340,'core','acl_role','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(341,'core','acl_setting_action','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(342,'core','acl_setting_group','admin_filter','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(343,'core','acl_setting_value','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(344,'undefined','activity_action','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(345,'undefined','activity_hide','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(346,'undefined','activity_setting','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(347,'undefined','activity_stream','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(348,'undefined','activity_type','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(349,'undefined','activity_wall','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(350,'announcement','announcement','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(351,'announcement','announcement_exclude','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(353,'user','auth_history','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(354,'user','auth_log','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(355,'user','auth_password','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(356,'user','auth_remote','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(357,'user','auth_token','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(358,'blog','blog_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(359,'blog','blog_post','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(362,'undefined','comment','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(363,'contact','contact_department','admin_filter','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(364,'core','core_event','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(366,'core','core_job_log','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(367,'core','core_job_message','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(368,'core','core_log','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(369,'core','core_menu','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(370,'core','core_package','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(371,'core','core_permission','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(373,'event','event','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(374,'event','event_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(375,'event','event_member','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(376,'event','event_member_item','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(377,'event','event_member_list','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(378,'event','event_member_request','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(379,'friend','friend','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(380,'friend','friend_forward','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(381,'friend','friend_item','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(382,'friend','friend_list','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(383,'friend','friend_request','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(384,'group','group','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(385,'group','group_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(386,'group','group_member','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(387,'group','group_member_item','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(388,'group','group_member_list','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(389,'group','group_member_request','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(390,'core','i18n_currency','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(391,'core','i18n_locale','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(392,'core','i18n_message','admin_filter','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(393,'core','i18n_timezone','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(394,'invite','invite','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(395,'core','layout_action','admin_filter','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(396,'core','layout_block','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(397,'core','layout_component','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(398,'core','layout_container','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(399,'core','layout_grid','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(400,'core','layout_location','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(401,'core','layout_page','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(402,'core','layout_theme','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(403,'core','layout_theme_params','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(404,'like','like','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(405,'link','link','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(406,'core','log_adapter','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(410,'core','mail_template','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(411,'marketplace','marketplace_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(412,'undefined','messages','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(413,'undefined','notification','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(414,'undefined','notification_setting','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(415,'undefined','notification_type','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(416,'pages','pages','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(417,'pages','pages_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(418,'pages','pages_member','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(419,'pages','pages_member_item','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(420,'pages','pages_member_list','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(421,'pages','pages_member_request','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(422,'photo','photo','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(423,'photo','photo_album','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(424,'photo','photo_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(425,'poll','poll_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(426,'undefined','privacy','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(427,'quiz','quiz_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(430,'report','report_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(431,'report','report_item','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(432,'undefined','request','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(433,'undefined','request_setting','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(434,'undefined','request_type','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(435,'core','session','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(438,'core','site_setting_value','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(439,'core','storage_adapter','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(441,'core','storage_file','admin_filter','delete',NULL,NULL,NULL,NULL,NULL,NULL),
	(442,'undefined','subject','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(443,'user','user','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(444,'user','user_verify_token','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(445,'video','video','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(446,'video','video_category','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(447,'video','video_channel','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(448,'video','video_provider','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(570,'dev','dev_action','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(571,'dev','dev_element','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(572,'dev','dev_table','admin_add','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(573,'dev','dev_action','admin_edit','create','_dev.edit_action','Edit Dev Action','',NULL,NULL,NULL),
	(574,'dev','dev_element','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(575,'dev','dev_table','admin_edit','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(576,'dev','dev_action','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(577,'dev','dev_element','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(578,'dev','dev_table','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(579,'dev','dev_action','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(580,'dev','dev_element','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(581,'dev','dev_table','admin_filter','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(621,'core','core_driver','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(622,'core','core_driver','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(623,'core','core_driver','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(624,'core','core_driver','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(626,'core','core_adapter','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(628,'core','core_adapter','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(630,'core','core_adapter','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(632,'core','core_adapter','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(637,'core','site_setting_form','admin_add','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(638,'core','site_setting_form','admin_edit','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(639,'core','site_setting_form','admin_delete','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(640,'core','site_setting_form','admin_filter','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(662,'blog','blog','admin_site_settings','skip','admin.blog_setting',NULL,NULL,NULL,NULL,NULL),
	(663,'core','core','admin_site_settings','create','admin.core_setting',NULL,NULL,NULL,NULL,NULL),
	(664,'core','core_cache','admin_site_settings','skip','admin.core_cache_setting',NULL,NULL,NULL,NULL,NULL),
	(665,'core','core_captcha','admin_site_settings','create','admin.core_captcha_setting',NULL,NULL,NULL,NULL,NULL),
	(666,'core','core_i18n','admin_site_settings','skip','admin.core_i18n_setting',NULL,NULL,NULL,NULL,NULL),
	(667,'core','core_license','admin_site_settings','create','admin.core_license_setting',NULL,NULL,NULL,NULL,NULL),
	(668,'core','core_log','admin_site_settings','skip','admin.core_log_setting',NULL,NULL,NULL,NULL,NULL),
	(669,'core','core_mail','admin_site_settings','skip','admin.core_mail_setting',NULL,NULL,NULL,NULL,NULL),
	(670,'core','core_seo','admin_site_settings','skip','admin.core_seo_setting',NULL,NULL,NULL,NULL,NULL),
	(671,'core','core_storage','admin_site_settings','skip','admin.core_storage_setting',NULL,NULL,NULL,NULL,NULL),
	(672,'core','core_verify','admin_site_settings','create','admin.core_verify_setting',NULL,NULL,NULL,NULL,NULL),
	(673,'dev','dev','admin_site_settings','skip','admin.dev_setting',NULL,NULL,NULL,NULL,NULL),
	(674,'user','user_login','admin_site_settings','skip','admin.user_login_setting',NULL,NULL,NULL,NULL,NULL),
	(675,'user','user_register','admin_site_settings','skip','admin.user_register_setting',NULL,NULL,NULL,NULL,NULL),
	(676,'core','core','admin_acl_settings','create','admin.core_acl',NULL,NULL,NULL,NULL,NULL),
	(677,'core','core_session','admin_site_settings','create','admin.core_session_setting',NULL,NULL,NULL,NULL,NULL),
	(679,'core','core_message','admin_site_settings','create','admin.core_message_setting',NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `pf5_dev_form` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_dev_model
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_dev_model`;

CREATE TABLE `pf5_dev_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_type` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_id` enum('default','skip','delete','create') COLLATE utf8_unicode_ci DEFAULT 'skip',
  `text_domain` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_info` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_submit` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancel_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'c',
  `action_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `table_name` (`table_name`,`action_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_dev_model` WRITE;
/*!40000 ALTER TABLE `pf5_dev_model` DISABLE KEYS */;

INSERT INTO `pf5_dev_model` (`id`, `package_id`, `table_name`, `action_type`, `action_id`, `text_domain`, `form_title`, `form_info`, `data_submit`, `cancel_url`, `action_url`)
VALUES
	(449,'core','acl_perm_allow','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(450,'core','acl_role','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(451,'core','acl_setting_action','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(452,'core','acl_setting_group','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(453,'core','acl_setting_value','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(456,'core','core_event','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(458,'core','core_job_log','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(459,'core','core_job_message','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(460,'core','core_log','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(461,'core','core_menu','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(462,'core','core_package','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(463,'core','core_permission','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(465,'core','i18n_currency','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(466,'core','i18n_locale','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(467,'core','i18n_message','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(468,'core','i18n_timezone','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(469,'core','log_adapter','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(473,'core','mail_template','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(475,'core','site_setting_value','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(476,'core','storage_adapter','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(478,'core','storage_file','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(487,'undefined','activity_action','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(488,'undefined','activity_hide','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(489,'undefined','activity_setting','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(490,'undefined','activity_stream','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(491,'undefined','activity_type','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(492,'undefined','activity_wall','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(493,'announcement','announcement','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(494,'announcement','announcement_exclude','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(496,'user','auth_history','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(497,'user','auth_log','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(498,'user','auth_password','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(499,'user','auth_remote','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(500,'user','auth_token','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(501,'blog','blog_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(502,'blog','blog_post','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(503,'undefined','comment','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(504,'contact','contact_department','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(507,'event','event','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(508,'event','event_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(509,'event','event_member','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(510,'event','event_member_item','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(511,'event','event_member_list','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(512,'event','event_member_request','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(513,'friend','friend','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(514,'friend','friend_forward','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(515,'friend','friend_item','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(516,'friend','friend_list','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(517,'friend','friend_request','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(518,'group','group','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(519,'group','group_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(520,'group','group_member','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(521,'group','group_member_item','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(522,'group','group_member_list','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(523,'group','group_member_request','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(524,'invite','invite','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(525,'core','layout_action','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(526,'core','layout_block','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(527,'core','layout_component','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(528,'core','layout_container','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(529,'core','layout_grid','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(530,'core','layout_location','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(531,'core','layout_page','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(532,'core','layout_theme','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(533,'core','layout_theme_params','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(534,'like','like','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(535,'link','link','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(536,'marketplace','marketplace_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(537,'undefined','messages','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(538,'undefined','notification','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(539,'undefined','notification_setting','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(540,'undefined','notification_type','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(541,'pages','pages','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(542,'pages','pages_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(543,'pages','pages_member','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(544,'pages','pages_member_item','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(545,'pages','pages_member_list','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(546,'pages','pages_member_request','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(547,'photo','photo','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(548,'photo','photo_album','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(549,'photo','photo_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(550,'poll','poll_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(551,'undefined','privacy','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(552,'quiz','quiz_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(553,'report','report_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(554,'report','report_item','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(555,'undefined','request','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(556,'undefined','request_setting','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(557,'undefined','request_type','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(558,'core','session','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(560,'undefined','subject','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(561,'user','user','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(562,'user','user_verify_token','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(563,'video','video','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(564,'video','video_category','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(565,'video','video_channel','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(566,'video','video_provider','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(582,'dev','dev_action','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(583,'dev','dev_element','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(584,'dev','dev_table','model_class','skip',NULL,NULL,NULL,NULL,NULL,NULL),
	(625,'core','core_driver','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(634,'core','core_adapter','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL),
	(641,'core','site_setting_form','model_class','create',NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `pf5_dev_model` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_dev_table
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_dev_table`;

CREATE TABLE `pf5_dev_table` (
  `table_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `package_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'undefined',
  `action_id` enum('skip','default','delete','refresh') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default',
  PRIMARY KEY (`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_dev_table` WRITE;
/*!40000 ALTER TABLE `pf5_dev_table` DISABLE KEYS */;

INSERT INTO `pf5_dev_table` (`table_name`, `package_id`, `action_id`)
VALUES
	('acl_action','core','default'),
	('acl_form','core','default'),
	('acl_level','core','default'),
	('acl_value','core','default'),
	('activity_action','undefined','default'),
	('activity_hide','undefined','default'),
	('activity_setting','undefined','default'),
	('activity_stream','undefined','default'),
	('activity_type','undefined','default'),
	('activity_wall','undefined','default'),
	('announcement','announcement','default'),
	('announcement_exclude','announcement','default'),
	('auth_history','user','default'),
	('auth_log','user','default'),
	('auth_password','user','default'),
	('auth_remote','user','default'),
	('auth_token','user','default'),
	('blog_category','blog','default'),
	('blog_post','blog','default'),
	('comment','undefined','default'),
	('contact_department','contact','default'),
	('core_adapter','core','default'),
	('core_driver','core','default'),
	('core_event','core','default'),
	('core_job_log','core','default'),
	('core_job_message','core','default'),
	('core_log','core','default'),
	('core_menu','core','default'),
	('core_package','core','default'),
	('core_permission','core','default'),
	('dev_action','dev','default'),
	('dev_element','dev','default'),
	('dev_form','dev','default'),
	('dev_model','dev','default'),
	('dev_table','dev','default'),
	('event','event','default'),
	('event_category','event','default'),
	('event_member','event','default'),
	('event_member_item','event','default'),
	('event_member_list','event','default'),
	('event_member_request','event','default'),
	('friend','friend','default'),
	('friend_forward','friend','default'),
	('friend_item','friend','default'),
	('friend_list','friend','default'),
	('friend_request','friend','default'),
	('group','group','default'),
	('group_category','group','default'),
	('group_member','group','default'),
	('group_member_item','group','default'),
	('group_member_list','group','default'),
	('group_member_request','group','default'),
	('i18n_currency','core','default'),
	('i18n_locale','core','default'),
	('i18n_message','core','default'),
	('i18n_timezone','core','default'),
	('invite','invite','default'),
	('layout_action','core','default'),
	('layout_block','core','default'),
	('layout_component','core','default'),
	('layout_container','core','default'),
	('layout_grid','core','default'),
	('layout_location','core','default'),
	('layout_page','core','default'),
	('layout_theme','core','default'),
	('layout_theme_params','core','default'),
	('like','like','default'),
	('link','link','default'),
	('log_adapter','core','default'),
	('mail_template','core','default'),
	('marketplace_category','marketplace','default'),
	('messages','undefined','default'),
	('notification','undefined','default'),
	('notification_setting','undefined','default'),
	('notification_type','undefined','default'),
	('pages','pages','default'),
	('pages_category','pages','default'),
	('pages_member','pages','default'),
	('pages_member_item','pages','default'),
	('pages_member_list','pages','default'),
	('pages_member_request','pages','default'),
	('photo','photo','default'),
	('photo_album','photo','default'),
	('photo_category','photo','default'),
	('poll_category','poll','default'),
	('privacy','undefined','default'),
	('quiz_category','quiz','default'),
	('report_category','report','default'),
	('report_item','report','default'),
	('request','undefined','default'),
	('request_setting','undefined','default'),
	('request_type','undefined','default'),
	('session','core','default'),
	('setting_form','core','default'),
	('setting_value','core','default'),
	('storage_adapter','core','default'),
	('storage_file','core','default'),
	('subject','undefined','default'),
	('user','user','default'),
	('user_verify_token','user','default'),
	('video','video','default'),
	('video_category','video','default'),
	('video_channel','video','default'),
	('video_provider','video','default');

/*!40000 ALTER TABLE `pf5_dev_table` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_event`;

CREATE TABLE `pf5_event` (
  `event_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_featured` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_sponsor` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `privacy_id` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `poster_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `location_id` int(11) NOT NULL DEFAULT '0',
  `photo_id` int(11) unsigned NOT NULL DEFAULT '0',
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `title` tinytext NOT NULL,
  `poster_type` varchar(50) DEFAULT NULL,
  `parent_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pf5_event` WRITE;
/*!40000 ALTER TABLE `pf5_event` DISABLE KEYS */;

INSERT INTO `pf5_event` (`event_id`, `is_featured`, `is_sponsor`, `privacy_id`, `parent_id`, `poster_id`, `user_id`, `location_id`, `photo_id`, `start_at`, `end_at`, `created_at`, `title`, `poster_type`, `parent_type`)
VALUES
	(34,1,0,1,33,22,99,33,17,'2014-12-11 00:11:44','2014-12-12 00:11:44','2013-12-11 00:11:44','exmple value test','user','pages');

/*!40000 ALTER TABLE `pf5_event` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_event_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_event_category`;

CREATE TABLE `pf5_event_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_event_category` WRITE;
/*!40000 ALTER TABLE `pf5_event_category` DISABLE KEYS */;

INSERT INTO `pf5_event_category` (`category_id`, `is_active`, `name`, `description`)
VALUES
	(12,1,'[example name]','[description]');

/*!40000 ALTER TABLE `pf5_event_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_event_member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_event_member`;

CREATE TABLE `pf5_event_member` (
  `parent_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`parent_id`,`user_id`),
  KEY `REVERSE` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_event_member_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_event_member_item`;

CREATE TABLE `pf5_event_member_item` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_event_member_list
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_event_member_list`;

CREATE TABLE `pf5_event_member_list` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL,
  `type_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `member_count` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_event_member_request
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_event_member_request`;

CREATE TABLE `pf5_event_member_request` (
  `parent_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `status_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`parent_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_friend
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_friend`;

CREATE TABLE `pf5_friend` (
  `user_id` int(11) unsigned NOT NULL,
  `friend_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_friend` WRITE;
/*!40000 ALTER TABLE `pf5_friend` DISABLE KEYS */;

INSERT INTO `pf5_friend` (`user_id`, `friend_id`)
VALUES
	(1,0);

/*!40000 ALTER TABLE `pf5_friend` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_friend_forward
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_friend_forward`;

CREATE TABLE `pf5_friend_forward` (
  `user_id` int(11) unsigned NOT NULL,
  `friend_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_friend_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_friend_item`;

CREATE TABLE `pf5_friend_item` (
  `list_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`list_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_friend_list
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_friend_list`;

CREATE TABLE `pf5_friend_list` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL,
  `type_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_friend_request
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_friend_request`;

CREATE TABLE `pf5_friend_request` (
  `parent_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `status_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`parent_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_group`;

CREATE TABLE `pf5_group` (
  `group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `title` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) unsigned NOT NULL DEFAULT '0',
  `location_id` int(10) unsigned NOT NULL,
  `invite_id` tinyint(1) NOT NULL DEFAULT '1',
  `is_approval` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_sponsor` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `parent_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `photo_id` int(11) unsigned NOT NULL DEFAULT '0',
  `cover_id` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `member_count` smallint(6) unsigned NOT NULL,
  `view_count` int(11) unsigned NOT NULL DEFAULT '0',
  `poster_id` int(11) unsigned NOT NULL DEFAULT '0',
  `poster_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_group_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_group_category`;

CREATE TABLE `pf5_group_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_group_category` WRITE;
/*!40000 ALTER TABLE `pf5_group_category` DISABLE KEYS */;

INSERT INTO `pf5_group_category` (`category_id`, `is_active`, `name`, `description`)
VALUES
	(12,1,'[example name]','[description]');

/*!40000 ALTER TABLE `pf5_group_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_group_member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_group_member`;

CREATE TABLE `pf5_group_member` (
  `parent_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`parent_id`,`user_id`),
  KEY `REVERSE` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_group_member_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_group_member_item`;

CREATE TABLE `pf5_group_member_item` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_group_member_list
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_group_member_list`;

CREATE TABLE `pf5_group_member_list` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL,
  `type_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `member_count` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_group_member_request
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_group_member_request`;

CREATE TABLE `pf5_group_member_request` (
  `parent_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `status_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`parent_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_i18n_currency
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_i18n_currency`;

CREATE TABLE `pf5_i18n_currency` (
  `currency_id` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `symbol` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ordering` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `currency_id` (`currency_id`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_i18n_currency` WRITE;
/*!40000 ALTER TABLE `pf5_i18n_currency` DISABLE KEYS */;

INSERT INTO `pf5_i18n_currency` (`currency_id`, `symbol`, `name`, `ordering`, `is_active`, `is_default`)
VALUES
	('GBP','£','Pound',3,1,0),
	('USD','$','US Dollar',1,1,0);

/*!40000 ALTER TABLE `pf5_i18n_currency` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_i18n_locale
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_i18n_locale`;

CREATE TABLE `pf5_i18n_locale` (
  `locale_id` varchar(16) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `name` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `native_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_6391` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `direction_id` enum('ltr','rtl') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'ltr',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`locale_id`),
  KEY `title` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_i18n_locale` WRITE;
/*!40000 ALTER TABLE `pf5_i18n_locale` DISABLE KEYS */;

INSERT INTO `pf5_i18n_locale` (`locale_id`, `name`, `native_name`, `code_6391`, `direction_id`, `is_active`, `is_default`)
VALUES
	('vi','Vietnameses','Tiếng Việt','vi',X'72746C',1,0);

/*!40000 ALTER TABLE `pf5_i18n_locale` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_i18n_message
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_i18n_message`;

CREATE TABLE `pf5_i18n_message` (
  `message_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'core',
  `locale_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `domain_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `message_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `message_value` mediumtext COLLATE utf8_unicode_ci,
  `is_json` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_updated` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`),
  UNIQUE KEY `locale_id` (`locale_id`,`domain_id`,`message_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_i18n_message` WRITE;
/*!40000 ALTER TABLE `pf5_i18n_message` DISABLE KEYS */;

INSERT INTO `pf5_i18n_message` (`message_id`, `package_id`, `locale_id`, `domain_id`, `message_name`, `message_value`, `is_json`, `is_updated`)
VALUES
	(1,'core','','admin','[storage quota note]','How much content (photos, songs, videos, etc.) do you want each member to be able to upload? This limit only applies to uploaded content, not things that are linked or embedded from other websites.',0,0),
	(2,'core','','admin','[allow blocking note]','If set to \"yes\", members can block other members from sending them private messages, requesting their friendship, and viewing their profile. This helps fight spam and network abuse.',0,0),
	(4,'core','','admin','[network offline]','\"Offline\" will prevent site visitors from accessing your network.',0,0),
	(6,'core','','admin','[google analytics id]','Enter the Website Profile ID to use Google Analytics.',0,0),
	(7,'core','','','Yes','Yes',0,0),
	(8,'core','','','No','No',0,0),
	(9,'core','','admin','Layout Editor {0}','Layout Editor - Editing Theme <strong class=\"uppercase\">{0}</strong>',0,0),
	(21,'core','','_core','[Edit Site Settings Info]','These settings are applied to your entire site and its members. ',0,0),
	(23,'core','','core_site','[Default Timezone Note]','Please select a default timezone setting for your social network. This will be the default timezone applied to users\' accounts if they do not select a timezone during signup, or if they are not signed in. ',0,0),
	(24,'core','','core_site','[Default Locale Note]','Select the default locale you want to use on your social network. This will affect the language of the dates that appear on your social network pages.',0,0),
	(25,'core','','admin.i18n','Edit I18n Timezone','Edit Timezone Settings',0,0),
	(26,'core','','admin.i18n','[Edit I18n Timezone Info]','<p class=\"alert alert-warning\">Warning: please ensure you have knowlegebase about php timezone, incorrect settings can make system down.</p>',0,0),
	(27,'core','','admin.core_storage','[Amazon Budget Note]','If the bucket does not exist, we will attempt to create it. Please note the following restrictions on bucket names:<br/>\n-Must start and end with a number or letter<br/>\n-Must only contain lowercase letters, numbers, and dashes [a-z0-9-]<br/>\n-Must be between 3 and 255 characters long',0,0),
	(28,'core','','admin.core_acl','[Access Admin Info]','Has general access to the Admin Control Panel. \nBest to allow on Admins and Staff for security.\n',0,0),
	(29,'core','','admin.core_acl','[Manage Package Info]','Can enable, disable apps',0,0),
	(30,'core','','admin.core_acl','[Clear Cache Info]','Can clear cache entries',0,0),
	(31,'core','','admin.core_acl','[Install Package Info]','[Install Package Info]',0,0),
	(88,'core','','admin.core_acl','Clear Cache','Clear Cache',0,0),
	(89,'core','','admin.core_acl','Manage Package','Manage Package',0,0),
	(90,'core','','admin.core_acl','Install Package','Install Package',0,0),
	(91,'core','','admin.core_acl','Access Admin','Access Admin',0,0),
	(92,'core','','admin.core_acl','Manage Layout','Manage Layout',0,0),
	(93,'core','','admin.core_acl','[Manage Layout Info]','Allows user clear site log data',0,0),
	(94,'core','','admin.core_acl','Manage Site Setting','Manage Site Setting',0,0),
	(95,'core','','admin.core_acl','[Manage Site Setting Info]','[Manage Site Setting Info]',0,0),
	(96,'core','','admin.core_acl','Manage Acl Setting','Manage Acl Setting',0,0),
	(97,'core','','admin.core_acl','[Manage Acl Setting Info]','Allow users edit user group settings.',0,0),
	(98,'core','','admin.core_acl','Moderate Content','Moderate Content',0,0),
	(99,'core','','admin.core_acl','[Moderate Content Info]','[Moderate Content Info]',0,0),
	(100,'core','','admin.core_acl','Manage Cache','Manage Cache',0,0),
	(101,'core','','admin.core_acl','[Manage Cache Info]','Allow users manage cache setttings.',0,0),
	(102,'core','','admin.core_acl','Clear Log','Clear Log',0,0),
	(103,'core','','admin.core_acl','[Clear Log Info]','Allow users clear log data',0,0),
	(104,'core','','admin.core_acl','Manage Log','Manage Log',0,0),
	(105,'core','','admin.core_acl','[Manage Log Info]','Allow users manage log settings',0,0),
	(106,'core','','admin.core_acl','Manage Admin','Manage Admin',0,0),
	(107,'core','','admin.core_acl','[Manage Admin Info]','Allows users edit admin account information.',0,0),
	(108,'core','','admin.core_acl','Manage Theme','Manage Theme',0,0),
	(109,'core','','admin.core_acl','[Manage Theme Info]','[Manage Theme Info]',0,0),
	(110,'core','','admin.core_acl','Manage Acl Role','Manage Acl Role',0,0),
	(112,'core','','admin.core_acl','[Manage Acl Role Info]','[Manage Acl Role Info]',0,0),
	(113,'core','','','Keywords','Keywords',0,0),
	(114,'core','','','Group Id','Group Id',0,0),
	(115,'core','','','Package Id','Package Id',0,0),
	(116,'core','','admin.core_setting','2 Step Verify','2 Step Verify',0,0),
	(117,'core','','admin.core_setting','[2 Step Verify Info]','[2 Step Verify Info]',0,0),
	(118,'core','','admin.core_setting','Allow Html','Allow Html',0,0),
	(119,'core','','admin.core_setting','[Allow Html Info]','[Allow Html Info]',0,0),
	(120,'core','','admin.core_setting','Allow Html Tags','Allow Html Tags',0,0),
	(121,'core','','admin.core_setting','[Allow Html Tags Info]','[Allow Html Tags Info]',0,0),
	(122,'core','','admin.core_setting','Cookie Domain','Cookie Domain',0,0),
	(123,'core','','admin.core_setting','[Cookie Domain Info]','[Cookie Domain Info]',0,0),
	(124,'core','','admin.core_setting','Cookie Path','Cookie Path',0,0),
	(125,'core','','admin.core_setting','[Cookie Path Info]','[Cookie Path Info]',0,0),
	(126,'core','','admin.core_setting','Cookie Prefix','Cookie Prefix',0,0),
	(127,'core','','admin.core_setting','[Cookie Prefix Info]','[Cookie Prefix Info]',0,0),
	(128,'core','','admin.core_setting','Default Cache Id','Default Cache Id',0,0),
	(129,'core','','admin.core_setting','[Default Cache Id Info]','[Default Cache Id Info]',0,0),
	(130,'core','','admin.core_setting','Default Currency Id','Default Currency Id',0,0),
	(131,'core','','admin.core_setting','[Default Currency Id Info]','[Default Currency Id Info]',0,0),
	(132,'core','','admin.core_setting','Default Locale Id','Default Locale Id',0,0),
	(133,'core','','admin.core_setting','[Default Locale Id Info]','[Default Locale Id Info]',0,0),
	(134,'core','','admin.core_setting','Default Mailer Id','Default Mailer Id',0,0),
	(135,'core','','admin.core_setting','[Default Mailer Id Info]','[Default Mailer Id Info]',0,0),
	(136,'core','','admin.core_setting','Default Storage Id','Default Storage Id',0,0),
	(137,'core','','admin.core_setting','[Default Storage Id Info]','[Default Storage Id Info]',0,0),
	(138,'core','','admin.core_setting','Default Timezone Id','Default Timezone Id',0,0),
	(139,'core','','admin.core_setting','[Default Timezone Id Info]','[Default Timezone Id Info]',0,0),
	(140,'core','','admin.core_setting','Full Ajax Mode','Full Ajax Mode',0,0),
	(141,'core','','admin.core_setting','[Full Ajax Mode Info]','[Full Ajax Mode Info]',0,0),
	(142,'core','','admin.core_setting','Offline Code','Offline Code',0,0),
	(144,'core','','admin.core_setting','Private Network','Private Network',0,0),
	(145,'core','','admin.core_setting','[Private Network Info]','[Private Network Info]',0,0),
	(146,'core','','admin.core_setting','Secure Image Enable','Secure Image Enable',0,0),
	(147,'core','','admin.core_setting','[Secure Image Enable Info]','[Secure Image Enable Info]',0,0),
	(148,'core','','admin.core_setting','Site Offline','Site Offline',0,0),
	(149,'core','','admin.core_setting','[Site Offline Info]','[Site Offline Info]',0,0),
	(160,'core','','_core.recaptcha','[ReCaptcha Settings Info]','<small><a rel=\"nofollow\" href=\"https://www.google.com/recaptcha/\" target=\"_blank\">reCAPTCHA</a> is a free service that protects your website from spam and abuse. <a rel=\"nofollow\" href=\"https://www.google.com/recaptcha/\" target=\"_blank\">reCAPTCHA</a> uses an advanced risk analysis engine and adaptive <a rel=\"nofollow\" href=\"https://www.google.com/recaptcha/\" target=\"_blank\">reCAPTCHA</a> to keep automated software from engaging in abusive activities on your site. It does this while letting your valid users pass through with ease.</small>',0,0),
	(171,'core','','admin.core_verify_setting','Default Verify','Default Verify',0,0),
	(172,'core','','admin.core_verify_setting','[Default Verify Id Info]','[Default Verify Id Info]',0,0),
	(173,'core','','admin.core_license_setting','License Key','License Key',0,0),
	(174,'core','','admin.core_license_setting','[License Key Info]','[License Key Info]',0,0),
	(175,'core','','admin.core_license_setting','License Email','License Email',0,0),
	(176,'core','','admin.core_license_setting','[License Email Info]','[License Email Info]',0,0),
	(177,'core','','admin.core_license_setting','License Package','License Package',0,0),
	(178,'core','','admin.core_license_setting','[License Package Info]','[License Package Info]',0,0),
	(181,'core','','_core.session','[Redis Port Info]','Server port default \"6379\"',0,0),
	(182,'core','','_core.session','[Redis Password]','Redis connection password, required if you set password on redis server, default empty.',0,0),
	(183,'core','','_core.session','[Redis Host Info]','Redis host, ip adress or domain name, example \"127.0.0.1\" or \"localhost\"',0,0),
	(184,'core','','_core.session','[Memcache Port Info]','Server port default \"11211\"',0,0),
	(185,'core','','_core.session','[Memcache Host Info]','Redis host, ip adress or domain name, example \"127.0.0.1\" or \"localhost\"',0,0),
	(186,'core','','_core.session','Cookie Path','Cookie Path',0,0),
	(187,'core','','_core.session','[Cookie Path Info]','This value is applied to php setting `session.cookie_path`.\nSpecifies path to set in the session cookie. Defaults to /.',0,0),
	(188,'core','','_core.session','Cookie Domain','Cookie Domain',0,0),
	(189,'core','','_core.session','[Cookie Domain Info]','This value is applied to php setting `session.cookie_domain`.',0,0),
	(190,'core','','_core.session','Http Only','Cookie HttpOnly',0,0),
	(191,'core','','_core.session','[Http Only Info]','This value is applied to php setting `session.cookie_httponly`.\nMarks the cookie as accessible only through the HTTP protocol. This means that the cookie won\'t be accessible by scripting languages, such as JavaScript. This setting can effectively help to reduce identity theft through XSS attacks (although it is not supported by all browsers).',0,0),
	(192,'contact','','','Is Default','Is Default',0,0),
	(193,'contact','','','[Is Default Info]','[Is Default Info]',0,0),
	(194,'dev','','','Meta Id','Meta Id',0,0),
	(195,'dev','','','[Meta Id Info]','[Meta Id Info]',0,0),
	(196,'dev','','','[Package Id Info]','[Package Id Info]',0,0),
	(197,'dev','','','Table Name','Table Name',0,0),
	(198,'dev','','','[Table Name Info]','[Table Name Info]',0,0),
	(199,'dev','','','Action Type','Action Type',0,0),
	(200,'dev','','','[Action Type Info]','[Action Type Info]',0,0),
	(201,'dev','','','Action Id','Action Id',0,0),
	(202,'dev','','','[Action Id Info]','[Action Id Info]',0,0),
	(203,'dev','','','Text Domain','Text Domain',0,0),
	(204,'dev','','','[Text Domain Info]','[Text Domain Info]',0,0),
	(205,'dev','','','Form Title','Form Title',0,0),
	(206,'dev','','','[Form Title Info]','[Form Title Info]',0,0),
	(207,'dev','','','Form Info','Form Info',0,0),
	(208,'dev','','','[Form Info Info]','[Form Info Info]',0,0),
	(209,'dev','','_dev.edit_action','Form Title','Form Title',0,0),
	(210,'dev','','_dev.edit_action','Form Info','Form Info',0,0),
	(211,'dev','','_dev.edit_action','Text Domain','Text Domain',0,0),
	(212,'dev','','_dev.edit_action','Data Submit','Data Submit',0,0),
	(213,'dev','','_dev.edit_action','[Data Submit Info]','[Data Submit Info]',0,0),
	(214,'dev','','_dev.edit_action','Cancel Url','Cancel Url',0,0),
	(215,'dev','','_dev.edit_action','[Cancel Url Info]','[Cancel Url Info]',0,0),
	(216,'dev','','_dev.edit_action','Action Url','Action Url',0,0),
	(217,'dev','','_dev.edit_action','[Action Url Info]','[Action Url Info]',0,0),
	(218,'dev','','','Package','Package',0,0),
	(219,'dev','','','Action','Action',0,0),
	(220,'dev','','_core.package','summary_packages_message','Total <strong>{0}</strong> installed packages, <strong>{1}</strong> packages are enable',0,0),
	(222,'core','','','currency_format','{0} #,###.00',0,0),
	(223,'core','','','number_format','#,###.00',0,0),
	(224,'contact','','','Name','Name',0,0),
	(225,'contact','','','[Name Info]','[Name Info]',0,0),
	(226,'contact','','','Email','Email',0,0),
	(227,'contact','','','[Email Info]','[Email Info]',0,0),
	(228,'contact','','','Description','Description',0,0),
	(229,'contact','','','[Description Info]','[Description Info]',0,0),
	(230,'contact','','','Is Active','Is Active',0,0),
	(231,'contact','','','[Is Active Info]','[Is Active Info]',0,0),
	(232,'core','','','Currency Id','Currency Id',0,0),
	(233,'core','','','[Currency Id Info]','[Currency Id Info]',0,0),
	(234,'core','','','Symbol','Symbol',0,0),
	(235,'core','','','[Symbol Info]','[Symbol Info]',0,0),
	(236,'core','','','Sort Order','Sort Order',0,0),
	(237,'core','','','[Sort Order Info]','[Sort Order Info]',0,0),
	(238,'core','','','Locale Id','Locale Id',0,0),
	(239,'core','','','[Locale Id Info]','[Locale Id Info]',0,0),
	(240,'core','','','Native Name','Native Name',0,0),
	(241,'core','','','[Native Name Info]','[Native Name Info]',0,0),
	(242,'core','','','Code 6391','Code 6391',0,0),
	(243,'core','','','[Code 6391 Info]','[Code 6391 Info]',0,0),
	(244,'core','','','Direction Id','Direction Id',0,0),
	(245,'core','','','[Direction Id Info]','[Direction Id Info]',0,0),
	(246,'core','','','Message Id','Message Id',0,0),
	(247,'core','','','[Message Id Info]','[Message Id Info]',0,0),
	(248,'core','','','Domain Id','Domain Id',0,0),
	(249,'core','','','[Domain Id Info]','[Domain Id Info]',0,0),
	(250,'core','','','Message Name','Message Name',0,0),
	(251,'core','','','[Message Name Info]','[Message Name Info]',0,0),
	(252,'core','','','Message Value','Message Value',0,0),
	(253,'core','','','[Message Value Info]','[Message Value Info]',0,0),
	(254,'core','','','Timezone Id','Timezone Id',0,0),
	(255,'core','','','[Timezone Id Info]','[Timezone Id Info]',0,0),
	(256,'core','','','Timezone Location','Timezone Location',0,0),
	(257,'core','','','[Timezone Location Info]','[Timezone Location Info]',0,0),
	(258,'core','','','Timezone Code','Timezone Code',0,0),
	(259,'core','','','[Timezone Code Info]','[Timezone Code Info]',0,0),
	(260,'core','','','Timezone Offset','Timezone Offset',0,0),
	(261,'core','','','[Timezone Offset Info]','[Timezone Offset Info]',0,0),
	(266,'core','','_core.seo_settings','Site Title','Site Title',0,0),
	(267,'core','','_core.seo_settings','[Site Title Info]','Give your site a unique name. This will appear in the &lt;title&gt; tag throughout most of your site.',0,0),
	(268,'core','','_core.seo_settings','Title Separator','Site Title Separator',0,0),
	(269,'core','','_core.seo_settings','[Title Separator Info]','Separate site title when it contain multiple partial.',0,0),
	(270,'core','','_core.seo_settings','Site Description','Site Description',0,0),
	(271,'core','','_core.seo_settings','[Site Description Info]','Search engines show the meta description in search results mostly when the searched for phrase is contained in the description. Optimizing the meta description is a very important aspect of on-page SEO. <br/>\nGive your site a description, It should include any key words or phrases that you want to appear in search engine listings.',0,0),
	(272,'core','','_core.seo_settings','Description Limit','Description Limit',0,0),
	(273,'core','','_core.seo_settings','[Description Limit Info]','',0,0),
	(274,'core','','_core.seo_settings','Site Keyword','Site Keyword',0,0),
	(275,'core','','_core.seo_settings','[Site Keyword Info]','A series of keywords you deem relevant to the your site content.',0,0),
	(276,'core','','_core.seo_settings','Keyword Limit','Keyword Limit',0,0),
	(277,'core','','_core.seo_settings','[Keyword Limit Info]','',0,0),
	(278,'core','','_core.seo_settings','Enable Facebook','Enable Facebook',0,0),
	(279,'core','','_core.seo_settings','[Enable Facebook Info]','[Enable Facebook Info]',0,0),
	(280,'core','','_core.seo_settings','Facebook App','Facebook App',0,0),
	(281,'core','','_core.seo_settings','[Facebook App Id Info]','[Facebook App Id Info]',0,0),
	(282,'core','','_core.seo_settings','Facebook App Secret','Facebook App Secret',0,0),
	(283,'core','','_core.seo_settings','[Facebook App Secret Info]','[Facebook App Secret Info]',0,0),
	(284,'core','','_core.seo_settings','Facebook App Name','Facebook App Name',0,0),
	(285,'core','','_core.seo_settings','[Facebook App Name Info]','[Facebook App Name Info]',0,0),
	(286,'core','','_core.seo_settings','Enable Google Plus','Enable Google Plus',0,0),
	(287,'core','','_core.seo_settings','[Enable Google Plus Info]','[Enable Google Plus Info]',0,0),
	(288,'core','','_core.seo_settings','Enable Google Analytic','Enable Google Analytics',0,0),
	(289,'core','','_core.seo_settings','[Enable Google Analytic Info]','Google Analytics is a freemium web analytics service offered by Google that tracks and reports website traffic.',0,0),
	(291,'core','','_core.seo_settings','[Google Analytic Id Info]','',0,0),
	(293,'core','','_core.seo_settings','[Google Plus Id Info]','',0,0),
	(294,'core','','_core.seo_settings','Enable Open Graph','Enable Open Graph',0,0),
	(295,'core','','_core.seo_settings','[Enable Open Graph Info]','The Open Graph is a protocol enables any web page to become a rich object in a social graph. For instance, this is used on Facebook to allow any web page to have the same functionality as any other object on Facebook. It\'s helpful to Social Network describes shared links as epected result.',0,0),
	(296,'core','','_core.seo_settings','Google Plus ID','Google Plus ID',0,0),
	(297,'core','','_core.seo_settings','Google Analytic ID','Google Analytic ID',0,0),
	(299,'core','','_core.general_settings','[Offline Code Info]','Using this key to access your site when  it\'s in `offline` mode.',0,0),
	(300,'core','','_core.general_settings','Running Mode','Running Mode',0,0),
	(302,'core','','_core.general_settings','Bundle Js','Bundle Js',0,0),
	(303,'core','','_core.general_settings','[Bundle Js Info]','Grouping internal file *.js request, it\'s helpful to improve page load time.',0,0),
	(304,'core','','_core.general_settings','Bundle Css','Bundle Css',0,0),
	(305,'core','','_core.general_settings','[Bundle Css Info]','Grouping internal file *.css request, it\'s helpful to improve page load time.',0,0),
	(306,'core','','_core.general_settings','Use Bundle JS','Use Bundle JS',0,0),
	(307,'core','','_core.general_settings','Use Bundle CSS','Use Bundle CSS',0,0),
	(308,'core','','_core.general_settings','Ajax Mode','Ajax Mode',0,0),
	(309,'core','','_core.general_settings','[Ajax Mode Info]','Runing your site under `ajax mode` to improve user experiences and wating to render time.',0,0),
	(310,'core','','_core.general_settings','Force Https','Force Https',0,0),
	(311,'core','','_core.general_settings','[Force Https Info]','Redirect `http` requests to `https`, <span class=\"text-danger\">*</span> please ensure that your site has been supported `https`.',0,0),
	(312,'core','','_core.general_settings','Secure Img','Secure Img',0,0),
	(313,'core','','_core.general_settings','[Secure Img Info]','Protected your site by loading external images via `secure image` scripts. <span class=\"text-danger\">*</span> Enable this option since you have a fast internet network.',0,0),
	(314,'core','','_core.general_settings','Force to Https','Force to Https',0,0),
	(315,'core','','_core.general_settings','Secure Image','Secure Image',0,0),
	(316,'core','','_core.general_settings','Google Api Key','Google Api Key',0,0),
	(317,'core','','_core.general_settings','[Google Api Key Info]','Provide Google Api Key in order to access Google APIs etc maps, places, youtube, ...',0,0),
	(318,'core','','_core.general_settings','[Site Online]','Online',0,0),
	(319,'core','','_core.general_settings','[Site Offline]','Yes, prevent all visitors from accessing your website without private `Offline Code`',0,0),
	(321,'core','','_core.session','Cookie Secure','Cookie Secure',0,0),
	(322,'core','','_core.session','[Cookie Secure Info]','This value is applied to php setting `session.cookie_secure`.\nIf you choose `Yes`, it mean session state does not share when user switch from https to https and vise versa.\nIf your site is not force to https scheme, when user login via http, system append `_http` to orignal name to allow visitor login successful.',0,0),
	(324,'core','','_core.session','Session Save Handler','Session Save Handler',0,0),
	(325,'core','','_core.session','Default Session','Default Session',0,0),
	(326,'core','','_core.session','[Default Session Id Info]','Choose the way your site save session data. if you would like to use customize storage, follow `Manage Session` tab.',0,0),
	(327,'core','','_core.session','Session Name','Session Name',0,0),
	(328,'core','','_core.session','[Session Name Info]','Must contain only alphanumeric characters; it should be less than 24 charaters.\nSpecifies the name of the session which is used as cookie name. It should only contain alphanumeric characters. Defaults to PHPSESSID.\n',0,0),
	(329,'core','','_core','[experience_only]','<span class=\"text-danger\">#</span> Do not changed this value if you don\'t sure the effected.',0,0),
	(331,'core','','_core.session','[experience_only]','[experience_only]',0,0),
	(332,'core','','_core.storage','Default Storage','Default Storage',0,0),
	(333,'core','','_core.storage','[Default Storage Id Info]','[Default Storage Id Info]',0,0),
	(334,'core','','_core.general_settings','Setting Version','Setting Version',0,0),
	(335,'core','','_core.general_settings','[Setting Version Info]','[Setting Version Info]',0,0),
	(336,'core','','_core.general_settings','Static Version','Static Version',0,0),
	(337,'core','','_core.general_settings','[Static Version Info]','[Static Version Info]',0,0),
	(338,'core','','_core.general_settings','Secret Key','Secret Key',0,0),
	(339,'core','','_core.general_settings','[Secret Key Info]','[Secret Key Info]',0,0),
	(340,'core','','_core.general_settings','Private Site','Private Site',0,0),
	(341,'core','','_core.general_settings','[Private Site Info]','Visitors will be blocked in `Login Page` until they login successfully. They also can do a limit of actions as view static page, register, ....',0,0),
	(342,'core','','_core.general_settings','[Private Site Option Yes]','Yes',0,0),
	(343,'core','','_core.general_settings','[Private Site Option No]','No, all visitors can browse your site contents.',0,0),
	(344,'core','','_core.general_settings','Offline Mode','Offline Mode',0,0),
	(345,'user','','admin.user_register_setting','Show Dob','Show Dob',0,0),
	(346,'user','','admin.user_register_setting','[Show Dob Info]','[Show Dob Info]',0,0),
	(347,'user','','admin.user_register_setting','Show Gender','Show Gender',0,0),
	(348,'user','','admin.user_register_setting','[Show Gender Info]','[Show Gender Info]',0,0),
	(349,'user','','admin.user_register_setting','Show Displayname','Show Displayname',0,0),
	(350,'user','','admin.user_register_setting','[Show Displayname Info]','[Show Displayname Info]',0,0),
	(351,'user','','admin.user_register_setting','Show Locale','Show Locale',0,0),
	(352,'user','','admin.user_register_setting','[Show Locale Info]','[Show Locale Info]',0,0),
	(353,'user','','admin.user_register_setting','Show Location','Show Location',0,0),
	(354,'user','','admin.user_register_setting','[Show Location Info]','[Show Location Info]',0,0),
	(355,'user','','admin.user_register_setting','Show Timezone','Show Timezone',0,0),
	(356,'user','','admin.user_register_setting','[Show Timezone Info]','[Show Timezone Info]',0,0),
	(357,'user','','admin.user_register_setting','Show Captcha','Show Captcha',0,0),
	(358,'user','','admin.user_register_setting','[Show Captcha Info]','[Show Captcha Info]',0,0),
	(359,'user','','admin.user_register_setting','Show Username','Show Username',0,0),
	(360,'user','','admin.user_register_setting','[Show Username Info]','[Show Username Info]',0,0),
	(361,'user','','admin.user_register_setting','Show Email','Show Email',0,0),
	(362,'user','','admin.user_register_setting','[Show Email Info]','[Show Email Info]',0,0),
	(363,'user','','admin.user_register_setting','Show Reenter Email','Show Reenter Email',0,0),
	(364,'user','','admin.user_register_setting','[Show Reenter Email Info]','[Show Reenter Email Info]',0,0),
	(365,'user','','admin.user_register_setting','Show Password','Show Password',0,0),
	(366,'user','','admin.user_register_setting','[Show Password Info]','[Show Password Info]',0,0),
	(367,'user','','admin.user_register_setting','Show Reenter Password','Show Reenter Password',0,0),
	(368,'user','','admin.user_register_setting','[Show Reenter Password Info]','[Show Reenter Password Info]',0,0),
	(369,'user','','admin.user_register_setting','Show Terms','Show Terms',0,0),
	(370,'user','','admin.user_register_setting','[Show Terms Info]','[Show Terms Info]',0,0),
	(371,'user','','admin.user_register_setting','Show Invite Code','Show Invite Code',0,0),
	(372,'user','','admin.user_register_setting','[Show Invite Code Info]','[Show Invite Code Info]',0,0),
	(373,'user','','admin.user_register_setting','Show Currency','Show Currency',0,0),
	(374,'user','','admin.user_register_setting','[Show Currency Info]','[Show Currency Info]',0,0),
	(375,'user','','admin.user_register_setting','Successful Url','Successful Url',0,0),
	(376,'user','','admin.user_register_setting','[Successful Url Info]','[Successful Url Info]',0,0),
	(377,'user','','admin.user_register_setting','Send Welcome Email','Send Welcome Email',0,0),
	(378,'user','','admin.user_register_setting','[Send Welcome Email Info]','[Send Welcome Email Info]',0,0),
	(379,'user','','admin.user_register_setting','Send Verify Email','Send Verify Email',0,0),
	(380,'user','','admin.user_register_setting','[Send Verify Email Info]','[Send Verify Email Info]',0,0),
	(381,'user','','admin.user_register_setting','Login After Success','Login After Success',0,0),
	(382,'user','','admin.user_register_setting','[Login After Success Info]','[Login After Success Info]',0,0),
	(383,'user','','_user.register','Show Dob','Show Dob',0,0),
	(384,'user','','_user.register','[Show Dob Info]','[Show Dob Info]',0,0),
	(385,'user','','_user.register','Show Gender','Show Gender',0,0),
	(386,'user','','_user.register','[Show Gender Info]','[Show Gender Info]',0,0),
	(387,'user','','_user.register','Show Displayname','Show Displayname',0,0),
	(388,'user','','_user.register','[Show Displayname Info]','[Show Displayname Info]',0,0),
	(389,'user','','_user.register','Show Locale','Show Locale',0,0),
	(390,'user','','_user.register','[Show Locale Info]','[Show Locale Info]',0,0),
	(391,'user','','_user.register','Show Location','Show Location',0,0),
	(392,'user','','_user.register','[Show Location Info]','[Show Location Info]',0,0),
	(393,'user','','_user.register','Show Timezone','Show Timezone',0,0),
	(394,'user','','_user.register','[Show Timezone Info]','[Show Timezone Info]',0,0),
	(395,'user','','_user.register','Show Captcha','Show Captcha',0,0),
	(396,'user','','_user.register','[Show Captcha Info]','[Show Captcha Info]',0,0),
	(397,'user','','_user.register','Show Username','Show Username',0,0),
	(398,'user','','_user.register','[Show Username Info]','[Show Username Info]',0,0),
	(399,'user','','_user.register','Show Email','Show Email',0,0),
	(400,'user','','_user.register','[Show Email Info]','[Show Email Info]',0,0),
	(401,'user','','_user.register','Show Reenter Email','Show Reenter Email',0,0),
	(402,'user','','_user.register','[Show Reenter Email Info]','[Show Reenter Email Info]',0,0),
	(403,'user','','_user.register','Show Password','Show Password',0,0),
	(404,'user','','_user.register','[Show Password Info]','[Show Password Info]',0,0),
	(405,'user','','_user.register','Show Reenter Password','Show Reenter Password',0,0),
	(406,'user','','_user.register','[Show Reenter Password Info]','[Show Reenter Password Info]',0,0),
	(407,'user','','_user.register','Show Terms','Show Terms',0,0),
	(408,'user','','_user.register','[Show Terms Info]','[Show Terms Info]',0,0),
	(409,'user','','_user.register','Show Invite Code','Show Invite Code',0,0),
	(410,'user','','_user.register','[Show Invite Code Info]','[Show Invite Code Info]',0,0),
	(411,'user','','_user.register','Show Currency','Show Currency',0,0),
	(412,'user','','_user.register','[Show Currency Info]','[Show Currency Info]',0,0),
	(413,'user','','_user.register','Successful Url','Successful Url',0,0),
	(414,'user','','_user.register','[Successful Url Info]','[Successful Url Info]',0,0),
	(415,'user','','_user.register','Send Welcome Email','Send Welcome Email',0,0),
	(416,'user','','_user.register','[Send Welcome Email Info]','[Send Welcome Email Info]',0,0),
	(417,'user','','_user.register','Send Verify Email','Send Verify Email',0,0),
	(418,'user','','_user.register','[Send Verify Email Info]','[Send Verify Email Info]',0,0),
	(419,'user','','_user.register','Login After Success','Login After Success',0,0),
	(420,'user','','_user.register','[Login After Success Info]','[Login After Success Info]',0,0),
	(421,'user','','_user.register','Auto Login','Auto Login',0,0),
	(422,'user','','_user.register','[Auto Login Info]','[Auto Login Info]',0,0),
	(423,'user','','_user.register','Auto Approve','Auto Approve',0,0),
	(424,'user','','_user.register','[Auto Approve Info]','[Auto Approve Info]',0,0),
	(425,'user','','_user.register','Notify Admin','Notify Admin',0,0),
	(426,'user','','_user.register','[Notify Admin Info]','[Notify Admin Info]',0,0),
	(427,'user','','_user.register','Verify Email Timeout','Verify Email Timeout',0,0),
	(428,'user','','_user.register','[Verify Email Timeout Info]','[Verify Email Timeout Info]',0,0),
	(429,'user','','_user.register','Show Subscriptions','Show Subscriptions',0,0),
	(430,'user','','_user.register','[Show Subscriptions Info]','[Show Subscriptions Info]',0,0),
	(431,'core','','_core.general_settings','Access Key','Access Key',0,0),
	(432,'core','','_core.general_settings','[Access Key Info]','[Access Key Info]',0,0),
	(433,'core','','_core.general_settings','[Offline Mode Info]','[Offline Mode Info]',0,0),
	(434,'core','','_core.general_settings','Offline Code','Offline Code',0,0),
	(435,'core','','_core.cache_settings','Default Cache','Default Cache',0,0),
	(436,'core','','_core.cache_settings','[Default Cache Id Info]','[Default Cache Id Info]',0,0),
	(437,'core','','_core.captcha','Default Captcha','Default Captcha Type',0,0),
	(438,'core','','_core.captcha','[Default Captcha Id Info]','Use this captcha type when captcha is visible to your site visitors.',0,0),
	(439,'core','','_core.license_settings','License Key','License Key',0,0),
	(440,'core','','_core.license_settings','[License Key Info]','[License Key Info]',0,0),
	(441,'core','','_core.license_settings','License Email','License Email',0,0),
	(442,'core','','_core.license_settings','[License Email Info]','[License Email Info]',0,0),
	(443,'core','','_core.license_settings','License Package','License Package',0,0),
	(444,'core','','_core.license_settings','[License Package Info]','[License Package Info]',0,0),
	(445,'core','','_core.verify_settings','Default Verify','Default Verify',0,0),
	(446,'core','','_core.verify_settings','[Default Verify Id Info]','[Default Verify Id Info]',0,0),
	(447,'core','','_core.i18n_settings','Default Locale','Default Locale',0,0),
	(448,'core','','_core.i18n_settings','[Default Locale Id Info]','[Default Locale Id Info]',0,0),
	(449,'core','','_core.i18n_settings','Default Timezone','Default Timezone',0,0),
	(450,'core','','_core.i18n_settings','[Default Timezone Id Info]','[Default Timezone Id Info]',0,0),
	(451,'core','','_core.i18n_settings','Default Currency','Default Currency',0,0),
	(452,'core','','_core.i18n_settings','[Default Currency Id Info]','[Default Currency Id Info]',0,0),
	(453,'core','','_core.mail_settings','Default Mail','Default Mail',0,0),
	(454,'core','','_core.mail_settings','[Default Mail Id Info]','[Default Mail Id Info]',0,0),
	(455,'core','','_core.logs','main_log_info','You can use main error logging to identify how many errors are issued, the type of errors that are issued, and what programs the errors occur',0,0),
	(456,'core','','_core.logs','main_log_title','Main Log',0,0),
	(457,'core','','_core.logs','mail_log_title','Mail Log',0,0),
	(458,'core','','_core.logs','debug_log_title','Debug Log',0,0),
	(459,'core','','_core.logs','mail_log_info','You can use main error logging to identify how many errors are issued, the type of errors that are issued, and what programs the errors occur',0,0),
	(460,'core','','_core.logs','debug_log_info','You can use main error logging to identify how many errors are issued, the type of errors that are issued, and what programs the errors occur',0,0),
	(463,'core','','_core.logs','Log Level','Log Level',0,0),
	(464,'core','','_core.logs','[Log Level Info]','Filter log message by greater than or equal selected value.',0,0),
	(465,'core','','_core.recaptcha','Site Key','Site Key',0,0),
	(466,'core','','_core.recaptcha','[Site Key Info]','Put google recaptcha site key here.',0,0),
	(467,'core','','_core.recaptcha','Secket Key','Secket Key',0,0),
	(469,'core','','_core.recaptcha','[Secret Key Info]','Put recaptcha secret key here. This key is used  for communication between your site and Google. Be sure to keep it a secret.',0,0),
	(470,'core','','_core.captcha','[Edit Captcha Settings Info]','<strong>Captcha </strong> is must have tools to protect your site from robots and spamer. It\'s easy to integrate captcha service to your site. \nTheses settings are applied to entire your site and all  members.',0,0),
	(472,'core','','_core.sms','Default SMS','Default SMS Service',0,0),
	(473,'core','','_core.sms','[Default SMS Id Info]','[Default SMS Id Info]',0,0),
	(474,'core','','_core.mbs','Default Mobile Service','Default Mobile Service',0,0),
	(475,'core','','_core.sms','[Edit Site Settings Info]','When you would like to verify user action via SMS, Phone or Voice call. It\'s easy by choosing a SMS service provider.\nThese settings are applied to your entire site and its members. ',0,0),
	(476,'core','','_core.mbs','Default SMS Service','Default SMS Service',0,0),
	(477,'core','','_core.mbs','[Default SMS Id Info]','[Default SMS Id Info]',0,0),
	(478,'core','','_core.session','Session Maxlifetime','Maxlifetime',0,0),
	(479,'core','','v','[Session Maxlifetime Info]','[Session Maxlifetime Info]',0,0),
	(480,'core','','_core.session','Session Lifetime','Lifetime',0,0),
	(481,'core','','_core.session','[Session Lifetime Info]','Specifies the lifetime of the cookie in seconds which is sent to the browser. The value 0 means \"until the browser is closed.\" Defaults to 0. this value applied to `session.cookie_lifetime`',0,0),
	(482,'core','','_core.session','[Session Maxlifetime Info]','This value (default 1440 seconds) defines how long an unused PHP session will be kept alive',0,0),
	(483,'core','','_core.session','Use Php Ini','Use Php Ini',0,0),
	(484,'core','','_core.session','[Use Php Ini Info]','Use value from \"php.ini\" only.\nIf this value set to `yes`, all session.* variables is used from php.ini file, others configure in this form will not applied.',0,0);

/*!40000 ALTER TABLE `pf5_i18n_message` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_i18n_timezone
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_i18n_timezone`;

CREATE TABLE `pf5_i18n_timezone` (
  `timezone_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `timezone_location` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordering` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `timezone_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `timezone_offset` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`timezone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_i18n_timezone` WRITE;
/*!40000 ALTER TABLE `pf5_i18n_timezone` DISABLE KEYS */;

INSERT INTO `pf5_i18n_timezone` (`timezone_id`, `timezone_location`, `is_active`, `ordering`, `timezone_code`, `timezone_offset`, `is_default`)
VALUES
	('UTC-10','Hawaii (US)',1,6,'Pacific/Honolulu','UTC-10',0),
	('UTC-11','Midway Island, Samoa',1,7,'Pacific/Samoa','UTC-11',0),
	('UTC-12','Eniwetok, Kwajalein',1,8,'Etc/GMT-12','UTC-12',0),
	('UTC-2','Mid-Atlantic',1,11,'Atlantic/South_Georgia','UTC-2',0),
	('UTC-3','Brasilia, Buenos Aires, ',1,10,'America/Buenos_Aires','UTC-3',0),
	('UTC-3:30','Canada/Newfoundland',1,9,'Canada/Newfoundland','UTC-3:30',0),
	('UTC-4','Atlantic Time (Canada)',1,4,'America/Halifax','UTC-4',0),
	('UTC-5','Eastern Time (US &amp; Canada)',1,3,'US/Eastern','UTC-5',0),
	('UTC-6','Central Time (US & Canada)',1,2,'US/Central','UTC-6',0),
	('UTC-7','Mountain Time (US &amp; Canada)',1,1,'US/Mountain','UTC-7',0),
	('UTC-8','Pacific Time (US &amp; Canada)',1,0,'US/Pacific','UTC-8',0),
	('UTC-9','Alaska (US &amp; Canada)',1,5,'America/Anchorage','UTC-9',0),
	('UTC+0','Lisbon, London',1,13,'Europe/London','UTC+0',0),
	('UTC+1','Amsterdam, Berlin, Paris, Rome, Madrid',1,14,'Europe/Berlin','UTC+1',0),
	('UTC+10','Brisbane, Melbourne, Sydney, Guam',1,29,'Australia/Sydney','UTC+10',0),
	('UTC+11','Magadan, Soloman Is., New Caledonia',1,30,'Asia/Magadan','UTC+11',0),
	('UTC+12','Fiji, Kamchatka, Marshall Is., Wellington',1,31,'Pacific/Auckland','UTC+12',0),
	('UTC+2','Athens, Helsinki, Istanbul, Cairo, E. Europe',1,15,'Europe/Athens','UTC+2',0),
	('UTC+3','Baghdad, Kuwait, Nairobi, Moscow',1,16,'Europe/Moscow','UTC+3',0),
	('UTC+3:30','Tehran',1,17,'Iran','UTC+3:30',0),
	('UTC+4','Abu Dhabi, Kazan, Muscat',1,18,'Asia/Dubai','UTC+4',0),
	('UTC+4:30','Kabul',1,19,'Asia/Kabul','UTC+4:30',0),
	('UTC+5','Islamabad, Karachi, Tash',1,20,'Asia/Yekaterinburg','UTC+5',0),
	('UTC+5:30','Bombay, Calcutta, New',1,21,'Asia/Calcutta','UTC+5:30',0),
	('UTC+5:45','Nepal',1,22,'Asia/Katmandu','UTC+5:45',0),
	('UTC+6','Almaty, Dhaka',1,23,'Asia/Omsk','UTC+6',0),
	('UTC+6:30','Cocos Islands, Yangon',1,24,'India/Cocos','UTC+6:30',0),
	('UTC+7','Bangkok, Jakarta, Hanoi',1,25,'Asia/Krasnoyarsk','UTC+7',0),
	('UTC+8','Beijing, Hong Kong, Sing',1,26,'Asia/Hong_Kong','UTC+8',0),
	('UTC+9','Tokyo, Osaka, Sapporto, Seoul, Yakutsk',1,27,'Asia/Tokyo','UTC+9',0),
	('UTC+9:30','Adelaide, Darwin',1,28,'Australia/Adelaide','UTC+9:30',0);

/*!40000 ALTER TABLE `pf5_i18n_timezone` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_invite
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_invite`;

CREATE TABLE `pf5_invite` (
  `id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_id` int(11) unsigned NOT NULL,
  `recipient` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new_user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `type_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_layout_action
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_layout_action`;

CREATE TABLE `pf5_layout_action` (
  `action_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_action_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `package_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_admin` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_layout_action` WRITE;
/*!40000 ALTER TABLE `pf5_layout_action` DISABLE KEYS */;

INSERT INTO `pf5_layout_action` (`action_id`, `parent_action_id`, `action_name`, `package_id`, `is_admin`, `description`)
VALUES
	('blog_index_index','default','Blog Home','blog',1,'Blog landing page'),
	('blog_index_my','default','My Posts','blog',1,'Browse blog posts from current viewer'),
	('blog_post_view','default','View Post','blog',1,'View blog post detail'),
	('core_index_index','default','Landing Page','core',1,'Visitor Landing Page'),
	('default','','Default','core',1,'Default Master Page'),
	('photo_index_index','default','Photo Home Page','photos',1,'Photo Home Page');

/*!40000 ALTER TABLE `pf5_layout_action` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_layout_block
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_layout_block`;

CREATE TABLE `pf5_layout_block` (
  `block_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `container_id` int(11) unsigned NOT NULL,
  `location_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'main',
  `component_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ordering` int(11) unsigned NOT NULL DEFAULT '0',
  `is_active` int(11) unsigned NOT NULL DEFAULT '1',
  `params` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`block_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_layout_block` WRITE;
/*!40000 ALTER TABLE `pf5_layout_block` DISABLE KEYS */;

INSERT INTO `pf5_layout_block` (`block_id`, `parent_id`, `container_id`, `location_id`, `component_id`, `ordering`, `is_active`, `params`)
VALUES
	(1,0,1,'main','core.action_content',1,1,'[]'),
	(5,0,11,'main','core.action_content',1,1,'[]'),
	(11,0,17,'main','core.main_search',0,1,'[]'),
	(12,0,17,'main','core.action_content',0,1,'[]');

/*!40000 ALTER TABLE `pf5_layout_block` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_layout_component
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_layout_component`;

CREATE TABLE `pf5_layout_component` (
  `component_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `component_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `component_class` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `package_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'core',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `ordering` tinyint(4) NOT NULL DEFAULT '1',
  `description` mediumtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`component_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_layout_component` WRITE;
/*!40000 ALTER TABLE `pf5_layout_component` DISABLE KEYS */;

INSERT INTO `pf5_layout_component` (`component_id`, `component_name`, `component_class`, `form_name`, `package_id`, `is_active`, `ordering`, `description`)
VALUES
	('core.action_content','Action Content','Neutron\\Core\\Block\\ActionContent','none','core',1,1,''),
	('core.main_search','Main Search','Neutron\\Core\\Block\\MainSearch','none','core',1,1,''),
	('core.menu_secondary','Secondary Menu','Neutron\\Core\\Block\\SecondaryMenu','none','core',1,1,NULL);

/*!40000 ALTER TABLE `pf5_layout_component` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_layout_container
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_layout_container`;

CREATE TABLE `pf5_layout_container` (
  `container_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) unsigned NOT NULL,
  `grid_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'simple',
  `type_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'container',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `params` mediumtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`container_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_layout_container` WRITE;
/*!40000 ALTER TABLE `pf5_layout_container` DISABLE KEYS */;

INSERT INTO `pf5_layout_container` (`container_id`, `page_id`, `grid_id`, `type_id`, `is_active`, `ordering`, `params`)
VALUES
	(1,1,'simple','container',1,0,'[]'),
	(11,15,'simple-011','container-fluid',1,0,'[]'),
	(17,14,'simple-011','container',1,1,NULL);

/*!40000 ALTER TABLE `pf5_layout_container` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_layout_grid
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_layout_grid`;

CREATE TABLE `pf5_layout_grid` (
  `grid_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ordering` tinyint(4) NOT NULL DEFAULT '1',
  `description` tinytext COLLATE utf8_unicode_ci,
  `locations` mediumtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`grid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_layout_grid` WRITE;
/*!40000 ALTER TABLE `pf5_layout_grid` DISABLE KEYS */;

INSERT INTO `pf5_layout_grid` (`grid_id`, `title`, `ordering`, `description`, `locations`)
VALUES
	('simple','Simple 1 column',1,'Single column','[\"main\"]'),
	('simple-011','Simple 2 column - right & main',2,'2 Column `right` and `main`','[\"main\",\"right\"]'),
	('simple-110','Simple 2 column - left & main',3,'2 Column `left` and `main`','[\"main\",\"left\"]'),
	('simple-111','Simple 3 column - left, right & main',4,'3 Column `left`,`right` and `main`','[\"main\",\"left\",\"right\"]');

/*!40000 ALTER TABLE `pf5_layout_grid` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_layout_location
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_layout_location`;

CREATE TABLE `pf5_layout_location` (
  `container_id` int(11) NOT NULL,
  `location_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `params` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `container_id` (`container_id`,`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_layout_location` WRITE;
/*!40000 ALTER TABLE `pf5_layout_location` DISABLE KEYS */;

INSERT INTO `pf5_layout_location` (`container_id`, `location_id`, `params`)
VALUES
	(1,'main','[]'),
	(11,'main','[]');

/*!40000 ALTER TABLE `pf5_layout_location` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_layout_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_layout_page`;

CREATE TABLE `pf5_layout_page` (
  `page_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `theme_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `params` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `page_id` (`action_id`,`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_layout_page` WRITE;
/*!40000 ALTER TABLE `pf5_layout_page` DISABLE KEYS */;

INSERT INTO `pf5_layout_page` (`page_id`, `action_id`, `theme_id`, `is_active`, `params`)
VALUES
	(1,'default','default',1,'[]'),
	(14,'blog_index_index','default',1,'[]'),
	(15,'core_index_index','default',1,'[]');

/*!40000 ALTER TABLE `pf5_layout_page` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_layout_theme
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_layout_theme`;

CREATE TABLE `pf5_layout_theme` (
  `theme_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_editing` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_admin` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_layout_theme` WRITE;
/*!40000 ALTER TABLE `pf5_layout_theme` DISABLE KEYS */;

INSERT INTO `pf5_layout_theme` (`theme_id`, `title`, `parent_id`, `is_default`, `is_active`, `is_editing`, `is_admin`)
VALUES
	('admin','Theme Admin','default',0,1,0,1),
	('default','Theme Default',NULL,0,1,1,0),
	('galaxy','Theme Galaxy','default',1,1,0,0);

/*!40000 ALTER TABLE `pf5_layout_theme` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_layout_theme_params
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_layout_theme_params`;

CREATE TABLE `pf5_layout_theme_params` (
  `params_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` varchar(64) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`params_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pf5_layout_theme_params` WRITE;
/*!40000 ALTER TABLE `pf5_layout_theme_params` DISABLE KEYS */;

INSERT INTO `pf5_layout_theme_params` (`params_id`, `theme_id`, `params`)
VALUES
	(3,'galaxy','[]'),
	(4,'galaxy','[]'),
	(5,'galaxy','[]'),
	(6,'galaxy','[]'),
	(7,'galaxy','[]'),
	(8,'galaxy','[]'),
	(9,'galaxy','[]'),
	(10,'galaxy','[]'),
	(11,'galaxy','[]'),
	(12,'galaxy','[]'),
	(13,'galaxy','[]'),
	(14,'galaxy','[]'),
	(15,'galaxy','[]'),
	(16,'galaxy','[]'),
	(17,'galaxy','[]'),
	(18,'galaxy','[]'),
	(19,'galaxy','[]'),
	(20,'galaxy','[]'),
	(21,'galaxy','[]');

/*!40000 ALTER TABLE `pf5_layout_theme_params` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_like
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_like`;

CREATE TABLE `pf5_like` (
  `like_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `about_id` int(11) unsigned NOT NULL,
  `about_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `poster_id` int(11) unsigned NOT NULL,
  `poster_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_id` int(11) unsigned NOT NULL,
  `parent_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_link
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_link`;

CREATE TABLE `pf5_link` (
  `link_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `title` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `photo_file_id` int(11) unsigned NOT NULL DEFAULT '0',
  `parent_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_id` int(11) unsigned NOT NULL,
  `poster_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `poster_id` int(11) unsigned NOT NULL,
  `view_count` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `like_count` int(11) unsigned NOT NULL DEFAULT '0',
  `comment_count` int(11) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `privacy_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_log_adapter
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_log_adapter`;

CREATE TABLE `pf5_log_adapter` (
  `adapter_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `container_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `driver_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `params` text COLLATE utf8_unicode_ci NOT NULL,
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`adapter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_log_adapter` WRITE;
/*!40000 ALTER TABLE `pf5_log_adapter` DISABLE KEYS */;

INSERT INTO `pf5_log_adapter` (`adapter_id`, `container_id`, `is_active`, `title`, `driver_id`, `params`, `description`)
VALUES
	(1,'main_log',1,'Files Logger','files','{\"level\":\"notice\",\"title\":\"Files Logger\"}','Default file logger'),
	(2,'main_log',1,'Database Logger','db','{\"level\":\"error\",\"title\":\"Database Logger\"}','Default database logger'),
	(3,'mail_log',1,'Files Logger','files','{\"level\":\"error\",\"title\":\"Files Logger\"}','Default database logger'),
	(4,'mail_log',0,'Database Logger','db','{\"level\":\"error\",\"title\":\"Database Logger\"}','Default database logger'),
	(5,'debug_log',1,'Files Logger','files','{\"level\":\"error\",\"title\":\"Files Logger\"}','Default database logger'),
	(6,'debug_log',0,'Database Logger','db','{\"level\":\"error\",\"title\":\"Database Logger\"}','Default database logger');

/*!40000 ALTER TABLE `pf5_log_adapter` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_mail_template
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_mail_template`;

CREATE TABLE `pf5_mail_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `package_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `vars` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_marketplace_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_marketplace_category`;

CREATE TABLE `pf5_marketplace_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_messages`;

CREATE TABLE `pf5_messages` (
  `message_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `attachment_type` varchar(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `attachment_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`),
  UNIQUE KEY `CONVERSATIONS` (`conversation_id`,`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_notification
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_notification`;

CREATE TABLE `pf5_notification` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `poster_type` varchar(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `poster_id` int(11) unsigned NOT NULL,
  `about_type` varchar(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `about_id` int(11) unsigned NOT NULL,
  `type_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `params` text COLLATE utf8_unicode_ci,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_mitigated` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `LOOKUP` (`user_id`,`created_at`),
  KEY `subject` (`poster_type`,`poster_id`),
  KEY `object` (`about_type`,`about_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_notification_setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_notification_setting`;

CREATE TABLE `pf5_notification_setting` (
  `user_id` int(11) unsigned NOT NULL,
  `params` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_notification_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_notification_type`;

CREATE TABLE `pf5_notification_type` (
  `type_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `package_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `handler_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_default` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_pages`;

CREATE TABLE `pf5_pages` (
  `page_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_featured` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `is_sponsor` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `type_id` smallint(4) unsigned NOT NULL,
  `category_id` mediumint(8) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `profile_name` varchar(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `photo_id` int(11) unsigned NOT NULL DEFAULT '0',
  `cover_photo_id` int(11) unsigned NOT NULL,
  `like_count` int(10) unsigned NOT NULL DEFAULT '0',
  `comment_count` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`page_id`),
  KEY `category_id` (`category_id`),
  KEY `app_id_3` (`user_id`),
  KEY `view_id` (`title`),
  KEY `page_id` (`page_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pf5_pages` WRITE;
/*!40000 ALTER TABLE `pf5_pages` DISABLE KEYS */;

INSERT INTO `pf5_pages` (`page_id`, `is_featured`, `is_sponsor`, `type_id`, `category_id`, `user_id`, `profile_name`, `title`, `photo_id`, `cover_photo_id`, `like_count`, `comment_count`, `created_at`)
VALUES
	(4,0,0,5,140,178,NULL,'Voluptas culpa alias nihil ducimus libero.',0,0,1,0,'2014-10-02 10:10:10'),
	(5,0,0,5,138,136,NULL,'Distinctio quo perspiciatis sint et.',0,0,1,0,'2014-10-02 10:10:10'),
	(6,0,0,5,135,126,NULL,'Deserunt quibusdam dolorum modi quae soluta dolorum minima.',0,0,1,0,'2014-10-02 10:10:10'),
	(7,0,0,5,142,139,NULL,'Enim sequi incidunt nam occaecati sunt possimus et magni.',0,0,1,0,'2014-10-02 10:10:10'),
	(8,0,0,5,145,192,NULL,'Reprehenderit non aut error consequatur repellat sed.',0,0,1,0,'2014-10-02 10:10:10'),
	(9,0,0,5,135,71,NULL,'Sed fuga architecto est minima in in.',0,0,1,0,'2014-10-02 10:10:10'),
	(10,0,0,5,141,205,NULL,'Molestias repellendus aut iste tempora rem similique omnis repellendus.',0,0,1,0,'2014-10-02 10:10:10'),
	(11,0,0,5,143,93,NULL,'Eum dolores qui sint dignissimos necessitatibus corporis.',0,0,1,0,'2014-10-02 10:10:10'),
	(12,0,0,5,141,165,NULL,'Officia quia beatae animi voluptas.',0,0,1,0,'2014-10-02 10:10:10'),
	(13,0,0,5,136,194,NULL,'Ut repudiandae similique sint et ullam.',0,0,1,0,'2014-10-02 10:10:10'),
	(14,0,0,5,145,263,NULL,'Molestiae fugit fuga omnis accusamus atque.',0,0,1,0,'2014-10-02 10:10:10'),
	(15,0,0,5,139,5,NULL,'Quasi quibusdam et fugiat occaecati earum non aut dolores.',0,0,1,0,'2014-10-02 10:10:10'),
	(16,0,0,5,135,200,NULL,'Repellendus a ut libero laudantium.',0,0,1,0,'2014-10-02 10:10:10'),
	(17,0,0,5,141,215,NULL,'Id quia praesentium at voluptatum voluptatem.',0,0,1,0,'2014-10-02 10:10:10'),
	(18,0,0,5,136,83,NULL,'Eveniet aspernatur nihil veniam cumque tempora.',0,0,1,0,'2014-10-02 10:10:10'),
	(19,0,0,5,136,111,NULL,'Temporibus qui sit ut quaerat at doloremque.',0,0,1,0,'2014-10-02 10:10:10'),
	(20,0,0,5,139,232,NULL,'Quo optio quis praesentium et.',0,0,1,0,'2014-10-02 10:10:10'),
	(21,0,0,5,135,173,NULL,'Fuga et autem necessitatibus veritatis quia et modi.',0,0,1,0,'2014-10-02 10:10:10'),
	(22,0,0,5,142,184,NULL,'Eum maxime enim facere omnis eaque vel asperiores quis.',0,0,1,0,'2014-10-02 10:10:10'),
	(23,0,0,5,141,144,NULL,'Et odit eos facere commodi molestiae molestiae.',0,0,1,0,'2014-10-02 10:10:10'),
	(24,0,0,5,143,34,NULL,'Occaecati est aut et nihil.',0,0,1,0,'2014-10-02 10:10:10'),
	(25,0,0,5,142,197,NULL,'Ullam autem non aut.',0,0,1,0,'2014-10-02 10:10:10'),
	(26,0,0,5,138,141,NULL,'Molestias similique modi necessitatibus quae quas impedit modi itaque.',0,0,1,0,'2014-10-02 10:10:10'),
	(27,0,0,5,142,220,NULL,'Odio esse occaecati ea nam nisi laborum.',0,0,1,0,'2014-10-02 10:10:10'),
	(28,0,0,5,140,69,NULL,'Voluptatem velit aliquam doloribus doloremque est.',0,0,1,0,'2014-10-02 10:10:10'),
	(29,0,0,5,141,82,NULL,'Error optio reprehenderit nihil fuga eum fugit dolorem qui.',0,0,1,0,'2014-10-02 10:10:10'),
	(30,0,0,5,144,122,NULL,'Quia enim voluptatem quisquam est repudiandae ducimus hic.',0,0,1,0,'2014-10-02 10:10:10'),
	(31,0,0,5,139,249,NULL,'Repellendus omnis exercitationem suscipit.',0,0,1,0,'2014-10-02 10:10:10'),
	(32,0,0,5,145,32,NULL,'Possimus distinctio voluptates et earum odio ut.',0,0,1,0,'2014-10-02 10:10:10'),
	(33,0,0,5,137,190,NULL,'In corrupti perspiciatis sit delectus qui pariatur doloribus.',0,0,1,0,'2014-10-02 10:10:10'),
	(34,0,0,5,143,188,NULL,'Et illum doloribus aspernatur optio eaque perspiciatis.',0,0,1,0,'2014-10-02 10:10:10'),
	(35,0,0,5,143,74,NULL,'Eum doloremque in quae molestiae aperiam nostrum.',0,0,1,0,'2014-10-02 10:10:10'),
	(36,0,0,5,139,51,NULL,'Error ad sint quae aut sint.',0,0,1,0,'2014-10-02 10:10:10'),
	(37,0,0,5,145,256,NULL,'Nemo dolore magnam laborum quidem facere.',0,0,1,0,'2014-10-02 10:10:10'),
	(38,0,0,5,144,211,NULL,'Qui eum aut odio eos.',0,0,1,0,'2014-10-02 10:10:10'),
	(39,0,0,5,142,28,NULL,'Numquam sapiente et sit inventore soluta.',0,0,1,0,'2014-10-02 10:10:10'),
	(40,0,0,5,142,250,NULL,'Sit placeat molestiae veniam distinctio laudantium explicabo ipsam dolores.',0,0,1,0,'2014-10-02 10:10:10'),
	(41,0,0,5,137,221,NULL,'Consequatur ut voluptatibus exercitationem id neque non.',0,0,1,0,'2014-10-02 10:10:10'),
	(42,0,0,5,135,253,NULL,'Repudiandae cupiditate saepe animi vel omnis.',0,0,1,0,'2014-10-02 10:10:10'),
	(43,0,0,5,141,142,NULL,'Voluptas voluptatem fugiat quaerat commodi.',0,0,1,0,'2014-10-02 10:10:10'),
	(44,0,0,5,143,260,NULL,'Mollitia in sunt nesciunt autem deleniti.',0,0,1,0,'2014-10-02 10:10:10'),
	(45,0,0,5,145,245,NULL,'Omnis iste at enim.',0,0,1,0,'2014-10-02 10:10:10'),
	(46,0,0,5,144,112,NULL,'Quo earum labore ut neque.',0,0,1,0,'2014-10-02 10:10:10'),
	(47,0,0,5,140,11,NULL,'Quia commodi adipisci vel dolor eaque libero sequi ut.',0,0,1,0,'2014-10-02 10:10:10'),
	(48,0,0,5,143,104,NULL,'Dolor occaecati vel sint esse.',0,0,1,0,'2014-10-02 10:10:10'),
	(49,0,0,5,142,33,NULL,'Nemo facere minus dolor quos sit dolores et.',0,0,1,0,'2014-10-02 10:10:10'),
	(50,0,0,5,141,80,NULL,'Ab maiores et molestias aliquam minima tempore tenetur nihil.',0,0,1,0,'2014-10-02 10:10:10'),
	(51,0,0,5,145,31,NULL,'Est quia et error fugiat rerum aliquid.',0,0,1,0,'2014-10-02 10:10:10'),
	(52,0,0,5,145,186,NULL,'Aut nobis enim et voluptate.',0,0,1,0,'2014-10-02 10:10:10'),
	(53,0,0,5,140,47,NULL,'Voluptatum itaque deleniti itaque similique sit.',0,0,1,0,'2014-10-02 10:10:10'),
	(54,0,0,5,136,133,NULL,'Natus officiis aut fuga consequatur illum ea veniam.',0,0,1,0,'2014-10-02 10:10:10'),
	(55,0,0,5,143,14,NULL,'Commodi voluptate dignissimos harum et dolorum fuga ea eveniet.',0,0,1,0,'2014-10-02 10:10:10'),
	(56,0,0,5,135,222,NULL,'Hic aut dolorum atque consectetur magni.',0,0,1,0,'2014-10-02 10:10:10'),
	(57,0,0,5,141,162,NULL,'Qui totam a enim aut tempore dignissimos.',0,0,1,0,'2014-10-02 10:10:10'),
	(58,0,0,5,137,176,NULL,'Natus ut aut provident beatae.',0,0,1,0,'2014-10-02 10:10:10'),
	(59,0,0,5,140,98,NULL,'Voluptatum quo natus labore sequi.',0,0,1,0,'2014-10-02 10:10:10'),
	(60,0,0,5,136,59,NULL,'Molestiae velit quo tempore earum sed iusto est.',0,0,1,0,'2014-10-02 10:10:10'),
	(61,0,0,5,142,62,NULL,'Quidem eligendi fuga repudiandae iusto.',0,0,1,0,'2014-10-02 10:10:10'),
	(62,0,0,5,138,182,NULL,'Eius ipsa dolorem consequatur delectus.',0,0,1,0,'2014-10-02 10:10:10'),
	(63,0,0,5,135,169,NULL,'Nisi totam et quia temporibus.',0,0,1,0,'2014-10-02 10:10:10'),
	(64,0,0,5,141,167,NULL,'Voluptate id et omnis eius itaque fugiat.',0,0,1,0,'2014-10-02 10:10:10'),
	(65,0,0,5,139,137,NULL,'Rerum quisquam et rem dicta voluptatem.',0,0,1,0,'2014-10-02 10:10:10'),
	(66,0,0,5,145,67,NULL,'Libero facere id quis aut.',0,0,1,0,'2014-10-02 10:10:10'),
	(67,0,0,5,143,22,NULL,'Tempora placeat et dolore veritatis magnam.',0,0,1,0,'2014-10-02 10:10:10'),
	(68,0,0,5,137,168,NULL,'Dolorum officiis minima fugit dicta.',0,0,1,0,'2014-10-02 10:10:10'),
	(69,0,0,5,137,105,NULL,'Sapiente aliquid magnam natus quasi blanditiis labore numquam.',0,0,1,0,'2014-10-02 10:10:10'),
	(70,0,0,5,140,227,NULL,'Enim voluptas dolorem assumenda dolores labore.',0,0,1,0,'2014-10-02 10:10:10'),
	(71,0,0,5,139,143,NULL,'Id accusantium voluptates ab unde.',0,0,1,0,'2014-10-02 10:10:10'),
	(72,0,0,5,140,209,NULL,'Ratione quae voluptas excepturi ut inventore id.',0,0,1,0,'2014-10-02 10:10:10'),
	(73,0,0,5,140,43,NULL,'Optio nemo incidunt fugit.',0,0,1,0,'2014-10-02 10:10:10'),
	(74,0,0,5,137,102,NULL,'Et voluptas alias error provident.',0,0,1,0,'2014-10-02 10:10:10'),
	(75,0,0,5,136,140,NULL,'Ipsum delectus qui harum aperiam mollitia corrupti aut.',0,0,1,0,'2014-10-02 10:10:10'),
	(76,0,0,5,144,123,NULL,'Eveniet eveniet voluptas amet.',0,0,1,0,'2014-10-02 10:10:10'),
	(77,0,0,5,141,64,NULL,'Deserunt quia voluptatibus commodi ipsum ut.',0,0,1,0,'2014-10-02 10:10:10'),
	(78,0,0,5,145,204,NULL,'Eum magni aut est laudantium tempore sunt qui.',0,0,1,0,'2014-10-02 10:10:10'),
	(79,0,0,5,139,120,NULL,'Sunt ducimus eos consectetur molestias fugit dolorem.',0,0,1,0,'2014-10-02 10:10:10'),
	(80,0,0,5,145,44,NULL,'Qui voluptatum tempore ut labore iure sit atque minus.',0,0,1,0,'2014-10-02 10:10:10'),
	(81,0,0,5,141,155,NULL,'Amet libero sit vel odit.',0,0,1,0,'2014-10-02 10:10:10'),
	(82,0,0,5,136,210,NULL,'Vitae explicabo nemo voluptatibus unde blanditiis modi minus.',0,0,1,0,'2014-10-02 10:10:10'),
	(83,0,0,5,135,199,NULL,'Quod harum in suscipit dolor ab soluta non.',0,0,1,0,'2014-10-02 10:10:10'),
	(84,0,0,9,0,46,NULL,'Veritatis qui enim ex ipsa illum.',0,0,1,0,'2014-10-02 10:10:10'),
	(85,0,0,9,0,32,NULL,'Deleniti blanditiis aut assumenda sapiente nulla laboriosam dolores.',0,0,1,0,'2014-10-02 10:10:10'),
	(86,0,0,7,0,184,NULL,'Quisquam vel ipsa qui mollitia ut.',0,0,1,0,'2014-10-02 10:10:10'),
	(87,0,0,6,0,215,NULL,'Repellat quidem quod aut impedit sit facilis ut.',0,0,1,0,'2014-10-02 10:10:10'),
	(88,0,0,6,0,228,NULL,'Sit quos reprehenderit ex non quaerat aperiam provident.',0,0,1,0,'2014-10-02 10:10:10'),
	(89,0,0,7,0,239,NULL,'Quia consectetur dolorum aut aut reiciendis aliquid.',0,0,1,0,'2014-10-02 10:10:10'),
	(90,0,0,9,0,126,NULL,'Eum laboriosam et repudiandae aliquid nihil laudantium rem.',0,0,1,0,'2014-10-02 10:10:10'),
	(91,0,0,9,0,222,NULL,'Omnis recusandae sunt illum nam id.',0,0,1,0,'2014-10-02 10:10:10'),
	(92,0,0,9,0,98,NULL,'Doloremque id est quod et atque magnam.',0,0,1,0,'2014-10-02 10:10:10'),
	(93,0,0,7,0,196,NULL,'Ducimus deleniti aperiam quidem velit iste est eum.',0,0,1,0,'2014-10-02 10:10:10'),
	(94,0,0,8,0,231,NULL,'Illum aut ut vitae molestiae quia.',0,0,1,0,'2014-10-02 10:10:10'),
	(95,0,0,6,0,190,NULL,'Quia vitae eveniet vel amet quas sapiente.',0,0,1,0,'2014-10-02 10:10:10'),
	(96,0,0,6,0,17,NULL,'Adipisci modi corrupti totam quam autem veniam.',0,0,1,0,'2014-10-02 10:10:10'),
	(97,0,0,8,0,2,NULL,'Rerum velit libero itaque ipsa dolorem excepturi fugit.',0,0,1,0,'2014-10-02 10:10:10'),
	(98,0,0,7,0,157,NULL,'Ut eius impedit nihil illo ut eligendi ut.',0,0,1,0,'2014-10-02 10:10:10'),
	(99,0,0,6,0,49,NULL,'Expedita eum neque consequatur nisi doloribus error qui.',0,0,1,0,'2014-10-02 10:10:10'),
	(100,0,0,8,0,97,NULL,'Sit sint molestiae facilis enim.',0,0,1,0,'2014-10-02 10:10:10'),
	(101,0,0,9,0,130,NULL,'Nostrum est ipsam id iusto qui.',0,0,1,0,'2014-10-02 10:10:10'),
	(102,0,0,9,0,225,NULL,'Repellendus facere dolor accusamus quia.',0,0,1,0,'2014-10-02 10:10:10'),
	(103,0,0,9,0,142,NULL,'Molestiae architecto occaecati quis sunt neque.',0,0,1,0,'2014-10-02 10:10:10'),
	(104,0,0,7,0,36,NULL,'Velit autem ut suscipit quos eum.',0,0,1,0,'2014-10-02 10:10:10'),
	(105,0,0,6,0,43,NULL,'Ea eligendi ut praesentium qui libero explicabo illum.',0,0,1,0,'2014-10-02 10:10:10'),
	(106,0,0,6,0,20,NULL,'Alias ea quis voluptas quibusdam corporis.',0,0,1,0,'2014-10-02 10:10:10'),
	(107,0,0,8,0,186,NULL,'Quod repudiandae consequatur libero vitae ad cupiditate molestiae.',0,0,1,0,'2014-10-02 10:10:10'),
	(108,0,0,7,0,164,NULL,'Aut doloremque ut dolores non ipsam quasi doloribus.',0,0,1,0,'2014-10-02 10:10:10'),
	(109,0,0,8,0,151,NULL,'Repudiandae error velit similique veniam.',0,0,1,0,'2014-10-02 10:10:10'),
	(110,0,0,6,0,103,NULL,'Consectetur natus iusto temporibus blanditiis est est quaerat.',0,0,1,0,'2014-10-02 10:10:10'),
	(111,0,0,6,0,250,NULL,'Atque ut ut sapiente.',0,0,1,0,'2014-10-02 10:10:10'),
	(112,0,0,6,0,227,NULL,'Et suscipit occaecati voluptatibus sed et.',0,0,1,0,'2014-10-02 10:10:10'),
	(113,0,0,7,0,127,NULL,'Aut amet excepturi nobis occaecati quaerat omnis sunt.',0,0,1,0,'2014-10-02 10:10:10'),
	(114,0,0,6,0,201,NULL,'Dolores voluptas vel harum facilis eos reiciendis dolores quidem.',0,0,2,0,'2014-10-02 10:10:10'),
	(115,0,0,9,0,207,NULL,'Temporibus quibusdam rerum rem laudantium dolores.',0,0,1,0,'2014-10-02 10:10:10'),
	(116,0,0,9,0,226,NULL,'Qui atque ipsam minima.',0,0,1,0,'2014-10-02 10:10:10'),
	(117,0,0,7,0,53,NULL,'Consequatur et cupiditate animi eius saepe minima accusamus.',0,0,1,0,'2014-10-02 10:10:10'),
	(118,0,0,9,0,69,NULL,'Repellendus sapiente ad corporis maxime quam minima ut tenetur.',0,0,1,0,'2014-10-02 10:10:10'),
	(119,0,0,8,0,30,NULL,'Dolore aliquam saepe voluptatem iusto.',0,0,1,0,'2014-10-02 10:10:10'),
	(120,0,0,9,0,209,NULL,'Rem aliquam rerum odit nesciunt repellat quo repudiandae.',0,0,1,0,'2014-10-02 10:10:10'),
	(121,0,0,6,0,52,NULL,'Aut quia aut vero placeat.',0,0,1,0,'2014-10-02 10:10:10'),
	(122,0,0,9,0,244,NULL,'Enim consequatur et dignissimos dolorem adipisci voluptate dolorem.',0,0,1,0,'2014-10-02 10:10:10'),
	(123,0,0,6,0,5,NULL,'Nihil assumenda optio ut vitae est culpa sit.',0,0,1,0,'2014-10-02 10:10:10'),
	(124,0,0,8,0,115,NULL,'Vel ex provident officia voluptatem.',0,0,1,0,'2014-10-02 10:10:10'),
	(125,0,0,7,0,174,NULL,'Velit doloremque ducimus necessitatibus non architecto.',0,0,1,0,'2014-10-02 10:10:10'),
	(126,0,0,8,0,7,NULL,'Illo magni nisi dolorem rem labore voluptatem vero enim.',0,0,1,0,'2014-10-02 10:10:10'),
	(127,0,0,8,0,64,NULL,'Voluptatem sunt molestiae vitae ut nostrum voluptatibus.',0,0,1,0,'2014-10-02 10:10:10'),
	(128,0,0,8,0,48,NULL,'Cumque sed molestias minima sed quia distinctio sed.',0,0,1,0,'2014-10-02 10:10:10'),
	(129,0,0,6,0,3,NULL,'Iusto amet eos numquam rerum.',0,0,1,0,'2014-10-02 10:10:10'),
	(130,0,0,8,0,179,NULL,'Fuga laboriosam mollitia nam.',0,0,1,0,'2014-10-02 10:10:10'),
	(131,0,0,8,0,194,NULL,'Illo numquam rem optio.',0,0,1,0,'2014-10-02 10:10:10'),
	(132,0,0,8,0,205,NULL,'Est facere voluptates est aperiam molestias molestiae voluptatem totam.',0,0,1,0,'2014-10-02 10:10:10'),
	(133,0,0,6,0,139,NULL,'Aut odit nihil et asperiores quasi.',0,0,1,0,'2014-10-02 10:10:10'),
	(134,0,0,9,0,66,NULL,'Provident ut repellat nobis eos aut dolor.',0,0,1,0,'2014-10-02 10:10:10'),
	(135,0,0,7,0,148,NULL,'Suscipit repellendus veritatis mollitia ut sapiente.',0,0,1,0,'2014-10-02 10:10:10'),
	(136,0,0,7,0,45,NULL,'Hic voluptas laudantium maiores ipsum quo id hic eos.',0,0,1,0,'2014-10-02 10:10:10'),
	(137,0,0,8,0,229,NULL,'Est tempora impedit fugit nam.',0,0,1,0,'2014-10-02 10:10:10'),
	(138,0,0,7,0,73,NULL,'Rerum corporis veniam et molestias consequuntur neque.',0,0,1,0,'2014-10-02 10:10:10'),
	(139,0,0,8,0,60,NULL,'Non voluptate et explicabo modi neque.',0,0,1,0,'2014-10-02 10:10:10'),
	(140,0,0,9,0,258,NULL,'Enim molestiae nihil esse tempora hic repellat.',0,0,1,0,'2014-10-02 10:10:10'),
	(141,0,0,9,0,166,NULL,'Perspiciatis id neque excepturi aperiam natus dolor soluta.',0,0,1,0,'2014-10-02 10:10:10'),
	(142,0,0,6,0,248,NULL,'Velit animi autem suscipit fugiat nobis sit aliquam eos.',0,0,1,0,'2014-10-02 10:10:10'),
	(143,0,0,8,0,19,NULL,'Est rerum architecto quibusdam deserunt dignissimos culpa.',0,0,1,0,'2014-10-02 10:10:10'),
	(144,0,0,8,0,180,NULL,'Id aut enim laboriosam pariatur sunt libero.',0,0,1,0,'2014-10-02 10:10:10'),
	(145,0,0,8,0,141,NULL,'Voluptate nobis et illum maiores atque fugit.',0,0,1,0,'2014-10-02 10:10:10'),
	(146,0,0,8,0,105,NULL,'Voluptatum eligendi qui aperiam neque.',0,0,1,0,'2014-10-02 10:10:10'),
	(147,0,0,7,0,110,NULL,'Optio alias dolorem omnis soluta omnis earum.',0,0,1,0,'2014-10-02 10:10:10'),
	(148,0,0,7,0,129,NULL,'Non aut atque quis.',0,0,1,0,'2014-10-02 10:10:10'),
	(149,0,0,6,0,47,NULL,'Enim velit totam beatae reprehenderit.',0,0,1,0,'2014-10-02 10:10:10'),
	(150,0,0,9,0,38,NULL,'Quidem qui voluptas aliquid itaque illum quo occaecati.',0,0,1,0,'2014-10-02 10:10:10'),
	(151,0,0,9,0,260,NULL,'Voluptas libero iusto quo numquam at vel.',0,0,1,0,'2014-10-02 10:10:10'),
	(152,0,0,6,0,88,NULL,'Libero et inventore possimus delectus quas autem nisi.',0,0,1,0,'2014-10-02 10:10:10'),
	(153,0,0,8,0,208,NULL,'Qui at expedita natus aut eaque.',0,0,1,0,'2014-10-02 10:10:10'),
	(154,0,0,7,0,167,NULL,'Id aut incidunt atque placeat.',0,0,1,0,'2014-10-02 10:10:10'),
	(155,0,0,7,0,35,NULL,'Aut quo autem sint minus eveniet voluptatem.',0,0,1,0,'2014-10-02 10:10:10'),
	(156,0,0,8,0,67,NULL,'Sit voluptatem labore facilis veritatis similique explicabo voluptatem.',0,0,1,0,'2014-10-02 10:10:10'),
	(157,0,0,6,0,124,NULL,'Aliquam dolore quibusdam hic voluptatibus quo tempore eos.',0,0,1,0,'2014-10-02 10:10:10'),
	(158,0,0,8,0,55,NULL,'Et id velit exercitationem nobis omnis culpa sequi.',0,0,1,0,'2014-10-02 10:10:10'),
	(159,0,0,7,0,168,NULL,'Et est aliquid dolorem.',0,0,1,0,'2014-10-02 10:10:10'),
	(160,0,0,7,0,91,NULL,'Sed perspiciatis enim non occaecati explicabo voluptatem debitis officia.',0,0,1,0,'2014-10-02 10:10:10'),
	(161,0,0,9,0,34,NULL,'Qui qui non tempore nesciunt.',0,0,1,0,'2014-10-02 10:10:10'),
	(162,0,0,7,0,170,NULL,'Sit necessitatibus repudiandae a.',0,0,1,0,'2014-10-02 10:10:10'),
	(163,0,0,8,0,65,NULL,'Quidem illum ut commodi accusantium velit voluptatem aut.',0,0,1,0,'2014-10-02 10:10:10'),
	(164,0,0,8,0,221,NULL,'Consequatur distinctio minus similique expedita delectus.',0,0,1,0,'2014-10-02 10:10:10'),
	(165,0,0,9,0,71,NULL,'Cum velit nulla esse est.',0,0,1,0,'2014-10-02 10:10:10'),
	(166,0,0,1,6,1,NULL,'[4.5] Blogs, Music, Forum, Page &amp; Group - Show error page when input long title[4.5] Blogs, Music, Forum, Page &amp; Group - Show error page when input long title[4.5] Blogs, Music, Forum, Page &amp; Group - Show error page when input long title[4.5] ',0,0,0,0,'2014-10-02 10:10:10'),
	(167,0,0,2,30,1,NULL,'[4.5] Blogs, Music, Forum, Page &amp; Group - Show error page when input long title[4.5] Blogs, Music, Forum, Page &amp; Group - Show error page when input long title[4.5] Blogs, Music, Forum, Page &amp; Group - Show error page when input long title',0,0,1,0,'2014-10-02 10:10:10'),
	(168,0,0,6,159,1,NULL,'[4.5] Blogs, Music, Forum, Page &amp; Group - Show error page when input long title[4.5] Blogs, Music, Forum, Page &amp; Group - Show error page when input long title[4.5] Blogs, Music, Forum, Page &amp; Group - Show error page when input long title',0,0,1,0,'2014-10-02 10:10:10');

/*!40000 ALTER TABLE `pf5_pages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_pages_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_pages_category`;

CREATE TABLE `pf5_pages_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_pages_category` WRITE;
/*!40000 ALTER TABLE `pf5_pages_category` DISABLE KEYS */;

INSERT INTO `pf5_pages_category` (`category_id`, `is_active`, `name`, `description`)
VALUES
	(12,1,'[example name]','[description]');

/*!40000 ALTER TABLE `pf5_pages_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_pages_member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_pages_member`;

CREATE TABLE `pf5_pages_member` (
  `parent_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`parent_id`,`user_id`),
  KEY `REVERSE` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_pages_member_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_pages_member_item`;

CREATE TABLE `pf5_pages_member_item` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_pages_member_list
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_pages_member_list`;

CREATE TABLE `pf5_pages_member_list` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL,
  `type_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `member_count` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_pages_member_request
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_pages_member_request`;

CREATE TABLE `pf5_pages_member_request` (
  `parent_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `status_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`parent_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_photo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_photo`;

CREATE TABLE `pf5_photo` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` int(11) unsigned NOT NULL DEFAULT '0',
  `type_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `ordering` int(11) unsigned NOT NULL DEFAULT '0',
  `parent_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_id` int(11) unsigned NOT NULL,
  `poster_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `poster_id` int(11) unsigned NOT NULL,
  `photo_file_id` int(11) unsigned NOT NULL,
  `view_count` int(11) unsigned NOT NULL DEFAULT '0',
  `like_count` int(11) NOT NULL DEFAULT '0',
  `comment_count` int(11) unsigned NOT NULL DEFAULT '0',
  `rating_value` float NOT NULL DEFAULT '0',
  `taken_date` date DEFAULT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `album_id` (`album_id`),
  KEY `owner_type` (`parent_type`,`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_photo_album
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_photo_album`;

CREATE TABLE `pf5_photo_album` (
  `album_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `parent_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_id` int(11) unsigned NOT NULL,
  `poster_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `poster_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `photo_id` int(11) unsigned NOT NULL DEFAULT '0',
  `view_count` int(11) unsigned NOT NULL DEFAULT '0',
  `like_count` int(11) NOT NULL DEFAULT '0',
  `comment_count` int(11) unsigned NOT NULL DEFAULT '0',
  `type_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `rating` float unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_sponsor` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`album_id`),
  KEY `owner_type` (`parent_type`,`parent_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_photo_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_photo_category`;

CREATE TABLE `pf5_photo_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_photo_category` WRITE;
/*!40000 ALTER TABLE `pf5_photo_category` DISABLE KEYS */;

INSERT INTO `pf5_photo_category` (`category_id`, `is_active`, `name`, `description`)
VALUES
	(1,1,'Anthro',NULL),
	(2,1,'Artisan Crafts',NULL),
	(3,1,'Cartoons & Comics',NULL),
	(4,1,'Comedy',NULL),
	(5,1,'Community Projects',NULL),
	(6,1,'Contests',NULL),
	(7,1,'Customization',NULL),
	(8,1,'Designs & Interfaces',NULL),
	(9,1,'Digital Art',NULL),
	(10,1,'Fan Art',NULL),
	(11,1,'Film & Animation',NULL),
	(12,1,'Fractal Art',NULL),
	(13,1,'Game Development Art',NULL),
	(14,1,'Literature',NULL),
	(15,1,'People',NULL),
	(16,1,'Pets & Animals',NULL),
	(17,1,'Photography',NULL),
	(18,1,'Resources & Stock Images',NULL),
	(19,1,'Science & Technology',NULL),
	(20,1,'Sports',NULL),
	(21,1,'Traditional Art',NULL);

/*!40000 ALTER TABLE `pf5_photo_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_poll_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_poll_category`;

CREATE TABLE `pf5_poll_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_privacy
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_privacy`;

CREATE TABLE `pf5_privacy` (
  `privacy_uid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_uid` bigint(20) unsigned NOT NULL,
  `privacy_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`privacy_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_quiz_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_quiz_category`;

CREATE TABLE `pf5_quiz_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_report_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_report_category`;

CREATE TABLE `pf5_report_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_report_category` WRITE;
/*!40000 ALTER TABLE `pf5_report_category` DISABLE KEYS */;

INSERT INTO `pf5_report_category` (`category_id`, `is_active`, `name`, `description`)
VALUES
	(1,0,'It\'s annoying or not interesting',''),
	(2,1,'It\'s a fake news story',''),
	(3,1,'It\'s spam',''),
	(4,1,'It\'s inappropriate content',''),
	(5,1,'It\'s spam content','');

/*!40000 ALTER TABLE `pf5_report_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_report_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_report_item`;

CREATE TABLE `pf5_report_item` (
  `item_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL DEFAULT '0',
  `message` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `about_id` int(11) NOT NULL,
  `about_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_report_item` WRITE;
/*!40000 ALTER TABLE `pf5_report_item` DISABLE KEYS */;

INSERT INTO `pf5_report_item` (`item_id`, `category_id`, `message`, `user_id`, `about_id`, `about_type`, `created_at`)
VALUES
	(86,0,'message content',100,21,'user','0000-00-00 00:00:00'),
	(88,0,'message content',100,21,'user','0000-00-00 00:00:00'),
	(89,0,'message content',100,21,'user','0000-00-00 00:00:00'),
	(91,0,'message content',100,21,'user','0000-00-00 00:00:00'),
	(92,0,'message content',100,21,'user','0000-00-00 00:00:00'),
	(99,3,'message content',100,21,'user','2012-10-10 00:22:44'),
	(102,3,'message content',100,21,'user','2012-10-10 00:22:44');

/*!40000 ALTER TABLE `pf5_report_item` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_request
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_request`;

CREATE TABLE `pf5_request` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `poster_type` varchar(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `poster_id` int(11) unsigned NOT NULL,
  `about_type` varchar(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `about_id` int(11) unsigned NOT NULL,
  `type_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `params` text COLLATE utf8_unicode_ci,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_mitigated` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `LOOKUP` (`user_id`,`created_at`),
  KEY `subject` (`poster_type`,`poster_id`),
  KEY `object` (`about_type`,`about_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_request_setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_request_setting`;

CREATE TABLE `pf5_request_setting` (
  `user_id` int(11) unsigned NOT NULL,
  `params` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_request_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_request_type`;

CREATE TABLE `pf5_request_type` (
  `type_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `package_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `handler_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_default` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_session
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_session`;

CREATE TABLE `pf5_session` (
  `id` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `modified` int(11) unsigned NOT NULL DEFAULT '0',
  `lifetime` int(11) unsigned NOT NULL DEFAULT '0',
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_session` WRITE;
/*!40000 ALTER TABLE `pf5_session` DISABLE KEYS */;

INSERT INTO `pf5_session` (`id`, `name`, `modified`, `lifetime`, `data`)
VALUES
	('099trcj7e3dp','',1487114469,3600,'example data'),
	('09ad22a9xln9','',1487113821,3600,'example data'),
	('0cz8fdlcyhso','',1487113291,3600,'example data'),
	('0kjn5vergstn','',1487114842,3600,'example data'),
	('0lnl4kteqplvapktpnsc1hvg00','PHPSESSID',1489751141,86400,''),
	('0oe7m51a1rucvn6aeghrk4g4s3','PHPSESSID',1493747288,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('0uy8axj3vlod','',1487089531,3600,'example data'),
	('2yhuvy5zbbnx','',1487090740,3600,'example data'),
	('3spfpmgqig38aiv2vcq6l69mm2','PHPSESSID',1487222929,86400,''),
	('42aci5sz8vdq','',1487114114,3600,'example data'),
	('494sto6csqqn','',1487090804,3600,'example data'),
	('4n5lo0n851ckol8fpn6bkekth2','PHPSESSID',1487243804,86400,''),
	('50igjmlcivz3','',1487089779,3600,'example data'),
	('51hje87dja44d3v693v815djs0','PHPSESSID',1487222835,86400,''),
	('5e0okdbu20uw','',1487113777,3600,'example data'),
	('5jat0ir8p4jz','',1487112944,3600,'example data'),
	('5s16tu0fdkum971e13crukkbv6','PHPSESSID',1487243575,86400,''),
	('6bah66u4nqnah32e6i1us9oju3','PHPSESSID',1491207469,86400,''),
	('6fpsqtb1r1zc','',1487090522,3600,'example data'),
	('6xeduffdv2iw','',1487089265,3600,'example data'),
	('7qqb0jpmv12i6kgt93a47cirb7','PHPSESSID',1488530182,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('860b80smfvmp','',1487089328,3600,'example data'),
	('8bgao19rseb5r5bv2mpd5n3eu5','PHPSESSID',1490092681,86400,''),
	('8f8kdlg2ece91hho8cml9plo94','PHPSESSID',1494578978,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('8jzervk39xao','',1487089998,3600,'example data'),
	('8r4ru0d77ko87np9ifa7es2h30','PHPSESSID',1487222929,86400,''),
	('92a2hl41n00vqhibln2i2oivo4','PHPSESSID',1487222834,86400,''),
	('99ct8dad60ry','',1487114878,3600,'example data'),
	('adgcsgh46k4j','',1487113532,3600,'example data'),
	('adhpchnqrncj','',1487090611,3600,'example data'),
	('afc8jqqat74i','',1487113550,3600,'example data'),
	('akot7ctoeia64oua07oavo8j22','PHPSESSID',1487923250,86400,''),
	('b6atmtn1jfc5','',1487090796,3600,'example data'),
	('bfigpm8utr69','',1487136722,3600,'example data'),
	('bnhmo0hktfu5','',1487136766,3600,'example data'),
	('cl4cenn3nv44k4fbgussiv77i2','PHPSESSID',1494240219,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('cmbfnitdk08o37pni8si9lill3','PHPSESSID',1495020508,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('cmdiqq28n28h941fjvve1v80r4','PHPSESSID',1494330652,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('cp9dlni97rbn71fne8dtgc2l76','PHPSESSID',1494068712,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('cpv1awbvdi4v','',1487113889,3600,'example data'),
	('d1f1rz8v4r24','',1487089720,3600,'example data'),
	('d6nzapkbvcnm','',1487089939,3600,'example data'),
	('d7zxajy5jqwq','',1487112770,3600,'example data'),
	('da3ub1prnfq096e0elaur41ho3','PHPSESSID',1493889523,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('dps366sqpdv5','',1487114011,3600,'example data'),
	('dsf7odr9o27t2p6r9upc0jhu23','PHPSESSID',1487222928,86400,''),
	('dyx5x03ygbm1','',1487090446,3600,'example data'),
	('eqo9ouwtlzqa','',1487090601,3600,'example data'),
	('ezjo4sqowbvh','',1487089958,3600,'example data'),
	('f1pml5v209h7t8d175fuejnnt4','PHPSESSID',1487243575,86400,''),
	('f55ay0ox8pwr','',1487114624,3600,'example data'),
	('f7yq99xy37w0','',1487091309,3600,'example data'),
	('fmlcwn4mmw7k','',1487089684,3600,'example data'),
	('geoitjgl2si0fle07gqth1fh87','PHPSESSID',1487222835,86400,''),
	('gv4693hhoud6t7bat8valedk80','PHPSESSID',1487222930,86400,''),
	('h55s413iolg8','',1487090484,3600,'example data'),
	('hg35qm06chc1j43r3inuf2tdh5','PHPSESSID',1492650409,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('hq8chitsiu6ktl5dianf1r40t6','PHPSESSID',1493481969,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('hwgexjwep3ey','',1487114548,3600,'example data'),
	('i2s52t4e3grint7hd8neqc14f0','PHPSESSID',1487243574,86400,''),
	('i75t6eog8i9turp42j0uqv1hr7','PHPSESSID',1487243803,86400,''),
	('ibvss206nq1uhifu2c400o5g34','PHPSESSID',1487252865,86400,''),
	('ig8p4iad6tsok1c54mq9uro371','PHPSESSID',1487243805,86400,''),
	('ihqlfije3vbr','',1487113476,3600,'example data'),
	('jbptsvzld20b','',1487089837,3600,'example data'),
	('jd210d9b5shmvclu6jar908b62','PHPSESSID',1493796905,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('joir9t36044d','',1487090074,3600,'example data'),
	('jx8pbz8j31oq','',1487089815,3600,'example data'),
	('k4jfvbu8pnq2vvpbgi7ofosm15','PHPSESSID',1487243637,86400,''),
	('k6aku9s7apm0ogs7l8iv9836d4','PHPSESSID',1492153855,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('keb2wwxx0nh2','',1487113578,3600,'example data'),
	('lx30qvnm1fc1','',1487112597,3600,'example data'),
	('m5irk8dmr1p5b9nn91bs4nops2','PHPSESSID',1487243802,86400,''),
	('mbcqiia6urrsdm2mo9gld03is0','PHPSESSID',1494607060,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('n1qp3gvaml0r0qqvvimbibado0','PHPSESSID',1487243639,86400,''),
	('n5c8r90k1coim9cjpv6nlh3kf1','PHPSESSID',1492296295,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('nr4aoeit3dh3up50gpip1in9k3','PHPSESSID',1487243638,86400,''),
	('o1e6api7g7v2g0hbg0jm1cv0s4','PHPSESSID',1494036303,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('o3dmp7lu9rk4','',1487090685,3600,'example data'),
	('o6u3h4isneg6dmnt9djaoe1uf0','PHPSESSID',1487243576,86400,''),
	('o6vhirkck564fhs4ekqmjj3vu3','PHPSESSID',1487243577,86400,''),
	('o8u2cfoan4u4mbi8470f696t35','PHPSESSID',1487256451,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('onon3ulv3rdmf8p80c9a460gb6','PHPSESSID',1487243637,86400,''),
	('pq2bb4btj4cm1tbqlud9897l73','PHPSESSID',1488783625,86400,''),
	('qjdf6i217bwi','',1487089704,3600,'example data'),
	('r28pgnktngolv1pcpmldvnfj65','PHPSESSID',1487243640,86400,''),
	('rm27s74kqhj51hg8etrn947q35','PHPSESSID',1487147937,86400,'_auth|a:3:{i:0;i:807;i:1;s:4:\"user\";i:2;i:807;}'),
	('rpj3t23594q34r14s2a3rho9n5','PHPSESSID',1487496334,86400,''),
	('sd76b2gwh2cg','',1487090838,3600,'example data'),
	('sf3csjvj1ufus4ca00qaabaei1','PHPSESSID',1487222930,86400,''),
	('shs9a7nq3t52dgo26pkbppmph4','PHPSESSID',1494847165,86400,'_auth|a:3:{i:0;i:2;i:1;s:4:\"user\";i:2;i:2;}'),
	('t8r5qgkz6mej','',1487113461,3600,'example data'),
	('tfrqttbpkiz3','',1487088995,3600,'example data'),
	('toq4fdvdic569rg8aq9705sk23','PHPSESSID',1487222835,86400,''),
	('u0kda83owsoo','',1487091148,3600,'example data'),
	('uaejox0wm4n4','',1487088912,3600,'example data'),
	('urlbkbm5ps684h06jjkap8i5t6','PHPSESSID',1487952350,86400,''),
	('ut8jvift4f1v5s2tec6621gvk0','PHPSESSID',1487243801,86400,''),
	('uvpo7zhhujvw','',1487091188,3600,'example data'),
	('vrqicvi0vaepk6u32vq40btrv4','PHPSESSID',1487222834,86400,''),
	('w6xc0pl5dpql','',1487113415,3600,'example data'),
	('xkvpj2lyarxb','',1487088898,3600,'example data'),
	('yhql6uek6f93','',1487089112,3600,'example data'),
	('yk7yxo8iorio','',1487114251,3600,'example data'),
	('zm53txs39qmd','',1487090196,3600,'example data'),
	('zq8gveo56phg','',1487089978,3600,'example data');

/*!40000 ALTER TABLE `pf5_session` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_setting_form
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_setting_form`;

CREATE TABLE `pf5_setting_form` (
  `form_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `package_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `form_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `ordering` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `is_active` tinyint(4) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_setting_form` WRITE;
/*!40000 ALTER TABLE `pf5_setting_form` DISABLE KEYS */;

INSERT INTO `pf5_setting_form` (`form_id`, `package_id`, `title`, `form_name`, `description`, `ordering`, `is_active`)
VALUES
	('blog','blog','Blog Settings','Neutron\\Blog\\Form\\Admin\\Settings\\SiteSettings','Blog Settings',2,1),
	('core_cache','core','Cache Settings','Neutron\\Core\\Form\\Admin\\Settings\\EditCacheSettings','Control Cache Settings',1,1),
	('core_captcha','core','Captcha Settings','Neutron\\Core\\Form\\Admin\\Settings\\EditCaptchaSettings','Genenral Settings',1,1),
	('core_general','core','General Settings','Neutron\\Core\\Form\\Admin\\Settings\\EditGeneralSettings','Genenral Settings',1,1),
	('core_i18n','core','International Settings','Neutron\\Core\\Form\\Admin\\Settings\\EditI18nSettings','Timezone, Currency, Locale, Translation',1,1),
	('core_license','core','License Settings','Neutron\\Core\\Form\\Admin\\Settings\\EditLicenseSettings','License Settings',1,1),
	('core_log','core','Log Settings','Neutron\\Core\\Form\\Admin\\Settings\\EditLogSettings','Control Log Settings',1,1),
	('core_mail','core','Mail Setttings','Neutron\\Core\\Form\\Admin\\Settings\\EditMailSettings','Mail Setttings',4,1),
	('core_message','core','Push Services','Neutron\\Core\\Form\\Admin\\Settings\\EditMessageSettings','Push Notification Settings',2,1),
	('core_seo','core','SEO Settings','Neutron\\Core\\Form\\Admin\\Settings\\EditSeoSettings','SEO Settings',1,1),
	('core_session','core','Session & Cookie Settings','Neutron\\Core\\Form\\Admin\\Settings\\EditSessionSettings','Control Session Settings',1,1),
	('core_sms','core','SMS Settings','Neutron\\Core\\Form\\Admin\\Settings\\EditSmsSettings','SMS Service Setttings',2,1),
	('core_storage','core','Storage Settings','Neutron\\Core\\Form\\Admin\\Settings\\EditStorageSettings','Storage System Settings',1,1),
	('dev','dev','Dev Settings','Neutron\\Dev\\Form\\Admin\\Settings\\DevSettings','Development Settings',2,1),
	('user_login','user','Login Setttings','Neutron\\User\\Form\\Admin\\Settings\\EditLoginSettings','Login Setttings',3,1),
	('user_register','user','Registration Setttings','Neutron\\User\\Form\\Admin\\Settings\\EditRegisterSettings','Registration Setttings',2,1);

/*!40000 ALTER TABLE `pf5_setting_form` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_setting_value
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_setting_value`;

CREATE TABLE `pf5_setting_value` (
  `value_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` varchar(32) NOT NULL DEFAULT 'core',
  `group_id` varchar(32) NOT NULL DEFAULT '',
  `form_id` varchar(32) DEFAULT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `value_actual` mediumtext,
  `ordering` int(10) unsigned NOT NULL DEFAULT '99',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`value_id`),
  UNIQUE KEY `group_id` (`group_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pf5_setting_value` WRITE;
/*!40000 ALTER TABLE `pf5_setting_value` DISABLE KEYS */;

INSERT INTO `pf5_setting_value` (`value_id`, `package_id`, `group_id`, `form_id`, `name`, `value_actual`, `ordering`, `is_active`)
VALUES
	(1,'core','core','core_captcha','default_captcha_id','\"3\"',1,1),
	(2,'core','core','core_sms','default_sms_id','\"\"',1,1),
	(3,'core','core','core_license','license_key','\"\"',1,1),
	(4,'core','core','core_license','license_email','\"\"',1,1),
	(5,'core','core','core_license','license_package','\"\"',1,1),
	(6,'core','core','core_session','default_session_id','\"9\"',2,1),
	(7,'core','core','core_session','cookie_path','\"\\/pf5\\/\"',6,1),
	(8,'core','core','core_session','cookie_domain','\"\"',5,1),
	(9,'core','core','core_session','cookie_httponly','\"1\"',8,1),
	(11,'core','core','core_general','offline_mode','\"0\"',1,1),
	(13,'core','core','core_seo','site_title','\"Social Network\"',1,1),
	(14,'core','core','core_seo','site_description','\"Social Network\"',8,1),
	(15,'core','core','core_seo','site_keyword','\"Social Network\"',11,1),
	(16,'core','core','core_seo','enable_google_analytic','\"0\"',19,1),
	(17,'core','core','core_seo','google_analytic_id','\"\"',20,1),
	(18,'core','core','core_seo','enable_facebook','\"0\"',13,1),
	(19,'core','core','core_seo','facebook_app_id','\"\"',14,1),
	(20,'core','core','core_seo','facebook_app_name','\"\"',16,1),
	(21,'core','core','core_seo','enable_google_plus','\"0\"',17,1),
	(22,'core','core','core_seo','google_plus_id','\"\"',18,1),
	(23,'core','core','core_seo','title_separator','\"&#187;\"',5,1),
	(24,'core','core','core_seo','keyword_limit','\"500\"',12,1),
	(25,'core','core','core_seo','description_limit','\"500\"',10,1),
	(26,'core','core','core_seo','enable_open_graph','\"0\"',21,1),
	(27,'core','core','core_seo','facebook_app_secret','\"\"',15,1),
	(28,'core','core','core_general','bundle_js','\"0\"',9,1),
	(29,'core','core','core_general','bundle_css','\"0\"',10,1),
	(30,'core','core','core_general','ajax_mode','\"0\"',6,1),
	(31,'core','core','core_general','force_https','\"1\"',7,1),
	(32,'core','core','core_general','secure_img','\"0\"',8,1),
	(33,'core','core','core_general','google_api_key','\"\"',10,1),
	(34,'core','core','core_cache','shared_cache_cache_id','\"10\"',10,1),
	(35,'core','core','core_i18n','default_locale_id','\"vi\"',10,1),
	(36,'core','core','core_i18n','default_timezone_id','\"UTC-1\"',10,1),
	(37,'core','core','core_i18n','default_currency_id','\"EUR\"',10,1),
	(39,'core','core','core_mail','default_mailer_id','\"1\"',10,1),
	(40,'core','core','core_session','cookie_secure','\"1\"',7,1),
	(41,'core','core','core_session','session_name','\"sancode\"',3,1),
	(42,'core','core','core_storage','default_storage_id','\"1\"',1,1),
	(43,'core','core','core_general','setting_version','1495210142',102,1),
	(44,'core','core','core_general','static_version','\"1\"',102,1),
	(45,'core','core','core_general','offline_code','\"9cafc\"',2,1),
	(46,'core','core','core_general','private_mode','\"0\"',4,1),
	(48,'user','user_register','user_register','show_dob','\"0\"',6,1),
	(49,'user','user_register','user_register','show_gender','\"0\"',6,1),
	(50,'user','user_register','user_register','show_displayname','\"0\"',6,1),
	(51,'user','user_register','user_register','show_locale','\"0\"',6,1),
	(52,'user','user_register','user_register','show_location','\"0\"',6,1),
	(53,'user','user_register','user_register','show_timezone','\"0\"',6,1),
	(54,'user','user_register','user_register','show_captcha','\"0\"',6,1),
	(55,'user','user_register','user_register','show_username','\"0\"',6,1),
	(56,'user','user_register','user_register','show_email','\"0\"',6,1),
	(57,'user','user_register','user_register','show_reenter_email','\"0\"',6,1),
	(58,'user','user_register','user_register','show_password','\"0\"',6,1),
	(59,'user','user_register','user_register','show_reenter_password','\"0\"',6,1),
	(60,'user','user_register','user_register','show_terms','\"0\"',6,1),
	(61,'user','user_register','user_register','show_invite_code','\"0\"',6,1),
	(62,'user','user_register','user_register','show_currency','\"0\"',6,1),
	(63,'user','user_register','user_register','successful_url','\"/\"',6,1),
	(64,'user','user_register','user_register','send_welcome_email','\"0\"',6,1),
	(65,'user','user_register','user_register','send_verify_email','\"0\"',6,1),
	(66,'user','user_register','user_register','auto_login','\"1\"',6,1),
	(67,'user','user_register','user_register','auto_approve','\"1\"',6,1),
	(68,'user','user_register','user_register','notify_admin','\"0\"',6,1),
	(69,'user','user_register','user_register','verify_email_timeout','\"0\"',6,1),
	(70,'user','user_register','user_register','show_subscriptions','\"0\"',6,1),
	(71,'core','core','core_log','log_level','\"error\"',1,0),
	(72,'core','core','core_session','session_maxlifetime','\"2592000\"',4,1),
	(73,'core','core','core_session','cookie_lifetime','\"2592000\"',5,1),
	(75,'core','core','core_session','cookie_php_ini_only','\"0\"',1,1);

/*!40000 ALTER TABLE `pf5_setting_value` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_storage_adapter
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_storage_adapter`;

CREATE TABLE `pf5_storage_adapter` (
  `adapter_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `driver_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `params` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_required` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`adapter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_storage_adapter` WRITE;
/*!40000 ALTER TABLE `pf5_storage_adapter` DISABLE KEYS */;

INSERT INTO `pf5_storage_adapter` (`adapter_id`, `title`, `description`, `driver_id`, `params`, `is_active`, `is_required`, `is_default`)
VALUES
	(2,'Ftp 127.0.0.1:22','','ftp','{\"protocol\":\"ftps\",\"host\":\"127.0.0.1\",\"port\":\"22\",\"timeout\":\"30\",\"username\":\"namnv\",\"password\":\"namnv123\",\"basePath\":\"\\/public_html\\/cdn\\/\",\"baseUrl\":\"http:\\/\\/product-dev.younetco.com\\/cdn\\/\",\"baseCdnUrl\":\"\",\"is_active\":\"1\",\"title\":\"Ftp 127.0.0.1:22\"}',1,0,0),
	(4,'Local `public2`','','local','{\"basePath\":\"public2\",\"baseUrl\":\"public\",\"baseCdnUrl\":\"public\",\"is_active\":\"1\",\"title\":\"Local `public2`\"}',1,0,0);

/*!40000 ALTER TABLE `pf5_storage_adapter` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_storage_file
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_storage_file`;

CREATE TABLE `pf5_storage_file` (
  `file_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adapter_id` int(11) unsigned NOT NULL DEFAULT '0',
  `file_size` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `file_mime` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `paths` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_subject
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_subject`;

CREATE TABLE `pf5_subject` (
  `subject_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_user`;

CREATE TABLE `pf5_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level_id` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_photo_id` int(11) unsigned NOT NULL DEFAULT '0',
  `gender_id` tinyint(3) NOT NULL DEFAULT '0',
  `status_id` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `view_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` varchar(100) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `locale_id` varchar(12) NOT NULL DEFAULT 'en_US',
  `timezone` varchar(32) NOT NULL DEFAULT 'GMT+7',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pf5_user` WRITE;
/*!40000 ALTER TABLE `pf5_user` DISABLE KEYS */;

INSERT INTO `pf5_user` (`user_id`, `level_id`, `user_photo_id`, `gender_id`, `status_id`, `view_id`, `username`, `fullname`, `email`, `locale_id`, `timezone`, `created_at`)
VALUES
	(2,2,0,0,0,0,'profile-2','Genevieve Greenholt','Casey02@Spencer.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(3,2,0,0,0,0,'profile-3','Blaze Raynor','Toy.Chloe@Stark.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(4,2,0,0,0,0,'profile-4','Jaiden Grady','Gislason.Erik@Crona.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(5,2,0,0,0,0,'profile-5','Timothy Konopelski','Dasia53@Mohr.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(6,2,0,0,0,0,'profile-6','Hobart Beier','McDermott.Lou@Boyer.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(8,2,0,0,0,0,'profile-8','Heaven Denesik','Lowe.Lila@Kessler.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(9,2,0,0,0,0,'profile-9','Maud Deckow','Mraz.Mariano@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(10,2,0,0,0,0,'profile-10','Elenora Torphy','aProhaska@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(11,2,0,0,0,0,'profile-11','Jessie Bernhard','gChamplin@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(12,2,0,0,0,0,'profile-12','Muhammad Brekke','Kuvalis.Neha@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(13,2,0,0,0,0,'profile-13','Burley Nader','Marjory.Bernhard@Hansen.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(14,2,0,0,0,0,'profile-14','Viviane Lang','xStiedemann@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(15,2,0,0,0,0,'profile-15','Timothy Schuster','wGorczany@Hilll.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(16,2,0,0,0,0,'profile-16','Jed Labadie','Collins.Beaulah@Bernier.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(17,2,0,0,0,0,'profile-17','Sarah Hamill','Jordane.Haag@Crona.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(18,2,0,0,0,0,'profile-18','Danial Wyman','Ana20@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(19,2,0,0,0,0,'profile-19','Ursula West','Nathan.Turner@Monahan.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(20,2,0,0,0,0,'profile-20','Jaylan Kovacek','iReilly@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(21,2,0,0,0,0,'profile-21','Maye Wilderman','Verdie.Cole@Howell.org','en_US','GMT+7','2016-10-25 12:09:34'),
	(22,2,0,0,0,0,'profile-22','Janis Bergstrom','Edwina30@Quitzon.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(23,2,0,0,0,0,'profile-23','Valerie Jerde','Ashleigh.Moore@Grant.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(24,2,0,0,0,0,'profile-24','Abel Hermann','Kayleigh.Lubowitz@Cronin.org','en_US','GMT+7','2016-10-25 12:09:34'),
	(25,2,0,0,0,0,'profile-25','Patrick Bradtke','Joe.OKeefe@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(26,2,0,0,0,0,'profile-26','Audreanne Bartell','Eulah.Goodwin@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(27,2,0,0,0,0,'profile-27','Frida Kirlin','Bruen.Saige@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(28,2,0,0,0,0,'profile-28','Hulda Nader','Cody.Kling@Schowalter.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(29,2,0,0,0,0,'profile-29','Cordia Thiel','qHamill@Kulas.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(30,2,0,0,0,0,'profile-30','Giuseppe Cassin','eConn@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(31,2,0,0,0,0,'profile-31','Myah Fadel','xSmith@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(32,2,0,0,0,0,'profile-32','Antoinette Rutherford','eStroman@Veum.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(33,2,0,0,0,0,'profile-33','Filiberto Romaguera','Khalid91@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(34,2,0,0,0,0,'profile-34','Marcelino Schamberger','Anya.Larkin@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(35,2,0,0,0,0,'profile-35','Eloy Kuhlman','vBeier@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(36,2,0,0,0,0,'profile-36','Joelle Feest','Laila.Olson@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(37,2,0,0,0,0,'profile-37','Adolph White','Vernie50@Larson.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(38,2,0,0,0,0,'profile-38','Alba Lemke','Hegmann.Eldred@Flatley.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(39,2,0,0,0,0,'profile-39','Gregg Walsh','Rossie70@Balistreri.org','en_US','GMT+7','2016-10-25 12:09:34'),
	(40,2,0,0,0,0,'profile-40','Itzel Mann','Douglas.Josianne@Nicolas.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(41,2,0,0,0,0,'profile-41','Lorna Koss','vDare@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(42,2,0,0,0,0,'profile-42','Fernando Boyle','Murazik.Kelsi@Ferry.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(43,2,0,0,0,0,'profile-43','Major Koch','Stark.Anastasia@Gerlach.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(44,2,0,0,0,0,'profile-44','Kenton Moen','Jarvis57@Brown.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(45,2,0,0,0,0,'profile-45','Kayley Heller','Isobel.Hilpert@Windler.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(46,2,0,0,0,0,'profile-46','Angeline Smitham','George26@Gottlieb.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(47,2,0,0,0,0,'profile-47','Brendon Waelchi','bMcKenzie@Hessel.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(48,2,0,0,0,0,'profile-48','Aileen Ratke','Schiller.Annabell@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(49,2,0,0,0,0,'profile-49','Evert Lemke','fJakubowski@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(50,2,0,0,0,0,'profile-50','Bobby Bednar','hOndricka@Gleason.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(51,2,0,0,0,0,'profile-51','Devan Rolfson','Jerde.Noemi@Schaden.org','en_US','GMT+7','2016-10-25 12:09:34'),
	(52,2,0,0,0,0,'profile-52','Roy Beer','oHerman@Johnston.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(53,2,0,0,0,0,'profile-53','Elmira Reichel','wRosenbaum@Dicki.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(54,2,0,0,0,0,'profile-54','Glen Bailey','Edgardo.Dickinson@Ledner.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(55,2,0,0,0,0,'profile-55','Abagail Paucek','Euna40@Bartell.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(56,2,0,0,0,0,'profile-56','Jimmy Mante','Ward.Shyann@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(57,2,0,0,0,0,'profile-57','Myrl O&#039;Keefe','Emelia.Douglas@Stroman.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(58,2,0,0,0,0,'profile-58','Jaquelin Torphy','Jermey.Purdy@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(59,2,0,0,0,0,'profile-59','Quinn Bednar','Cleve37@Robel.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(60,2,0,0,0,0,'profile-60','Roma Borer','Berge.Jerod@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(61,2,0,0,0,0,'profile-61','Milford Johnson','zBarton@Braun.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(62,2,0,0,0,0,'profile-62','Nyah Reichert','hRunolfsson@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(63,2,0,0,0,0,'profile-63','Anibal Donnelly','Runolfsdottir.Angeline@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(64,2,0,0,0,0,'profile-64','Nathen Durgan','Ashtyn.Rath@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(65,2,0,0,0,0,'profile-65','Izabella Herman','Marquardt.Myriam@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(66,2,0,0,0,0,'profile-66','Ruthie Gerlach','lArmstrong@Romaguera.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(67,2,0,0,0,0,'profile-67','Mitchel Yost','Wisoky.Holly@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(68,2,0,0,0,0,'profile-68','Romaine Roob','Conn.Cali@Nicolas.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(69,2,0,0,0,0,'profile-69','Vida Oberbrunner','eFeeney@OKeefe.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(70,2,0,0,0,0,'profile-70','Jarret Hayes','Aurelia05@Schaden.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(71,2,0,0,0,0,'profile-71','Estelle Hayes','Alexa18@Rice.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(72,2,0,0,0,0,'profile-72','Euna Hagenes','nMohr@Nader.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(73,2,0,0,0,0,'profile-73','Lilian Kertzmann','Ozella43@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(74,2,0,0,0,0,'profile-74','Leo Rohan','gStracke@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(75,2,0,0,0,0,'profile-75','Imani Jaskolski','Runolfsdottir.Sydni@Jaskolski.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(76,2,0,0,0,0,'profile-76','Jacky Toy','fLehner@Vandervort.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(77,2,0,0,0,0,'profile-77','Nikki Altenwerth','Fanny.Lehner@Marvin.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(78,2,0,0,0,0,'profile-78','Eloy Schoen','Dustin21@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(79,2,0,0,0,0,'profile-79','Giovanny Goldner','Kunde.Deborah@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(80,2,0,0,0,0,'profile-80','Lance Pagac','Eliezer73@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(81,2,0,0,0,0,'profile-81','Elizabeth Sanford','Katelyn43@Ruecker.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(82,2,0,0,0,0,'profile-82','Angelica McDermott','rKling@Kub.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(83,2,0,0,0,0,'profile-83','Sheila Kautzer','Gerda.Wilkinson@Kemmer.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(84,2,0,0,0,0,'profile-84','Briana Lubowitz','Bayer.Beatrice@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(85,2,0,0,0,0,'profile-85','Ryleigh Hahn','Gladys.Erdman@Greenfelder.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(86,2,0,0,0,0,'profile-86','Janis Schneider','iBeer@Mayert.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(87,2,0,0,0,0,'profile-87','Reagan Luettgen','Koepp.Heber@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(88,2,0,0,0,0,'profile-88','Sydney Watsica','lLockman@Fisher.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(89,2,0,0,0,0,'profile-89','Rashawn Kerluke','Stephan.Medhurst@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(90,2,0,0,0,0,'profile-90','Helena Pacocha','Gusikowski.Madelyn@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(91,2,0,0,0,0,'profile-91','Reinhold Abshire','Alfreda33@OKon.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(92,2,0,0,0,0,'profile-92','Nia Medhurst','Bradley.Sporer@Waters.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(93,2,0,0,0,0,'profile-93','Marcellus Berge','Effie14@VonRueden.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(94,2,0,0,0,0,'profile-94','Annette Bartell','Ullrich.Candice@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(95,2,0,0,0,0,'profile-95','Gustave Lind','Jed.Larkin@Fadel.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(96,2,0,0,0,0,'profile-96','Tyson Lindgren','Wintheiser.Khalid@Jaskolski.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(97,2,0,0,0,0,'profile-97','Santino Mosciski','Alexandre26@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(98,2,0,0,0,0,'profile-98','Shanna Schultz','Ozella.Aufderhar@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(99,2,0,0,0,0,'profile-99','Vivian Blick','Walsh.Lincoln@Fisher.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(100,2,0,0,0,0,'profile-100','Webster Torp','Kassulke.Dayana@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(101,2,0,0,0,0,'profile-101','Jerel Hilll','Walsh.Buford@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(102,2,0,0,0,0,'profile-102','Emmett Dickinson','uKonopelski@Ondricka.org','en_US','GMT+7','2016-10-25 12:09:34'),
	(103,2,0,0,0,0,'profile-103','Bailee Wisozk','Serenity71@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(104,2,0,0,0,0,'profile-104','Carmelo Cole','Era.Wuckert@Keeling.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(105,2,0,0,0,0,'profile-105','Ludie Luettgen','qSporer@Watsica.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(106,2,0,0,0,0,'profile-106','Jess Bayer','Clinton.Bahringer@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(107,2,0,0,0,0,'profile-107','Ova Smith','Natalie.Rogahn@Goodwin.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(108,2,0,0,0,0,'profile-108','Carlotta Friesen','Jarrett68@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(109,2,0,0,0,0,'profile-109','Leone Cole','oRosenbaum@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(110,2,0,0,0,0,'profile-110','Rosario Doyle','Viola53@Bruen.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(111,2,0,0,0,0,'profile-111','Alek Gorczany','Benton65@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(112,2,0,0,0,0,'profile-112','Stephania Bailey','Kunde.Ryann@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(113,2,0,0,0,0,'profile-113','Schuyler Bartell','Ledner.Giuseppe@Purdy.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(114,2,0,0,0,0,'profile-114','Sunny Ernser','Rosalia92@Abshire.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(115,2,0,0,0,0,'profile-115','Kyleigh Walter','Schowalter.Odell@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(116,2,0,0,0,0,'profile-116','Kelsi Kshlerin','Monahan.Sabrina@Dibbert.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(117,2,0,0,0,0,'profile-117','Lelah Schmidt','Chelsea67@Windler.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(118,2,0,0,0,0,'profile-118','Walker Brakus','Pouros.Magnus@Bartell.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(119,2,0,0,0,0,'profile-119','Roberta Greenholt','Kimberly62@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(120,2,0,0,0,0,'profile-120','Wilber O&#039;Reilly','Gretchen.Weissnat@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(121,2,0,0,0,0,'profile-121','Lindsey Wisoky','Gust.Reichert@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(122,2,0,0,0,0,'profile-122','Lucas Parker','aLuettgen@Ritchie.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(123,2,0,0,0,0,'profile-123','Sadye Ritchie','Willa13@Mitchell.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(124,2,0,0,0,0,'profile-124','Madilyn Emard','Whitney.Wiegand@Stanton.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(125,2,0,0,0,0,'profile-125','Rebeka Schmidt','iFisher@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(126,2,0,0,0,0,'profile-126','Noemi Nienow','Skiles.Lulu@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(127,2,0,0,0,0,'profile-127','Kariane Rau','mStracke@Pfeffer.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(128,2,0,0,0,0,'profile-128','Grace Kris','Edgar10@Glover.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(129,2,0,0,0,0,'profile-129','Eric Kessler','Elenor.Upton@Kassulke.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(130,2,0,0,0,0,'profile-130','Kristofer Kunze','cGleason@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(131,2,0,0,0,0,'profile-131','Turner Weber','Avis.Kuhic@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(132,2,0,0,0,0,'profile-132','Rossie Huels','Justen84@Satterfield.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(133,2,0,0,0,0,'profile-133','Breana Walter','Chadd.Mann@Glover.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(134,2,0,0,0,0,'profile-134','Carroll Hansen','Travon59@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(135,2,0,0,0,0,'profile-135','Rosina Roob','Emile.Weissnat@Streich.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(136,2,0,0,0,0,'profile-136','Francisca O&#039;Conner','xMitchell@Murray.org','en_US','GMT+7','2016-10-25 12:09:34'),
	(137,2,0,0,0,0,'profile-137','Nina Lehner','Shields.Krystina@Buckridge.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(138,2,0,0,0,0,'profile-138','Alayna Dicki','Allen44@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(139,2,0,0,0,0,'profile-139','Beau Swaniawski','Adolph33@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(140,2,0,0,0,0,'profile-140','Krystel Heidenreich','Satterfield.Giuseppe@Stiedemann.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(141,2,0,0,0,0,'profile-141','Joey Bogan','Rice.Lavada@Gaylord.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(142,2,0,0,0,0,'profile-142','Lyda Welch','Kuhic.Kip@Renner.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(143,2,0,0,0,0,'profile-143','Jaida Fisher','Arlie.Romaguera@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(144,2,0,0,0,0,'profile-144','Mary Farrell','Alba05@Howell.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(145,2,0,0,0,0,'profile-145','Chaim Heidenreich','gWolff@Littel.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(146,2,0,0,0,0,'profile-146','Josefina Hoeger','Emil.Tremblay@Rath.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(147,2,0,0,0,0,'profile-147','Jacey Simonis','hWilderman@Kling.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(148,2,0,0,0,0,'profile-148','Shanna Klein','Langworth.Alison@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(149,2,0,0,0,0,'profile-149','Leann Kautzer','Selina96@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(150,2,0,0,0,0,'profile-150','Tyree Gottlieb','Gretchen.Kuhn@Shields.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(151,2,0,0,0,0,'profile-151','Sally Yundt','Trevion.Bernier@Mann.org','en_US','GMT+7','2016-10-25 12:09:34'),
	(152,2,0,0,0,0,'profile-152','Murray Bogan','Isac76@Deckow.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(153,2,0,0,0,0,'profile-153','Katelyn Gislason','Zora76@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(154,2,0,0,0,0,'profile-154','Marlen Mitchell','Liliana.Terry@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(155,2,0,0,0,0,'profile-155','Agustina Kilback','Jaron98@Lockman.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(156,2,0,0,0,0,'profile-156','Jude Powlowski','oWilliamson@Blanda.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(157,2,0,0,0,0,'profile-157','Odie Dietrich','Witting.Michael@Brekke.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(158,2,0,0,0,0,'profile-158','Millie Sanford','Donato25@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(159,2,0,0,0,0,'profile-159','Javier Upton','Erica.Mills@Bartoletti.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(160,2,0,0,0,0,'profile-160','Fabian Streich','cMayert@Grady.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(161,2,0,0,0,0,'profile-161','Kenya Douglas','xHilll@Stroman.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(162,2,0,0,0,0,'profile-162','Salvador Mraz','Boehm.Madilyn@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(163,2,0,0,0,0,'profile-163','Kaia Heller','Michael07@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(164,2,0,0,0,0,'profile-164','Oda Fisher','iSchmitt@Kling.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(165,2,0,0,0,0,'profile-165','Orlo Bogisich','Cicero.Connelly@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(166,2,0,0,0,0,'profile-166','Emily Macejkovic','hBeier@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(167,2,0,0,0,0,'profile-167','Isabel Frami','Annabelle.Hirthe@Collins.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(168,2,0,0,0,0,'profile-168','Lessie Stracke','Meagan99@Ortiz.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(169,2,0,0,0,0,'profile-169','Skye Johns','Maryam72@Wunsch.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(170,2,0,0,0,0,'profile-170','Lori Jacobs','oMann@Torp.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(171,2,0,0,0,0,'profile-171','Marcelo O&#039;Hara','Pfeffer.Ellis@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(172,2,0,0,0,0,'profile-172','Lesley Kohler','Orval97@Zieme.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(173,2,0,0,0,0,'profile-173','Fae Parisian','Jamaal.Abshire@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(174,2,0,0,0,0,'profile-174','Ronaldo McCullough','Anais23@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(175,2,0,0,0,0,'profile-175','Jamal Boehm','Arielle51@Dare.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(176,2,0,0,0,0,'profile-176','Millie Stroman','Annie.Leuschke@Zboncak.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(177,2,0,0,0,0,'profile-177','Savannah Weissnat','Emilie.Durgan@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(178,2,0,0,0,0,'profile-178','Lourdes Kshlerin','Mabelle25@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(179,2,0,0,0,0,'profile-179','Enrique Collier','Schowalter.Garth@Daniel.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(180,2,0,0,0,0,'profile-180','Margarett Mohr','Jayda35@Gislason.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(181,2,0,0,0,0,'profile-181','Haylee Mitchell','zBashirian@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(182,2,0,0,0,0,'profile-182','Kathlyn Bogisich','Christiansen.Emelia@Orn.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(183,2,0,0,0,0,'profile-183','Lavina Crona','vRenner@Watsica.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(184,2,0,0,0,0,'profile-184','Gussie Klocko','Efren.Funk@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(185,2,0,0,0,0,'profile-185','Conner Johnson','Kale.Hane@Schowalter.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(186,2,0,0,0,0,'profile-186','Abraham Mraz','nGrimes@Leuschke.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(187,2,0,0,0,0,'profile-187','Ardella Schimmel','rDurgan@Smitham.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(188,2,0,0,0,0,'profile-188','Evelyn Goodwin','xSipes@Sawayn.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(189,2,0,0,0,0,'profile-189','Ila Botsford','xLubowitz@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(190,2,0,0,0,0,'profile-190','Neha Wilkinson','Boyle.Toney@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(191,2,0,0,0,0,'profile-191','Allie Dickinson','Lavon.Crooks@Flatley.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(192,2,0,0,0,0,'profile-192','Delmer Gutmann','eDouglas@Greenholt.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(193,2,0,0,0,0,'profile-193','Freddie Borer','Misael97@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(194,2,0,0,0,0,'profile-194','Dan Hilpert','Yasmine.Schinner@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(195,2,0,0,0,0,'profile-195','Quinten Sauer','Greenholt.Ricardo@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(196,2,0,0,0,0,'profile-196','Liana Koch','zKing@Kertzmann.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(197,2,0,0,0,0,'profile-197','Dianna Wiegand','Aglae83@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(198,2,0,0,0,0,'profile-198','Johnnie Nolan','Teresa86@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(199,2,0,0,0,0,'profile-199','Mikel Beahan','Bahringer.Hollis@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(200,2,0,0,0,0,'profile-200','Liza Mraz','Brycen11@Bruen.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(201,2,0,0,0,0,'profile-201','Kendra Strosin','Donna13@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(202,2,0,0,0,0,'profile-202','Elyssa Kuhn','Deckow.Justen@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(203,2,0,0,0,0,'profile-203','Fae Quigley','bVeum@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(204,2,0,0,0,0,'profile-204','Theodore Littel','Price.Jettie@Runte.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(205,2,0,0,0,0,'profile-205','Leatha Stark','Eric.Treutel@Kohler.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(206,2,0,0,0,0,'profile-206','Merlin Schiller','Jess74@Kertzmann.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(207,2,0,0,0,0,'profile-207','Lindsey Beier','kRosenbaum@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(208,2,0,0,0,0,'profile-208','Elwin Mraz','Leann.Ward@Konopelski.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(209,2,0,0,0,0,'profile-209','Salma Dietrich','cLehner@Windler.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(210,2,0,0,0,0,'profile-210','Chloe Swaniawski','Austen80@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(211,2,0,0,0,0,'profile-211','Eliseo Corwin','bDaniel@Nicolas.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(212,2,0,0,0,0,'profile-212','Virgie Kuhn','Maurice65@Tromp.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(213,2,0,0,0,0,'profile-213','Caleb McCullough','mRunte@Lueilwitz.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(214,2,0,0,0,0,'profile-214','Gerard Huel','xOConnell@Gaylord.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(215,2,0,0,0,0,'profile-215','Bill Walker','Shanna76@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(216,2,0,0,0,0,'profile-216','Rowland Cremin','Rice.Efren@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(217,2,0,0,0,0,'profile-217','Julio Langosh','Kemmer.Ariane@Maggio.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(218,2,0,0,0,0,'profile-218','Jillian Krajcik','nVeum@Jacobi.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(219,2,0,0,0,0,'profile-219','Makayla Bradtke','tCrist@Dare.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(220,2,0,0,0,0,'profile-220','Donald Crist','Minerva.Corkery@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(221,2,0,0,0,0,'profile-221','Carli Leuschke','Julie.Boyer@Schmitt.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(222,2,0,0,0,0,'profile-222','Luciano Wisoky','Delta67@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(223,2,0,0,0,0,'profile-223','Lorenzo Kirlin','aOrn@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(224,2,0,0,0,0,'profile-224','Shanelle Mueller','Tamara.Glover@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(225,2,0,0,0,0,'profile-225','Rylee Borer','Anya43@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(226,2,0,0,0,0,'profile-226','Maia Howe','Torp.Aurelia@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(227,2,0,0,0,0,'profile-227','Nathen Jast','Ebony25@Upton.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(228,2,0,0,0,0,'profile-228','Dorris Dietrich','Breitenberg.Vicente@Beier.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(229,2,0,0,0,0,'profile-229','Kody Konopelski','Laurianne15@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(230,2,0,0,0,0,'profile-230','Garry Deckow','Flavio20@OConnell.org','en_US','GMT+7','2016-10-25 12:09:34'),
	(231,2,0,0,0,0,'profile-231','Celestine Lind','Vance.Hessel@Daniel.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(232,2,0,0,0,0,'profile-232','Mark Rosenbaum','Zulauf.Madalyn@Heaney.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(233,2,0,0,0,0,'profile-233','Grady Walker','yAbbott@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(234,2,0,0,0,0,'profile-234','Wilfrid Leuschke','wWilderman@Huels.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(235,2,0,0,0,0,'profile-235','Tad Smitham','Chauncey.McKenzie@Wolf.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(236,2,0,0,0,0,'profile-236','Dino Auer','Kyra.Langosh@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(237,2,0,0,0,0,'profile-237','Rosalyn Casper','Koby.Rosenbaum@Abshire.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(238,2,0,0,0,0,'profile-238','Guillermo Bauch','Emil.Durgan@Nicolas.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(239,2,0,0,0,0,'profile-239','Domenick Reinger','DAmore.Darrel@Larson.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(240,2,0,0,0,0,'profile-240','Lia Champlin','Jaden37@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(241,2,0,0,0,0,'profile-241','Melisa Dach','iBeer@Wyman.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(242,2,0,0,0,0,'profile-242','Emily O&#039;Keefe','gBaumbach@Purdy.net','en_US','GMT+7','2016-10-25 12:09:34'),
	(243,2,0,0,0,0,'profile-243','Gertrude Kuvalis','Josianne.Zulauf@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(244,2,0,0,0,0,'profile-244','Mara Bartell','Junius.Homenick@Rosenbaum.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(245,2,0,0,0,0,'profile-245','Leatha Eichmann','Collin.Jerde@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(246,2,0,0,0,0,'profile-246','Mckenna Feest','Molly10@Hills.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(247,2,0,0,0,0,'profile-247','Cecilia Kunde','kGulgowski@Waelchi.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(248,2,0,0,0,0,'profile-248','Kyla Kertzmann','Lelah53@Romaguera.org','en_US','GMT+7','2016-10-25 12:09:34'),
	(249,2,0,0,0,0,'profile-249','Magdalena Kautzer','Caleigh23@Russel.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(250,2,0,0,0,0,'profile-250','Reanna Schuppe','Kristy79@Swift.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(251,2,0,0,0,0,'profile-251','Justus Shanahan','Penelope55@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(252,2,0,0,0,0,'profile-252','Rosario Fahey','bHirthe@Schmitt.info','en_US','GMT+7','2016-10-25 12:09:34'),
	(253,2,0,0,0,0,'profile-253','Casimir Douglas','Steuber.Ellis@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(254,2,0,0,0,0,'profile-254','Vincenza Schuster','vYost@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(255,2,0,0,0,0,'profile-255','Earnest Wintheiser','qBailey@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(256,2,0,0,0,0,'profile-256','Kaleb Gorczany','Heathcote.Raven@Gleason.biz','en_US','GMT+7','2016-10-25 12:09:34'),
	(257,2,0,0,0,0,'profile-257','Sheila Bosco','Micah.Hauck@Marquardt.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(258,2,0,0,0,0,'profile-258','Henderson Ernser','Baumbach.Rogelio@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(259,2,0,0,0,0,'profile-259','Cathryn Schroeder','wKeeling@Veum.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(260,2,0,0,0,0,'profile-260','Lester Langworth','Braxton.Aufderhar@gmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(261,2,0,0,0,0,'profile-261','Alvena Goyette','iNienow@hotmail.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(262,2,0,0,0,0,'profile-262','Fern Kessler','Furman89@yahoo.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(263,2,0,0,0,0,'profile-263','Marcelo Kassulke','Rickie.Zboncak@Buckridge.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(431,2,0,1,0,0,'fb-1680771022212285','Van Luu','1680771022212285@fb','en_US','GMT+7','2016-10-27 13:33:51'),
	(807,1,0,0,0,0,'unit_test','Unit Test','unitest@example.com','en_US','GMT+7','2016-10-25 12:09:34'),
	(966,1,0,0,0,0,'auth_remote_unitest','Unit Test','auth_token.unitest@example.com','en_US','GMT+7','2016-10-25 12:09:34');

/*!40000 ALTER TABLE `pf5_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_user_verify_token
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_user_verify_token`;

CREATE TABLE `pf5_user_verify_token` (
  `token_id` varchar(52) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_id` int(11) unsigned NOT NULL,
  `reason` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `created_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_user_verify_token` WRITE;
/*!40000 ALTER TABLE `pf5_user_verify_token` DISABLE KEYS */;

INSERT INTO `pf5_user_verify_token` (`token_id`, `user_id`, `reason`, `created_at`, `expires_at`)
VALUES
	('03gxpml08xwoo98j',12,'verify_email','2017-02-15 16:18:14','2017-02-16 16:18:14'),
	('05mmm7yaarb8kc5o',12,'verify_email','2017-02-15 16:33:39','2017-02-16 16:33:39'),
	('0ryxj078stox7qfp',12,'verify_email','2017-02-15 16:43:33','2017-02-16 16:43:33'),
	('32px3mosrgrbf48v',12,'verify_email','2017-02-15 16:34:19','2017-02-16 16:34:19'),
	('3evb8xbczpc1atep',12,'verify_email','2017-02-15 16:19:40','2017-02-16 16:19:40'),
	('5o9f24rnsowv20se',12,'verify_email','2017-02-15 16:42:26','2017-02-16 16:42:26'),
	('61nrxsyuir95634m',12,'verify_email','2017-02-15 16:49:12','2017-02-16 16:49:12'),
	('62q39w1c594skv6l',12,'verify_email','2017-02-15 16:43:39','2017-02-16 16:43:39'),
	('6or28qc7oh8ay5xd',12,'verify_email','2017-02-15 16:34:52','2017-02-16 16:34:52'),
	('7e5uv4imi7g2p77o',12,'verify_email','2017-02-15 16:47:12','2017-02-16 16:47:12'),
	('7kyyqcvdscpe3nb8',12,'verify_email','2017-02-15 16:43:03','2017-02-16 16:43:03'),
	('8znou4pglnfa1aww',12,'verify_email','2017-02-15 16:58:08','2017-02-16 16:58:08'),
	('9yw5w2kbzbk9291o',12,'verify_email','2017-02-15 16:34:37','2017-02-16 16:34:37'),
	('ahevcizwz89fo5gz',12,'verify_email','2017-02-15 16:48:08','2017-02-16 16:48:08'),
	('aytqiekl353z13ph',12,'verify_email','2017-02-15 16:34:07','2017-02-16 16:34:07'),
	('cdw21bz5bwfhtckf',12,'verify_email','2017-02-15 16:18:39','2017-02-16 16:18:39'),
	('ckhi61f39wnsmivr',12,'verify_email','2017-02-15 16:55:54','2017-02-16 16:55:54'),
	('cq1oi63pgs30vjpk',12,'verify_email','2017-02-15 16:52:22','2017-02-16 16:52:22'),
	('d38vsf0y1k65ck06',12,'verify_email','2017-02-15 16:22:01','2017-02-16 16:22:01'),
	('d569cjd6a9bgxnq6',12,'verify_email','2017-02-15 17:09:56','2017-02-16 17:09:56'),
	('dwkun39jhg3yzvyw',12,'verify_email','2017-02-15 16:19:21','2017-02-16 16:19:21'),
	('fvjhrlomiwdomdpb',12,'verify_email','2017-02-15 16:08:28','2017-02-16 16:08:28'),
	('h4dgby0tvt5vfrx7',12,'verify_email','2017-02-15 16:41:55','2017-02-16 16:41:55'),
	('hlxi0b8cegder1oe',12,'verify_email','2017-02-15 16:07:30','2017-02-16 16:07:30'),
	('iainfnc7wgb8jmz1',12,'verify_email','2017-02-15 16:43:12','2017-02-16 16:43:12'),
	('kemoq07dh7f2xkny',12,'verify_email','2017-02-15 16:43:25','2017-02-16 16:43:25'),
	('kw3uhvd7cbn8ut8z',12,'verify_email','2017-02-15 16:26:33','2017-02-16 16:26:33'),
	('nnoh9cntt9mhuj08',12,'verify_email','2017-02-15 16:08:08','2017-02-16 16:08:08'),
	('q5j633n1b7m8wdnn',12,'verify_email','2017-02-16 06:32:51','2017-02-17 06:32:51'),
	('utfknhzdtxct9uuu',12,'verify_email','2017-02-15 16:15:31','2017-02-16 16:15:31'),
	('wu6236ku4nh9m5h1',12,'verify_email','2017-02-15 16:27:56','2017-02-16 16:27:56'),
	('xfk2q75izmiizg8s',12,'verify_email','2017-02-15 16:08:46','2017-02-16 16:08:46'),
	('y9bu1w26qa4grcib',12,'verify_email','2017-02-15 16:53:57','2017-02-16 16:53:57'),
	('ybrjmfvw7jedq6z3',12,'verify_email','2017-02-15 16:47:59','2017-02-16 16:47:59'),
	('yr70tk676oxmvhji',12,'verify_email','2017-02-15 16:33:52','2017-02-16 16:33:52'),
	('yttig2wfps27esn1',12,'verify_email','2017-02-15 16:48:57','2017-02-16 16:48:57');

/*!40000 ALTER TABLE `pf5_user_verify_token` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_video
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_video`;

CREATE TABLE `pf5_video` (
  `video_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_approval` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `category_id` int(11) unsigned NOT NULL DEFAULT '0',
  `provider_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `parent_type` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `poster_id` int(11) unsigned NOT NULL,
  `poster_type` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_video` WRITE;
/*!40000 ALTER TABLE `pf5_video` DISABLE KEYS */;

INSERT INTO `pf5_video` (`video_id`, `is_active`, `is_approval`, `category_id`, `provider_id`, `title`, `created_at`, `user_id`, `parent_id`, `parent_type`, `poster_id`, `poster_type`, `description`)
VALUES
	(14,1,1,4,'[youtube]','[title]','0000-00-00 00:00:00',44,45,'pages',434,'user','[description]');

/*!40000 ALTER TABLE `pf5_video` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_video_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_video_category`;

CREATE TABLE `pf5_video_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_video_category` WRITE;
/*!40000 ALTER TABLE `pf5_video_category` DISABLE KEYS */;

INSERT INTO `pf5_video_category` (`category_id`, `is_active`, `name`, `description`)
VALUES
	(1,1,'Film & Animation',NULL),
	(2,1,'Cars & Vehicles',NULL),
	(3,1,'Music',NULL),
	(4,1,'Pets & Animals',NULL),
	(5,1,'Sports',NULL),
	(6,1,'Travel & Events',NULL),
	(7,1,'Gaming',NULL),
	(8,1,'People & Blogs',NULL),
	(9,1,'Comedy',NULL),
	(10,1,'Entertainment',NULL),
	(11,1,'News & Politics',NULL),
	(12,1,'How-to & Style',NULL),
	(13,1,'Education',NULL),
	(14,1,'Science & Technology',NULL),
	(15,1,'Non-profits & Activism',NULL);

/*!40000 ALTER TABLE `pf5_video_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pf5_video_channel
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_video_channel`;

CREATE TABLE `pf5_video_channel` (
  `channel_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pf5_video_provider
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pf5_video_provider`;

CREATE TABLE `pf5_video_provider` (
  `provider_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `form_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `params` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `provider_class` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pf5_video_provider` WRITE;
/*!40000 ALTER TABLE `pf5_video_provider` DISABLE KEYS */;

INSERT INTO `pf5_video_provider` (`provider_id`, `name`, `form_name`, `description`, `is_active`, `params`, `provider_class`)
VALUES
	('facebook','Facebook','[example form name]','[example description]',1,'','Neutron\\Video\\Provider\\FacebookProvider'),
	('upload','Upload','[example form name]','[example description]',1,'','Neutron\\Video\\Provider\\UploadProvider'),
	('vimeo','Vimeo','[example form name]','[example description]',1,'','Neutron\\Video\\Provider\\VimeoProvider'),
	('youtube','YouTube','[example form name]','[example description]',1,'','Neutron\\Video\\Provider\\YoutubeProvider');

/*!40000 ALTER TABLE `pf5_video_provider` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
