<?php
session_start();

/*
date_default_timezone_set('Europe/Paris');

if (isset($_COOKIE['pseudo']) && isset($_COOKIE['password']))
{
	$_SESSION['pseudo'] = $_COOKIE['pseudo'];
}

Déplacer cette partie hors du routeur
*/
require('controller/frontend.php');
require('controller/backend.php');

try {
	/*
	if (isset($_SESSION['pseudo']))
	{
		updateLastConnexion($_SESSION['pseudo']);
	}
	Déplacer cette partie également
	*/
	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'homepage') {
			homePage();
		}
		if ($_GET['action'] == 'readarticle') {
			readArticle($_GET['id']);
		}
		if ($_GET['action'] == 'loginview') {
			loginView();
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
			addComment($_GET['id'], $_POST['messageContent']);
		}
		if ($_GET['action'] == 'userprofile') {
			userProfile($_GET['user']);
		}
		if ($_GET['action'] == 'changedatauser') {
			changeDataUser($_GET['user']);
		}
		if ($_GET['action'] == 'updatedatauser') {
			updateDataUser($_GET['user'], $_POST['firstname'], $_POST['name'], $_POST['country'], $_POST['phone'], $_POST['birthdate'], $_POST['gender'], $_POST['bio']);	
		}
		if ($_GET['action'] == 'updatepassword') {
				updatePassword($_GET['user'], $_POST['exPassword'], $_POST['newPassword'], $_POST['newPassword2']);
		}
		if ($_GET['action'] == 'addprofileimage') {
			updateAvatar($_FILES['newprofileimage']);
		}
		if ($_GET['action'] == 'showArticles') {
			showArticles($_GET['page'], $_GET['type']);
		}
		if ($_GET['action'] == 'forum') {
			forumView($_GET['page']);
		}
		if ($_GET['action'] == 'addTopic') {
			addTopic($_POST['topicTitle'], $_POST['topicContent']);
		}
		if ($_GET['action'] == 'topic') {
			topicView($_GET['id'], $_GET['page']);
		}
		if ($_GET['action'] == 'addMessage') {
			addMessage($_GET['id'], $_GET['user'], $_POST['message']);
		}
		if ($_GET['action'] == 'reportComm') {
			reportComm($_GET['postid'], $_GET['id']);
		}
		if ($_GET['action'] == 'homeAdmin') {
			homeAdminView();
		}
		if($_GET['action'] == 'addArticle') {
			addArticle($_POST['title'], $_FILES['nameImage'], $_POST['category'], $_POST['content']);
		}
		if ($_GET['action'] == 'listMembers') {
			listMembers();
		}
		if ($_GET['action'] == 'eraseMember') {
			eraseMember($_GET['member']);
		}
		if ($_GET['action'] == 'promoteMember') {
			promoteMember($_GET['member']);
		}
		if ($_GET['action'] == 'demoteMember') {
			demoteMember($_GET['member']);
		}
		if ($_GET['action'] == 'listReported') {
			listReported();
		}
		if ($_GET['action'] == 'deleteComment') {
			deleteComment($_GET['id']);
		}
		if ($_GET['action'] == 'deleteMessage') {
			deleteMessage($_GET['id']);
		}
		if ($_GET['action'] == 'listPost') {
			listPost();
		}
		if ($_GET['action'] == 'deletePost') {
			deletePost($_GET['id']);
		}
		if ($_GET['action'] == 'updatePost') {
			updatePost($_GET['id']);
		}
		if ($_GET['action'] == 'confirmUpdatePost') {
			confirmUpdatePost($_GET['id'], $_POST['title'], $_FILES['nameImage'],$_POST['category'], $_POST['content']);
		}
	}
	else {
		homePage();
	}
}
catch(Exception $e) {
	echo 'Erreur : ' . $e->getMessage();
}