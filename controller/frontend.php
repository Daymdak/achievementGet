<?php

require_once('model/PostManager.php');

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
	$post = $postManager->getPostById($id);

	require('view/frontend/readArticleView.php');
}