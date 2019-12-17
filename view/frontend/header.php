<header>
	<a href="index.php"><img src="public/images/logo.png" alt="achievementget official logo" id="logo" /></a>
	<a href="#">TEST</a>
	<a href="#">ACTU</a>
	<a href="#">DOSSIERS</a>
	<a href="#">FORUM</a>
	<?php
		if(isset($_SESSION['pseudo'])) {
		?>
			<p>Bienvenue <a href="#"><?= $_SESSION['pseudo'] ?></a> !</p>
			<p><a href="index.php?action=unlog">SE DECONNECTER</a></p>
		<?php
		}
		else {
		?>
			<a href="index.php?action=loginview">SE CONNECTER / S'INSCRIRE</a>
		<?php
		}
	?>
	
</header>