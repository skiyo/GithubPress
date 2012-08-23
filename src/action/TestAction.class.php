<?php
class TestAction extends Action {
	protected function execute() {
		$api = GithubAPI::getInstance();
		$content = $api->createRepos('1b3e75dc5818c58edf3da9ec4c7cd19bafca9ec6');
		var_dump($content);
	}
}