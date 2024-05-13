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

$pdo = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bioblog</title>
</head>
<body>

	<?php include_once 'includes/header.php'; ?>

	<main>
		<header>
			<h1>Articles</h1>
		</header>

		<section>
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
							<!-- <a href="">Voir l’article</a>
							<a href="">Modifier</a>
							<button>Supprimer</button> -->
						</td>
						<td><?php echo $post['username']; ?></td>
						<td><?php echo $status; ?></td>
						<td><?php echo $created_at; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>

			<ol>
				<li>
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
			<a href="">Créer un article</a>
		</aside>
	</main>

	<?php include_once 'includes/footer.php'; ?>

</body>
</html>
