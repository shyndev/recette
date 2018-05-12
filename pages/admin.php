<?php 
	$lesRecettes = getRecettes($link);
	$lesIngredients = getIngredients($link);
	$lesCategories = getCategories($link);
?>
<style type="text/css">
	.nav-pills .nav-link.active, .show>.nav-pills .nav-link{
		color: var(--light);
		background-color: var(--dark);
	}
	.nav-pills a, .nav-pills a:hover {
		color: var(--light);
		text-align: center;
	}

	.contenu {
		background-color: var(--blankpage);
		margin: 30px auto 0;
		box-shadow: 0 3px 20px black;
	}
	.modal-content{
		background-color: var(--white);
		min-width: 650px;
		min-height: 650px;
	}
	input[type=file]{
		display: none;
	}
	textarea {
		min-height: 240px;
	}
	td {
		padding: 0!important;
	}

	[id*=gestion-] span{
		margin: auto;
		display: block;
	}

	[id*=gestion-] img{
		width: 60px;
		height: auto;
	}

	[id*=gestion-] span{
		font-size: 20px;
		text-align: center;
		vertical-align: -webkit-baseline-middle;
	}
</style>
<div class="col-3 menu">
	<h1>Paramètre</h1>
	<ul class="nav nav-pills flex-column" id="pills-tab" role="tablist" aria-orientation="vertical">
		 <li class="nav-item"><a class="nav-link" id="gestion-recette-tab" data-toggle="pill" href="#gestion-recette" role="tab" aria-controls="gestion-recette" aria-selected="false">Recettes</a></li>
		 <li class="nav-item"><a class="nav-link" id="gestion-ingredient-tab" data-toggle="pill" href="#gestion-ingredient" role="tab" aria-controls="gestion-ingredient" aria-selected="false">Ingrédients</a></li>
		 <li class="nav-item"><a class="nav-link" id="gestion-categorie-tab" data-toggle="pill" href="#gestion-categorie" role="tab" aria-controls="gestion-categorie" aria-selected="false">Catégories</a></li>
	</ul>
