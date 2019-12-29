<?php $title = 'Forum - Accueil'; ?>

<?php ob_start(); ?>

<div class="col-12 mb-2 centerElement">
	<p class="titleSection">Liste des sujets</p>
	<div class="col-12 listTopic darkPanel mt-2">
		<?php
		while($topic = $fewTopics->fetch())
		{
		?>
			<div class="transition post mt-1 mb-1">
				<a href="index.php?action=topic&id=<?= $topic['id'] ?>&page=1" class="row">
					<div class="col-12 col-md-4 col-lg-5">
						<p class="row lowSiz">
							<span class="white col-6 col-md-12 col-lg-6">
								<?= $topic['last_modification'] ?>
							</span>
							<span class="categoryPost yellow col-6 col-md-12 col-lg-6">
								<?= htmlspecialchars($topic['author']) ?>
							</span>
						</p>
					</div>
					<div class="col-12 col-md-8 col-lg-7">
						<p class="white">
							<?= htmlspecialchars($topic['title']) ?>
						</p>
					</div>
				</a>
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
	<div class="col-12 col-lg-10 mt-2 centerElement">
		<p class="titleSection">Nouveau Sujet</p>
		<form action="index.php?action=addTopic" method="post" class="darkPanel mb-5 col-12">
			<input type="text" name="topicTitle" placeholder="Saisir le titre du sujet" class="mb-1" maxlength="65" required/>
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