<?php
namespace AchievementGet\Website\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
	public function getPostComments($id)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, author, comment, post_id, comment_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
		$comments->execute(array($id));

		return $comments;
	}
}