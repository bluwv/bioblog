<?php
require 'data/home.php';
ob_start(); ?>

<form class="filters" action="" method="GET">
	<div class="form-row form-row--select">
		<label class="sr-only" for="cat-filter">Filtrer les catégories</label>
		<select id="cat-filter" name="categorie">
			<?php foreach ($categories as $categorie) :
				$selected = ( isset( $_GET['categorie'] ) && $_GET['categorie'] == $categorie['id'] ) ? 'selected' : '';
				?>
				<option value="<?php echo $categorie['id']; ?>" <?php echo $selected; ?>><?php echo $categorie['name']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<!-- <button type="submit">Filtrer</button> -->
</form>

<section class="posts-list">
	<?php foreach ( $posts as $post ) : ?>
		<?php if ( $post["status"] == 1 ) : // Si == 1 alors le post est publié ?>
			<?php include 'views/components/post-card.php'; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</section>

<ol class="pagination">
	<?php
	// Check si il y a besoin d'une pagination
	if ( $total_posts['n'] > $num_posts ) : ?>
		<?php for ($i = 1; $i < $pagination; $i++) : ?>
			<li class="<?php echo (isset($_GET['p']) && $_GET['p'] == $i) ? 'active' : ''; ?>">
				<a href="single/<?php echo $i; ?>"><?php echo $i; ?></a>
			</li>
		<?php endfor; ?>
	<?php endif; ?>
</ol>

<?php $content = ob_get_clean();
require 'views/layout/default.php';
?>
