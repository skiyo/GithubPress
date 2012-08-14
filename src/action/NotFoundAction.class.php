<?php
/**
 * GithubPress
 * Copyright (c) 2011 bai.lu
 *
 * 404
 *
 * @author skiyo@me.com
 */
class NotFoundAction extends Action {
    protected function execute() {
		$smarty = Punny::getSmarty();
		$smarty->display('404.tpl');
	}
}