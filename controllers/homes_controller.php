<?php
class HomesController extends AppController{

	function index(){
		parent::index();
		/* Sliders */
		$this->loadModel('Slider');
		$conditions = array('online' => 1);
		$d['sliders'] = $this->Slider->find(array('conditions' => $conditions,'order'=>'id'));
		$this->set('sliders', $d['sliders']);
		
		
		/* Derniers projets */
		$this->loadModel('Project');
		$conditions = array('online' => 1);
		$d['elem'] = 8;
		$limit = 0;
		$d['projects'] = $this->Project->find(array('conditions' => $conditions,'order'=>'id', 'limit' => $limit.', '.$d['elem']));
		$this->set('projects', $d['projects']);
		
		/* Derniers articles */
		$this->loadModel('Post');
		$conditions = array('online' => 1);
		$d['elem'] = 8;
		$limit = 0;
		$d['posts'] = $this->Post->find(array('conditions' => $conditions,'order'=>'id', 'limit' => $limit.', '.$d['elem']));
		$this->set('posts', $d['posts']);
		
		
		return($d);
	}
}
