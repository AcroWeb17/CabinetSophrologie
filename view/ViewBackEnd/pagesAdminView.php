<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Administration des pages - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/sophrologie.css"/>
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
				<h2 class="titreSection"> Gestion des pages </h2>
				<div class="gpBtUpdate">
					<a class="editButton" href="index.php?action=newPage">Nouvelle Page</a>
					<a class="editButton" href="index.php?action=contentAllAdmin">Gestion des contenus</a>
					<a class="editButton" href="index.php?action=accueil">Retour à la page d'accueil</a>
				</div>
				<?php
				//Affichage des rubriques
					while($data = $page->fetch())
					{
				?>
				<div class="separationSections">
							<h3 class="titrePage"> <?= htmlspecialchars($data['titlePage']) ?> </h3>
							<form class="styleForm" action="index.php?action=pageAdminUpdate" method="post" >
								<div class="gpLabelAdmin">
									<label class="labelAdmin hidden" for="id">Identifiant de la page:</label>
									<input class="inputAdmin hidden" type="number" id="id" name="id" value="<?= htmlspecialchars($data['idPage']); ?>"/>
								</div>
								<div class="gpLabelAdmin">
									<label class="labelAdmin" for="newTitle">Titre de la page:</label>
									<input class="inputAdmin" type="text" id="newTitle" name="newTitle" value="<?= htmlspecialchars($data['titlePage']); ?>" required/>
								</div>
								<div class="gpLabelAdmin">
									<label class="labelAdmin" for="name">Nom de la page:</label>
									<input class="inputAdmin" type="text" id="name" name="name" value="<?= htmlspecialchars($data['name']); ?>" required/>
								</div>
								<div class="gpLabelAdmin">
									<label class="labelAdmin" for="indexPage">Ordre de la page:</label>
									<input class="inputAdmin" type="number" id="indexPage" name="indexPage" value="<?= htmlspecialchars($data['index_page']); ?>" required/>
								</div>
								<div class="gpBtUpdate">
									<input type="submit" class="editButton" value="Enregistrer" />
									<a class="editButton" href="index.php?action=confirmDeletePage&idPage=<?= htmlspecialchars($data['idPage']); ?>">Supprimer</a>
								</div>
							</form>
				</div>
						<?php
							}
						?> 
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