<?php 
//Mise en place des règles de validation
$validate = array(
	'section' => array(
		'rule1' => array(
			'rule' => array('minLength', 3),
			'message' => 'La valeur du champ est de 3 caractères minimum.'
		)
	),
	'host' => array(
		'rule1' => array(
			'rule' => array('minLength', 3),
			'message' => 'La valeur du champ est de 3 caractères minimum.'
		),
		'rule2' => array(
			'rule' => array('custom', '/^([a-zA-Z0-9-_.]+)$/'),
			'message' => "Caractères non autorisés dans le champ (Uniquement lettres, chiffres, - (tiret), _ (underscore) et .(point))."
		)
	),
	'login' => array(
		'rule1' => array(
			'rule' => array('minLength', 3),
			'message' => 'La valeur du champ est de 3 caractères minimum.'
		),
		'rule2' => array(
			'rule' => array('custom', '/^([a-zA-Z0-9-_.]+)$/'),
			'message' => "Caractères non autorisés dans le champ (Uniquement lettres, chiffres, - (tiret), _ (underscore) et .(point))."
		)
	),/*
	'password' => array(
		'rule1' => array(
			'rule' => array('minLength', 3),
			'message' => 'La valeur du champ est de 3 caractères minimum.'
		),
		'rule2' => array(
			'rule' => array('custom', '/^([a-zA-Z0-9-]+)$/'),
			'message' => "Caractères non autorisés dans le champ (Uniquement lettres, chiffres et -)."
		)
	),*/
	'database' => array(
		'rule1' => array(
			'rule' => array('minLength', 3),
			'message' => 'La valeur du champ est de 3 caractères minimum.'
		),
		'rule2' => array(
			'rule' => array('custom', '/^([a-zA-Z0-9-_.]+)$/'),
			'message' => "Caractères non autorisés dans le champ (Uniquement lettres, chiffres, - (tiret), _ (underscore) et .(point))."
		)
	)
);

require_once(INSTALL_VALIDATE.DS.'proceed.php');