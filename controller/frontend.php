<?php

require_once('model/PostManager.php');

function homePage()
{
	$postManager = new \AchievementGet\Website\Model\PostManager();
	$posts = $postManager->getFewPosts(0, 6);
	$morePosts = $postManager->getFewPosts(0, 10);

	require('view/frontend/homepage.php');
}