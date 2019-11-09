<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Message d'accueil - Cabinet de Sophrologie</title>
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
		<main>
			<!--En mode Admin-->
			<?php
				if (isset($_SESSION['auth'])) {
			?>	
					<section class="contenuRubriques">
						<div class="separationSections">
							<h2 class="titreSection"> Message d'accueil</h2>
							<form class="styleForm" action="index.php?action=updateMsgAccueil" method="post" >
							<textarea class="smallTxtAdmin" name="content" rows="255" >
								<?=html_entity_decode(($msgAccueil['content']))?>
							</textarea>
							<div class="submitAccueil">
								<a class="editButton" href="index.php?action=accueil">Annuler</a>
								<input type="submit" class="editButton" value="Enregistrer" />
							</div>
							</form>
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