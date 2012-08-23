<?php
/**
 * bai.lu
 * Copyright (c) 2011 bai.lu
 *
 * 鎺у埗鍣ㄨ矾鐢遍厤缃�
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
	'/oauth2/request_authorize' => array(
		'action' => array(
			'OAuth2RequestAuthorizeAction',
		),
		'params' => array(),
	),
	'/oauth2/callback' => array(
		'action' => array(
			'OAuth2CallbackAction',
		),
		'params' => array(),
	),
	'/test' => array(
		'action' => array(
			'TestAction',
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