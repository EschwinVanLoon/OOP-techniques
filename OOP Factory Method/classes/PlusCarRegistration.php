<?php

class PlusCarRegistration {
	private $factory = null;
	private $id = 0;
	private $ownerId = 0;
	private $licensePlate = '';
	private $registrationDate = '';
	private $model = '';
	private $manufacturer = '';
	private $color = '';
	
	public function __construct(PlusFactory $factory, int $id = 0) {
		$this->factory = $factory;
		$this->id = $id;
		$this->refresh();
	}
	
	public function __toString() {
		$html = "<h2>Car Registration #{$this->id} - {$this->licensePlate}</h2>";
		$html .= "<h3>({$this->manufacturer} {$this->model}, {$this->color})</h3>";
		return $html;
	}
	
//	public function getId():int {return $this->id;}

//	public function getName():string {return $this->name;}

	public function getPDO():PDO {return $this->factory->getPDO();}
	
	public function getOwner():PlusOwner {
		return $this->factory->getOwnerById($this->ownerId);
	}

	public function setData(array $data = []) {
		$this->id = $data['id'];
		$this->ownerId = $data['owner_id'];
		$this->licensePlate = $data['license_plate'];
		$this->registrationDate = $data['registration_date'];
		$this->model = $data['model'];
		$this->manufacturer = $data['manufacturer'];
		$this->color = $data['color'];
	}
	
	public function refresh() {
		$query = 'SELECT * FROM car_registrations WHERE id = :id';
		$ps = $this->getPDO()->prepare($query);
		$ps->execute([
			':id' => $this->id
		]);
		$data = $ps->fetch();
		if ($data) {
			$this->setData($data);
			return true;
		} else {
			$this->id = 0;
			return false;
		}
	}	
/*	
*	public function save() {
*		if ($this->id > 0) {
*			// Wel een id.
*			$query = 'UPDATE owners SET name = :name WHERE id = :id';
*			$ps = $this->getPDO()->prepare($query);
*			$ps->execute([
*				':name' => $this->name,
*				':id' => $this->id
*			]);
*		} else {
*			// Geen id?
*			$query = 'INSERT INTO owners (name) VALUES (:name)';
*			$ps = $this->getPDO()->prepare($query);
*			$ps->execute([
*				':name' => $this->name
*			]);
*			$this->id = $this->getPDO()->lastInsertId();
*		}
*	}
*/
}