<?php

session_start();
require_once '/Users/adrienpierre/Sites/bioblog/public/admin/App/Database.php';

class Admin {
	private $pdo;

	public function __construct()
	{
		$this->pdo = Database::getInstance()->getConnection();
	}

	public static function sanitize_input( $input ) {
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);

		return $input;
	}

	public function registerUser()
	{
		if (isset($_POST['username']) && ! empty($_POST['username'])) {
			$username = self::sanitize_input($_POST['username']);
		}

		if (isset($_POST['password']) && ! empty($_POST['password'])) {
			$password = self::sanitize_input($_POST['password']);
			$password = password_hash($password, PASSWORD_BCRYPT);
		}

		if (isset($_POST['mail']) && ! empty($_POST['mail'])) {
			$mail = self::sanitize_input($_POST['mail']);
		}

		if (isset($_POST['username']) && isset($_POST['password'])) {
			$query = "SELECT mail, username
			FROM users
			WHERE mail = :mail OR username = :username";

			$statement = $this->pdo->prepare( $query );
			$statement->bindValue(':username', $username);
			$statement->bindValue(':mail', $mail);
			$statement->execute();
			$user_exist = $statement->fetch();

			/**
			 * On sélectionne DB si le username OU le mail existe déjà
			 * Si pas, on ajoute l'utilisateur
			 */
			if ( ! $user_exist ) {
				$query = "INSERT INTO users (username, password, mail)
				VALUES (:username, :password, :mail)";

				$statement = $this->pdo->prepare( $query );
				$statement->bindValue(':username', $username);
				$statement->bindValue(':mail', $mail);
				$statement->bindValue(':password', $password);
				$statement->execute();

				header('Location: http://bioblog.localhost/admin');
			} else {
				var_dump("Cet email et/ou username existe déjà.");
			}
		}
	}

	public function loginUser()
	{
		if (isset($_POST['username']) && ! empty($_POST['username'])) {
			$username = self::sanitize_input($_POST['username']);
		}

		if (isset($_POST['password']) && ! empty($_POST['password'])) {
			$password = self::sanitize_input($_POST['password']);
		}

		if (isset($_POST['username']) && isset($_POST['password'])) {
			$query = "SELECT *
			FROM users
			WHERE username = :username";

			$statement = $this->pdo->prepare( $query );
			$statement->bindValue(':username', $username);
			$statement->execute();
			$users = $statement->fetch();

			if ( password_verify( $password, $users['password'] ) ) {
				$_SESSION["current_user"]['id'] = $users['id'];
				$_SESSION["current_user"]['name'] = $users['username'];
				$_SESSION["current_user"]['role'] = 'administrator';
				$_SESSION['last_activity'] = time();

				header('Location: http://bioblog.localhost/admin/posts-list.php');
			} else {
				var_dump("Cette combinaison username et password n'existe pas.");
			}
		}
	}
}
