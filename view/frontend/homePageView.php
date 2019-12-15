<?php $title = 'Page d\'accueil - Achievement Get !'; ?>

<?php ob_start(); ?>

<div id="slider">
	<?php
	while($data = $posts->fetch())
	{
	?>	
		<figure class="illustratedPost">
			<a href="index.php?action=readarticle&amp;id=<?= $data['id']?>">
				<img src="public/images/<?= $data['nameImage'] ?>" alt="<?= $data['title'] ?>" />
				<figcaption>
					<p><?= htmlspecialchars($data['title']) ?></p>
				</figcaption>
			</a>
		</figure>
	<?php	
	}
	?>
</div>

<div class="row mt-5">
	<div id="listLastPosts" class="col-12">
		<?php 
		while ($data = $morePosts->fetch())
		{
		?>
			<div class="post">
				<p><strong><?= $data['creation_date_fr'] ?> <a href="index.php?action=readarticle&amp;id=<?= $data['id']?>" ><span class="categoryPost"><?= $data['category'] ?></span> <?= htmlspecialchars($data['title']) ?></a></strong></p>
			</div>
		<?php
		}
		?>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>