</div>
<div class="col-8 contenu">
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade" id="gestion-recette" role="tabpanel" aria-labelledby="gestion-recette-tab">
			<h1>Gestion des recettes</h1>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ajouterRecette">Ajouter une recette</button>
			<table class="table table-hover">
				<thead>
					<th>#</th>
					<th>Nom de la recette</th>
					<th></th>
				</thead>
				<tbody>
					<?php foreach ($lesRecettes as $recette) { ?>
					<tr>
						<td>
							<?php if(trim($recette['recette_image']) != '') { ?>
								<img src="<?php echo $recette['recette_image']; ?>">
							<?php } else { ?>
								<img src="<?php echo SITE_URL; ?>no-image.webp" class="rounded img-thumbnail" alt="...">
							<?php } ?>
						</td>
						<td><span><?php echo $recette['recette_nom']; ?></span></td>
						<td>
							<button type="button" class="btn btn-secondary btn_modifier_recette" id="<?php echo $recette['recette_id']; ?>">Modifier</button>
							<button type="button" class="btn btn-danger" id="btn_supprimer_recette">Supprimer</button>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="gestion-categorie" role="tabpanel" aria-labelledby="gestion-categorie-tab">
			<h1>Gestion des catégories</h1>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ajouterCategorie">Ajouter une catégorie</button>
			<table class="table table-hover">
				<thead>
					<th>#</th>
					<th>Nom de la catégorie</th>
					<th></th>
				</thead>
				<tbody>
					<?php foreach ($lesCategories as $categorie) { ?>
					<tr>
						<td>
							<?php if(trim($categorie['categorie_image']) != '') { ?>
								<img src="<?php echo $categorie['categorie_image']; ?>">
							<?php } else { ?>
								<img src="<?php echo SITE_URL; ?>no-image.webp" class="rounded img-thumbnail" alt="...">
							<?php } ?>
						</td>
						<td><p><?php echo $categorie['categorie_nom']; ?></p></td>
						<td>
							<button type="button" class="btn btn-secondary btn_modifier_categorie" id="<?php echo $categorie['categorie_id']; ?>">Modifier</button>
							<button type="button" class="btn btn-danger" id="btn_supprimer_categorie">Supprimer</button>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="gestion-ingredient" role="tabpanel" aria-labelledby="gestion-ingredient-tab">
			<h1>Gestion des ingrédients</h1>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ajouterIngredient">Ajouter un ingrédient</button>
			<table class="table table-hover">
				<thead>
					<th>#</th>
					<th>Nom de l'ingrédient</th>
					<th></th>
				</thead>
				<tbody>
					<?php foreach ($lesIngredients as $ingredient) { ?>
					<tr>
						<td>
							<?php if(trim($ingredient['ingredient_image']) != '') { ?>
								<img src="<?php echo $ingredient['ingredient_image']; ?>">
							<?php } else { ?>
								<img src="<?php echo SITE_URL; ?>no-image.webp" class="rounded img-thumbnail" alt="...">
							<?php } ?>
						</td>
						<td><p><?php echo $ingredient['ingredient_nom']; ?></p></td>
						<td>
							<button type="button" class="btn btn-secondary btn_modifier_ingredient" id="<?php echo $ingredient['ingredient_id']; ?>">Modifier</button>
							<button type="button" class="btn btn-danger" id="btn_supprimer_ingredient">Supprimer</button>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="modifierRecette" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Modifier une recette</h3>
			</div>
			<div class="modal-body">
				<form>
					<input type="hidden" name="recette_id" class="recette_id" value="<?php echo $recette['recette_id']; ?>">
					<div class="form-group">
						<select class="form-control recette_categorie">
						<?php foreach ($lesCategories as $categorie) { ?>
							<option value="<?php echo $categorie['categorie_id']; ?>"><?php echo $categorie['categorie_nom']; ?></option>
						<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control recette_nom" placeholder="Nom de la recette">
					</div>
					<div class="form-group">
						<input type="number" class="form-control recette_duree" placeholder="Durée de la cuisson (en minute)" min="10" max="120">
					</div>
					<div class="form-group">
						<input type="number" class="form-control recette_temperature" placeholder="Température de cuisson" min="60" max="200">
					</div>
					<div class="form-group">
						<textarea name="description" class="form-control recette_details" placeholder="Description de la recette"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-success" id="btn_modifier_recette">Confirmer</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ajouterRecette" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Ajouter une recette</h3>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<select class="form-control" id="recette_categorie">
						<?php foreach ($lesCategories as $categorie) { ?>
							<option value="<?php echo $categorie['categorie_id']; ?>"><?php echo $categorie['categorie_nom']; ?></option>
						<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Nom de la recette" id="recette_nom">
					</div>
					<div class="form-group">
						<input type="number" class="form-control" placeholder="Durée de la cuisson (en minute)" id="recette_duree" min="10" max="120">
					</div>
					<div class="form-group">
						<input type="number" class="form-control" placeholder="Température de cuisson" id="recette_temperature" min="60" max="200">
					</div>
					<div class="form-group">
						<textarea name="description"  id="recette_details" class="form-control" placeholder="Description de la recette"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-success" id="btn_ajouter_recette">Confirmer</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ajouterIngredient" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Ajouter un ingrédient</h3>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Nom de l'ingrédient" id="ingredient_nom">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-success" id="btn_ajouter_ingredient">Confirmer</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ajouterCategorie" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Ajouter une catégorie</h3>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Nom de la catégorie" id="categorie_nom">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-success" id="btn_ajouter_categorie">Confirmer</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.btn_modifier_recette').click(function(){
		var recette_id = $(this).attr('id');
		var action = {'fonction':'getRecetteParId', 'recette_id':recette_id};
		var param = $.param(action);
		$.ajax({
			'url':'<?php echo SITE_URL; ?>fonction.php',
			'type':'POST',
			'data':param,
			'dataType':'JSON',
			success:function(recette){
				console.log(recette);

				$('body').find('#modifierRecette').find('.recette_categorie').val(recette.recette_categorie);
				$('body').find('#modifierRecette').find('.recette_nom').val(recette.recette_nom);
				$('body').find('#modifierRecette').find('.recette_duree').val(recette.recette_duree);
				$('body').find('#modifierRecette').find('.recette_temperature').val(recette.recette_temperature);
				$('body').find('#modifierRecette').find('.recette_details').val(recette.recette_details);
			}
		});
		$('#modifierRecette').modal('show');
	});

	$('#btn_modifier_recette').click(function(){
		var id = $('#modifierRecette').find('.recette_id').val();
		var nom = $('#modifierRecette').find('.recette_nom').val();
		var duree = $('#modifierRecette').find('.recette_duree').val();
		var temperature = $('#modifierRecette').find('.recette_temperature').val();
		var details = $('#modifierRecette').find('.recette_details').val();
		var categorie = $('#modifierRecette').find('.recette_categorie').val();

		var recette = {'id':id,'nom':nom, 'image':'', 'duree':duree, 'temperature':temperature, 'categorie':categorie, 'details':details};

		if(verification(nom) && verification(duree) && verification(temperature) && verification(categorie)){
			var action = {'fonction':'modifierRecette', 'recette':recette};
			console.log(action);
			var param = $.param(action);

			$.ajax({
				'url':'<?php echo SITE_URL; ?>fonction.php',
				'type':'POST',
				'data':param,
				'dataType':'JSON',
				success:function(data){
					$('#afficherNotification').find('.modal-body').html(data);
					$('#modifierRecette').modal('hide');
					$('#afficherNotification').modal();
					setTimeout(function(){
						window.location.reload();
					}, 2000);
				}
			});
		} else {
			$('#afficherNotification').find('.modal-body').html('Des éléments incorrects sont présents dans le formulaire.');
			$('#modifierRecette').modal('hide');
			$('#afficherNotification').modal();
		}
	});
	$('#btn_ajouter_ingredient').click(function(){
		var nom = $('#ingredient_nom').val();
		if(verification(nom)){
			var ingredient = {'nom':nom, 'image':''};
			var action = {'fonction':'ajouterIngredient', 'ingredient':ingredient};
			var param = $.param(action);
			$.ajax({
				'url':'<?php echo SITE_URL; ?>fonction.php',
				'type':'POST',
				'data':param,
				'dataType':'JSON',
				success:function(data){
					$('#afficherNotification').find('.modal-body').html(data);
					$('#ajouterIngredient').modal('hide');
					$('#afficherNotification').modal();
					setTimeout(function(){
						window.location.reload();
					}, 2000);
				}
			});
		} else {
			$('#afficherNotification').find('.modal-body').html('Nom invalide.');
			$('#ajouterIngredient').modal('hide');
			$('#afficherNotification').modal();
		}
	});

	$('#btn_ajouter_categorie').click(function(){
		var nom = $('#categorie_nom').val();
		if(verification(nom)){
			var categorie = {'nom':nom, 'image':''};
			var action = {'fonction':'ajouterCategorie', 'categorie':categorie};
			var param = $.param(action);
			$.ajax({
				'url':'<?php echo SITE_URL; ?>fonction.php',
				'type':'POST',
				'data':param,
				'dataType':'JSON',
				success:function(data){
					$('#afficherNotification').find('.modal-body').html(data);
					$('#ajouterCategorie').modal('hide');
					$('#afficherNotification').modal();
					setTimeout(function(){
						window.location.reload();
					}, 2000);
				}
			});
		} else {
			$('#afficherNotification').find('.modal-body').html('Nom invalide.');
			$('#ajouterCategorie').modal('hide');
			$('#afficherNotification').modal();
		}
	});

	$('#btn_ajouter_recette').click(function(){
		var nom = $('#recette_nom').val();
		var duree = $('#recette_duree').val();
		var temperature = $('#recette_temperature').val();
		var details = $('#recette_details').val();
		var categorie = $('#recette_categorie').val();

		var recette = {'nom':nom, 'image':'', 'duree':duree, 'temperature':temperature, 'categorie':categorie, 'details':details};

		if(verification(nom) && verification(duree) && verification(temperature) && verification(categorie)){
			var action = {'fonction':'ajouterRecette', 'recette':recette};
			var param = $.param(action);

			$.ajax({
				'url':'<?php echo SITE_URL; ?>fonction.php',
				'type':'POST',
				'data':param,
				'dataType':'JSON',
				success:function(data){
					$('#afficherNotification').find('.modal-body').html(data);
					$('#ajouterRecette').modal('hide');
					$('#afficherNotification').modal();
					setTimeout(function(){
						window.location.reload();
					}, 2000);
				}
			});
		} else {
			$('#afficherNotification').find('.modal-body').html('Des éléments incorrects sont présents dans le formulaire.');
			$('#ajouterRecette').modal('hide');
			$('#afficherNotification').modal();
		}
	});

	function verification(data){
		if(data == undefined || data.trim() == ''){
			return false;
		} else {
			return true;
		}
	}
</script>