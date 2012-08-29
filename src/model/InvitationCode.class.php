<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
 *
 * @author skiyo@me.com
 */
class InvitationCode {
	
	const INVITATION_CODE_FORMAT = '%s-%s-%s';
	
	public function genInvitationCode() {
		return sprintf(self::INVITATION_CODE_FORMAT, uniqid(), $this->genRandomStr(), 
				$this->genRandomStr());
	}
	
	protected function genRandomStr($length = 5) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$chars_len = strlen($chars);
		$string = '';
		do {
			$string .= $chars{mt_rand(0, $chars_len - 1)};
		} while($length-- > 0);
		return $string;
	}
	
}