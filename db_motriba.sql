# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.6.35)
# Database: db_motriba
# Generation Time: 2019-10-29 02:46:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin
# ------------------------------------------------------------

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table countries
# ------------------------------------------------------------

CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` tinytext NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table country_ip
# ------------------------------------------------------------

CREATE TABLE `country_ip` (
  `begin_ip` char(15) NOT NULL DEFAULT '',
  `end_ip` char(15) NOT NULL DEFAULT '',
  `begin_num` int(10) unsigned NOT NULL,
  `end_num` int(10) unsigned NOT NULL,
  `code` char(2) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='http://www.maxmind.com/\nfile name: GeoIP-103_20120306.csv';



# Dump of table ip_address
# ------------------------------------------------------------

CREATE TABLE `ip_address` (
  `idtable` bigint(11) NOT NULL AUTO_INCREMENT COMMENT 'table id',
  `ip` bigint(20) unsigned NOT NULL COMMENT 'ip adress',
  `maxcount` int(1) NOT NULL COMMENT 'how many times the ip was used',
  `id_person` int(11) NOT NULL COMMENT 'id person voted for',
  PRIMARY KEY (`idtable`),
  KEY `ip` (`ip`),
  KEY `id_person` (`id_person`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='this table will be to store ip adress temporary';



# Dump of table person
# ------------------------------------------------------------

CREATE TABLE `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `wlink` varchar(500) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `countryid` int(11) NOT NULL,
  `defult` enum('TRUE','FALSE') NOT NULL,
  `active` enum('TRUE','FALSE') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `countryid` (`countryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table site
# ------------------------------------------------------------

CREATE TABLE `site` (
  `active` tinyint(1) NOT NULL,
  `id_table` int(11) NOT NULL,
  `maxip` int(11) NOT NULL DEFAULT '5',
  `today` date NOT NULL,
  KEY `id_table` (`id_table`),
  KEY `id_table_2` (`id_table`),
  KEY `id_table_3` (`id_table`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='site properties ';



# Dump of table stats
# ------------------------------------------------------------

CREATE TABLE `stats` (
  `idtable` int(11) NOT NULL AUTO_INCREMENT,
  `personid` int(11) NOT NULL,
  `inlike` int(11) NOT NULL,
  `inhate` int(11) NOT NULL,
  `outlike` int(11) NOT NULL,
  `outhate` int(11) NOT NULL,
  `date` date NOT NULL,
  UNIQUE KEY `idtable` (`idtable`),
  KEY `personid` (`personid`),
  KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='table for permanent stats ';



# Dump of table stats_temp
# ------------------------------------------------------------

CREATE TABLE `stats_temp` (
  `personid` int(11) NOT NULL,
  `inlike` int(11) NOT NULL,
  `inhate` int(11) NOT NULL,
  `outlike` int(11) NOT NULL,
  `outhate` int(11) NOT NULL,
  KEY `personid` (`personid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
