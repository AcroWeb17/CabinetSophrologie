<?php
namespace Sophrologie\controller;
use Sophrologie\model\MessageAccueil;
use Sophrologie\model\Page;
use Sophrologie\model\Contact;

class AccueilControl
{
	//administration de la page d'accueil
	public function accueilDetail()
	{
		$msgAccueilManager = new MessageAccueil();
		$pageManager = new Page();
		$contactManager = new Contact();
		$msgAccueil= $msgAccueilManager->getContentMessage();
		$page = $pageManager->getListPages();
		$contact = $contactManager->getContentContact();
		require('view/ViewFrontEnd/accueilView.php');
	}
}