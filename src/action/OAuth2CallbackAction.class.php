<?php
class OAuth2CallbackAction extends Action {
	protected function execute() {
		$api = GithubAPI::getInstance();
		if (!empty($_GET['code']) && !empty($_GET['state'])) {
			var_dump($api->getAccessToken($_GET['code'], $_GET['state']));
		} else {
			//
		}
		
	}
}