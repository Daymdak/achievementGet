<?php
namespace AchievementGet\Website\Model;

class UtilitaryManager
{
	public function verifyProfileImage($image)
	{
		if (isset($image) && $image['error'] == 0){
			if ($image['size'] <= 1000000) {
				$dataImage = pathinfo($image['name']);
				$extensionImage = $dataImage['extension'];
				$allowExtensions = array('jpg', 'jpeg', 'gif', 'png');

				if (in_array($extensionImage, $allowExtensions)) {
					move_uploaded_file($image['tmp_name'], 'public/images/profileimageusers/' . $_SESSION['pseudo'] . '.' . $dataImage['extension']);
					return $dataImage['extension'];
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

	public function verifyArticleImage($title, $image)
	{
		$nameImage = preg_replace('#\W*#', "", $title);

		if (isset($image) && $image['error'] == 0){
			if ($image['size'] <= 1000000) {
				$dataImage = pathinfo($image['name']);
				$extensionImage = $dataImage['extension'];
				$allowExtensions = array('jpg', 'jpeg', 'gif', 'png');

				if (in_array($extensionImage, $allowExtensions)) {
					$completeName = $nameImage . "." . $dataImage['extension'];
					move_uploaded_file($image['tmp_name'], 'public/images/postimages/' . $completeName);

					return $completeName;
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