<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
 *
 * @author skiyo@me.com
 */
class GithubAPI {
	
	const API_DOMAIN = 'https://api.github.com';
	
	const API_GET_USER_INFO = '/user';
	
	const API_GET_UESR_REPOS = '/user/repos';
	
	const API_GET_USER_EMAILS = '/user/emails';

	const API_CREATE_REPO_KEY = '/repos/%s/%s/keys';
	
	protected $oauth_client;
	
	/**
	 * Adapter
	 *
	 * @var object
	 */
	protected static $instance = null;
	
	/**
	 * get the instance
	 */
	public static function getInstance() {
		if (self::$instance === null) {
			self::$instance = new GithubAPI();
		}
		return self::$instance;
	}
	
	protected function __construct() {
		$this->oauth_client = new OAuth2Client();
	}
	
	public function authorize() {
		$params = array(
			'client_id' => GithubPressConfig::OAUTH2_CLIENT_ID,
			'scope'		=> GithubPressConfig::OAUTH2_SCOPE,
			'redirect_uri' => GithubPressConfig::OAUTH2_REDIRECT_URI,
			'state'		=> OAuth2Client::getState(),
		);
		$this->oauth_client->setParams($params);
		$this->oauth_client->setAuthorizeUrl(GithubPressConfig::OAUTH2_AUTHORIZE_URL);
		$url = $this->oauth_client->getAuthorizeUrl();
		
		header("Location: $url");
	}
	
	public function getAccessToken($code, $state) {
		$params = array(
			'client_id' => GithubPressConfig::OAUTH2_CLIENT_ID,
			'client_secret' => GithubPressConfig::OAUTH2_CLIENT_SECRET,
			'code'		=> $code,
			'state'		=> $state,
		);
		$this->oauth_client->setParams($params);
		$this->oauth_client->setAccessTokenUrl(GithubPressConfig::OAUTH2_ACCESS_TOKEN_URL);
		return $this->oauth_client->getAccessToken();
	}
	
	public function getUserInfo($access_token) {
		return json_decode($this->oauth_client->requestAPI(self::API_DOMAIN . self::API_GET_USER_INFO, 
				$access_token), true);
	}
	
	public function getEmails($access_token) {
		return json_decode($this->oauth_client->requestAPI(self::API_DOMAIN . self::API_GET_USER_EMAILS,
				$access_token), true);
	}
	
	public function getUserRepos($access_token) {
		return json_decode($this->oauth_client->requestAPI(self::API_DOMAIN . self::API_GET_UESR_REPOS,
				$access_token), true);
	}
	
	public function createRepos($access_token, $name = GithubPressConfig::DEFAULT_GITHUB_PRESS_REPOS_NAME) {
		$params = array(
			'name' => $name,
			'has_issues' => false,
			'has_wiki'	=> false,
			'has_downloads'	=> false,
		);
		return json_decode($this->oauth_client->requestAPI(self::API_DOMAIN . self::API_GET_UESR_REPOS,
				$access_token, OAuth2Client::POST, $params), true);
	}

	public function addKeyToRepo($access_token, $user, $repo, $key) {
		$url = sprintf(self::API_CREATE_REPO_KEY, $user, $repo);
		$params = array(
			'title' => GithubPressConfig::DEFAULT_GITHUB_PRESS_REPOS_NAME,
			'key'	=> $key,
		);
		return json_decode($this->oauth_client->requestAPI(self::API_DOMAIN . $url,
				$access_token, OAuth2Client::POST, $params), true);
	}
	
}