<?php
namespace Sophrologie\controller;
use Sophrologie\model\Users;
use Sophrologie\model\Contact;

class MailControl
{   
    private $sautLigne = "\r\n";

	// Envoi de message depuis le formulaire de contact
	public function sendContactMail($firstName,$lastName,$mail,$tel,$message)
	{
        $response  = [
            'status'=>'',
            'msgHtml'=>''
        ];
        
		try {
			$errors = "";
			if (is_null($firstName) || $firstName=="") {
	            $errors .= "<li>Veuillez fournir un prénom.</li>";
	        }
	        if (is_null($lastName) || $lastName=="") {
	            $errors .= "<li>Veuillez fournir un nom de famille.</li>";
	        }
	        if ((is_null($mail) || $mail=="") && (is_null($tel) || $tel=="")) {
	            $errors .= "<li>Veuillez fournir soit une adresse mail soit un numéro de téléphone.</li>";
	        }
	        if (is_null($message) || $message=="") {
	            $errors .= "<li>Veuillez remplir le message que vous souhaitez m'adresser.</li>";
	        }
	        
	        // Si tous les champs sont correctement remplis alors le mail est envoyé
	        if ($errors=="") {
                
                //Paramètres des mails envoyés et reçus
                // Création des variables destinataire, sujet et headers
                $boundary = "-----=".md5(rand());
                $adminMailContact = new Contact();
                $adminArray = $adminMailContact->getMail($mailAdmin);
                $admin = $adminArray['mail'];
                $subject = "Message de: cabinet-sophrologie";                
			    $headers = $this->prepareHeaders('Cabinet de Sophrologie','ne-pas-repondre@alwaysdata.net',$boundary);
                
                // Phrases introductives (admin et copie)
                $msgHead = "Veuillez trouver ci-dessous un message envoyé depuis le formulaire de contact du site acroweb.alwaysdata.net/sophrologie";
                $msgCopyHead = "Veuillez trouver ci-dessous la copie du message que vous venez d'envoyer depuis le formulaire de contact du site acroweb.alwaysdata.net/sophrologie";
              
                //Préparation des mails au format Texte
                // Corps du message au format texte
                $msgContentTxt = "Prénom : ".$firstName.$this->sautLigne;
			    $msgContentTxt .= "Nom : ".$lastName.$this->sautLigne;
			    if (!is_null($tel) && $tel!="") {
			        $msgContentTxt .= "Tel : ".$tel.$this->sautLigne;
			    }
			    if (!is_null($mail) && $mail!="") {
			        $msgContentTxt .= "Mail : ".$mail.$this->sautLigne;
			    }
			    $msgContentTxt .= "Message : ".$message;
                
                // Contenu des messages (admin et copie) au format texte
                $msgTxt = "Bonjour,".$this->sautLigne.$this->sautLigne.$msgHead.$this->sautLigne.$this->sautLigne.$msgContentTxt;
                $msgCopyTxt = "Bonjour,".$this->sautLigne.$this->sautLigne.$msgCopyHead.$this->sautLigne.$this->sautLigne.$msgContentTxt;
                
                //Préparation des mails au format Html
                // Corps du message HTML
                $msgContentHtml = "<strong>Prénom : </strong>".$firstName."<br/>";
			    $msgContentHtml .= "<strong>Nom : </strong>".$lastName."<br/>";
			    if (!is_null($tel) && $tel!="") {
			        $msgContentHtml .= "<strong>Tel : </strong>".$tel."<br/>";
			    }
			    if (!is_null($mail) && $mail!="") {
			        $msgContentHtml .= "<strong>Mail : </strong>".$mail."<br/>";
			    }
			    $msgContentHtml .= "<strong>Message : </strong>".$message."</body></html>";
                
                // Contenu des messages (admin et copie) au format html
                $msgHtml = "<html><head><title>".$subject."</title></head><body><p>Bonjour<br/><br/>".$msgHead."<br/><br/>".$msgContentHtml;
                $msgCopyHtml = "<html><head><title>".$subject."</title></head><body><p>Bonjour<br/><br/>".$msgCopyHead."<br/><br/>".$msgContentHtml;

                //Combinaison des mails Html et Texte
                // Mail final admin combinant texte et html
                $msg = $this->prepareFormatedContent($msgTxt,$msgHtml,$boundary);
                // Mail final copie combinant texte et html
                $msgCopy = $this->prepareFormatedContent($msgCopyTxt,$msgCopyHtml,$boundary);
                
                //Envoi des mails et de la réponse 
			    // Envoi des mails et réponse à la page HTML
                if (mail($admin,$subject,$msg,$headers)) {
                    if (!is_null($mail) && $mail!="") {
                    	mail($mail,$subject,$msgCopy,$headers);
		            }
                    $response  = [
                        'status'=>'success',
                        'msgHtml'=>'<p>Votre message a bien été transmis. Vous serez recontacté dès que possible.</p>'
                    ];
                } else {
                    $response  = [
                        'status'=>'echec',
                        'msgHtml'=>'<p>L\'envoi de votre message a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>'
                    ];
                }
			}

			// Si certains champs sont incomplets, alors on envoi un message d'erreur
			else {
				$errorMsg = "<p>Votre message n'a pas pu être envoyé pour les raisons suivantes :</p>";
	            $errorMsg .= "<ul>";
	            $errorMsg .= $errors;
	            $errorMsg .= "</ul>";
			    $response  = [
                    'status'=>'error',
                    'msgHtml'=>$errorMsg
                ];
			}
		}

		catch(Exception $e){
		    $response  = [
                'status'=>'error',
                'msgHtml'=>'<p>L\'envoi de votre message a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>'
            ];
		}
        
        // Envoi de la réponse
        echo json_encode($response);
        exit();
	}
    
