<?php
class OAuth2CallbackAction extends Action {
	protected function execute() {
		$api = GithubAPI::getInstance();
		var_dump($api->getAccessToken($_GET['code'], $_GET['state']));
	}
}