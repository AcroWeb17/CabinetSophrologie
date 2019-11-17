<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Administration des pages - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Administration des pages du site du Cabinet de Sophrologie">
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
							<h2 class="titreSection"> Gestion des pages </h2>
							<div class="gpBtUpdate">
								<a class="editButton editPage" href="admin-nouvelle-page">Nouvelle Page</a>
								<a class="editButton editPage" href="admin-gestion-des-contenus">Gestion des contenus</a>
								<a class="editButton editPage" href="accueil">Retour à la page d'accueil</a>
							</div>
							<?php
								//Affichage des rubriques
								while($data = $page->fetch())
								{
							?>
									<div class="separationSections">
										<h3 class="titrePage"> <?= htmlspecialchars($data['title_page']) ?> </h3>
										<form class="styleForm" action="index.php?action=pageAdminUpdate" method="post" enctype="multipart/form-data">
											<div class="gpLabelAdmin">
												<label class="labelAdmin hidden" for="id">Identifiant de la page:</label>
												<input class="inputAdmin hidden" type="number" id="id" name="id" value="<?= htmlspecialchars($data['id_page']); ?>"/>
											</div>
											<div class="gpLabelAdmin">
												<label class="labelAdmin" for="newTitle">Titre de la page:</label>
												<input class="inputAdmin" type="text" id="newTitle" name="newTitle" value="<?= htmlspecialchars($data['title_page']); ?>" required/>
											</div>
											<div class="gpLabelAdmin" title="Photo au format jpg, dimensions attendues 400x270">
												<label class="labelAdmin" for="picture">Photo</label>
												<input class="inputAdmin" type="file" id="picture" name="picture"/>
											</div>
											<div class="gpLabelAdmin" title="Nom en minuscules et sans espaces ni caractères spéciaux">
												<label class="labelAdmin" for="name">Nom de la page:</label>
												<input class="inputAdmin" type="text" id="name" name="name" pattern="[a-z]*" value="<?= htmlspecialchars($data['name']); ?>" required/>
											</div>
											<div class="gpLabelAdmin">
												<label class="labelAdmin" for="indexPage">Ordre de la page:</label>
												<input class="inputAdmin" type="number" id="indexPage" name="indexPage" min="1" value="<?= htmlspecialchars($data['index_page']); ?>" required/>
											</div>
											<?php
												if ($data['contact'] === '0'){
											?>
													<div class="gpBtUpdate">
														<input type="submit" class="editButton editPage" value="Enregistrer" />
														<a class="editButton editPage" href="admin-suppression-page-n-<?= htmlspecialchars($data['id_page']); ?>">Supprimer</a>
													</div>
											<?php
												} else {
											?>
													<div class="gpBtUpdate">
														<input type="submit" class="editButton" value="Enregistrer" />
													</div>
											<?php
												}
											?>
										</form>
									</div>
							<?php
								}
							?> 
						</div>
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
			<a id="retourHtPage"class="retourHtPage" href="#"><i class="fas fa-arrow-alt-circle-up"></i>Retour en haut de la page</a>
		</main>

		<!--Pied de page-->
		<?php include("public/footer.php");?>

		<!--Scripts-->
		<?php include("public/scripts.php");?>
		
	</body>
</html>