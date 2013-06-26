<form class="form-horizontal" action="index.php?step=connect" method="post">
	<input type="hidden" value="1" name="valid_database_form" />
	<input type="hidden" value="<?php echo isset($datas['section']) ? $datas['section'] : $section ?>" name="section" />
	<fieldset>
		<?php if(isset($formerrors['host']) && !empty($formerrors['host'])) { ?>
			<div class="control-group error">
			  <label class="control-label" for="inputHost">DataBase Host Name</label>
			  <div class="controls">
				<input type="text" id="inputHost" name="host" value="<?php if(isset($_POST['host'])){ echo $_POST['host']; }?>">
				<span class="help-inline">Caractères incorrectes</span>
			  </div>
			</div>
		<?php }else{ ?>
			<div class="control-group">
				<label class="control-label" for="inputHost">DataBase Host Name</label>
				<div class="controls">
					<input type="text" id="inputHost" name="host" value="" placeholder="DataBase Host Name">
				</div>
			</div>
		<?php } ?>
		<?php if(isset($formerrors['login']) && !empty($formerrors['login'])){?>
			<div class="control-group error">
			  <label class="control-label" for="inputUser">DataBase Username</label>
			  <div class="controls">
				<input type="text" id="inputUser" name="login" value="<?php if(isset($_POST['login'])){ echo $_POST['login']; }?>">
				<span class="help-inline">Caractères incorrectes</span>
			  </div>
			</div>
		<?php }else{ ?>
			<div class="control-group">
				<label class="control-label" for="inputUser">DataBase Username</label>
				<div class="controls">
					<input type="text" id="inputUser" name="login" value="" placeholder="Database Username">
				</div>
			</div>
		<?php } ?>
		<div class="control-group">
			<label class="control-label" for="inputPassword">DataBase Password</label>
			<div class="controls">
			<input type="password" id="inputPassword" name="password" value="" placeholder="Database Password">
			</div>
		</div>
		<?php if(isset($formerrors['database']) && !empty($formerrors['database'])){?>
			<div class="control-group error">
			  <label class="control-label" for="inputName">DataBase Username</label>
			  <div class="controls">
				<input type="text" id="inputName" name="database" value="<?php if(isset($_POST['database'])){ echo $_POST['database']; }?>">
				<span class="help-inline">Caractères incorrectes</span>
			  </div>
			</div>
		<?php }else{ ?>
			<div class="control-group">
				<label class="control-label" for="inputName">DataBase Name</label>
				<div class="controls">
					<input type="text" id="inputName" name="database" value="" placeholder="Database Name">
				</div>
			</div>
		<?php } ?>
		<div class="control-group">
			<button class="btn btn-large btn-primary" type="submit">Tester la connexion de la base</button>
		</div>
	</fieldset>
</form>