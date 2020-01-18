<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MemberManager.php');
require_once('model/TopicManager.php');
require_once('model/MessagesForumManager.php');
require_once('model/UtilitaryManager.php');

function homePage()
{
	$postManager = new \AchievementGet\Website\Model\PostManager();
	$posts = $postManager->getFewPosts(0, 6);
	$morePosts = $postManager->getFewPosts(6, 10);

	require('view/frontend/homePageView.php');
}

function readArticle($id)
{
	if (isset($id) && $id > 0)
	{
		$postManager = new \AchievementGet\Website\Model\PostManager();
		$commentManager = new \AchievementGet\Website\Model\CommentManager();

		$post = $postManager->getPostById($id);
		$comments = $commentManager->getPostComments($_GET['id']);

		require('view/frontend/readArticleView.php');	
	}
	else {
		throw new Exception('Aucun identifiant de billet envoyé.');
	}
}

function loginView()
{
	if (!isset($_SESSION['pseudo']))
	{
		require('view/frontend/loginView.php');
	}
	else {
		homepage();
	}
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
	setcookie('role', '');

	header('Location: index.php');
}

function addComment($id, $messageContent)
{
	if (isset($id) && $id > 0)
	{
		$commentManager = new \AchievementGet\Website\Model\CommentManager();
		$memberManager = new \AchievementGet\Website\Model\MemberManager();

		$avatar = $memberManager->getMemberInformation($_SESSION['pseudo']);
		$newComment = $commentManager->postComment($id, $messageContent, $avatar['profileImage']);

		if ($newComment === false) {
			throw new Exception('Impossible d\'ajouter le commentaire !');
		}
		else {
			header('Location: index.php?action=readarticle&id=' . $id);
		}	
	}
	else {
		throw new Exception('Aucun identifiant de billet envoyé.');
	}
}

function userProfile($user)
{
	if (isset($user))
	{
		$memberManager = new \AchievementGet\Website\Model\MemberManager();
		$commentManager = new \AchievementGet\Website\Model\CommentManager();

		$memberInformation = $memberManager->getMemberInformation($user);
		$nbrComments = $commentManager->howMuchAuthorComments($user);

		require('view/frontend/userProfileView.php');
	}
	else {
		throw new Exception('Aucun nom d\'utilisateur envoyé.');
	}
}

function changeDataUser($user)
{
	if (isset($user))
	{
		$memberManager = new \AchievementGet\Website\Model\MemberManager();
		$memberInformation = $memberManager->getMemberInformation($user);

		require('view/frontend/changeDataUserView.php');	
	}
	else {
		throw new Exception('Aucun nom d\'utilisateur envoyé.');
	}
}

function updateDataUser($user, $firstname, $name, $country, $phone, $birthdate, $gender, $bio) {
	if (isset($user))
	{
		$memberManager = new \AchievementGet\Website\Model\MemberManager();
		$updateData = $memberManager->changeData($firstname, $name, $country, $phone, $birthdate, $gender, $bio);

		if ($updateData === false) {
			throw new Exception('Impossible de mettre à jour le profil');
		}
		else {
			header('Location: index.php?action=changedatauser&user=' . $_SESSION['pseudo']);
		}
	}
	else {
		throw new Exception('Aucun nom d\'utilisateur envoyé.');
	}
}

function updatePassword($user, $exPassword, $newPassword, $newPassword2) {
	if (isset($user))
	{
		$memberManager = new \AchievementGet\Website\Model\MemberManager();

		$verifyPassword = $memberManager->verifyPassword($exPassword);
		$updatePasswordUser = $memberManager->updatePasswordUser($verifyPassword, $newPassword, $newPassword2);

		if ($updatePasswordUser == 4) {
			header('Location: index.php?action=changedatauser&user=' . $_SESSION['pseudo']);
		}
		else {
			header('Location: index.php?action=changedatauser&user=' . $_SESSION['pseudo'] . '&error=' . $updatePasswordUser);
		}
	}
	else {
		throw new Exception('Aucun nom d\'utilisateur envoyé.');
	}
}

