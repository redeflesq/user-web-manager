<?php

class Database 
{
	private $host;
	private $dbname;
	private $username;
	private $password;
	private $charset;
	private $pdo;
	private $options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false,
	];

	public function __construct($host, $dbname, $username, $password, $charset = DB_CHARSET) 
	{
		$this->host = $host;
		$this->dbname = $dbname;
		$this->username = $username;
		$this->password = $password;
		$this->charset = $charset;
	}

	public function connect() 
	{
		try {
			// Connect to MySQL server without specifying database
			$dsn = "mysql:host={$this->host};charset={$this->charset}";
			$this->pdo = new PDO($dsn, $this->username, $this->password, $this->options);

			// Create database if it does not exist
			$this->createDatabaseIfNotExists();

			// Connect to the specified database
			$dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
			$this->pdo = new PDO($dsn, $this->username, $this->password, $this->options);
				
		} catch (PDOException $e) {
			die("Database connection failed: " . $e->getMessage());
		}
	}

	public function tableExists($table)
	{
		// Check if the admins table exists
		$sql = "SELECT TABLE_NAME 
				FROM INFORMATION_SCHEMA.TABLES 
				WHERE TABLE_SCHEMA = DATABASE() 
				AND TABLE_NAME = :table";

		return $this->fetch($sql, ['table' => $table]);
	}

	private function createDatabaseIfNotExists()
	{
		// Execute SQL to create database if it doesn't exist
		$sql = "CREATE DATABASE IF NOT EXISTS " . $this->dbname;
		$this->pdo->exec($sql);
	}

	public function query($sql, $params = []) 
	{
		// Prepare and execute a SQL query with optional parameters
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($params);
		return $stmt;
	}

	public function fetchAll($sql, $params = []) 
	{
		// Execute query and return all results
		return $this->query($sql, $params)->fetchAll();
	}

	public function fetch($sql, $params = []) 
	{
		// Execute query and return single result
		return $this->query($sql, $params)->fetch();
	}

	public function lastInsertId() 
	{
		// Return the ID of the last inserted row
		return $this->pdo->lastInsertId();
	}
}
