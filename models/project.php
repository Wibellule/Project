<?php
class Project extends Model{

	//PRINCIPE DE FONCTIONS PARENTES
	// public function __construct(){
		// parent::__construct();
	// }
	
	var $validate = array(
		'name' => array(
			'rule' 		=> 'notEmpty',
			'message' 	=> "Vous devez indiquer le titre"
		),
		'description' => array(
			'rule'		=> 'notEmpty',
			'message'	=> "Le contenu ne doit pas être vide"
		),
		'content' => array(
			'rule'		=> 'notEmpty',
			'message'	=> "Le contenu ne doit pas être vide"
		)
	);
	
}