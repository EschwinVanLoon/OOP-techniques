<?php

namespace Fauna;

abstract class Animal implements DierInterface {
	protected $_species = '';
	
	public function __construct(){
		if (file_exists('images/'.$this->_species.'.jpg')){
			echo '<img src="images/'.$this->_species.'.jpg" alt="'.$this->_species.'" title="'.$this->_species.'">';
		} else {
			echo '<p>no picture</p>';
			var_dump($this->_species);
		}			
	}
	public function __call($method, $args){
		echo '<p>De '.$this->_species.' kan de handeling "'.$method.'" niet uitvoeren.</p>';
	}
	public function __debugInfo(){
		echo '<p>Een '.$this->_species.' beschikt over de volgende handelingen:</p>';
		echo '<ul>';
		foreach (get_class_methods($this) as $value){
			echo '<li>'.$value.'</li>';
		}
		echo '</ul>';
	}
}

?>