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

<form action="" method="post" class="mt-5">
	<p><label for="messageContent">Laisser un commentaire</label></p>
	<p><textarea name="messageContent" placeholder=""></textarea></p>
	<p><input type="submit" value="POSTER" class="button" /></p>
</form>

<?php
while($comment = $comments->fetch())
{
?>
	<div class="postComment">
		<?= $comment['author']; ?>

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
			 
		    if($return['hour'] >= 24)
		    	echo $comment['comment_date'];
		    if($return['hour'] > 0 && $return['hour'] < 24)
		    {
		    	if ($return['hour'] == 1)
		    		echo "il y a 1 heure";
		    	else
		    		echo "il y a " . $return['hour'] . " heures";
		    }
		    else
		    {
		    	if ($return['minute'] <= 1)
		    		echo "à l'instant";
		    	else
		    		echo "il y a " . $return['minute'] . " minutes";
		    }
		?>

		<hr />
		<?= $comment['comment']; ?>
	</div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>