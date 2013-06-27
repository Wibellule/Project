<?php 

/**
 * function check_connexion
 * 
 * Cette fonction va permettre d'effectuer un test de connexion à la base de donnée
 *
 * @param	varchar	$host		Adresse du serveur
 * @param	varchar	$login		Login de connexion à la base de données
 * @param	varchar	$password	Mot de passe de connexion à la base de données
 * @param	varchar	$database	Nom de la base de données
 * @access 	public
 * @author 	koéZionCMS
 * @version 0.1 - 16/03/2012 by FI
 * @version 0.2 - 31/07/2012 by FI - Suppression de la création de la base de données car fonctionnement aléatoire selon les hébergeurs
 */	
	function check_connexion($host, $login, $password, $database) {
		
		$dbconnection = @mysql_connect($host, $login, $password); //Connexion au serveur mysql
		if($dbconnection) { //Si la connexion s'est correctement déroulée
		
			//Vérification de l'existence de la bdd
			//$result = mysql_query("SHOW DATABASES", $dbconnection);
			//while($ligne = mysql_fetch_row($result)) { //Parcours des BDD
		
				//$exists = false; //Par défaut elle n'existe pas
				//if($ligne[0] == $database) { $exists = true; } //Si on la trouve dans la liste on change le booleen
		
				//Si elle n'existe pas on va la créer
				//if(!$exists) { @mysql_query("CREATE DATABASE ".$database, $dbconnection); }
		
				$db = mysql_select_db($database);
				$bBddConnect = $dbconnection && $db; //Booléen qui va contrôler que la connexion et la sélection de la base se sont bien déroulées
				if(!$bBddConnect) { $dbconnection = false; } //Si tout ne s'est pas correctement déroulé on initialise le booléen à faux
				return $dbconnection; //On retourne le booléen
			//}
		} else { return false; }
	}

