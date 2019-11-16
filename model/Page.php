<?php
namespace Sophrologie\model;

class Page extends DataBase
{
	private $_id,
			$_name,
			$_title,
			$_indexPage,
			$_picture;

	//Sélection des pages à l'exception de la page contact
	public function getListPages()
	{
		$db = $this->dbConnect();
		$listPages = $db->query('SELECT id_page, name, title_page, index_page, picture, contact FROM pages WHERE id_page != 10 ORDER BY index_page ASC');
		return $listPages;
	}

	//Affichage du menu à l'exception de la page contact
	public function getListMenu()
	{
		$db = $this->dbConnect();
		$listMenu = $db->query('SELECT id_page, name, title_page, contact FROM pages WHERE id_page != 10 ORDER BY index_page ASC');
		return $listMenu;
	}

	//Sélection des pages à partir de leur nom
	public function getPage($name)
	{
		$db = $this->dbConnect();
		$req= $db->prepare('SELECT id_page, name, title_page FROM pages WHERE name=?');
		$req->execute(array($name));
		$page = $req->fetch();
		return $page;
	}

	//Sélection des pages à partir de leur identifiant
	public function getPageFromid($idPage)
	{
		$db = $this->dbConnect();
		$req= $db->prepare('SELECT id_page, name FROM pages WHERE id_page=?');
		$req->execute(array($idPage));
		$page = $req->fetch();
		return $page;
	}

	//Sélection de la page Contact
	public function getContact($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT contact FROM pages WHERE name=?');
		$req->execute(array($name));
		$contact = $req->fetch();
		return $contact;
	}

	//Vérifie si le nom de page est existant
	public function pageVerif($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT COUNT(name) AS cnt FROM pages WHERE name=?');
		$req->execute(array($name));
		$pageNameVerif = $req->fetch();
		$pageCount = $pageNameVerif['cnt'];
		return $pageCount;
	}

	//Ajouter une page
	public function postPage($title, $name, $photo, $indexPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO pages (name,title_page,index_page,picture,contact) VALUES(?,?,?,?,0)');
		$newPage = $req->execute(array($name,$title, $indexPage,$photo));
		return $newPage;
	}

	//Modifie le contenu d'une page
	public function modifyPage($idPage, $name, $title, $picture, $indexPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE pages SET name=?, title_page=?, index_page=?, picture=? WHERE id_page=?');
		$pageMaj = $req->execute(array($name, $title, $indexPage,$picture, $idPage));
		return $pageMaj;
	}

	//Récupération des données avant suppression de la page
	public function verifDeletePage($idPage)
	{
		$db = $this->dbConnect();
		$req= $db->prepare('SELECT id_page FROM pages WHERE id_page=?');
		$req->execute(array($idPage));
		$page = $req->fetch();
		return $page;
	}

	//Suppression d'une page
	public function suppPage($idPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM pages WHERE id_page=?');
		$pageDelete = $req->execute(array($idPage));
		return $pageDelete;
	}
}