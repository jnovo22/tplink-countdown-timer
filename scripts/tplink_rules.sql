SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tplink_rules`
-- ----------------------------
DROP TABLE IF EXISTS `tplink_rules`;
CREATE TABLE `tplink_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` int(11) DEFAULT NULL,
  `rule_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


