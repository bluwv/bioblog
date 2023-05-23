<?php

$query = "SELECT * FROM categories";
$stmt = $pdo->prepare( $query );
$stmt->execute();
$categories = $stmt->fetchAll();
// var_dump($categories);

if ( isset( $_GET['category_id'] ) ) {
	$query = "SELECT *, posts.id as post_id
	FROM posts
	LEFT JOIN users ON posts.post_author = users.id
	LEFT JOIN categorie_post ON posts.id = categorie_post.id_post
	LEFT JOIN categories ON categorie_post.id_categorie = categories.id
	WHERE categories.id = " . $_GET['category_id'] .  "
	ORDER BY posts.post_date ASC
	LIMIT 12";
} else {
	$query = "SELECT *, posts.id as post_id
	FROM posts
	LEFT JOIN users ON posts.post_author = users.id
	LEFT JOIN categorie_post ON posts.id = categorie_post.id_post
	LEFT JOIN categories ON categorie_post.id_categorie = categories.id
	ORDER BY posts.post_date ASC
	LIMIT 12";
}

$stmt = $pdo->prepare( $query );
$stmt->execute();
$posts = $stmt->fetchAll();
// var_dump($posts);

?>

<div class="home">
	<form action="" method="GET">
		<label for="categorie_filtre">Filtre</label>
		<select name="categorie_filtre" id="categorie_filtre">
			<?php foreach ( $categories as $categorie ) : ?>
				<option value="<?php echo $categorie->id .'_'. $categorie->id; ?>"><?php echo $categorie->name; ?></option>
			<?php endforeach; ?>
		</select>
	</form>

	<article>
		<section class="post-list">
			<?php foreach ( $posts as $post ) : ?>
				<?php if ( $post->post_status == 'publish' ) : ?>
					<div class="post-card">
						<a href="index.php?page=post&id=<?php echo $post->post_id; ?>">
							<figure class="post-card-image">
								<img src="//source.unsplash.com/weekly" alt="">
							</figure>

							<div class="post-card-content">
								<h3 class="post-card-title"><?php echo 'titre : ' . $post->post_title; ?></h3>
								<!-- <p><?php echo 'contenu : ' . $post->post_content; ?></p> -->
								<!-- <td><?php echo 'auteur : ' . $post->user_login; ?></td> -->
								<!-- <td><?php echo 'date : ' . $post->post_date; ?></td> -->
							</div>
						</a>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</section>
	</article>
</div>

<img src="https://images.unsplash.com/photo-1683049339644-3f820ec2c71c?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=MnwxfDB8MXxyYW5kb218MHx8fHx8fHx8MTY4NDc4Mjg1Nw&amp;ixlib=rb-4.0.3&amp;q=80&amp;utm_campaign=api-credit&amp;utm_medium=referral&amp;utm_source=unsplash_source&amp;w=1080" alt="" width="1080" height="1350">
