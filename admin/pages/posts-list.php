<?php

if ( ! isset( $_SESSION['current_session'] ) ) {
	header('Location: index.php?page=login');
}

// Requête SQL catégories
// $query = "SELECT posts.id, posts.post_content, posts.post_date, posts.post_title, posts.post_status, users.user_login, categories.name FROM posts
// LEFT JOIN users ON posts.post_author = users.id
// LEFT JOIN categorie_post ON posts.id = categorie_post.id_post
// LEFT JOIN categories ON categorie_post.id_categorie = categories.id
// ";
$query = "SELECT posts.id as slug, posts.post_date, posts.post_title, posts.post_status FROM posts
";
$stmt = $pdo->prepare( $query );
$stmt->execute();
$posts = $stmt->fetchAll();

?>

<div class="posts">
	<a href="index.php?page=posts-edit">Ajouter un nouvel article</a>
	<table>
		<?php foreach( $posts as $post ) : ?>
			<tr>
				<td>
					<a href="index.php?page=posts-edit&id=<?php echo $post->slug; ?>">
						<?php echo $post->post_title; ?>
					</a>
				</td>
				<td>
					<?php echo $post->post_status; ?>
				</td>
				<td>
					<?php echo $post->post_date; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
