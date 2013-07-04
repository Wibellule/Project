<?php 
	$messageFlash = Session::read('Flash');
		if($messageFlash){
			echo "<div class='alert alert-".Session::read('Flash.type')."'>";
			echo Session::read('Flash.message').'</div>';
		}
	Session::delete('Flash');
?>
<div class="page-header">
	<h1>Zone réservée</h1>
</div>
	<?php
		echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('users/login'), 'class' => 'form-horizontal'));
		echo $this->helpers['Form']->input('login', 'Login',array('class' => 'input-medium','placeholder' => 'Login'));
		echo $this->helpers['Form']->input('mdp', 'Mot de passe',array('type' => 'password','class' => 'input-medium', 'placeholder'=>'Mot de passe'));
		echo $this->helpers['Form']->end(true);
	?>
<div class="container">
	<div class="login">
		<div class="login-screen">
			<div class="login-icon">
				<img src="<?php echo Router::webroot('css/backoffice/images/login/icon.png');?>" alt="Welcome to Mail App" />
				<h4>Welcome to <small>Mail App</small></h4>
			</div>
			<?php echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('users/login'), 'class' => 'form-horizontal'));?>
			<div class="login-form">
				<div class="control-group">
					<input type="text" class="login-field" value="" placeholder="Enter your name" id="login-name" />
					<label class="login-field-icon fui-man-16" for="login-name"></label>
				</div>

				<div class="control-group">
					<input type="password" class="login-field" value="" placeholder="Password" id="login-pass" />
					<label class="login-field-icon fui-lock-16" for="login-pass"></label>
				</div>

				<a class="btn btn-primary btn-large btn-block" href="#">Login</a>
				<!--<a class="login-link" href="#">Lost your password?</a>-->
			</div>
			<?php echo $this->helpers['Form']->end(false);?>
		</div>
	</div>
</div>
