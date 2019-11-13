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
		<main class="mainPage">
			<?php include("public/menu.php");?>

			<section class="sectionRubriques">
				<div class="contenuRubriques">
					<?php
						if (isset($_SESSION['auth'])){
					?>	
							<div class="gpBtUpdate">
								<a class="editButton" href="index.php?action=newContent">Nouveau contenu</a>
								<a class="editButton editPage" href="index.php?action=contentAllAdmin">Gestion des contenus</a>
								<a class="editButton editPage" href="index.php?action=pageAdmin">Gestion des pages</a>
							</div>
					<?php
						}
					?> 
					<div class="separationSections">
						<?php
						//Affichage des rubriques
							while($data = $content->fetch())
							{
						?>
								<div class="contentSection">
									<h2 class="titreSection"> <?= htmlspecialchars($data['title']) ?> </h2>
									<img class="photo" src="<?=$data['picture'] ?>"alt="" title=""/>
									<p class="contentPage">
										<?= html_entity_decode($data['content']) ?>
									</p>
								<?php
									if (isset($_SESSION['auth'])){
								?>	
										<div class="gpBtUpdate">
											<a class="editButton" href="index.php?action=contentAdmin&id=<?= htmlspecialchars($data['id']) ?>">Mise à jour</a>
											<a class="editButton" href="index.php?action=confirmDeleteContent&id=<?= htmlspecialchars($data['id']) ?>">Supprimer</a>
										</div>
								</div>
								<?php
								}
							?> 
						<?php
							}
						?> 
					</div>
						<a id="retourHtPage"class="retourHtPage" href="#"><i class="fas fa-arrow-alt-circle-up"></i>Retour en haut de la page</a>
				</div>
			</section>

		</main>

		<!--Pied de page-->
		<footer>
			<?php include("public/footer.php");?>
		</footer>
		
		<script src="public/js/backToTop.js" defer></script>

	</body>
</html>