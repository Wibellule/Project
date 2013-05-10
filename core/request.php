<?php
/**
 * Cette classe va faire les actions suivantes : 
 * - Récupération de l'url courante
 * - Gestion des variables passées en GET
 * - Gestion des variables passées en POST
 * - Gestion des champs upload
 */
class Request{
	
	public $url;
	public $page;
	public $data = false;//Pour l'envoie des données de modif des articles
	public $err = array();

	function __construct(){
		// pr($_SERVER['PATH_INFO']);
		$this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/'; //Affectation de l'url
		//Test ternaire si path_info existe alors path info sinon racine
			if(isset($_GET['page']) && is_numeric($_GET['page'])){
				$this->page = $_GET['page'];
			}else{
				$this->page = 1;
			}
			//Gestion de la variable $_POST
			if(!empty($_POST)){//Si $_POST n'est pas vide
				// $this->data = new stdClass();//Seule manière de déclarer un nouvel objet vide
				// foreach($_POST as $k=>$v){//Parcours
					// $this->data->$k=$v;//Affectation clé valeur
				// }
				
				/** François **/
				if(!$this->data) { $this->data = array(); }
				foreach($_POST as $k=>$v){
					if(!is_array($v)){ $v = stripslashes($v); } 
					$this->data[$k] = $v;
					// $this->err[$k] = $v;
				}
			}
		}
		
}
