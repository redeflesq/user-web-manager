<?php

abstract class Singleton
{
	protected static $instances = []; // Stores instances for each child class

	protected function __construct() {} // Private constructor to prevent direct instantiation
	private function __clone() {} // Prevent cloning
	private function __wakeup() {} // Prevent unserialization

	public static function i()
	{
		$className = get_called_class(); // Get the name of the calling class

		if (!isset(static::$instances[$className])) {
			static::$instances[$className] = new static(); // Create an instance of the calling class
		}

		return static::$instances[$className];
	}
}
