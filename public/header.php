<!--En tête-->
<header>
	<a href="index.php?action=accueil">
		<div class="bandeau">
			<h1 class="titreBandeau"> Votre cabinet de Sophrologie</h1>
			<p class="ssTitreBandeau"> Être bien dans son corps pour se sentir bien dans sa tête </p>
		</div>
	</a>
	<?php
		if (isset($_SESSION['auth']) && (!isset($_GET['action']) || $_GET['action']=='accueil'|| $_GET['action']=='' )){
	?>		
			<div class="identification">
				<h2 class="titreSection titreConnect">Bienvenue Marine </h2>
				<a class="changeMdP" href="index.php?action=newPassword" alt="Password" title="Modifier le mot de passe"><i class="fas fa-key"></i></a>
				<a class="deconnect" href="index.php?action=deconnect" alt="Deconnexion" title="Deconnexion">Deconnexion</a>
			</div>
	<?php
		} 
		if (isset($_GET['action']) && $_GET['action']!='accueil'&& $_GET['action']!='' ) {
	?>
				<button type="button" class="menuMobile button" id="menuMobile" name="menuMobile">
					<span class="navBtContent">	Menu</span>
				</button>
	<?php
		}
	?>
</header>	