<?php
namespace Sophrologie\controller;
use Sophrologie\model\MessageAccueil;
use Sophrologie\model\Page;

class MsgAccueilControl
{
	//affichage du message d'accueil
	public function msgAccueilDetail()
	{
		$pageManager = new Page();
		$pageMenu = $pageManager->getListMenu();
		$msgAccueilManager = new MessageAccueil();
		$msgAccueil= $msgAccueilManager->getContentMessage();
		require('view/ViewBackEnd/msgAccueilAdminView.php');
	}

	//mise à jour du message de la page d'accueil
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