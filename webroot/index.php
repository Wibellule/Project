<?php
// $debut = microtime(true);
////////////////////////////////////////////////////////////
//   DEFINITION DES VARIABLES GLOBALES DE L'APPLICATION   //
////////////////////////////////////////////////////////////
define('DS', DIRECTORY_SEPARATOR); //Définition du séparateur dans le cas ou l'on est sur windows ou linux
define('WEBROOT', dirname(__FILE__)); //Chemin absolu vers le dossier webroot
define('ROOT', dirname(WEBROOT)); //Chemin absolu vers le dossier racine du site
define('CORE', ROOT.DS.'core'); //Chemin relatif vers le coeur de l'application
define('BEHAVIORS', ROOT.DS.'models'.DS.'behaviors'); //Chemin relatif vers les comportements d'un model
define('COMPONENTS', ROOT.DS.'controllers'.DS.'components'); //Chemin relatif vers les composants des controllers


// define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME']))); //
//********************  CODE FRANçOIS  ***************************//
//Mise en place du chemin relatif pour pouvoir fonctionner dans les sous dossiers
$baseUrl = '';
$scriptPath = preg_split("#[\\\\/]#", dirname(__FILE__), -1, PREG_SPLIT_NO_EMPTY);
$urlPath = preg_split("#[\\\\/]#", $_SERVER['REQUEST_URI'], -1, PREG_SPLIT_NO_EMPTY);

foreach($urlPath as $k => $v) {
	
	$key = array_search($v, $scriptPath);
	if($key !== false) $baseUrl .= "/".$v;
}
define('BASE_URL', $baseUrl); //Chemin relatif vers le coeur de l'application
//****************************************************************//


define('HELPERS', ROOT.DS.'views'.DS.'helpers');//Acces aux helpers
define('ELEMENTS', ROOT.DS.'views'.DS.'elements');//Acces aux elements
define('BACKOFFICE', ROOT.DS.'views'.DS.'elements'.DS.'backoffice');//Acces aux elements du backoffice
define('FRONTOFFICE', ROOT.DS.'views'.DS.'elements'.DS.'frontoffice');//Acces aux elements du frontoffice
define('SWIFTMAILER', CORE.DS.'SwiftMailer'); //Chemin vers les librairies de SwiftMailer


define('EVENT', CORE.DS.'Event'.DS.'event.php'); //Chemin vers l'event
define('EVENT_MANAGER', CORE.DS.'Event'.DS.'event_manager.php'); //Chemin vers l'event_manager
define('EVENT_LISTENER', CORE.DS.'Event'.DS.'event_listener.php'); //Chemin vers l'event_listener


require(CORE.DS.'includes.php');
$dispatcher = new Dispatcher();

// pr($scriptPath);
// pr($urlPath);
// pr($baseUrl);

?>
<!--<div style="position:fixed;bottom:0; background:#900;color:#FFF;
line-height:30px;height:30px;left:0;right:0;padding-left:10px;">
<?php //echo 'Page g&eacute;n&eacute;r&eacute;e en : '.round(microtime(true) - $debut,5).' secondes';?>
</div>-->
<?php //var_dump($_SERVER);?>
