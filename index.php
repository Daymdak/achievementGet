<?php

require('controller/frontend.php');

try {
	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'homepage') {
			homePage();
		}
		if ($_GET['action'] == 'readarticle') {
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				readArticle($_GET['id']);
			}
			else {
				throw new Exception('Aucun identifiant de billet envoyé');
			}
		}
	}
	else {
		homePage();
	}
}
catch(Exception $e) {
	echo 'Erreur : ' . $e->getMessage();
}