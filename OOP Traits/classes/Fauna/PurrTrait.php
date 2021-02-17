<?php

namespace Fauna;

trait PurrTrait {
	public function purr(){
		echo '<p>De '.$this->_species.' purrt omdat hij lekker geaaid wordt.</p>';
	}
}

?>