<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<img src="public/images/<?= $post['nameImage'] ?>" alt="<?= $post['title'] ?>" id="imagePost"/>
<div id="postBlock">
	<div id="postText">
		<h1><?= $post['title'] ?></h1>
		<p id="metaDataPost">Publié le <?= $post['creation_date_fr'] ?> par <?= $post['author'] ?></p>
		<hr />
		<p><?= $post['content'] ?></p>
	</div>
</div>

<?php
if (isset($_SESSION['pseudo']))
{
?>
	<form action="index.php?action=addcomment&amp;id= <?= $post['id'] ?>" method="post" class="mt-5">
		<label for="messageContent">Laisser un commentaire</label>
		<textarea name="messageContent" placeholder="" required></textarea>
		<input type="submit" value="POSTER" class="button" />
	</form>
<?php
}
else
{
?>
	<div id="error" class="mb-3">
		<p><i class="fas fa-times fa-2x"></i></p>
		<p>Il faut être connecter pour poster des commentaires.</p>
	</div>
<?php
}

while($comment = $comments->fetch())
{
?>
	<div class="postComment">
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
		    		$timeSincePost = "hier";
		    	else
		    		$timeSincePost = "il y a " . $return['day'] . "jours";
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
		<p><strong><?= $comment['author']; ?></strong> <?= $timeSincePost ?></p>
		<hr />
		<?= $comment['comment']; ?>
	</div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>