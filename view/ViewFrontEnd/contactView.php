<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Contact - Cabinet de Sophrologie</title>
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
			<section class="menu">
				<a href="index?action=accueil">
					<img class="logo" src="public/Illustrations/logo.png" alt="Logo" title="Logo"/>
				</a>
				<div class="titresMenu">
					<?php
					//Affichage des rubriques
						while($menu = $pageMenu->fetch())
						{
					?>
							<a class="lienMenu" href="index?action=page&idPage=<?= htmlspecialchars($menu['idPage']) ?>"><?= htmlspecialchars($menu['titlePage']) ?></a>
					<?php
						}
					?> 
							<a class="lienMenu" href="index?action=accueil">Retour page d'accueil</a>
				</div>
			</section>

			<section class="contenuRubriques">

					<h2 class="titreSection"> <?=htmlspecialchars($content['title'])?> </h2>
					<div class="mapContact">
						<iframe class="map" allowfullscreen src="https://www.openstreetmap.org/export/embed.html?bbox=2.30463981628418%2C49.88621549668987%2C2.3192310333251958%2C49.89818675815544&amp;layer=mapnik&amp;marker=49.89220149861141%2C2.3119354248046875"></iframe>
					</div>
					<div class="coordonnees">
						<?php
							if (isset($_SESSION['auth'])){
						?>	
								<a class="editButton sectionsEdit" href="index.php?action=contentAdmin&id=<?= htmlspecialchars($content['id']) ?>">Mise à jour</a>
						<?php
							}
						?> 
						<p class="contentContact"><?= html_entity_decode($content['content']) ?> </p>
	
					</div>
					<form class="formContact">
						<div class="gpLabelContact">
							<label class="labelContact" for="pernomUser">Votre nom</label>
							<input class="inputContact" type="text" id="nomUser" name="nomUser" required/>
						</div>
						<div class="gpLabelContact">
							<label class="labelContact" for="prenomUser">Votre prénom</label>
							<input class="inputContact" type="text" id="prenomUser" name="nomUser" required/>
						</div>
						<div class="gpLabelContact">
							<label class="labelContact" for="mailUser">Votre adresse mail</label>
							<input class="inputContact" type="mail" id="mailUser" name="mailUser"/>
						</div>
						<div class="gpLabelContact">
							<label class="labelContact" for="telUser">Votre téléphone</label>
							<input class="inputContact" type="tel" id="telUser" name="telUser" required/>
						</div>
						<div class="gpLabelContact">
							<textarea class="txtContact" rows="15" placeholder="Votre message"></textarea>
						</div>
						<div class="gpLabelContact">
							<input class="btSend" type="submit" value="Envoyer" />
						</div>
					</form>

					<a id="retourHtPage" class="retourHtPage" href="#"><i class="fas fa-arrow-alt-circle-up"></i>Retour en haut de la page</a>

			</section>
		</main>

		<!--Pied de page-->
		<footer>
			<?php include("public/footer.php");?>
		</footer>
		
	</body>
</html>