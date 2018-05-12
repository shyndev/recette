<?php
	$larecette = array(
		'recette_id' => '',
		'recette_nom' => '',
		'recette_duree' => '',
		'recette_temperature' => '',
		'recette_image' => '',
		'recette_details' => ''
	);
	// var_dump($_REQUEST);

	if(isset($_REQUEST['categorie'])){
		$categorie = $_REQUEST['categorie'];
		$lesRecettes = getRecettesParCategorie($link, $categorie);
		// var_dump($lesRecettes);
	}
	if(isset($_REQUEST['recette'])){
		$recette_id = $_REQUEST['recette'];
		$larecette = getRecetteParId($link, $recette_id);
		// var_dump($recette);
	}
?>
<style type="text/css">
	.indicateur{
		background: var(--light);
		display: block;
		text-align: center;
		box-shadow: inset 0 0 5px black;
	}

	.indicateur-gauche{
		border-top-left-radius: 50px;
		border-bottom-left-radius: 50px;
	}

	.indicateur-droit{
		border-top-right-radius: 50px;
		border-bottom-right-radius: 50px;
	}

	.description{
		text-align: justify;
	}
</style>
<div class="col-3 menu">
	<h1>Menu</h1>
	<ul>
	<?php foreach ($lesRecettes as $recette) { $nom = getRename($recette['recette_nom']); ?>
		<a href="<?php echo SITE_URL.$categorie.'-'.$recette['recette_id'].'-'.$nom; ?>"><li><?php echo $recette['recette_nom']; ?></li></a>
	<?php } ?>
	</ul>
</div>
<div class="col-9 contenu">
	<?php if($larecette['recette_id'] > 0) { ?>
	<div class="row">
		<div class="col-12">
			<img src="<?php echo $larecette['recette_image']; ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-6"><span class="indicateur indicateur-gauche"><?php echo $larecette['recette_duree']; ?> min</span></div>
		<div class="col-6"><span class="indicateur indicateur-droit"><?php echo $larecette['recette_temperature']; ?>°C</span></div>
	</div>
	<div class="row">
		<div class="col-12"><h2><?php echo $larecette['recette_nom']; ?></h2></div>
	</div>
	<div class="row">
		<div class="col-3">
			<ul>
			<?php foreach ($lesIngredients as $ingredient) { $nom = getRename(); ?>
				<a href="#"><li><?php echo $ingredient['ingredient_nom']; ?></li></a>
			<?php } ?>
			</ul>
		</div>
		<div class="col-9 description"><?php echo nl2br($larecette['recette_details']); ?></div>
	</div>
	<?php } ?>
</div>