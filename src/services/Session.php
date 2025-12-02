<?php

class Session
{
	public function getStatus()
	{
		// Return current session status
		return session_status();
	}
	
	public function exists()
	{
		// Check if a session is already active
		return $this->getStatus() !== PHP_SESSION_NONE;
	}
	
	public function start()
	{
		// Start a new session
		session_start();
	}
	
	public function regenerate()
	{
		// Regenerate session ID to prevent session fixation
		session_regenerate_id(true);
	}
	
	public function setVariable($name, $value)
	{
		// Ensure session is active before setting a variable
		if (!$this->exists())
			$this->start();
		
		$_SESSION[$name] = $value;
		return true;
	}
	
	public function destroy()
	{
		// Remove all session variables and fully destroy the session
		session_unset();
		session_destroy();
	}
	
	public function existsVariable($name)
	{
		// Check if a session variable exists
		return isset($_SESSION[$name]);
	}
	
	public function getVariable($name)
	{
		// Return session variable or null if it doesn't exist
		if (!$this->existsVariable($name))
			return null;
		
		return $_SESSION[$name];
	}
}
