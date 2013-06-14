<?php include(BACKOFFICE.DS.'formulaire'.DS.'js.php');?>
<?php include(BACKOFFICE.DS.'formulaire'.DS.'message_flash.php');?>
	<h2>Ajouter une <?php echo $titrepage[$this->request->controller];?></h2>
<?php
	echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/adm/'.$this->request->controller.'/'.$this->request->action)));
	echo $this->helpers['Form']->input('id', '',array('type' => 'hidden'));//Important pour ne pas dupliquer la ligne
	include(BACKOFFICE.DS.'slider'.DS.$this->request->controller.'.php');
	echo $this->helpers['Form']->end(true);
?>

