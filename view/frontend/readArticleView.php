<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<img src="public/images/postimages/<?= $post['nameImage'] ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="imagePost col-11"/>
<div class="darkPanel mt-4 col-10 centerElement">
	<div class="postText">
		<h1><?= htmlspecialchars($post['title']) ?></h1>
		<p class="metaDataPost grey">Publié le <?= $post['creation_date_fr'] ?> par <?= htmlspecialchars($post['author']) ?></p>
		<hr />
		<p><?= $post['content'] ?></p>
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
		<?php
			$postDate = strtotime($comment['comment_date']);
			$now = time();
			
		    $diff = abs($now - $postDate);
		    $return = array();
		 
		    $tmp = $diff;
		    $return['second'] = $tmp % 60;
		 
		    $tmp = floor( ($tmp - $return['second']) /60 );
		    $return['minute'] = $tmp % 60;
		 
		    $tmp = floor( ($tmp - $return['minute'])/60 );
		    $return['hour'] = $tmp % 24;

		    $tmp = floor( ($tmp - $return['hour'])  /24 );
   			$return['day'] = $tmp;
			 
		    
		    if ($return['day'] > 0) 
		    {
		    	if ($return['day'] == 1)
		    		$timeSincePost = "il y a " . $return['day'] . " jour";
		    	else
		    		$timeSincePost = "il y a " . $return['day'] . " jours";
		    }
		    elseif ($return['hour'] > 0 && $return['hour'] < 24)
		    {
		    	if ($return['hour'] == 1)
		    		$timeSincePost = "il y a 1 heure";
		    	else
		    		$timeSincePost = "il y a " . $return['hour'] . " heures";
		    }
		    else
		    {
		    	if ($return['minute'] <= 1)
		    		$timeSincePost = "à l'instant";
		    	else
		    		$timeSincePost = "il y a " . $return['minute'] . " minutes";
		    }
		?>
		<p><a href="index.php?action=userprofile&user=<?= $comment['author'] ?>" class="yellow"><img src="public/images/profileimageusers/<?= $comment['nameImage'] ?>" alt="<?= htmlspecialchars($comment['author']) ?>" class="avatar col-1 mr-1"/><strong><?= htmlspecialchars($comment['author']); ?> </a></strong> <?= $timeSincePost ?></p>
		<hr />
		<?= htmlspecialchars($comment['comment']); ?>
	</div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>