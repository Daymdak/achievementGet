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
		$query->closeCursor();

		return $topic;
	}

	public function howMuchTopics()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT COUNT(*) AS nbElement FROM topics');
		$nbrElements = $query->fetch();
		$query->closeCursor();

		return $nbrElements['nbElement'];
	}

	public function newTopic($title)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('INSERT INTO topics(title, author, creation_date, last_modification) VALUES (?, ?, NOW(), NOW())');
		$newTopic = $query->execute(array($title, $_SESSION['pseudo']));
		$query->closeCursor();

		return $newTopic;
	}

	public function idFromLastTopic()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT id FROM topics WHERE id=(select max(id) from topics)');
		$maxId = $query->fetch();
		$idTopic = $maxId['id'];
		$query->closeCursor();	

		return $idTopic;
	}

	public function lastUpdate($id)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('UPDATE topics SET last_modification = NOW() WHERE id = ?');
		$query->execute(array($id));
		$query->closeCursor();
	}
}