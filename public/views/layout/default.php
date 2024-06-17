<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bioblog</title>
	<link rel="stylesheet" href="assets/css/app.css">
</head>

<body class="site <?php echo $page; ?>">

	<?php include_once 'includes/header.php'; ?>

	<main>
		<?php echo $content; ?>
	</main>

	<?php // include_once 'includes/footer.php'; ?>

	<?php if ( $page == "single") : ?>
		<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
	<?php endif; ?>
	<script src="assets/app.js"></script>
</body>
</html>
