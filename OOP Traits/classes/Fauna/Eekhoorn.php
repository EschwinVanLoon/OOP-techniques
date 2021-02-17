<?php

namespace Fauna;

class Eekhoorn extends Animal {
	use KlimTrait, KnaagTrait;
	// Properties
	protected $_species = 'eekhoorn';
	
	// Normale methods
	public function nestelen(){
		echo '<p>De '.$this->_species.' bouwt een nest van twijgen en mos.</p>';
	}	
}

?>