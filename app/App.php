<?php

class App {

	public static function load() {

		// Initialiser la session
		session_start();

		require ROOT . '/app/Autoloader.php';
		App\Autoloader::register();

	}

}
