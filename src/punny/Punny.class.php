<?php
/**
 * bai.lu
 * Copyright (c) 2011 bai.lu
 *
 * 网站主进程管理
 *
 * @author dongliqiang<jessica.dlq@gmail.com>
 * @version $Id: Punny.class.php 14 2011-01-09 12:36:44Z jessica.dlq $
 */
class Punny {

	/**
	 * 实例
	 * 
	 * @var array
	 */
	protected static $instances = array();

	/**
	 * core
	 */
	public function __construct() {
		//设置编码
		header ( "Content-type: text/html;charset=UTF-8" );

		//设置时区
		date_default_timezone_set('Asia/Chongqing');

		//不进行魔术过滤
		set_magic_quotes_runtime(0);

		//开启页面压缩
		function_exists('ob_gzhandler') ? ob_start('ob_gzhandler') : ob_start();

		//页面报错
		error_reporting(E_ALL);
		
		//session
		session_start();
		
		//Router
		new Controller();
	}

	/**
	 * 获取数据库连接实例
	 *
	 * @return objeact
	 * @access public
	 * @static
	 */
	public final static function getDB() {
		if(empty(self::$instances['db'])) {
			self::$instances['db'] = DatabaseDriver::getInstance();
		}
		return self::$instances['db'];
	}

	/**
	 * 获取模板引擎实例
	 *
	 * @return object
	 * @access public
	 * @static
	 */
	public final static function getSmarty() {
		if(empty(self::$instances['smarty'])) {
			self::$instances['smarty'] = new Smarty();
			self::$instances['smarty']->template_dir = ROOT . 'template/templates';
			self::$instances['smarty']->compile_dir  = ROOT . 'template/templates_c';
			self::$instances['smarty']->config_dir = ROOT . 'template/config';
			self::$instances['smarty']->cache_dir = ROOT . 'template/cache';
		}
		return self::$instances['smarty'];
	}

}