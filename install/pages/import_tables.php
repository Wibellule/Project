<?php
//On récupère la section de la page précédente
if(isset($_POST['section']) && !empty($_POST['section'])) { 
	
	$section = $_POST['section'];
	unset($_POST['section']);
} else {
	
	$httpHost = $_SERVER["HTTP_HOST"];
	if($httpHost == 'localhost' || $httpHost == '127.0.0.1') { $section = 'localhost';	} else { $section = 'online'; }
}
require_once(CONFIG_MAGIK.DS.'class.ConfigMagik.php'); //Inclusion de la librairie pour la gestion des fichiers de configuration
$cfg = new ConfigMagik(ROOT.DS.'configs'.DS.'database.ini', true, true); //Création d'une instance, si le fichier database.ini n'existe pas il sera créé
$conf = $cfg->keys_values($section);

require_once(INSTALL_FUNCTIONS.DS.'connect.php'); //Inclusion des fonctions de paramétrage de la base de données
$start = 1;
$foffset = 0;
$totalqueries = 0;
$init_db_tables = init_db($conf['host'], $conf['database'], $conf['login'], $conf['password'], "database_tables", $start, $foffset, $totalqueries);

// pr($init_db_tables);
?>
<table class="table table-striped">
	<tr>
		<th id="MatrixItems">&nbsp;</th>
		<th class="tablecol">Session</th>
		<th class="tablecol">Effectué</th>
		<th class="tablecol">Total</th>
	</tr>
	<tr>
		<td class="tableid first">Lignes</td>
		<td class="odd"><?php echo $init_db_tables['datas']['lines_this']; ?></td>
		<td class="even"><?php echo $init_db_tables['datas']['lines_done']; ?></td>
		<td class="odd"><?php echo $init_db_tables['datas']['lines_tota']; ?></td>
	</tr>
	<tr>
		<td class="tableid first">Requêtes</td>
		<td class="odd"><?php echo $init_db_tables['datas']['queries_this']; ?></td>
		<td class="even"><?php echo $init_db_tables['datas']['queries_done']; ?></td>
		<td class="odd"><?php echo $init_db_tables['datas']['queries_tota']; ?></td>
	</tr>
	<tr>
		<td class="tableid first">Volume en Bytes</td>
		<td class="odd"><?php echo $init_db_tables['datas']['bytes_this']; ?></td>
		<td class="even"><?php echo $init_db_tables['datas']['bytes_done']; ?></td>
		<td class="odd"><?php echo $init_db_tables['datas']['bytes_tota']; ?></td>
	</tr>
	<tr>
		<td class="tableid first">Volume en KB</td>
		<td class="odd"><?php echo $init_db_tables['datas']['kbytes_this']; ?></td>
		<td class="even"><?php echo $init_db_tables['datas']['kbytes_done']; ?></td>
		<td class="odd"><?php echo $init_db_tables['datas']['kbytes_tota']; ?></td>
	</tr>
	<tr>
		<td class="tableid first">Volume en MB</td>
		<td class="odd"><?php echo $init_db_tables['datas']['mbytes_this']; ?></td>
		<td class="even"><?php echo $init_db_tables['datas']['mbytes_done']; ?></td>
		<td class="odd"><?php echo $init_db_tables['datas']['mbytes_tota']; ?></td>
	</tr>
	<tr>
		<td class="tableid first">%</td>
		<td class="odd"><?php echo $init_db_tables['datas']['pct_this']; ?></td>
		<td class="even"><?php echo $init_db_tables['datas']['pct_done']; ?></td>
		<td class="odd"><?php echo $init_db_tables['datas']['pct_tota']; ?></td>
	</tr>
	<tr>
		<td class="tableid first">% progression</td>
		<td class="odd" colspan="4"><?php echo $init_db_tables['datas']['pct_bar']; ?></td>
	</tr>
</table>
<form action="index.php?step=import_datas" method="post">
	<input type="hidden" name="section" value="<?php echo $section; ?>" />
	<button class="btn btn-large btn-primary" type="submit">Importer les tables</button></br>
</form>