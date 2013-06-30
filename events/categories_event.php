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
		$categorie = ClassRegistry::init('categorie');
		pr($event->name());
		pr($categorie->test());
		// die();
	}
	
	// public function __construct(){
		// pr($this);
	// }

}