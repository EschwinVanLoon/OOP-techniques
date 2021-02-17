<?php

namespace Fauna;

interface DierInterface {
	public function __construct();
	public function __call($method, $args);
	public function __debugInfo();
}

?>