<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Mot de passe oublié - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Formulaire de renouvellement du mot de passe pour l'administrateur du site du Cabinet de Sophrologie">
	</head>

	<body>
		<!--En tête-->
		<?php include("public/header.php");?>

		<!--Corps de page-->
		<main class="mainConnect">
			<section class="contenuConnect">
				<h2 class="titreSection"> Mot de passe oublié </h2>
				<form id="formForgetPassword" class="formConnect" method="post" action="index.php?action=sendNewPassword">
					<label for="mailUser"> Veuillez saisir votre email:</label>
					<input type="email" name="mailUser" id="mailUser" required /><br/><br/>
					<button class="button btConnect" id="connectButton" type="submit" value="Valider">Valider</button>
				</form>
				<div id="redirectionForgetPassword" class="redirection">
				</div>
			</section>
		</main>

		<!--Pied de page-->
		<?php include("public/footer.php");?>

		<!--Fichier Javascript-->
		<script src="public/js/userForm.js" defer> </script>
		
	</body>
</html>