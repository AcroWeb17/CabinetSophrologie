class connexionForm {
    
    constructor(connexionFormId,connexionMsgId,connexionFormType) {
        
        var thisContactForm = this;
        
        // Eléments HTML du formulaire
        this.connexionFormElt = document.getElementById(connexionFormId);
        this.connexionMsgDiv = document.getElementById(connexionMsgId);
        this.connexionFormType = connexionFormType;
        
        // Validation du formulaire
        this.connexionFormElt.addEventListener ('submit',function(e) {
			e.preventDefault();
            thisContactForm.verifUser();
		});
        
    }
    
    // Vérification des identifiants de l'utilisateur via une requête Ajax Post appelant le modèle php
    verifUser() {
        var url = this.connexionFormElt.getAttribute('action');
        var data = new FormData(this.connexionFormElt);
        if (this.connexionFormType == 'connexion') {
            this.ajaxPost(url, data, this.callUser);
        } else if (this.connexionFormType == 'modifPassword') {
            this.ajaxPost(url, data, this.callPassword);
        }
    }
    
    // Requête Ajax Post
    ajaxPost(url, data, callback){
        var req = new XMLHttpRequest();
        req.open('POST', url);
        var thisConnexionForm = this;
        req.addEventListener('load',function(){
            if (req.status>=200 && req.status <400) {
                callback(req.responseText,thisConnexionForm);
            } else {
                if (this.connexionFormType=='connexion') {
                    this.connexionMsgDiv.innerHTML = '<p>La connexion a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>';
                } else if (this.connexionFormType=='modifPassword') {
                    this.connexionMsgDiv.innerHTML = '<p>La modification de mot de passe a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>';
                }
            }
        }); 
        req.send(data);
    }
    
    // Affichage de la réponse du formulaire de connnexion
    callUser(response,thisConnexionForm) {
        if (response == 'echec') {
            thisConnexionForm.connexionMsgDiv.innerHTML = 'L\'identifiant ou le mot de passe sont incorrects';
        }
        else if (response == 'error') {
            thisConnexionForm.connexionMsgDiv.innerHTML = 'Echec de la connexion';
        }
        else if (response == 'succes') {
            thisConnexionForm.connexionMsgDiv.innerHTML = 'Vous êtes maintenant connecté.<br/> Vous allez être redirigé vers la page d\'accueil dans quelques instants...';
            setTimeout(function(){
                window.location = 'index.php?action=accueil';
            },2000);
        }
    }
    
    // Affichage de la réponse du formulaire de changemeent de mot de passe
    callPassword(response,thisConnexionForm) {
        if (response == 'les nouveaux mots de passe ne sont pas identiques') {
            thisConnexionForm.connexionMsgDiv.innerHTML='Les nouveaux mots de passe ne sont pas identiques';
        }
        else if (response == 'mauvais nom d utilisateur ou de mot de passe') {
            thisConnexionForm.connexionMsgDiv.innerHTML = 'Nom d\'utilisateur ou mot de passe incorrect';
        }
        else if (response == 'champs non remplis') {
            thisConnexionForm.connexionMsgDiv.innerHTML = 'Veuillez remplir tous les champs';
        }
        else if (response == 'succes') {
            thisConnexionForm.connexionMsgDiv.innerHTML = 'Votre mot de passe a bien été modifié.<br/> Vous allez être redirigé vers la page d \'accueil dans quelques instants...';
            setTimeout(function(){
                window.location = 'index.php?action=accueil';
            },2000);
        }
    }
    
}

if (document.getElementById('formConnexion') && document.getElementById('redirectionConnect')) {
    new connexionForm('formConnexion','redirectionConnect','connexion');
} else if (document.getElementById('formMdP') && document.getElementById('redirectionNewPsw')) {
    new connexionForm('formMdP','redirectionNewPsw','modifPassword');
} 
