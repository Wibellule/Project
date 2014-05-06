<?php
//INCLUSION DES FICHIERS
require('session.php');

//Démarrage de la session
Session::init();

//Librairie File_And_Dir
require(LIBS.DS.'file_and_dir.php');
//Inclusion du fichier de fonctions basics
require('basics.php');

//Helper
require ROOT.DS.'views'.DS.'helpers'.DS.'form.php';

//Librairie CakePHP
require('CakePHP'.DS.'inflector.php');
require('CakePHP'.DS.'set.php');
require('CakePHP'.DS.'hash.php');

//Librairie SwiftMailer


//Events
require(EVENT);
require(EVENT_MANAGER);
require(EVENT_LISTENER);

//Core
require('router.php');

require ROOT.DS.'configs'.DS.'routes.php';
require('request.php');
require('controller.php');
require(ROOT.DS.'controllers'.DS.'app_controller.php');
require('object.php');
require('model.php');
require('class_registry.php');

require('dispatcher.php');
