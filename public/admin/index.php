<?php
session_start();

require_once '../../config/database.php';

function sanitize_input($input) {
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);

	return $input;
}

if ( $_POST ) {

	if (isset($_POST['username']) && ! empty($_POST['username'])) {
		$username = sanitize_input($_POST['username']);
	}

	if (isset($_POST['password']) && ! empty($_POST['password'])) {
		$password = sanitize_input($_POST['password']);
		// FIXME: Check password hash var_dump(password_verify($password, $_POST['password']));
	}

	if (isset($_POST['username']) && isset($_POST['password'])) {
		$query = "SELECT *
		FROM users
		WHERE username = :username AND password = :password";

		$statement = $pdo->prepare( $query );
		$statement->bindValue(':username', $username);
		$statement->bindValue(':password', $password);
		$statement->execute();
		$users = $statement->fetch();

		if ( $users ) {
			$_SESSION["current_user"] = $users;
			header('Location: posts-list.php');
		} else {
			var_dump("Cette combinaison username et password n'existe pas.");
		}
	}
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bioblog</title>
</head>
<body>

	<?php // include_once '../includes/header.php'; ?>

	<main>
		<div>
			<form action="" method="POST">
				<a href="/home">
					<img src="" alt="">
				</a>

				<label for="username">Email ou login</label>
				<input id="username" type="text" name="username" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>">

				<label for="password">Mot de passe</label>
				<input id="password" type="password" name="password" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] : ''; ?>">

				<button type="submit">Se connecter</button>
				<a href="#">S’inscrire</a>
			</form>

			<a href="">Mot de passe oublié ?</a>
		</div>
	</main>

	<?php // include_once '../includes/footer.php'; ?>

</body>
</html>
