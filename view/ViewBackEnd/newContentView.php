<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Nouveau contenu - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Sophrologie Marine">
	</head>

	<body>
		<header>
			<?php include("public/header.php");?>
		</header>

		<!--Corps de page-->
		<main>
			<?php
				if (isset($_SESSION['auth'])){
			?>	

			<section class="contenuRubriques">
				<h2 class="titreSection"> Nouveau contenu </h2>
				<div class="gpBtUpdate">
					<a class="editButton" href="index.php?action=contentAllAdmin">Annuler</a>
					<a class="editButton" href="index.php?action=accueil">Retour à la page d'accueil</a>
				</div>

				<div class="separationSections">
							<form class="styleForm" action="index.php?action=addContent" method="post" >
								<div class="gpLabelAdmin">
									<label class="labelAdmin" for="newTitle">Titre de la page:</label>
									<input class="inputAdmin" type="text" id="newTitle" name="newTitle" required/>
								</div>
								<div class="gpLabelAdmin">
									<label class="labelAdmin" for="content">Contenu de la page:</label>
									<input class="inputAdmin" type="text" id="content" name="content" required/>
								</div>
								<div class="gpLabelAdmin">
									<label class="labelAdmin" for="idPage">identifiant de la page</label>
									<input class="inputAdmin" type="number" id="idPage" name="idPage" required/>
								</div>
								<div class="gpBtUpdate">
									<input type="submit" class="editButton" value="Enregistrer" />
								</div>
							</form>
				</div>

			</section>
			<?php
				} else {
			?> 
					<h2> Vous n'avez pas les droits sur cette page </h2>
			<?php
				}
			?> 

					<a id="retourHtPage"class="retourHtPage" href="#"><i class="fas fa-arrow-alt-circle-up"></i>Retour en haut de la page</a>
			

		</main>

		<!--Pied de page-->
		<footer>
			<?php include("public/footer.php");?>
		</footer>
		
	</body>
</html>