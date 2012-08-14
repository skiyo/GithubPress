<?php
/**
 * VeryCoder.Com
 * Copyright (c) 2010 VeryCoder.Com
 *
 * Action
 *
 * @author dongliqiang<jessica.dlq@gmail.com>
 * @version $Id: Action.class.php 20 2011-01-13 09:33:04Z jessica.dlq $
 */
class Action {

	/**
	 * Action参数
	 * 
	 * @var array
	 */
	protected $action_params = array();

	/**
	 * URL参数
	 * 
	 * @var array
	 */
	protected $url_params = array();

	/**
	 * 参数 初始化
	 */
	public final function __construct($action_params, $url_params = null) {
		empty($action_params) || $this->action_params = $action_params;
		empty($url_params) || $this->url_params = $url_params;
		$this->execute();
	}

	/**
	 * 执行Action
	 */
	protected function execute() {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->post();
		} else {
			$this->get();
		}
	}

	/**
	 * 覆盖此方法执行POST方法
	 */
	protected function post() {
		
	}

	/**
	 * 覆盖此方法执行GET方法
	 */
	protected function get() {
		
	}

}