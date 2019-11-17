<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Confirmation de suppression- Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Confirmation de la suppression d'une page du site du Cabinet de Sophrologie">
	</head>

	<body>
		<!--En tête-->
		<?php include("public/header.php");?>

		<!--Corps de page-->
		<main class="mainConnect">
			<!--En mode Admin-->
			<?php
				if (isset($_SESSION['auth'])) {
			?>	
					<section class="contenuDelete">
						<h2 class="titreSection">La page a bien été supprimée</h2>
						<div class="gpButton">
							<a class="button" href="admin-gestion-des-pages">Gestion des pages</a>
							<a class="button" href="accueil">Page d'accueil</a>
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

	</body>
</html>