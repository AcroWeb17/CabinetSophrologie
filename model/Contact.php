<?php
namespace Sophrologie\model;

class Contact extends DataBase
{
	private $_id,
			$_title,
			$_content;

	public function getContentContact()
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content FROM contact');
		$req->execute(array());
		$txtContact = $req->fetch();
		return $txtContact;
	}

}