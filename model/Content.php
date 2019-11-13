<?php
namespace Sophrologie\model;

class Content extends DataBase
{
	private $_id,
			$_title,
			$_content,
			$_indexContent,
			$_namePage;

	//afficher la liste des contenus
	public function getListContent()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT id,title, content,picture,index_content,idPage FROM content ORDER BY idPage ASC');
		return $req;
	}

	public function getJoinContent()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT t2.id,t2.title, t2.content,t2.idPage, t1.titlePage, t1.contact FROM content t2 LEFT JOIN pages t1 ON t2.idPage = t1.idPage ORDER BY idPage ASC');
		return $req;
	}

	//afficher le détail d'une page
	public function getContentPage($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT t2.id, t2.title, t2.content, t2.picture, t2.index_content FROM content t2 LEFT JOIN pages t1 ON t2.idPage = t1.idPage WHERE t1.name =? ORDER BY index_content ASC');
		$req->execute(array($name));
		return $req;
	}


	//afficher le détail de la page contact
	public function getContentContact($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT t2.id, t2.title, t2.content, t2.index_content FROM content t2  LEFT JOIN pages t1 ON t2.idPage = t1.idPage WHERE t1.name =?  ORDER BY index_content ASC');
		$req->execute(array($name));
		$contentContact = $req->fetch();
		return $contentContact;
	}

	//afficher le détail d'une page Admin
	public function getAdminContentPage($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content, picture, index_content, idPage FROM content WHERE id =?');
		$req->execute(array($id));
		$contentPage = $req->fetch();
		return $contentPage;
	}

	//ajouter un contenu
	public function postContent($title, $content,$picture, $indexContent,$idPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO content (title, content, picture, index_content,idPage) VALUES(?,?,?,?,?)');
		$newContent = $req->execute(array($title, $content,$picture,$indexContent, $idPage));
		return $newContent;
	}

	//verifie si le nom du contenu est existant
	public function contentVerif($title)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT COUNT(title) AS cnt FROM content WHERE title=?');
		$req->execute(array($_POST['newTitle']));
		$contentTitleVerif = $req->fetch();
		$contentCount = $contentTitleVerif['cnt'];
		return $contentCount;
	}

	//modifie un contenu avec photo
	public function modifyContent($id, $title, $picture, $content,$indexContent, $idPage)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE content SET title=?, content=?, index_content=?, picture=?, idPage=? WHERE id = ?');
		$pageMaj = $req->execute(array($title, $content,$indexContent, $picture, $idPage, $id));
		return $pageMaj;
	}

	//suppression d'un contenu
	public function suppContent($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM content WHERE id=?');
		$contentDelete = $req->execute(array($id));
		return $contentDelete;
	}

}