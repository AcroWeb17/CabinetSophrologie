<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title> <?php echo $page['title_page'];?> - Cabinet de sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Page du site du Cabinet de Sophrologie">
	</head>

	<body>
		<!--En tête-->
		<?php include("public/header.php");?>

		<!--Corps de page-->
		<main class="mainPage">
			<?php include("public/menu.php");?>
			<section class="sectionRubriques">
				<div class="contenuRubriques">
					<?php
						if (isset($_SESSION['auth'])){
					?>	
							<div class="gpBtUpdate">
								<a class="editButton editPage" href="index.php?action=newContent">Nouveau contenu</a>
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
									<?php 
										if (!is_null($data['picture']) && $data['picture']!=='' && file_exists($data['picture']) ){
									?>
											<img class="photo" src="<?=$data['picture'] ?>"alt="Image de la section" title="<?=$data['title'] ?>"/>
									<?php
										}
									?>
									<div class="contentPage">
										<?= html_entity_decode($data['content']) ?>
									</div>
									<?php
										if (isset($_SESSION['auth'])){
									?>	
											<div class="gpBtUpdate">
												<a class="editButton editPage" href="index.php?action=contentAdmin&id=<?= htmlspecialchars($data['id']) ?>">Mise à jour</a>
												<a class="editButton editPage" href="index.php?action=confirmDeleteContent&id=<?= htmlspecialchars($data['id']) ?>">Supprimer</a>
											</div>
									<?php
										}
									?> 
								</div>
						<?php
							}
						?> 
					</div>
					<a id="retourHtPage"class="retourHtPage" href="#"><i class="fas fa-arrow-alt-circle-up"></i>Retour en haut de la page</a>
				</div>
			</section>
		</main>

		<!--Pied de page-->
		<?php include("public/footer.php");?>
		
		<!--Script-->
		<?php include("public/scripts.php");?>

	</body>
</html>