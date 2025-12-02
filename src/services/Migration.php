<?php

class Migration 
{
	private $app;
	private $userModel;

	public function __construct($app) 
	{
		// Store the application instance for database access
		$this->app = $app;
		$this->userModel = new User($app->db());
	}

	public function run() 
	{
		// Run all migrations
		$this->createAdminsTable();
		$this->createUsersTable();
	}

	private function createAdminsTable() 
	{
		// SQL to create the "admins" table if it doesn't exist
		$sql = "CREATE TABLE IF NOT EXISTS admins (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			username VARCHAR(50) NOT NULL UNIQUE,
			password VARCHAR(255) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		
		try {
			// Execute table creation
			$this->app->db()->query($sql);
		} catch (Exception $e) {
			// Stop execution if table creation fails
			die("Failed to create admins table: " . $e->getMessage());
		}

		// If there are no admins yet, insert the default admin
		$checkAdmin = $this->app->db()->fetch("SELECT * FROM admins LIMIT 1");
		
		if (!$checkAdmin) {
			// Hash the default admin password
			$defaultPassword = password_hash(DEFAULT_ADMIN_PASS, PASSWORD_DEFAULT);
			
			try {
				// Insert default admin into the table
				$this->app->db()->query(
					"INSERT INTO admins (username, password) VALUES (:username, :password)", 
					[
						'username' => DEFAULT_ADMIN_NAME,
						'password' => $defaultPassword
					]
				);
			} catch (Exception $e) {
				// Stop execution if table creation fails
				die("Failed to create default admin: " . $e->getMessage());
			}
		}
	}

	private function createUsersTable() 
	{
		if ($this->app->db()->tableExists('users'))
			return;

		// SQL to create the "users" table
		$sql = "CREATE TABLE users (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			login VARCHAR(50) NOT NULL UNIQUE,
			password VARCHAR(255) NOT NULL,
			first_name VARCHAR(50) NOT NULL,
			last_name VARCHAR(50) NOT NULL,
			gender ENUM('male','female') DEFAULT NULL,
			birth_date DATE DEFAULT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

		try {
			// Execute table creation
			$res = $this->app->db()->query($sql);
		} catch (Exception $e) {
			// Stop execution if table creation fails
			die("Failed to create users table: " . $e->getMessage());
		}

		// suppressing errors...
		try {

		   
					$data = [
						'login' => "default_user",
						'password' => "password",
						'first_name' => "Default",
						'last_name' => "User",
						'gender' => "male",
						'birth_date' => "1994-04-10"
					];
					
					$this->userModel->add($data);
		} catch(Exception $e) {}
	}
}
