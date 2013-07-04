<div class="container">
	<div class="page-header">
		<h1>Zone réservée</h1>
		<?php 
			$messageFlash = Session::read('Flash');
				if($messageFlash){
					echo "<div class='alert alert-".Session::read('Flash.type')."'>";
					echo Session::read('Flash.message').'</div>';
				}
			Session::delete('Flash');
		?>
	</div>
	<?php 
		// echo $this->helpers['Form']->login(); 
		echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('users/login'), 'class' => 'form-horizontal'));
		echo $this->helpers['Form']->input('login', 'Login',array('class' => 'input-medium','placeholder' => 'Login'));
		echo $this->helpers['Form']->input('mdp', 'Mot de passe',array('type' => 'password','class' => 'input-medium', 'placeholder'=>'Mot de passe'));
		echo $this->helpers['Form']->end(true);
	?>
</div>
