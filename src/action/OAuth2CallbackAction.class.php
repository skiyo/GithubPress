<?php
class OAuth2CallbackAction extends Action {
	protected function execute() {
		$api = GithubAPI::getInstance();
		$api->getAccessToken($_GET['code'], $_GET['state']);
	}
}