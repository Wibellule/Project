<?php 
$httpHost = $_SERVER["HTTP_HOST"];
if($httpHost == 'localhost' || $httpHost == '127.0.0.1') { $section = 'localhost'; } else { $section = 'online'; }
?>
<form action="index.php?step=import_datas" method="post">
	<input type="hidden" name="section" value="<?php echo $section; ?>" />
	<button class="btn btn-large btn-primary" type="submit">Importer les tables</button></br>
</form>