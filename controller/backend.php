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
	if ($nbrPosts > 0)
	{
		$nbrCommentsByPost = ceil($nbrComments/$nbrPosts);
	}
	else {
		$nbrCommentsByPost = 0;
	}

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

function listMembers()
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$getAllMembers = $memberManager->getAllMembers();

	if ($getAllMembers === false)
	{
		throw new Exception('Impossible de récupérer la liste des membres.');
	}
	else {
		require('view/backend/listMembersView.php');
	}
}

function eraseMember($member)
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$deleteMember = $memberManager->deleteMember($member);

	if ($addArticle === false)
	{
		throw new Exception('Impossible de supprimer l\'utilisateur');
	}
	else
	{
		header('Location: index.php?action=listMembers');
	}
}

function promoteMember($member)
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$promoteMember = $memberManager->promoteMember($member);

	if ($promoteMember === false)
	{
		throw new Exception('Impossible de changer le rang du membre');
	}
	else
	{
		header('Location: index.php?action=listMembers');
	}
}

function demoteMember($member)
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$demoteMember = $memberManager->demoteMember($member);

	if ($addArticle === false)
	{
		throw new Exception('Impossible de changer le rang du membre');
	}
	else
	{
		header('Location: index.php?action=listMembers');
	}
}

function listReported()
{
	$commentManager = new \AchievementGet\Website\Model\CommentManager();
	$messagesForumManager = new\AchievementGet\Website\Model\MessagesForumManager();
	$reportedComments = $commentManager->getReportedComments();
	$reportedMessages = $messagesForumManager->getReportedMessages();


	if (!($reportedComments) && !($reportedMessages))
	{
		throw new Exception('Impossible de récupérer les éléments signalés');
	}
	else {
		require('view/backend/listReportedElementsView.php');
	}
}

function deleteComment($id)
{
	$commentManager = new \AchievementGet\Website\Model\CommentManager();

	$deleteComment = $commentManager->eraseComment($id);

	if ($deleteComment === false)
	{
		throw new Exception('Impossible de supprimer le commentaire');
	}
	else
	{
		header('Location: index.php?action=listReported');
	}
}

function deleteMessage($id)
{
	$messagesForumManager = new \AchievementGet\Website\Model\MessagesForumManager();

	$deleteMessage = $messagesForumManager->eraseMessage($id);

	if ($deleteMessage === false)
	{
		throw new Exception('Impossible de supprimer le message');
	}
	else
	{
		header('Location: index.php?action=listReported');
	}
}

function listPost()
{
	$postManager = new \AchievementGet\Website\Model\PostManager();

	$getAllPost = $postManager->getAllPost();

	if ($getAllPost === false)
	{
		throw new Exception('Impossible de récupérer les articles');
	}
	else
	{
		require('view/backend/listPostView.php');
	}
}

function deletePost($id)
{
	$postManager = new AchievementGet\Website\Model\PostManager();

	$deletePost = $postManager->erasePost($id);

	if ($deletePost === false)
	{
		throw new Exception('Impossible de supprimer l\'article.');
	}
	else
	{
		header('Location: index.php?action=listPost');
	}
}

function updatePost($id)
{
	$postManager = new AchievementGet\Website\Model\PostManager();
	$post = $postManager->getPostById($id);

	require('view/backend/updatePostView.php');
}

function confirmUpdatePost($id, $title, $image,$category, $content)
{
	$postManager = new \AchievementGet\Website\Model\PostManager();
	$utilitaryManager = new \AchievementGet\Website\model\UtilitaryManager();

	$completeName = $utilitaryManager->verifyArticleImage($title, $image);

	$updateArticle = $postManager->changePost($id, $title, $completeName, $category, $content);

	if ($updateArticle === false)
	{
		throw new Exception('Impossible de modifier l\'article.');
	}
	else
	{
		header('Location: index.php?action=listPost');
	}
}