<?php
class TestAction extends Action {
	protected function execute() {
		$api = GithubAPI::getInstance();
		$content = $api->getUserInfo('5946c4cfd43bb39a2191dac9201719b2b1f133bc');
		var_dump($content);
	}
}