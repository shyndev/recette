<?php
	require 'configuration.php';
	
	if(isset($_REQUEST['fonction'])){
		$response = $_REQUEST['fonction']($link);
		$typeofResponse = gettype($response);

		if($typeofResponse == 'string'){
			if(trim($response) != '' && $response != null) { echo json_encode($response); }
		} else if($typeofResponse == 'array'){
			if($response != null && count($response) > 0) { echo json_encode($response); }
		}
	}

	function getRecettesParCategorie($link, $categorie = null){
		if($categorie == null && isset($_REQUEST['categorie'])){
			$categorie = $_REQUEST['categorie'];
		}

		$categorie = str_replace('-', ' ', $_REQUEST['categorie']);

		$sql = "SELECT * FROM categorie WHERE categorie_nom LIKE '%$categorie%'";
		$requete = mysqli_query($link, $sql) or die(mysqli_error($link));
		$row = mysqli_fetch_assoc($requete);
		$categorie_id = $row['categorie_id'];

		$sql = "SELECT * FROM recette WHERE recette_categorie = ".$categorie_id;
		$requete = mysqli_query($link, $sql) or die(mysqli_error($link));

		$lesRecettes = array();
		while($row = mysqli_fetch_assoc($requete)){
			array_push($lesRecettes, $row);
		}

		return $lesRecettes;
	}

	function getRecetteParId($link, $recette_id = null){
		if($recette_id == null && isset($_REQUEST['recette_id'])){
			$recette_id = $_REQUEST['recette_id'];
		}

		$sql = "SELECT * FROM recette WHERE recette_id = ".$recette_id;
		$requete = mysqli_query($link, $sql) or die(mysqli_error($link));

		$recette = mysqli_fetch_assoc($requete);
		$recette['ingredients'] = getIngredientsParRecette($link, $recette_id);

		return $recette;
	}

	function getRecettes($link){
		$sql = "SELECT * FROM recette";
		$requete = mysqli_query($link, $sql);
		$lesRecettes = array();

		while($row = mysqli_fetch_assoc($requete)){
			array_push($lesRecettes, $row);
		}

		return $lesRecettes;
	}

	function getIngredientsParRecette($link, $recette_id = null){
		if($recette_id == null && isset($_REQUEST['recette_id'])){
			$recette_id = $_REQUEST['recette_id'];
		}

		$lesIngredients = array();

		$sql = "SELECT * FROM rel_recette_ingredient rri, ingredient i WHERE rri.recette_id = $recette_id AND  rri.ingredient_id = i.ingredient_id";
		$requete = mysqli_query($link, $sql) or die(mysqli_error($link));

		while($row = mysqli_fetch_assoc($requete)){
			array_push($lesIngredients, $row);
		}

		return $lesIngredients;
	}

	function getIngredients($link){
		$sql = "SELECT * FROM ingredient";
		$requete = mysqli_query($link, $sql);
		$lesIngredients = array();

		while($row = mysqli_fetch_assoc($requete)){
			array_push($lesIngredients, $row);
		}

		return $lesIngredients;
	}

	function getCategories($link){
		$sql = "SELECT * FROM categorie";
		$requete = mysqli_query($link, $sql);
		$lesCategories = array();

		while($row = mysqli_fetch_assoc($requete)){
			array_push($lesCategories, $row);
		}

		return $lesCategories;
	}

	function ajouterRecette($link){
		$recette = $_REQUEST['recette'];

		$nom = $recette['nom'];
		$duree = $recette['duree'];
		$temperature = $recette['temperature'];
		$image = $recette['image'];
		$categorie = $recette['categorie'];

		if(isset($_REQUEST['recette']['details'])){
			$details = mysqli_escape_string($link, $recette['details']);
		} else {
			$details = '';
		}

		$sql = "INSERT INTO recette VALUES(null, '$nom', $duree, $temperature, '$image', $categorie, '$details')";
		$requete = mysqli_query($link, $sql);

		if($requete){
			$response = 'Succès : Recette ajoutée !';
		} else {
			$response = 'Erreur : '.mysqli_error($link);
		}

		echo json_encode($response);
	}

	function ajouterIngredient($link){
		$ingredient = $_REQUEST['ingredient'];

		$nom = $ingredient['nom'];
		$image = $ingredient['image'];

		$sql = "INSERT INTO ingredient VALUES(null, '$nom', '$image')";
		$requete = mysqli_query($link, $sql);

		if($requete){
			$response = 'Succès : Ingrédient ajouté !';
		} else {
			$response = 'Erreur : '.mysqli_error($link);
		}

		echo json_encode($response);
	}

	function ajouterCategorie($link){
		$categorie = $_REQUEST['categorie'];

		$nom = $categorie['nom'];
		$image = $categorie['image'];

		$sql = "INSERT INTO categorie VALUES(null, '$nom', '$image')";
		$requete = mysqli_query($link, $sql);

		if($requete){
			$response = 'Succès : Catégorie ajoutée !';
		} else {
			$response = 'Erreur : '.mysqli_error($link);
		}

		echo json_encode($response);
	}

	function ajouterIngredientsRecette($link, $recette_id = null){
		if(isset($recette_id) && $recette_id == null){
			$recette_id = $_REQUEST['recette_id'];
		}

		var_dump($recette_id);

		
	}

	function modifierRecette($link){
		$recette = $_REQUEST['recette'];

		$nom = $recette['nom'];
		$duree = $recette['duree'];
		$temperature = $recette['temperature'];
		// $image = $recette['image'];
		// , recette_image = '$image'
		$categorie = $recette['categorie'];

		if(isset($_REQUEST['recette']['details'])){
			$details = mysqli_escape_string($link, $recette['details']);
		} else {
			$details = '';
		}

		$sql = "UPDATE recette SET recette_nom = '$nom', recette_duree = $duree, recette_temperature = $temperature, recette_categorie = $categorie, recette_details = '$details'";
		$requete = mysqli_query($link, $sql);

		if($requete){
			$response = 'Succès : Recette modifiée !';
		} else {
			$response = 'Erreur : '.mysqli_error($link);
		}

		echo json_encode($response);
	}

	function modifierIngredient($link){
		$ingredient = $_REQUEST['ingredient'];

		$nom = $ingredient['nom'];
		$image = $ingredient['image'];

		$sql = "UPDATE ingredient SET ingredient_nom = '$nom', ingredient_image = '$image'";
		$requete = mysqli_query($link, $sql);

		if($requete){
			$response = 'Succès : Ingrédient modifié !';
		} else {
			$response = 'Erreur : '.mysqli_error($link);
		}

		echo json_encode($response);
	}

	function modifierCategorie($link){
		$categorie = $_REQUEST['categorie'];

		$nom = $categorie['nom'];
		$image = $categorie['image'];

		$sql = "UPDATE categorie SET categorie_nom = '$nom', categorie_image = '$image'";
		$requete = mysqli_query($link, $sql);

		if($requete){
			$response = 'Succès : Catégorie modifiée !';
		} else {
			$response = 'Erreur : '.mysqli_error($link);
		}

		echo json_encode($response);
	}

	function supprimerRecette($link){
		$recette_id = $_REQUEST['recette'];
		$sql = "DELETE FROM recette WHERE recette_id = $recette_id";
		$requete = mysqli_query($link, $sql);

		if($requete){
			$response = 'Succès : Recette supprimée !';
		} else {
			$response = 'Erreur : '.mysqli_error($link);
		}

		echo json_encode($response);
	}

	function supprimerIngredient($link){
		$ingredient_id = $_REQUEST['ingredient'];
		$sql = "DELETE FROM ingredient WHERE ingredient_id = $ingredient_id";
		$requete = mysqli_query($link, $sql);

		if($requete){
			$response = 'Succès : Ingrédient supprimé !';
		} else {
			$response = 'Erreur : '.mysqli_error($link);
		}

		echo json_encode($response);
	}

	function supprimerCategorie($link){
		$categorie_id = $_REQUEST['categorie'];
		$sql = "DELETE FROM categorie WHERE categorie_id = $categorie_id";
		$requete = mysqli_query($link, $sql);

		if($requete){
			$response = 'Succès : Catégorie supprimée !';
		} else {
			$response = 'Erreur : '.mysqli_error($link);
		}

		echo json_encode($response);
	}

	function getRename($nom){
		$nom = preg_replace('#Ç#', 'C', $nom);
		$nom = preg_replace('#ç#', 'c', $nom);
		$nom = preg_replace('#è|é|ê|ë#', 'e', $nom);
		$nom = preg_replace('#È|É|Ê|Ë#', 'E', $nom);
		$nom = preg_replace('#à|á|â|ã|ä|å#', 'a', $nom);
		$nom = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $nom);
		$nom = preg_replace('#ì|í|î|ï#', 'i', $nom);
		$nom = preg_replace('#Ì|Í|Î|Ï#', 'I', $nom);
		$nom = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $nom);
		$nom = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $nom);
		$nom = preg_replace('#ù|ú|û|ü#', 'u', $nom);
		$nom = preg_replace('#Ù|Ú|Û|Ü#', 'U', $nom);
		$nom = preg_replace('#ý|ÿ#', 'y', $nom);
		$nom = preg_replace('#Ý#', 'Y', $nom);
		
		$nom = strtolower($nom);
		$nom = str_replace(' ', '-', $nom);
		return $nom;
	}
?>