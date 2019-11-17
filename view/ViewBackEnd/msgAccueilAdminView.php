<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Message d'accueil - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Administration du message d'accueil du site du Cabinet de Sophrologie">
	</head>

	<body>
		<!--En tête-->
		<?php include("public/header.php");?>

		<!--Corps de page-->
		<main class="mainPage">
			<!--En mode Admin-->
			<?php
				if (isset($_SESSION['auth'])) {
			?>	
					<?php include("public/menu.php");?>
					<section class="sectionRubriques">
						<div class="contenuRubriques">
							<h2 class="titreSection">Message d'accueil</h2>
							<form class="styleForm" action="index.php?action=updateMsgAccueil" method="post" >
								<textarea class="smallTxtAdmin" name="content" rows="255" >
									<?=html_entity_decode(($msgAccueil['content']))?>
								</textarea>
								<div class="submitAccueil">
									<a class="editButton" href="accueil">Annuler</a>
									<input type="submit" class="editButton" value="Enregistrer" />
								</div>
							</form>
						</div>
					</section>

			<!--En mode Utilisateur-->
			<?php
				} else {
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
		</main>

		<!--Pied de page-->
		<?php include("public/footer.php");?>

		<!--Scripts-->
		<?php include("public/scripts.php");?>
		<script src="tinymce/tinymce.min.js"></script>
		<script src="tinymce/themes/silver/theme.min.js"></script>
		<script src="tinymce/parametresTinyMCE.js"></script>
		
	</body>
</html>