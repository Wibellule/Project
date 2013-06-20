<?php
/* inclusion du comportement */
include_once(BEHAVIORS.DS.'tree.php');

class Categorie extends Tree{

	//PRINCIPE DE FONCTIONS PARENTES
	// public function __construct(){
		// parent::__construct();
	// }
	
	//Variable pour l'affichage des erreurs sur les champs
	public $msgerr;
	
	/**
	 * Tableau contenant l'ensemble des champs à valider
	 * @comment version stable pour les conditions
	 * @var 	array
	 * @access 	public
	 */	
	
	var $validate = array(
		'name' => array(
			'rule' 		=> 'notEmpty',
			'message' 	=> "Vous devez indiquer le titre"
		),
		'slug' => array(
			'rule'		=> '([a-z0-9\-]+)',
			'message'	=> "Le slug de l'Url n'est pas valide"
		),
		'parent_id' => array(
			'rule'		=> 'checkParadox',
			'message' 	=> "Cette catégorie ne peut pas être son propre parent"
		),
		'redirection_category_id' => array(
			'rule' 		=> 'checkRedirect',
			'message' 	=> "Cette catégorie ne peut pas être redirigée vers elle-même"
		)
	);
	 
	
	
	/**
	 * Fonction afterSave, fonction qui propage l'évènement
	 * Fonction de test pour la version 0.1 du gestionnaire d'évènement
	 * @param $created boolean true ou false (pour le moment)
	 * @return void
	 * @access public
	 * @version 0.1
	 * @author Wibellule
	 */
	public function afterSave( $created ){
		if($created){
			$this->getEventManager()->dispatch(new Event('Model.Categorie.add', $this));
		}
	}
	
}