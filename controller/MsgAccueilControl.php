<?php
namespace Sophrologie\controller;
use Sophrologie\model\MessageAccueil;

class MsgAccueilControl
{
	//affichage du message d'accueil
	public function msgAccueilDetail()
	{
		$msgAccueilManager = new MessageAccueil();
		$msgAccueil= $msgAccueilManager->getContentMessage();
		require('view/ViewBackEnd/msgAccueilAdminView.php');
	}

	//mise à jour de la page d'accueil
	public function updateMsgAccueil($content)
	{
		$msgAccueilModify = new MessageAccueil();
		$msgAccueilMo = $msgAccueilModify->modifMsgAccueil($content);
		if ($msgAccueilMo === false){
			throw new \Exception('Impossible d\'effectuer la mise à jour!');		
		}
		else {
			header('Location: index.php');
			exit();	
		}
	}
}