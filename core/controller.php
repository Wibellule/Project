<?php
class Controller{
	
	public $request;
	public $layout = 'default';
	
	private $vars = array();
	private $rendered = false;
	
	var $helpers = array(
		'Form','Html'
	);
	
	/**
	* Constructeur de la classe Controller
	* @param object $request
	* @access public
	*/
	function __construct($request = null){
		if($request) {$this->request = $request; include CORE.DS.'is_logged.php';}
		foreach($this->helpers as $k=>$v){
			$file_name = HELPERS.DS.Inflector::underscore($v).'.php';
			require_once $file_name;
			$helper = new $v($this);
			unset ($this->helpers[$k]);
			$this->helpers[$v] = $helper;
		}
		
	}
	
	/**
	* Permet de rendre une vue
	* @param varchar $view fichier � rendre (chemin depuis view ou nom de la vue)
	* @access public
	*/
	public function render($view){
		// pr($this->request);
		extract($this->vars);//Converti les donn�es du tableau en variables | extrait des variables de $vars pour les envoyer dans la view, obligatoire pour envoyer les variables � la vue
		
		//Pas de rendu par d�faut, donc test si la vue a d�j� �t� rendu
		if(strpos($view, '/') === 0){/*V�rifie que le premier caract�re de la chaine est un slash*/
			//Rendu d'une vue qui ne se trouve pas dans le dossier du controller
			$view = ROOT.DS.'views'.$view.'.php';
		}else{
			//Sinon comportement par d�faut
			$view = ROOT.DS.'views'.DS.$this->request->controller.DS.$view.'.php';
		}
		
		ob_start();//D�but du buffer
		
		//Inclut la vue dans la page
		require($view);
		$content_for_layout = ob_get_clean();//Renvois le contenu du buffer dans une variable
		// $this->layout = 'modal';
		
		if(isset($this->request->prefix) && $this->request->prefix == 'backoffice'){
			$this->layout = 'backoffice';
			// pr($this->layout);
		}
		
		require ROOT.DS.'views'.DS.'layout'.DS.$this->layout.'.php';
		
		$this->rendered = true;//Rendu � vrai quand ok
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
		$this->render('/errors/404');//On fait le rendu � la vue
		die();
	}
	
	/**
	* Permet de passer une ou plusieurs variables � la vue en ins�rant les valeurs dans le tableau vars puis est envoy� grace � render.
	* @param mixed (array ou varchar) $key nom de la variable OU Tableau de variables, on pr�f�rera le tableau
	* @param varchar $value Valeur de la variable, peut �tre � null
	* @access public
	*/
	public function set($key, $value = null){
		if(is_array($key)) {$this->vars += $key;}
		else{$this->vars[$key] = $value;}//am�lioration possible if isset $value
	}
	
	/**
	* Permet de charger un model
	* @param varchar $name nom du model
	* @access public
	*/
	public function loadModel($modelName){
		$file = ROOT.DS.'models'.DS.lcfirst($modelName).'.php';
		require_once($file);
		//Test si le model existe et �vite de charger plusieurs fois le model
		if(!isset($this->$modelName)){ $this->$modelName = new $modelName();}
		// pr($this->$modelName);
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
		//Chemin du fichier � charger
		$file = ROOT.DS.'controllers'.DS.$controller.'_controller.php';
		//V�rification de l'existence du controleur
		if(!file_exists($file)){ $this->error("Le controleur ".$controller." n'existe pas");}
		//inclusion du fichier
		require_once $file;// !!!! important require_once !!!!
		//Affectation d'un nouvel objet dans une variable
		$variable = new $name();
		$modelName = ucfirst(substr($controller,0,-1));
		$variable->loadModel($modelName);
		//Appel de la m�thode sur le controller
		return $variable->$action($param);
	}
	
	/**
	* Fonction redirect redirige une url erron�e vers la bonne url
	* @url varchar url envoy�
	* @code integer code des status http
	*/
	function redirect($url,$code = 301){
	
		if($code == 301){
			header("HTTP/1.0 301 Moved Permanently");
		}
		header("Location: ".Router::url($url));//On fait la redirection
		die();//Pour �viter que les fonctions continues
	}
	
	/**
	* Fonction qui permet d'inclure un �lement html au sein d'une vue, d'un layout etc ...
	* @chemin varchar chemin vers l'�lement html
	* @version 0.1 - 05/06/13
	* @version 0.2 - 10/06/13
	* @todo g�rer directement l'acc�s aux �lements - 06/05/13
	*/
	function element($chemin, $vars = null){
		if(isset($vars) && !empty($vars)) { 
    		
    		foreach($vars as $k => $v) { $this->vars[$k] = $v; } 
    	}    	
		extract($this->vars);//Passe les variables � la vue
		// pr($this->vars);
		include($chemin);//Fait l'inclusion du fichier
	}
}

















?>