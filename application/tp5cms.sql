/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 5.7.26 : Database - tp5cms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tp5cms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `tp5cms`;

/*Table structure for table `tp5_category` */

DROP TABLE IF EXISTS `tp5_category`;

CREATE TABLE `tp5_category` (
  `cateid` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `catename` varchar(50) NOT NULL DEFAULT '新建栏目',
  `parentid` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `typeid` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '栏目类型',
  `moduleid` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '内容模型',
  `englishdir` varchar(50) NOT NULL DEFAULT 'dir',
  `image` varchar(100) DEFAULT NULL,
  `url` varchar(100) NOT NULL DEFAULT '',
  `desc` mediumtext,
  `listorder` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `letter` varchar(30) NOT NULL,
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`cateid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tp5_category` */

insert  into `tp5_category`(`cateid`,`catename`,`parentid`,`typeid`,`moduleid`,`englishdir`,`image`,`url`,`desc`,`listorder`,`letter`,`display`) values 
(1,'走进松山',0,1,1,'dir','','welcome','',0,'',1),
(2,'政府信息',0,1,1,'dir','','','',0,'',1);

/*Table structure for table `tp5_category_type` */

DROP TABLE IF EXISTS `tp5_category_type`;

CREATE TABLE `tp5_category_type` (
  `typeid` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `typename` varchar(40) NOT NULL DEFAULT '新建栏目类型',
  `disable` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tp5_category_type` */

insert  into `tp5_category_type`(`typeid`,`typename`,`disable`) values 
(1,'内部栏目',1),
(2,'外部链接',1),
(3,'单网页',1);

/*Table structure for table `tp5_menu` */

DROP TABLE IF EXISTS `tp5_menu`;

CREATE TABLE `tp5_menu` (
  `menuid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `menuname` char(40) NOT NULL DEFAULT '新建菜单',
  `menuicon` varchar(40) DEFAULT NULL,
  `parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `route` varchar(50) NOT NULL DEFAULT '/',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`menuid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `tp5_menu` */

insert  into `tp5_menu`(`menuid`,`menuname`,`menuicon`,`parentid`,`route`,`listorder`,`display`) values 
(1,'管理员管理','fa fa-home',0,'manage',0,1),
(2,'系统管理','fa fa-home',0,'system',0,1),
(3,'个人资料','fa fa-home',1,'profile',0,1),
(4,'修改密码','fa fa-home',1,'editPwd',1,1),
(5,'账号管理','fa fa-home',1,'manage',0,1),
(6,'角色管理','fa fa-home',1,'role',0,1),
(7,'系统设置','fa fa-home',2,'setting',0,1),
(8,'菜单管理','fa fa-home',2,'menu',0,1),
(9,'会员管理','fa fa-home',0,'member',0,1),
(10,'成员管理','fa fa-home',9,'memberlist',0,1),
(11,'会员组管理','fa fa-home',9,'membergroup',0,1),
(12,'参数设置','fa fa-home',7,'paramSetting',0,1),
(13,'微信设置','fa fa-home',7,'weixinSetting',0,1),
(14,'微博设置','fa fa-home',7,'weiboSetting',0,1),
(15,'内容管理','fa fa-home',0,'article',0,1),
(16,'发布管理','fa fa-home',15,'articlePublish',0,1),
(17,'生成首页','fa fa-home',16,'produceIndex',0,1),
(18,'批量更新URL','fa fa-home',16,'updateUrl',0,1),
(19,'批量更新内容','fa fa-home',16,'ceshi',0,1),
(20,'增加菜单','fa fa-home',8,'ceshi',0,1),
(21,'编辑菜单','fa fa-home',8,'测试',0,1),
(22,'删除菜单','fa fa-home',8,'ceshi',0,1),
(23,'相关设置','fa fa-home',15,'ceshi',0,1),
(24,'管理栏目','fa fa-home',23,'ceshi',0,1),
(25,'模型管理','fa fa-home',23,'ceshi',0,1),
(26,'推荐位管理','fa fa-home',23,'ceshi',0,1);

/*Table structure for table `tp5_module` */

DROP TABLE IF EXISTS `tp5_module`;

CREATE TABLE `tp5_module` (
  `moduleid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `modulename` varchar(40) NOT NULL DEFAULT '新建模型',
  `disable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`moduleid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tp5_module` */

insert  into `tp5_module`(`moduleid`,`modulename`,`disable`) values 
(1,'文章模型',1),
(2,'图片模型',1),
(3,'视频模型',1);

/*Table structure for table `tp5_module_field` */

DROP TABLE IF EXISTS `tp5_module_field`;

CREATE TABLE `tp5_module_field` (
  `fieldid` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(50) NOT NULL,
  `fieldenname` varchar(30) NOT NULL,
  `moduleid` smallint(6) unsigned NOT NULL,
  `fieldtype` tinyint(2) unsigned NOT NULL,
  `data` mediumtext,
  PRIMARY KEY (`fieldid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tp5_module_field` */

/*Table structure for table `tp5_role` */

DROP TABLE IF EXISTS `tp5_role`;

CREATE TABLE `tp5_role` (
  `roleid` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `rolename` varchar(20) NOT NULL DEFAULT '新建角色',
  `desc` mediumtext,
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `disable` smallint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tp5_role` */

insert  into `tp5_role`(`roleid`,`rolename`,`desc`,`listorder`,`disable`) values 
(1,'超级管理员','系统管理员',0,1),
(2,'主编','主编',0,1),
(3,'编辑','编辑',0,0);

/*Table structure for table `tp5_user` */

DROP TABLE IF EXISTS `tp5_user`;

CREATE TABLE `tp5_user` (
  `userid` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `encrypt` varchar(10) DEFAULT NULL,
  `roleid` smallint(5) unsigned DEFAULT '0',
  `lastloginip` varchar(10) DEFAULT NULL,
  `lastlogintime` int(15) unsigned DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `tp5_user` */

insert  into `tp5_user`(`userid`,`username`,`password`,`encrypt`,`roleid`,`lastloginip`,`lastlogintime`,`realname`,`email`) values 
(2,'admin','2a85dee120683e43c7004371aa0d58bf','sBMBuU',1,'0.0.0.0',1579329425,'uncle-z','916103108@qq.com'),
(3,'admin1','5f32d277935539d73ae2524c6c639820','hQBAcP',2,'0.0.0.0',1577937598,NULL,NULL),
(4,'云联小编','0dd7241f835ad419fd3d7c2c6a606b75','swAuIU',3,'0.0.0.0',1578100369,NULL,NULL),
(5,'张三','f8dd600f516803f83c0b68fd9960097b','lCK2M9',3,NULL,0,'测试','916103108@qq.com'),
(6,'李四','0c0fadabe609a229a31ad0b077676f7a','q99fvP',2,NULL,0,'测试啊啊啊','11@qq.com'),
(9,'还有谁','1ede4f9b5541d1812ecf87c56bf183bc','azQqfM',3,NULL,0,'呃呃呃呃呃','啛啛喳喳错'),
(11,'我的老妹','0fdf9c345f4a4c145179ec541d7c5567','v4Ha1Z',3,NULL,0,'顶顶顶顶','柔柔弱弱'),
(13,'火烈鸟','cb834b4a9d7ce600c763742a183c3caa','mBGuD5',2,NULL,0,'水电费水电费','苏打水');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
