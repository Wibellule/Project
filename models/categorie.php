﻿<?php
class Categorie extends Model{

	//PRINCIPE DE FONCTIONS PARENTES
	// public function __construct(){
		// parent::__construct();
	// }
	public $msgerr;
	
	var $validate = array(
		'name' => array(
			'rule' 		=> 'notEmpty',
			'message' 	=> "Vous devez indiquer le titre"
		),
		'slug' => array(
			'rule'		=> '([a-z0-9\-]+)',
			'message'	=> "Le slug de l'Url n'est pas valide"
		)/*,
		'content' => array(
			'rule'		=> 'notEmpty',
			'message'	=> "Le contenu ne doit pas être vide"
		),
		'online' => array(
			'rule' => 'notEmpty',
			'message' => "Le contenu ne doit pas être vide"
		)*/
	);
	
}