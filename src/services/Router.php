<?php

class Router 
{
	private $app;

	public function __construct($app) 
	{
		$this->app = $app;
	}
	
	// Redirect to a given location and exit
	public function setLocation($location)
	{
		header('Location: ' . $location);
		exit;
	}

	// Handle incoming route and dispatch to appropriate controller/action
	public function handle($route) 
	{
		// If 'lang' is in GET parameters, store it in session
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
			if ($this->app->translator()->hasLang($lang))
				$this->app->session()->setVariable('lang', $lang);
		}

		$parts = explode('/', $route);
		$shift = 0;
		$lang = '';

		// Use session language if exists and valid
		if ($this->app->session()->existsVariable('lang') &&  
			$this->app->translator()->hasLang($this->app->session()->getVariable('lang'))) 
		{
			$lang = $this->app->session()->getVariable('lang');
		}

		// If first route segment is a language, override session variable
		if (isset($parts[0]) && $this->app->translator()->hasLang($parts[0])){
			$lang = $parts[0];
			$shift++;
			$this->app->session()->setVariable('lang', $lang);
		}

		// Determine controller, action, and optional ID
		$controller = $parts[0 + $shift] ?? 'user';
		$action = $parts[1 + $shift] ?? 'listUsers';
		$id = $parts[2 + $shift] ?? null;

		// Require authentication for all pages except login
		if ($controller !== 'auth' && !$this->app->auth()->isLoggedIn())
			$this->setLocation('/auth/login');

		// Load language if set
		if ($lang)
			$this->app->translator()->loadLang($lang);

		// Dispatch to appropriate controller
		switch ($controller) {
			case 'auth':
				$authController = new AuthController($this->app, $this->app->auth());
				if (method_exists($authController, $action)) {
					$authController->$action();
				} else {
					$this->app->renderer()->render('internal', '404');
				}
				break;

			case 'user':
				$userController = new UserController($this->app);
				if (method_exists($userController, $action)) {
					if ($id !== null) {
						$userController->$action($id);
					} else {
						$userController->$action();
					}
				} else {
					$this->app->renderer()->render('internal', '404');
				}
				break;

			default:
				// Unknown controller
				$this->app->renderer()->render('internal', '404');
				break;
		}
	}
}
