<?php

class Database
{
	// Database credentials
	private $host;
	private $db_name;
	private $username;
	private $password;
	private $conn;

	// Hold the class instance.
	private static $instance = null;

	// Private constructor to prevent multiple instances
	private function __construct()
	{
		$config = '/Users/adrienpierre/Sites/bioblog/config/database.php';
		if (file_exists($config)) {
			require_once $config;

			$this->host = DBHOST;
			$this->db_name = DBNAME;
			$this->username = DBUSER;
			$this->password = DBPASSWORD;

			$this->conn = null;

			try {
				$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
				$this->conn = new PDO($dsn, $this->username, $this->password);

				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // FETCH_OBJ FETCH_BOTH
			} catch (PDOException $exception) {
				echo 'Connection error: ' . $exception->getMessage();
			}
		}
	}

	// Method to get the single instance of the class
	public static function getInstance()
	{
		if (self::$instance == null) {
			self::$instance = new Database();
		}

		return self::$instance;
	}

	// Method to get the database connection
	public function getConnection()
	{
		return $this->conn;
	}
}
