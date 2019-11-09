<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Interface de connexion - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Sophrologie Marine">
	</head>

	<body>
		<!--En tête-->
		<header>
			<?php include("public/header.php");?>
		</header>

				<!--Corps de page-->
		<main class="mainConnect">
			<section class="contenuRubriques">
				<h2 class="titreSection"> Se connecter </h2>
				<form id="formConnexion" class="formConnect" method="post">
					<label for="loginUser"> Identifiant</label>
					<input type="text" name="login" id="loginUser" required /><br/><br/>
					<label for="passwordUser">Mot de passe </label>
					<input id="passwordUser" type="password" name="password" required /><br/>
					<p id="oubliPassword" >Mot de passe oublié	</p>
					<button class="button btConnect" id="connectButton" type="submit" value="Se connecter">Connecter</button>
				</form>
				<div id="redirectionConnect" class="redirection">
				</div>
			</section>
		</main>


		<!--Pied de page-->
		<footer>
			<?php include("public/footer.php");?>
		</footer>

		<!--Fichier Javascript-->
		<script src="public/gestionUsers.js"> </script>
		
	</body>
</html>