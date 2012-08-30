<?php
/**
 * GithubPress
 * Copyright (c) 2012 GithubPress
 *
 * @author skiyo@me.com
 */
class Git {

	/**
	 * path of user's repo
	 */
	const GIT_USER_REPOS_HOME_PATH = '/home/githubpress/data/user_git/';

	/**
	 * path of git bin
	 */
	const GIT_BIN_PATH = '/usr/bin/git';

	/**
	 * current repo path
	 */
	protected $repo_path = '';

	/**
	 * init git
	 */
	public function __construct($uid, $repo, $user, $email) {
		$this->repo_path = self::GIT_USER_REPOS_HOME_PATH . "$uid/$repo";
		if (!is_dir($this->repo_path)) {
			exec("mkdir -p {$this->repo_path}");
		}
		chdir($this->repo_path);
		if (!is_file($this->repo_path . '/.git/HEAD')) {
			exec("git init");
		}
		exec('git config user.name "' . $user . '"');
		exec('git config user.email "' . $email . '" ')
	}


	protected function run($command) {
		$command = sprintf('cd %s && %s', escapeshellarg($this->repo_path), self::GIT_BIN_PATH . ' ' . $command);
		ob_start();
        passthru($command, $ret);
        $output = ob_get_clean();
        if ($ret === 0) {
        	return false;
        }
        return trim($output);
	}

	/**
     * Get branches list
     *
     * @return array list of branches names
     */
    public function getBranches() {
        return array_filter(preg_replace('/[\s\*]/', '', explode("\n", $this->run('branch'))));
    }

     /**
     * Get current branch
     *
     * @return string the current branch name
     */
    public function getCurrentBranch() {
        $output = $this->run('branch');

        foreach(explode("\n", $output) as $line) {
            if('*' === $line{0}) {
                return substr($line, 2);
            }
        }
    }

    /**
     * Tell if a branch exists
     *
     * @return  boolean true if the branch exists, false otherwise
     */
    public function hasBranch($name) {
        return in_array($name, $this->getBranches());
    }
	/**
	 * Runs a `git commit` call
	 *
	 * Accepts a commit message string
	 *
	 * @access  public
	 * @param   string  commit message
	 * @return  string
	 */	
	public function commit($message = "") {
		return $this->run("commit -a -m \"$message\"");
	}

	/**
	 * Runs a `git clone` call to clone a remote repository
	 * into the current repository
	 *
	 * Accepts a source url
	 *
	 * @access  public
	 * @param   string  source url
	 * @return  string
	 */	
	public function clone($source) {
		return $this->run("clone $source " . $this->repo_path);
	}

	/**
	 * Runs a `git branch` call
	 *
	 * Accepts a name for the branch
	 *
	 * @access  public
	 * @param   string  branch name
	 * @return  string
	 */	
	public function branch($branch) {
		return $this->run("branch $branch");
	}

	/**
	 * Runs a `git branch` call
	 *
	 * Accepts a name for the branch
	 *
	 * @access  public
	 * @param   string  branch name
	 * @return  string
	 */	
	public functio getCurrentRepoDir() {
		return $this->repo_path;
	}

}