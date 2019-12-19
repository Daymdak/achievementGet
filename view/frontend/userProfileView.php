<?php $title = htmlspecialchars(htmlspecialchars($memberInformation['pseudo'])) . ' - Profil' ?>

<?php ob_start(); ?>
<div class="row mt-2" id="profileHead">
	<div class="col-2">
		<img src="public/images/profileimageusers/<?= $memberInformation['profileImage'] ?>" alt="<?= $memberInformation['pseudo'] ?>" id="profileImage"/>
	</div>
	<div class="col-10">
		<h1><strong><?= htmlspecialchars($memberInformation['pseudo']) ?></strong></h1>
		<hr />
	</div>
</div>

<div class="row mt-5 profileInfos">
		<h2>INFOS</h2>
		<div class="col-12">
			<hr />
			<p><strong>Date de naissance : </strong><?= $memberInformation['birthdate_fr'] ?></p>
			<p><strong>Genre : </strong><?= $memberInformation['gender'] ?></p>
			<p><strong>Pays : </strong><?= $memberInformation['country'] ?></p>
			<p><strong>Membres depuis le : </strong><?= $memberInformation['inscription_date_fr'] ?></p>
			<p><strong>Dernière connexion le : </strong><?= $memberInformation['last_connexion_fr'] ?></p>
			<p><strong>Commentaires : </strong><?= $nbrComments ?> commentaires postés</p>
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