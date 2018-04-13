-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(255) DEFAULT NULL,
  `model_id` int(13) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `images` (`id`, `img_name`, `model_id`, `created_at`, `update_at`) VALUES
(1,	'1522433591525.png',	1,	'2018-03-30 18:13:11',	NULL),
(3,	'1522433757593.png',	3,	'2018-03-30 18:15:57',	NULL),
(4,	'1522433853424.png',	4,	'2018-03-30 18:17:33',	NULL);

DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE `manufacturer` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `manufacturer_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `manufacturer` (`id`, `name`, `created_at`, `update_at`) VALUES
(1,	'BMW',	'2018-03-30 18:12:21',	NULL),
(2,	'Maruti',	'2018-03-30 18:12:26',	NULL);

DROP TABLE IF EXISTS `models`;
CREATE TABLE `models` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `manufacturer_id` int(13) DEFAULT NULL,
  `reg_number` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `note` text,
  `sold_status` int(13) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `models` (`id`, `name`, `manufacturer_id`, `reg_number`, `color`, `year`, `note`, `sold_status`, `created_at`, `update_at`) VALUES
(1,	'X5',	1,	'MH 02 1881',	'RED',	'2012',	'THIS IS BMW X5. 2012 Model',	0,	'2018-03-30 18:13:11',	'2018-03-30 19:04:18'),
(2,	'X6',	1,	'MH 43 5555',	'BLACK',	'2005',	'BMW X6. 2005 Model.\r\n\r\nMH 43 5555',	0,	'2018-03-30 18:14:13',	'2018-03-30 19:37:59'),
(3,	'X6',	1,	'MH 33 3243',	'Orange',	'2008',	'This is BMW\'s X6 2008 Model.\r\n\r\nMH 33 3243',	0,	'2018-03-30 18:15:56',	'2018-03-30 19:38:21'),
(4,	'X12',	1,	'MH 222',	'Chrome',	'Vintage',	'X12 BMW Vintage model.\r\nMH 222 (Chrome Color)',	0,	'2018-03-30 18:17:33',	'2018-03-30 19:38:21');

-- 2018-03-30 19:44:59