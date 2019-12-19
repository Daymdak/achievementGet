<?php $title = htmlspecialchars(htmlspecialchars($memberInformation['pseudo'])) . ' - Profil' ?>

<?php ob_start(); ?>
<div class="row mt-2" id="profileHead">
	<div class="col-2">
		<img src="public/images/profileimageusers/<?= $memberInformation['profileImage'] ?>" alt="<?= $memberInformation['pseudo'] ?>" id="profileImage"/>
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
						<a href="index.php?action=changedatauser&user=<?= $_SESSION['pseudo'] ?>" id="changeData"><i class="fas fa-tools fa-lg"></i></a>
					<?php
					}
				?>
			</div>
		</div>
		<hr />
	</div>
</div>

<div class="row mt-5 profileInfos">
		<h2>Informations</h2>
		<div class="col-12">
			<hr />
			<p><strong>Prénom :</strong>
				<?php
					if ($memberInformation['firstname'] == NULL)
						echo "Non renseigné";
					else
						echo $memberInformation['firstname'];
				?>
			</p>
			<p><strong>Nom :</strong>
				<?php
					if ($memberInformation['name'] == NULL)
						echo "Non renseigné";
					else
						echo $memberInformation['name'];
				?>
			</p>
			<p><strong>Téléphone :</strong>
				<?php
					if($memberInformation['phone'] == NULL)
						echo "Non renseigné";
					else
						echo "0". $memberInformation['phone'];
				?>
			</p>
			<p><strong>Date de naissance :</strong>
				<?php 
					if ($memberInformation['birthdate_fr'] == NULL)
						echo "Non renseigné";
					else
						echo $memberInformation['birthdate_fr'];
				?>
			</p>
			<p><strong>Genre :</strong>
				<?php 
					if($memberInformation['gender'] == NULL)
						echo "Non renseigné";
					else
						echo $memberInformation['gender'];
				?>
			</p>
			<p><strong>Pays :</strong>
				<?php
					if ($memberInformation['country'] == NULL)
						echo "Non renseigné";
					else
						echo $memberInformation['country'];
				?>
			</p>
			<p><strong>Membres depuis le :</strong> <?= $memberInformation['inscription_date_fr'] ?></p>
			<p><strong>Dernière connexion le :</strong> <?= $memberInformation['last_connexion_fr'] ?></p>
			<p><strong>Commentaires :</strong>
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

<div class="row profileInfos profileBio mt-5 mb-5">
	<h2>Biographie</h2>
	<div class="col-12">
		<hr />
		<p><?= htmlspecialchars($memberInformation['bio']) ?></p>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>