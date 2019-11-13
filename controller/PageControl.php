<?php
namespace Sophrologie\controller;
use Sophrologie\model\Page;
use Sophrologie\model\Content;
use Sophrologie\model\Contact;


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
				$contactManager = new Contact();
				$contact = $contactManager->getContact();
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
				$pictureSrc = "";
				if(!is_null($picture) && $picture!="" && $picture['error']==0){
					$pictureSrc = $this->uploadPicture($picture, "public/Photos","page-".$name);
				}
				if ($pictureSrc = ""){
					throw new \Exception('La photo n\'est pas conforme');
				} else {
					$pageManager = new Page();
					$newPage = $pageManager->postPage($title, $name, $pictureSrc,$indexPage);
					if ($newPage === false){
						throw new \Exception('Impossible d\'ajouter la page!');		
					}
					else {
						header('Location: index.php?action=accueil');
						exit();
					}
				}
			} else {
				throw new \Exception('Cette page existe déjà');
			}
		} 
		else {
			throw new \Exception('Nom de page non conforme!');	
		}
	}
	
	public function pageUpdate($idPage,$name,$title,$picture, $indexPage)
	{
		$pictureSrc = "";
		if(!is_null($picture) && $picture!="" && $picture['error']==0){
			$pictureSrc = $this->uploadPicture($picture,"public/Photos","page-".$name);
		}
		$pageManager = new Page();
		if ($pictureSrc == ""){
			$pictureSrc = "public/Photos/page-".$name.".jpg";
			$page = $pageManager->getPageFromId($idPage);
			$oldNamePage = $page['name'];
			$page = $pageManager->modifyPage($idPage,$name,$title,$pictureSrc, $indexPage);
			$this->renamePicture("public/Photos/page-".$oldNamePage.".jpg",$pictureSrc);

		} else {
			$page = $pageManager->getPageFromId($idPage);
			if ($page['name']!=$name){
				$this->deletePicture("public/Photos","page-".$page['name']);
			}
			$page = $pageManager->modifyPage($idPage,$name,$title,$pictureSrc, $indexPage);
		}
		require('view/ViewBackEnd/confirmUpdatePageView.php');
	}

	public function verifDeletePage($idPage)
	{
		$pageManager = new Page();
		$page = $pageManager->verifDeletePage($idPage);
		require('view/ViewBackEnd/deletePageView.php');
	}

	public function pageDelete($idPage)
	{
		$pageManager = new Page();
		$page = $pageManager->getPageFromId($idPage);
		$pageName = $page['name'];
		$page = $pageManager->suppPage($idPage);
		if ($page === false){
			throw new \Exception('Suppression impossible. Vider la page de son contenu avant de la supprimer à nouveau!');		
		}
		else {
			$this->deletePicture("public/Photos","page-".$pageName);
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

	private function uploadPicture($picture,$folder,$name){
		$extension = pathinfo($picture['name'])['extension'];
		if ($extension!="jpg" && $extension!="jpeg"){
			return "";
		} else {
			$path = $folder."/".$name.".jpg";
			if (move_uploaded_file($picture["tmp_name"],$path)){
				return $path;
			} else {
				return "";
			}
		}
	}

	private function renamePicture ($old, $new){
		if (file_exists($old) && !file_exists($new)){
			rename($old,$new);
		}
	}

	private function deletePicture ($folder, $name){
		if (file_exists($folder."/".$name.".jpg")){
			unlink($folder."/".$name.".jpg");
		}
	}
		
}