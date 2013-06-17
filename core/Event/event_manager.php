<?php

class EventManager{
	
	/**
	 * La valeur de file d'attente de priorité par défaut pour les nouveaux écouteurs connectés
	 *
	 * @var int
	 */
		public static $defaultPriority = 10;

	/**
	 * L'instance globale disponible, utilisée pour la distribution des événements attachés de toute portée
	 *
	 * @var CakeEventManager
	 */
		protected static $_generalManager = null;

	/**
	 * Liste des callback d'écouteur associés à
	 *
	 * @var object $Listeners
	 */
		protected $_listeners = array();

	/**
	 * Indicateur interne qui distingue un gestionnaire commun du singleton
	 *
	 * @var boolean
	 */
		protected $_isGlobal = false;
	
	/**
	 * Renvoie l'occurrence disponibles au niveau global d'un EventManager 
	 * il est utilisé pour l'envoi d'événements attachés à l'extérieur du champ d'application d'autres cadres ont été créés. 
	 * Habituellement, pour la création de systèmes de crochet ou de la communication inter-classe
	 *
	 * Si elle est appelée avec le premier paramètre, il sera défini comme l'instance globalement disponible
	 *
	 * @param CakeEventManager $manager
	 * @return CakeEventManager the global event manager
	 */
		public static function instance($manager = null) {
			if ($manager instanceof EventManager) {
				self::$_generalManager = $manager;
			}
			if (empty(self::$_generalManager)) {
				self::$_generalManager = new EventManager;
			}

			self::$_generalManager->_isGlobal = true;
			return self::$_generalManager;
		}
		
	/**
	 * Ajoute un nouvel écouteur à un événement. Ecouteurs
	 *
	 * @param callback|EventListener $callable PHP type callback valide ou instance de EventListener d'être appelé
	 * Lorsque l'événement nommé avec $ eventKey est déclenchée. Si une instance de EventListener est passé, puis la méthode `implementedEvents`
	 * sera appelée sur l'objet pour enregistrer les événements déclarés individuellement que des méthodes pour être gérées par cette classe.
	 * Il est possible de définir plusieurs gestionnaires d'événements par nom d'événement.
	 *
	 * @param string $eventKey Le nom de l'identificateur unique de l'événement avec laquelle le rappel sera associé. Si $ callable
	 * Est une instance de EventListener cet argument sera ignoré
	 *
	 * @param array $options utilisé pour définir la 'priority' et 'passParams' à l'écouteur.
	 * Les priorités sont traités comme des files d'attente, et plusieurs pièces jointes ajoutées à la même file d'attente de priorité seront traités dans
	 * L'ordre d'insertion. `passParams` signifie que la propriété des données d'événement sera converti les arguments de fonctions
     * Quand l'écouteur est appelé. Si dollars appelé est une instance de EventListener, ce paramètre sera ignoré
	 *
	 * @return void
	 * @throws InvalidArgumentException Lorsque la clé d'événement est manquante ou appelable n'est pas une
	 * Instance de EventListener.
	 */
		public function attach($callable, $eventKey = null, $options = array()) {
			if (!$eventKey && !($callable instanceof EventListener)) {
				throw new InvalidArgumentException('_dev', 'The eventKey variable is required');
			}
			if ($callable instanceof EventListener) {
				$this->_attachSubscriber($callable);
				return;
			}
			$options = $options + array('priority' => self::$defaultPriority, 'passParams' => false);
			$this->_listeners[$eventKey][$options['priority']][] = array(
				'callable' => $callable,
				'passParams' => $options['passParams'],
			);
		}
		
	/**
	 * Dispatches a new event to all configured listeners
	 *
	 * @param string|CakeEvent $event the event key name or instance of CakeEvent
	 * @return void
	 */
		public function dispatch($event) {
			if (is_string($event)) {
				$event = new Event($event);
			}

			if (!$this->_isGlobal) {
				self::instance()->dispatch($event);
			}

			if (empty($this->_listeners[$event->name()])) {
				return;
			}

			foreach ($this->listeners($event->name()) as $listener) {
				if ($event->isStopped()) {
					break;
				}
				if ($listener['passParams'] === true) {
					$result = call_user_func_array($listener['callable'], $event->data);
				} else {
					$result = call_user_func($listener['callable'], $event);
				}
				if ($result === false) {
					$event->stopPropagation();
				}
				if ($result !== null) {
					$event->result = $result;
				}
				continue;
			}
		}

	/**
	 * Returns a list of all listeners for an eventKey in the order they should be called
	 *
	 * @param string $eventKey
	 * @return array
	 */
		public function listeners($eventKey) {
			if (empty($this->_listeners[$eventKey])) {
				return array();
			}
			ksort($this->_listeners[$eventKey]);
			$result = array();
			foreach ($this->_listeners[$eventKey] as $priorityQ) {
				$result = array_merge($result, $priorityQ);
			}
			return $result;
		}

}