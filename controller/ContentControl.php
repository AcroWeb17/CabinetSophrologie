<?php
namespace Sophrologie\controller;
use Sophrologie\model\Content;
use Sophrologie\model\Contact;
use Sophrologie\model\Page;


class ContentControl
{
	//affichage du détail d'une page
	public function contentDetailAdmin()
	{
		$contentManager = new Content();
		$contentDetail= $contentManager->getAdminContentPage($_GET['id']);
		if ($contentDetail === false){
			throw new \Exception('Cette page n\'existe pas!');		
		}
		else {
			$pageManager = new Page();
			$pageMenu = $pageManager->getListMenu();
			$listPages = $pageManager->getListPages();
			$contactManager = new Contact();
			$contactContent = $contactManager->getContact();
			require('view/ViewBackEnd/contentAdminView.php');
		}
	}
	public function contentUpdate($id, $title, $content, $indexContent, $idPage, $latX, $longY, $nameCab, $adresse, $codePostal, $ville, $tel, $mail)
	{
		$contentManager = new Content();
		$contentUpdate = $contentManager->modifyContent($id, $title, $content, $indexContent, $idPage);
		$contactManager = new Contact();
		$contactUpdate = $contactManager->modifyContact($latX, $longY, $nameCab, $adresse, $codePostal, $ville, $tel, $mail);
		if ($contentUpdate=== false){
			throw new \Exception('Impossible d\'effectuer la mise à jour!');		
		}
		else {
			header('Location: index.php?action=confirmUpdateContent&id=');
			exit();
		}
	}


	public function contentAllAdmin()
	{
		$contentManager = new Content();
		$contentJoin = $contentManager->getJoinContent();
		$pageManager = new Page();
		$pageMenu = $pageManager->getListMenu();
		require('view/ViewBackEnd/contentAllAdminView.php');
	}


	public function contentNew()
	{
		$pageManager = new Page();
		$pageMenu = $pageManager->getListMenu();
		$listPages = $pageManager->getListPages();
		require 'view/ViewBackEnd/newContentView.php';	
	}

	public function contentAdd($title, $content,$indexContent, $idPage)
	{
		if(!empty($_POST) && !empty($_POST['newTitle'])){
			$contentTitle = new Content();
			$contentVerif = $contentTitle->contentVerif($title);
			if($contentVerif==="0"){
				$contentManager = new Content();
				$newContent = $contentManager->postContent($title, $content,$indexContent, $idPage);
				if ($newContent === false){
					throw new \Exception('Impossible d\'ajouter le contenu!');		
				}
				else {
					header('Location: index.php?action=accueil');
					exit();
				}
			}
			else {
				throw new \Exception('Cet contenu existe déjà');
			}
		} 
		else {
			throw new \Exception('Nom du contenu non conforme!');	
		}

	}

		public function verifDeleteContent($id)
	{
		$contentManager = new Content();
		$contentVerifDelete = $contentManager->getAdminContentPage($_GET['id']);
		require('view/ViewBackEnd/deleteContentView.php');
	}

	public function contentDelete($id)
	{
		$contentManager = new Content();
		$contentDelete = $contentManager->suppContent($id);
		if ($content === false){
			throw new \Exception('Impossible de supprimer ce contenu!');		
		}
		else {
			header('Location: index.php?action=confContentDelete');
			exit();	
		}
	}

			


}