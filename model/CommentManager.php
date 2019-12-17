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

	public function postComment($id, $messageContent)
	{
		$db = $this->dbConnect();
		$comment = $db->prepare('INSERT INTO comments(post_id, author, comment, reports, comment_date) VALUES(?, ?, ?, 0, NOW())');
		$newComment = $comment->execute(array($id, $_SESSION['pseudo'], $messageContent));

		return $newComment;
	}
}