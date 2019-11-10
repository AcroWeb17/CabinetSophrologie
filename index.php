<?php

// définition des controller
session_start();
require('autoloader.php');
Autoloader::register();
use Sophrologie\controller\AccueilControl;
use Sophrologie\controller\PageControl;
use Sophrologie\controller\ContentControl;
use Sophrologie\controller\ConnectControl;
use Sophrologie\controller\MsgAccueilControl;
use Sophrologie\controller\MailControl;

try{
	if(isset($_GET['action'])){
		if($_GET['action'] == 'accueil'){
			$accueilControl = new AccueilControl();
			$accueilDetail = $accueilControl->accueilDetail();
		}

		else if ($_GET['action'] == 'page'){
			if(isset($_GET['name'])){
				$pageControl = new PageControl;
				$pageDetail = $pageControl->pageDetail();
			}
			else {
				throw new Exception('Aucun nom de page envoyé');
			}
		}

		else if ($_GET['action'] == 'contentAdmin'){
			if(isset($_GET['id'])) {
				$contentControl = new ContentControl;
				$contentDetail = $contentControl->contentDetailAdmin();
			}
			else {
				throw new Exception('Aucun titre de section envoyé');
			}
		}

		else if ($_GET['action'] == 'contentUpdate'){
			if(isset($_GET['id'])){
				$id = isset($_POST['id'])?htmlspecialchars($_POST['id']):NULL;
				$title = isset($_POST['newTitle'])?htmlspecialchars($_POST['newTitle']):NULL;
				$content = isset($_POST['content'])?htmlspecialchars($_POST['content']):NULL;
				$indexContent = isset($_POST['indexContent'])?htmlspecialchars($_POST['indexContent']):NULL;
				$idPage = isset($_POST['idPage'])?htmlspecialchars($_POST['idPage']):NULL;
				$contentControl = new ContentControl;
				$contentDetail = $contentControl->contentUpdate($_GET['id'],$title, $content, $indexContent, $idPage);
			}
			else {
				throw new Exception('Aucun identifiant de section envoyé');
			}
		}

		//création d'une nouvelle page
		else if ($_GET['action'] == 'newPage'){
			require 'view/ViewBackEnd/newPageView.php';
		}

		//ajouter une page
		else if ($_GET['action'] == 'addPage'){
			if(isset($_POST['name'])){
				$title = isset($_POST['newTitle'])?htmlspecialchars($_POST['newTitle']):NULL;
				$name = isset($_POST['name'])?htmlspecialchars($_POST['name']):NULL;
				$picture = isset($_POST['picture'])?htmlspecialchars($_POST['picture']):NULL;
				$indexPage = isset($_POST['indexPage'])?htmlspecialchars($_POST['indexPage']):NULL;
				$pageNew = new PageControl();
				$page = $pageNew->pageAdd($title, $name,$picture, $indexPage);
			}
			else {
				throw new Exception('Veuillez renseigner un nom de page valide');
			}	
		}

		//confirmation de la mise à jour d'une page
		else if ($_GET['action'] == 'confirmUpdatePage'){
			if(isset($_GET['id'])){
				require 'view/ViewBackEnd/confirmUpdatePageView.php';
			}
			else {
				throw new Exception('Aucun identifiant de section envoyé');
			}
		}

		//administration des pages
		else if ($_GET['action'] == 'pageAdmin'){
			$pageControl = new PageControl();
			$pageAdmin = $pageControl->pageAdmin();
		}

		else if ($_GET['action'] == 'pageAdminUpdate'){
			$idPage = isset($_POST['id'])?htmlspecialchars($_POST['id']):NULL;
			$title = isset($_POST['newTitle'])?htmlspecialchars($_POST['newTitle']):NULL;
			$name = isset($_POST['name'])?htmlspecialchars($_POST['name']):NULL;
			$picture = isset($_POST['picture'])?htmlspecialchars($_POST['picture']):NULL;
			$indexPage = isset($_POST['indexPage'])?htmlspecialchars($_POST['indexPage']):NULL;
			$pageControl = new PageControl;
			$pageAdminDetail = $pageControl->pageUpdate($idPage,$name,$title,$picture, $indexPage);
		}

		//confirmer la suppression d'une page
		else if ($_GET['action'] == 'confirmDeletePage'){
			if(isset($_GET['idPage']) && $_GET['idPage']>0){
				$idPage = isset($_POST['idPage'])?htmlspecialchars($_POST['idPage']):NULL;
				$title = isset($_POST['title'])?htmlspecialchars($_POST['title']):NULL;
				$name = isset($_POST['name'])?htmlspecialchars($_POST['name']):NULL;
				$indexPage = isset($_POST['index_page'])?htmlspecialchars($_POST['index_page']):NULL;
				$pageConfirm = new PageControl();
				$pageIdConfirm = $pageConfirm ->verifDeletePage($_GET['idPage']);
			}
			else {
				throw new Exception('Erreur lors de la confirmation');
			}
		}

		//supprimer une page
		else if ($_GET['action'] == 'deletePage'){
			if(isset($_GET['idPage']) && $_GET['idPage']>0){
				$idPage = isset($_POST['idPage'])?htmlspecialchars($_POST['idPage']):NULL;
				$pageControl = new PageControl();
				$pageDetail = $pageControl->pageDelete($_GET['idPage']);
			}
			else {
				throw new Exception('Erreur lors de la suppression de la page');
			}
		}

		//confirmation de la suppression d'une page
		else if ($_GET['action'] == 'confPageDelete'){
			require 'view/ViewBackEnd/confirmDeletePageView.php';
		}


		//administration des contenus
		//création d'un nouveau contenu
		else if ($_GET['action'] == 'newContent'){
			require 'view/ViewBackEnd/newContentView.php';
		}

		//ajouter un contenu
		else if ($_GET['action'] == 'addContent'){
			if(isset($_POST['newTitle'])){
				$title = isset($_POST['newTitle'])?htmlspecialchars($_POST['newTitle']):NULL;
				$content = isset($_POST['content'])?htmlspecialchars($_POST['content']):NULL;
				$idPage = isset($_POST['idPage'])?htmlspecialchars($_POST['idPage']):NULL;
				$contentNew = new ContentControl();
				$content = $contentNew->contentAdd($title, $content, $idPage);
			}
			else {
				throw new Exception('Veuillez renseigner un nom de page valide');
			}	
		}

		//confirmer la suppression d'une page
		else if ($_GET['action'] == 'confirmDeleteContent'){
			if(isset($_GET['id']) && $_GET['id']>0){
				$id = isset($_POST['id'])?htmlspecialchars($_POST['id']):NULL;
				$contentControl = new ContentControl();
				$contentDetail = $contentControl ->verifDeleteContent($_GET['id']);
			}
			else {
				throw new Exception('Erreur lors de la confirmation');
			}
		}

		//supprimer un contenu
		else if ($_GET['action'] == 'deleteContent'){
			if(isset($_GET['id']) && $_GET['id']>0){
				$idPage = isset($_POST['id'])?htmlspecialchars($_POST['id']):NULL;
				$contentControl = new ContentControl();
				$contentDetail = $contentControl->contentDelete($_GET['id']);
			}
			else {
				throw new Exception('Erreur lors de la suppression du contenu');
			}
		}

		//confirmation de la suppression d'un contenu
		else if ($_GET['action'] == 'confContentDelete'){
			require 'view/ViewBackEnd/confirmDeleteContentView.php';
		}

		else if ($_GET['action'] == 'contentAllAdmin'){
			$contentControl = new ContentControl();
			$contentAdmin = $contentControl->contentAllAdmin();
		}

		else if ($_GET['action'] == 'contact'){
			$contactControl = new ContactControl();
			$contactDetail = $contactControl->contactDetail();
		}

		else if ($_GET['action'] == 'mentionsLegales'){
			require 'view/ViewFrontEnd/mentionsLegales.php';
		}


		else if($_GET['action'] == 'msgAccueil'){
			$msgControl = new MsgAccueilControl();
			$msgDetail = $msgControl->msgAccueilDetail();
		}

		else if($_GET['action'] == 'updateMsgAccueil'){
			$msgAccueilContent = isset($_POST['content'])?htmlspecialchars($_POST['content']):NULL;
			$msgControl = new MsgAccueilControl();
			$msgDetail = $msgControl->updateMsgAccueil($msgAccueilContent);
		}

		//interface de connexion
		else if($_GET['action'] == 'connect'){
			$connectControl = new ConnectControl();
			$connect = $connectControl->connect();
		}

		//déconnexion
		else if($_GET['action'] == 'deconnect'){
			$connectControl = new ConnectControl();
			$connect = $connectControl->deconnect();
		}

		//authentification
		else if($_GET['action'] == 'interfaceAdmin'){
			$login = isset($_POST['login'])?htmlspecialchars($_POST['login']):NULL;
			$password = (isset($_POST['passwordUser'])?htmlspecialchars($_POST['passwordUser']):NULL);
			$connectControl = new ConnectControl();
			$admin = $connectControl->interfaceAdmin($login,$password);
		}

		//modification du mot de passe
		else if($_GET['action'] == 'newPassword'){
			require ('view/ViewBackEnd/newPassword.php');
		}
		
		//mise à jour du mot de passe
		else if ($_GET['action'] == 'updatePassword'){
			$login = isset($_POST['login'])?htmlspecialchars($_POST['login']):NULL;
			$password = (isset($_POST['password'])?htmlspecialchars($_POST['password']):NULL);
			$newPassword = (isset($_POST['newPassword'])?htmlspecialchars($_POST['newPassword']):NULL);
			$confNewPassword = (isset($_POST['confirmNewPassword'])?htmlspecialchars($_POST['confirmNewPassword']):NULL);
			$connectControl = new ConnectControl();
			$admin = $connectControl->updatePassword($login, $password, $newPassword, $confNewPassword);
		}

		else if ($_GET['action'] == 'sendMessage'){
			$firstName = isset($_POST['prenomUser'])?htmlspecialchars($_POST['prenomUser']):NULL;
			$lastName = (isset($_POST['nomUser'])?htmlspecialchars($_POST['nomUser']):NULL);
			$mail = (isset($_POST['mailUser'])?htmlspecialchars($_POST['mailUser']):NULL);
			$tel = (isset($_POST['telUser'])?htmlspecialchars($_POST['telUser']):NULL);
			$message = (isset($_POST['msgUser'])?htmlspecialchars($_POST['msgUser']):NULL);
			$mailControl = new MailControl();
			$contactMail = $mailControl->sendContactMail($firstName,$lastName,$mail,$tel,$message);
		}

		else if ($_GET['action'] == 'erreur404'){
			require 'view/ViewFrontEnd/error404View.php';
		}
	}
	else {
		$accueilControl = new AccueilControl();
		$accueilDetail = $accueilControl->accueilDetail();
	}

}

catch(Exception $e){
	$errorMessage = $e->getMessage();
	require('view/ViewFrontEnd/errorView.php');
}

?>