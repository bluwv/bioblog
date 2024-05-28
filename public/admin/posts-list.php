<?php
session_start();

require_once '../../config/database.php';

if ( ! isset($_SESSION["current_user"]) ) {
	header('Location: index.php');
}

$query = "SELECT p.id, p.title, p.status, p.created_at, u.username
FROM posts p
LEFT JOIN users u ON p.user_id = u.id";

$statement = $pdo->prepare( $query );
$statement->execute();
$posts = $statement->fetchAll();

// $pdo = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bioblog</title>
	<link rel="stylesheet" href="../assets/css/reset.css">
	<link rel="stylesheet" href="../assets/css/app.css">
</head>

<body class="admin post --list">
	<?php include_once 'includes/header.php'; ?>

	<main>
		<section class="admin-header">
			<h1>Articles</h1>
		</section>

		<section class="admin-content">
			<table>
				<?php foreach ( $posts as $post ) :
					$status = ($post['status']) ? "Publié" : "Brouillon";
					$created_at = date("d/m/Y", strtotime($post['created_at']));
					?>
					<tr class="post-id-<?php echo $post['id']; ?>">
						<td>
							<h3>
								<a href="posts-edit.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
							</h3>
							<div>
								<a class="link-small link --publish" href="../single.php?id=<?php echo $post['id']; ?>">Voir l’article</a>
								<a class="link-small link --update" href="posts-edit.php?id=<?php echo $post['id']; ?>">Modifier</a>
								<button class="link-small link --delete">Supprimer</button>
							</div>
						</td>
						<td><?php echo $post['username']; ?></td>
						<td><?php echo $status; ?></td>
						<td><?php echo $created_at; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>

			<ol class="pagination">
				<li class="active">
					<a href="">1</a>
				</li>
				<li>
					<a href="">2</a>
				</li>
				<li>
					<a href="">3</a>
				</li>
			</ol>
		</section>

		<aside>
			<a class="button-primary button-small button" href="posts-edit.php">Créer un article</a>
		</aside>
	</main>

	<?php // include_once 'includes/footer.php'; ?>

</body>
</html>
