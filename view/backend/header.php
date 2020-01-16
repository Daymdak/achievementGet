<header id="wrap">
	<a href="#wrap" id="open" class="mb-1"><i class="fas fa-bars fa-2x"></i></a>
	<a href="index.php"><img src="public/images/logo.png" alt="achievementget official logo" class="logo" /></a>
	<a href="index.php?action=showArticles&type=Dossier&page=1" class="transition">Dossier</a>
	<a href="index.php?action=showArticles&type=News&page=1" class="transition">News</a>
	<a href="index.php?action=showArticles&type=Test&page=1" class="transition">Test</a>
	<a href="index.php?action=forum&page=1" class="transition">Forum</a>
	<?php
		if(isset($_SESSION['pseudo'])) {
		?>
			<a href="index.php?action=userprofile&user=<?= $_SESSION['pseudo'] ?>" class="transition"><?= htmlspecialchars($_SESSION['pseudo']) ?></a>
		<?php
		}
		else {
		?>
			<a href="index.php?action=loginview" class="transition">Se connecter / S'inscrire</a>
		<?php
		}
	?>
	<a href="#" id="close"><i class="fas fa-times fa-2x"></i></a>
</header>