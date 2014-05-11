<?php
/**
 * Classe de gestion de fichiers locaux et distants.
 */
class FileAndDir {

/**
 * Crée une arborescence (vérifie son existence) en fonction du chemin indiqué
 */
	function createPath($path, $mod = 0777) {
		
		$path_pieces = explode(DS, $path);
		$path = '';

		while(!is_null($piece = array_shift($path_pieces))) {
			
			$path .= $piece.DS;
			if(!is_dir($path)) { FileAndDir::createDirectory($path, $mod); }
		}
	}

/**
 * Crée un répertoire à l'endroit spécifié.
 * @param   string  $path    Dossier à créer.
 * @param   int     $mod     Nouveaux droits du fichier (en octal). Exemple : 0777
 */
	function createDirectory($path, $mod) {
		
		umask(0);
		mkdir($path, $mod);
	}

/**
 * Vérifie l'existence du fichier.
 * @return  bool Retourne true si le fichier existe, false le cas contraire.
 */
	function fexists($path) {
		
		clearstatcache();
		return file_exists($path);
	}

/**
 * Vérifie l'existence du dossier.
 * @return  bool Retourne true si le dossier existe, false le cas contraire.
 */
	function dexists($path) {
		
		clearstatcache();
		return is_dir($path);
	}

/**
 * Vérifie l'existence du dossier.
 * @return  bool Retourne true si le dossier existe, false le cas contraire.
 */
	function dwritable($path) {
		
		clearstatcache();
		return is_writable($path);
	}

/**
 * Modifie les droits d'un fichier.
 * @param int $mod Nouveaux droits du fichier (en octal). Exemple : 0777
 */
	function chProperties($path, $mod) {
		
		umask(0);
		chmod($path, $mod);
	}

/**
 * Supprime le fichier.
 * @return  bool Retourne true si le fichier a pu être supprimé, false sinon.
 */
	function remove($path) {
		
		if(file_exists($path)) { return unlink($path); }
		else { return false; }
	}
	
	static function fcopy($source, $dest) {
		
		return copy($source, $dest);
	}
	
	
	
	function directoryContent($directory) {
				
		$files = array();
		$dir = opendir($directory);
		
		while($file = readdir($dir)) {
			
			if($file != '.' && $file != '..' && $file != 'empty' && !is_dir($directory.$file)) {
				
				//$directory.$file
				$files[] = $file;
			}
		}		
		closedir($dir);
		return $files;
	}	
	
	function remove_directory($chemin) {
			
		// vérifie si le nom du repertoire contient "/" à la fin
		// place le pointeur en fin d'url
		if($chemin[strlen($chemin)-1] != DS) { $chemin .= DS; } // rajoute '/'
	
		if(is_dir($chemin)) {
			$sq = opendir($chemin); // lecture
			while($f = readdir($sq)) {
				if($f != '.' && $f != '..') {
					$fichier = $chemin.$f; // chemin fichier
					if (is_dir($fichier)) {
						
						FileAndDir::remove_directory($fichier); // rapel la fonction de manière récursive
					} else {
						
						unlink($fichier);
					} // sup le fichier
				}
			}
			closedir($sq);
			rmdir($chemin); // sup le répertoire
		}
		elseif(is_file($chemin)) { 
			
			unlink($chemin);  // sup le fichier
		}
	}
	
	function delete_directory_file($dir) {
		
		foreach(FileAndDir::directoryContent($dir) as $file) { unlink($dir.$file); } //On supprime le fichier
	}

	
	
