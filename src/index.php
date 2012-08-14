<?php
/**
 * GithubPress
 * Copyright (c) 2011 bai.lu
 *
 * 网站入口
 *
 * @author skiyo@me.com
 */
define ('SRC_ROOT', dirname(__FILE__) . '/');
define ('ROOT', dirname(__FILE__) . '/../');

$libs = array(
	'Punny' => SRC_ROOT . 'punny/Punny.class.php',
	'Controller' => SRC_ROOT . 'punny/Controller.class.php',
	'Action' => SRC_ROOT . 'punny/Action.class.php',
	'DatabaseDriver' => SRC_ROOT . 'punny/database/DatabaseDriver.class.php',
	'Database' => SRC_ROOT . 'punny/database/Database.class.php',
	'DbMySQL' => SRC_ROOT . 'punny/database/DbMySQL.class.php',
	'ControllerConfig' => SRC_ROOT . 'config/ControllerConfig.class.php',
	'BailuConfig' => SRC_ROOT . 'config/BailuConfig.class.php',
	'Smarty' => SRC_ROOT . 'libs/smarty/Smarty.class.php',
	'AuthToken' => SRC_ROOT . 'libs/google/AuthToken.class.php',
	'ShortURL' => SRC_ROOT . 'model/ShortURL.class.php',
);

function bailu_autoload($class) {
	global $libs;
	if(isset($libs[$class])) {
		require_once($libs[$class]);
	}
}

spl_autoload_register('bailu_autoload');

//开启网站进程
new Punny();