<?php $title = htmlspecialchars(htmlspecialchars($memberInformation['pseudo'])) . ' - Changer les informations' ?>
<?php ob_start(); ?>

<?php
if($memberInformation['pseudo'] == $_SESSION['pseudo']) {
?>
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
				<a href="index.php?action=userprofile&user=<?= $memberInformation['pseudo'] ?>" id="changeData"><i class="fas fa-tools fa-lg"></i></a>
			</div>
		</div>
		<hr />
	</div>
</div>

<div class="row mt-5 profileInfos">
	<h2>Changer les informations</h2>
	<div class="col-12">
		<hr />
		<form action="index.php?action=updatedatauser&user=<?= $_SESSION['pseudo'] ?>" method="POST">
			<p><strong><label for="">Changer le prénom :</label></strong><input type="text" name="firstname" placeholder="Non renseigné" value="<?= $memberInformation['firstname'] ?>" /></p>
			<p><strong><label for="">Changer le nom :</label></strong><input type="text" name="name" placeholder="Non renseigné" value="<?= $memberInformation['name'] ?>" /></p>
			<p><strong><label for="">Changer le pays :</label></strong><input type="text" name="country" placeholder="Non renseigné" value="<?= $memberInformation['country'] ?>" /></p>
			<p><strong><label for="">Changer le numéro de téléphone :</label></strong><input type="tel" name="phone" placeholder="Non renseigné" value="<?= $memberInformation['phone'] ?>" maxlength="10" /></p>
			<p><strong><label for="">Changer la date de naissance :</label></strong><input type="date" name="birthdate" /></p>
			<p><strong><label for="">Changer le genre :</label></strong>
				<select name="gender" value="<?= $memberInformation['gender'] ?>">
					<option value="Homme">Homme</option>
					<option value="Femme">Femme</option>
					<option value="Autre">Autre</option>
				</select>
			</p>
			<input type="submit" value="CHANGER" class="button" />
		</form>
	</div>
</div>
<?php
}
else {
	header('Location: index.php?action=changedatauser&user=' . $_SESSION['pseudo']);
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>