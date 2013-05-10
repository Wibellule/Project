<?php
class SlidersController extends AppController{
	

	function view($id = null,$slug){
		
		$id = (int) $id;
		
		//On test si un paramètre existe
		if(!isset($id)){ $this->e404('La page demandée n\'existe pas.'); }
		
		else if( !$id ){ $this->e404('La page demandée n\'existe pas.'); }
		
		$post = $this->Slider->findFirst( array( 'conditions' => array( 'id' => $id, 'online' => 1) ) );
		
		//On test si la page demandée existe
		if(empty($post)){ $this->e404('La page demandée n\'existe pas.'); }
		
		if(isset($post['slug'])){
			if($slug != $post['slug']){
				$this->redirect('sliders/view/id:'.$post['id'].'/slug:'.$post['slug'].'/prefix:article');
			}
		}
		
		//On envoi les variables à la vue
		$this->set('slider', $post);
	}

	function index(){
		
	}
}
