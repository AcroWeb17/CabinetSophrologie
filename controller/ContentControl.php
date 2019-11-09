<?php
namespace Sophrologie\controller;
use Sophrologie\model\Content;
use Sophrologie\model\Page;


class ContentControl
{
	//affichage du détail d'une page
	public function contentDetailAdmin()
	{
		$contentManager = new Content();
		$content= $contentManager->getAdminContentPage($_GET['id']);
		if ($content === false){
			throw new \Exception('Cette page n\'existe pas!');		
		}
		else {
			$pageManager = new Page();
			$pageMenu = $pageManager->getListMenu();
			require('view/ViewBackEnd/contentAdminView.php');
		}
	}
	public function contentUpdate($id, $title, $content, $idPage)
	{
		$contentManager = new Content();
		$content = $contentManager->modifyContent($id, $title, $content, $idPage);
	
		if ($content === false){
			throw new \Exception('Impossible d\'effectuer la mise à jour!');		
		}
		else {
			header('Location: index.php?action=confirmUpdatePage&id=');
			exit();
		}
	}


	public function contentAllAdmin()
	{
		$contentManager = new Content();
		$content = $contentManager->getListContent();
		$contentJoin = $contentManager->getJoinContent();
		require('view/ViewBackEnd/contentAllAdminView.php');
	}

	public function contentAdd($title, $content, $idPage)
	{
		if(!empty($_POST) && !empty($_POST['newTitle'])){
			$contentTitle = new Content();
			$contentVerif = $contentTitle->contentVerif($title);
			if($contentVerif==="0"){
				$contentManager = new Content();
				$newContent = $contentManager->postContent($title, $content, $idPage);
				if ($newContent === false){
					throw new \Exception('Impossible d\'ajouter le contenu!');		
				}
				else {
					header('Location: index?action=accueil');
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
		$content = $contentManager->getAdminContentPage($_GET['id']);
		require('view/ViewBackEnd/deleteContentView.php');
	}

	public function contentDelete($id)
	{
		$contentManager = new Content();
		$content = $contentManager->suppContent($id);
		if ($content === false){
			throw new \Exception('Impossible de supprimer ce contenu!');		
		}
		else {
			header('Location: index.php?action=confContentDelete');
			exit();	
		}
	}
		
	

}