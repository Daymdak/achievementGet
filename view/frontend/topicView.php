<?php $title = 'Forum - Accueil'; ?>

<?php ob_start(); ?>

<div class="darkPanel col-12 col-lg-10 centerElement">
	<h1 class="text-center"><?= $getTopic['title'] ?></h1>
</div>

<?php
while($message = $listMessages->fetch())
{
?>
	<div class="postComment centerElement mb-3 mt-3 darkPanel col-12 col-lg-10">
		<p><a href="index.php?action=userprofile&user=<?= $message['author'] ?>"><img src="public/images/profileimageusers/<?= $message['nameImage'] ?>" alt="<?= htmlspecialchars($message['author']) ?>" class="avatar col-2 col-md-1 mr-3"/><strong class="yellow"><?= htmlspecialchars($message['author']); ?></a></strong> - <?= $message['message_date_fr'] ?></p>
		<hr />
		<?= htmlspecialchars($message['message']); ?>
	</div>
<?php
}
?>

<?php require('view/frontend/pagination.php'); ?>

<?php
	if(isset($_SESSION['pseudo']))
	{
	?>
	<div class="col-12 col-lg-10 centerElement">
		<p class="titleSection mb-2">Ajouter un message</p>
		<form action="index.php?action=addMessage&id=<?= $_GET['id'] ?>" method="post" class="darkPanel mb-5 col-12">
			<textarea name="message" class="m-1" maxlength="2000" required></textarea>
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
			<p>Il faut être connecter pour poster des messages.</p>
		</div>
	<?php
	}
?>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>