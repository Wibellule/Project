<?php
class ProjectsController extends AppController{
	

	function view($id = null,$slug){
		
		$id = (int) $id;
		// pr($id);
		// die();
		//On test si un param�tre existe
		if(!isset($id)){ $this->e404('La page demand�e n\'existe pas.'); }
		
		else if( !$id ){ $this->e404('La page demand�e n\'existe pas.'); }
		
		$post = $this->Project->findFirst( array( 'conditions' => array( 'id' => $id, 'online' => 1) ) );
		
		//On test si la page demand�e existe
		if(empty($post)){ $this->e404('La page demand�e n\'existe pas.'); }
		
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
		
		//On envoi les variables � la vue
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
		
		// var_dump($d['project']);
		
		foreach($d['project'] as $k => $v){
			// var_dump($v);
			$link = $v['content'];
			// var_dump($link);
			$link = explode('<img alt="" src="', $link);
			// var_dump($link);
			$link = implode('', $link);
			// var_dump($link);
			$link = explode('" style="width: 220px; height: 140px;" />',$link);
			// var_dump($link);
			$link = array_slice($link, 0, -1);
			// var_dump($link);
		}
		var_dump($link);
		
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
