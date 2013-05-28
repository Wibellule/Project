<?php
class AppController extends Controller{
	function index(){
		// pr($this->request);
		// Router::promote(3);
		// pr($this->request);
		// $menu = $this->_get_website_menu();
		// $this->set('menuGeneral', $menu);
	}

	function backoffice_index(){
		$modelName = $this->request->modelName;
	
		$d['elementsPerPage'] = 10;
		$d['page'] = $this->request->page;
		$limit = $d['elementsPerPage']*($d['page']-1);
		
		$conditions = array( 'online' => 1);
		$d[$this->request->controller] = $this->$modelName->find( array( 'limit' => $limit.', '.$d['elementsPerPage'] ) );
		$d['nbElem'] = $this->$modelName->findCount( $conditions );
		$d['nbPages'] = ceil($d['nbElem'] / $d['elementsPerPage']);
		$this->set($d);
		// pr($modelName);
	}
	
	function backoffice_add($id = null){
		$modelName = $this->request->modelName;
		if($this->request->data){
			
			//////////////////////////////
			// Code validation Fran�ois //
			//////////////////////////////
			if($this->$modelName->validates($this->request->data)){
				$this->$modelName->save($this->request->data);
				Session::setFlash('Element ajout� avec succes','success');
				$this->redirect('/adm/'.lcfirst($modelName).'s'.'/index');
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
	
	function backoffice_edit($id){	
		$modelName = $this->request->modelName;
		if($this->request->data){
			//////////////////////////////
			// Code validation Fran�ois //
			//////////////////////////////
			if($this->$modelName->validates($this->request->data)){
				// $this->request->data['type'] = 'post';
				$this->$modelName->save($this->request->data);
				Session::setFlash('Element modifi� avec succes','success');
				// pr($this->request->data);
				// die();
				$this->redirect('/adm/'.lcfirst($modelName).'s'.'/index');
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
		//Injection de l'id dans les donn�es
		$this->request->data = $this->$modelName->findFirst(array('conditions' => array( 'id' => $id )));
		$d['id'] = $this->request->data['id'];
		$this->set($d);
	}
	
	function backoffice_delete($id){
		$modelName = $this->request->modelName;
		if($this->$modelName->delete($id)){
			Session::setFlash('L\'enregistrement a �t� supprim�','success');
		}else{
			Session::setFlash('L\'enregistrement n\'a pas �t� supprim�','error');
		}
		$this->redirect('adm/'.lcfirst($modelName).'s'.'/index');
	}
	
	/**
	 * Cette fonction permet de r�cup�rer le menu
	 *
	 * @param 	integer $websiteId Identifiant du site Internet
	 * @return 	array 	Liste des cat�gories
	 * @access 	protected
	 * @author 	ko�ZionCMS
	 * @version 0.1 - 03/05/2012 by FI
	 */       
    // protected function _get_website_menu($websiteId) {
    protected function _get_website_menu() {
    	
    	// $cacheFolder 	= TMP.DS.'cache'.DS.'variables'.DS.'Categories'.DS;
    	// $cacheFile 		= "website_menu_".$websiteId;
    	
    	// $menuGeneral = Cache::exists_cache_file($cacheFolder, $cacheFile);
    	
    	// if(!$menuGeneral) {
    	
    		//R�cup�ration du menu g�n�ral
    		$this->loadModel('Categorie');
    		$req = array('conditions' => array('online' => 1, 'type' => 1));
    		$menuGeneral = $this->Categorie->getTreeRecursive($req);
    		
    		// Cache::create_cache_file($cacheFolder, $cacheFile, $menuGeneral);
    	// }
    	// pr($menuGeneral);
    	return $menuGeneral;
    }       
	
	   
}