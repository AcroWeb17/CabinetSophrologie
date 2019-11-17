<?php

// définition des controller
session_start();
require('autoloader.php');
Autoloader::register();
use Sophrologie\controller\AccueilControl;
use Sophrologie\controller\PageControl;
use Sophrologie\controller\ContentControl;
use Sophrologie\controller\ContactControl;
use Sophrologie\controller\ConnectControl;
use Sophrologie\controller\MsgAccueilControl;
use Sophrologie\controller\MailControl;

try{
	if(isset($_GET['action'])){
		//Affichage de la page d'accueil
		if($_GET['action'] == 'accueil'){
			$accueilControl = new AccueilControl();
			$accueilDetail = $accueilControl->accueilDetail();
		}

		//Affichage du message d'accueil
		else if($_GET['action'] == 'msgAccueil'){
			$msgControl = new MsgAccueilControl();
			$msgDetail = $msgControl->msgAccueilDetail();
		}

		//Mise à jour du message d'accueil
		else if($_GET['action'] == 'updateMsgAccueil'){
			$msgAccueilContent = isset($_POST['content'])?htmlspecialchars($_POST['content']):NULL;
			$msgControl = new MsgAccueilControl();
			$msgDetail = $msgControl->updateMsgAccueil($msgAccueilContent);
		}

		//Interface de connexion
		else if($_GET['action'] == 'connect'){
			$connectControl = new ConnectControl();
			$connect = $connectControl->connect();
		}

		//Authentification
		else if($_GET['action'] == 'interfaceAdmin'){
			$login = isset($_POST['login'])?htmlspecialchars($_POST['login']):NULL;
			$password = (isset($_POST['passwordUser'])?htmlspecialchars($_POST['passwordUser']):NULL);
			$connectControl = new ConnectControl();
			$admin = $connectControl->interfaceAdmin($login,$password);
		}

		//Modification du mot de passe
		else if($_GET['action'] == 'newPassword'){
			require ('view/ViewBackEnd/newPasswordView.php');
		}

		//Mise à jour du mot de passe
		else if ($_GET['action'] == 'updatePassword'){
			$login = isset($_POST['login'])?htmlspecialchars($_POST['login']):NULL;
			$password = (isset($_POST['password'])?htmlspecialchars($_POST['password']):NULL);
			$newPassword = (isset($_POST['newPassword'])?htmlspecialchars($_POST['newPassword']):NULL);
			$confNewPassword = (isset($_POST['confirmNewPassword'])?htmlspecialchars($_POST['confirmNewPassword']):NULL);
			$connectControl = new ConnectControl();
			$admin = $connectControl->updatePassword($login, $password, $newPassword, $confNewPassword);
		}

		//Mot de passe oublié
		else if($_GET['action'] == 'forgetPassword'){
			require ('view/ViewFrontEnd/forgetPasswordView.php');
		}

		//Envoie d'un nouveau mot de passe
		else if($_GET['action'] == 'sendNewPassword'){
			$mailUser = (isset($_POST['mailUser'])?htmlspecialchars($_POST['mailUser']):NULL);
			$mailControl = new MailControl();
			$contactMail = $mailControl->sendNewPwd($mailUser);
		}

		//Déconnexion
		else if($_GET['action'] == 'deconnect'){
			$connectControl = new ConnectControl();
			$connect = $connectControl->deconnect();
		}

		//Gestion des pages
		//Affichage des pages
		else if ($_GET['action'] == 'page'){
			if(isset($_GET['name'])){
				$pageControl = new PageControl;
				$pageDetail = $pageControl->pageDetail();
			}
			else {
				throw new Exception('Aucun nom de page envoyé');
			}
		}

		//Formulaire de création d'une nouvelle page
		else if ($_GET['action'] == 'newPage'){
			$pageNew = new PageControl();
			$page = $pageNew->pageMenu();
		}

		//Ajout d'une page
		else if ($_GET['action'] == 'addPage'){
			if(isset($_POST['name'])){
				$title = isset($_POST['newTitle'])?htmlspecialchars($_POST['newTitle']):NULL;
				$name = isset($_POST['name'])?htmlspecialchars($_POST['name']):NULL;
				$picture = isset($_FILES['picture'])?$_FILES['picture']:NULL;
				$indexPage = isset($_POST['indexPage'])?htmlspecialchars($_POST['indexPage']):NULL;
				$pageNew = new PageControl();
				$page = $pageNew->pageAdd($title, $name,$picture, $indexPage);
			}
			else {
				throw new Exception('Veuillez renseigner un nom de page valide');
			}	
		}

		//Administration des pages
		else if ($_GET['action'] == 'pageAdmin'){
			$pageControl = new PageControl();
			$pageAdmin = $pageControl->pageAdmin();
		}

		//Mise à jour d'une page
		else if ($_GET['action'] == 'pageAdminUpdate'){
			$idPage = isset($_POST['id'])?htmlspecialchars($_POST['id']):NULL;
			$title = isset($_POST['newTitle'])?htmlspecialchars($_POST['newTitle']):NULL;
			$name = isset($_POST['name'])?htmlspecialchars($_POST['name']):NULL;
			$picture = isset($_FILES['picture'])?$_FILES['picture']:NULL;
			$indexPage = isset($_POST['indexPage'])?htmlspecialchars($_POST['indexPage']):NULL;
			$pageControl = new PageControl;
			$pageAdminDetail = $pageControl->pageUpdate($idPage,$name,$title,$picture, $indexPage);
		}

		//Confirmation de la mise à jour d'une page
		else if ($_GET['action'] == 'confirmUpdatePage'){
			require 'view/ViewBackEnd/confirmUpdatePageView.php';
		}

		//Formulaire de confirmation avant la suppression d'une page
		else if ($_GET['action'] == 'confirmDeletePage'){
			if(isset($_GET['idPage']) && $_GET['idPage']>0){
				$idPage = ($_GET['idPage']);
				$pageConfirm = new PageControl();
				$pageIdConfirm = $pageConfirm ->verifDeletePage($idPage);
			}
			else {
				throw new Exception('Erreur lors de la confirmation');
			}
		}

		//Suppression d'une page
		else if ($_GET['action'] == 'deletePage'){
			if(isset($_GET['idPage']) && $_GET['idPage']>0){
				$idPage = ($_GET['idPage']);
				$pageControl = new PageControl();
				$pageDetail = $pageControl->pageDelete($idPage);
			}
			else {
				throw new Exception('Erreur lors de la suppression de la page');
			}
		}

		//Confirmation de la suppression d'une page
		else if ($_GET['action'] == 'confPageDelete'){
			require 'view/ViewBackEnd/confirmDeletePageView.php';
		}

		//Gestion des contenus
		//Formulaire de création d'un nouveau contenu
		else if ($_GET['action'] == 'newContent'){
			$contentNew = new ContentControl();
			$content = $contentNew->contentNew();
		}

		//Ajouter un contenu
		else if ($_GET['action'] == 'addContent'){
			if(isset($_POST['newTitle'])){
				$title = isset($_POST['newTitle'])?htmlspecialchars($_POST['newTitle']):NULL;
				$content = isset($_POST['content'])?htmlspecialchars($_POST['content']):NULL;
				$idPage = isset($_POST['idPage'])?htmlspecialchars($_POST['idPage']):NULL;
				$picture = isset($_FILES['picture'])?$_FILES['picture']:NULL;
				$indexContent = isset($_POST['indexContent'])?htmlspecialchars($_POST['indexContent']):NULL;
				$contentNew = new ContentControl();
				$content = $contentNew->contentAdd($title, $content,$indexContent,$picture, $idPage);
			}
			else {
				throw new Exception('Veuillez renseigner un nom de page valide');
			}	
		}

		//Administration de tous les contenus
		else if ($_GET['action'] == 'contentAllAdmin'){
			$contentControl = new ContentControl();
			$contentAdmin = $contentControl->contentAllAdmin();
		}

		//Administration du contenu d'une page
		else if ($_GET['action'] == 'contentAdmin'){
			if(isset($_GET['id'])) {
				$contentControl = new ContentControl;
				$contentDetail = $contentControl->contentDetailAdmin();
			}
			else {
				throw new Exception('Aucun identifiant de contenu envoyé');
			}
		}

		//Administration du contenu de la page Contacts
		else if ($_GET['action'] == 'contactAdmin'){
			$contactControl = new ContactControl;
			$contactDetail = $contactControl->contactDetailAdmin();
		}

		//Envoi du message par le formulaire de contact
		else if ($_GET['action'] == 'sendMessage'){
			$firstName = isset($_POST['prenomUser'])?htmlspecialchars($_POST['prenomUser']):NULL;
			$lastName = (isset($_POST['nomUser'])?htmlspecialchars($_POST['nomUser']):NULL);
			$mail = (isset($_POST['mailUser'])?htmlspecialchars($_POST['mailUser']):NULL);
			$tel = (isset($_POST['telUser'])?htmlspecialchars($_POST['telUser']):NULL);
			$message = (isset($_POST['msgUser'])?htmlspecialchars($_POST['msgUser']):NULL);
			$mailControl = new MailControl();
			$contactMail = $mailControl->sendContactMail($firstName,$lastName,$mail,$tel,$message);
		}

		//Mise à jour d'un contenu
		else if ($_GET['action'] == 'contentUpdate'){
			if(isset($_GET['id'])){
				$id = isset($_POST['id'])?htmlspecialchars($_POST['id']):NULL;
				$title = isset($_POST['newTitle'])?htmlspecialchars($_POST['newTitle']):NULL;
				$content = isset($_POST['content'])?htmlspecialchars($_POST['content']):NULL;
				$picture = isset($_FILES['picture'])?$_FILES['picture']:NULL;
				$noPicture = isset($_POST['noPicture'])?$_POST['noPicture']:NULL;
				var_dump($noPicture);
				$indexContent = isset($_POST['indexContent'])?htmlspecialchars($_POST['indexContent']):NULL;
				$idPage = isset($_POST['idPage'])?htmlspecialchars($_POST['idPage']):NULL;
				$latX = isset($_POST['latX'])?htmlspecialchars($_POST['latX']):NULL;
				$longY = isset($_POST['longY'])?htmlspecialchars($_POST['longY']):NULL;
				$nameCab = isset($_POST['nameCab'])?htmlspecialchars($_POST['nameCab']):NULL;
				$adresse = isset($_POST['adresse'])?htmlspecialchars($_POST['adresse']):NULL;
				$codePostal = isset($_POST['codePostal'])?htmlspecialchars($_POST['codePostal']):NULL;
				$ville = isset($_POST['ville'])?htmlspecialchars($_POST['ville']):NULL;
				$tel = isset($_POST['telephone'])?htmlspecialchars($_POST['telephone']):NULL;
				$mail = isset($_POST['mail'])?htmlspecialchars($_POST['mail']):NULL;
				$contentControl = new ContentControl;
				$contentDetail = $contentControl->contentUpdate($_GET['id'],$title,$picture,$noPicture, $content, $indexContent, $idPage, $latX, $longY, $nameCab, $adresse, $codePostal, $ville, $tel, $mail);
			}
			else {
				throw new Exception('Aucun identifiant de section envoyé');
			}
		}

		//Confirmation de la mise à jour d'un contenu
		else if ($_GET['action'] == 'confirmUpdateContent'){
			require 'view/ViewBackEnd/confirmUpdateContentView.php';
		}

		//Formulaire de confirmation avant la suppression d'un contenu
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

		//Suppression d'un contenu
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

		//Confirmation de la suppression d'un contenu
		else if ($_GET['action'] == 'confContentDelete'){
			require 'view/ViewBackEnd/confirmDeleteContentView.php';
		}

		//Affichage des mentions légales
		else if ($_GET['action'] == 'mentionsLegales'){
			require 'view/ViewFrontEnd/mentionsLegales.php';
		}

		//Redirection sur la page d'accueil
		else if ($_GET['action'] == ''){
			$accueilControl = new AccueilControl();
			$accueilDetail = $accueilControl->accueilDetail();
		}

		else {
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