/**
 * function init_db
 * 
 * Cette fonction va permettre à l'initialisation des tables et des données de la base
 *
 * @param	varchar	$db_host		Adresse du serveur
 * @param	varchar	$db_name		Nom de la base de données
 * @param	varchar	$db_username	Login de connexion à la base de données
 * @param	varchar	$db_password	Mot de passe de connexion à la base de données
 * @param	varchar	$file			Fichier à importer
 * @param	integer	$start			
 * @param	integer	$foffset		
 * @param	integer	$totalqueries	
 * @access 	public
 * @author 	koéZionCMS
 * @version 0.1 - 16/03/2012 by FI
 * @version 0.2 - 31/07/2012 by FI - Rajout du nom du fichier à importer
 * @see http://www.ozerov.de/bigdump/
 */		
	function init_db($db_host, $db_name, $db_username, $db_password, $file, $start, $foffset, $totalqueries) {
				
		$filename           = INSTALL_FILES.DS.$file.'.sql';  	//Chemin vers le fichier d'initialisation
		$linespersession    = 50000;   							//Nombre de lignes maximum à importer
		
		//Allowed comment markers: lines starting with these strings will be ignored by BigDump
		$comment[]='#';                       // Standard comment lines are dropped by default
		$comment[]='-- ';
		$comment[]='DELIMITER';               // Ignore DELIMITER switch as it's not a valid SQL statement
		// $comment[]='---';                  // Uncomment this line if using proprietary dump created by outdated mysqldump
		// $comment[]='CREATE DATABASE';      // Uncomment this line if your dump contains create database queries in order to ignore them
		$comment[]='/*!';                     // Or add your own string to leave out other proprietary things
		
		//Connection charset should be the same as the dump file charset (utf8, latin1, cp1251, koi8r etc.)
		//See http://dev.mysql.com/doc/refman/5.0/en/charset-charsets.html for the full list
		//Change this if you have problems with non-latin letters
		$db_connection_charset = 'utf8';
		
		//Default query delimiter: this character at the line end tells Bigdump where a SQL statement ends
		//Can be changed by DELIMITER statement in the dump file (normally used when defining procedures/functions)
		$delimiter = ';';
		
		//String quotes character
		$string_quotes = '\'';                  // Change to '"' if your dump file uses double qoutes for strings
		
		$DATA_CHUNK_LENGTH = 16384;  // How many chars are read per time
		$MAX_QUERY_LINES = 300;      // How many lines may be considered to be one query (except text lines)
		
		@ini_set('auto_detect_line_endings', true);
		@set_time_limit(0);
		
		if(function_exists("date_default_timezone_set") && function_exists("date_default_timezone_get")) @date_default_timezone_set(@date_default_timezone_get());
		
		//Clean and strip anything we don't want from user's input [0.27b]
		/*if(isset($this->data['Install'])) {
			
			foreach($this->data['Install'] as $key => $val) {
			
				$val = preg_replace("/[^_A-Za-z0-9-\.&= ;\$]/i", '', $val);
				$this->data['Install'][$key] = $val;
			}
		}*/
		
		$aErrors = array(); //Liste des erreurs
		$file  = false;
		
		//Check PHP version
		if(count($aErrors) == 0 && !function_exists('version_compare')) { 
			
			$aErrors[] = "PHP version 4.1.0 is required to proceed. You have PHP ".utf8_encode(phpversion())." installed.";
		}
		
		//Check if mysql extension is available
		if(count($aErrors) == 0 && !function_exists('mysql_connect')) { 
		
			$aErrors[] = "There is no mySQL extension available in your PHP installation. Sorry!";
		}
		
		//Calculate PHP max upload size (handle settings like 10M or 100K)
		if(count($aErrors) == 0) { 
		
			$upload_max_filesize = ini_get("upload_max_filesize");
			if(preg_match("/([0-9]+)K/i", $upload_max_filesize, $tempregs)) $upload_max_filesize = $tempregs[1] * 1024;
			if(preg_match("/([0-9]+)M/i", $upload_max_filesize, $tempregs)) $upload_max_filesize = $tempregs[1] * 1024 * 1024;
			if(preg_match("/([0-9]+)G/i", $upload_max_filesize, $tempregs)) $upload_max_filesize = $tempregs[1] * 1024 * 1024 * 1024;
		}
		
		//Connect to the database
		if(count($aErrors) == 0) { $dbconnection = check_connexion($db_host, $db_username, $db_password, $db_name); }
		else { $dbconnection = false; }
		
		if(!$dbconnection) $aErrors[] = "Database connection failed due to ".utf8_encode(mysql_error());

		//set charset
		if(count($aErrors) == 0 && $db_connection_charset !== '') @mysql_query("SET NAMES $db_connection_charset", $dbconnection);
		
		//Open the file
		if(count($aErrors) == 0 && isset($start)) { 
		
			$curfilename = $filename; 
		
			//Recognize GZip filename
			if(preg_match("/\.gz$/i", $curfilename)) { $gzipmode = true; }
			else { $gzipmode = false; }
		
			if(
				(!$gzipmode && !$file = @fopen($curfilename, "r")) 
				|| 
				($gzipmode && !$file = @gzopen($curfilename, "r"))
			) { 
				
				$aErrors[] = "Can't open ".$curfilename." for import";
			}
		
			//Get the file size (can't do it fast on gzipped files, no idea how)
			else if(
				(!$gzipmode && @fseek($file, 0, SEEK_END) == 0) 
				|| 
				($gzipmode && @gzseek($file, 0) == 0)
			) { 
			
				if(!$gzipmode) $filesize = ftell($file);
				else $filesize = gztell($file); //Always zero, ignore
			}
			else { 
			
				$aErrors[] = "I can't seek into $curfilename";
			}
		}
		
		// *******************************************************************************************
		// START IMPORT SESSION HERE
		// *******************************************************************************************
		if(count($aErrors) == 0 && isset($start) && isset($foffset) && preg_match("/(\.(sql|gz|csv))$/i", $curfilename)) {
		
			//Check start and foffset are numeric values
			if(!is_numeric($start) || !is_numeric($foffset)) {
		
				$aErrors[] = "UNEXPECTED: Non-numeric values for start and foffset";
			} else {
				
				$start   = floor($start);
				$foffset = floor($foffset);
			}
			
			//Set the current delimiter if defined
			if(isset($delimiter)) $delimiter = $delimiter;
		
			//Check $foffset upon $filesize (can't do it on gzipped files)
			if(count($aErrors) == 0 && !$gzipmode && $foffset > $filesize) { 
			
				$aErrors[] = "UNEXPECTED: Can't set file pointer behind the end of file";
			}
		
			//Set file pointer to $foffset
			if(
				count($aErrors) == 0 && 
				((!$gzipmode && fseek($file, $foffset) != 0) || 
				($gzipmode && gzseek($file, $foffset) != 0))
			) { 
				
				$aErrors[] = "UNEXPECTED: Can't set file pointer to offset: ".$foffset;
			}
		
			//Start processing queries from $file
			if(count($aErrors) == 0) { 
				
				$query = "";
				$queries = 0;
				$totalqueries = $totalqueries;
				$linenumber = $start;
				$querylines = 0;
				$inparents = false;
				
				//Stay processing as long as the $linespersession is not reached or the query is still incomplete
				while($linenumber < $start + $linespersession || $query != "") {
				
					//Read the whole next line
					$dumpline = "";
					while(!feof($file) && substr($dumpline, -1) != "\n" && substr($dumpline, -1) != "\r") { 
					
						if(!$gzipmode) $dumpline .= fgets($file, $DATA_CHUNK_LENGTH);
						else $dumpline .= gzgets($file, $DATA_CHUNK_LENGTH);
					}
					
					if($dumpline === "") break;
					
					//Remove UTF8 Byte Order Mark at the file beginning if any
					if($foffset == 0) $dumpline=preg_replace('|^\xEF\xBB\xBF|', '', $dumpline);
		
					//Handle DOS and Mac encoded linebreaks (I don't know if it really works on Win32 or Mac Servers)
					$dumpline = str_replace("\r\n", "\n", $dumpline);
					$dumpline = str_replace("\r", "\n", $dumpline);
		            
					//DIAGNOSTIC
					//echo ("<p>Line $linenumber: $dumpline</p>\n");
		
					//Recognize delimiter statement
					if(!$inparents && strpos($dumpline, "DELIMITER ") === 0) $delimiter = str_replace("DELIMITER ", "", trim($dumpline));
					
					//Skip comments and blank lines only if NOT in parents
					if(!$inparents) { 
			  
						$skipline = false;
						reset($comment);
						foreach($comment as $comment_value) { 
						
							//DIAGNOSTIC
							//echo ($comment_value);
							if(trim($dumpline) == "" || strpos(trim($dumpline), $comment_value) === 0) { 
								
								$skipline = true;
								break;
							}
						}
						
						if($skipline) { 
						
							$linenumber++;
							//DIAGNOSTIC
							//echo ("<p>Comment line skipped</p>\n");
							continue;
						}
					}
					
					//Remove double back-slashes from the dumpline prior to count the quotes ('\\' can only be within strings)
					$dumpline_deslashed = str_replace("\\\\", "", $dumpline);
					
					//Count ' and \' (or " and \") in the dumpline to avoid query break within a text field ending by $delimiter
					$parents = substr_count($dumpline_deslashed, $string_quotes) - substr_count($dumpline_deslashed, "\\$string_quotes");
					if($parents % 2 != 0) $inparents=!$inparents;
					
					//Add the line to query
					$query .= $dumpline;
		
					//Don't count the line if in parents (text fields may include unlimited linebreaks)
					if(!$inparents) $querylines++;
		      
					//Stop if query contains more lines as defined by $MAX_QUERY_LINES
					if($querylines > $MAX_QUERY_LINES) {
						
						$aErrors[] = "Stopped at the line $linenumber. At this place the current query includes more than ".$MAX_QUERY_LINES." dump lines. That can happen if your dump file was ";
						break;
					}
		
					//Execute query if end of query detected ($delimiter as last character) AND NOT in parents
					//DIAGNOSTIC
					//echo ("<p>Regex: ".'/'.preg_quote($delimiter).'$/'."</p>\n");
					//echo ("<p>In Parents: ".($inparents?"true":"false")."</p>\n");
					//echo ("<p>Line: $dumpline</p>\n");
					if(preg_match('/'.preg_quote($delimiter).'$/',trim($dumpline)) && !$inparents) { 
					
						//Cut off delimiter of the end of the query
						$query = substr(trim($query), 0, -1 * strlen($delimiter));
						
						//DIAGNOSTIC
						//echo ("<p>Query: ".trim(nl2br(htmlentities($query)))."</p>\n");
						
						if(!mysql_query($query, $dbconnection)) { 
							
							$aErrors[] = array(
								'message' => "Error at the line $linenumber: ". trim($dumpline)." - MySQL: ".mysql_error(),
								'query' => "Query: ".trim(nl2br(htmlentities($query)))
							);
							break;
						}
						
						$totalqueries++;
						$queries++;
						$query = "";
						$querylines = 0;
					}
					
					$linenumber++;
				}
			}
		
			//Get the current file position
			if(count($aErrors) == 0) { 
			
				if(!$gzipmode) $foffset = ftell($file);
				else $foffset = gztell($file);
				
				if(!$foffset) { 
				
					$aErrors[] = "UNEXPECTED: Can't read the file pointer offset";
				}
			}
		
			//Print statistics
			if(count($aErrors) == 0) { 
		    
				$lines_this   = $linenumber - $start;
				$lines_done   = $linenumber-1;
				$lines_togo   = ' ? ';
				$lines_tota   = ' ? ';
		    
				$queries_this = $queries;
				$queries_done = $totalqueries;
				$queries_togo = ' ? ';
				$queries_tota = ' ? ';
		
				$bytes_this   = $foffset - $foffset;
				$bytes_done   = $foffset;
				$kbytes_this  = round($bytes_this / 1024, 2);
				$kbytes_done  = round($bytes_done / 1024, 2);
				$mbytes_this  = round($kbytes_this / 1024, 2);
				$mbytes_done  = round($kbytes_done / 1024, 2);
		   
				if(!$gzipmode) {
					
					$bytes_togo  = $filesize - $foffset;
					$bytes_tota  = $filesize;
					$kbytes_togo = round($bytes_togo / 1024, 2);
					$kbytes_tota = round($bytes_tota / 1024, 2);
					$mbytes_togo = round($kbytes_togo / 1024, 2);
					$mbytes_tota = round($kbytes_tota / 1024, 2);
		      
					$pct_this   = ceil($bytes_this / $filesize * 100);
					$pct_done   = ceil($foffset / $filesize * 100);
					$pct_togo   = 100 - $pct_done;
					$pct_tota   = 100;
		
					if($bytes_togo == 0) { 
						
						$lines_togo   = '0'; 
						$lines_tota   = $linenumber - 1; 
						$queries_togo = '0'; 
						$queries_tota = $totalqueries; 
					}
					
					$pct_bar  = '<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>';
				} else {
					
					$bytes_togo  = ' ? ';
					$bytes_tota  = ' ? ';
					$kbytes_togo = ' ? ';
					$kbytes_tota = ' ? ';
					$mbytes_togo = ' ? ';
					$mbytes_tota = ' ? ';
		
					$pct_this    = ' ? ';
					$pct_done    = ' ? ';
					$pct_togo    = ' ? ';
					$pct_tota    = 100;
					$pct_bar     = str_replace(' ', '&nbsp;', '<tt>[         Not available for gzipped files          ]</tt>');
				}
				
				$sucess['message'] = "La création de la base de données s'est correctement déroulée.";
				$sucess['lines_this'] = $lines_this;
				$sucess['lines_done'] = $lines_done;
				$sucess['lines_togo'] = $lines_togo;
				$sucess['lines_tota'] = $lines_tota;
				$sucess['queries_this'] = $queries_this;
				$sucess['queries_done'] = $queries_done;
				$sucess['queries_togo'] = $queries_togo;
				$sucess['queries_tota'] = $queries_tota;
				$sucess['bytes_this'] = $bytes_this;
				$sucess['bytes_done'] = $bytes_done;
				$sucess['bytes_togo'] = $bytes_togo;
				$sucess['bytes_tota'] = $bytes_tota;
				$sucess['kbytes_this'] = $kbytes_this;
				$sucess['kbytes_done'] = $kbytes_done;
				$sucess['kbytes_togo'] = $kbytes_togo;
				$sucess['kbytes_tota'] = $kbytes_tota;
				$sucess['mbytes_this'] = $mbytes_this;
				$sucess['mbytes_done'] = $mbytes_done;
				$sucess['mbytes_togo'] = $mbytes_togo;
				$sucess['mbytes_tota'] = $mbytes_tota;
				$sucess['pct_this'] = $pct_this;
				$sucess['pct_done'] = $pct_done;
				$sucess['pct_togo'] = $pct_togo;
				$sucess['pct_tota'] = $pct_tota;
				$sucess['pct_bar'] = $pct_bar;
				
				$result = array(
					'result' => true,
					'datas' => $sucess
				);				
			} else {
			
				$result = array(
					'result' => false,
					'datas' => $aErrors
				);
			}
		} else { 
			
			$result = array(
				'result' => false,
				'datas' => $aErrors		
			); 
		}
		
		if ($dbconnection) mysql_close($dbconnection);
		if ($file && !$gzipmode) fclose($file);
		else if ($file && $gzipmode) gzclose($file);
		
		return $result;
	}