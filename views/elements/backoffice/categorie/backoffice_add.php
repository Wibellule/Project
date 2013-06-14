<?php include(BACKOFFICE.DS.'formulaire'.DS.'js.php');?>
	<div class="contentcontainer">
	<?php include(BACKOFFICE.DS.'formulaire'.DS.'message_flash.php');?>
		<div class="headings altheading">
			<h2>Ajouter une <?php echo $titrepage[$this->request->controller];?></h2>
		</div>
	<div class="contentbox">
		<?php
			echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/adm/'.$this->request->controller.'/'.$this->request->action)));
			include(BACKOFFICE.DS.'categorie'.DS.$this->request->controller.'.php');
			echo $this->helpers['Form']->end(true);
		?>
	</div>
</div>
