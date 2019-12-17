<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

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

function login()
{
	require('view/frontend/loginView.php');
}