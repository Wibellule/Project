<?php
function pr($mVar2Display) {

	$debug = debug_backtrace();
	echo '<div class="status info" style="margin-left:250px;width:500px"><p><img src="'.Router::webroot('img/icons/icon_info.png').'" alt="Information" /><span>Information:</span><pre style="background-color: #EBEBEB; border: 1px dashed black; width: 97%; padding: 10px;">';
	print_r($mVar2Display);
	print_r("\n".'[FILE]:'.$debug[0]['file']."\n");
	print_r('[LINE]:'.$debug[0]['line']."\n");
	echo '</pre></div>';
}

function prTab($mVar2Display){
	print_r($mVar2Display);
}
//width:965px

//INCLUSION DES FICHIERS
require('session.php');

//Inclusion de la session
Session::init();

//Helper
require ROOT.DS.'views'.DS.'helpers'.DS.'form.php';

//Librairie CakePHP
require('CakePHP'.DS.'inflector.php');
require('CakePHP'.DS.'set.php');

//Librairie SwiftMailer


//Core
require('router.php');
require ROOT.DS.'configs'.DS.'routes.php';
require('request.php');
require('controller.php');
require(ROOT.DS.'controllers'.DS.'app_controller.php');
require('model.php');
require('dispatcher.php');