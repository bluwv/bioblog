<?php

$query = "SELECT * FROM categories";
$stmt = $pdo->prepare( $query );
$stmt->execute();
$categories = $stmt->fetchAll();
// var_dump($categories);

if ( isset( $_GET['offset'] ) ) {
	$offset = $_GET['offset'];
} else {
	$offset = 1;
}

if ( isset( $_GET['category_id'] ) ) {
	$query = "SELECT COUNT(*) FROM posts
	LEFT JOIN categorie_post ON posts.id = categorie_post.id_post
	LEFT JOIN categories ON categorie_post.id_categorie = categories.id
	WHERE categories.id = " . $_GET['category_id'];
	$total_posts = $pdo->query( $query )->fetchColumn();
} else {
	$query = "SELECT COUNT(*) FROM posts";
	$total_posts = $pdo->query( $query )->fetchColumn();
}

$limit_posts = 6;
$posts_per_page = ceil( $total_posts / $limit_posts );
$offset = ($offset - 1) * $limit_posts;

if ( isset( $_GET['category_id'] ) ) {
	$query = "SELECT *, posts.id as post_id
	FROM posts
	LEFT JOIN users ON posts.post_author = users.id
	LEFT JOIN categorie_post ON posts.id = categorie_post.id_post
	LEFT JOIN categories ON categorie_post.id_categorie = categories.id
	WHERE categories.id = " . $_GET['category_id'] .  "
	ORDER BY posts.post_date ASC
	LIMIT "  . $limit_posts . " OFFSET " . $offset;
} else {
	$query = "SELECT p.id as post_id, p.post_title, p.post_status, p.post_thumbnail, p.post_date, u.user_login as author
	FROM posts p
	LEFT JOIN users u ON p.post_author = u.id
	-- LEFT JOIN categorie_post ON posts.id = categorie_post.id_post
	-- LEFT JOIN categories ON categorie_post.id_categorie = categories.id
	ORDER BY p.post_date ASC
	LIMIT " . $limit_posts . " OFFSET " . $offset;
}

$stmt = $pdo->prepare( $query );
$stmt->execute();
$posts = $stmt->fetchAll();
// var_dump($posts);

?>

<div class="home">
	<form class="posts-filter" action="" method="GET">
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
								<img src="<?php echo '../uploads/'. $post->post_thumbnail; ?>" alt="">
							</figure>

							<div class="post-card-content">
								<h3 class="post-card-title"><?php echo $post->post_title; ?></h3>
								<p class="post-card-info"><?php echo $post->post_date .' - '. $post->author; ?></p>
							</div>
						</a>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</section>

		<div class="posts-paginate">
			<?php if ( $total_posts >= $limit_posts ) : ?>
				<?php for ( $i = 1 ; $i <= $posts_per_page ; $i++ ) : ?>
					<a href="index.php?offset=<?php echo $i; ?>"><?php echo $i; ?></a>
				<?php endfor; ?>
			<?php endif; ?>
		</div>
	</article>
</div>
