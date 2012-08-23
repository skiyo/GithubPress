<?php

class OAuth2RequestAuthorizeAction extends Action {
	
	protected function execute() {
		$api = GithubAPI::getInstance();
		$api->authorize();
	}
	
}