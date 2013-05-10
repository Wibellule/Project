<?php
// pr($this->request->prefix);
//redirection vers le formulaire de connexion si l'on essaye d'acceder aux pages de connexion sans etre connecté
if( isset($this->request->prefix) && $this->request->prefix == 'backoffice' && !Session::check('Backoffice')){
	Session::setFlash('Merci de bien vouloir vous connecter','info');
	$this->redirect('connexion');
}
?>