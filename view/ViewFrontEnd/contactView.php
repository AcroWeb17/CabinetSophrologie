<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Contact - Cabinet de Sophrologie</title>
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
					<h2 class="titreSection"> <?=htmlspecialchars($content['title'])?> </h2>
					<div class="introContact">
						<p class="contentIntroContact"><?= html_entity_decode($content['content']) ?> </p>
						<?php
							if (isset($_SESSION['auth'])){
						?>	
								<div class="gpBtUpdate">
									<a class="editButton" href="index.php?action=contentAdmin&id=<?= htmlspecialchars($content['id']) ?>">Mise à jour</a>
								</div>
						<?php
							}
						?> 
					</div>
					<div class="mapContact">
						<div id="map_viewer">
							<p id="sources">© AcroWeb - 2019 <br/> Fond de carte: © OpenStreetMap<br/> </p>
						</div>

					</div>
					<div class="coordonnees">
						<input id="latX" type="hidden" value="<?= html_entity_decode($contact['latX']) ?>" disabled />
						<input id="longY" type="hidden" value="<?= html_entity_decode($contact['longY']) ?>" disabled />
						<p class="contentContact"><?= html_entity_decode($contact['name']) ?> </p>
						<p class="contentContact"><?= html_entity_decode($contact['adresse']) ?> </p>
						<p class="contentContact"><?= html_entity_decode($contact['codePostal']) ?> <?= html_entity_decode($contact['ville']) ?> </p>
						<p class="contentContact"><?= html_entity_decode($contact['telephone']) ?> </p>
						<p class="contentContact"><?= html_entity_decode($contact['mail']) ?> </p> 
						<?php
							if (isset($_SESSION['auth'])){
						?>	
								<div class="gpBtUpdate">
									<a class="editButton" href="index.php?action=contentAdmin&id=<?= htmlspecialchars($content['id']) ?>">Mise à jour</a>
								</div>
						<?php
							}
						?>
					</div>
					<form class="formContact" id="formContact" method="post" action="index.php?action=sendMessage">
						<div class="gpLabelContact">
							<label class="labelContact" for="nomUser">Votre nom *</label>
							<input class="inputContact" type="text" id="nomUser" name="nomUser" required/>
						</div>
						<div class="gpLabelContact">
							<label class="labelContact" for="prenomUser">Votre prénom *</label>
							<input class="inputContact" type="text" id="prenomUser" name="prenomUser" required/>
						</div>
						<div class="gpLabelContact">
							<label class="labelContact" for="mailUser">Votre adresse mail</label>
							<input class="inputContact" type="mail" id="mailUser" name="mailUser"/>
						</div>
						<div class="gpLabelContact">
							<label class="labelContact" for="telUser">Votre téléphone</label>
							<input class="inputContact" type="tel" id="telUser" name="telUser" />
						</div>
						<div class="gpLabelContact gpLabelContactVertical">
                            <label class="labelContact" for="msgUser">Votre message *</label>
							<textarea class="txtContact" rows="15" id="msgUser" name="msgUser"></textarea>
						</div>
						<div class="gpLabelContact">
							<input class="btSend" type="submit" value="Envoyer" />
                            <p id="formLoading" class="formLoading hidden">Validation en cours...</p>
						</div>
                        <div id="contactErrorMsg" class="contactInfoMsg contactErrorMsg"></div>
                        <div id="contactSuccessMsg" class="contactInfoMsg contactSuccessMsg"></div>
                        <div class="contactInfoMsg">
                            <ul>
                                <li>Les champs marqués par * sont obligatoires.</li>
                                <li>Merci de fournir une adresse mail ou un numéro de téléphone afin de pouvoir vous recontacter.</li>
                            </ul>
                        </div>
					</form>

					<a id="retourHtPage" class="retourHtPage" href="#"><i class="fas fa-arrow-alt-circle-up"></i>Retour en haut de la page</a>
				</div>
			</section>
		</main>

		<!--Pied de page-->
		<footer>
			<?php include("public/footer.php");?>
		</footer>

		<script src="public/js/contactForm.js" defer></script>
		<!--<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js" defer></script> --><!--fond de carte Openlayers-->
		<script src="public/js/ol.js" defer></script>
		<script src="public/js/map.js" defer></script>	<!--fichier Javascript de la carte-->
		<script src="public/js/backToTop.js" defer></script>
		
	</body>
</html>