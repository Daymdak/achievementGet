<?php
namespace AchievementGet\Website\Model;

require_once("model/Manager.php");

class MemberManager extends Manager
{
	public function getMemberInformation($pseudo)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, profileImage, pseudo, password, email, phone, DATE_FORMAT(inscription_date, \'%d/%m/%Y\') as inscription_date_fr, name, firstname,DATE_FORMAT(birthdate, \'%d/%m/%Y\') as birthdate_fr, DATE_FORMAT(birthdate, \'%Y-%m-%d\') as default_birthdate, gender, country, DATE_FORMAT(last_connexion, \'%d/%m/%Y\') as last_connexion_fr, bio, role FROM members WHERE pseudo = :pseudo');
		$query->execute(array(
			'pseudo' => $pseudo
		));
		$memberInformation = $query->fetch();

		return $memberInformation;
	}

	public function getAllMembers()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT * FROM members ORDER BY id');

		return $query;
	}

	public function verifyRegisterData($pseudo, $password1, $password2, $email)
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
			$query->closeCursor();
			if($password1 == $password2)
			{
				$query = $db->prepare('INSERT INTO members(pseudo, password, email, inscription_date) VALUES (:pseudo, :password, :email, NOW())');
				$query->execute(array(
					'pseudo' => $pseudo,
					'password' => password_hash($password1, PASSWORD_DEFAULT),
					'email' => $email
				));
				$_SESSION['pseudo'] = $pseudo;
				$query->closeCursor();
				return 0;
			}
			else
				return 3;
		}
		else
			return 1;
	}

	public function beConnect($pseudo, $password, $rememberMe)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, pseudo, password, role FROM members WHERE pseudo = :pseudo');
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
					if ($result['role'] == "Administrators") {
						setcookie('role', $result['role'], time() + 365*24*3600,null, null, false, true);
					}
				}
				$_SESSION['pseudo'] = $pseudo;
				if ($result['role'] == "Administrators") {
					$_SESSION['role'] = $result['role'];
				}
				$query->closeCursor();
				return 0;
			}
			else
				return 6;
		}
		else
			return 6;
	}

	public function changeAvatar($image, $extension)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('UPDATE members SET profileimage = :image WHERE pseudo = :pseudo');
		$query->execute(array(
			'image' => $_SESSION['pseudo'] . '.' . $extension,
			'pseudo' => $_SESSION['pseudo']
		));
		$query->closeCursor();
	}

	public function changeData($firstname, $name, $country, $phone, $birthdate, $gender, $bio)
	{
		if (empty($birthdate)) {
			$birthdate = NULL;
		}
		if (empty($phone)) {
			$phone = NULL;
		}
		$db = $this->dbConnect();
		$query = $db->prepare('UPDATE members SET firstname = :firstname, name = :name, country = :country, phone = :phone, birthdate = :birthdate, gender = :gender, bio = :bio WHERE pseudo = :user');
		$query->execute(array(
			'firstname' => $firstname,
			'name' => $name,
			'country' => $country,
			'phone' => $phone,
			'birthdate' => $birthdate,
			'gender' => $gender,
			'bio' => $bio,
			'user' => $_SESSION['pseudo']
		));

		$query->closeCursor();
	}

	public function verifyPassword($password)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT password FROM members WHERE pseudo = ?');
		$query->execute(array($_SESSION['pseudo']));
		$result = $query->fetch();
		$verifyPassword = password_verify($password, $result['password']);
		$query->closeCursor();

		return $verifyPassword;
	}

	public function updatePasswordUser($verifyPassword, $newPassword, $newPassword2)
	{
		if($verifyPassword)
		{
			if ($newPassword === $newPassword2)
			{
				$db = $this->dbConnect();
				$query = $db->prepare('UPDATE members SET password = :password WHERE pseudo = :pseudo');
				$query->execute(array(
					'password' => password_hash($newPassword, PASSWORD_DEFAULT),
					'pseudo' => $_SESSION['pseudo']
				));
				$query->closeCursor();
				return 4;
			}
			else
				return 6;
		}
		else
			return 5;
	}

	public function lastConnexion()
	{
		$db = $this->dbConnect();
		$query = $db->prepare('UPDATE members SET last_connexion = NOW() WHERE pseudo = :pseudo');
		$query->execute(array(
			'pseudo' => $_SESSION['pseudo']
		));
		$query->closeCursor();
	}

	public function howMuchMembers()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT COUNT(*) AS nbElement FROM members');
		$nbrElements = $query->fetch();
		$query->closeCursor();

		return $nbrElements['nbElement'];
	}

	public function deleteMember($member)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('DELETE FROM members WHERE pseudo = :member');
		$query->execute(array(
			'member' => $member
		));
		$query->closeCursor();
	}

	public function promoteMember($member)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('UPDATE members SET role = "Administrators" WHERE pseudo = :member');
		$query->execute(array(
			'member' => $member
		));
		$query->closeCursor();
	}

	public function demoteMember($member)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('UPDATE members SET role = "Members" WHERE pseudo = :member');
		$query->execute(array(
			'member' => $member
		));
		$query->closeCursor();
	}

	public function verifyRight($member)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT role FROM members WHERE pseudo = :pseudo');
		$query->execute(array(
			'member' => $member
		));
		$role = $query->fetch();

		if ($role == "Administrators") {
			return true;
		}
		else {
			return false;
		}
		$query->closeCursor();
	}
}