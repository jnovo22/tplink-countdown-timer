
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tplink_devices`
-- ----------------------------
DROP TABLE IF EXISTS `tplink_devices`;
CREATE TABLE `tplink_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `timer_remaining` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


