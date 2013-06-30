<?php

class ClassRegistry extends Model {

	/**
	 * Fonction static qui va permettre de charger un model dans les évènements
	 * @param $modelName string nom du model à charger
	 * @return instance du modelName
	 */
	public static function init($modelName){
		$file = ROOT.DS.'models'.DS.lcfirst($modelName).'.php';
		require_once($file);
		//Test si le model existe et évite de charger plusieurs fois le model
		if(!isset($modelName)){ $modelName = new $modelName();}
		// pr($modelName);
		return  new $modelName();
	}

}