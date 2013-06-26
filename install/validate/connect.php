<?php 
//Mise en place des règles de validation
function validate($datas){
	$errors = array();
	foreach($datas as $k => $v){
		switch($k){
			case 'host':
				if(!preg_match('/^([a-zA-Z0-9-_.]+)$/',$v)){
					$errors[$k] = "Caractères non autorisés dans le champ (Uniquement lettres, chiffres, - (tiret), _ (underscore) et .(point)).";
				}
			break;
			case 'login':
				if(!preg_match('/^([a-zA-Z0-9-_.]+)$/',$v)){
					$errors[$k] = "Caractères non autorisés dans le champ (Uniquement lettres, chiffres, - (tiret), _ (underscore) et .(point)).";
				}
			break;
			case 'database':
				if(!preg_match('/^([a-zA-Z0-9-_.]+)$/',$v)){
					$errors[$k] = "Caractères non autorisés dans le champ (Uniquement lettres, chiffres, - (tiret), _ (underscore) et .(point)).";
				}
			break;
		}
	}
	return $errors;
}