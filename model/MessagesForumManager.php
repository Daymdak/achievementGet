<?php
namespace AchievementGet\Website\Model;

require_once("model/Manager.php");

class MessagesForumManager extends Manager
{
	public function getFewMessagesById($offset, $limit, $topic_id)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT topic_id, author, nameImage,message, DATE_FORMAT(message_date, \'%d/%m/%Y à %Hh%m\') as message_date_fr FROM messagesforum WHERE topic_id = :topic_id ORDER BY id LIMIT :offset, :limit');
		$query->bindValue(':topic_id', $topic_id, \PDO::PARAM_INT);
		$query->bindValue('offset', $offset, \PDO::PARAM_INT);
		$query->bindValue('limit', $limit, \PDO::PARAM_INT);
		$query->execute();

		return $query;
	}

	public function howMuchMessagesById($id)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT COUNT(*) AS nbMessages FROM messagesforum WHERE topic_id = ?');
		$query->execute(array($id));
		$nbrMessages = $query->fetch();

		return $nbrMessages['nbMessages'];
	}

	public function addNewMessage($id, $message, $author)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT profileImage FROM members WHERE pseudo = ?');
		$query->execute(array($_SESSION['pseudo']));
		$avatar = $query->fetch();
		$query->closeCursor();

		$db = $this->dbConnect();
		$query = $db->prepare('UPDATE topics SET last_modification = NOW() WHERE id = ?');
		$query->execute(array($id));
		$query->closeCursor();

		$db = $this->dbConnect();
		$query = $db->prepare('INSERT INTO messagesforum(topic_id, author, nameImage, message, reports, message_date) VALUES(?, ?, ?, ?, 0, NOW())');
		$newMessage = $query->execute(array($id, $author, $avatar['profileImage'], $message));
		$query->closeCursor();

		return $newMessage;
	}
}