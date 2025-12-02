<?php

class Csrf
{
	private $app;
	private $variable_name = 'csrf_token';
	
	public function __construct($app)
	{
		$this->app = $app;
	}
	
	private function generateRandomToken()
	{
		// Generate a secure random CSRF token
		return bin2hex(random_bytes(32));
	}
	
	public function variableName()
	{
		// Return the session variable name used for CSRF token
		return $this->variable_name;
	}
	
	public function generateToken() 
	{
		// Ensure session is started
		if (!$this->app->session()->exists()) 
			$this->app->session()->start();

		// Generate token if it doesn't already exist
		if (!$this->app->session()->existsVariable($this->variable_name)) 
			$this->app->session()->setVariable($this->variable_name, $this->generateRandomToken());

		// Return current CSRF token
		return $this->app->session()->getVariable($this->variable_name);
	}
	
	public function checkToken($token) 
	{
		// Ensure session is started
		if (!$this->app->session()->exists()) 
			$this->app->session()->start();
		
		// Validate provided token
		return $this->app->session()->existsVariable($this->variable_name) && 
			   hash_equals($this->app->session()->getVariable($this->variable_name), $token);
	}
	
	public function refreshToken() 
	{
		// Generate a new CSRF token and store it in session
		$this->app->session()->setVariable($this->variable_name, $this->generateRandomToken());
		
		// Return the new token
		return $this->app->session()->getVariable($this->variable_name);
	}
}
