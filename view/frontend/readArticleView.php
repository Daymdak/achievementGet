<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>

<div id="postBlock">
	<img src="public/images/<?= $post['nameImage'] ?>" alt="<?= $post['title'] ?>" id="imagePost"/>
	<h1><?= $post['title'] ?></h1>
	<p><strong><?= $post['creation_date_fr'] ?></strong></p>
	<p id="postText"><?= $post['content'] ?></p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>