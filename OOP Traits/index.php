<?php

spl_autoload_register(function($classname) {
	// Bestandsnaam bepalen
	$filename= 'classes/'.str_replace('\\', '/', $classname).'.php';
	// Probeer het bestand in te laden
	if(file_exists($filename)) {
		include_once$filename;
	}
});
	
$cavia = new Fauna\Cavia();
$cavia->popcorn();
$cavia->klim();
echo '<hr>';
$kat = new Fauna\Kat();
$kat->purr();
$kat->miauw();
echo '<hr>';
$eekhoorn = new Fauna\Eekhoorn();
$eekhoorn->klim();
$eekhoorn->knaag();

?>