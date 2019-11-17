<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title><?php echo($contentDetail['title']);?> - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Administration du contenu du site du Cabinet de Sophrologie">
	</head>

	<body>
		<!--En tête-->
		<?php include("public/header.php");?>

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
							<form class="styleForm" action="index.php?action=contentUpdate&id=<?= htmlspecialchars($contentDetail['id']); ?>" method="post" enctype="multipart/form-data">
								<div class="gpLabelAdmin">
									<label class="labelAdmin" for="newTitle">Titre de la section:</label>
									<input class="inputAdmin" type="text" id="newTitle" name="newTitle" value="<?= htmlspecialchars($contentDetail['title']); ?>" required/>
								</div>

								<div class="gpLabelAdmin">
									<label class="labelAdmin" for="idPage">Contenu affiché sur la page:</label>
									<select  class="inputAdmin" type="text" id="idPage" name="idPage" />
										<?php
											while($menu = $listPages->fetch())
											{
												if (($contentDetail['id_page'])=="8" & ($menu['id_page'])!="8"){
													continue;
												}
												$selected = "";
												if (($contentDetail['id_page'])==($menu['id_page'])){
													$selected="selected";
												}
										?>
										<option <?= $selected ?> value="<?= ($menu['id_page'])?>"><?= htmlspecialchars($menu['title_page']) ?></option>
										<?php
											} 
											if (($contentDetail['id_page'])!="8"){
										?> 
										<option value="10">Brouillon</option>
										<?php
											}
										?>
									</select>
								</div>

								<?php 
									if(($contentDetail['id_page'])=='8')
									{
								?>		
										<div class="gpLabelAdmin">
											<label class="labelAdmin" for="indexContent">Ordre du contenu dans la page:</label>
											<input class="inputAdmin" readonly type="number" id="indexContent" min="1" name="indexContent" value="<?= htmlspecialchars($contentDetail['index_content']); ?>" required/>
										</div>
										<div class="gpLabelAdmin">
											<textarea class="smallTxtAdmin" name="content" rows="255" >
												<?=html_entity_decode($contentDetail['content'])?>
											</textarea>
										</div>
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
											<input class="inputAdmin" type="text" id="codePostal" name="codePostal" value="<?= htmlspecialchars($contactContent['code_postal']); ?>" required/>
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
											<input class="inputAdmin" type="email" id="mail" name="mail" value="<?= htmlspecialchars($contactContent['mail']); ?>" required/>
										</div>
										<div class="gpBtUpdate">
											<a class="editButton" href="admin-gestion-des-contenus">Annuler</a>
											<input type="submit" class="editButton" value="Enregistrer" />
										</div>
								<?php 
									} else {
								?>
										<div class="gpLabelAdmin">
											<label class="labelAdmin" for="indexContent">Ordre du contenu dans la page:</label>
											<input class="inputAdmin" type="number" id="indexContent" min="1" name="indexContent" min="1" value="<?= htmlspecialchars($contentDetail['index_content']); ?>" required/>
										</div>
										<div class="gpLabelAdmin" title="Photo au format jpg, dimensions attendues 200x200">
											<label class="labelAdmin" for="picture">Photo</label>
											<input class="inputAdmin" type="file" id="picture" name="picture"/>
										</div>
										<div class="gpLabelAdmin">
											<label class="labelAdmin" for="noPicture">Supprimer la photo du contenu</label>
											<input class="checkboxAdmin" type="checkbox" id="noPicture" name="noPicture"/>
										</div>
										<div class="gpLabelAdmin">
											<textarea class="largeTxtAdmin" name="content" rows="255" >
												<?=html_entity_decode($contentDetail['content'])?>
											</textarea>
										</div>
										<div class="gpBtUpdate">
											<a class="editButton" href="admin-gestion-des-contenus">Annuler</a>
											<input type="submit" class="editButton" value="Enregistrer" />
											<a class="editButton" href="admin-suppression-contenu-n-<?= htmlspecialchars($contentDetail['id']) ?>">Supprimer</a>
										</div>
								<?php 
									}
								?>
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
							<a class="button btSolo" href="accueil">Page d'accueil</a>
						</div>
					</section>
			<?php
				}
			?>
		</main>

		<!--Pied de page-->
		<?php include("public/footer.php");?>

		<!--Scripts-->
		<script src="tinymce/tinymce.min.js"></script>
		<script src="tinymce/themes/silver/theme.min.js"></script>
		<script src="tinymce/parametresTinyMCE.js"></script>
		<?php include("public/scripts.php");?>
		
	</body>
</html>