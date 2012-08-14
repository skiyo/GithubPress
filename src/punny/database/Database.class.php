<?php
/**
 * Punny - The most easy-to-use PHP MVC framework
 * http://punny.skiyo.cn/
 *
 * Copyright (c) 2009 Jessica(董立强)
 * Licensed under the MIT license.
 *
 * @author Jessica<cndingo@qq.com>
 * @version $Id: Database.class.php 362 2010-05-18 01:39:55Z jessica.dlq $
 */
abstract class Database {

	/**
	 * 数据库连接标识
	 * 
	 * @var resource
	 */
	protected $link;
	
    /**
	 * 执行SQL语句的次数
	 *
	 * @var integer
	 * @access protected
	 */
	protected $queryNum = 0;

	/**
	 * 上一次事物是否执行成功
	 * 
	 * @var bool
	 * @access protected
	 */
	protected $success = true;

	/**
	 * 连接数据库
	 */
	public abstract function connect();

	/**
	 * 选择数据库
	 * 
	 * @param string $database
	 */
	public abstract function selectDatabase($database);

	/**
	 * 执行一条SQL查询语句 返回资源标识符
	 * 
	 * @param string $sql
	 */
	public abstract function query($sql);

	/**
	 * 执行一条SQL语句 返回似乎执行成功
	 *
	 * @param string $sql
	 */
	public abstract function execute($sql);

	/**
	 * 从结果集中取出数据
	 * 
	 * @param resource $rs
	 */
	protected abstract function fetch($rs);

	/**
	 * 执行INSERT命令.返回AUTO_INCREMENT
	 * 返回0为没有插入成功
	 *
	 * @param string $sql  SQL语句
	 * @access public
	 * @return integer
	 */
	public abstract function insert($sql);

	/**
	 * 释放结果集
	 *
	 * @param resource $rs 结果集
	 * @access protected
	 * @return boolean
	 */
	protected abstract function free($rs);

	/**
	 * 关闭数据库
	 *
	 * @access public
	 * @return boolean
	 */
	public abstract function close();

	/**
	 * 获取错误信息
	 *
	 * @return void
	 * @access public
	 */
	public abstract function getError();

	/**
	 * 获取执行SQL语句的个数
	 *
	 * @access public
	 * @return integer
	 */
	public function getQueryNum() {
		return $this->queryNum;
	}

	/**
	 * 得到结果集的第一个数据
	 *
	 * @param string $sql   SQL语句
	 * @access public
	 * @return mixed
	 */
	public function getOne($sql) {
		if (!$rs = $this->query($sql)) {
			return false;
		}
		$row = $this->fetch($rs);
		$this->free($rs);
		return is_array($row) ? array_shift($row) : $row;
	}

	/**
	 * 返回结果集的一行
	 *
	 * @param string $sql  SQL语句
	 * @access public
	 * @return array
	 */
	public function getRow($sql) {
		if (!$rs = $this->query($sql)) {
			return false;
		}
		$row = $this->fetch($rs);
		$this->free($rs);
		return $row;
	}

	/**
	 * 返回所有结果集
	 *
	 * @param string $sql   SQL语句
	 * @access public
	 * @return mixed
	 */
	public function getAll($sql) {
		if (!$rs = $this->query($sql)) {
			return false;
		}
		$all_rows = array();
		while($rows = $this->fetch($rs)) {
			$all_rows[] = $rows;
		}
		$this->free($rs);
		return $all_rows;
	}

	/**
	 * 获取上次事物是否执行成功
	 * 
	 * @return bool
	 */
	public function isSuccess() {
		return $this->success;
	}

}