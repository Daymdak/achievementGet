<?php
namespace AchievementGet\Website\Model;

class Manager
{
	protected function dbConnect()
	{
		$db = new \PDO('mysql:host=localhost;dbname=AG_database;charset=utf8', 'root', '');
		return $db;
	}
}