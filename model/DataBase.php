<?php
namespace Sophrologie\model;
class DataBase
{
	//connexion à la base de données
	protected function dbConnect()
	{
		$db = new \PDO('mysql:host=localhost;dbname=sophrologie;charset=utf8','root','');
		return $db;		
	}
}