    // Envoi de nouveau mot de passe par mot de passe oublié
	public function sendNewPwd($mail)
	{
        $response  = [
            'status'=>'',
            'msgHtml'=>''
        ];
        
		try {
            if (is_null($mail) || $mail=="") {
                $response  = [
                    'status'=>'error',
                    'msgHtml'=>'Veuillez fournir un email valide.'
                ];
            } else {
                $passwordConnect = new Users();
                $passwordCo = $passwordConnect->mailVerif($mail);
                if($passwordCo==0){
                    $response  = [
                        'status'=>'error',
                        'msgHtml'=>'Votre email n\'est pas reconnu, veuillez contacter l\'administrateur du site.'
                    ];
                } else{
                    //Si le champs mail est correctement remplis alors on génère un nouveau mot de passe dans la BDD            
                    $newMdP = $this->randomMdP(8);
                    
                    //Et on envoi un mail avec le nouveau mot de passe
                    // Création des variables sujet et headers
                    $boundary = "-----=".md5(rand());
                    $subject = "Message de: Cabinet-sophrologie";                
                    $headers = $this->prepareHeaders('Cabinet de Sophrologie','ne-pas-repondre@alwaysdata.net',$boundary);
            
                    // Phrases introductives
                    $msgHead = "Vous avez fait une demande de ré-initialisation de votre mot de passe sur le site Cabinet de Sophrologie.";
                    
                    //corps du message au format Text
                    $msgContentTxt = "Votre nouveau mot de passe est le suivant : ".$newMdP.$this->sautLigne.$this->sautLigne;
                    $msgContentTxt .= "Nous vous invitons à vous connecter dans l'interface d'administration avec ce mot de passe et à le remplacer rapidement via les pages suivantes :".$this->sautLigne.$this->sautLigne;
                    $msgContentTxt .= "Connexion : https://acroweb.alwaysdata.net/sophrologie/index.php?action=connect".$this->sautLigne.$this->sautLigne;
                    $msgContentTxt .= "Changement de mot de passe : https://acroweb.alwaysdata.net/sophrologie/index.php?action=newPassword";

                    //contenu du message au format text
                    $msgTxt = "Bonjour,".$this->sautLigne.$this->sautLigne.$msgHead.$this->sautLigne.$this->sautLigne.$msgContentTxt;
                  
                    //corps du message au format Html
                    $msgContentHtml = "Votre nouveau mot de passe est le suivant : <strong>".$newMdP."</strong><br/><br/>";
                    $msgContentHtml .= "Nous vous invitons à vous connecter dans l'interface d'administration avec ce mot de passe et à le remplacer rapidement via les pages suivantes :";
                    $msgContentHtml .= "Connexion : <a href=\"https://acroweb.alwaysdata.net/sophrologie/index.php?action=connect\">https://acroweb.alwaysdata.net/sophrologie/index.php?action=connect</a><br/><br/>";
                    $msgContentHtml .= "Changement de mot de passe : <a href=\"https://acroweb.alwaysdata.net/sophrologie/index.php?action=newPassword\">https://acroweb.alwaysdata.net/sophrologie/index.php?action=newPassword</a>";
                    $msgContentHtml .= "</p></body></html>";

                    //contenu du message au format Html
                    $msgHtml = "<html><head><title>".$subject."</title></head><body><p>Bonjour<br/><br/>".$msgHead."<br/><br/>".$msgContentHtml;

                    //Mail final combinant texte et Html
                    $msg = $this->prepareFormatedContent($msgTxt,$msgHtml,$boundary);
                    
                    //Envoi du mail et de la réponse + modif MdP dans la base
                    if (mail($mail,$subject,$msg,$headers)) {
                        
                        $passwordMaj = new Users();
                        $passwordUpdate = $passwordMaj->modifPasswordFromMail($mail,$newMdP);

                        $response  = [
                        'status'=>'success',
                        'msgHtml'=>'Votre demande de ré-initialisation de mot de passe a bien été envoyée. Vous allez bientôt recevoir un nouveau mot de passe dans votre boîte mail.'
                        ];
                    } else {
                        $response  = [
                            'status'=>'error',
                            'msgHtml'=>'L\'envoi d\'un nouveau mot de passe a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.'
                        ];
                    }
                }
            }
        }
        
        // Erreur technique
		catch(Exception $e){

		    $response  = [
                'status'=>'error',
                'msgHtml'=>'L\'envoi d\'un nouveau mot de passe a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.'
            ];
		}
        // Envoi de la réponse
        echo json_encode($response);
        exit();
	}
    
