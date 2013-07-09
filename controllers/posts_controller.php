<?php
class PostsController extends AppController{
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
		
		// pr($d['typeposts']);
		foreach($d['typeposts'] as $k => $v){
			// pr($v['name']);
			$conditions = array('tag' => $v['name'] ,'online' => 1);
			$count = $this->Post->findCount($conditions);
			// pr($count);
			if($count == 0){
				unset($d['typeposts'][$k]);
			}
		}
		// pr($d['typeposts']);
		$this->set('post', $post);
		$this->set($d);
		
		/** Gestion du formulaire en Ajax **/
		if($this->components['RequestHandler']->isAjax()){
			$this->layout = 'ajax';
			if(isset($this->request->data)){
				$this->loadModel('Postscomment');
				if($this->Postscomment->validate){
					$this->request->data['online'] = 0;
					$this->Postscomment->save($this->request->data);
					Session::setFlash('Message envoyé','success');
				}else{
					$errors = $this->Postscomment->errors;
					$message = "Erreur dans le formulaire<br/><br/>";
					foreach($errors as $k => $v){
						$message .= $v."<br />";
					}
					Session::setFlash($message,'error');
				}
			}
		}
		
		/** Chargement des commentaires **/
		$this->loadModel('Postscomment');
		$conditions = array('post_id' => $id ,'online' => 1);
		$comments = $this->Postscomment->find(array('conditions' => $conditions));
		$nb_comments = $this->Postscomment->findCount($conditions);
		// pr($comments);
		// pr($nb_comments);
		$this->set('comments', $comments);
		$this->set('nbcomments', $nb_comments);
		/** à suivre **/
		
		/* menu */
		$menu = $this->_get_website_menu();
		$this->set('menuGeneral', $menu);
	}

	function index($tag = null){
		parent::index();
		$d['elementsPerPage'] = 5;
		$d['page'] = $this->request->page;
		$limit = $d['elementsPerPage']*($d['page']-1);
		if($tag){
			$conditions = array( 'online' => 1, 'tag' => $tag);
			Router::connect($tag,'posts/index/'.$tag);
		}else{
			$conditions = array( 'online' => 1);
		}
		$d['posts'] = $this->Post->find( array( 'conditions' => $conditions, 'limit' => $limit.', '.$d['elementsPerPage'] ) );
		$d['nbPosts'] = $this->Post->findCount( $conditions );
		$d['nbPages'] = ceil($d['nbPosts'] / $d['elementsPerPage']);
		$this->loadModel('Typepost');
		$d['typeposts'] = $this->Typepost->find();
		
		foreach($d['typeposts'] as $k => $v){
			// pr($v['name']);
			$conditions = array('tag' => $v['name'] ,'online' => 1);
			$count = $this->Post->findCount($conditions);
			// pr($count);
			if($count == 0){
				unset($d['typeposts'][$k]);
			}
		}		
		
		$this->set($d);
		
		/** Menu **/
		$menu = $this->_get_website_menu();
		$this->set('menuGeneral', $menu);
		
		/** Commentaires **/
		$this->loadModel('Postscomment');
		// $conditions = array('post_id' => $id ,'online' => 1);
		// $nb_comments = $this->Postscomment->findCount($conditions);
		// $this->set('nbcomments', $nb_comments);
	}
		
	function backoffice_add(){
		parent::backoffice_add();
		$this->loadModel('Typepost');
		$d['typeposts'] = $this->Typepost->find();
		$this->set('typeposts', $d);
		// pr($d['typeprojects']);
	}
	
	function backoffice_edit($id){
		parent::backoffice_edit($id);
		$this->loadModel('Typepost');
		$d['typeposts'] = $this->Typepost->find();
		$this->set('typeposts', $d);
		// pr($d['typeprojects']);
	}
	
	//Prochainement fonction de tri pour afficher les différents types d'articles sur une meme page//
}	
?>













