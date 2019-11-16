<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<title>Accueil - Cabinet de Sophrologie</title>
		<link rel="shortcut icon" href="public/Illustrations/favicon.ico"/>
		<link rel="stylesheet" href="public/css/sophrologie.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta name="description" content="Page d'accueil du site du Cabinet de Sophrologie">
	</head>

	<body>
		<!--En tête-->
		<?php include("public/header.php");?>

		<!--Corps de page-->
		<main class="mainAccueil">
			<!--Présentation-->
			<section class="menu msgPresentation">
				<div class="lienLogo">
					<img class="logo" src="public/Illustrations/logo.svg" alt="Logo" title="Logo"/>
				</div>
				<article class="msgAccueilTxt">
					<p>	<?= html_entity_decode($msgAccueil['content']) ?></p>
					<p class="signature"> Marine</p>
					<?php
						if (isset($_SESSION['auth'])){
					?>	
						<div class="msgAccueilEdit">
							<a class="editButton msgAccueilEdit" href="index.php?action=msgAccueil">Mise à jour</a>
						</div>
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
					<a href="index.php?action=page&name=<?= htmlspecialchars($data['name']) ?>">
						<img class="imgRubrique" src="<?=$data['picture'] ?>" alt="Image d'une section de la page d'accueil" title="<?=$data['title_page'] ?>"/>
						<h3 class="titreRubrique"> <?= htmlspecialchars($data['title_page']) ?> </h3>
					</a>
				</article>
				<?php
					}
				?>
				<?php
					if (isset($_SESSION['auth'])){
				?>	
						<div class="pageUpdate">
							<a class="editButton editPage" href="index.php?action=pageAdmin">Gestion des pages</a>
							<a class="editButton editPage" href="index.php?action=contentAllAdmin">Gestion des contenus</a>
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