<?php
namespace Sophrologie\controller;

class MailControl
{

	// vérification du login et mdp pour connexion
	public function sendContactMail($firstName,$lastName,$mail,$tel,$message)
	{
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
	        
	        // Tous les champs sont correctement remplis => envoi du mail
	        if ($errors=="") {
                
                // Création des sauts de ligne
                $sautLigne = "\r\n";
                
                // Création de la boundary
                $boundary = "-----=".md5(rand());
                
                // Création des variables destinataire, sujet et headers
                $admin = "acroweb@orange.fr";
                $subject = "Message de: cabinet-sophrologie";                
			    $headers = "From: \"Cabinet de sophrologie\"<ne-pas-repondre@alwaysdata.net>".$sautLigne;
                $headers .= "MIME-Version: 1.0".$sautLigne;
                $headers .= "Content-Type: multipart/alternative;".$sautLigne." boundary=\"$boundary\"".$sautLigne;
                
                // Phrases introductives (admin et copie)
                $msgHead = "Veuillez trouver ci-dessous un message envoyé depuis le formulaire de contact du site acroweb.alwaysdata.net/sophrologie";
                $msgCopyHead = "Veuillez trouver ci-dessous la copie du message que vous venez d'envoyer depuis le formulaire de contact du site acroweb.alwaysdata.net/sophrologie";
                
                // Corps du message texte
                $msgContentTxt = "Prénom : ".$firstName.$sautLigne;
			    $msgContentTxt .= "Nom : ".$lastName.$sautLigne;
			    if (!is_null($tel) && $tel!="") {
			        $msgContentTxt .= "Tel : ".$tel.$sautLigne;
			    }
			    if (!is_null($mail) && $mail!="") {
			        $msgContentTxt .= "Mail : ".$mail.$sautLigne;
			    }
			    $msgContentTxt .= "Message : ".$message;
                
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
                
                // Contenus des messages (admin et copie) aux formats texte et html
                $msgTxt = "Bonjour,".$sautLigne.$sautLigne.$msgHead.$sautLigne.$sautLigne.$msgContentTxt;
                $msgCopyTxt = "Bonjour,".$sautLigne.$sautLigne.$msgCopyHead.$sautLigne.$sautLigne.$msgContentTxt;
                $msgHtml = "<html><head><title>".$subject."</title></head><body><p>Bonjour<br/><br/>".$msgHead."<br/><br/>".$msgContentHtml;
                $msgCopyHtml = "<html><head><title>".$subject."</title></head><body><p>Bonjour<br/><br/>".$msgCopyHead."<br/><br/>".$msgContentHtml;
                
                // Mail final admin combinant texte et html
                $msg = $sautLigne."--".$boundary.$sautLigne;
                // Format texte
                $msg .= "Content-Type: text/plain; charset=\"UTF-8\"".$sautLigne;
                $msg .= "Content-Transfer-Encoding: 8bit".$sautLigne;
                $msg .= $sautLigne.$msgTxt.$sautLigne;
                $msg .= $sautLigne."--".$boundary.$sautLigne;
                // Format html
                $msg .= "Content-Type: text/html; charset=\"UTF-8\"".$sautLigne;
                $msg .= "Content-Transfer-Encoding: 8bit".$sautLigne;
                $msg .= $sautLigne.$msgHtml.$sautLigne;
                $msg .= $sautLigne."--".$boundary."--".$sautLigne;
                $msg .= $sautLigne."--".$boundary."--".$sautLigne;
                
                // Mail final copie combinant texte et html
                $msgCopy = $sautLigne."--".$boundary.$sautLigne;
                // Format texte
                $msgCopy .= "Content-Type: text/plain; charset=\"UTF-8\"".$sautLigne;
                $msgCopy .= "Content-Transfer-Encoding: 8bit".$sautLigne;
                $msgCopy .= $sautLigne.$msgCopyTxt.$sautLigne;
                $msgCopy .= $sautLigne."--".$boundary.$sautLigne;
                // Format html
                $msgCopy .= "Content-Type: text/html; charset=\"UTF-8\"".$sautLigne;
                $msgCopy .= "Content-Transfer-Encoding: 8bit".$sautLigne;
                $msgCopy .= $sautLigne.$msgCopyHtml.$sautLigne;
                $msgCopy .= $sautLigne."--".$boundary."--".$sautLigne;
                $msgCopy .= $sautLigne."--".$boundary."--".$sautLigne;
                
			    // Envoi des mails et réponse à la page HTML
                if (mail($admin,$subject,$msg,$headers)) {
                    if (!is_null($mail) && $mail!="") {
                    	mail($mail,$subject,$msgCopy,$headers);
		            }
                    echo "<p>Votre message a bien été transmis. Vous serez recontacté dès que possible.</p>";
                    exit();
                } else {
                    echo "<p>L'envoi de votre message a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>";
                    exit();
                }

			}

			// Certains champs sont incomplets => envoi d'un message d'erreur
			else {

				$errorMsg = "<p>Votre message n'a pas pu être envoyé pour les raisons suivantes :</p>";
	            $errorMsg .= "<ul>";
	            $errorMsg .= $errors;
	            $errorMsg .= "</ul>";
			    echo $errorMsg;
				exit();

			}

		}

		// Erreur technique
		catch(Exception $e){

		    echo "<p>L'envoi de votre message a échoué pour raisons techniques. Nous vous prions de bien vouloir ré-essayer plus tard.</p>";
			exit();

		}

	}
		
}
