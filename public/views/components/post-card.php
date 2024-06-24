<article id="post-<?php echo $post["id"]; ?>" class="post-card">
	<picture class="post-card-image">
		<a href="single/<?php echo $post["id"]; ?>">
			<?php if (isset($post["thumbnail"]) && ! empty($post["thumbnail"]) ) : ?>
				<img src="<?php echo ROOT; ?>/uploads/<?php echo $post["thumbnail"]; ?>" alt="">
			<?php endif; ?>
		</a>
	</picture>

	<div class="post-card-content">
		<?php if ( $page == "single") : ?>
			<div class="categories-list">
				<a href="">Catégorie 1</a>
				<a href="">Catégorie 2</a>
				<a href="">Catégorie 3</a>
			</div>
		<?php endif; ?>

		<h2 class="title">
			<a href="single.php?id=<?php echo $post["id"]; ?>"><?php echo $post["title"]; ?></a>
		</h2>
		<p><?php echo (! empty($post["content"])) ? limit_text($post["content"], 20) : ''; ?></p>
	</div>
</article>
