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
	 *
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
		)
	);
	
	/**
	 * Fonction qui doit vérifier qu'une catégorie ne doit pas être son propre parent
	 */
	 
	 
	/**
	 * Fonction qui doit vérifier qu'une catégorie n'est pas redirigée vers elle même ( boucle infinie )
	 */
	
}