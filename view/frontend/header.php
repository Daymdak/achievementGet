<header>
	<a href="index.php"><img src="public/images/logo.png" alt="achievementget official logo" id="logo" /></a>
	<a href="#"><p>Test</p></a>
	<a href="#">Actu</a>
	<a href="#">Dossiers</a>
	<a href="#">Forum</a>
	<?php
		if(isset($_SESSION['pseudo'])) {
		?>
			<a href="index.php?action=userprofile&user=<?= $_SESSION['pseudo'] ?>"><?= $_SESSION['pseudo'] ?></a>
			<a href="index.php?action=unlog">Se déconnecter</a>
		<?php
		}
		else {
		?>
			<a href="index.php?action=loginview">Se connecter / S'inscrire</a>
		<?php
		}
	?>
	
</header>