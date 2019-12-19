<?php
namespace AchievementGet\Website\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
	public function getPostComments($id)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT * FROM comments WHERE post_id = ? ORDER BY id DESC');
		$comments->execute(array($id));

		return $comments;
	}

	public function howMuchAuthorComments($author)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT COUNT(*) AS nbcomment FROM comments WHERE author = ?');
		$query->execute(array($author));
		$nbrComments = $query->fetch();

		return $nbrComments['nbcomment'];
	}

	public function postComment($id, $messageContent)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT profileImage FROM members WHERE pseudo = ?');
		$query->execute(array($_SESSION['pseudo']));
		$avatar = $query->fetch();
		$query->closeCursor();

		$comment = $db->prepare('INSERT INTO comments(post_id, author, nameImage,comment, reports, comment_date) VALUES(?, ?, ?, ?, 0, NOW())');
		$newComment = $comment->execute(array($id, $_SESSION['pseudo'], $avatar['profileImage'],$messageContent));

		return $newComment;
	}
}