<?php
class Typepost extends Model{

	//PRINCIPE DE FONCTIONS PARENTES
	// public function __construct(){
		// parent::__construct();
	// }
	
	var $validate = array(
		'name' => array(
			'rule' 		=> 'notEmpty',
			'message' 	=> "Vous devez indiquer le titre"
		)
	);
	
}