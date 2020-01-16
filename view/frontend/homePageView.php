<?php $title = 'Page d\'accueil - Achievement Get !'; ?>

<?php ob_start(); ?>

<div class="presentationText">
	<p><strong>Bienvenue sur Achivement Get !</strong> Vous retrouverez sur ce site des articles traitant de tout ce qui a un rapport de près ou de loin avec le jeu vidéo. Que ce soit de hardware, software, personnalité influente, histoire, e-sport ou même psychologie ! N'hésitez pas à vous inscrire pour participer à la vie du site, et à donner votre avis sur le contenu proposé via les commentaires ou le forum !</p>
</div>

<div class="mt-3">
	<p class="titleSection">Les derniers articles !</p>
	<div class="mt-2 slider">
		<?php
		while($data = $posts->fetch())
		{
		?>	
			<figure class="illustratedPost transition">
				
					<div class="illustration">
						<a href="index.php?action=readarticle&amp;id=<?= $data['id']?>">
						<img src="public/images/postimages/<?= $data['nameImage'] ?>" alt="<?= $data['title'] ?>" />
						</a>
					</div>

					<figcaption class="transition">
						<p class="ml-1 white"><?= htmlspecialchars($data['title']) ?></p>
					</figcaption>
				
			</figure>
		<?php	
		}
		?>
	</div>
</div>

<div class="mt-5 mb-5">
	<p class="titleSection">Plus d'articles !</p>
	<div class="col-12 listLastPosts darkPanel mt-2">
		<?php 
		while ($data = $morePosts->fetch())
		{
		?>
			<div class="transition post">
				<a href="index.php?action=readarticle&amp;id=<?= $data['id']?>" class="row">
					<div class="col-4">
						<p class="row">
							<span class="white col-md-5">
								<?= $data['creation_date_fr'] ?>
							</span>
							<span class="categoryPost yellow col-md-7">
								<?= $data['category'] ?>
							</span>
						</p>
					</div>
					<div class="col-8">
						<p>
							<?= htmlspecialchars($data['title']) ?>
						</p>
					</div>
				</a>
			</div>
		<?php
		}
		?>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>