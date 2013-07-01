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
	
	// public static function destruct($modelName){
		// $model = ClassRegistry::init($modelName);
		// $modelName = ucfirst(substr($model->table,0,-1));
		// $classes = get_declared_classes();
		// if(in_array($modelName, $classes)){
			// foreach($classes as $k => $v){
				// if($v == $modelName){
					// pr($classes[$k]);
					// pr($k.' => '.$v);
					// unset($classes[$k]);
					// var_dump($classes[$k]);
				// }
				// unset($classes[$modelName]);
				// pr($classes[$modelName]);
				// pr($classes['154']);
				// pr($modelName);
				// pr($k.' => '.$v);
			// }
		// }
	// }

}