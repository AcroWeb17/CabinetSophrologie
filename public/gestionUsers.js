//fichier Javascript de redirection automatique
//redirection après connexion à l'interface admin
if (document.getElementById("formConnexion")){
	document.getElementById("formConnexion").addEventListener("submit",verifUser,false)
}
//redirection après modification du mot de passe
else if(document.getElementById("formMdP")){
	document.getElementById("formMdP").addEventListener("submit",verifPassword,false)
};

//fonction ajax
function ajaxPost(url, data, callback){
    var req = new XMLHttpRequest();
    req.open("POST", url);
    req.addEventListener("load",function(){
    	callback(req.responseText);
    }); 
    req.send(data);
}

//Redirection après connexion à l'interface admin
//vérification du mot de passe avec la base de données
function verifUser(e){
	e.preventDefault();
	var data = new FormData(document.getElementById("formConnexion"));
	ajaxPost("index.php?action=interfaceAdmin",data, callUser);
}

//redirection
function callUser(reponse){
	if (reponse == "echec"){
		document.getElementById("redirectionConnect").innerHTML="L'identifiant ou le mot de passe sont incorrects";
	}
	else if (reponse == "error"){
		document.getElementById("redirectionConnect").innerHTML="Echec de la connexion";
	}
	else if (reponse == "succes")
	{
		document.getElementById("redirectionConnect").innerHTML="Vous êtes maintenant connecté.<br/> Vous allez être redirigé vers la page d'accueil dans quelques instants...";
		setTimeout(function(){window.location = "index.php?action=accueil";},2000);
	}
}

//Redirection après modification du mot de passe
//vérification du mot de passe avec la base de données
function verifPassword(e){
	e.preventDefault();
	var data = new FormData(document.getElementById("formMdP"));
	ajaxPost("index.php?action=updatePassword",data, callPassword);
}

//redirection
function callPassword(reponse){
	if (reponse == "les nouveaux mots de passe ne sont pas identiques"){
		document.getElementById("redirectionNewPsw").innerHTML="Les nouveaux mots de passe ne sont pas identiques";
	}
	else if (reponse == "mauvais nom d utilisateur ou de mot de passe"){
		document.getElementById("redirectionNewPsw").innerHTML="Nom d\'utilisateur ou mot de passe incorrect";
	}
	else if (reponse == "champs non remplis"){
		document.getElementById("redirectionNewPsw").innerHTML="Veuillez remplir tous les champs";
	}
	else if (reponse == "succes")
	{
		document.getElementById("redirectionNewPsw").innerHTML="Votre mot de passe a bien été modifié.<br/> Vous allez être redirigé vers la page d'accueil dans quelques instants...";
		setTimeout(function(){window.location = "index.php?action=accueil";},2000);
	}
}