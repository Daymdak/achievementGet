<?php
namespace AchievementGet\Website\Model;

require_once("model/Manager.php");

class MessagesForumManager extends Manager
{
	public function getFewMessagesById($offset, $limit, $topic_id)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT topic_id, author, nameImage,message, DATE_FORMAT(message_date, \'%d/%m/%Y à %Hh%i\') as message_date_fr FROM messagesforum WHERE topic_id = :topic_id ORDER BY id LIMIT :offset, :limit');
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
		$query->closeCursor();

		return $nbrMessages['nbMessages'];
	}

	public function eraseMessage($id)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('DELETE FROM messagesforum WHERE id= ?');
		$query->execute(array($id));
		$query->closeCursor();
	}

	public function getReportedMessages()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT * FROM messagesforum WHERE reports > 0 ORDER BY reports DESC');
		return $query;
	}

	public function howMuchMessages()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT COUNT(*) AS nbElement FROM messagesforum');
		$nbrElements = $query->fetch();
		$query->closeCursor();

		return $nbrElements['nbElement'];
	}

	public function howMuchReportedMessages()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT COUNT(*) AS nbElement FROM messagesforum WHERE reports > 0');
		$nbrElements = $query->fetch();
		$query->closeCursor();

		return $nbrElements['nbElement'];
	}

	public function addNewMessage($id, $message, $avatar)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('INSERT INTO messagesforum(topic_id, author, nameImage, message, reports, message_date) VALUES(?, ?, ?, ?, 0, NOW())');
		$newMessage = $query->execute(array($id, $_SESSION['pseudo'], $avatar, $message));
		$query->closeCursor();

		return $newMessage;
	}
}