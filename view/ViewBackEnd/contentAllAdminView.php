<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Gestion des contenus - Cabinet de Sophrologie</title>
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
				<h2 class="titreSection"> Gestion des contenus </h2>
				<div class="gpBtUpdate">
					<a class="editButton" href="index.php?action=newContent">Nouveau contenu</a>
					<a class="editButton" href="index.php?action=pageAdmin">Gestion des pages</a>
					<a class="editButton" href="index.php?action=accueil">Retour à la page d'accueil</a>
				</div>
					<div class="separationSections">
							<?php
								$page_courante = "";
								while($data = $contentJoin->fetch())
								{
									if(htmlspecialchars($data['titlePage']) != $page_courante)
									{
										$page_courante = htmlspecialchars($data['titlePage']);
							?>
								<h3 class="titrePage"> <?=$page_courante?> </h3>
							<?php
								}
							?>
								<div class="separationGestionContenu">
									<a href="index.php?action=contentAdmin&id=<?= htmlspecialchars($data['id']) ?>">
										<p class="titreGestionContenu"> <?= htmlspecialchars($data['title']) ?> </p>
									</a>
									<div class="gpBtUpdate">
										<a class="editButton" href="index.php?action=contentAdmin&id=<?= htmlspecialchars($data['id']) ?>">Modifier</a>
										<a class="editButton" href="index.php?action=confirmDeleteContent&id=<?= htmlspecialchars($data['id']) ?>">Supprimer</a>
									</div>
								</div>
							<?php
								}
							?> 
			
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