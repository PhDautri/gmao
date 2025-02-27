<?php

namespace Core\Entity;

// function magique qui remonte la methode //

class Entity {

	public function __get($key){

	        $method = 'get' . ucfirst($key);

	        $this->$key = $this->$method();

	        return $this->$key;

	}
	

}