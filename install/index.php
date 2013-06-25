<?php
require_once('bootstrap.php'); //Fichier chargé de loader les librairies et initialiser les constantes 

//03/12/2012 - Si le site est paramétré on ne refait pas l'install
// if(file_exists(CONFIGS_FILES.DS.'installed')) {

	// header("Location: ".Router::url('/', ''));
	// die();
// }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../webroot/css/install/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="../webroot/css/install/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../webroot/css/install/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
		<link href="../webroot/css/install/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
		  body {
			padding-top: 60px;
			padding-bottom: 40px;
		  }
		  .sidebar-nav {
			padding: 9px 0;
		  }

		  @media (max-width: 980px) {
			/* Enable use of floated navbar text */
			.navbar-text.pull-right {
			  float: none;
			  padding-left: 5px;
			  padding-right: 5px;
			}
		  }
		</style>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="brand" href="#">Procédure d'installation</a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Étapes</li>
              <li class="active"><a>Accueil</a></li>
              <li><a>Base de données</a></li>
              <li><a>Récapitulatif</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <h1>Bienvenue dans le module d'installation</h1>
            <p></p>
            <p><a href="#" class="btn btn-primary btn-large">Commencer &raquo;</a></p>
          </div>
		  <hr>
		  <footer>
			<p>&copy; Wibellule 2013</p>
		  </footer>
		</div><!--/.fluid-container-->
	</body>
</html>