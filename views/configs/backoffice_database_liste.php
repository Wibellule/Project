<div id='rightside'>
<?php $this->element(BACKOFFICE.DS.'formulaire'.DS.'message_flash.php');?>
<?php echo $this->helpers['Form']->create(array('id' => 'ConfigDatabase', 'action' => Router::url('backoffice/configs/database_liste'), 'method' => 'post')); ?>
	<h2><?php echo "Configuration de la base de données (locale)"; ?></h2>
		<?php 
		echo $this->helpers['Form']->input('localhost.host', 'Adresse du serveur');			 
		echo $this->helpers['Form']->input('localhost.database', 'Nom de la base de données');			 
		echo $this->helpers['Form']->input('localhost.login', 'Identifiant');			 
		echo $this->helpers['Form']->input('localhost.password', 'Mot de passe', array('type' => 'password'));			 
		echo $this->helpers['Form']->input('localhost.prefix', 'Préfix des tables');	
		?>
	<h2><?php echo "Configuration de la base de données (production)"; ?></h2>
		<?php 
		echo $this->helpers['Form']->input('online.host', 'Adresse du serveur');			 
		echo $this->helpers['Form']->input('online.database', 'Nom de la base de données');			 
		echo $this->helpers['Form']->input('online.login', 'Identifiant');			 
		echo $this->helpers['Form']->input('online.password', 'Mot de passe', array('type' => 'password'));			 
		echo $this->helpers['Form']->input('online.prefix', 'Préfix des tables');	
		?>
<?php echo $this->helpers['Form']->end(true); ?>
</div>