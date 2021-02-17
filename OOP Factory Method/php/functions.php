<?php
/*
 *  Instellingen voor het maken van een verbinding met de database
 *  server kunnen het beste in een apart bestand (bijv. settings.php)
 *  ondergebracht worden.
 */
require_once 'settings.php';

/*
 *	In deze functie wordt een connectie gelegd met de database.
 *	De actieve databaseverbinding wordt vervolgens geretourneerd.
 */
function makeConnection() {
	static $pdo = false;
	if ($pdo) {return $pdo;}
	
	// Verbinding maken met de database
	$host     = DB_HOST;
	$dbName   = DB_NAME;
	$user     = DB_USER;
	$password = DB_PASS;
	$charset  = 'utf8mb4';

	// Hulpvariabelen voor het verbinden
	$dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];

	// Maak een nieuwe database verbinding aan
	$pdo = new PDO($dsn, $user, $password, $options);
	$pdo->exec("SET sql_mode='traditional';");
	
	return $pdo;
}