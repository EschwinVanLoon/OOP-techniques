<?php

namespace Fauna;

class Kat extends Animal {
	use PurrTrait, KlimTrait;
	// Properties
	protected $_species = 'kat';
	
	// Normale methods
	public function miauw(){
		echo '<p>De '.$this->_species.' miauwt zo luid dat alle buren wakker worden.</p>';
	}
}

?>