<?php
/* Définition des constantes */
define('DS', DIRECTORY_SEPARATOR);//Définition du séparateur dans le cas ou l'on est sur windows ou linux
define('ROOT', dirname(dirname(__FILE__))); 
/* Constantes de la procedure d'installation */
define('INSTALL_FILES', ROOT.DS.'install'.DS.'files'); 			//Chemin vers les fichiers de configuration
define('INSTALL_FUNCTIONS', ROOT.DS.'install'.DS.'functions'); 	//Chemin vers les fichiers contenants les fonctions
define('INSTALL_INCLUDE', ROOT.DS.'install'.DS.'include'); 		//Chemin vers les fichiers include de configuration
define('INSTALL_VALIDATE', ROOT.DS.'install'.DS.'validate'); 	//Chemin vers les fichiers de validation
define('CONFIG_MAGIK', ROOT.DS.'core'.DS.'ConfigMagik'); 	//Chemin vers les fichiers de validation
//********************  CODE FRANÇOIS  ***************************//
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

/* Inclusion des fichiers */
require_once(ROOT.DS.'core'.DS.'basics.php');
require_once(ROOT.DS.'core'.DS.'router.php');