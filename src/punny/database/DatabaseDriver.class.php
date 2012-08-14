<?php
/**
 * Punny - The most easy-to-use PHP MVC framework
 * http://punny.skiyo.cn/
 *
 * Copyright (c) 2009 Jessica(董立强)
 * Licensed under the MIT license.
 *
 * @author Jessica<cndingo@qq.com>
 * @version $Id: DatabaseDriver.class.php 361 2010-05-17 09:19:39Z jessica.dlq $
 */
class DatabaseDriver {
    /**
	 * 数据库实例
	 *
	 * @var object
	 * @static
	 */
	protected static $instance = null;

	/**
	 * 取得缓存实例
	 *
	 * @return object
	 * @access public
	 * @static
	 */
	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new DbMySQL();
		}
		return self::$instance;
	}
}