<?php
require_once('bootstrap.php'); //Fichier chargé de loader les librairies et initialiser les constantes 
require_once(INSTALL_FUNCTIONS.DS.'accueil.php');

//03/12/2012 - Si le site est paramétré on ne refait pas l'install
// if(file_exists(CONFIGS_FILES.DS.'installed')) {

	// header("Location: ".Router::url('/', ''));
	// die();
// }

$steps = array(
	'accueil'			=> '- Accueil ',
	'connect'			=> '- Test de la connexion',
	'database' 			=> '- Configuration de la base de données ',
	'import_tables'		=> '- Import des tables de la base de données ',
	'database_datas'	=> '- Import des données ',
	'final'				=> '- Récapitulatif de l\'installation '
);

//Si on récupère la page à afficher dans l'url, par défaut on charge la page de configuration des dossiers
if(!isset($_GET['step'])) { $step = 'accueil'; }
else { $step = $_GET['step']; }

// pr($step);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>.:: Installation <?php echo $steps[$step];?>::.</title>
		<link href="../webroot/css/install/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="../webroot/css/install/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../webroot/css/install/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
		<link href="../webroot/css/install/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
		<link href="../webroot/js/install/js/bootstrap.js" type="javascript" />
		<link href="../webroot/js/install/js/bootstrap.min.js" type="javascript" />
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
              <li <?php echo $step == 'accueil' ? 'class="active"' : '';?>><a>Accueil</a></li>
              <li <?php echo in_array($step, array('database', 'connect', 'import_tables', 'database_datas')) ? 'class="active"' : ''; ?>><a>Base de données</a></li>
              <li <?php echo $step == 'final' ? 'class="active"' : '';?>><a>Récapitulatif</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
			<?php include('pages/'.$step.'.php');?>
          </div>
		  <hr>
		  <footer>
			<p>&copy; Wibellule 2013</p>
		  </footer>
		</div><!--/.fluid-container-->
		<script src="../webroot/js/install/js/jquery.js"></script>
		<script src="../webroot/js/install/js/bootstrap-transition.js"></script>
		<script src="../webroot/js/install/js/bootstrap-alert.js"></script>
		<script src="../webroot/js/install/js/bootstrap-modal.js"></script>
		<script src="../webroot/js/install/js/bootstrap-dropdown.js"></script>
		<script src="../webroot/js/install/js/bootstrap-scrollspy.js"></script>
		<script src="../webroot/js/install/js/bootstrap-tab.js"></script>
		<script src="../webroot/js/install/js/bootstrap-tooltip.js"></script>
		<script src="../webroot/js/install/js/bootstrap-popover.js"></script>
		<script src="../webroot/js/install/js/bootstrap-button.js"></script>
		<script src="../webroot/js/install/js/bootstrap-collapse.js"></script>
		<script src="../webroot/js/install/js/bootstrap-carousel.js"></script>
		<script src="../webroot/js/install/js/bootstrap-typeahead.js"></script>
	</body>
</html>