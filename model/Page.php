<?php
namespace Sophrologie\model;

class Page extends DataBase
{
	private $_id,
			$_name,
			$_title,
			$_indexPage,
			$_picture;

	//afficher la liste des pages
	public function getListPages()
	{
		$db = $this->dbConnect();
		$listPages = $db->query('SELECT idPage, name, titlePage, index_page, picture FROM pages ORDER BY index_page ASC');
		return $listPages;
	}

		public function getListMenu()
	{
		$db = $this->dbConnect();
		$listMenu = $db->query('SELECT idPage, name, titlePage, contact FROM pages ORDER BY index_page ASC');
		return $listMenu;
	}

	public function getPage($name)
	{
		$db = $this->dbConnect();
		$req= $db->prepare('SELECT idPage, name FROM pages WHERE name=?');
		$req->execute(array($name));
		$page = $req->fetch();
		return $page;
	}

		public function getContact($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT contact FROM pages WHERE name=?');
		$req->execute(array($name));
		$contact = $req->fetch();
		return $contact;
	}

	//ajouter une page
	public function postPage($title, $name, $photo, $indexPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO pages (name,titlePage,index_page,picture,contact) VALUES(?,?,?,?,0)');
		$newPage = $req->execute(array($name,$title, $indexPage,$photo));
		return $newPage;
	}

	//verifie si le nom de page est existant
	public function pageVerif($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT COUNT(name) AS cnt FROM pages WHERE name=?');
		$req->execute(array($_POST['name']));
		$pageNameVerif = $req->fetch();
		$pageCount = $pageNameVerif['cnt'];
		return $pageCount;
	}

	//modifie le contenu d'une page
	public function modifyPage($idPage, $name, $title, $picture, $indexPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE pages SET name=?, titlePage=?, index_page=?, picture=? WHERE idPage=?');
		$pageMaj = $req->execute(array($name, $title, $indexPage,$picture, $idPage));
		return $pageMaj;
	}

	//suppression d'une page
	public function suppPage($idPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM pages WHERE idPage=?');
		$pageDelete = $req->execute(array($idPage));
		return $pageDelete;
	}
}