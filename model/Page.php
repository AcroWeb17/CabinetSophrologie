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

	public function getPage($idPage)
	{
		$db = $this->dbConnect();
		$req= $db->prepare('SELECT idPage FROM pages WHERE idPage=?');
		$req->execute(array($idPage));
		$page = $req->fetch();
		return $page;
	}

		public function getContact($idPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT contact FROM pages WHERE idPage=?');
		$req->execute(array($idPage));
		$contact = $req->fetch();
		return $contact;
	}

	//ajouter une page
	public function postPage($title, $name, $indexPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO pages (name,titlePage,index_page,picture,contact) VALUES(?,?,?,0,0)');
		$newPage = $req->execute(array($name,$title, $indexPage));
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
	public function modifyPage($idPage, $name, $title, $indexPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE pages SET name=?, titlePage=?, index_page=? WHERE idPage=?');
		$pageMaj = $req->execute(array($name, $title, $indexPage, $idPage));
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