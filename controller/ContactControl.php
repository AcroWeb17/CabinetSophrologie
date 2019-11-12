<?php
namespace Sophrologie\controller;
use Sophrologie\model\Page;
use Sophrologie\model\Contact;
use Sophrologie\model\Content;

class ContactControl
{
	//affichage du détail d'une page
	public function contactDetailAdmin()
	{
		$pageManager = new Page();
		$pageMenu = $pageManager->getListMenu();
		$contactManager = new Contact();
		$contact = $contactManager->getContact();
		$contentManager = new Content();
		$contentDetail= $contentManager->getAdminContentPage($_GET['id']);
		require('view/ViewBackEnd/contactAdminView.php');
		
	}
}