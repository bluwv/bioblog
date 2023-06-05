<?php

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
}

if ( isset( $_SESSION['current_session'] ) ) {
	header('Location: index.php?page=posts-list');
}

if ( isset( $_POST['user_login'], $_POST['user_password'] ) ) {
	// $email = test_input( $_POST['user_email'] );
	$login = test_input( $_POST['user_login'] );
	$password = test_input( $_POST['user_password'] );
	$password = hash('md5', $password);

	$query = "SELECT *
	FROM `users`
	WHERE (user_login=:login OR user_email=:login) AND user_password=:password";
	$stmt = $pdo->prepare( $query );
	$stmt->bindValue(":login", $login);
	$stmt->bindValue(":password", $password);
	$stmt->execute();
	$user = $stmt->fetch();

	if ( $user ) {
		$_SESSION['current_session'] = array(
			'status' => 1,
			'user_id' => $user->id,
			'user_login' => $user->user_login,
			'date_time' => date('Y-m-d H:i:s'),
		);
		header('Location: index.php?page=posts-list');
	} else {
		$message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
	}
}

?>

<div class="login">
	<form action="" method="POST">
		<h1>
			<img class="logo" src="../assets/images/logo-bioblog.png" alt="Connexion">
		</h1>

		<div class="form-row" novalidate>
			<label for="user_login">Nom d'utilisateur</label>
			<input id="user_login" type="text" name="user_login" placeholder="Nom d'utilisateur" value="<?php echo ( isset( $_POST['user_login'] ) ) ? $_POST['user_login'] : ''; ?>">
			<!-- <input type="email" name="user_email" placeholder="Email d'utilisateur" value="<?php echo ( isset( $_POST['user_email'] ) ) ? $_POST['user_email'] : ''; ?>"> -->
		</div>

		<div class="form-row">
			<label for="user_password">Mot de passe</label>
			<input id="user_password" type="password" name="user_password" placeholder="Mot de passe" value="">
		</div>

		<div class="form-row">
			<button class="button" type="submit" name="submit">Connexion</button>
		</div>

		<?php if ( ! empty( $message ) ) : ?>
			<div class="form-row">
				<p class="error"><?php echo $message; ?></p>
			</div>
		<?php endif; ?>
	</form>

	<div>
		<a class="link" href="../public">< Retour sur le site</p>
	</div>
</div>
