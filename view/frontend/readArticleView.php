<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<img src="public/images/postimages/<?= $post['nameImage'] ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="imagePost col-11" />
<div class="darkPanel mt-4 col-10 centerElement">
	<div class="postText">
		<h1><?= htmlspecialchars($post['title']) ?></h1>
		<p class="metaDataPost grey">Publié le <?= $post['creation_date_fr'] ?> par <?= htmlspecialchars($post['author']) ?></p>
		<hr />
		<?= $post['content'] ?>
	</div>
</div>

<?php
if (isset($_SESSION['pseudo']))
{
?>
	<form action="index.php?action=addcomment&amp;id= <?= $post['id'] ?>" method="post" class="mt-5 centerElement col-10">
		<label for="messageContent">Laisser un commentaire</label>
		<textarea name="messageContent" placeholder="" required></textarea>
		<input type="submit" value="POSTER" class="button transition centerElement white" />
	</form>
<?php
}
else
{
?>
	<div class="information centerElement mb-3">
		<p><i class="fas fa-info-circle fa-2x"></i></p>
		<p>Il faut être connecter pour poster des commentaires.</p>
	</div>
<?php
}

while($comment = $comments->fetch())
{
?>
	<div class="postComment centerElement mb-3 darkPanel col-10">
		<p><a href="index.php?action=userprofile&user=<?= $comment['author'] ?>" class="yellow"><img src="public/images/profileimageusers/<?= $comment['nameImage'] ?>" alt="<?= htmlspecialchars($comment['author']) ?>" class="avatar col-1 mr-1"/><strong><?= htmlspecialchars($comment['author']); ?> </a></strong> - <?= $comment['comment_date_fr'] ?>
			<?php
			if(isset($_SESSION['pseudo']))
			{
			?>
				<a href="index.php?action=reportComm&postid=<?= $_GET['id'] ?>&id=<?= $comment['id'] ?>" title="Signaler le commentaire"><i class="fas fa-exclamation-circle yellow"></i></a>
			<?php
			}
			?>
			</p>
		<hr />
		<?= htmlspecialchars($comment['comment']); ?>
	</div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>