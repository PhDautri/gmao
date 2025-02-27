<?php

namespace Core\Controller;

class Controller{


	protected $viewPath;

	protected $template;


	protected function render($view, $variables = []){

		ob_start();

		extract($variables);

		if ($view == "users.login") {

			require($this->viewPath . str_replace('.', '/', $view) . '.php');
		
			$content = ob_get_clean();

			require($this->viewPath . 'templates/defaultLogin.php');
			
		} else {
		
			require($this->viewPath . str_replace('.', '/', $view) . '.php');
			
			$content = ob_get_clean();

			require($this->viewPath . 'templates/' . $this->template . '.php');

		}
	}	

	protected function forbidden(){

        header('HTTP/1.0 403 Forbidden');

        die('Acces Interdit');

    }


    protected function notFound(){

        header('HTTP/1.0 404 Not Found');

        die('Page Introuvable');
    }

}