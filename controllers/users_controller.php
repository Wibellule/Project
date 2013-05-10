<?php
class UsersController extends AppController{
	function login(){
		$this->layout = 'connect';
		// pr($this->request->data['login']);
		// pr($this->request->data['mdp']);
		if($this->request->data){
			$data['login'] = $this->request->data['login'];
			$data['mdp'] = $this->request->data['mdp'];
			// pr($data);
			
			$postLogin = $data['login'];
			$postPassword = $data['mdp'];
			
			$user = $this->User->findFirst(array('conditions' => array( 'login' => $postPassword )));
			if(!empty($user)){
				//Etape1 Login
				$bddPassword = $user['password'];
				//Etape2 Comparaison des passwords
				if($postPassword == $bddPassword){
					// Etape3 Vérification du Online
					if($user['online'] == 1){
						//Etape4 Redirection page backoffice
						// + Initialisation des sessions
						// + Nom des sessions Backoffice.User.id.login
						// + Gestion des messages d'erreurs
						Session::write('Backoffice.User.id', $data['login']);
						Session::write('Backoffice.User.mdp', $data['mdp']);
						Session::setFlash('Connexion au backoffice réussie');
						$this->redirect('adminblog');
					}else{
						Session::setFlash('Cet utilisateur n\'est pas autorisé à se connecter', 'error');
					}
				}else{
					Session::setFlash('Mot de passe incorrect', 'error');				
				}			
			}else{
				Session::setFlash('Merci d\'indiquer un login', 'error');
			}	
		}
	}
	
	function logout(){
		Session::destroy();
		//Message de deconnexion
		$this->redirect('/');
	}
}