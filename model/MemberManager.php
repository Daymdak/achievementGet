<?php
namespace AchievementGet\Website\Model;

require_once("model/Manager.php");

class MemberManager extends Manager
{
	function verifyRegisterData($pseudo, $password1, $password2, $email)
	{
		$validity = true;

		$db = $this->dbConnect();
		$query = $db->query('SELECT pseudo FROM members');

		while ($data = $query->fetch())
		{
			if(strtoupper($pseudo) == strtoupper($data['pseudo'])) {
				$validity = false;
			}
		}
		if ($validity == true)
		{
			if(preg_match("#^[\S]{6,16}$#", $pseudo))
			{
				$query->closeCursor();
				if($password1 == $password2)
				{
					if(preg_match("#^[\S]{6,16}$#", $password1))
					{
						if(preg_match("#^[\S]+@[\w]+\.[\w]{2,4}$#", $email))
						{
							$query = $db->prepare('INSERT INTO members(pseudo, password, email, inscription_date) VALUES (:pseudo, :password, :email, NOW())');
							$query->execute(array(
								'pseudo' => $pseudo,
								'password' => password_hash($password1, PASSWORD_DEFAULT),
								'email' => $email
							));
							return 0;
						}
						else
							return 5;
					}
					else
						return 4;
				}
				else
					return 3;
			}
			else
				return 2;
		}
		else
			return 1;
	}
}