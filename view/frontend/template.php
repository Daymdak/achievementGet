<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<title><?= $title ?></title>
		<link rel="icon" href="public/images/favicon.png">
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="vendor/fontawesome/css/all.css" />
		<link rel="stylesheet" type="text/css" href="public/css/style.css" />
	</head>

	<body>
		<?php require_once("view/frontend/header.php"); ?>
		<div class="container">
			<?= $content ?>
		</div>
		<?php require_once("view/frontend/footer.php"); ?>

		<script src="public/js/index.js"></script>
	</body>
</html>