<?php

class Bootstrap
{
	public static function loadClasses()
	{
		self::loadFromDir(__DIR__ . '/classes');
	}

	public static function loadFromDir($dir)
	{
		foreach (scandir($dir) as $item) {
			if ($item === '.' || $item === '..') {
				continue;
			}

			$path = $dir . '/' . $item;

			if (is_file($path) && substr($item, -4) === '.php') {
				require_once $path;
			}
		}
	}
}
