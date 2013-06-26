<?php
//On récupère la section de la page précédente
if(isset($_POST['section']) && !empty($_POST['section'])) { 
	
	$section = $_POST['section'];
	unset($_POST['section']);
} else {
	
	$httpHost = $_SERVER["HTTP_HOST"];
	if($httpHost == 'localhost' || $httpHost == '127.0.0.1') { $section = 'localhost';	} else { $section = 'online'; }
}
?>
<h2>Configuration de la base de données</h2>
