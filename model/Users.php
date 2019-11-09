<?php
namespace Sophrologie\model;
class Users extends DataBase
{
	private $_id,
			$_login,
			$_password;

	//modifie le mot de passe
	public function modifPassword($login,$newPassword)
	{
		$db = $this->dbConnect();
		$passwordHash = password_hash($newPassword,PASSWORD_DEFAULT);
		$req = $db->prepare('UPDATE users SET password= ? WHERE login = ?');
		$passwordMaj = $req->execute(array($passwordHash, $login));
		return $passwordMaj;
	}

	//vérification du login et du mdp avant connexion
	public function passwordVerif()
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT login, password FROM users WHERE login = :login');
		$req->execute(['login'=> $_POST['login']]);
		$user = $req->fetch();
		$passwordExact = password_verify($_POST['password'],$user['password']);
		return $passwordExact;
	}

}