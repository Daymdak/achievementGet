<?php $title = $type . " - Achievement Get !"; ?>

<?php ob_start(); ?>

<?php
	while($post = $fewPosts->fetch())
	{
	?>
		<div class="col-12 col-lg-10 darkPanel mb-3 mt-3 centerElement">
			<a href="index.php?action=readarticle&amp;id=<?= $post['id']?>" >
			<div class="row">
				<img src="public/images/postimages/<?= $post['nameImage'] ?>" alt="<?= $post['nameImage'] ?>" class="col-11 col-md-6 ml-md-3 centerElement mb-2 box-shadow imageListArticle" />
				<div class="col-12 col-md-5">
					<p class="yellow"><?= $post['category'] ?></p>
					<hr />
					<p class="bold mt-5 mb-5 white"><?= $post['title'] ?></p>
					<p class="text-right grey mt-5" ><?= $post['creation_date_fr'] ?></p>
				</div>
			</div>
			</a>
		</div>
	
	<?php
	}
?>

<?php require('view/frontend/pagination.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>