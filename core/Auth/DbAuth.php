<?php

namespace Core\Auth;

use Core\Database\Database;


class DbAuth {


	private $db;

	public function __construct(Database $db){

		$this->db = $db;

	}


	public function getUserId(){

		if ($this->logged()){

			return $_SESSION['auth'];
		}

		return false;

	}

	// retourne le nom de la base //

	public function namebase(){

		return $this->db->query("SELECT DATABASE() AS namebase");
	}	

	/**

	* @param $username

	* @param $password

	* @return boolean

	*/

	public function login($username, $password){

		$user = $this->db->prepare('SELECT u.id, u.username, CONCAT(u.last_name, "-" ,u.first_name) AS name, u.type, u.password, u.u_phone, u.u_etat, u.niveau 
									FROM users u 
									WHERE username = ?', [$username], null, true
									);

		if ($user === false) {

			$user = "Inconnu";

			return $user;

		} else if($user->u_etat === 'Actif'){			

			if(password_verify($password,$user->password)){

				$_SESSION['auth'] = $user->id;
				$_SESSION['username'] = $user->username;
				$_SESSION['name'] = $user->name;
				$_SESSION['type'] = $user->type;
				$_SESSION['phone'] = $user->u_phone;
				$_SESSION['etat'] = $user->u_etat;
				$_SESSION['niveau'] = $user->niveau;

				return true;

			} else {

				return false;
			}


		} else if ($user->u_etat === 'Inactif') {

			$user = "Inactif";

			return $user;			
		}				

	}

	// function logged //

	public function logged(){

		return isset($_SESSION['auth']);

	}

}