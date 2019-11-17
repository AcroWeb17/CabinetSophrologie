<?php
namespace Sophrologie\model;

class Contact extends DataBase
{
	private $_id,
			$_latX,
			$_longY,
			$_name,
			$_adresse,
			$_telephone,
			$_mail;

	//Sélection des données
	public function getContact()
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, latX, longY, name, adresse, code_postal, ville, telephone, mail FROM contact WHERE id=1');
		$req->execute(array());
		$contact = $req->fetch();
		return $contact;
	}

	//Modification des données
	public function modifyContact($latX, $longY, $nameCab, $adresse, $codePostal, $ville, $tel, $mail)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE contact SET latX=?, longY=?, name=?, adresse=?, code_postal=?, ville=?, telephone=?, mail=?');
		$pageMaj = $req->execute(array($latX, $longY, $nameCab, $adresse, $codePostal, $ville, $tel, $mail));
		return $pageMaj;
	}
}	