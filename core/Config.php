<?php

namespace Core;


class Config {

	private $settings = [];

	private static $_instance;

	// fonction qui instancie l'instance //

	public static function getInstance($file){

		if(is_null(self::$_instance)){

			self::$_instance = new Config($file);
		}

		return self::$_instance;

	}
		// constructeur singleton //

	public function __construct($file){

		$this->settings = require($file);
	}

	// fonction get return la clé //

	public function get($key){

		if (!isset($this->settings[$key])) {

			return null;
			
		}

		return $this->settings[$key];

	}

}
