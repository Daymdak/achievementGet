<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MemberManager.php');
require_once('model/TopicManager.php');
require_once('model/MessagesForumManager.php');
require_once('model/UtilitaryManager.php');

function homeAdminView()
{
	$postManager = new \AchievementGet\Website\Model\PostManager();
	$commentManager = new \AchievementGet\Website\Model\CommentManager();
	$memberManager = new \AchievementGet\Website\Model\MemberManager();
	$topicManager = new \AchievementGet\Website\Model\TopicManager();
	$messagesForumManager = new \AchievementGet\Website\Model\MessagesForumManager();

	$nbrComments = $commentManager->howMuchComments();
	$nbrReportedComments = $commentManager->howMuchReportedComments();
	$nbrMembers = $memberManager->howMuchMembers();
	$nbrPosts = $postManager->howMuchPosts();
	$nbrTopics = $topicManager->howMuchTopics();
	$nbrMessages = $messagesForumManager->howMuchMessages();
	$nbrReportedMessages = $messagesForumManager->howMuchReportedMessages();
	$nbrCommentsByPost = ceil($nbrComments/$nbrPosts);

	require('view/backend/homeAdminView.php');
}

function addArticle($title, $image, $category, $content)
{
	$postManager = new \AchievementGet\Website\Model\PostManager();
	$utilitaryManager = new \AchievementGet\Website\model\UtilitaryManager();

	$completeName = $utilitaryManager->verifyArticleImage($title, $image);

	$addArticle = $postManager->addNewPost($title, $completeName, $category, $content);

	if ($addArticle === false)
	{
		throw new Exception('Impossible de créer l\'article.');
	}
	else
	{
		header('Location: index.php?action=homeAdmin');
	}
}