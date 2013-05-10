<?php
class PagesController extends Controller{
	
	function view($id,$slug){
	
	
		//cast de la variable $id
		$id = (int)$id;
		// var_dump($id);
		//test pour ne pas surcharger l'application
		//Si un parametre existe
		if(!isset($id)){$this->e404($message);}
		//On teste si l'id est un numérique
		// else if (is_int($id)){$this->e404($message);}
		else if (!$id){$this->e404($message);}
	
		//On charge le model
		$this->loadModel('Post');
	
		
		$page = $this->Post->findFirst(array(
			'conditions' => array(
				'id' 	=> $id,
				'type' 	=> 'page'
			)
		));
		//Si vide, par exemple si la page est offline
		if(empty($page)) {$this->e404('Page introuvable');}
		
		//Pour la redirection
		if(isset($page['slug'])){
			if($slug != $page['slug']){
				$this->redirect('pages/view/id:'.$page['id'].'/slug:'.$page['slug']);
			}
		}
		
		// print_r($page);
		
		$this->set('categories',$page);		
		
		//appel du menu
		// $this->getMenu();
		
		// $post = $this->Post->find(array(
			// 'conditions' => array(
				// 'id' => 1,
				// 'online' => 1
			// ),
			// 'moreConditions' => "name = 'toto'",
			// 'order' => 'id ASC, name DESC',
			// 'limit' => '10'
		// ));
		
		
		
		// $post = $this->Post->findFirst(
			// array(
			// 'conditions' => array(
				// 'online' => 1
		// )));
		
		
		
		// $conditions = array('online' => 1, 'name' => 'toto');
		// $resultat = $this->Post->findCount($conditions);
		// pr($post);
		// $post = $this->Post->find();
		
		
		
		// $this->set('resultat',$resultat);
		// print_r($d['post']);
		// pr($this->Post->table_list());
	}
	
/**
* Fonction qui récupère les élements du menu à inclure dans la view
*/
	function getMenu(){
		$this->loadModel('Post');
		$pages = $this->Post->find(
			array('conditions' => array('type' => 'page'))
		);
		// $this->set('pages', $pages);
		return $pages;
	}
}
?>












