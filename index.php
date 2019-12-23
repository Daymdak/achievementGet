<?php
session_start();

date_default_timezone_set('Europe/Paris');

if (isset($_COOKIE['pseudo']) && isset($_COOKIE['password']))
{
	$_SESSION['pseudo'] = $_COOKIE['pseudo'];
}

require('controller/frontend.php');
require('controller/backend.php');

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
					changeDataUser($_GET['error']);
				}
				else {
					changeDataUser(false);
				}
			}
			else {
				throw new Exception('Aucun nom d\'utilisateur envoyé.');
			}
		}
		if ($_GET['action'] == 'updatedatauser') {
			if (isset($_GET['user']))
			{
				updateDataUser($_POST['firstname'], $_POST['name'], $_POST['country'], $_POST['phone'], $_POST['birthdate'], $_POST['gender'], $_POST['bio']);
			}
			else {
				throw new Exception('Aucun nom d\'utilisateur envoyé.');
			}
			
		}
		if ($_GET['action'] == 'updatepassword') {
			if (isset($_GET['user']))
			{
				updatePassword($_POST['exPassword'], $_POST['newPassword'], $_POST['newPassword2']);
			}
			else {
				throw new Exception('Aucun nom d\'utilisateur envoyé.');
			}
		}
		if ($_GET['action'] == 'addprofileimage') {
			updateAvatar($_FILES['newprofileimage']);
		}
		if ($_GET['action'] == 'showArticles') {
			if (isset($_GET['type'])) {
				if (isset($_GET['page']) && $_GET['page'] > 0) {
					showArticles($_GET['page'], $_GET['type']);
				}
				else {
					throw new Exception('Aucun numéro de page renseigné.');
				}
			}
			else {
				throw new Exception('Aucun type d\'article renseigné.');
			}
		}
		if ($_GET['action'] == 'forum') {
			if (isset($_GET['page']) && $_GET['page'] > 0) {
				forumView($_GET['page']);
			}
			else {
				throw new Exception('Aucun numéro de page renseigné.');
			}
		}
		if ($_GET['action'] == 'addTopic') {
			addTopic($_POST['topicTitle'], $_POST['topicContent']);
		}
		if ($_GET['action'] == 'topic') {
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				if (isset($_GET['page']) && $_GET['page'] > 0) {
					topicView($_GET['id'], $_GET['page']);
				}
				else {
					throw new Exception('Aucun numéro de page renseigné.');
				}
			}
			else {
				throw new Exception('Aucun identifiant de sujet renseigné.');
			}
		}
		if ($_GET['action'] == 'addMessage') {
			if (isset($_GET['id'])) {
				addMessage($_GET['id'], $_POST['message'], $_SESSION['pseudo']);
			}
			else {
				throw new Exception('Aucun identifiant de sujet renseigné.');
			}
		}
		if ($_GET['action'] == 'reportComm') {
			if (isset($_GET['postid']) && $_GET['postid'] > 0) {
				if (isset($_GET['id']) && $_GET['postid'] > 0) {
					reportComm($_GET['postid'], $_GET['id']);
				}
				else {
					throw new Exception('Aucun identifiant de commentaires renseigné.');
				}
			}
			else {
				throw new Exception('Aucun identifiant de billet reçu.');
			}
		}
		if ($_GET['action'] == 'homeAdmin') {
			homeAdminView();
		}
		if($_GET['action'] == 'addArticle') {
			addArticle($_POST['title'], $_FILES['nameImage'], $_POST['category'], $_POST['content']);
		}
	}
	else {
		homePage();
	}
}
catch(Exception $e) {
	echo 'Erreur : ' . $e->getMessage();
}