<?php
namespace Sophrologie\model;

class MessageAccueil extends DataBase
{
	private $_id,
			$_content;

	//affichage de le message d'accueil
	public function getContentMessage()
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, content FROM msg_accueil WHERE id=1');
		$req->execute(array());
		$txtPresentation = $req->fetch();
		return $txtPresentation;
	}

	//mise à jour du message d'accueil
	public function modifMsgAccueil($content)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE msg_accueil SET content=? WHERE id =1');
		$majMsgAccueil =$req->execute(array($content));
		return $majMsgAccueil;
	}

}
