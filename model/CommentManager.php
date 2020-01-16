<?php
namespace AchievementGet\Website\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
	public function getPostComments($id)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, author, nameImage, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') as comment_date_fr FROM comments WHERE post_id = ? ORDER BY id DESC');
		$query->execute(array($id));

		return $query;
	}

	public function howMuchComments()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT COUNT(*) AS nbElement FROM comments');
		$nbrElements = $query->fetch();
		$query->closeCursor();

		return $nbrElements['nbElement'];
	}

	public function eraseComment($id)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('DELETE FROM comments WHERE id= ?');
		$query->execute(array($id));
		$query->closeCursor();
	}
	
	public function getReportedComments()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT * FROM comments WHERE reports > 0 ORDER BY reports DESC');

		return $query;
	}

	public function howMuchReportedComments()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT COUNT(*) AS nbElement FROM comments WHERE reports > 0');
		$nbrElements = $query->fetch();
		$query->closeCursor();

		return $nbrElements['nbElement'];
	}

	public function howMuchAuthorComments($author)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT COUNT(*) AS nbcomment FROM comments WHERE author = ?');
		$query->execute(array($author));
		$nbrComments = $query->fetch();
		$query->closeCursor();

		return $nbrComments['nbcomment'];
	}

	public function postComment($id, $messageContent, $avatar)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('INSERT INTO comments(post_id, author, nameImage,comment, reports, comment_date) VALUES(?, ?, ?, ?, 0, NOW())');
		$newComment = $query->execute(array($id, $_SESSION['pseudo'], $avatar, $messageContent));
		$query->closeCursor();

		return $newComment;
	}

	public function getNumberOfReport($id)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT reports FROM comments WHERE id = ?');
		$query->execute(array($id));
		$data = $query->fetch();
		$numberReports = $data['reports'] + 1;
		$query->closeCursor();

		return $numberReports;
	}

	public function reportComment($id, $report)
	{	
		$db = $this->dbConnect();
		$query = $db->prepare('UPDATE comments SET reports = :newreports WHERE id = :id');
		$query->execute(array(
			'newreports' => $report,
			'id' => $id
		));
		$query->closeCursor();
	}
}