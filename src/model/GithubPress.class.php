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
		$user = new User();
		$is_registed = $user->getUserByGid($user_info['id']);
		if ($is_registed) {
			Cookie::set('gpu', $user_info['id']);
		} else {
			throw new Exception("");
		}
		//$email = $api->getEmails($access_token);
	}
	
	
	
}