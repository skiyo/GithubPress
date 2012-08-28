<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
 *
 * @author skiyo@me.com
 */
class TestAction extends Action {
	protected function execute() {
		$api = GithubAPI::getInstance();
		$content = $api->getEmails('ddede5aba68430f033646f6b8666c51d4483d896');
		var_dump($content);
	}
}