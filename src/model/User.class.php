<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
 *
 * @author skiyo@me.com
 */
class User {
	
	protected $github_id;
	
	protected $github_uname;
	
	protected $avatar_url;
	
	protected $blog_name;
	
	protected $email;
	
	/**
	 * @return the $github_id
	 */
	public function getGithubId() {
		return $this->github_id;
	}

	/**
	 * @return the $github_uname
	 */
	public function getGithubUname() {
		return $this->github_uname;
	}

	/**
	 * @return the $avatar_url
	 */
	public function getAvatarUrl() {
		return $this->avatar_url;
	}

	/**
	 * @param field_type $github_id
	 */
	public function setGithubId($github_id) {
		$this->github_id = $github_id;
	}

	/**
	 * @param field_type $github_uname
	 */
	public function setGithubUname($github_uname) {
		$this->github_uname = $github_uname;
	}

	/**
	 * @param field_type $avatar_url
	 */
	public function setAvatarUrl($avatar_url) {
		$this->avatar_url = $avatar_url;
	}

	public function getUserByGid($github_id) {
		
	}
	
	public function save() {
		
	}
	
	
}