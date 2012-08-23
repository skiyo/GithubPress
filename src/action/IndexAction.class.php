<?php
/**
 * GithubPress
 * Copyright (c) 2011 bai.lu
 *
 * Index
 *
 * @author skiyo@me.com
 */
class IndexAction extends Action {
	protected function execute() {
		Cookie::set('test', '中文测试');
		var_dump($_COOKIE);
		echo Cookie::get('test');
	}
}