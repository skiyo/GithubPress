<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
 *
 * SSHKey
 *
 * @author skiyo@me.com
 */
class SSHKey {

	const SSH_KEY_CONFIG_FILE = '/home/githubpress/.ssh/config';

	const SSH_KEY_USERS_DIR = '/home/githubpress/.ssh/users/';

	const SSH_GEN_KEY_COMMAND = 'ssh-keygen -t rsa -C "%s" -f %s -N ""';

	const SSH_KEY_CONFIG_HOST = "Host\t%s.github.com\n";
	const SSH_KEY_CONFIG_HOSTNAME = "HostName\tgithub.com\n";
	const SSH_KEY_CONFIG_USER = "User\tgithubpress\n";
	const SSH_KEY_CONFIG_ID_FILE = "IdentityFile\t%s\n";


	public static function genKey($username, $email) {
		$command = sprintf(self::SSH_GEN_KEY_COMMAND, $email, self::SSH_KEY_USERS_DIR . $username);
		exec($command);
		exec("echo #key for $username\n > " . self::SSH_KEY_CONFIG_FILE);
		$tmp_command = sprintf(self::SSH_KEY_CONFIG_HOST, $username);
		exec("echo $tmp_command > " . self::SSH_KEY_CONFIG_FILE);
		exec("echo " . self::SSH_KEY_CONFIG_HOSTNAME . " > " . self::SSH_KEY_CONFIG_FILE);
		exec("echo " . self::SSH_KEY_CONFIG_USER . " > " . self::SSH_KEY_CONFIG_FILE);
		$tmp_command = sprintf(self::SSH_KEY_CONFIG_ID_FILE, $username);
		exec("echo $tmp_command > " . self::SSH_KEY_CONFIG_FILE);
		//return file_get_contents(self::SSH_KEY_USERS_DIR . $username);
	}

	public static function getPubKey($uesrname) {
		return file_get_contents(self::SSH_KEY_USERS_DIR . $uesrname . ".pub");
	}

}