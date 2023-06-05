<?php

if ( ! isset( $_SESSION['current_session'] ) ) {
	header('Location: index.php?page=login');
}

// Requête SQL catégories
$query = "SELECT user_login, user_password, user_email
FROM users";
$stmt = $pdo->prepare( $query );
$stmt->execute();
$users = $stmt->fetchAll();

?>

<div class="users">
	<table>
		<?php if ($users) : ?>
			<?php foreach( $users as $user ) : ?>
				<tr>
					<td><?php echo $user->user_login; ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</table>
</div>
