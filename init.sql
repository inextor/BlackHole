
CREATE DATABASE IF NOT EXISTS blackhole;
use blackhole;
--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(15) NOT NULL,
  `data` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(50) CHARACTER SET utf8 NOT NULL,
  `external_id` varchar(50) DEFAULT NULL,
  `flags` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `content_type` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data` longtext CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyword_2` (`keyword`,`external_id`),
  KEY `keyword` (`keyword`),
  KEY `flags` (`flags`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
