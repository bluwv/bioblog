<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bioblog</title>
	<link rel="stylesheet" href="../assets/css/app.css">
</head>

<body class="admin <?php echo $page; ?>">
	<?php
	$page_not_logged_in = ['login', 'register'];
	if ( ! in_array($page, $page_not_logged_in) ) :
		include 'includes/header.php';
	endif; ?>

	<main>
		<?php echo $content; ?>
	</main>

	<?php if ( $page == 'posts-list' || $page == 'categorie' ) : ?>
		<aside>
			<div class="modal-add modal">
				<?php include 'views/components/modal-add.php'; ?>
			</div>

			<div class="modal-delete modal">
				<?php include 'views/components/modal-delete.php'; ?>
			</div>
		</aside>
	<?php endif; ?>

	<?php // include_once '../includes/footer.php'; ?>

	<script src="../assets/app.js"></script>

	<?php if ( $page == 'posts-edit' ) : ?>
	<script src="https://cdn.tiny.cloud/1/xswlm84astace0qr6v2hdut445do9w67ky2rx4pai8d1xhbu/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			tinymce.init({
				selector: 'textarea',
				plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
				toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
			});
		});
	</script>
	<?php endif; ?>

</body>
</html>
