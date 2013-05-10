<?php
class CategoriesController extends AppController{
	

	function view($id = null,$slug){
		
		$id = (int) $id;
		// pr($id);
		// die();
		//On test si un paramètre existe
		if(!isset($id)){ $this->e404('La page demandée n\'existe pas.'); }
		
		else if( !$id ){ $this->e404('La page demandée n\'existe pas.'); }
		
		$post = $this->Categorie->findFirst( array( 'conditions' => array( 'id' => $id, 'online' => 1) ) );
		
		//On test si la page demandée existe
		if(empty($post)){ $this->e404('La page demandée n\'existe pas.'); }
		
		if(isset($post['slug'])){
			if($slug != $post['slug']){
				$this->redirect('categories/view/id:'.$post['id'].'/slug:'.$post['slug'].'/prefix:article');
			}
		}
		
		//On envoi les variables à la vue
		$this->set('categorie', $post);
		// pr($this->request);
		// pr($post);
	}

	function index(){
		parent::index();
		$d['elementsPerPage'] = 1;
		$d['page'] = $this->request->page;
		$limit = $d['elementsPerPage']*($d['page']-1);
		$conditions = array('online' => 1);
		$d['categorie'] = $this->Categorie->find( array( 'conditions' => $conditions, 'limit' => $limit.', '.$d['elementsPerPage'] ) );
		$d['nbPosts'] = $this->Categorie->findCount( $conditions );
		$d['nbPages'] = ceil($d['nbPosts'] / $d['elementsPerPage']);
		$this->set('categorie',$d);
	}
	
	function backoffice_index(){
		parent::backoffice_index();
		// pr($this->Categorie->getTree());
		// die();
	}
	
	/**
	* Fonction qui récupère les élements du menu à inclure dans la view
	*/
	function getMenu(){
		// $this->loadModel('Categorie');
		$conditions = array('online' => 1);
		$pages = $this->Categorie->find(array('conditions' => $conditions,'order'=>'id'));
		$this->set('pages', $pages);
		return $pages;
	}


}
