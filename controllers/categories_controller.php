﻿<?php
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
		// $menu = parent::_get_website_menu();
		// $this->set('menuGeneral', $menu);
		// pr($menu);
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
		// parent::backoffice_index();
		
		$this->loadModel('Categorie');
		$d['elementsPerPage'] = 50;
		$conditions = array(
			'conditions' => 'type != 3',
			'fields' => array('id', 'name', 'lft', 'rgt', 'level', 'online', 'type'), 
			'order' => 'lft'
		);
		$d['categories'] = $this->Categorie->find($conditions);		
		$d['nbElem'] = $this->Categorie->findCount('type != 3');
		$d['nbPages'] = ceil($d['nbElem'] / $d['elementsPerPage']);
		$this->set($d);
		
		pr($this->Categorie->getTreeList());
		// pr($this->Categorie->getPath(3,'varchar'));
		pr($this->Categorie->getTreeRecursive());
		// die();
	}
	
	function backoffice_add($id = null){

		$this->loadModel('Categorie');
		if($this->request->data){
			
			//////////////////////////////
			// Code validation François //
			//////////////////////////////
			if($this->Categorie->validates($this->request->data)){
				$this->request->data['type'] = 1;
				$this->Categorie->save($this->request->data);
				Session::setFlash('Element ajouté avec succes','success');
				$this->redirect('/adm/categories/index');
			}else{
				$errors = $this->$modelName->errors;
				$message = "Erreur dans le formulaire<br/><br/>";
				foreach($errors as $k => $v){
					$message .= $v."<br />";
				}
				Session::setFlash($message,'error');
			}			
			//////////////////////////////
		}
	}
	
	function _get_website_menu(){
		parent::_get_website_menu();
	}
	
	/**
	* Fonction qui récupère les élements du menu à inclure dans la view
	*/
	function getMenu(){
		$this->loadModel('Categorie');
		$conditions = array('conditions' => 'type != 3','online' => 1,'order'=>'id');
		$pages = $this->Categorie->find($conditions);		
		$this->set('pages', $pages);
		return $pages;
	}
	
	/**
	 * Fonction qui récupère le menu du site
	 * @return $menuGeneral array contient les catégories
	 * @access private
	 * @version 0.1 13/05/13
	 */
	// function _get_website_menu() {
    	
		//Récupération du menu général
		// $this->loadModel('Categorie');
		// $req = array('conditions' => array('online' => 1, 'type' => 1));
		// $menuGeneral = $this->Categorie->getTreeRecursive($req);
		// pr($menuGeneral);
    	// return $menuGeneral;
    // }    


}
