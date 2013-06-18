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
		pr($event->name());
		// die();
	}
	
	// public function __construct(){
		// pr($this);
	// }

}