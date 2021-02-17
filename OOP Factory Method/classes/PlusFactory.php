<?php

class PlusFactory {
	private $pdo = null;
	
	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}

	public function getPDO() {return $this->pdo;}
	
	public function getCarByLicense($license) {
		$query = 'SELECT id FROM car_registrations WHERE license_plate = :lp';		
		$ps = $this->pdo->prepare($query);
		$ps->execute([
			':lp' => $license
		]);		
		$data = $ps->fetch();
		$car = new PlusCarRegistration($this, $data['id']);
		$car->refresh();
		return $car;
	}	
	
	public function getCarRegistrationById($id) {
		$registration = new PlusCarRegistration($this, $id);
		$registration->refresh();
		return $registration;
	}
	
	public function getCarRegistrationsByOwner($ownerId) {
		$query = 'SELECT * FROM car_registrations WHERE owner_id = :oid';		
		$ps = $this->pdo->prepare($query);
		$ps->execute([
			':oid' => $ownerId
		]);
		
		$cars = [];
		foreach($ps->fetchAll() as $data) {
			$registration = new PlusCarRegistration($this);
			$registration->setData($data);
			$cars[] = $registration;
		}
		
		return $cars;
	}
	
	public function getOwnerById($id) {
		$owner = new PlusOwner($this, $id);
		$owner->refresh();
		return $owner;
	}
/*	
*	public function createOwnerByName($name) {
*		$owner = new PlusOwner($this);
*		$owner->setName($name);
*		$owner->save();
*		return $owner;
*	}
*/
}