<?php $title = 'Liste des éléments signalés - Achievement Get !' ?>

<?php ob_start(); ?>

<div class="darkPanel col-12 col-md-10 centerElement">
	<h1 class="text-center">Elements signalés</h1>
	<p class="text-right"><a href="index.php?action=homeAdmin" class="yellow">Retournez à la page d'administration</a></p>
</div>

<div class="row col-12 col-md-10 centerElement">
	<div class="col-md-6">
		<p class="titleSection">Commentaires signalés</p>
		<div class="listLastPosts darkPanel reportedElement">
			<?php
				while($reportedComment = $reportedComments->fetch())
				{
				?>
					<div class="transition post text-justify">
						<p class="row">
							<span class="col-12 yellow">
								<?= $reportedComment['author'] ?>
							</span>
							<span class="col-12">
								Reports : <?= $reportedComment['reports'] ?> 
								<a href="index.php?action=deleteComment&id=<?= $reportedComment['id'] ?>">
									<i class="fas fa-comment-slash yellow"></i>
								</a>
							</span>
							<span class="col-12">
								Posté le : <?= $reportedComment['comment_date'] ?>
							</span>
						</p>
						<p>Message : <?= $reportedComment['comment'] ?></p>
					</div>
				<?php
				}
			?>
		</div>
	</div>
	<div class="col-md-6">
		<p class="titleSection">Messages signalés</p>
		<div class="listLastPosts darkPanel reportedElement">
			<?php
				while($reportedMessage = $reportedMessages->fetch())
				{
				?>
					<div class="transition post text-justify">
						<p class="row">
							<span class="col-12 yellow">
								<?= $reportedMessage['author'] ?>
							</span>
							<span class="col-12">
								Reports : <?= $reportedMessage['reports'] ?> 
								<a href="index.php?action=deleteMessage&id=<?= $reportedMessage['id'] ?>">
									<i class="fas fa-comment-slash yellow"></i>
								</a>
							</span>
							<span class="col-12">
								Posté le : <?= $reportedMessage['message_date'] ?>
							</span>
						</p>
						<p>Message : <?= $reportedMessage['message'] ?></p>
					</div>
				<?php
				}
			?>
		</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>