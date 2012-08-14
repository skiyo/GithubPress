<?php
/**
 * bai.lu
 * Copyright (c) 2011 bai.lu
 *
 * 核心控制器
 *
 * @author dongliqiang<jessica.dlq@gmail.com>
 * @version $Id$
 */
class Controller{

	/**
	 * URL
	 *
	 * @var string
	 */
	protected $url = '';

	/**
	 * URL 参数 正则解析出来的参数
	 *
	 * @var array
	 */
	protected $url_params = array();

	/**
	 * Action 参数
	 *
	 * @var array
	 */
	protected $action = array();

	/**
	 * 构造函数.
	 *
	 * @return void
	 * @access public
	 */
	public function __construct() {
		if(strpos($_SERVER['REQUEST_URI'], '?') === false) {
			//没有寻找到?
			$this->url = $_SERVER['REQUEST_URI'];
		} else {
			list($this->url, $get_params) = explode('?', $_SERVER['REQUEST_URI']);
		}
		$this->parseHashRouter();
		empty($this->action) && $this->parseRegexRouter();
		//找不到Action就去默认执行hash的最后一个Action 所以一般将hash的最后一个Action设置为404页面
		if(empty($this->action)) {
			$this->action = array_pop(ControllerConfig::$router['hash']);
		}
		empty($get_params) ? $_GET = array() : parse_str($get_params, $_GET);
		$this->execute();
	}

	/**
	 * 解析正则router
	 */
	protected function parseRegexRouter() {
		foreach(ControllerConfig::$router['regex'] as $regex_url => $action) {
			if(preg_match_all($regex_url, $this->url, $this->url_params, PREG_PATTERN_ORDER)) {
				$this->action = $action;
			}
		}
	}

	/**
	 * 解析hash router
	 */
	protected function parseHashRouter() {
		foreach(ControllerConfig::$router['hash'] as $hash_url => $action) {
			if($hash_url == $this->url) {
				$this->action = $action;
			}
		}
	}

	/**
	 * 执行Action
	 */
	protected function execute() {
		foreach($this->action['action'] as $action) {
			require_once(SRC_ROOT . '/action/' . $action . '.class.php');
			if(empty($this->url_params[1])) {
				new $action($this->action['params']);
			} else {
				new $action($this->action['params'], $this->url_params[1]);
			}
		}
	}
}