function updateAvatar($image)
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();
	$utilitaryManager = new \AchievementGet\Website\Model\utilitaryManager();

	$extension = $utilitaryManager->verifyProfileImage($image);

	if ($extension >= 1 && $extension <= 3) {
		header('Location: index.php?action=changedatauser&user=' . $_SESSION['pseudo'] . '&error=' . $extension);
	}
	else {
		$memberManager->changeAvatar($image, $extension);
		header('Location: index.php?action=changedatauser&user=' . $_SESSION['pseudo']);
	}
}

function updateLastConnexion()
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();

	$memberManager->lastConnexion();
}

function showArticles($page, $type)
{
	if (isset($page) && $page > 0)
	{
		if (isset($type))
		{
			$elementByPage = 5;
			$firstElement = -$elementByPage+($page*$elementByPage);

			$postManager = new \AchievementGet\Website\Model\PostManager();
			$fewPosts = $postManager->getFewPostsWhere($firstElement, $elementByPage, $type);
			$nbrElements = $postManager->howMuchCategoryPost($type);

			require('view/frontend/showArticlesView.php');
		}
		else {
			throw new Exception('Aucun type d\'article envoyé.');
		}
	}
	else {
		throw new Exception('Aucun numéro de page envoyé.');
	}
}

function forumView($page)
{
	if (isset($page) && $page > 0)
	{
		$elementByPage = 15;
		$firstElement = -$elementByPage+($page*$elementByPage);

		$topicManager = new \AchievementGet\Website\Model\TopicManager();
		$fewTopics = $topicManager->getFewTopics($firstElement, $elementByPage);
		$nbrElements = $topicManager->howMuchTopics();

		require('view/frontend/homeForumView.php');
	}
	else {
		throw new Exception('Aucun numéro de page envoyé.');
	}
	
}

function addTopic($title, $content)
{
	$memberManager = new \AchievementGet\Website\Model\MemberManager();
	$topicManager = new \AchievementGet\Website\Model\TopicManager();
	$messagesForumManager = new \AchievementGet\Website\Model\MessagesForumManager();

	$avatar = $memberManager->getMemberInformation($_SESSION['pseudo']);
	$newTopic = $topicManager->newTopic($title);
	$idTopic = $topicManager->idFromLastTopic();
	$newMessage = $messagesForumManager->addNewMessage($idTopic, $content, $avatar['profileImage']);

	if ($newTopic === false) {
		throw new Exception('Impossible de créer un nouveau topic.');
	}
	else {
		header('Location: index.php?action=forum&page=1');
	}
}

function topicView($id, $page)
{
	if (isset($id) && $id > 0)
	{
		if (isset($page) && $page > 0)
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
		else {
			throw new Exception('Aucun numéro de page envoyé.');
		}
	}
	else {
		throw new Exception('Aucun identifiant de sujet envoyé.');
	}
}

function addMessage($id, $user,$message)
{
	if(isset($id) && $id > 0)
	{
		$messagesForumManager = new \AchievementGet\Website\Model\messagesForumManager();
		$memberManager = new \AchievementGet\Website\model\memberManager();
		$topicManager = new \AchievementGet\Website\Model\TopicManager();

		$avatar = $memberManager->getMemberInformation($user);
		$addMessageForum = $messagesForumManager->addNewMessage($id, $message, $avatar['profileImage']);
		$lastUpdate = $topicManager->lastUpdate($id);
		$nbrMessages = $messagesForumManager->howMuchMessagesById($id);
		$page = ceil($nbrMessages/8);

		if ($addMessageForum === false) {
			throw new Exception('Impossible d\'ajouter un message.');
		}
		else {
			header('Location: index.php?action=topic&id=' . $id . '&page=' . $page);
		}
	}
	else {
		throw new Exception('Aucun identifiant de sujet envoyé.');
	}
}

function reportComm($postid, $id)
{
	if (isset($id) && $id > 0) {
		if (isset($postid) && $postid > 0)
		{
			$commentManager = new \AchievementGet\Website\Model\CommentManager();

			$numberOfReport = $commentManager->getNumberOfReport($id);
			$reportComment = $commentManager->reportComment($id, $numberOfReport);

			if ($reportComment === false) {
				throw new Exception('Impossible de signaler le commentaires.');
			}
			else {
				header('Location: index.php?action=readarticle&id=' . $postid);
			}
		}
		else {
			throw new Exception('Aucun identifiant de billet envoyé.');
		}
	}
	else {
		throw new Exception('Aucun identifiant de commentaire envoyé.');
	}
}