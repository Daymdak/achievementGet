<?php $title = 'Page de connexion - Achievement Get !'; ?>

<?php ob_start(); ?>

<div class="loginPanel mt-5 col-12 col-md-10 col-lg-7 darkPanel centerElement">
	<p class="loginPanelTitle">Se connecter</p>
	<hr />
	<form action="index.php?action=login" method="POST" class="centerElement">
		<p><label class="col-6 offset-md-1">* Pseudo :</label><input type="text" name="pseudo" placeholder="Pseudo" class="col-5" pattern="^[\S]{6,16}$" required/></p>
		<p><label class="col-6 offset-md-1">* Mot de passe :</label><input type="password" name="password" placeholder="Mot de passe" class="col-5" pattern="^[\S]{6,16}$" required/></p>
		<p class="rememberMeCheckbox centerElement"><input type="checkbox" name="rememberMe" /><label class="ml-1">Se souvenir de moi</label></p>
		<input type="submit" value="CONNEXION" class="button transition centerElement white" />
	</form>
</div>

<?php 
	if (isset($_GET['error']))
	{
		if ($_GET['error'] == 6)
		{
		?>
			<div class="error centerElement col-12 col-md-10 col-lg-7">
				<p><i class="fas fa-info-circle fa-2x"></i></p>
				<p>Pseudo ou mot de passe incorrect.</p>
			</div>
		<?php
		}	
	}
?>

<div class="loginPanel darkPanel mt-5 col-12 col-md-10 col-lg-7 centerElement">
	<p class="loginPanelTitle">S'inscrire</p>
	<hr />
	<form action="index.php?action=register" method="POST" class="centerElement">
		<p><label class="col-6 offset-md-1">* Pseudo :</label><input type="text" name="pseudo" placeholder="Pseudo" class="col-5" pattern="^[\S]{6,16}$" required /></p>
		<p><label class="col-6 offset-md-1">* Mot de passe :</label><input type="password" name="password1" id="password1" placeholder="Mot de passe" class="col-5" pattern="^[\S]{6,16}$" required /></p>
		<p><label class="col-6 offset-md-1">* Confirmation :</label><input type="password" name="password2" id="password2" placeholder="Confirmation du mot de passe" class="col-5" pattern="^[\S]{6,16}$" required/></p>
		<p><label class="col-6 offset-md-1">* Adresse e-mail :</label><input type="email" name="email" placeholder="Adresse e-mail" class="col-5" pattern="^[\S]+@[\w]+\.[\w]{2,4}$" required /></p>
		<input type="submit" value="INSCRIPTION" class="button transition centerElement white" />
	</form>
</div>

<?php 
	if (isset($_GET['error']))
	{
		if ($_GET['error'] == 3)
		{
		?>
			<div class="error centerElement col-12 col-md-10 col-lg-7">
				<p><i class="fas fa-info-circle fa-2x"></i></p>
				<p>Les deux mots de passe renseigné sont différents.</p>
			</div>
		<?php
		}
		if ($_GET['error'] == 1)
		{
		?>
			<div class="error centerElement col-12 col-md-10 col-lg-7">
				<p><i class="fas fa-info-circle fa-2x"></i></p>
				<p>Le pseudo renseigné est déjà réserver.</p>
			</div>
		<?php
		}	
	}
?>

<div class="mt-5 informationLogin">
	<hr />
	<p><em>* Informations obligatoires</em></p>
	<p><em>Le pseudo que vous choississez doit faire entre 6 et 16 caractères.<br />
	Les espaces et les tabulations ne sont pas acceptée. Les autres caractères spéciaux sont acceptés.<br />
	Le mot de passe choisis doit également être composé de 6 à 16 caractères et ne pas contenir d'espace ou de tabulations.<br />
	L'adresse e-mail doit être au format xxxxx@xxxx.xx.
	 Si le format n'est pas respecter, elle est jugé invalide.</em></p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>