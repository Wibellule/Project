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
		
		/* Variable link et image */
		$this->loadModel('Project');
		$conditions = array('online' => 1, 'id' => $id);
		$d['req'] = $this->Project->find( array( 'fields' => 'content','conditions' => $conditions ) );
		$req = array();
		$req = $d['req'];
		foreach($req as $k => $v){
			$d['img'] = array();
			$d['img'] = explode('/>', $v['content']);
			$d['link'] = array();
			$d['link'] = explode('<img alt="" src="', $v['content']);
			$d['link'] = implode('',$d['link']);
			$d['link'] = explode('" style="width: 680px; height: 600px;" />',$d['link']);
		}
		// var_dump($link);
		$d['img'] = array_slice($d['img'], 0, -1);
		$d['link'] = array_slice($d['link'], 0, -1);
		$this->set('link', $d);
		////////////////////////////
		
		//On envoi les variables à la vue
		$this->set('project', $post);
		
		/* menu */
		$menu = $this->_get_website_menu();
		$this->set('menuGeneral', $menu);
	}

	function index(){		
		parent::index();
		$d['page'] = $this->request->page;
		$conditions = array('online' => 1);
		$d['project'] = $this->Project->find( array( 'conditions' => $conditions ) );
		$d['nbProjects'] = $this->Project->findCount( $conditions );
		
		
		$this->loadModel('Typeproject');
		$d['type'] = $this->Typeproject->find();
		
		// var_dump($d['project']);
		$tab = array();
		foreach($d['project'] as $k => $v){
			// var_dump($v);
			$link = $v['content'];
			// var_dump($link);
			$link = explode('<img alt="" src="', $link);
			// var_dump($link);
			$link = implode('', $link);
			// var_dump($link);
			$link = explode('" />',$link);
			// var_dump($link);
			$link = array_slice($link, 0, -1);
			// var_dump($link);
			$tab[$k] = $link;
		}
		// var_dump($tab);
		
		$this->set('nbProjects', $d['nbProjects']);
		$this->set('projects',$d);
		$this->set('type',$d['type']);
		$this->set('link',$tab);
		
		$menu = $this->_get_website_menu();
		$this->set('menuGeneral', $menu);
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
