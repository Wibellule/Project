<?php

class RequestHandler {
	/**
	 * The layout that will be switched to for Ajax requests
	 *
	 * @var string
	 * @see RequestHandler::setAjax()
	 */
		public $ajaxLayout = 'ajax';

	/**
	 * Determines whether or not callbacks will be fired on this component
	 *
	 * @var boolean
	 */
		public $enabled = true;

	/**
	 * Holds the reference to Controller::$request
	 *
	 * @var Request
	 */
		public $request;

	/**
	 * Holds the reference to Controller::$response
	 *
	 * @var Response
	 */
		public $response;
		
		
	/**
	 * Constructor. Parses the accepted content types accepted by the client using HTTP_ACCEPT
	 *
	 * @param ComponentCollection $collection ComponentCollection object.
	 * @param array $settings Array of settings.
	 */
		// public function __construct(ComponentCollection $collection, $settings = array()) {
			// parent::__construct($collection, $settings + array('checkHttpCache' => true));
			// $this->addInputType('xml', array(array($this, 'convertXml')));

			// $Controller = $collection->getController();
			// $this->request = $Controller->request;
			// $this->response = $Controller->response;
		// }
		
	public $controller;
		
	public function __construct($controller = null){
		$this->controller = $controller;
		$this->request = $controller->request;
	}
	
	/**
	 * Retourne true si la requete courante est de type XMLHttpRequest, false sinon
	 *
	 * @return boolean True si l'appel est en Ajax
	 */
		public function isAjax() {
			return $this->request->is('ajax');
		}


}