<?php
session_start();
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
		if ($_GET['action'] == 'loginview') {
			if (isset($_GET['error']) && $_GET['error'] > 0)
				loginView($_GET['error']);
			else {
				loginView(false);
			}
		}
		if ($_GET['action'] == 'login') {

		}
		if ($_GET['action'] == 'register') {
			register($_POST['pseudoRegister'], $_POST['password1Register'], $_POST['password2Register'], $_POST['emailRegister']);
		}
	}
	else {
		homePage();
	}
}
catch(Exception $e) {
	echo 'Erreur : ' . $e->getMessage();
}