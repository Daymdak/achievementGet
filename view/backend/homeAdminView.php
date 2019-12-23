<?php $title = 'Administration - Achievement Get !' ?>

<?php ob_start(); ?>

<div class="mt-3">
	<p class="titleSection text-center">Quelques stats</p>
	<div class="mt-2 blockStat col-8 centerElement">
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

<div class="mt-3 mb-5 col-10 centerElement">
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