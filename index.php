<?php
	require 'fonction.php';

	$page = 'pages/recette.php';

	if(isset($_REQUEST['categorie'])){
		$categorie = $_REQUEST['categorie'];
	} else if(isset($_REQUEST['setting'])){
		$page = 'pages/admin.php';
	}

	$lesCategories = getCategories($link);
	// var_dump($lesCategories);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Les recettes</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/ico" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>style.css">
	<link href="<?php echo SITE_URL; ?>bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo SITE_URL; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo SITE_URL; ?>bootstrap/dist/css/bootstrap-reboot.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo SITE_URL; ?>bootstrap/dist/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo SITE_URL; ?>bootstrap/dist/css/bootstrap-grid.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo SITE_URL; ?>bootstrap/dist/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<style type="text/css">
		:root{
			--normal: rgba(33, 38, 47, 1);
			--dark: rgba(87, 100, 80, 1);
			--light: rgba(175, 192, 86, 1);
			--white: rgba(228, 239, 187, 1);
			--transparent: rgba(175, 192, 86, 0.5);
			--darktransparent: rgba(87, 100, 80, 0.5);
			--blankpage: rgba(225, 216, 199, 0.75);
		}

		@font-face{
			font-family: "Corps";
			src:url('<?php echo SITE_URL; ?>fonts/Courgette.ttf');
		}
		@font-face{
			font-family: "Titre";
			src:url('<?php echo SITE_URL; ?>fonts/DancingScript.ttf');
		}

		body{
			background-image: url('wallpaper-zen.jpg');
			background-size: cover;
			background-repeat: no-repeat;
			background-color: var(--dark);
			color: var(--normal);
			font-family: "Corps";
			font-size: 17px;
		}

		h1, h2, h3 {
			color: var(--light);
			font-family: "Titre";
			text-align: center!important;
			text-shadow: 0px 1px 1px black;
		}

		h4, h5, h6 {
			color: var(--dark);
			font-family: "Sous-titre";
			text-align: center;
			text-shadow: 0px 1px 1px black;
		}
	</style>
	<nav class="navbar navbar-expand-lg">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuRecette" aria-controls="menuRecette" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="menuRecette">
			<ul>
			<?php foreach ($lesCategories as $categorie) { $nom = getRename($categorie['categorie_nom']); ?>
				<a href="<?php echo SITE_URL.'recettes-'.$nom; ?>"><li><?php echo $categorie['categorie_nom']; ?></li></a>
			<?php } ?>
			<a href="<?php echo SITE_URL; ?>setting"><li>Paramètre</li></a>
			</ul>
		</div>
	</nav>

	<div class="modal fade" id="afficherNotification" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Notification</h3>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	
<script type="text/javascript" src="<?php echo SITE_URL; ?>jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="<?php echo SITE_URL; ?>bootstrap/dist/js/bootstrap.js"></script>
<script src="<?php echo SITE_URL; ?>bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript"></script>

<div class="container-fluid">
	<div class="row">
		<?php require $page; ?>
	</div>
</div>
</body>
</html>