    // Prépare les métadonnnées du mail à partir des données expéditeur
    private function prepareHeaders($titleFrom,$mailFrom,$boundary) {
        $headers = "From: \"".$titleFrom."\"<".$mailFrom.">".$this->sautLigne;
        $headers .= "MIME-Version: 1.0".$this->sautLigne;
        $headers .= "Content-Type: multipart/alternative;".$this->sautLigne." boundary=\"$boundary\"".$this->sautLigne;
        return $headers;
    }
    
    // Formate le contenu d'un mail combiné texte+html à partir des messages bruts texte et html
    private function prepareFormatedContent($msgTxt,$msgHtml,$boundary) {
        // Initialisation du message
        $msg = $this->sautLigne."--".$boundary.$this->sautLigne;
        
        // Format texte
        $msg .= "Content-Type: text/plain; charset=\"UTF-8\"".$this->sautLigne;
        $msg .= "Content-Transfer-Encoding: 8bit".$this->sautLigne;
        $msg .= $this->sautLigne.$msgTxt.$this->sautLigne;
        $msg .= $this->sautLigne."--".$boundary.$this->sautLigne;
        
        // Format html
        $msg .= "Content-Type: text/html; charset=\"UTF-8\"".$this->sautLigne;
        $msg .= "Content-Transfer-Encoding: 8bit".$this->sautLigne;
        $msg .= $this->sautLigne.$msgHtml.$this->sautLigne;
        $msg .= $this->sautLigne."--".$boundary."--".$this->sautLigne;
        $msg .= $this->sautLigne."--".$boundary."--".$this->sautLigne;
        return $msg;
    }
    
    // Génére un mot de passe aléatoire d'une longueur donnée
    private function randomMdP($length) {
        $chaine = 'azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789';
        $MdP = "";
        for ($i=0;$i<$length;$i++) {
            $position = mt_rand(0,strlen($chaine));
            $MdP .= $chaine[$position];
        }
        return $MdP;
    }
}
