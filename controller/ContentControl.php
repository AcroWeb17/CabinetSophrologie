<?php
namespace Sophrologie\controller;
use Sophrologie\model\Content;
use Sophrologie\model\Contact;
use Sophrologie\model\Page;

class ContentControl
{
	//Administration de tous les contenus
	public function contentAllAdmin()
	{
		$contentManager = new Content();
		$contentJoin = $contentManager->getJoinContent();
		$pageManager = new Page();
		$pageMenu = $pageManager->getListMenu();
		require('view/ViewBackEnd/contentAllAdminView.php');
	}

	//Administration d'un contenu en particulier
	public function contentDetailAdmin()
	{
		$contentManager = new Content();
		$contentDetail= $contentManager->getAdminContentPage($_GET['id']);
		if ($contentDetail === false){
			throw new \Exception('Cette page n\'existe pas!');		
		} else {
			$pageManager = new Page();
			$pageMenu = $pageManager->getListMenu();
			$listPages = $pageManager->getListPages();
			$contactManager = new Contact();
			$contactContent = $contactManager->getContact();
			require('view/ViewBackEnd/contentAdminView.php');
		}
	}

	//Nouveau contenu
	public function contentNew()
	{
		$pageManager = new Page();
		$pageMenu = $pageManager->getListMenu();
		$listPages = $pageManager->getListPages();
		require 'view/ViewBackEnd/newContentView.php';	
	}

	//Ajout d'un nouveau contenu dans la base
	public function contentAdd($title, $content,$indexContent, $picture,$idPage)
	{
		if(!empty($_POST) && !empty($_POST['newTitle'])){
			$contentTitle = new Content();
			$contentVerif = $contentTitle->contentVerif($title);
			if($contentVerif==="0"){
				$pictureSrc = "";
				if (!is_null($picture) && $picture!="" && $picture['error']==0){
					$titleNormalize = $this->replaceTitle($title);
					$pictureSrc = $this->uploadPicture($picture,"public/Photos","content-".$titleNormalize);
				}
				$contentManager = new Content();
				$newContent = $contentManager->postContent($title, $content, $pictureSrc,$indexContent, $idPage);
				if ($newContent === false){
					throw new \Exception('Impossible d\'ajouter le contenu!');		
				}
				else {
					header('Location:accueil');
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

	//Mise à jour d'un contenu
	public function contentUpdate($id, $title,$picture,$noPicture, $content, $indexContent, $idPage, $latX, $longY, $nameCab, $adresse, $codePostal, $ville, $tel, $mail)
	{
		$contactManager = new Contact();
		$contactUpdate = $contactManager->modifyContact($latX, $longY, $nameCab, $adresse, $codePostal, $ville, $tel, $mail);
		$pictureSrc = "";
		$titleNormalize = $this->replaceTitle($title);
		if (!is_null($picture) && $picture!="" && $picture['error']==0){
			$pictureSrc = $this->uploadPicture($picture,"public/Photos","content-".$titleNormalize);
		}
		$contentManager = new Content();

		if ($pictureSrc==""){
			//si case est cochée je lance deletePicture et pictureSrc=""
			if($noPicture=='on'){
				$pictureSrc ="";
				$contentUpdate = $contentManager->getAdminContentPage($id);
				$oldNameContent = $contentUpdate['title'];
				$oldNameContentNormalize = $this->replaceTitle($oldNameContent);
				$this->deletePicture("public/Photos","content-".$oldNameContentNormalize);
				$contentUpdate = $contentManager->modifyContent($id, $title, $pictureSrc, $content, $indexContent,$idPage);
			} else {
				$pictureSrc = "public/Photos/content-".$titleNormalize.".jpg";
				$contentUpdate = $contentManager->getAdminContentPage($id);
				$oldNameContent = $contentUpdate['title'];
				$oldNameContentNormalize = $this->replaceTitle($oldNameContent);
				$contentUpdate = $contentManager->modifyContent($id, $title, $pictureSrc, $content, $indexContent,$idPage);
				$this->renamePicture("public/Photoscontent-".$oldNameContentNormalize.".jpg",$pictureSrc);
			}

		} else {
			$contentUpdate = $contentManager->getAdminContentPage($id);
			if ($contentUpdate['title']!=$title){
				$oldNameContent = $contentUpdate['title'];
				$oldNameContentNormalize = $this->replaceTitle($oldNameContent);
				$this->deletePicture("public/Photos","content-".$oldNameContentNormalize);
			}
			$contentUpdate = $contentManager->modifyContent($id, $title, $pictureSrc, $content, $indexContent,$idPage);
		}

		if ($contentUpdate=== false){
			throw new \Exception('Impossible d\'effectuer la mise à jour!');		
		} else {
			header('Location:admin-confirmation-actualisation-du-contenu');
			exit();
		}
	}

	//Vérification avant suppression d'un contenu
	public function verifDeleteContent($id)
	{
		$contentManager = new Content();
		$contentVerifDelete = $contentManager->getAdminContentPage($_GET['id']);
		require('view/ViewBackEnd/deleteContentView.php');
	}

	//Suppression d'un contenu
	public function contentDelete($id)
	{
		$contentManager = new Content();
		$contentDelete = $contentManager->getAdminContentPage($_GET['id']);
		$contentTitle = $contentDelete['title'];
		$contentDelete = $contentManager->suppContent($id);
		if ($content === false){
			throw new \Exception('Impossible de supprimer ce contenu!');		
		} else {
			$titleNormalize = $this->replaceTitle($contentTitle);
			$this->deletePicture("public/Photos","content-".$titleNormalize);
			header('Location: admin-confirmation-suppression-du-contenu');
			exit();	
		}
	}

	//Gestion des photos
	//Téléchargement d'une photo
	private function uploadPicture($picture, $folder, $name){
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

	//Remplacement des caractères spéciaux dans le titre
	private function replaceTitle ($title){
		$titleSimpl = str_replace(' ','-',strtolower($title));
		return preg_replace('/[^A-Za-z0-9-]/', '', $titleSimpl);
	}

	//Renommage d'une photo
	private function renamePicture ($old, $new){
		if (file_exists($old) && !file_exists($new)){
			rename($old,$new);
		}
	}	

	//Suppression d'une photo
	private function deletePicture ($folder, $name){
		if (file_exists($folder."/".$name.".jpg")){
			unlink($folder."/".$name.".jpg");
		}
	}
}