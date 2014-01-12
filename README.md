BugCake Plugin for CakePHP
=======

BugCake is an open source minimalistic bug/issue tracking plugin, developed using the CakePHP framework. Though it was developed as a CakePHP plugin, it can also be transformed and deployed with ease as a standalone bug/issue tracker.

### Pictures
For more pictures take a look [here](https://github.com/lubbleup/BugCake/wiki/Pictures)


[![Build Status](https://travis-ci.org/lubbleup/BugCake.png?branch=master)](https://travis-ci.org/lubbleup/BugCake)
![Picture 1](https://dl.dropboxusercontent.com/u/162584646/bug1.png)


###Instructions
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8_unicode_ci AUTO_INCREMENT=1 ;
```


In the `Controller/UsersController.php` file, there is a company-inside limitation for users' registration (by default, we require a LubbleUp corporal e-mail account), which is (by default) commented out. We recommend to uncomment these lines and fix them to suit your needs, especially if you do use the bug/issue tracking plugin in an enterprise environment.

Developed from LubbleUp in-house software dev team with love.
Contact: talk2us@lubbleup.com
