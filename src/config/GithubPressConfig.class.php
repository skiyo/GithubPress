<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
 *
 * @author skiyo@me.com
 */
class GithubPressConfig {

	const DB_HOST = '127.0.0.1:3306';

	const DB_USER = 'root';

	const DB_PASSWORD = 'root';

	const DB_NAME = 'githubpress';

	const DB_CHARSET = 'utf8';
	
	const COOKIE_ENCRYPT_KEY = 'githubpress^^%$#!%&*%$@';
	
	const OAUTH2_CLIENT_ID = 'c6c990e5c3e6cb7a94b2';
	
	const OAUTH2_CLIENT_SECRET = '242d04160a60990f7c76aa58e2d15b791835b035';
	
	const OAUTH2_SCOPE = 'repo';
	
	const OAUTH2_REDIRECT_URI = 'http://gp.com/oauth2/callback';
	
	const OAUTH2_AUTHORIZE_URL = 'https://github.com/login/oauth/authorize';
	
	const OAUTH2_ACCESS_TOKEN_URL = 'https://github.com/login/oauth/access_token';
	
	const DEFAULT_GITHUB_PRESS_REPOST_NAME = 'GithubPress';
}