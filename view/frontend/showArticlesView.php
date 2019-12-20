<?php $title = $type . " - Achievement Get !"; ?>

<?php ob_start(); ?>

<?php
	while($post = $fewPosts->fetch())
	{
	?>
	<a href="index.php?action=readarticle&amp;id=<?= $post['id']?>" >
		<div class="row darkPanel mb-3 mt-3">
			<img src="public/images/postimages/<?= $post['nameImage'] ?>" class="col-6 box-shadow" />
			<div class="col-6">
				<p class="yellow"><?= $post['category'] ?></p>
				<hr />
				<p class="bold"><?= $post['title'] ?></p>
				<p class="text-right grey" ><?= $post['creation_date_fr'] ?></p>
			</div>
		</div>
	</a>
	<?php
	}
?>

<?php require('view/frontend/pagination.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>