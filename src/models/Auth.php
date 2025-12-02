<?php

class Auth 
{
	private $app;
	private $table = 'admins';

	public function __construct($app) 
	{
		$this->app = $app;

		// Ensure session is started
		if (!$this->app->session()->exists())
			$this->app->session()->start();
	}
	
	// Administrator login
	public function login($username, $password) 
	{
		if (!$this->app->db()->tableExists($this->table)) 
			return false;

		// Fetch admin record by username
		$sql = "SELECT * FROM {$this->table} WHERE username = :username LIMIT 1";
		$admin = $this->app->db()->fetch($sql, ['username' => $username]);

		// Verify password and store session variables
		if ($admin && password_verify($password, $admin['password'])) {
			$this->app->session()->setVariable('admin_id', $admin['id']);
			$this->app->session()->setVariable('admin_username', $admin['username']);
			
			return true;
		}
		
		return false;
	}

	// Check if administrator is logged in
	public function isLoggedIn() 
	{
		return $this->app->session()->existsVariable('admin_id');
	}

	// Logout administrator
	public function logout() 
	{
		if ($this->app->session()->exists())
			$this->app->session()->destroy();
	}

	// Get current logged-in administrator info
	public function getAdmin() 
	{
		if ($this->isLoggedIn()) {
			return [
				'id' => $this->app->session()->getVariable('admin_id'),
				'username' => $this->app->session()->getVariable('admin_username')
			];
		}
		
		return null;
	}
}
