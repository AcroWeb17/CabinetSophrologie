<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Modification du mot de passe - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Changement du mot de passe de l'administrateur du site du Cabinet de Sophrologie">
	</head>

	<body>
		<!--En tête-->
		<?php include("public/header.php");?>

		<!--Corps de page-->
		<main class="mainConnect">
			<section class="contenuConnect">
			<!--En mode Admin-->
			<?php
				if (isset($_SESSION['auth'])) {
			?>
					<h2 class="titreSection">Modification du mot de passe </h2>
					<form id="formMdP" class="formNewMdp" method="post" action="index.php?action=updatePassword">
						<label for="login"> Identifiant</label>
						<input type="text" name="login" id="login" required /><br/><br/>
						<label for="oldPassword">Mot de passe </label>
						<input id="oldPassword" type="password" name="password" required /><br/><br/>
						<label for="newPassword">Nouveau mot de passe </label>
						<input id="newPassword" type="password" name="newPassword" required /><br/><br/>
						<label for="confirmNewPassword">Confirmer le nouveau mot de passe </label>
						<input id="confirmNewPassword" type="password" name="confirmNewPassword" required /><br/>
						<div class="submitNewPassword">
							<a class="button " href="accueil">Annuler</a>
							<input type="submit" class="button" value="Valider" />
						</div>
					</form>
					<!--Redirection automatique-->
					<div id="redirectionNewPsw" class="redirection">
					</div>
			
			<!--En mode Utilisateur-->
			<?php
				}
				else {
			?>
					<section class="contenuDelete mainConnect">
						<h2 class="titreSection">Vous n'avez pas les droits sur cette page</h2>
						<div class="btSolo">
							<a class="button btSolo" href="accueil">Page d'accueil</a>
						</div>
					</section>
			<?php
				}
			?>	
			</section>
		</main>

		<!--Pied de page-->
		<?php include("public/footer.php");?>
		
		<!--Scripts-->
		<?php include("public/scripts.php");?>
		<script src="public/js/userForm.js" defer></script>

	</body>
</html>