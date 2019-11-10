<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title> Cabinet de Sophrologie</title>
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
		<main>
			<section class="menu">
				<a href="index.php?action=accueil">
					<img class="logo" src="public/Illustrations/logo.png" alt="Logo" title="Logo"/>
				</a>
				<div class="titresMenu">
					<?php
					//Affichage des rubriques
						while($menu = $pageMenu->fetch())
						{
					?>
							<a class="lienMenu" href="index.php?action=page&name=<?= htmlspecialchars($menu['name']) ?>"><?= htmlspecialchars($menu['titlePage']) ?></a>
					<?php
						}
					?> 
							<a class="lienMenu" href="index.php?action=accueil">Retour page d'accueil</a>
				</div>
			</section>

			<section class="contenuRubriques">

				<div class="separationSections">
					<?php
					//Affichage des rubriques
						while($data = $content->fetch())
						{
					?>
							<h2 class="titreSection"> <?= htmlspecialchars($data['title']) ?> </h2>
							<img class="photo" src="<?=$data['picture'] ?>"alt="" title=""/>
							<p class="contentPage">
								<?= html_entity_decode($data['content']) ?>
							</p>
				</div>
						<?php
							if (isset($_SESSION['auth'])){
						?>	
								<div class="gpBtUpdate">
									<a class="editButton" href="index.php?action=contentAdmin&id=<?= htmlspecialchars($data['id']) ?>">Mise à jour</a>
									<a class="editButton" href="index.php?action=confirmDeleteContent&id=<?= htmlspecialchars($data['id']) ?>">Supprimer</a>
								</div>
						<?php
							}
						?> 
					<?php
						}
					?> 
				
					<a id="retourHtPage"class="retourHtPage" href="#"><i class="fas fa-arrow-alt-circle-up"></i>Retour en haut de la page</a>
				
			</section>

		</main>

		<!--Pied de page-->
		<footer>
			<?php include("public/footer.php");?>
		</footer>
		
	</body>
</html>