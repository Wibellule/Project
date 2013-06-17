<?php
class CategoriesEventListener implements EventListener{

	public function implementedEvents(){
 			return array('Categories.controller' => '');
	}

	public function test($event = null){
		return $this->implementedEvents();
	}

}