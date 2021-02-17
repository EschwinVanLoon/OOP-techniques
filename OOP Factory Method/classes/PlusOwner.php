<?php

class PlusOwner {
	private $factory = null;
	private $id = 0;
	private $name = '';
	
	public function __construct(PlusFactory $factory, int $id = 0) {
		$this->factory = $factory;
		$this->id = $id;
		$this->refresh();
	}
	
	public function __toString() {
		$html = "<h2>Owner #{$this->id} - {$this->name}</h2>";
		return $html;
	}
	
//	public function getId():int {return $this->id;}

	public function getPDO():PDO {return $this->factory->getPDO();}
	
//	public function getName():string {return $this->name;}

	public function setName(string $name) {
		$this->name = $name;
	}
	
	public function getRegisteredCars() {
		return $this->factory->getCarRegistrationsByOwner($this->id);
	}	
	
	public function setData(array $data) {
		$this->id = $data['id'];
		$this->name = $data['name'];
	}
	
	public function refresh(array $data = []) {
		$query = 'SELECT * FROM owners WHERE id = :id';
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