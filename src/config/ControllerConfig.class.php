<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
 *
 * @author skiyo@me.com
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