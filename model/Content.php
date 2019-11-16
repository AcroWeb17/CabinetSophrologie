<?php
namespace Sophrologie\model;

class Content extends DataBase
{
	private $_id,
			$_title,
			$_content,
			$_indexContent,
			$_namePage;

	//Sélectionner la liste des contenus
	public function getListContent()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT id,title, content,picture,index_content,id_page FROM content ORDER BY id_page ASC');
		return $req;
	}

	//Sélectionner les contenus en récupérant les données de la table page
	public function getJoinContent()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT t2.id,t2.title, t2.content,t2.id_page, t1.title_page, t1.contact FROM content t2 LEFT JOIN pages t1 ON t2.id_page = t1.id_page ORDER BY id_page ASC');
		return $req;
	}

	//Sélectionner le détail d'une page
	public function getContentPage($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT t2.id, t2.title, t2.content, t2.picture, t2.index_content FROM content t2 LEFT JOIN pages t1 ON t2.id_page = t1.id_page WHERE t1.name =? ORDER BY index_content ASC');
		$req->execute(array($name));
		return $req;
	}

	//Sélectionner le détail de la page contact
	public function getContentContact($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT t2.id, t2.title, t2.content, t2.index_content FROM content t2  LEFT JOIN pages t1 ON t2.id_page = t1.id_page WHERE t1.name =?  ORDER BY index_content ASC');
		$req->execute(array($name));
		$contentContact = $req->fetch();
		return $contentContact;
	}

	//Sélectionner le détail des contenus pour affichage sur la page d'administration
	public function getAdminContentPage($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content, picture, index_content, id_page FROM content WHERE id =?');
		$req->execute(array($id));
		$contentPage = $req->fetch();
		return $contentPage;
	}

	//Vérifie si le nom du contenu est existant
	public function contentVerif($title)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT COUNT(title) AS cnt FROM content WHERE title=?');
		$req->execute(array($_POST['newTitle']));
		$contentTitleVerif = $req->fetch();
		$contentCount = $contentTitleVerif['cnt'];
		return $contentCount;
	}

	//Ajouter un contenu
	public function postContent($title, $content,$picture, $indexContent,$idPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO content (title, content, picture, index_content,id_page) VALUES(?,?,?,?,?)');
		$newContent = $req->execute(array($title, $content,$picture,$indexContent, $idPage));
		return $newContent;
	}

	//Mise à jour d'un contenu
	public function modifyContent($id, $title, $picture, $content,$indexContent, $idPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE content SET title=?, content=?, index_content=?, picture=?, id_page=? WHERE id = ?');
		$pageMaj = $req->execute(array($title, $content,$indexContent, $picture, $idPage, $id));
		return $pageMaj;
	}

	//Suppression d'un contenu
	public function suppContent($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM content WHERE id=?');
		$contentDelete = $req->execute(array($id));
		return $contentDelete;
	}
}