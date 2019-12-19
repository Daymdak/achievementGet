<?php $title = htmlspecialchars(htmlspecialchars($memberInformation['pseudo'])) . ' - Profil' ?>

<?php ob_start(); ?>
<div class="row mt-2 profileHead darkPanel">
	<div class="col-2">
		<img src="public/images/profileimageusers/<?= $memberInformation['profileImage'] ?>" alt="<?= $memberInformation['pseudo'] ?>" class="avatar col-12"/>
	</div>
	<div class="col-10">
		<div class="row">
			<div class="col-11">
				<h1><strong><?= htmlspecialchars($memberInformation['pseudo']) ?></strong></h1>
			</div>
			<div class="col-1">
				<?php
					if ($memberInformation['pseudo'] == $_SESSION['pseudo']) {
					?>
						<a href="index.php?action=changedatauser&user=<?= $_SESSION['pseudo'] ?>" class="changeData"><i class="fas fa-tools fa-lg yellow"></i></a>
					<?php
					}
				?>
			</div>
		</div>
		<hr />
	</div>
</div>

<div class="row mt-5 profileInfos darkPanel">
	<div class="col-12">
		<h2>Informations</h2>
		<hr />
		<div class="row">
			<div class="col-6">
				<p><strong class="col-6">Prénom :</strong>
					<?php
						if ($memberInformation['firstname'] == NULL)
							echo "Non renseigné";
						else
							echo $memberInformation['firstname'];
					?>
				</p>
				<p><strong class="col-6">Nom :</strong>
					<?php
						if ($memberInformation['name'] == NULL)
							echo "Non renseigné";
						else
							echo $memberInformation['name'];
					?>
				</p>
				<p><strong class="col-6">Téléphone :</strong>
					<?php
						if($memberInformation['phone'] == NULL)
							echo "Non renseigné";
						else
							echo "0". $memberInformation['phone'];
					?>
				</p>
				<p><strong class="col-6">Date de naissance :</strong>
					<?php 
						if ($memberInformation['birthdate_fr'] == NULL)
							echo "Non renseigné";
						else
							echo $memberInformation['birthdate_fr'];
					?>
				</p>
				<p><strong class="col-6">Genre :</strong>
					<?php 
						if($memberInformation['gender'] == NULL)
							echo "Non renseigné";
						else
							echo $memberInformation['gender'];
					?>
				</p>
			</div>
			<div class="col-6">
				<p><strong class="col-6">Pays :</strong>
					<?php
						if ($memberInformation['country'] == NULL)
							echo "Non renseigné";
						else
							echo $memberInformation['country'];
					?>
				</p>
				<p><strong class="col-6">Membres depuis le :</strong> <?= $memberInformation['inscription_date_fr'] ?></p>
				<p><strong class="col-6">Dernière connexion le :</strong> <?= $memberInformation['last_connexion_fr'] ?></p>
				<p><strong class="col-6">Commentaires :</strong>
					<?php 
						if ($nbrComments == 0)
							echo "Aucun commentaires postés";
						elseif ($nbrComments == 1)
							echo "Un seul commentaire posté";
						else
							echo $nbrComments . " commentaires postés";
					?> 
				</p>
			</div>
		</div>
	</div>
</div>

<div class="row profileInfos profileBio mt-5 mb-5 darkPanel">
	<h2>Biographie</h2>
	<div class="col-12">
		<hr />
		<p class="mb-3"><?= htmlspecialchars($memberInformation['bio']) ?></p>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>