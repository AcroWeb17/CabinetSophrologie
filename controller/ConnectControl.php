<?php
namespace Sophrologie\controller;
use Sophrologie\model\Users;

class ConnectControl
{
	//interface de connexion
	public function connect()
	{
		require('view/ViewFrontEnd/loginView.php');
	}

	//interface de déconnexion
	public function deconnect()
	{
		session_destroy();
		require('view/ViewFrontEnd/deconnectView.php');
	}

	//vérification du login et mdp pour connexion
	public function interfaceAdmin($login,$password)
	{

		$response  = [
            'status'=>'',
            'msgHtml'=>''
        ];

		if(!empty($_POST) && !empty($_POST['login']) && !empty($_POST['password'])){
			$passwordConnect = new Users();
			$passwordCo = $passwordConnect->passwordVerif($login,$password);
			if($passwordCo){
				$_SESSION['auth'] = $passwordCo;
				$response  = [
		            'status'=>'success',
		            'msgHtml'=>'<p>Vous êtes maintenant connecté(e).<br/> Vous allez être redirigé vers la page d\'accueil dans quelques instants...</p>'
		        ];
			}
			else {
				$response  = [
		            'status'=>'error',
		            'msgHtml'=>'<p>L\'identifiant ou le mot de passe sont incorrects.</p>'
		        ];
			}
		}
		else {
			$response  = [
	            'status'=>'error',
	            'msgHtml'=>'<p>La connexion a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>'
	        ];
		}

		echo json_encode($response);
        exit();

	}

	//modification du mot de passe
	public function updatePassword($login, $password, $newPassword)
	{	
		
		$response  = [
            'status'=>'',
            'msgHtml'=>''
        ];

		if(!empty($_POST) && !empty($_POST['login']) && !empty($_POST['password'])){
			$passwordConnect = new Users();
			$passwordCo = $passwordConnect->passwordVerif($login,$password);
			if($passwordCo){
				if (($_POST['newPassword'])===($_POST['confirmNewPassword'])){
					$passwordModify = new Users();
					$passwordMo = $passwordModify->modifPassword($login, $newPassword);
						if ($passwordMo === false){
							$response  = [
					            'status'=>'error',
					            'msgHtml'=>'<p>Le changement de mot de passe a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>'
					        ];
						}
						else {
							$response  = [
					            'status'=>'success',
					            'msgHtml'=>'<p>Votre mot de passe a bien été modifié.<br/> Vous allez être redirigé vers la page d\'accueil dans quelques instants...</p>'
					        ];
						}
				}
				else {
					$response  = [
			            'status'=>'error',
			            'msgHtml'=>'<p>Les nouveaux mots de passe ne sont pas identiques.</p>'
			        ];
				}
			}
			else {
				$response  = [
		            'status'=>'error',
		            'msgHtml'=>'<p>Nom d\'utilisateur ou mot de passe incorrect.</p>'
		        ];
			}
		}
		else {
			$response  = [
	            'status'=>'error',
	            'msgHtml'=>'<p>Veuillez remplir tous les champs.</p>'
	        ];
		}

		echo json_encode($response);
    	exit();

	}
	
}
