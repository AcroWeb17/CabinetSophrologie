<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Gestion des contenus - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Page d'administration des contenus du site du Cabinet de Sophrologie">
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
							<h2 class="titreSection"> Gestion des contenus </h2>
							<div class="gpBtUpdate">
								<a class="editButton editPage" href="index.php?action=newContent">Nouveau contenu</a>
								<a class="editButton editPage" href="index.php?action=pageAdmin">Gestion des pages</a>
								<a class="editButton editPage" href="index.php?action=accueil">Retour à la page d'accueil</a>
							</div>
							<div class="separationSections">
								<?php
									$page_courante = "";
									while($data = $contentJoin->fetch())
									{
										if(htmlspecialchars($data['title_page']) != $page_courante)
										{
											$page_courante = htmlspecialchars($data['title_page']);
								?>
											<h3 class="titrePage"> <?=$page_courante?> </h3>
									<?php
										}
									?>
										<div class="separationGestionContenu">
											<a href="index.php?action=contentAdmin&id=<?= htmlspecialchars($data['id']) ?>">
												<p class="titreGestionContenu"> <?= htmlspecialchars($data['title']) ?> </p>
											</a>
											<?php
												if ($data['contact'] === '0'){
											?>
													<div class="gpBtUpdate">
														<a class="editButton editPage" href="index.php?action=contentAdmin&id=<?= htmlspecialchars($data['id']) ?>">Modifier</a>
														<a class="editButton editPage" href="index.php?action=confirmDeleteContent&id=<?= htmlspecialchars($data['id']); ?>">Supprimer</a>
													</div>
											<?php
												} else {
											?>
													<div class="gpBtUpdate">
														<a class="editButton" href="index.php?action=contentAdmin&id=<?= htmlspecialchars($data['id']) ?>">Modifier</a>
													</div>
											<?php
												}
											?>
										</div>
								<?php
									}
								?> 
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