<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Confirmation de suppression- Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
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
			<!--En mode Admin-->
			<?php
				if (isset($_SESSION['auth'])) {
			?>	

			<section class="contenuRubriques">
				<h2 class="titreSection">La page a bien été supprimée</h2>
				<div class="gpButton">
					<a class="button deconnectAccueil" href="index.php?action=pageAdmin">Retour à la page précédente</a>
					<a class="button deconnectAccueil" href="index.php?action=accueil">Retour à la page d'accueil</a>
				</div>
			</section>

			<!--En mode Utilisateur-->
			<?php
				} else {
			?>
					<h2 class="titreSection"> Vous n'avez pas les droits sur cette page </h2>
			<?php
				}
			?>
		</main>

				<!--Pied de page-->
		<footer>
			<?php include("public/footer.php");?>
		</footer>

		<!--Fichiers Javascript-->
		<script src="tinymce/tinymce.min.js"></script>
		<script src="tinymce/themes/silver/theme.min.js"></script>
		<script src="tinymce/parametresTinyMCE.js"></script>
		
	</body>
</html>