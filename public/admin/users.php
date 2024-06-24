<?php
require_once 'includes/has_session.php';
require_once 'App/User.php';

$page = "users";

$users = new User;

ob_start();
?>

<section class="admin-header">
	<h1>Utilisateurs</h1>
</section>

<section class="admin-content">
	<table>
		<?php foreach ( $users->getUsers() as $user ) : ?>
			<tr class="user-id-<?php echo $user['id']; ?>">
				<td><?php echo $user['username']; ?></td>
				<td><?php echo $user['mail']; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</section>

<aside class="admin-sidebar">
</aside>

<?php
$content = ob_get_clean();
require 'views/layout/admin.php';
?>
