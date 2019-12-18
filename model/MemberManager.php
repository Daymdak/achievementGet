<?php
namespace AchievementGet\Website\Model;

require_once("model/Manager.php");

class MemberManager extends Manager
{
	function getMemberInformation($pseudo)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, profileImage, pseudo, password, email, DATE_FORMAT(inscription_date, \'%d/%m/%Y\') as inscription_date_fr, DATE_FORMAT(birthdate, \'%d/%m/%Y\') as birthdate_fr, gender, country, DATE_FORMAT(last_connexion, \'%d/%m/%Y\') as last_connexion_fr, bio FROM members WHERE pseudo = :pseudo');
		$query->execute(array(
			'pseudo' => $pseudo
		));
		$memberInformation = $query->fetch();

		return $memberInformation;
	}

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
							$query = $db->prepare('INSERT INTO members(profileImage, pseudo, password, email, inscription_date) VALUES ("default.png", :pseudo, :password, :email, NOW())');
							$query->execute(array(
								'pseudo' => $pseudo,
								'password' => password_hash($password1, PASSWORD_DEFAULT),
								'email' => $email
							));
							$_SESSION['pseudo'] = $pseudo;
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

	function beConnect($pseudo, $password, $rememberMe)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, pseudo, password FROM members WHERE pseudo = :pseudo');
		$query->execute(array(
			'pseudo' => $pseudo
		));
		$result = $query->fetch();

		$verifyPassword = password_verify($password, $result['password']);

		if ($result)
		{
			if ($verifyPassword)
			{
				if ($rememberMe)
				{
					setcookie('pseudo', $result['pseudo'], time() + 365*24*3600, null, null, false, true);
					setcookie('password', $result['password'], time() + 365*24*3600, null, null, false, true);
				}
				$_SESSION['pseudo'] = $pseudo;
				return 0;
			}
			else
				return 6;
		}
		else
			return 6;
	}

	function verifyProfileImage($image)
	{
		if (isset($image) && $image['error'] == 0){
			if ($image['size'] <= 1000000) {
				$dataImage = pathinfo($image['name']);
				$extensionImage = $dataImage['extension'];
				$allowExtensions = array('jpg', 'jpeg', 'gif', 'png');

				if (in_array($extensionImage, $allowExtensions)) {
					move_uploaded_file($image['tmp_name'], 'public/images/profileimageusers/' . $_SESSION['pseudo'] . '.' . $dataImage['extension']);
					$db = $this->dbConnect();
					$query = $db->prepare('UPDATE members SET profileimage = :image WHERE pseudo = :pseudo');
					$query->execute(array(
						'image' => $_SESSION['pseudo'] . '.' . $dataImage['extension'],
						'pseudo' => $_SESSION['pseudo']
					));
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

	function lastConnexion($user)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('UPDATE members SET last_connexion = NOW() WHERE pseudo = :pseudo');
		$query->execute(array(
			'pseudo' => $user
		));
	}
}