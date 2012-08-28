<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
 *
 * @author skiyo@me.com
 */
class GithubPress {
	
	public function isLogin() {
		$user_github_id = Cookie::get('gpu');
		
	}
	
	/*
	public function regist() {
		
	}
	*/
	
	public function login($access_token) {
		$api = GithubAPI::getInstance();
		$user_info = $api->getUserInfo($access_token);
		$email = $api->getEmails($access_token);
		//Cookie::set('gpu', $user_info['']);
	}
	
	
	
}