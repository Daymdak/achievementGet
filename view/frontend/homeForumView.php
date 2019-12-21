<?php $title = 'Forum - Accueil'; ?>

<?php ob_start(); ?>

<div class="col-11 mb-2 centerElement">
	<p class="titleSection">Liste des sujets</p>
	<div class="col-12 listLastPosts darkPanel mt-2">
		<?php
		while($topic = $fewTopics->fetch())
		{
		?>
			<div class="transition post">
				<a href="index.php?action=topic&id=<?= $topic['id'] ?>&page=1"><p class="col-12"><strong><span class="dateInListPost"><?= $topic['last_modification'] ?></span><span class="yellow col-3 categoryPost"><?= htmlspecialchars($topic['author']) ?></span><span class="titleforum"><?= htmlspecialchars($topic['title']) ?></span></strong></p></a>
			</div>
		<?php	
		}
		?>
	</div>
</div>

<?php require('view/frontend/pagination.php'); ?>

<?php
	if(isset($_SESSION['pseudo']))
	{
	?>
	<div class="col-10 mt-2 centerElement">
		<p class="titleSection">Nouveau Sujet</p>
		<form action="index.php?action=addTopic" method="post" class="darkPanel mb-5 col-12">
			<input type="text" name="topicTitle" placeholder="Saisir le titre du sujet" class="mb-1" maxlength="80" required/>
			<textarea name="topicContent" class="mb-1" placeholder="Saisir le contenu du premier message de votre sujet" maxlength="2000" required></textarea>
			<input type="submit" value="Poster" class="transition button centerElement white" />
		</form>
	</div>
	<?php
	}
	else
	{
	?>
		<div class="information centerElement mb-3">
			<p><i class="fas fa-info-circle fa-2x"></i></p>
			<p>Il faut être connecté pour créer des sujets.</p>
		</div>
	<?php
	}
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>