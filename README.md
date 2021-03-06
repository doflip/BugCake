BugCake Plugin for CakePHP
=======

BugCake is an open source minimalistic bug/issue tracking plugin, developed using the CakePHP framework. Though it was developed as a CakePHP plugin, it can also be transformed and deployed with ease as a standalone bug/issue tracker.

### Pictures
For more pictures take a look [here](https://github.com/intelligems/BugCake/wiki/Pictures)

![Picture 1](https://dl.dropboxusercontent.com/u/162584646/bug1.png)


###Instructions
Create a folder named BugCake(app/Plugin)
and move in this folder the BugCake files
Do not forget to load the plugin in your bootstrap.php file.
You can do that just by adding 
```php
CakePlugin::loadAll();
```
Then, access the plugin controllers as in the example:
`http://host/bug_cake/issues`

###Standalone deployment Instructions
Install the latest version of the CakePHP framework and correctly configure the database (see the installation instructions below for more detailed information).
Into the folder `APP/Plugin`, clone the BugCake plugin repository. Then practically you have successfully deployed a standalone BugCake web application. You may access your bug tracker via `http://yourhost/bug_cake`.


### Installation
It is highly extendable, like any CakePHP web app. By default it makes use of the MySQL database, which you have to correctly set when installing the web app:
Rename `app/Config/database.php.default` to `app/Config/database.php` and change the following snipet, according to your database server credentials:

```php
public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'user',
        'password' => 'password',
        'database' => 'database_name',
        'prefix' => '',
        //'encoding' => 'utf8',
);
```

After that, you should create the MySQL tables into your database. The recommended  structure is the following:

```sql
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

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `author` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `issue_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
```


In the `Controller/UsersController.php` file, there is a company-inside limitation for users' registration (by default, we require a intelligems corporal e-mail account), which is (by default) commented out. We recommend to uncomment these lines and fix them to suit your needs, especially if you do use the bug/issue tracking plugin in an enterprise environment.

Developed from intelligems in-house software dev team with love.
