<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title><?= htmlspecialchars($content['title']); ?> - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/sophrologie.css"/>
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
			<!--En mode Admin-->
			<?php
				if (isset($_SESSION['auth'])) {
			?>	
					<section class="contenuRubriques">
						<div class="separationSections">
							<h2 class="titreSection"> <?= htmlspecialchars($content['title']); ?></h2>
							<form class="styleForm" action="index.php?action=contentUpdate&id=<?= htmlspecialchars($content['id']); ?>" method="post" >
								<label for="newTitle">Titre de la section:</label>
								<input type="text" id="newTitle" name="newTitle" value="<?= htmlspecialchars($content['title']); ?>" required/>
								<label for="idPage">Nom de la page:</label>
								<select type="text" id="idPage" name="idPage"/>
									<?php
										while($menu = $pageMenu->fetch())
										{
									?>
									<option value="<?= ($menu['idPage'])?>"><?= htmlspecialchars($menu['titlePage']) ?></option>
									<?php
										}
									?> 
									
									<option value="">Brouillon</option>
		
				
								</select>
								<textarea class="largeTxtAdmin" name="content" rows="255" >
									<?=html_entity_decode($content['content'])?>
								</textarea>
								<div class="submitAccueil">
									<a class="editButton" href="index.php?action=page">Annuler</a>
									<input type="submit" class="editButton" value="Enregistrer" />
									<a class="editButton" href="index.php?action=confirmDeleteContent&id=<?= htmlspecialchars($content['id']) ?>">Supprimer</a>
								</div>
							</form>
						</div>
					</section>

			<!--En mode Utilisateur-->
			<?php
				} else {
			?>
					<h2 class="titreSection"> Vous n'avez pas les droits sur cette page </h2>
			<?php
				}
			?>
		</main>

				<!--Pied de page-->
		<footer>
			<?php include("public/footer.php");?>
		</footer>

		<!--Fichiers Javascript-->
		<script src="tinymce/tinymce.min.js"></script>
		<script src="tinymce/themes/silver/theme.min.js"></script>
		<script src="tinymce/parametresTinyMCE.js"></script>
		
	</body>
</html>