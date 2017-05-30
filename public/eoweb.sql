/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.5.47 : Database - eoweb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`eoweb` /*!40100 DEFAULT CHARACTER SET gbk */;

USE `eoweb`;

/*Table structure for table `eo_food` */

DROP TABLE IF EXISTS `eo_food`;

CREATE TABLE `eo_food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '菜品名称',
  `insert_time` int(11) NOT NULL COMMENT '推出时间',
  `t_id` int(11) NOT NULL COMMENT '所属类型',
  `thumb` varchar(100) NOT NULL COMMENT '缩略图',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*Data for the table `eo_food` */

/*Table structure for table `eo_type` */

DROP TABLE IF EXISTS `eo_type`;

CREATE TABLE `eo_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '类型名称',
  `insert_time` int(11) NOT NULL COMMENT '推出时间',
  `status` enum('0','1','2','3') NOT NULL DEFAULT '1' COMMENT '0不用了，1正常，2推荐，3最佳',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk;

/*Data for the table `eo_type` */

insert  into `eo_type`(`id`,`name`,`insert_time`,`status`) values (1,'营养早餐系列',1494665305,'1'),(2,'面包类',1494665309,'1'),(3,'粥类',1494665605,'1'),(4,'粉类',1494667305,'1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
