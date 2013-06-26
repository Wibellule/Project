<?php 
$httpHost = $_SERVER["HTTP_HOST"];
if($httpHost == 'localhost' || $httpHost == '127.0.0.1') { $section = 'localhost'; } else { $section = 'online'; }

if(isset($_POST['valid_database_form']) && $_POST['valid_database_form']) {
		
	unset($_POST['valid_database_form']);
	$datas = $_POST; //Création d'une variable contenant les données postées

	require_once(INSTALL_VALIDATE.DS.'database.php'); //Inclusion des règles de validation des champs
	
	//Si pas d'erreur de validation
	if(!isset($formerrors)) {
			
		require_once(INSTALL_FUNCTIONS.DS.'connect.php'); //Inclusion des fonctions de paramétrage de la base de données
		$bddcheck = check_connexion($datas['host'], $datas['login'], $datas['password'], $datas['database']); //On check la connexion à la bdd
		if($bddcheck) {
			require_once(CONFIG_MAGIK.DS.'class.ConfigMagik.php'); //Import de la librairie de gestion des fichiers de configuration
			$cfg = new ConfigMagik(CONFIGS_FILES.DS.'database.ini', true, true); //Création d'une instance, si le fichier database.ini n'existe pas il sera créé
			
			$datas['prefix'] = ""; //Par défaut à vide
			//On va parcourir les données postées et mettre à jour le fichier ini
			foreach($datas as $k => $v) { $cfg->set($k, $v, $section); }
			$cfg->save(); //On sauvegarde le fichier de configuration
		}
	}
}
?>
<form action="index.php?step=connect" method="post">
	<input type="hidden" name="section" value="<?php echo $section; ?>" />
	<div class="alert alert-info"><strong>Attention</strong>, la base de donnée doit être crée avant de tester la connexion</div>
	<?php include(INSTALL_INCLUDE.DS.'database_form.php');?>
</form>