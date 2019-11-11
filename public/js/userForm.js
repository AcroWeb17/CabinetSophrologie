class userForm {
    
    constructor(userFormId,userMsgId,urlRedirect) {
        
        var thisUserForm = this;
        
        // Eléments HTML du formulaire
        this.userFormElt = document.getElementById(userFormId);
        this.userFormDiv = document.getElementById(userMsgId);
        this.urlRedirect = urlRedirect;
        
        // Validation du formulaire
        this.userFormElt.addEventListener ('submit',function(e) {
			e.preventDefault();
            thisUserForm.callRequest();
		});
        
    }
    
    // Vérification des identifiants de l'utilisateur via une requête Ajax Post appelant le modèle php
    callRequest() {
        var url = this.userFormElt.getAttribute('action');
        var data = new FormData(this.userFormElt);
        this.ajaxPost(url, data, this.displayResponse);
    }
    
    // Requête Ajax Post
    ajaxPost(url, data, callback){
        var req = new XMLHttpRequest();
        req.open('POST', url);
        var thisUserForm = this;
        req.addEventListener('load',function(){
            if (req.status>=200 && req.status <400) {
                callback(req.responseText,thisUserForm);
            } else {
                this.userFormDiv.innerHTML = '<p>Votre demande a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>';
            }
        }); 
        req.send(data);
    }
    
    // Affichage de la réponse du formulaire de connnexion
    displayResponse(responseText,thisUserForm) {
        
        var response = {
            'status': '',
            'msgHtml': ''
        };

        try {
            response = JSON.parse(responseText);
        } catch (e) {
            response.status = 'error';
            response.msgHtml = '<p>Votre demande a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>';
        }

        thisUserForm.userFormDiv.innerHTML = response.msgHtml;
        if (response.status=='success' && thisUserForm.urlRedirect!='') {
            setTimeout(function(){
               window.location = thisUserForm.urlRedirect;
            },2000);
        }

    }
    
}

if (document.getElementById('formConnexion') && document.getElementById('redirectionConnect')) {
    new userForm('formConnexion','redirectionConnect','index.php?action=accueil');
} else if (document.getElementById('formMdP') && document.getElementById('redirectionNewPsw')) {
    new userForm('formMdP','redirectionNewPsw','index.php?action=accueil');
} else if (document.getElementById('formForgetPassword') && document.getElementById('redirectionForgetPassword')) {
    new userForm('formForgetPassword','redirectionForgetPassword','index.php?action=connect');
} 
