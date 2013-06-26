<form class="form-horizontal" action="index.php?step=connect" method="post">
	<input type="hidden" value="1" name="valid_database_form" />
	<input type="hidden" value="<?php echo isset($datas['section']) ? $datas['section'] : $section ?>" name="section" />
	<fieldset>
		<div class="control-group">
			<?php if(isset($formerrors['host']) && !empty($formerrors['host'])) { ?>
				<label class="control-label" for="inputHost">Input with error</label>
			<?php }else{?>
				<label class="control-label" for="inputHost">DataBase Host Name</label>
			<?php } ?>
			<div class="controls">
			<input type="text" id="inputHost" placeholder="DataBase Host Name">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputUser">DataBase Username</label>
			<div class="controls">
			<input type="text" id="inputUser" placeholder="Database Username">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">DataBase Password</label>
			<div class="controls">
			<input type="password" id="inputPassword" placeholder="Database Password">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputName">DataBase Name</label>
			<div class="controls">
			<input type="text" id="inputName" placeholder="Database Name">
			</div>
		</div>
		<div class="control-group">
			<button class="btn btn-large btn-primary" type="submit">Tester la connexion de la base</button>
		</div>
	</fieldset>
</form>