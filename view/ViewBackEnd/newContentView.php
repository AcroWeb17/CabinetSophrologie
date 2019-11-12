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
		<main class="mainPage">
			<?php
				if (isset($_SESSION['auth'])){
			?>	
					<?php include("public/menu.php");?>
					<section class="sectionRubriques">
						<div class="contenuRubriques">
							<h2 class="titreSection"> Nouveau contenu </h2>
							<div class="gpBtUpdate">
								<a class="editButton" href="index.php?action=contentAllAdmin">Annuler</a>
								<a class="editButton" href="index.php?action=accueil">Retour à la page d'accueil</a>
							</div>

							<div class="separationSections">
								<form class="styleForm" action="index.php?action=addContent" method="post" >
									<div class="gpLabelAdmin">
										<label class="labelAdmin" for="newTitle">Titre de la section:</label>
										<input class="inputAdmin" type="text" id="newTitle" name="newTitle" required/>
									</div>
									<div class="gpLabelAdmin">
										<label class="labelAdmin" for="idPage">Nom de la page</label>
										<select  class="inputAdmin" type="text" id="idPage" name="idPage" />
												<?php
													while($menu = $listPages->fetch())
													{
												?>
												<option value="<?= ($menu['idPage'])?>"><?= htmlspecialchars($menu['titlePage']) ?></option>
												<?php
													}
												?> 
												<option selected value="10">Brouillon</option>
										</select>
									</div>
									<div class="gpLabelAdmin">
										<label class="labelAdmin" for="indexContent">Ordre du contenu dans la page</label>
										<input class="inputAdmin" type="number" id="indexContent" name="indexContent" required/>
									</div>
									<div class="gpLabelAdmin">
										<label class="labelAdmin" for="content">Contenu:</label>
										<textarea class="largeTxtAdmin" name="content" rows="255" ></textarea>
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
		<footer>
			<?php include("public/footer.php");?>
		</footer>
				<!--Fichiers Javascript-->
		<script src="tinymce/tinymce.min.js"></script>
		<script src="tinymce/themes/silver/theme.min.js"></script>
		<script src="tinymce/parametresTinyMCE.js"></script>
	</body>
</html>