

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tplink_main`
-- ----------------------------
DROP TABLE IF EXISTS `tplink_main`;
CREATE TABLE `tplink_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

