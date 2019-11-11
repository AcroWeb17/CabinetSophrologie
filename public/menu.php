<section class="menu">
	<a class="lienLogo" href="index.php?action=accueil">
		<img class="logo" src="public/Illustrations/logo.svg" alt="Logo" title="Logo"/>
	</a>
	<div class="titresMenu">
	<?php
		while($menu = $pageMenu->fetch())
		{
	?>
			<a class="lienMenu" href="index.php?action=page&name=<?= htmlspecialchars($menu['name']) ?>"><?= htmlspecialchars($menu['titlePage']) ?></a>
	<?php
		}
	?> 
			<a class="lienMenu" href="index.php?action=accueil">Retour page d'accueil</a>
	</div>
</section>