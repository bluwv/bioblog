<?php
require 'data/single.php';
ob_start();
?>

<picture class="hero">
	<img src="uploads/<?php echo $post["thumbnail"]; ?>" alt="">
</picture>

<section class="content">
	<h1 class="title"><?php echo $post['title']; ?></h1>
	<?php echo $post['content']; ?>
</section>

<aside class="sidebar">
	<div class="post-data">
		<ul>
			<li>
				<?php $created_at = date("d/m/Y", strtotime($post['created_at'])); ?>
				<p>Publié le: <span><?php echo $created_at; ?></span></p>
			</li>
			<li>
				<p>Auteur : <span><?php echo $post['username']; ?></span></p>
			</li>
		</ul>
	</div>

	<div class="categories-list">
		<a href="">Catégorie 1</a>
		<a href="">Catégorie 2</a>
		<a href="">Catégorie 3</a>
	</div>
</aside>

<aside class="related">
	<h2 class="title">Articles liés</h2>

	<div class="posts-container">
		<div class="glide">
			<div class="glide__track" data-glide-el="track">
				<ul class="glide__slides">
					<?php foreach ($post_linked as $post) : ?>
						<li class="glide__slide">
							<?php include 'views/components/post-card.php'; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="glide__arrows" data-glide-el="controls">
				<button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
				<button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
			</div>
		</div>
	</div>
</aside>

<?php
$content = ob_get_clean();
require 'views/layout/default.php';
?>
