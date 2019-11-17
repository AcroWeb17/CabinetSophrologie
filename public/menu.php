<!--Menu-->
<nav class="menu menuPage ferme" id="menu">
	<button type="button" class="crossMenu" id="crossMenu" name="crossMenu">X</button>
	<a class="lienLogo" href="index.php?action=accueil">
		<img class="logo" src="public/Illustrations/logo.svg" alt="Logo" title="Logo"/>
	</a>
	<div class="titresMenu">
		<?php
			while($menu = $pageMenu->fetch())
			{
		?>
				<a class="lienMenu" href="<?= htmlspecialchars($menu['name']) ?>"><?= htmlspecialchars($menu['title_page']) ?></a>
		<?php
			}
		?> 
				<a class="lienMenu" href="accueil">Retour page d'accueil</a>
	</div>
</nav>