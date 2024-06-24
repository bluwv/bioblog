<?php

session_start();

$page = "register";

if ( isset($_SESSION["current_user"]) ) {
	header('Location: http://bioblog.localhost/admin/posts-list.php');
}
ob_start();
?>

<div class="login-wrapper">
	<form action="data/register.php" method="POST">
		<a class="logo" href="../index.php">
			<img src="../assets/images/logo-bioblog.png" width="112" height="112" alt="">
		</a>

		<label for="username">Username</label>
		<input id="username" type="text" name="username" placeholder="Username" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>">

		<label for="mail">Email</label>
		<input id="mail" type="mail" name="mail" placeholder="Email" value="<?php echo (isset($_POST['mail'])) ? $_POST['mail'] : ''; ?>">

		<label for="password">Mot de passe</label>
		<input id="password" type="password" name="password" placeholder="Mot de passe" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] : ''; ?>">

		<button class="button-primary button-small button" type="submit">S’inscrire</button>
		</form>
	<a class="link- link" href="index.php">Retour</a>
</div>

<?php
$content = ob_get_clean();
require 'views/layout/admin.php';
?>
