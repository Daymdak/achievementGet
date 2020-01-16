<?php $title = 'Liste des membres - Achievement Get !' ?>

<?php ob_start(); ?>

<div class="darkPanel col-12 col-md-10 centerElement">
	<h1 class="text-center">Liste des membres</h1>
	<p class="text-right"><a href="index.php?action=homeAdmin" class="yellow">Retournez à la page d'administration</a></p>
</div>

<div class="listMembers mt-5 col-12 col-md-10 centerElement">
	<?php 
	while ($memberInfo = $getAllMembers->fetch())
	{
	?>
		<div class="transition post spaceAround darkPanel memberPanel">
			<div class="row">
				<div class="col-4 col-md-3 centerElement mt-1">
					<a href="index.php?action=userprofile&amp;user=<?= $memberInfo['pseudo']?>" class="row"><img src="public/images/profileimageusers/<?= $memberInfo['profileImage'] ?>" alt="<?= $memberInfo['pseudo'] ?>" class="col-12 box-shadow" /></a>
				</div>
				<div class="col-12 col-md-10 centerElement">
					<div class="row centerElement">
						<p class="col-12 text-center">
							<?= $memberInfo['pseudo'] ?>
						</p>
						<p class="col-12 text-center">
							<?= $memberInfo['email'] ?>
						</p>
						<p class="col-12 text-center">
							<?= $memberInfo['inscription_date'] ?>
						</p>
						<p class="col-12 text-center">
						<?= $memberInfo['role'] ?>
						</p>
						<p class="col-12 spaceAround">
							<a href="index.php?action=eraseMember&member=<?= $memberInfo['pseudo']?>" title="Supprimer le membre"><i class="fas fa-user-times fa-lg yellow mr-1"></i></a>
							<?php
							if ($memberInfo['role'] == "Members")
							{
							?>
								<a href="index.php?action=promoteMember&member=<?= $memberInfo['pseudo']?>" title="Promouvoir au rang d'administrateur"><i class="fas fa-crown fa-lg yellow ml-1"></i></a>
							<?php
							}
							else
							{
							?>
								<a href="index.php?action=demoteMember&member=<?= $memberInfo['pseudo']?>" title="Demote au rang de membre"><i class="fas fa-user-minus fa-lg yellow"></i></a>
							<?php
							}
							?>
						</p>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>