<?php
/**
 * Cette classe est chargée d'effectuer les opérations suivantes : 
 * - Instancier un objet de type Request qui va récupérer l'url
 * - Parser cette url via l'objet Router
 * - Charger le controller souhaité
 */
class Dispatcher implements EventListener{

	/**
	 * Variable contenant la request
	 */
		var $request;
	
	/**
	 * Event manager, used to handle dispatcher filters
	 *
	 * @var EventManager
	 */
		protected $_eventManager;
	
	public function implementedEvents(){
 			return array('Dispatcher.beforeDispatch' => 'parseParams');
	}

	/**
	* Fonction principale du dispatcher
	* Charge le controller en fonction du routing
	*/
	function __construct(){
		
		//On créer l'objet Request que l'on affecte à $this->request
		$this->request = new Request();
		$event = new Event('Dispatcher.afterRequest',$this);
		//On parse l'url via l'objet Router
		Router::parse($this->request->url, $this->request);//appel static modifie l'objet request sans créer d'objet intermédiaire
		// pr($this->request);
		// pr($this->loadEvent());
		// pr($this->request->clientIp(true));
		// die();
		
		EventManager::instance();
		
		// $event = $this->loadEvent();
		
		//Ajout de la fonction qui va charger les controleurs
		$controller = $this->loadController();
		
		//On va tester si il y a un prefixe
		$action = $this->request->action;
		if(isset($this->request->prefix)){
			$action = $this->request->prefix.'_'.$action;
		}
		
		// pr($this);
		
		//Test que request->action soit bien dans les methodes sinon on appel errors
		if(	!in_array(
				$action, 
				array_diff(//fait la différence entre deux tableau pour faire ressortir seulement la fct view du controller 
						   //et empecher l'acces aux methode de la classe parente
					get_class_methods($controller), //controleur de l'url qui est demandé (instance objet) + large
					get_class_methods('Controller')//controleur principal (chaine) + restreint
				)
			)
		){	$this->error("Le controleur ".$this->request->controller." n'a pas de méthode ".$action); }//Message d'erreur
		
		//Nous allons faire un appel dynamique à une fonction se trouvant dans le controleur (faire appel à la fct index dans page par exemple)
		call_user_func_array(array($controller/*CONTROLLER*/,$action/*ACTION*/),$this->request->params/*PARAMS*/);
		
		//Creation automatique de la vue, avec l'objet Controller $controller
		$controller->render($action);
		
		// print_r(get_class_methods($controller));
		// print_r(array_diff(get_class_methods($controller), get_class_methods('Controller')));
		
	}
	
	/**
	* Fonction qui génére une page d'erreur en cas de problème au niveau du routing
	* @param varchar $message
	*/	
	function error($message){
		header("HTTP/1.0 404 Not Found");
		//On recrée un controleur
		$controller = new Controller($this->request);
		$controller->set('message',$message);
		$controller->render('/errors/404');
		die();
	}
	
	/**
	* Fonction qui permet de charger le controller en fonction de la requete utilisateur
	* @return object nouvelle instance du type $nameController($this->request)
	*/
	function loadController(){
	
		//Nous allons récupérer le controleur directement depuis ma variable request
		//Nom du controller
		$name = ucfirst($this->request->controller).'Controller';
		//Chemin du fichier à charger
		$file = ROOT.DS.'controllers'.DS.$this->request->controller.'_controller.php';
		//Vérification de l'existence du controleur
		if(!file_exists($file)){
			$this->error("Le controleur ".$this->request->controller." n'existe pas");
		}
		// pr($file);
		//inclusion du fichier
		require $file;
		$controller = new $name($this->request);
		$modelName = ucfirst(substr($this->request->controller,0,-1));

		$controller->loadModel($modelName);
		
		//Ajout de la variable du nom du model dans la request
		$controller->request->modelName = $modelName;
		
		// pr($this->loadEvent());
		
		// $controller->Form = new Form();
		//Retourne un nouvel objet de type $names
		return $controller;
	}
	
	// function loadEvent(){
		// $event = new Event($this->request->controller.'.'.$this->request->action, $this);
		// return $event;
	// }
	
	/**
	 * Returns the EventManager instance or creates one if none was
	 * created. Attaches the default listeners and filters
	 *
	 * @return EventManager
	 */
		public function getEventManager() {
			if (!$this->_eventManager) {
				$this->_eventManager = new EventManager();
				$this->_eventManager->attach($this);
				// $this->_attachFilters($this->_eventManager);
			}
			return $this->_eventManager;
		}

	
}	

