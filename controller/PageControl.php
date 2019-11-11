<?php
namespace Sophrologie\controller;
use Sophrologie\model\Page;
use Sophrologie\model\Content;


class PageControl
{

	public function pageDetail()
	{
		$pageManager = new Page();
		$page = $pageManager->getPage($_GET['name']);

		if ($page === false){
			throw new \Exception('Cette page n\'existe pas!');		
		}
		else {

			$pageManager = new Page();
			$pageMenu = $pageManager->getListMenu();
			$pageContact = $pageManager->getContact($_GET['name']);
			if ($pageContact['contact'] === '1'){
				$contentManager = new Content();
				$content = $contentManager->getContentContact($_GET['name']);
				require('view/ViewFrontEnd/contactView.php');
			}
			else {
				$contentManager = new Content();
				$content = $contentManager->getContentPage($_GET['name']);
				require('view/ViewFrontEnd/pageView.php');
			}		
		}
	}

	public function pageAdmin()
	{
		$pageManager = new Page();
		$page = $pageManager->getListPages();
		$pageMenu = $pageManager->getListMenu();
		require('view/ViewBackEnd/pagesAdminView.php');
	}

	public function pageAdd($title, $name, $picture, $indexPage)
	{
		if(!empty($_POST) && !empty($_POST['name'])){
			$pageName = new Page();
			$namePageVerif = $pageName->pageVerif($name);
			if($namePageVerif==="0"){
				$pageManager = new Page();
				$newPage = $pageManager->postPage($title, $name, $picture,$indexPage);
				if ($newPage === false){
					throw new \Exception('Impossible d\'ajouter la page!');		
				}
				else {
					header('Location: index.php?action=accueil');
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
	
	public function pageUpdate($idPage,$name,$title,$picture, $indexPage)
	{
		$pageManager = new Page();
		$page = $pageManager->modifyPage($idPage,$name,$title,$picture, $indexPage);
		require('view/ViewBackEnd/confirmUpdatePageView.php');
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

	public function pageMenu()
	{
		$pageManager = new Page();
		$pageMenu = $pageManager->getListMenu();
		require 'view/ViewBackEnd/newPageView.php';
	}
		
}