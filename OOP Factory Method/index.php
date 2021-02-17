<?php
spl_autoload_register(function($classname) {
	// Bestandsnaam bepalen
	$filename= 'classes/'.str_replace('\\', '/', $classname).'.php';
	
	// Als het bestand bestaat laadt het in
	if(file_exists($filename)) {
		include_once $filename;
	}
});

require_once 'php/functions.php';

$pdo = makeConnection();
$factory = new PlusFactory($pdo);

if (isset($_GET['find_owner_id']) && !empty($_GET['id'])) {
	$owner = $factory->getOwnerById($_GET['id']);
	$cars = $owner->getRegisteredCars();
}
if (isset($_GET['find_car_id']) && !empty($_GET['id'])) {
	$car = $factory->getCarRegistrationById($_GET['id']);
	$owner = $car->getOwner();
}
if (isset($_GET['find_car_license']) && !empty($_GET['id'])) {
	$car = $factory->getCarByLicense($_GET['id']);
	$owner = $car->getOwner();
}

?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>t07m11o4plus</title>
		<link rel="stylesheet" href="css/opdrachten.css">
	</head>
	<body>
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
			<input type="text" name="id" placeholder="zoek op id of kenteken">
			<input type="submit" name="find_owner_id" value="toon eigenaar (id)">
			<input type="submit" name="find_car_id" value="toon auto (id)">
			<input type="submit" name="find_car_license" value="toon auto (kenteken)">
		</form>
		<?php
			if (isset($car)) {echo($car);}
			if (isset($owner)) {echo($owner);}
			if (isset($cars)) {
				foreach($cars as $car) {echo $car;}
			}
		?>
	</body>
</html>