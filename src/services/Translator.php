<?php

class Translator
{
	public $lang;					// Currently loaded language key
	private $messages = [];			// Loaded language messages
	public $available_langs = [];	// List of available languages (filename => full path)

	public function __construct()
	{
		// Detect available language files
		$this->available_langs = $this->getAvailableLangs();

		// Load the default language on startup
		$this->loadDefaultLang();
	}

	public function loadLang($lang)
	{
		// Load translation file for the requested language
		$this->messages = $this->loadFile($lang);
		$this->lang = $lang;
	}
	
	private function getAvailableLangs()
	{
		// Scan the /lang folder for all *.php language files
		$res = [];

		foreach (glob(__DIR__ . "/../lang/*.php") as $v) {

			// Resolve real path and use filename (without extension) as the language key
			if ($p = realpath($v)) {
				$res[pathinfo($p, PATHINFO_FILENAME)] = $p;
			}
		}

		return $res;
	}
	
	public function loadDefaultLang()
	{
		// Load the default language defined in configuration
		$this->default_messages = $this->loadFile(DEFAULT_LANG);
		$this->default_lang = DEFAULT_LANG;
	}
	
	public function hasLang($lang)
	{
		// Check if the language file exists
		return isset($this->available_langs[$lang]);
	}
	
	private function loadFile($lang)
	{
		// Load a specific language file if it exists
		if ($this->hasLang($lang)) {

			$data = include $this->available_langs[$lang];

			// Return only valid message arrays
			if (is_array($data)) {
				return $data;
			}
		}

		// Return an empty fallback array
		return [];
	}

	public function get($key)
	{
		// Try to get the message from the current language
		// If missing — fall back to default language
		// If still missing — return the key itself
		return $this->messages[$key] ?? $this->default_messages[$key] ?? $key;
	}
}
