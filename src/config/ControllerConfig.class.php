<?php
/**
 * bai.lu
 * Copyright (c) 2011 bai.lu
 *
 * 控制器路由配置
 *
 * @author dongliqiang<jessica.dlq@gmail.com>
 * @version $Id: ControllerConfig.class.php 20 2011-01-13 09:33:04Z jessica.dlq $
 */
Class ControllerConfig {
	public static $router;
}

ControllerConfig::$router['regex'] = array(
	'#^/(.*$)#' => array(
		'action' => array(
			'GoAction',
		),
		'params' => array(),
	),
);

ControllerConfig::$router['hash'] = array(
	'/' => array(
		'action' => array(
			'IndexAction',
		),
		'params' => array(),
	),
	'/404' => array(
		'action' => array(
			'NotFoundAction',
		),
		'params' => array(),
	),
);