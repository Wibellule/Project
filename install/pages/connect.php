<?php 
$httpHost = $_SERVER["HTTP_HOST"];
if($httpHost == 'localhost' || $httpHost == '127.0.0.1') { $section = 'localhost'; } else { $section = 'online'; }
?>
<form action="index.php?step=database" method="post">
	<input type="hidden" name="section" value="<?php echo $section; ?>" />
	<div class="alert alert-info"><strong>Attention</strong>, la base de donnée doit être crée avant de tester la connexion</div>
	<button class="btn btn-large btn-primary" type="submit">Tester la connexion de la base</button></br>
</form>