<?php
namespace Sophrologie\controller;
use Sophrologie\model\MessageAccueil;
use Sophrologie\model\Page;

class AccueilControl
{
	//administration de la page d'accueil
	public function accueilDetail()
	{
		$msgAccueilManager = new MessageAccueil();
		$pageManager = new Page();
		$msgAccueil= $msgAccueilManager->getContentMessage();
		$page = $pageManager->getListPages();
		require('view/ViewFrontEnd/accueilView.php');
	}
}