<?php
class ProjectsController extends AppController{
	

	function view($id = null,$slug){
		
		$id = (int) $id;
		// pr($id);
		// die();
		//On test si un paramètre existe
		if(!isset($id)){ $this->e404('La page demandée n\'existe pas.'); }
		
		else if( !$id ){ $this->e404('La page demandée n\'existe pas.'); }
		
		$post = $this->Project->findFirst( array( 'conditions' => array( 'id' => $id, 'online' => 1) ) );
		
		//On test si la page demandée existe
		if(empty($post)){ $this->e404('La page demandée n\'existe pas.'); }
		
		if(isset($post['slug'])){
			if($slug != $post['slug']){
				$this->redirect('projects/view/id:'.$post['id'].'/slug:'.$post['slug'].'/prefix:projet');
			}
		}
		// print_r($post['slug']);
		
		//On envoi les variables à la vue
		$this->set('project', $post);
	}

	function index(){		
		parent::index();
		$d['page'] = $this->request->page;
		$conditions = array('online' => 1);
		$d['project'] = $this->Project->find( array( 'conditions' => $conditions ) );
		$d['nbProjects'] = $this->Project->findCount( $conditions );
		$this->loadModel('Typeproject');
		$d['type'] = $this->Typeproject->find();
		$this->set('nbProjects', $d['nbProjects']);
		$this->set('projects',$d);
		$this->set('type',$d['type']);
	}
	
	function backoffice_index(){
		parent::backoffice_index();
		$this->loadModel('Typeproject');
		$d['typeprojects'] = $this->Typeproject->find();
		$this->set('typeprojects', $d);
		// pr($d['typeprojects']);
	}
	
	function backoffice_add(){
		parent::backoffice_add();
		$this->loadModel('Typeproject');
		$d['typeprojects'] = $this->Typeproject->find();
		$this->set('typeprojects', $d);
		// pr($d['typeprojects']);
	}
	
	function backoffice_edit($id){
		parent::backoffice_edit($id);
		$this->loadModel('Typeproject');
		$d['typeprojects'] = $this->Typeproject->find();
		$this->set('typeprojects', $d);
		// pr($d['typeprojects']);
	}
}
