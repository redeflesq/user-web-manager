<?php

class Renderer
{
	public function render($controller, $view, $vars = [])
	{
		// Get full path to the view file
		$file = $this->getViewFile($controller, $view);
		
		// If the view file does not exist, show error and exit
		if (!file_exists($file)) {
			echo 'Page not found';
			exit;
		}
		
		// Helper function to get translated text by key
		function text($name)
		{
			return Application::i()->translator()->get($name);
		}
		
		// Extract variables so they become available in the view
		foreach ($vars as $i => $v) {
			$$i = $v;
		}
		
		// Include the view file
		include $file;
	}
	
	public function die_render($controller, $view, $lang = '')
	{
		// Render a view and terminate the script immediately
		$this->render($controller, $view, $lang);
		die();
	}

	private function getViewFile($controller, $view)
	{
		// Construct full file path to the view
		return __DIR__ . "/../views/{$controller}/{$view}.php";
	}
}
