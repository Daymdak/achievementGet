<?php
namespace AchievementGet\Website\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
	public function getFewPosts($offset, $limit)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, nameImage, title, author,category,content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') as creation_date_fr FROM posts ORDER BY id DESC LIMIT :offset, :limit');
		$query->bindValue('offset', $offset, \PDO::PARAM_INT);
		$query->bindValue('limit', $limit, \PDO::PARAM_INT);
		$query->execute();

		return $query;
	}

	public function getFewPostsWhere($offset, $limit, $category)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, nameImage, title, author,category,content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') as creation_date_fr FROM posts WHERE category = :category ORDER BY id DESC LIMIT :offset, :limit');
		$query->bindValue(':category', $category, \PDO::PARAM_STR);
		$query->bindValue('offset', $offset, \PDO::PARAM_INT);
		$query->bindValue('limit', $limit, \PDO::PARAM_INT);
		$query->execute();

		return $query;
	}

	public function howMuchCategoryPost($category)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT COUNT(*) AS nbPosts FROM posts WHERE category = ?');
		$query->execute(array($category));
		$nbrPosts = $query->fetch();
		$query->closeCursor();

		return $nbrPosts['nbPosts'];
	}

	public function getPostById($id)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, nameImage, title, author,category, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%m\') as creation_date_fr FROM posts WHERE id = ?');
		$query->execute(array($id));
		$post = $query->fetch();
		$query->closeCursor();

		return $post;
	}

	public function howMuchPosts()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT COUNT(*) AS nbElement FROM posts');
		$nbrElements = $query->fetch();
		$query->closeCursor();

		return $nbrElements['nbElement'];
	}

	public function addNewPost($title, $completeName, $category, $content)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('INSERT INTO posts(nameImage, title, author, category, content, creation_date) VALUES(:image, :title, :author, :category, :content, NOW())');
		$query->execute(array(
			'image' => $completeName,
			'title' => $title,
			'author' => $_SESSION['pseudo'],
			'category' => $category,
			'content' => $content
		));
		$query->closeCursor();
	}
}