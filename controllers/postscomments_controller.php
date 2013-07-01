<?php
class PostscommentsController extends AppController{
	function view($id = null,$slug){
		
		$id = (int) $id;
		
		//On test si un paramètre existe
		if(!isset($id)){ $this->e404('La page demandée n\'existe pas.'); }
		
		else if( !$id ){ $this->e404('La page demandée n\'existe pas.'); }
		
		$post = $this->Post->findFirst( array( 'conditions' => array( 'id' => $id, 'online' => 1) ) );
		
		//On test si la page demandée existe
		if(empty($post)){ $this->e404('La page demandée n\'existe pas.'); }
		
		if(isset($post['slug'])){
			if($slug != $post['slug']){
				$this->redirect('posts/view/id:'.$post['id'].'/slug:'.$post['slug'].'/prefix:article');
			}
		}
		$this->loadModel('Typepost');
		$d['typeposts'] = $this->Typepost->find();
		$this->set('post', $post);
		$this->set($d);
		
		/* menu */
		$menu = $this->_get_website_menu();
		$this->set('menuGeneral', $menu);
	}
	
	function index(){
		parent::index();
	}
	
	function backoffice_add(){
		parent::backoffice_add();
	}
	
	function backoffice_edit($id){
		parent::backoffice_edit($id);
	}


}