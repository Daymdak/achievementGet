<?php
namespace AchievementGet\Website\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
	public function getFewPosts($offset, $limit)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, nameImage, title, category,content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') as creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT :offset, :limit');
		$query->bindValue('offset', $offset, \PDO::PARAM_INT);
		$query->bindValue('limit', $limit, \PDO::PARAM_INT);
		$query->execute();

		return $query;
	}
}