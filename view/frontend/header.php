<header>
	<a href="index.php"><img src="public/images/logo.png" alt="achievementget official logo" class="logo" /></a>
	<a href="#" class="transition">Test</a>
	<a href="#" class="transition">Actu</a>
	<a href="#" class="transition">Dossiers</a>
	<a href="#" class="transition">Forum</a>
	<?php
		if(isset($_SESSION['pseudo'])) {
		?>
			<a href="index.php?action=userprofile&user=<?= $_SESSION['pseudo'] ?>" class="transition"><?= htmlspecialchars($_SESSION['pseudo']) ?></a>
		<?php
		}
		else {
		?>
			<a href="index.php?action=loginview">Se connecter / S'inscrire</a>
		<?php
		}
	?>
	
</header>