<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
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
	'GithubPressConfig' => SRC_ROOT . 'config/GithubPressConfig.class.php',
	'Smarty' => SRC_ROOT . 'libs/smarty/Smarty.class.php',
	'OAuth2Client' => SRC_ROOT . 'libs/oauth2/OAuth2Client.class.php',
	'Markdown' => SRC_ROOT . 'libs/Markdown.class.php',
	'Cookie' => SRC_ROOT . 'libs/Cookie.class.php',
	'FeedItem' => SRC_ROOT . 'libs/feed/FeedItem.class.php',
	'FeedWriter' => SRC_ROOT . 'libs/feed/FeedWriter.class.php',
);

function punny_autoload($class) {
	global $libs;
	if(isset($libs[$class])) {
		require_once($libs[$class]);
	}
}

function model_autoload($class) {
	require_once(SRC_ROOT . "model/$class.class.php");
}

spl_autoload_register('punny_autoload');
spl_autoload_register('model_autoload');

new Punny();