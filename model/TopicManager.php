<?php
namespace AchievementGet\Website\Model;

require_once("model/Manager.php");

class TopicManager extends Manager
{
	public function getFewTopics($offset, $limit)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, title, author, DATE_FORMAT(creation_date, \'%d/%m/%Y\') as creation_date_fr, DATE_FORMAT(last_modification, \'%d/%m/%Y\') as last_modification_fr, last_modification FROM topics ORDER BY last_modification DESC LIMIT :offset, :limit');
		$query->bindValue('offset', $offset, \PDO::PARAM_INT);
		$query->bindValue('limit', $limit, \PDO::PARAM_INT);
		$query->execute();

		return $query;
	}

	public function getTopicById($id)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, title, author FROM topics WHERE id = ?');
		$query->execute(array($id));
		$topic = $query->fetch();

		return $topic;
	}

	public function howMuchTopic()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT COUNT(*) AS nbTopics FROM topics');
		$nbrTopics = $query->fetch();

		return $nbrTopics['nbTopics'];
	}

	public function newTopic($author, $title, $content)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT profileImage FROM members WHERE pseudo = ?');
		$query->execute(array($author));
		$avatar = $query->fetch();
		$query->closeCursor();

		$topic = $db->prepare('INSERT INTO topics(title, author, creation_date, last_modification) VALUES (?, ?, NOW(), NOW())');
		$newTopic = $topic->execute(array($title, $author));
		$topic->closeCursor();

		$query = $db->query('SELECT id FROM topics WHERE id=(select max(id) from topics)');
		$maxId = $query->fetch();
		$idTopic = $maxId['id'];
		$query->closeCursor();

		$query = $db->prepare('INSERT INTO messagesforum(topic_id, author, nameImage, message, reports, message_date) VALUES(?, ?, ?, ?, 0, NOW())');
		$firstmessage = $query->execute(array($idTopic, $author, $avatar['profileImage'], $content));
		$query->closeCursor();

		return $newTopic;
	}
}