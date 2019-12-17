<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MemberManager.php');

function homePage()
{
	$postManager = new \AchievementGet\Website\Model\PostManager();
	$posts = $postManager->getFewPosts(0, 6);
	$morePosts = $postManager->getFewPosts(0, 10);

	require('view/frontend/homePageView.php');
}

function readArticle($id)
{
	$postManager = new \AchievementGet\Website\Model\PostManager();
	$commentManager = new \AchievementGet\Website\Model\CommentManager();

	$post = $postManager->getPostById($id);
	$comments = $commentManager->getPostComments($_GET['id']);

	require('view/frontend/readArticleView.php');
}

function loginView($error)
{
	require('view/frontend/loginView.php');
}

function register($pseudo, $password1, $password2, $email)
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$stateQuery = $memberManager->verifyRegisterData($pseudo, $password1, $password2, $email);

	if ($stateQuery == 0) {
		header('Location: index.php');
	}
	else {
		header('Location: index.php?action=loginview&error=' . $stateQuery);
	}
}

function login($pseudo, $password, $rememberMe)
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$stateQuery = $memberManager->beConnect($pseudo, $password, $rememberMe);

	if($stateQuery == 0) {
		header('Location: index.php');
	}
	else {
		header('Location: index.php?action=loginview&error=' . $stateQuery);
	}
}

function unlog()
{
	session_destroy();
	setcookie('pseudo', '');

	header('Location: index.php');
}

function addComment($id, $messageContent)
{
	$commentManager = new \AchievementGet\Website\Model\CommentManager();

	$newComment = $commentManager->postComment($id, $messageContent);

	if ($newComment === false) {
		throw new Exception('Impossible d\'ajouter le commentaire !');
	}
	else {
		header('Location: index.php?action=readarticle&id=' . $id);
	}
}