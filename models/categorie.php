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
	 * Cette fonction permet de contrôler qu'une catégorie ne soit pas son propre parent
	 * Fonction qui doit vérifier qu'une catégorie ne doit pas être son propre parent
	 * @var 	integer $val Valeur du champ parent_id
	 * @access 	public
	 * @author 	koéZionCMS
	 * @version 0.1 - 20/04/2012 by FI
	 */	
	function check_paradox($val) {

	$modelDatas = $this->datas; //Données postées

	//Il faut contrôler si on est sur un ajout ou sur une édition
	//car dans le cas de l'ajout il ne faudra pas faire le test		
	if(isset($modelDatas['id'])) { return $modelDatas['id'] != $val; }
	else { return true; }		
	}	
	
	/**
	 * Cette fonction permet de contrôler qu'une catégorie ne soit redirigée vers elle même
	 * Fonction qui doit vérifier qu'une catégorie n'est pas redirigée vers elle même ( boucle infinie )
	 * @var 	integer $val Valeur du champ parent_id
	 * @access 	public
	 * @author 	koéZionCMS
	 * @version 0.1 - 20/04/2012 by FI
	 */	
	function check_redirect($val) {
		
		$modelDatas = $this->datas; //Données postées
		
		//Il faut contrôler si on est sur un ajout ou sur une édition
		//car dans le cas de l'ajout il ne faudra pas faire le test		
		if(isset($modelDatas['id'])) { return $modelDatas['id'] != $val; }
		else { return true; }		
	}
	
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