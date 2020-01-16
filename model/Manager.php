<?php
namespace AchievementGet\Website\Model;

class Manager
{
	protected function dbConnect()
	{
		$db = new \PDO('mysql:host=localhost;dbname=ag_database;charset=utf8', 'root', '');
		return $db;
	}
}