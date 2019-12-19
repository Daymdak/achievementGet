<?php
session_start();

date_default_timezone_set('Europe/Paris');

if (isset($_COOKIE['pseudo']) && isset($_COOKIE['password']))
{
	$_SESSION['pseudo'] = $_COOKIE['pseudo'];
}

require('controller/frontend.php');

try {
	if (isset($_SESSION['pseudo']))
	{
		updateLastConnexion($_SESSION['pseudo']);
	}
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
			if (!isset($_SESSION['pseudo']))
			{
				if (isset($_GET['error']) && $_GET['error'] > 0) {
					loginView($_GET['error']);
				}
				else {
					loginView(false);
				}
			}
			else {
				homepage();
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
			else {
				throw new Exception('Aucun identifiant de billet envoyé');
			}
		}
		if ($_GET['action'] == 'userprofile') {
			if (isset($_GET['user'])) {
					userProfile($_GET['user']);
			}
			else {
				throw new Exception('Aucun nom d\'utilisateur envoyé.');
			}
		}
		if ($_GET['action'] == 'changedatauser') {
			if (isset($_GET['user'])) {
				if (isset($_GET['error']) && $_GET['error'] > 0)
				{
					changeDataUser($_GET['user'], $_GET['error']);
				}
				else {
					changeDataUser($_GET['user'], false);
				}
			}
			else {
				throw new Exception('Aucun nom d\'utilisateur envoyé.');
			}
		}
		if ($_GET['action'] == 'updatedatauser') {
			if (isset($_GET['user']))
			{
				updateDataUser($_POST['firstname'], $_POST['name'], $_POST['country'], $_POST['phone'], $_POST['birthdate'], $_POST['gender'], $_POST['bio'], $_GET['user']);
			}
			else {
				throw new Exception('Aucun nom d\'utilisateur envoyé.');
			}
			
		}
		if ($_GET['action'] == 'updatepassword') {
			if (isset($_GET['user']))
			{
				updatePassword($_POST['exPassword'], $_POST['newPassword'], $_POST['newPassword2'], $_GET['user']);
			}
			else {
				throw new Exception('Aucun nom d\'utilisateur envoyé.');
			}
		}
		if ($_GET['action'] == 'addprofileimage') {
			checkImage($_FILES['newprofileimage']);
		}
	}
	else {
		homePage();
	}
}
catch(Exception $e) {
	echo 'Erreur : ' . $e->getMessage();
}