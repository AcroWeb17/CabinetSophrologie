<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Nouvelle page - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Création d'une nouvelle page par l'administrateur du site du Cabinet de Sophrologie.">
	</head>

	<body>
		<!--En-tête-->
		<?php include("public/header.php");?>

		<!--Corps de page-->
		<main class="mainPage">
			<?php
				if (isset($_SESSION['auth'])){
			?>	
					<?php include("public/menu.php");?>
					<section class="sectionRubriques">
						<div class="contenuRubriques">
							<h2 class="titreSection"> Nouvelle page </h2>
							<div class="gpBtUpdate">
								<a class="editButton" href="index.php?action=pageAdmin">Annuler</a>
								<a class="editButton" href="index.php?action=accueil">Retour à la page d'accueil</a>
							</div>

							<div class="separationSections">
								<form class="styleForm" action="index.php?action=addPage" method="post" enctype="multipart/form-data">
									<div class="gpLabelAdmin">
										<label class="labelAdmin" for="newTitle">Titre de la page:</label>
										<input class="inputAdmin" type="text" id="newTitle" name="newTitle" required/>
									</div>
									<div class="gpLabelAdmin">
										<label class="labelAdmin" for="name">Nom de la page:</label>
										<input class="inputAdmin" type="text" id="name" name="name" required/>
									</div>
									<div class="gpLabelAdmin">
										<label class="labelAdmin" for="picture">Photo</label>
										<input class="inputAdmin" type="file" id="picture" name="picture"required/>
									</div>
									<div class="gpLabelAdmin">
										<label class="labelAdmin" for="indexPage">Ordre de la page:</label>
										<input class="inputAdmin" type="number" id="indexPage" name="indexPage" required/>
									</div>
									<div class="gpBtUpdate">
										<input type="submit" class="editButton" value="Enregistrer" />
									</div>
								</form>
							</div>
						</div>
						<a id="retourHtPage"class="retourHtPage" href="#"><i class="fas fa-arrow-alt-circle-up"></i>Retour en haut de la page</a>
					</section>
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
		<?php include("public/footer.php");?>
		
		<!--Scripts-->
		<?php include("public/scripts.php");?>
		
	</body>
</html>