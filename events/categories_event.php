<?php
class CategoriesEventListener implements EventListener{

	public function implementedEvents(){
 			return array(
				'Model.Categorie.add' => 'addPost'
			);
	}

	public function addPost($event){
		// return $this->implementedEvents();
		// var_dump($event);
		$model = ClassRegistry::init('mail');
		// $modelName = ucfirst(substr($model->table,0,-1));
		// pr($modelName);
		// pr($event->name());
		// pr($event->subject->test());
		// pr(get_declared_classes());
		// die();
		// pr($model);
		// ClassRegistry::destruct($modelName);
		// pr(get_declared_classes());
	}
	
	// public function __construct(){
		// pr($this);
	// }

}