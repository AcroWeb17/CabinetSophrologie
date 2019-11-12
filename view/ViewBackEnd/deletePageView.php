<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>- Cabinet de Sophrologie</title>
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
					<section class="contenuDelete">
						<h2 class="titreSection">Etes-vous certain de vouloir supprimer cette page? </h2>
						<div class="gpButton">
							<a class="button" href="index.php?action=pageAdmin">Gestion des pages</a>
							<a href="index.php?action=deletePage&idPage=<?= htmlspecialchars($page['idPage']); ?>" 
							   class="button">Confirmer la suppression</a>
							<a class="button" href="index.php?action=accueil">Page d'accueil</a>
						</div>
					</section>
			<!--En mode Utilisateur-->
			<?php
				} else {
			?>
					<section class="contenuDelete mainConnect">
						<h2 class="titreSection">Vous n'avez pas les droits sur cette page</h2>
						<div class="btSolo">
							<a class="button btSolo" href="index.php?action=accueil">Page d'accueil</a>
						</div>
					</section>
			<?php
				}
			?>
		</main>
				<!--Pied de page-->
		<footer>
			<?php include("public/footer.php");?>
		</footer>

	</body>
</html>