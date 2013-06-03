<?php
class MessagesController extends AppController{
	
	function backoffice_index(){
		parent::backoffice_index();
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


}
