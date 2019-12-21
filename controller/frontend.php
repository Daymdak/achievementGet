<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MemberManager.php');
require_once('model/TopicManager.php');
require_once('model/MessagesForumManager.php');

function homePage()
{
	$postManager = new \AchievementGet\Website\Model\PostManager();
	$posts = $postManager->getFewPosts(0, 6);
	$morePosts = $postManager->getFewPosts(6, 10);

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

function userProfile($user)
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();
	$commentManager = new \AchievementGet\Website\Model\CommentManager();

	$memberInformation = $memberManager->getMemberInformation($user);
	$nbrComments = $commentManager->howMuchAuthorComments($user);

	require('view/frontend/userprofileview.php');
}

function changeDataUser($user, $error)
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$memberInformation = $memberManager->getMemberInformation($user);

	require('view/frontend/changedatauserview.php');
}

function updateDataUser($firstname, $name, $country, $phone, $birthdate, $gender, $bio, $user) {
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$updateData = $memberManager->changeData($firstname, $name, $country, $phone, $birthdate, $gender, $bio, $user);

	if ($updateData === false) {
		throw new Exception('Impossible de mettre à jour le profil');
	}
	else {
		header('Location: index.php?action=changedatauser&user=' . $user);
	}
}

function updatePassword($exPassword, $newPassword, $newPassword2, $user) {
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$updatePasswordUser = $memberManager->updatePasswordUser($exPassword, $newPassword, $newPassword2, $user);

	if ($updatePasswordUser == 4) {
		header('Location: index.php?action=changedatauser&user=' . $user);
	}
	else {
		header('Location: index.php?action=changedatauser&user=' . $user . '&error=' . $updatePasswordUser);
	}
}

function checkImage($image)
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$addImage = $memberManager->verifyProfileImage($image);

	if ($addImage == 4) {
		header('Location: index.php?action=changedatauser&user=' . $_SESSION['pseudo']);
	}
	else {
		header('Location: index.php?action=changedatauser&user=' . $_SESSION['pseudo'] . '&error=' . $addImage);
	}
}

function updateLastConnexion($user)
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$memberManager->lastConnexion($user);
}

function showArticles($page, $type)
{
	$elementByPage = 5;
	$firstElement = -$elementByPage+($page*$elementByPage);

	$postManager = new \AchievementGet\Website\Model\PostManager();
	$fewPosts = $postManager->getFewPostsWhere($firstElement, $elementByPage, $type);
	$nbrElements = $postManager->howMuchCategoryPost($type);

	require('view/frontend/showArticlesView.php');
}

function forumView($page)
{
	$elementByPage = 15;
	$firstElement = -$elementByPage+($page*$elementByPage);

	$topicManager = new \AchievementGet\Website\Model\TopicManager();
	$fewTopics = $topicManager->getFewTopics($firstElement, $elementByPage);
	$nbrElements = $topicManager->howMuchTopic();

	require('view/frontend/homeForumView.php');
}

function addTopic($author, $title, $content)
{
	$topicManager = new \AchievementGet\Website\Model\TopicManager();

	$newTopic = $topicManager->newTopic($author, $title, $content);

	if ($newTopic === false) {
		throw new Exception('Impossible de créer un nouveau topic.');
	}
	else {
		header('Location: index.php?action=forum&page=1');
	}
}

function topicView($id, $page)
{
	$elementByPage = 8;
	$firstElement = -$elementByPage+($page*$elementByPage);

	$topicManager = new \AchievementGet\Website\Model\TopicManager();
	$messagesForumManager = new \AchievementGet\Website\Model\messagesForumManager();

	$getTopic = $topicManager->getTopicById($id);
	$listMessages = $messagesForumManager->getFewMessagesById($firstElement, $elementByPage, $id);
	$nbrElements = $messagesForumManager->howMuchMessagesById($id);

	require('view/frontend/topicView.php');
}

function addMessage($id, $message, $author)
{
	$messagesForumManager = new \AchievementGet\Website\Model\messagesForumManager();

	$addMessageForum = $messagesForumManager->addNewMessage($id, $message, $author);
	$nbrMessages = $messagesForumManager->howMuchMessagesById($id);
	$page = ceil($nbrMessages/8);

	if ($addMessageForum === false) {
		throw new Exception('Impossible d\'ajouter un message.');
	}
	else {
		header('Location: index.php?action=topic&id=' . $id . '&page=' . $page);
	}
}

function reportComm($postid, $id)
{
	$commentManager = new \AchievementGet\Website\Model\commentManager();

	$reportComment = $commentManager->reportComment($id);

	if ($reportComment === false) {
		throw new Exception('Impossible de signaler le commentaires.');
	}
	else {
		header('Location: index.php?action=readarticle&id=' . $postid);
	}
}