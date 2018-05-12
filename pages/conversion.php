<?php
	if(isset($_REQUEST['fonction'])){
		$nombre = $_REQUEST['nombre'];
		$masse;
		$conversion = $_REQUEST['fonction']($nombre);
	} else {
		$nombre = '';
		$conversion = '';
	}

	function toLitre($nombre){
		return $nombre * 0.001;
	}
	function toGramme($nombre){
		return $nombre * 1000;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Conversion</title>
</head>
<body>
	<h1>Masse en Volume</h1>
	<form method="post">
		<input type="number" name="nombre" value="<?php echo $nombre; ?>">
		<select name="masse">
			<option value="1">g</option>
			<option value="2">kg</option>
		</select>
		<input type="number" name="conversion" value="<?php echo $conversion; ?>" readonly>
		<select name="volume">
			<option value="1">mL</option>
			<option value="2">cL</option>
			<option value="3">L</option>
		</select>
		<button type="submit" name="fonction" value="toLitre">Valider</button>
	</form>
	<h1>Volume en Masse</h1>
	<form method="post">
		<input type="number" name="nombre" value="<?php echo $nombre; ?>">
		<select name="volume">
			<option value="1">mL</option>
			<option value="2">cL</option>
			<option value="3">L</option>
		</select>
		<input type="number" name="conversion" value="<?php echo $conversion; ?>" readonly>
		<select name="masse">
			<option value="1">g</option>
			<option value="2">kg</option>
		</select>
		<button type="submit" name="fonction" value="toGramme">Valider</button>
	</form>
</body>
</html>