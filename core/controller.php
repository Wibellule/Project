<?php
class Controller{
	
	public $request;
	public $layout = 'default';
	
	private $vars = array();
	private $rendered = false;
	
	var $helpers = array(
		'Form','Html'
	);
	
	var $components = array(
		'RequestHandler'
	);
	
	/**
	* Constructeur de la classe Controller
	* @param object $request
	* @access public
	*/
	function __construct($request = null){
		if($request) {$this->request = $request; include CORE.DS.'is_logged.php';}
		
		//Chargement des Helpers
		foreach($this->helpers as $k=>$v){
			$file_name = HELPERS.DS.Inflector::underscore($v).'.php';
			require_once $file_name;
			$helper = new $v($this);
			unset ($this->helpers[$k]);
			$this->helpers[$v] = $helper;
		}
		
		//Chargement des composants
		foreach($this->components as $k => $v) {
		
			$component = strtolower($v); //Nom du fichier
			require_once COMPONENTS.DS.$component.'.php'; //Inclusion du fichier
			unset($this->components[$k]); //On supprime de la variable
			$this->components[$v] = new $v($this); //Et on insère l'objet
		}
		
		// pr($this->components);
	}
	
	/**
	* Permet de rendre une vue
	* @param varchar $view fichier à rendre (chemin depuis view ou nom de la vue)
	* @access public
	*/
	public function render($view){
		// pr($this->request);
		extract($this->vars);//Converti les données du tableau en variables | extrait des variables de $vars pour les envoyer dans la view, obligatoire pour envoyer les variables à la vue
		
		//Pas de rendu par défaut, donc test si la vue a déjà été rendu
		if(strpos($view, '/') === 0){/*Vérifie que le premier caractère de la chaine est un slash*/
			//Rendu d'une vue qui ne se trouve pas dans le dossier du controller
			$view = ROOT.DS.'views'.$view.'.php';
		}else{
			//Sinon comportement par défaut
			$view = ROOT.DS.'views'.DS.$this->request->controller.DS.$view.'.php';
		}
		
		ob_start();//Début du buffer
		
		//Inclut la vue dans la page
		require($view);
		$content_for_layout = ob_get_clean();//Renvois le contenu du buffer dans une variable
		// $this->layout = 'modal';
		
		if(isset($this->request->prefix) && $this->request->prefix == 'backoffice'){
			$this->layout = 'backoffice';
			// pr($this->layout);
		}
		
		require ROOT.DS.'views'.DS.'layout'.DS.$this->layout.'.php';
		
		$this->rendered = true;//Rendu à vrai quand ok
		// pr($this->layout);
	}
	
	/**
	* Cette fonction permet l'affichage des erreurs 404
	* @param varchar $message
	* @access public
	*/
	public function e404($message){
		header("HTTP/1.0 404 Not Found");//Header 404 pour le navigateur
		$this->set('message',$message);//On envoi le message
		$this->render('/errors/404');//On fait le rendu à la vue
		die();
	}
	
	/**
	* Permet de passer une ou plusieurs variables à la vue en insérant les valeurs dans le tableau vars puis est envoyé grace à render.
	* @param mixed (array ou varchar) $key nom de la variable OU Tableau de variables, on préfèrera le tableau
	* @param varchar $value Valeur de la variable, peut être à null
	* @access public
	*/
	public function set($key, $value = null){
		if(is_array($key)) {$this->vars += $key;}
		else{$this->vars[$key] = $value;}//amélioration possible if isset $value
	}
	
	/**
	* Permet de charger un model
	* @param varchar $name nom du model
	* @access public
	*/
	public function loadModel($modelName){
		$file = ROOT.DS.'models'.DS.lcfirst($modelName).'.php';
		require_once($file);
		//Test si le model existe et évite de charger plusieurs fois le model
		if(!isset($this->$modelName)){ $this->$modelName = new $modelName();}
		// pr($this->$modelName);
	}
	
	public function loadEvent($modelName){
		// $event = new Event($this->request->controller.'.'.$this->request->action, $this);
		// return $event;
		//Chargement des évenements
		$event = ROOT.DS.'events'.DS.lcfirst($modelName).'s_event.php';
		if(file_exists($event)){
			require_once($event);
			$eventName = $modelName.'sEventListener';
			if(!isset($this->$eventName)){ $this->$eventName = new $eventName();}
		}
	}
	
	/**
	* Fonction requestAction qui peut utiliser une methode d'un controller depuis une vue
	* @param $controller
	* @param $action
	* @param $param mixed
	*/
	public function requestAction($controller,$action,$param = null){
		//Nom du controller
		$name = ucfirst($controller).'Controller';
		//Chemin du fichier à charger
		$file = ROOT.DS.'controllers'.DS.$controller.'_controller.php';
		//Vérification de l'existence du controleur
		if(!file_exists($file)){ $this->error("Le controleur ".$controller." n'existe pas");}
		//inclusion du fichier
		require_once $file;// !!!! important require_once !!!!
		//Affectation d'un nouvel objet dans une variable
		$variable = new $name();
		$modelName = ucfirst(substr($controller,0,-1));
		$variable->loadModel($modelName);
		//Appel de la méthode sur le controller
		return $variable->$action($param);
	}
	
	/**
	* Fonction redirect redirige une url erronée vers la bonne url
	* @url varchar url envoyé
	* @code integer code des status http
	*/
	function redirect($url,$code = 301){
	
		if($code == 301){
			header("HTTP/1.0 301 Moved Permanently");
		}
		header("Location: ".Router::url($url));//On fait la redirection
		die();//Pour éviter que les fonctions continues
	}
	
	/**
	* Fonction qui permet d'inclure un élement html au sein d'une vue, d'un layout etc ...
	* @chemin varchar chemin vers l'élement html
	* @version 0.1 - 05/06/13
	* @version 0.2 - 10/06/13
	* @todo gérer directement l'accès aux élements - 06/05/13
	*/
	function element($chemin, $vars = null){
		if(isset($vars) && !empty($vars)) { 
    		
    		foreach($vars as $k => $v) { $this->vars[$k] = $v; } 
    	}    	
		extract($this->vars);//Passe les variables à la vue
		// pr($this->vars);
		include($chemin);//Fait l'inclusion du fichier
	}
}

















?>