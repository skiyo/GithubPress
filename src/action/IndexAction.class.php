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
		$smarty = Punny::getSmarty();
		$smarty->assign('abc', 'aaa');
		$smarty->display('index.tpl');
	}
}