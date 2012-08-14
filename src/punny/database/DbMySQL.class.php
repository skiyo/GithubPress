<?php
/**
 * Punny - The most easy-to-use PHP MVC framework
 * http://punny.skiyo.cn/
 *
 * Copyright (c) 2009 Jessica(董立强)
 * Licensed under the MIT license.
 *
 * @author Jessica<cndingo@qq.com>
 * @version $Id: DbMySQL.class.php 332 2010-03-08 03:24:41Z jessica.dlq $
 */
class DbMySQL extends Database {

	/**
	 * 初始化
	 *
	 * @global array $PunnyConfig
	 */
	public function __construct() {
		//连接数据库
		$this->link = $this->connect();
		if($this->link) {
			//选择数据库
			$this->selectDatabase(BailuConfig::DB_NAME);
			//设置编码与sql_mode
			mysql_query("SET NAMES '" . BailuConfig::DB_CHARSET . "', sql_mode=''", $this->link);
		}
	}

	/**
	 * 连接数据库
	 *
	 * @global array $PunnyConfig
	 * @return bool
	 */
	public function connect() {
		return mysql_connect(BailuConfig::DB_HOST, BailuConfig::DB_USER, BailuConfig::DB_PASSWORD, true);
	}

	/**
	 * 选择数据库
	 *
	 * @param string $database
	 * @return bool
	 */
	public function selectDatabase($database) {
		return mysql_select_db($database, $this->link);
	}

	/**
	 * 执行一条SQL查询语句 返回资源标识符
	 *
	 * @param string $sql
	 */
	public function query($sql) {
		$rs = mysql_query($sql, $this->link);
		if ($rs) {
			$this->queryNum++;
			return $rs;
		} else {
			$this->success = false;
			return false;
		}
	}

	/**
	 * 执行一条SQL语句 返回似乎执行成功
	 *
	 * @param string $sql
	 */
	public function execute($sql) {
		if (mysql_query($sql, $this->link)) {
			$this->queryNum++;
			return true;
		} else {
			$this->success = false;
			return false;
		}
	}

	/**
	 * 从结果集中取出数据
	 *
	 * @param resource $rs
	 */
	protected function fetch($rs) {
		return mysql_fetch_array($rs, MYSQL_ASSOC);
	}

	/**
	 * 开始事务
	 *
	 * @return bool
	 */
	public function startTrans() {
		return $this->execute('START TRANSACTION');
	}

	/**
	 * 提交事务
	 *
	 * @return bool
	 */
	public function commit() {
		return $this->execute('COMMIT');
	}

	/**
	 * 回滚事务
	 *
	 * @return bool
	 */
	public function rollback() {
		return $this->execute('ROLLBACK');
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
		$this->execute($sql);
		return mysql_insert_id($this->link);
	}

	/**
	 * 释放结果集
	 *
	 * @param resource $rs 结果集
	 * @access protected
	 * @return boolean
	 */
	protected function free($rs) {
		return mysql_free_result($rs);
	}

	/**
	 * 关闭数据库
	 *
	 * @access public
	 * @return boolean
	 */
	public function close() {
		return mysql_close($this->link);
	}

	/**
	 * 获取错误信息
	 *
	 * @return void
	 * @access public
	 */
	public function getError() {
		return mysql_errno($this->link) . " : " . mysql_error($this->link);
	}

}