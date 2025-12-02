<?php

class Application extends Singleton
{
	private $csrf;
	private $session;
	private $translator;
	private $renderer;
	private $db;
	private $migration;
	private $auth;
	private $router;
	
	protected function __construct()
	{
		// Initialize session handler
		$this->session = new Session;

		// Initialize CSRF protection module
		$this->csrf = new Csrf($this);

		// Initialize language translator
		$this->translator = new Translator;

		// Initialize view renderer
		$this->renderer = new Renderer;

		// Initialize database connection handler
		$this->db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

		// Initialize migration system
		$this->migration = new Migration($this);

		// Initialize authentication module
		$this->auth = new Auth($this);

		// Initialize routing system
		$this->router = new Router($this);
	}
	
	public function csrf()
	{
		// Return CSRF component
		return $this->csrf;
	}
	
	public function session()
	{
		// Return session handler
		return $this->session;
	}
	
	public function translator()
	{
		// Return translator instance
		return $this->translator;
	}
	
	public function renderer()
	{
		// Return renderer instance
		return $this->renderer;
	}
	
	public function db()
	{
		// Return database handler
		return $this->db;
	}
	
	public function migration()
	{
		// Return migration system
		return $this->migration;
	}
	
	public function auth()
	{
		// Return authentication module
		return $this->auth;
	}
	
	public function router()
	{
		// Return router instance
		return $this->router;
	}
	
	public function start()
	{
		try 
		{
			// Establish database connection
			$this->db->connect();
			
			// Run migrations
			$this->migration->run();
			
			// Start session if not already started
			if (!$this->session->exists())
				$this->session->start();
			
			// Resolve and handle requested route (default: user/listUsers)
			$this->router->handle(isset($_GET['route']) ? $_GET['route'] : 'user/listUsers');
		}
		catch (Exception $e) {

			// Handle unexpected exceptions
			echo 'Undefined exception: ' . $e->getMessage();
			exit;
		}
	}
}
