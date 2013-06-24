<?php
/**
 * Cette classe va faire les actions suivantes : 
 * - Récupération de l'url courante
 * - Gestion des variables passées en GET
 * - Gestion des variables passées en POST
 * - Gestion des champs upload
 */
class Request{
	
	public $url;
	public $page;
	public $data = false;//Pour l'envoie des données de modif des articles
	public $err = array();
	
	/**
	 * The built in detectors used with `is()` can be modified with `addDetector()`.
	 *
	 * There are several ways to specify a detector, see CakeRequest::addDetector() for the
	 * various formats and ways to define detectors.
	 *
	 * @var array
	 */
		protected $_detectors = array(
			'get' => array('env' => 'REQUEST_METHOD', 'value' => 'GET'),
			'post' => array('env' => 'REQUEST_METHOD', 'value' => 'POST'),
			'put' => array('env' => 'REQUEST_METHOD', 'value' => 'PUT'),
			'delete' => array('env' => 'REQUEST_METHOD', 'value' => 'DELETE'),
			'head' => array('env' => 'REQUEST_METHOD', 'value' => 'HEAD'),
			'options' => array('env' => 'REQUEST_METHOD', 'value' => 'OPTIONS'),
			'ssl' => array('env' => 'HTTPS', 'value' => 1),
			'ajax' => array('env' => 'HTTP_X_REQUESTED_WITH', 'value' => 'XMLHttpRequest'),
			'flash' => array('env' => 'HTTP_USER_AGENT', 'pattern' => '/^(Shockwave|Adobe) Flash/'),
			'mobile' => array('env' => 'HTTP_USER_AGENT', 'options' => array(
				'Android', 'AvantGo', 'BlackBerry', 'DoCoMo', 'Fennec', 'iPod', 'iPhone', 'iPad',
				'J2ME', 'MIDP', 'NetFront', 'Nokia', 'Opera Mini', 'Opera Mobi', 'PalmOS', 'PalmSource',
				'portalmmm', 'Plucker', 'ReqwirelessWeb', 'SonyEricsson', 'Symbian', 'UP\\.Browser',
				'webOS', 'Windows CE', 'Windows Phone OS', 'Xiino'
			)),
			'requested' => array('param' => 'requested', 'value' => 1)
		);

	function __construct(){
		// pr($_SERVER['PATH_INFO']);
		$this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/'; //Affectation de l'url
		//Test ternaire si path_info existe alors path info sinon racine
			if(isset($_GET['page']) && is_numeric($_GET['page'])){
				$this->page = $_GET['page'];
			}else{
				$this->page = 1;
			}
			//Gestion de la variable $_POST
			if(!empty($_POST)){//Si $_POST n'est pas vide
				// $this->data = new stdClass();//Seule manière de déclarer un nouvel objet vide
				// foreach($_POST as $k=>$v){//Parcours
					// $this->data->$k=$v;//Affectation clé valeur
				// }
				
				/** François **/
				if(!$this->data) { $this->data = array(); }
				foreach($_POST as $k=>$v){
					if(!is_array($v)){ $v = stripslashes($v); } 
					$this->data[$k] = $v;
					// $this->err[$k] = $v;
				}
			}
		}
		
	/**
	 * Get the IP the client is using, or says they are using.
	 *
	 * @param boolean $safe Use safe = false when you think the user might manipulate their HTTP_CLIENT_IP
	 *   header. Setting $safe = false will will also look at HTTP_X_FORWARDED_FOR
	 * @return string The client IP.
	 */
		public function clientIp($safe = true) {
			if (!$safe && env('HTTP_X_FORWARDED_FOR')) {
				$ipaddr = preg_replace('/(?:,.*)/', '', env('HTTP_X_FORWARDED_FOR'));
			} else {
				if (env('HTTP_CLIENT_IP')) {
					$ipaddr = env('HTTP_CLIENT_IP');
				} else {
					$ipaddr = env('REMOTE_ADDR');
				}
			}

			if (env('HTTP_CLIENTADDRESS')) {
				$tmpipaddr = env('HTTP_CLIENTADDRESS');

				if (!empty($tmpipaddr)) {
					$ipaddr = preg_replace('/(?:,.*)/', '', $tmpipaddr);
				}
			}
			return trim($ipaddr);
		}
		
	/**
	 * Vérifie si une Request est d'un certain type. Uses the built in detection rules
	 * as well as additional rules defined with CakeRequest::addDetector(). Any detector can be called
	 * as `is($type)` or `is$Type()`.
	 *
	 * @param string $type The type of request you want to check.
	 * @return boolean Whether or not the request is the type you are checking.
	 */
		public function is($type) {
			$type = strtolower($type);
			if (!isset($this->_detectors[$type])) {
				return false;
			}
			$detect = $this->_detectors[$type];
			if (isset($detect['env'])) {
				if (isset($detect['value'])) {
					return env($detect['env']) == $detect['value'];
				}
				if (isset($detect['pattern'])) {
					return (bool)preg_match($detect['pattern'], env($detect['env']));
				}
				if (isset($detect['options'])) {
					$pattern = '/' . implode('|', $detect['options']) . '/i';
					return (bool)preg_match($pattern, env($detect['env']));
				}
			}
			if (isset($detect['param'])) {
				$key = $detect['param'];
				$value = $detect['value'];
				return isset($this->params[$key]) ? $this->params[$key] == $value : false;
			}
			if (isset($detect['callback']) && is_callable($detect['callback'])) {
				return call_user_func($detect['callback'], $this);
			}
			return false;
		}
}
