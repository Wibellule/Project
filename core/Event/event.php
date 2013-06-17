<?php

class Event{

	/**
	 * Nom de l'évenement
	 *
	 * @var string $name
	 */
		protected $_name = null;

	/**
	 * L'objet courant est passé dans l'event
	 * The object this event applies to (usually the same object that generates the event)
	 *
	 * @var object
	 */
		protected $_subject;

	/**
	 * Données personnalisées passées dans l'évenement
	 *
	 * @var mixed $data
	 */
		public $data = null;

	/**
	 * Constructeur de la classe Event
	 * @param $name Varchar ex : 'Model.Order.afterPlace'
	 * @param $subject Object on lui passe l'objet courant ($this)
	 * @param $data Array les données à faire passer pour déclencher des évènements en fonctions de conditions
	 */
	public function __construct($name, $subject = null, $data = null){
		$this->_name = $name;
		$this->data = $data;
		$this->_subject = $subject;
	}
	
	/**
	 * Renvoie dynamiquement le nom et le sujet si on y accède directement
	 *
	 * @param string $attribute
	 * @return mixed
	 */
	public function __get($attribute) {
		if ($attribute === 'name' || $attribute === 'subject') {
			return $this->{$attribute}();
		}
	}
	
	/**
	 * Returns the name of this event. This is usually used as the event identifier
	 *
	 * @return string
	 */
	public function name() {
		return $this->_name;
	}

	/**
	 * Returns the subject of this event
	 *
	 * @return string
	 */
	public function subject() {
		return $this->_subject;
	}

	
	/**
	 * Stops the event from being used anymore
	 *
	 * @return void
	 */
		public function stopPropagation() {
			return $this->_stopped = true;
		}

	/**
	 * Check if the event is stopped
	 *
	 * @return boolean True if the event is stopped
	 */
		public function isStopped() {
			return $this->_stopped;
		}
	
	

}