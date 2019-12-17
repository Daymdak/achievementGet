<?php $title = 'Page de connexion - Achievement Get !'; ?>

<?php ob_start(); ?>

<div class="loginPanel col-8 offset-2">
	<p class="loginPanelTitle">Se connecter</p>
	<hr />
	<form action="" methode="POST">
		<p class="logField"><label for="pseudo">* Pseudo :</label><input type="text" name="pseudo" placeholder="Pseudo"  required/></p>
		<p class="logField"><label for="password">* Mot de passe :</label><input type="password" name="password" placeholder="Mot de passe"  required/></p>
		<p class="rememberMeCheckbox"><input type="checkbox" name="rememberMe" /><label for="rememberMe">Se souvenir de moi</label></p>
		<input type="submit" value="CONNEXION" class="button"/>
	</form>
</div>

<div class="loginPanel col-8 offset-2">
	<p class="loginPanelTitle">S'inscrire</p>
	<hr />
	<form action="" method="POST">
		<p class="logField"><label for="pseudo">* Pseudo :</label><input type="text" name="pseudo" placeholder="Pseudo"  required /></p>
		<p class="logField"><label for="pseudo">* Mot de passe :</label><input type="password" name="password1" placeholder="Mot de passe"  required /></p>
		<p class="logField"><label for="pseudo">* Confirmation du mot de passe :</label><input type="password" name="password2" placeholder="Confirmation du mot de passe" required/></p>
		<p class="logField"><label for="pseudo">* Adresse e-mail :</label><input type="text" name="email" placeholder="Adresse e-mail" required /></p>
		<input type="submit" value="INSCRIPTION" class="button" />
	</form>
</div>

<div class="mt-5">
	<hr />
	<p>* Informations obligatoires</p>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>