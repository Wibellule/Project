<?php

class Session{

	/**
	* Fonction static init
	* Initialise une session
	*/
	public static function init(){
		if(!isset($_SESSION)){
			ini_set('session.use_trans_sid', 0);	//Evite de passer l'id de la session dans l'url
			session_name('monMVC');					//Modifie le nom de la session
			session_start();						//Démarre la session
		}
	}
	
	/**
	* Fonction static check vérifie si un élement est présent dans la session
	* @param varchar $key chemin
	* @return boolean, vrai si la valeur est insérée, faux sinon
	*/
	// public static function check($key){
		// if(isset($_SESSION[$key])){
			// return true;
		// }else{
			// return false;
		// }
	// }
	//AVEC SET
	public static function check($key){
		if(empty($key)){ return false; }
		
		$result = Set::classicExtract($_SESSION,$key);//Classe Set permet d'extraire les données d'un tableau grace au chemin
		return isset($result);
	}
	
	/**
	* Fonction static write écrie une donnée dans la variable session
	* @param varchar $key clé envoyée( chemin )
	* @param varchar $value valeur de la clé
	* @return boolean, vrai si la valeur est insérée, faux sinon
	*/
	public static function write($key,$value){
		$session = Set::insert($_SESSION,$key,$value);//On insère les données et on récupére la nouvelle variable de session
		$_SESSION = $session;
		return Set::classicExtract($_SESSION,$key) == $value;//Retourne la comparaison entre l'extraction et la valeur
	}
	
	/**
	* Fonction static qui lit la valeur d'un élement dans la variable de session
	* @param varchar $key clé de la donnée
	*/
	public static function read($key = null){
		$result = Set::classicExtract($_SESSION,$key);
		if(!is_null($result)){	
			return $result;
		}else{
			return false;
		}
	}
	
	/**
	* Fonction static pour supprimer un élement
	*/
	public static function delete($key){
		$result = Set::remove($_SESSION,$key);
		$_SESSION = $result;
		return (Session::check($key) == false);
	}
	
	/**
	* Fonction static qui supprime une variable de session
	*/
	public static function destroy(){
		session_unset();
		//Copier le code de koezion pour supprimer le cookie//		
		session_destroy();
	}
	
	/**
	* Fonction pour insérer des messages flash qui seront afficher dans le site
	*/
	public static function setFlash($message,$type = 'success'){
		Session::write('Flash.message', $message);
		Session::write('Flash.type', $type);
	}


}