class contactForm {
    
    constructor(contactFormId, contactFirstNameId, contactLastNameId, contactMailId, contactTelId, contactMsgId, contactErrorId, contactSuccessId, contactLoadingId) {
        // Eléments HTML du formulaire
        this.contactFormElt = document.getElementById(contactFormId);
        this.contactFirstNameInput = document.getElementById(contactFirstNameId);
        this.contactLastNameInput = document.getElementById(contactLastNameId);
        this.contactMailInput = document.getElementById(contactMailId);
        this.contactTelInput = document.getElementById(contactTelId);
        this.contactMsgInput = document.getElementById(contactMsgId);
        this.contactErrorDiv = document.getElementById(contactErrorId);
        this.contactSuccessDiv = document.getElementById(contactSuccessId);
        this.contactLoadingDiv = document.getElementById(contactLoadingId);
        
        // Validation du formulaire
        this.contactFormElt.addEventListener ('submit',(e)=> {
			e.preventDefault();
            this.formValid();
		});
        
    }
    
    // Validation du formulaire : vérifie les champs puis envoie le message
    formValid() {
        if (this.inputsVerif()) {
            this.sendMessage();
        }
    }
    
    // Vérification du bon remplissage des champs et affichage d'un message d'erreur le cas échéant
    inputsVerif() {
        var errors = '';
        if (this.contactFirstNameInput.value=='') {
            errors += '<li>Veuillez fournir un prénom.</li>';
        }
        if (this.contactLastNameInput.value=='') {
            errors += '<li>Veuillez fournir un nom de famille.</li>';
        }
        if (this.contactMailInput.value=='' && this.contactTelInput.value=='') {
            errors += '<li>Veuillez fournir soit une adresse mail soit un numéro de téléphone.</li>';
        }
        if (this.contactMsgInput.value=='') {
            errors += '<li>Veuillez remplir le message que vous souhaitez m\'adresser.</li>';
        }

        if (errors=='') {
            this.contactErrorDiv.innerHTML = '';
            return true;
        } else {
            var errorMsg = '<p>Votre message n\'a pas pu être envoyé pour les raisons suivantes :</p>';
            errorMsg += '<ul>';
            errorMsg += errors;
            errorMsg += '</ul>';
            this.contactErrorDiv.innerHTML = errorMsg;
            return false;
        }
    }
    
    // Envoi du message via une requête Ajax Post appelant un envoi de message en php
    sendMessage() {
        var url = this.contactFormElt.getAttribute('action');
        var data = new FormData(this.contactFormElt);
        this.ajaxPost(url, data, this.displayResponse);
    }
    
    // Requête Ajax Post
    ajaxPost(url, data, callback){
        var req = new XMLHttpRequest();
        req.open('POST', url);
        this.contactLoadingDiv.classList.remove('hidden');
        var thisForm=this;
        req.addEventListener('load',function(){
            thisForm.contactLoadingDiv.classList.add('hidden');
            console.log(req.responseText);
            if (req.status>=200 && req.status <400) {
                callback(req.responseText,thisForm);
            } else {
                thisForm.contactSuccessDiv.innerHTML = '';
                thisForm.contactErrorDiv.innerHTML = '<p>L\'envoi de votre message a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>';
            }
        }); 
        req.send(data);
    }
    
    // Affichage de la réponse
    displayResponse(responseText,thisForm) {
        var response = {
            'status': '',
            'msgHtml': ''
        };
        console.log(responseText);
        console.log(response);
        try {
            response = JSON.parse(responseText);
            console.log('test catch');

        } catch (e) {
            response.status = 'error';
            response.msgHtml = '<p>L\'envoi de votre message a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>';
        }
        if (response.status == 'error') {
            thisForm.contactSuccessDiv.innerHTML = '';
            thisForm.contactErrorDiv.innerHTML = response.msgHtml;
        } else if (response.status == 'success') {
            thisForm.contactErrorDiv.innerHTML = '';
            thisForm.contactSuccessDiv.innerHTML = response.msgHtml;
        }

    }
}

new contactForm('formContact','prenomUser','nomUser','mailUser','telUser','msgUser','contactErrorMsg','contactSuccessMsg','formLoading');