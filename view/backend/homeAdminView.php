<?php $title = 'Administration - Achievement Get !' ?>

<?php ob_start(); ?>

<div class="darkPanel mb-3 col-12 col-md-10 centerElement">
	<h1 class="text-center">Panneau d'administration</h1>
</div>

<div class="col-12 col-md-10 col-lg-7 centerElement darkPanel spaceAround">
	<a href="index.php?action=listMembers" title="Liste des membres"><i class="fas fa-users fa-2x yellow"></i></a>
	<a href="index.php?action=listReported" title="Commentaires et messages signalés"><i class="fas fa-exclamation-circle fa-2x yellow"></i></a>
	<a href="index.php?action=listPost" title="Liste des articles"><i class="fas fa-copy fa-2x yellow"></i></a>
</div>

<div class="mt-3 col-12 col-md-10 col-lg-7 centerElement">
	<p class="titleSection">Quelques stats</p>
	<div class="mt-2 blockStat">
		<div class="stat darkPanel text-center"><p class="moySize yellow"><?= $nbrMembers ?></p><p>Membres</p></div>
		<div class="stat darkPanel text-center"><p class="moySize yellow"><?= $nbrPosts ?></p><p>Articles</p></div>
		<div class="stat darkPanel text-center"><p class="moySize yellow"><?= $nbrComments ?></p><p>Commentaires</p></div>
		<div class="stat darkPanel text-center"><p class="moySize yellow"><?= $nbrCommentsByPost ?></p><p>Commentaire(s) par article</p></div>
		<div class="stat darkPanel text-center"><p class="moySize yellow"><?= $nbrReportedComments ?></p><p>Commentaire(s) signalés</p></div>
		<div class="stat darkPanel text-center"><p class="moySize yellow"><?= $nbrTopics ?></p><p>Topic</p></div>
		<div class="stat darkPanel text-center"><p class="moySize yellow"><?= $nbrMessages ?></p><p>Messages forum</p></div>
		<div class="stat darkPanel text-center"><p class="moySize yellow"><?= $nbrReportedMessages ?></p><p>Messages forum signalé(s)</p></div>
	</div>
</div>
	<?php
	if (isset($_GET['error']))
		{
			if ($_GET['error'] == 3)
			{
			?>
				<div class="error centerElement col-12 col-md-10 col-lg-7">
					<p><i class="fas fa-info-circle fa-2x"></i></p>
					<p>Extension de fichier non prise en charge.</p>
				</div>
			<?php
			}
			if ($_GET['error'] == 2)
			{
			?>
				<div class="error centerElement col-12 col-md-10 col-lg-7">
					<p><i class="fas fa-info-circle fa-2x"></i></p>
					<p>Le fichier est trop lourd.</p>
				</div>
			<?php
			}
			if ($_GET['error'] == 1)
			{
			?>
				<div class="error centerElement col-12 col-md-10 col-lg-7">
					<p><i class="fas fa-info-circle fa-2x"></i></p>
					<p>Le fichier s'est mal envoyé.</p>
				</div>
			<?php
			}
		}
	?>
<div class="mt-3 mb-5 col-12 col-md-10 col-lg-7 centerElement">
	<p class="titleSection">Ajouter un article</p>
	<div class="darkPanel mt-2">
		<form action="index.php?action=addArticle" method="post" enctype="multipart/form-data">
			<input type="text" name="title" placeholder="Rentrer le titre de votre article" class="mt-1" required />
			<input type="file" name="nameImage" accept=".png, .jpg, .jpeg, .gif" class="col-5 mt-1 centerElement" required />
			<select name="category" class="mt-1 mb-2" >
				<option>DOSSIER</option>
				<option>NEWS</option>
				<option>TEST</option>
			</select>
			<textarea name="content" placeholder="Ecrivez votre article ici !" required> </textarea>
			<input type="submit" value="PUBLIER" class="button transition centerElement white" />
		</form>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>