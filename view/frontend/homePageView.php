<?php $title = 'Page d\'accueil - Achievement Get !'; ?>

<?php ob_start(); ?>
<div id="presentationText">
	<p><strong>Bienvenue sur Achivement Get !</strong> Vous retrouverez sur ce site des articles traitant de tout ce qui a un rapport de près ou de loin avec le jeu vidéo. Que ce soit de hardware, software, personnalité influente, histoire, e-sport ou même psychologie ! N'hésitez pas à vous inscrire pour participer à la vie du site, et à donner votre avis sur le contenu proposé !</p>
</div>
<div class="mt-3">
	<p class="titleSection">Les derniers articles !</p>
	<div class="col-12 mt-2" id="slider">
		<?php
		while($data = $posts->fetch())
		{
		?>	
			<figure class="illustratedPost">
				<a href="index.php?action=readarticle&amp;id=<?= $data['id']?>">
					<img src="public/images/postimages/<?= $data['nameImage'] ?>" alt="<?= $data['title'] ?>" />
					<figcaption>
						<p><?= htmlspecialchars($data['title']) ?></p>
					</figcaption>
				</a>
			</figure>
		<?php	
		}
		?>
	</div>
</div>

<div class="mt-5 mb-5">
	<p class="titleSection">Plus d'articles !</p>
	<div id="listLastPosts" class="col-12 mt-2">
		<?php 
		while ($data = $morePosts->fetch())
		{
		?>
			<div class="post">
				<a href="index.php?action=readarticle&amp;id=<?= $data['id']?>" ><p><strong><span class="dateInListPost" ><?= $data['creation_date_fr'] ?></span> <span class="categoryPost"><?= $data['category'] ?></span> <?= htmlspecialchars($data['title']) ?></strong></p></a>
			</div>
		<?php
		}
		?>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>