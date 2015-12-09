/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50172
Source Host           : localhost:3306
Source Database       : wlcha

Target Server Type    : MYSQL
Target Server Version : 50172
File Encoding         : 65001

Date: 2015-12-09 17:04:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wy_order
-- ----------------------------
DROP TABLE IF EXISTS `wy_order`;
CREATE TABLE `wy_order` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `creattime` int(30) DEFAULT NULL,
  `edittime` int(10) DEFAULT NULL,
  `uid` int(10) NOT NULL,
  `state` int(2) DEFAULT '1',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wy_order
-- ----------------------------
INSERT INTO `wy_order` VALUES ('1', 'LEAD887', '<p>									</p><p><br/></p><p>\r\n									1449631862sss</p><p><br/></p><p>								</p>', '1449631862', '1449644892', '1', '1');
INSERT INTO `wy_order` VALUES ('2', 'LEAD887', 'ssss', null, null, '1', '2');
INSERT INTO `wy_order` VALUES ('3', '8888888', '<p>									</p><p><img src=\"/upload/image/20151209/1449647447111534.png\" title=\"1449647447111534.png\" alt=\"scrawl.png\"/></p><p>								</p>', '1449646331', '1449647450', '1', '1');
INSERT INTO `wy_order` VALUES ('4', '888888s', '<p>fdsafdsafsda</p>', '1449647339', null, '1', '1');

-- ----------------------------
-- Table structure for wy_user
-- ----------------------------
DROP TABLE IF EXISTS `wy_user`;
CREATE TABLE `wy_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `nikname` varchar(255) DEFAULT NULL,
  ` logintime` varchar(30) DEFAULT NULL,
  ` loginsut` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wy_user
-- ----------------------------
INSERT INTO `wy_user` VALUES ('1', '_admin', 'be56e057f20f883e', ' 管理员', '1449641066', '1');
