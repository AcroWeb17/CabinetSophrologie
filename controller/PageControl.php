<?php
namespace Sophrologie\controller;
use Sophrologie\model\Page;
use Sophrologie\model\Content;


class PageControl
{

	public function pageDetail()
	{
		$pageManager = new Page();
		$page = $pageManager->getPage($_GET['idPage']);

		if ($page === false){
			throw new \Exception('Cette page n\'existe pas!');		
		}
		else {

			$pageManager = new Page();
			$pageMenu = $pageManager->getListMenu();
			$pageContact = $pageManager->getContact($_GET['idPage']);
			if ($pageContact['contact'] === '1'){
				$contentManager = new Content();
				$content = $contentManager->getContentContact($_GET['idPage']);
				require('view/ViewFrontEnd/contactView.php');
			}
			else {
				$contentManager = new Content();
				$content = $contentManager->getContentPage($_GET['idPage']);
				require('view/ViewFrontEnd/pageView.php');
			}		
		}
	}

	public function pageAdmin()
	{
		$pageManager = new Page();
		$page = $pageManager->getListPages();
		require('view/ViewBackEnd/pagesAdminView.php');
	}

	public function pageAdd($title, $name, $indexPage)
	{
		if(!empty($_POST) && !empty($_POST['name'])){
			$pageName = new Page();
			$namePageVerif = $pageName->pageVerif($name);
			if($namePageVerif==="0"){
				$pageManager = new Page();
				$newPage = $pageManager->postPage($title, $name, $indexPage);
				if ($newPage === false){
					throw new \Exception('Impossible d\'ajouter la page!');		
				}
				else {
					header('Location: index?action=accueil');
					exit();
				}
			}
			else {
				throw new \Exception('Cette page existe déjà');
			}
		} 
		else {
			throw new \Exception('Nom de page non conforme!');	
		}

	}
	
	public function pageUpdate($idPage,$name,$title, $indexPage)
	{
		$pageManager = new Page();
		$page = $pageManager->modifyPage($idPage,$name,$title, $indexPage);
		require('view/ViewBackEnd/confirmUpdatePageAdminView.php');
	}

	public function verifDeletePage($idPage)
	{
		$pageManager = new Page();
		$page = $pageManager->getPage($_GET['idPage']);
		require('view/ViewBackEnd/deletePageView.php');
	}

	public function pageDelete($idPage)
	{
		$pageManager = new Page();
		$page = $pageManager->suppPage($idPage);
		if ($page === false){
			throw new \Exception('Impossible de supprimer cette page!');		
		}
		else {
			header('Location: index.php?action=confPageDelete');
			exit();	
		}
	}



}