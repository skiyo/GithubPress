<?php
/**
 * Punny - The most easy-to-use PHP MVC framework
 * http://punny.skiyo.cn/
 *
 * Copyright (c) 2009 Jessica(董立强)
 * Licensed under the MIT license.
 *
 * @author Jessica<cndingo@qq.com>
 * @version $Id: DbMySQLi.class.php 332 2010-03-08 03:24:41Z jessica.dlq $
 */
class DbMySQLi extends Database {

	/**
	 * 初始化
	 *
	 * @global array $PunnyConfig
	 */
	public function __construct() {
		global $PunnyConfig;
		//连接数据库
		$this->link = $this->connect();
		if($this->link) {
			//选择数据库
			$this->selectDatabase($PunnyConfig['Database']['dbname']);
			//设置编码
			$this->execute("SET NAMES '{$PunnyConfig['Database']['charset']}'");
			//设置sql_mode
			$this->execute("SET sql_mode=''");
			//获取缓存实例
			$this->getCache();
		} else {
			throw new PunnyException('无法连接到数据库:' . $this->getError());
		}
	}

	/**
	 * 连接数据库
	 */
	public function connect() {
		
	}

	/**
	 * 选择数据库
	 *
	 * @param string $database
	 */
	public function selectDatabase($database) {
		
	}

	/**
	 * 执行一条SQL查询语句 返回资源标识符
	 *
	 * @param string $sql
	 */
	public function query($sql) {
		
	}

	/**
	 * 执行一条SQL语句 返回似乎执行成功
	 *
	 * @param string $sql
	 */
	public function execute($sql) {

	}

	/**
	 * 从结果集中取出数据
	 *
	 * @param resource $rs
	 */
	protected function fetch($rs) {

	}

	/**
	 * 执行INSERT命令.返回AUTO_INCREMENT
	 * 返回0为没有插入成功
	 *
	 * @param string $sql  SQL语句
	 * @access public
	 * @return integer
	 */
	public function insert($sql) {

	}

	/**
	 * 释放结果集
	 *
	 * @param resource $rs 结果集
	 * @access protected
	 * @return boolean
	 */
	protected function free($rs) {

	}

	/**
	 * 关闭数据库
	 *
	 * @access public
	 * @return boolean
	 */
	public function close() {

	}

	/**
	 * 获取错误信息
	 *
	 * @return void
	 * @access public
	 */
	public function getError() {
		
	}
	
}