	/**
	 * Renvoie le contenu du fichier s'il existe, un message d'erreur sinon.
	 * @author  Josselin Willette
	 * @param   string    $type     Type de contenu à retourner (string (valeur par défaut), array) (facultatif).
	 * @param   string    $retour   Langage de retour dans le cas d'une erreur (facultatif).
	 * @param   int       $offset   Position à laquelle on commence à lire (facultatif).
	 * @param   int       $maxlen   Taille maximale d'octets (facultatif).
	 * @return  mixed               Contenu sous la forme du type passé en paramètre.
	 */
	public function get($filename, $type = 'string', $retour = '', $offset = null, $maxlen = null ) {
		//try {
			//FileAndDir::testURI($filename);

		$contents = '';
		if(file_exists($filename)) {

			//pr($filename);
			$contents = file_get_contents($filename);
			
		}
		
			/*$contents = '';
			if(file_exists($filename)) {
				switch ( $type )
				{
					case 'array'  :
						if ( is_null( $maxlen ) ) {
							$contents = explode( "\n", file_get_contents( $filename, null, null, $offset ) );
						}
						else {
							$contents = explode( "\n", file_get_contents( $filename, null, null, $offset, $maxlen ) );
						}
						break;
	
					case 'string' :
					default       :
						if ( is_null( $maxlen ) ) {
							$contents = file_get_contents( $filename, null, null, $offset );
						}
						else {
							$contents = file_get_contents( $filename, null, null, $offset, $maxlen );
						}
						break;
				}
			}*/
		//}
		//catch ( Exception $e ) {
		//	switch ( strtolower( $retour ) )
		//	{
		//		case 'css'    :
		//		case 'js'     :
					//$contents = '/* ' . $e->getMessage() . ' */';
		//			break;

		//		case 'html'   :
		//		case 'xml'    :
		//			$contents = '<!-- ' . $e->getMessage() . ' -->';
		//			break;

		//		default       :
		//			$contents = $e->getMessage();
		//		break;
		//	}
		//}

		return $contents;
	}

	/**
	 * Ecrit le contenu passé en paramètre dans un fichier.
	 * @author  Josselin Willette
	 * @param   string    $content    Contenu à écrire.
	 * @param   int       $append     Précise si on écrase le fichier ou si on écrit à la fin (0 par défaut : écrase) (facultatif).
	 * @return  bool                  Retourne true en cas de succès et false en cas d'échec.
	 */
	public function put($filename, $content, $append = 0 ) {
		

		try {
			
			if (!file_put_contents( $filename, $content, $append)) {
				$message = error_get_last();
				$message = $message['message'];
				throw new Exception( 'Impossible d\'écrire dans ' . $filename . "\n" . $message );
			}

			return true;
		}
		catch ( Exception $e ) {
			return false;
		}
	}

	/**
	 * Teste si une URI est bonne et lance une exception dans le cas contraire.
	 * @author  Josselin Willette
	 */
	/*public function testURI($filename)
	{
		if ( !@fopen( $filename, 'r' ) )
		{
			$message = error_get_last();
			$message = $message['message'];
			throw new Exception( 'Impossible d\'ouvrir ' . $filename . "\n" . $message );
		}
	}*/

	/**
	 * Vérifie la validité d'un fichier en fonction d'une durée passée en paramètre.
	 * @author  Josselin Willette
	 * @param   int   $dureeValidite    Durée de validité du fichier, en secondes.
	 * @return  bool                    Retourne true si le fichier est encore valide, false sinon.
	 */
	/*public function valid($filename, $dureeValidite )
	{
		clearstatcache();
		return time() - filemtime( $filename ) < $dureeValidite;
	}*/

	/**
	 * Renvoie la taille du fichier.
	 * @author  Josselin Willette
	 * @return  int                    Retourne la taille du fichier.
	 */
	/*public function size($filename)
	{
		return filesize( $filename );
	}*/

	/**
	 * Renomme le fichier.
	 * @author  Josselin Willette
	 * @param   string    $newName  Nouveau nom du fichier.
	 * @param   bool      $change   Change le nom du fichier de l'objet courant.
	 * @return  bool                Retourne true si le fichier a pu être renommé, false sinon.
	 */
	/*public function rename($filename, $newName, $change = false )
	{
		$o = rename( $filename, $newName );

		if ( $change == true ) {
			$filename = $newName;
		}

		return $o;
	}*/

}
