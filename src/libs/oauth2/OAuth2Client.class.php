<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
 *
 * @author skiyo@me.com
 */
require_once 'OAuth2Exception.class.php';
class OAuth2Client {
	
	/**
	 * HTTP POST
	 */
	const POST = 'POST';
	
	/**
	 * HTTP GET
	 */
	const GET = 'GET';
	
	/**
	 * parameters
	 *
	 * @var array
	 */
	protected $params = array ();
	
	/**
	 * authorize url
	 * 
	 * @var string
	 */
	protected $authorize_url = '';
	
	/**
	 * access token url
	 * 
	 * @var string
	 */
	protected $access_token_url = '';
	
	/**
	 * construct
	 * check the curl functions
	 */
	public function __construct() {
		if (! function_exists ( 'curl_init' )) {
			throw new OAuth2Exception ( 'curl is not available' );
		}
	}
	
	/**
	 * set authorize url
	 * 
	 * @param string $authorize_url
	 */
	public function setAuthorizeUrl($authorize_url) {
		$this->authorize_url = $authorize_url;
	}
	
	/**
	 * set access token url
	 * 
	 * @param string $access_token_url
	 */
	public function setAccessTokenUrl($access_token_url) {
		$this->access_token_url = $access_token_url;
	}
	
	/**
	 * get authorize url
	 * 
	 * @return string
	 */
	public function getAuthorizeUrl() {
		$get = $this->bulidHttpQuery($this->params);
		return $this->authorize_url . '?' . $get;
	}
	
	/**
	 * set paramters
	 * 
	 * @param array $params
	 */
	public function setParams(array $params) {
		$this->params = $params;
	}
	
	/**
	 * get access token
	 * 
	 * @throws OAuth2Exception
	 * @return string
	 */
	public function getAccessToken() {
		$ret = $this->request($this->access_token_url, 
				self::POST, null, $this->bulidHttpQuery($this->params));
		if (empty($ret) || (!empty($ret['http_code']) && $ret['http_code'] != 200)) {
			throw new OAuth2Exception('curl error');
		} else {
			return $ret['content'];
		}
	}
	
	
	public function requestAPI($url, $access_token, $method = self::GET, $data = array()) {
		if ($method == self::POST) {
			$data = json_encode($data);
		} else {
			$data = $this->bulidHttpQuery($data);
		}
		$ret = $this->request($url, $method,
				"Authorization: token $access_token", $data);
		if (empty($ret) || (!empty($ret['http_code']) && $ret['http_code'] != 200)) {
			var_dump($ret);
			throw new OAuth2Exception('curl error');
		} else {
			return $ret['content'];
		}
	}
	
	/**
	 * bulid the http query with parameters
	 *
	 * @param array $params        	
	 * @return string
	 */
	protected function bulidHttpQuery($params) {
		if (empty ( $params )) {
			return '';
		} else {
			$queryArr = array ();
			foreach ( $params as $key => $value ) {
				$queryArr [] = self::urlencode ( $key ) . '=' . self::urlencode ( $value );
			}
			return implode ( '&', $queryArr );
		}
	}
	
	/**
	 * get a state
	 *
	 * @return string
	 */
	public static function getState() {
		return md5 ( uniqid ( mt_rand (), true ) );
	}
	
	/**
	 * build a http request
	 *
	 * @param string $url        	
	 * @param string $method        	
	 * @param string $headers        	
	 * @param string $data        	
	 * @return array
	 */
	protected function request($url, $method = self::GET, $headers = null, $data = null) {
		if (! self::isUrl ( $url )) {
			throw new OAuth2Exception ( 'invalid url : ' . $url );
		}
		$curl = curl_init ( $url );
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, false );
		switch ($method) {
			case self::POST :
				curl_setopt ( $curl, CURLOPT_HTTPHEADER, array (
						'Accept: application/json',
						$headers 
				) );
				curl_setopt ( $curl, CURLOPT_POST, true );
				curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data );
				break;
			default :
				// GET is the default
				if ($headers) {
					curl_setopt ( $curl, CURLOPT_HTTPHEADER, array (
							'Accept: application/json',
							$headers 
					) );
				}
		}
		$response = curl_exec ( $curl );
		if (! $response) {
			$response = curl_error ( $curl );
			throw new OAuth2Exception ( "curl error : $response" );
		}
		$http_code = curl_getinfo ( $curl, CURLINFO_HTTP_CODE );
		curl_close ( $curl );
		return array (
				'content' => $response,
				'http_code' => $http_code 
		);
	}
	
	/**
	 * URL-encode according to RFC 3986
	 *
	 * @param array|string $input        	
	 * @return string
	 */
	public static function urlencode($input) {
		if (is_array ( $input )) {
			return array_map ( array (
					'OAuth2Client',
					'urlencode' 
			), $input );
		} else if (is_scalar ( $input )) {
			return str_replace ( array (
					'+',
					'%7E' 
			), array (
					' ',
					'~' 
			), rawurlencode ( $input ) );
		} else {
			return '';
		}
	}
	
	/**
	 * Decode URL-encoded strings
	 *
	 * @param string $string        	
	 * @return string
	 */
	public static function urldecode($string) {
		return urldecode ( $string );
	}
	
	/**
	 * check the string is a URL or not
	 *
	 * @param string $url        	
	 * @return bool
	 */
	public static function isUrl($url) {
		if (empty ( $url )) {
			return false;
		}
		$urlPattern = '/^(http|https):\/\/[^\s&<>#;,"\'\?]*(|#[^\s<>;"\']*|\?[^\s<>;"\']*)$/i';
		return ( bool ) preg_match ( $urlPattern, $url );
	}
}

