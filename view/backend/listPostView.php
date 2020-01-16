<?php $title = 'Liste des articles - Achievement Get !' ?>

<?php ob_start(); ?>

<div class="darkPanel mb-5 col-12 col-md-10 centerElement">
	<h1 class="text-center">Liste des articles</h1>
	<p class="text-right"><a href="index.php?action=homeAdmin" class="yellow">Retournez à la page d'administration</a></p>
</div>

<div class="col-12 col-md-10 col-7 centerElement">
<?php
	while($post = $getAllPost->fetch())
	{
	?>
		<div class="darkPanel my-1">
			<p class="row">
				<span class="col-8 col-md-4 col-lg-5"><?= $post['title'] ?></span>
				<span class="col-2 col-md-2 col-lg-2"><?= $post['category'] ?></span>
				<span class="col-9 col-md-4 col-lg-3"><?= $post['creation_date'] ?></span>
				<span class="col-1 col-md-1 col-lg-1"><a href="index.php?action=deletePost&id=<?= $post['id'] ?>"><i class="fas fa-trash-alt fa-lg yellow"></i></a></span>
				<span class="col-1 col-md-1  col-lg-1"><a href="index.php?action=updatePost&id=<?= $post['id'] ?>"><i class="fas fa-edit fa-lg yellow"></i></a></span>
			</p>
		</div>
	<?php
	}
?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>