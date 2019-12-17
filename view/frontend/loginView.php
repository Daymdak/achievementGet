<?php $title = 'Page de connexion - Achievement Get !'; ?>

<?php ob_start(); ?>

<div class="loginPanel col-8 offset-2">
	<p class="loginPanelTitle">Se connecter</p>
	<hr />
	<form action="index.php?action=login" methode="POST">
		<p class="logField"><label for="pseudo">* Pseudo :</label><input type="text" name="pseudoLogin" placeholder="Pseudo"  required/></p>
		<p class="logField"><label for="password">* Mot de passe :</label><input type="password" name="passwordLogin" placeholder="Mot de passe"  required/></p>
		<p class="rememberMeCheckbox"><input type="checkbox" name="rememberMe" /><label for="rememberMe">Se souvenir de moi</label></p>
		<input type="submit" value="CONNEXION" class="button"/>
	</form>
</div>

<div class="loginPanel col-8 offset-2">
	<p class="loginPanelTitle">S'inscrire</p>
	<hr />
	<form action="index.php?action=register" method="POST">
		<p class="logField"><label for="pseudo">* Pseudo :</label><input type="text" name="pseudoRegister" placeholder="Pseudo"  required /></p>
		<p class="logField"><label for="pseudo">* Mot de passe :</label><input type="password" name="password1Register" placeholder="Mot de passe"  required /></p>
		<p class="logField"><label for="pseudo">* Confirmation du mot de passe :</label><input type="password" name="password2Register" placeholder="Confirmation du mot de passe" required/></p>
		<p class="logField"><label for="pseudo">* Adresse e-mail :</label><input type="text" name="emailRegister" placeholder="Adresse e-mail" required /></p>
		<input type="submit" value="INSCRIPTION" class="button" />
	</form>
</div>

<?php
	if($error >= 1 && $error <= 5)
	{
		if ($error == 1)
			$error = "Le pseudo choisi est déjà prit.";
		elseif ($error == 2)
			$error = "Le pseudo doit faire entre 6 et 16 caractères et ne pas comporter d'espace ou de tabulation.";
		elseif($error == 3)
			$error = "Les mots de passes saisis sont différents.";
		elseif($error == 4)
			$error = "Le mot de passe doit faire entre 6 et 16 caractères et ne pas comporter d'espace ou de tabulation.";
		elseif ($error == 5)
			$error = "L'adresse email que vous avez fourni n'est pas valide.";
		?>
			<div id="error">
				<p><i class="fas fa-times fa-2x"></i></p>
				<p><?= $error ?></p>
			</div>
		<?php
	}
?>

<div class="mt-4">
	<hr />
	<p>* Informations obligatoires</p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>