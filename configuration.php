<?php
	// PASSSAGE EN FR
	setlocale(LC_TIME, 'fr','fr_FR','fr_FR@euro','fr_FR.utf8','fr-FR','fra');
	setlocale(LC_ALL, 'fr_FR');
	mb_internal_encoding("UTF-8");

	// DEFINITION DE LA DATE
	date_default_timezone_set('America/Martinique');
	$now 		= new DateTime('NOW');
	$date 		= $now->format('d/m/Y');
	$datetime 	= $now->format('Y-m-d H:i:s');

	// CONFIGURATION PHP
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	define("SITE_URL", "http://192.168.0.31/recette/") ;
	define("SITE_DIR", "C:/wampserver/www/recette/") ;

	define("MEDIA_URL", SITE_URL."media/") ;
	define("MEDIA_DIR", SITE_DIR."media/") ;
	
	// CONFIGURATION BASE DE DONNEE
	define("DB_HOST","localhost");
	define("DB_USER", "root"); 
	define("DB_PASS", "");
	define("DB_NAME", "recette");
	define("SEL_CRYPT", "*-aD55");

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	mysqli_set_charset($link,"utf8");

	session_start();
?>