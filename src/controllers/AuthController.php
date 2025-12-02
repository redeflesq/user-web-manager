<?php

class AuthController 
{
	private $app;
	private $auth;
	
	public function __construct($app, $auth) 
	{
		$this->app = $app;
		$this->auth = $auth;
	}

	// Display and handle login page
	public function login() 
	{
		// Redirect if already logged in
		if ($this->auth->isLoggedIn())
			$this->app->router()->setLocation('/user/listUsers');

		$vars = [];

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$csrfToken = $_POST[$this->app->csrf()->variableName()] ?? '';

			// Check CSRF token validity
			if (!$this->app->csrf()->checkToken($csrfToken)) {
				$vars['error'] = 'invalid_csrf';
			} else {
				$username = $_POST['username'] ?? '';
				$password = $_POST['password'] ?? '';

				// Attempt login
				if ($this->auth->login($username, $password)) {
					// Regenerate session ID and refresh CSRF token
					$this->app->session()->regenerate();
					$this->app->csrf()->refreshToken();
					$this->app->router()->setLocation('/user/listUsers');
				} else {
					$vars['error'] = "invalid_username_or_password";
				}
			}
		}

		// Render login view with any errors
		$this->app->renderer()->render('auth', 'login', $vars);
	}

	// Logout and redirect to login page
	public function logout() 
	{
		$this->auth->logout();
		$this->app->router()->setLocation('/auth/login');
	}
}
