<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Accueil - Cabinet de Sophrologie</title>
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
			<?php
				if (isset($_SESSION['auth'])){
			?>		
					<div class="identification">
						<h2 class="titreSection titreConnect">Bienvenue Marine </h2>
						<a class="changeMdP" href="index?action=newPassword" alt="Password" title="Modifier le mot de passe"><i class="fas fa-key"></i></a>
						<a class="deconnect" href="index?action=deconnect" alt="Deconnexion" title="Deconnexion">Deconnexion</a>
					</div>
			<?php
				}
			?>
		</header>

		<!--Corps de page-->
		<main class="mainAccueil">
			<!--Présentation-->
			<section class="menu">
				<img class="logo" src="public/Illustrations/logo.png" alt="Logo" title="Logo"/>
				<article class="msgAccueilTxt">
					<p>	<?= html_entity_decode($msgAccueil['content']) ?></p>
					<p class="signature"> Marine</p>
					<?php
					if (isset($_SESSION['auth'])){
					?>	
						<a class="editButton msgAccueilEdit" href="index?action=msgAccueil">Mise à jour</a>
					<?php
						}
					?> 
				</article>
			</section>

			<section class="rubriques">
				<?php
				//Affichage des rubriques
					while($data = $page->fetch())
					{
				?>
				<article class="itemsRubrique">
					<a href="index?action=page&idPage=<?= htmlspecialchars($data['idPage']) ?>">
						<img class="imgRubrique" src="<?=$data['picture'] ?>"alt="" title=""/>
						<h3 class="titreRubrique"> <?= htmlspecialchars($data['titlePage']) ?> </h3>
					</a>
				</article>
				<?php
					}
				?>
				<?php
					if (isset($_SESSION['auth'])){
					?>	
						<div class="pageUpdate">
							<a class="editButton editPage" href="index?action=pageAdmin">Gestion des pages</a>
							<a class="editButton editPage" href="index?action=contentAllAdmin">Gestion des contenus</a>
						</div>
					<?php
						}
					?> 

			</section>

		</main>

		<!--Pied de page-->
		<footer>
			<?php include("public/footer.php");?>
		</footer>
		
	</body>
</html>