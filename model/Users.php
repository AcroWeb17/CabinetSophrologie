<?php
namespace Sophrologie\model;
class Users extends DataBase
{
	private $_id,
			$_name,
			$_login,
			$_mail,
			$_password;

	//Vérification du login et du mdp avant connexion
	public function passwordVerif()
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT login, password FROM users WHERE login = :login');
		$req->execute(['login'=> $_POST['login']]);
		$user = $req->fetch();
		$passwordExact = password_verify($_POST['password'],$user['password']);
		return $passwordExact;
	}

	//Vérification si l'adresse mail est bien dans la base
	public function mailVerif($mailUser)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT COUNT(mail) AS cnt FROM users WHERE mail = ?');
		$req->execute(array($mailUser));
		$mailUserVerif = $req->fetch();
		$mailCount = $mailUserVerif['cnt'];
		return $mailCount;
	}

	//Modifie le mot de passe depuis login (mot de passe oublié)
	public function modifPassword($login,$newPassword)
	{
		$db = $this->dbConnect();
		$passwordHash = password_hash($newPassword,PASSWORD_DEFAULT);
		$req = $db->prepare('UPDATE users SET password= ? WHERE login = ?');
		$passwordMaj = $req->execute(array($passwordHash, $login));
		return $passwordMaj;
	}

	//Modifie le mot de passe depuis mail (pour envoi du mot de passe oublié par mail)
	public function modifPasswordFromMail($mail,$newPassword)
	{
		$db = $this->dbConnect();
		$passwordHash = password_hash($newPassword,PASSWORD_DEFAULT);
		$req = $db->prepare('UPDATE users SET password= ? WHERE mail = ?');
		$passwordMaj = $req->execute(array($passwordHash, $mail));
		return $passwordMaj;
	}
}	