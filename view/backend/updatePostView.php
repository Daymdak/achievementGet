<?php $title = 'Modifier un article - Achievement Get' ?>

<?php ob_start(); ?>

<div class="darkPanel mb-3 col-12 col-md-10 centerElement">
	<h1 class="text-center">Modifier un article !</h1>
	<p class="text-right" ><a href="index.php?action=listPost" class="yellow">Retournez à la liste des articles</a></p>
</div>

<div class="mt-3 mb-5 col-12 col-md-10 col-lg-7 centerElement">
	<div class="darkPanel mt-2">
		<form action="index.php?action=confirmUpdatePost&id=<?= $post['id'] ?>" method="post" enctype="multipart/form-data">
			<input type="text" name="title" placeholder="Rentrer le titre de votre article" class="mt-1" value="<?= $post['title'] ?>" required />
			<input type="file" name="nameImage" accept=".png, .jpg, .jpeg, .gif" class="col-5 mt-1 centerElement" required />
			<select name="category" class="mt-1 mb-2" >
				<option <?php if($post['category'] === "DOSSIER"){echo "selected";} ?>>DOSSIER</option>
				<option <?php if($post['category'] === "NEWS"){echo "selected";} ?>>NEWS</option>
				<option <?php if($post['category'] === "TEST"){echo "selected";} ?>>TEST</option>
			</select>
			<textarea name="content" placeholder="Ecrivez votre article ici !"required><?= $post['content'] ?></textarea>
			<input type="submit" value="PUBLIER" class="button transition centerElement white" />
		</form>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>