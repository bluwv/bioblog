<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="../assets/css/reset.css">
	<link rel="stylesheet" href="../assets/css/style.css">
	<?php if ( $page === 'posts-edit' ) : ?>
	<script src="https://cdn.tiny.cloud/1/xswlm84astace0qr6v2hdut445do9w67ky2rx4pai8d1xhbu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
	<?php endif; ?>
</head>

<body>
	<article class="admin">
		<header class="admin-nav">
			<a href=""></a>
			<nav>
				<ul>
					<li>
						<a href="index.php?page=posts-list">Articles</a>
					</li>
					<li>
						<a href="index.php?page=categories-list">Catégories</a>
					</li>
					<li>
						<a href="index.php?page=users-list">Utilisateurs</a>
					</li>
					<li>
						<a href="index.php?page=logout">Se déconnecter</a>
					</li>
				</ul>
			</nav>
		</header>

		<main class="admin-content">
			<?php echo $content; ?>
		</main>
	</article>

	<?php if ( $page === 'posts-edit' ) : ?>
		<script>
			tinymce.init({
			selector: 'textarea',
			plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
			toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
			tinycomments_mode: 'embedded',
			tinycomments_author: 'Author name',
			mergetags_list: [
				{ value: 'First.Name', title: 'First Name' },
				{ value: 'Email', title: 'Email' },
			]
			});
		</script>
	<?php endif; ?>
</body>
</html>
