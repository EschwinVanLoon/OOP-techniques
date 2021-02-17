<?php

namespace Fauna;

class Cavia extends Animal {
	use PurrTrait, KnaagTrait;
	// Properties
	protected $_species = 'cavia';
	
	// Normale methods
	public function popcorn(){
		echo '<p>De '.$this->_species.' springt vrolijk in de lucht.</p>';
	}
}

?>