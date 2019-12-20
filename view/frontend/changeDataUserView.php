<?php $title = htmlspecialchars(htmlspecialchars($memberInformation['pseudo'])) . ' - Changer les informations' ?>
<?php ob_start(); ?>

<?php
if($memberInformation['pseudo'] == $_SESSION['pseudo']) {
?>
<div class="row mt-2 darkPanel profileHead">
	<div class="col-2">
		<img src="public/images/profileimageusers/<?= $memberInformation['profileImage'] ?>" alt="<?= $memberInformation['pseudo'] ?>" class="avatar col-12"/>
	</div>
	<div class="col-10">
		<div class="row">
			<div class="col-11">
				<h1><strong><?= htmlspecialchars($memberInformation['pseudo']) ?></strong></h1>
			</div>
			<div class="col-1">
				<a href="index.php?action=userprofile&user=<?= $memberInformation['pseudo'] ?>"><i class="fas fa-undo yellow"></i></a>
			</div>
		</div>
		<hr />
	</div>
</div>

<div class="row mt-5 profileInfos darkPanel">
	<h2>Changer d'image de profil</h2>
	<div class="col-12">
		<hr />
		<div class="row">
			<div class="col-6">
				<?php
					if($error >= 1 && $error <= 3) {
						if ($error == 1)
							$error = "Nous n'avons pas réussi à traiter votre image, veuillez réessayer.";
						elseif($error == 2)
							$error = "L'image que vous avez envoyer est trop lourde.";
						elseif ($error == 3)
							$error = "L'image envoyée n'est pas au bon format.";
						?>

						<div class="error centerElement">
							<p><i class="fas fa-times-circle fa-2x"></i></p>
							<p><?= $error ?></p>
						</div>
						<?php
					}
				?>
				<p class="infoProfileImage">Taille max. 1 Mo (PNG, JPG, JPEG ou GIF)</p>
			</div>
			<div class="col-6">
				<form action="index.php?action=addprofileimage" method="post" enctype="multipart/form-data" class="centerElement">
					<input type="file" name="newprofileimage" accept=".png, .jpg, .jpeg, .gif" class="col-8 centerElement" required />
					<input type="submit" value="Envoyer" class="button transition centerElement white" />
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row mt-5 profileInfos darkPanel">
	<h2>Changer les informations</h2>
	<div class="col-12">
		<hr />
		<form action="index.php?action=updatedatauser&user=<?= $_SESSION['pseudo'] ?>" method="POST" class="centerElement">
			<div class="row">
				<div class="col-6">
					<p><label for="firstname" class="col-6">Prénom :</label><input type="text" name="firstname" placeholder="Non renseigné" value="<?= $memberInformation['firstname'] ?>" class="col-5" /></p>
					<p><label for="name" class="col-6">Nom :</label><input type="text" name="name" placeholder="Non renseigné" value="<?= $memberInformation['name'] ?>" class="col-5" /></p>
					<p><label for="country" class="col-6">Pays :</label><input type="text" name="country" placeholder="Non renseigné" value="<?= $memberInformation['country'] ?>" class="col-5" /></p>
				</div>
				<div class="col-6">
					<p><label for="phone" class="col-6">Téléphone :</label> <input type="tel" name="phone" pattern="[0-9]{10}" placeholder="Non renseigné" value="<?=  $memberInformation['phone'] ?>" maxlength="10" class="col-5" /></p>
					<p><label for="birthdate" class="col-6">Date de naissance :</label> <input type="date" name="birthdate" value="<?= $memberInformation['default_birthdate'] ?>" min="1940-01-01" max="2015-01-01" class="col-5"/></p>
					<p><label for="gender" class="col-6">Genre :</label>
						<select name="gender" class="col-5">
							<option value="Homme"
							<?php
								if ($memberInformation['gender'] == "Homme")
									echo 'selected="selected"';
							?>
							>Homme</option>
							<option value="Femme"
							<?php
								if ($memberInformation['gender'] == "Femme")
									echo 'selected="selected"';
							?>
							>Femme</option>
							<option value="Non renseigné" 
							<?php
								if ($memberInformation['gender'] == "Non renseigné")
									echo 'selected="selected"';
							?>
							>Non renseigné</option>
						</select>
					</p>
				</div>
			</div>
			<p><label for="bio" class="col-6">Changer la biographie :</label><p>
			<p><textarea name="bio" class="col-12"><?= $memberInformation['bio'] ?></textarea></p>
			<input type="submit" value="Changer" class="button transition centerElement white" />
		</form>
	</div>
</div>

<div class="row mt-5 profileInfos darkPanel mb-1">
	<h2>Changer de mot de passe</h2>
	<div class="col-12">
		<hr />
		<form action="index.php?action=updatepassword&user=<?= $_SESSION['pseudo'] ?>" method="POST" class="centerElement col-8">
			<p><label for="exPassword" class="col-6">Mot de passe actuel :</label><input type="password" name="exPassword" placeholder="Mot de passe actuel" class="col-5" required/></p>
			<p><label for="newPassword" class="col-6">Nouveau mot de passe :</label><input type="password" name="newPassword"  placeholder="Nouveau mot de passe" class="col-5" required /></p>
			<p><label for="newPassword2" class="col-6">Confirmation du mot de passe :</label><input type="password" name="newPassword2" placeholder="Confirmation du mot de passe" class="col-5" required /></p>
			<input type="submit" value="Changer"  class="button transition centerElement white" />
		</form>
	</div>
</div>

<?php
	if($error >= 5 && $error <= 7)
	{
		if ($error == 5)
			$error = "Le mot de passe actuel rentrer est incorrect.";
		elseif ($error == 6)
			$error = "Les deux nouveaux mot de passes sont différents";
		elseif($error == 7)
			$error = "Le nouveaux mot de passe doit faire entre 6 et 16 caractères et ne pas contenir d'espace ou de tabulation.";
		?>
			<div class="error centerElement" class="mb-1">
				<p><i class="fas fa-times-circle fa-2x"></i></p>
				<p><?= $error ?></p>
			</div>
		<?php
	}
?>

<div class="row mt-5 profileInfos darkPanel mb-5">
	<h2>Autres</h2>
	<div class="col-12 yellow mb-5">
		<hr />
		<a href="index.php?action=unlog">Se déconnecter</a>
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