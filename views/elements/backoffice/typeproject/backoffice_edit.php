<?php include(BACKOFFICE.DS.'formulaire'.DS.'js.php');?>
<?php include(BACKOFFICE.DS.'formulaire'.DS.'message_flash.php');?>
<h2>Editer un <?php echo $titrepage[$this->request->controller];?></h2>
<?php
	//Important de spécifier l'id dans l'url sinon si un champs est vide cela affiche une erreur
	echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/adm/'.$this->request->controller.'/'.$this->request->action.'/'.$id)));
	echo $this->helpers['Form']->input('id', '',array('type' => 'hidden'));//Important pour ne pas dupliquer la ligne
	include(BACKOFFICE.DS.'typeproject'.DS.$this->request->controller.'.php');
	echo $this->helpers['Form']->end(true);
?>