CREATE TABLE IF NOT EXISTS `issues` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` VARCHAR(50) DEFAULT NULL,
`body` text,
`created` datetime DEFAULT NULL,
`modified` datetime DEFAULT NULL,
`comment_id` INT(11) NOT NULL,
`author` VARCHAR(255) NOT NULL,
`answers` INT(11) NOT NULL,
`tags` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`username` VARCHAR(50) DEFAULT NULL,
`password` VARCHAR(50) DEFAULT NULL,
`role` VARCHAR(20) DEFAULT NULL,
`created` datetime DEFAULT NULL,
`modified` datetime DEFAULT NULL,
`email` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `email` (`email`),
UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'name', '_user_'),
(3, 'time', '600'),
(5, 'path', '/'),
(6, 'secure', 'false'),
(7, 'domain', 'bugcake.com'),
(8, 'httpOnly', 'false'),
(9, 'key', 'qSI232qs*&sfytf65r6fc9-+!@#HKis~#^'),
(10, 'admin', 'true');