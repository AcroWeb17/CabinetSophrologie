<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title><?= htmlspecialchars($content['title']); ?> - Cabinet de Sophrologie</title>
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
			<!--En mode Admin-->
			<?php
				if (isset($_SESSION['auth'])) {
			?>	
					<?php include("public/menu.php");?>
					<section class="sectionRubriques">
						<div class="separationSections contenuRubriques">
							<h2 class="titreSection"> <?= htmlspecialchars($contentDetail['title']); ?></h2>
							<form class="styleForm" action="index.php?action=contentUpdate&id=<?= htmlspecialchars($contentDetail['id']); ?>" method="post" >
								<div class="gpLabelAdmin">
									<label class="labelAdmin" for="newTitle">Titre de la section:</label>
									<input class="inputAdmin" type="text" id="newTitle" name="newTitle" value="<?= htmlspecialchars($contentDetail['title']); ?>" required/>
								</div>
								<div class="gpLabelAdmin">
									<label class="labelAdmin" for="idPage">Nom de la page:</label>
									<select  class="inputAdmin" type="text" id="idPage" name="idPage" />
										<?php
											while($menu = $listPages->fetch())
											{
												$selected = "";
												if (($contentDetail['idPage'])==($menu['idPage'])){
													$selected="selected";
												}
										?>
										<option <?= $selected ?> value="<?= ($menu['idPage'])?>"><?= htmlspecialchars($menu['titlePage']) ?></option>
										<?php
											}
										?> 
										<option value="10">Brouillon</option>
									</select>
								</div>
								<div class="gpLabelAdmin">
									<label class="labelAdmin" for="indexContent">Ordre du contenu dans la page:</label>
									<input class="inputAdmin" type="number" id="indexContent" name="indexContent" value="<?= htmlspecialchars($contentDetail['index_content']); ?>" required/>
								</div>
								<div class="gpLabelAdmin">
									<textarea class="largeTxtAdmin" name="content" rows="255" >
										<?=html_entity_decode($contentDetail['content'])?>
									</textarea>
								</div>

								<?php 
									if(($contentDetail['idPage'])=='8')
									{
								?>
										<div class="gpLabelAdmin">
											<label class="labelAdmin" for="latX">Latitude X:</label>
											<input class="inputAdmin" type="text" id="latX" name="latX" value="<?= htmlspecialchars($contactContent['latX']); ?>" required/>
										</div>
										<div class="gpLabelAdmin">
											<label class="labelAdmin" for="longY">Longitude Y:</label>
											<input class="inputAdmin" type="text" id="longY" name="longY" value="<?= htmlspecialchars($contactContent['longY']); ?>" required/>
										</div>
										<div class="gpLabelAdmin">
											<label class="labelAdmin" for="nameCab">Nom du cabinet:</label>
											<input class="inputAdmin" type="text" id="nameCab" name="nameCab" value="<?= htmlspecialchars($contactContent['name']); ?>" required/>
										</div>
										<div class="gpLabelAdmin">
											<label class="labelAdmin" for="adresse">Adresse du cabinet:</label>
											<input class="inputAdmin" type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($contactContent['adresse']); ?>" required/>
										</div>
										<div class="gpLabelAdmin">
											<label class="labelAdmin" for="codePostal">Code postal:</label>
											<input class="inputAdmin" type="text" id="codePostal" name="codePostal" value="<?= htmlspecialchars($contactContent['codePostal']); ?>" required/>
										</div>
										<div class="gpLabelAdmin">
											<label class="labelAdmin" for="ville">Ville:</label>
											<input class="inputAdmin" type="text" id="ville" name="ville" value="<?= htmlspecialchars($contactContent['ville']); ?>" required/>
										</div>
										<div class="gpLabelAdmin">
											<label class="labelAdmin" for="telephone">Téléphone:</label>
											<input class="inputAdmin" type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($contactContent['telephone']); ?>" required/>
										</div>
										<div class="gpLabelAdmin">
											<label class="labelAdmin" for="mail">Mail:</label>
											<input class="inputAdmin" type="text" id="mail" name="mail" value="<?= htmlspecialchars($contactContent['mail']); ?>" required/>
										</div>
								<?php 
									}
								?>

								<div class="gpBtUpdate">
									<a class="editButton" href="index.php?action=contentAllAdmin">Annuler</a>
									<input type="submit" class="editButton" value="Enregistrer" />
									<a class="editButton" href="index.php?action=confirmDeleteContent&id=<?= htmlspecialchars($contentDetail['id']) ?>">Supprimer</a>
								</div>
							</form>
						</div>
					</section>

			<!--En mode Utilisateur-->
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