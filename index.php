<?php
session_start();

date_default_timezone_set('Europe/Paris');

if (isset($_COOKIE['pseudo']) && isset($_COOKIE['password']))
{
	$_SESSION['pseudo'] = $_COOKIE['pseudo'];
}

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
			login($_POST['pseudo'], $_POST['password'], $_POST['rememberMe']);
		}
		if ($_GET['action'] == 'register') {
			register($_POST['pseudo'], $_POST['password1'], $_POST['password2'], $_POST['email']);
		}
		if ($_GET['action'] == 'unlog') {
			unlog();
		}
		if ($_GET['action'] == 'addcomment') {
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				addComment($_GET['id'], $_POST['messageContent']);
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