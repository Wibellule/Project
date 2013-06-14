<?php
class Model{

	public $conf = 'localhost';
	public $db;
	public $table = false;
	public $primaryKey = 'id';
	static $connections = array();

	public function __construct(){
		// require ROOT.DS.'configs'.DS.'database.php';
		require_once ROOT.DS.'core'.DS.'ConfigMagik'.DS.'class.ConfigMagik.php';
		$config = new ConfigMagik( ROOT.DS.'configs'.DS.'database.ini', true, true);
		
		//Test si une configuration de type localhost ou non, et charge la bonne section du database.ini
		$httpHost = $_SERVER["HTTP_HOST"];
		if($httpHost == 'localhost' || $httpHost == '127.0.0.1') { $section = 'localhost'; } else { $section = 'online'; }
		//Charge la bonne section
		$conf = $config->get($section);
		
		//Si le nom de la table n'est pas défini on va l'initialiser automatiquement
		if($this->table === false){
			$tableName = strtolower(get_class($this)).'s';//Mise en variable du nom de la table
			$this->table = $tableName;//Affectation de la variable de classe
		}
		$this->dbName = $conf['database'];
		
		//On test qu'une connexion ne soit pas déjà active
		//Pour éviter de se connecter deux fois à la base de données
		if(isset(Model::$connections[$this->conf])) {
			$this->db = Model::$connections[$this->conf];
			return true;
		}
		
		//On va tenter de se connecter à la base de données
		try {
			//Création d'un objet PDO
			$pdo = new PDO(
				'mysql:host='.$conf['host'].';dbname='.$conf['database'],
				$conf['login'],
				$conf['password'],
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
			);
			
			//Mise en place des erreurs de la classe PDO
			//Utilisation du mode exception pour récupérer les erreurs
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			
			Model::$connections[$this->conf] = $pdo; //On affecte l'objet à la classe
			$this->db = $pdo;
			
		} catch(PDOException $e) { //Erreur
			$message = '<pre style="background-color: #EBEBEB; border: 1px dashed black; padding: 10px;">';
			$message .= "La base de données n'est pas disponible merci de reessayer plutard ".$e->getMessage();
			$message .= '</pre>';
			die($message);
		}
	}
		
		/**
		* Cette fonction permet l'exécution du requête sans passer par la fonction find
		* Il suffit d'envoyer directement dans le paramètre $sql la requête à effectuer (par exemple un SELECT ou autre)
		*
		* @param varchar $sql Requête à effectuer
		* @param boolean $return Indique si ou ou non on doit retourner le résultat de la requête
		* @return array Tableau contenant les éléments récupérés lors de la requête
		* @access public
		*/
		function query($sql, $return = false) {
			// pr($this->db);
			$pre = $this->db->prepare($sql); //On prépare la requête
			$result = $pre->execute(); //On l'exécute
			if($result) { //Si l'exécution s'est correctement déroulée
				if($return) { return $pre->fetchAll(PDO::FETCH_ASSOC); } //On retourne le résultat si demandé
				else { return true; } //On retourne vrai sinon
			} else { return false; } //Si la requête ne s'est pas bien déroulée on retourne faux
		}
		
		
		/**
		* Fonction permettant d'effectuer des recherches dans la base de données
		*
		* $req peut être composé des index suivants :
		* - fields (optionnel) : liste des champs à récupérer. Cet index peut être une chaine de caractères ou un tableau, si il est
		laissé vide la requête récupèrera l'ensemble des colonnes de la table.
		* - conditions (optionnel) : ensemble des conditions de recherche à mettre en place. Cet index peut être une chaine de
		caractères ou un tableau.
		* - moreConditions (optionnel) : cet index est une chaine de caractères et permet lorsqu'il est renseigné de rajouter des
		conditions de recherche particulières.
		* - order (optionnel) : cet index est une chaine de caractères et permet lorsqu'il est renseigné d'effectuer un tri sur les
		éléments retournés.
		* - limit (optionnel) : cet index est un entier et permet lorsqu'il est renseigné de limiter le nombre de résultats
		retournés.
		* - allLocales (optionnel) : cet index est un booléen qui permet lors de la récupération d'un élément d'indiquer si il faut ou
		non récupérer l'ensemble des champs traduits
		*
		* @param array $req Tableau de conditions et paramétrages de la requete
		* @param object $type Indique le type de retour de PDO dans notre cas un tableau dont les index sont les colonnes
		de la table
		* @return array Tableau contenant les éléments récupérés lors de la requête
		*/
		public function find($req = array(), $type = PDO::FETCH_ASSOC) {
			$sql = 'SELECT '; //Requete sql
			
			///////////////////////
			// CHAMPS FIELDS //
			if(!isset($req['fields'])) {
				//Si aucun champ n'est demandé on va récupérer le shéma de la table et récupérer ces champs
				//Dans le cas de table traduite on va également récupérer les champs traduits ainsi que la langue associée
				$req['fields'] = $this->shema();
			}
			if(is_array($req['fields'])) { $sql .= implode(', ', $req['fields']); } //Si il s'agit d'un tableau
			else { $sql .= $req['fields']; } //Si il s'agit d'une chaine de caractères
			$sql .= ' FROM '.$this->table.' AS '.get_class($this).' '; //Mise en place du from
			
			///////////////////////////
			// CHAMPS CONDITIONS //
			if(isset($req['conditions'])) { //Si on a des conditions
				$conditions = 'WHERE '; //Mise en variable des conditions
				//On teste si conditions est un tableau
				//Sinon on est dans le cas d'une requête personnalisée
				if(!is_array($req['conditions'])) {
					$conditions .= $req['conditions']; //On les ajoute à la requete
					//Si c'est un tableau on va rajouter les valeurs
				} else {
					$cond = array();
					foreach($req['conditions'] as $k => $v) {
						if(!is_numeric($v)) { $v = $this->db->quote($v); } //Equivalement de mysql_real_escape_string
						$k = get_class($this).".".$k; //On rajoute le nom de la classe devant le nom de la colonne
						// pr($k);
						// pr($v);
						$cond[] = "$k=$v";
					}
					// pr($cond);
					$conditions .= implode(' AND ', $cond);
					// pr($conditions);
				}
				$sql .= $conditions; //On rajoute les conditions à la requête
				// pr($sql);
			}
			
			////////////////////////////////
			// CHAMPS MORE CONDITIONS //
			if(isset($req['moreConditions']) && !empty($req['moreConditions'])) {
				//On test s'il existe des conditions dans ce cas on rajoute un AND sinon on met un WHERE
				if(isset($req['conditions']) && !empty($req['conditions'])) { $sql .= ' AND '; } else { $sql .= ' WHERE '; }
				$sql .= $req['moreConditions'];
				// pr($sql);
			}
			
			//////////////////////
			// CHAMPS ORDER //
			if(isset($req['order']) && !empty($req['order'])) { $sql .= ' ORDER BY '.$req['order']; }
			// pr($sql);
			
			//////////////////////
			// CHAMPS LIMIT //
			if(isset($req['limit'])) { $sql .= ' LIMIT '.$req['limit']; }//ex: 30[element de départ],10[nombre d'éléments par pages]
			//[nombre d'element par page]*[numéro de la page - 1], [nombre d'element par page]
			// pr($sql);
			
			//EXECUTION DE LA REQUETE
			$pre = $this->db->prepare($sql);
			// pr($sql);
			$pre->execute();
			return $pre->fetchAll($type);
		}
		
		/** findFirst 
		* Fonction qui permet de récupérer le premier élément d'un tableau
		* @param $req requete à envoyer
		* @return retourne l'élément courant
		* @access public
		* @use find
		*/
		public function findFirst($req){
			//Retourne l'élément courant
			return current($this->find($req));
		}
		
		/** findCount
		* Fonction qui permet de compter les élements
		* @param $conditions
		*/
		public function findCount($conditions = null,$moreConditions = null){
			// $req = 'SELECT COUNT('.$this->primaryKey.') as nb FROM posts';
			// $res = $this->findFirst(array(
				// 'fields' 		=> 'COUNT('.get_class($this).'.'.$this->primaryKey.') as count',
				// 'conditions' 	=> $conditions,
				// 'moreConditions' => $moreConditions
			// ));
			// $return = 'Il y a '.$res['count'].' &eacute;lement(s) pour ces conditions ';
			// $key = array();
			// foreach($conditions as $k=>$v){
				// $tab = array();
				// $tab = $k;
				// $key = implode(', ',$tab);
			// }
			// print_r($conditions);
			// return $return;
			// print_r($key);
			
			$result = $this->findFirst(
			array(
				'fields' => "COUNT(".get_class($this).'.'.$this->primaryKey.") AS NbElements",
				'conditions' => $conditions,
				'moreConditions' => $moreConditions
			)
		
			);
			// $request = "SELECT COUNT(*) AS NbElements FROM posts";
			// return current($this->query($request, true));//Par défaut on va retourner le premier element du tableau	
			return $result['NbElements'];
			}
				
		/**
		* Cette fonction permet d'afficher le schéma d'une table
		*
		* @return array Tableau contenant les colonnes de la table
		* @access public
		*/
		function shema() {
			$sql = "SHOW COLUMNS FROM ".$this->table;
			$shema = array();
			// pr($sql);
			// pr($shema);
			$result = $this->query($sql, true);
			foreach($result as $k => $v) { $shema[] = $v['Field']; }
			return $shema;
		}
		
		
		/**
		* Fonction table_list qui permet d'afficher le schema
		*/
		function table_list(){
			$sql = "SHOW TABLES FROM ".$this->dbName;
			 // pr($sql);
			$list = array();
			$result = $this->query($sql, true);
			// pr($result);
			foreach($result as $k => $v){ 
				$list[] = $v['Tables_in_mvc_bdd'];
			}
			// pr($list);
			return $list;
		}
		
		/**
		* Fonction delete permet de supprimer un enregistrement
		* @param int $id Id de l'enregistrement
		* @return retourne le resultat de la requete
		*/
		// public function delete($id)
		// {
			// $sql = "DELETE FROM ".$this->table." WHERE ".$this->primaryKey." = $id";
			// return $this->db->query($sql);
		// }
		
		/**
		* Fonction DELETE FRANçOIS
		*/
		public function delete($id){
			if(is_array($id)){ $idConditions = " IN (".implode(',',$id).')';} else { $idConditions = " = ".$id; }
			$sql = "DELETE FROM ".$this->table." WHERE ".$this->primaryKey.$idConditions.";";
			// $queryResult = $this->db->query($sql);
			$queryResult = $this->query($sql);
			return $queryResult;
		}
		
		/**
		* Fonction save, permet d'effectuer la sauvegarde des données
		* Selon les cas un insert ou un update
		* On travaille avec les requetes préparées de PDO
		* @param array $datas contient l'ensemble des index et valeurs de $_POST
		* @param $forceInsert boolean sert pour forcer l'ajout de donnée ( RI )
		* @access public
		*/
		public function save($datas, $forceInsert = false){
		
			$key = $this->primaryKey;//Récupération de la clé primaire //On testera la clé pour déterminer l'insert ou l'update
			$fieldsToSave = array();//Tableau des champs à sauvegarder
			$datasToSave = array();//Tableau utilisé pour la préparation des requetes
			
			//Permet de connaitre le type de requete à effectuer pour deux choses
			//--> Savoir quelle requete lancer INSERT ou UPDATE
			//--> Savoir comment renvoyer l'id
			//--> Ajout de la condition !$forceInsert pour la RI
			//Dans ce cas on est sur de l'update (car clé pas vide)
			if(isset($datas[$key]) && !empty($datas[$key]) && !$forceInsert){
				$action = 'update';//Définition de l'action
				$returnId = $datas[$key];//Récupération de la valeur de la clé primaire
				//Notation PDO
				$dataToSave[":$key"] = $returnId;//On insère dans les données préparées la valeur de la clée lors de l'update
			}else{
				//Dans ce cas on est sur de l'insert
				$action = 'insert';//Définition de l'action
				if(in_array('created', $this->shema())){
					$datas['created'] = date('Y-m-d H:i:s');//On procède à la mise à jour du champ created s'il existe
				}
				if(in_array('created_by', $this->shema())){
					$datas['created_by'] = Session::read('Backoffice.User.id');//On procède à la mise à jour du champ created_by s'il existe
				}
			}
			
			//Mise à jour des champs modified et modified_by
			if(in_array('modified', $this->shema())){
				$datas['modified'] = date('Y-m-d H:i:s');//On procède à la mise à jour du champ modified s'il existe
			}
			if(in_array('modified_by', $this->shema())){
				$datas['modified_by'] = Session::read('Backoffice.User.id');//On procède à la mise à jour du champ modified_by s'il existe
			}
			
			//Par d'accolade que s'il y a une seule instruction
			if(isset($datas[$key]) && !$forceInsert) unset($datas[$key]);
			//Comme la clé est présente par défaut, on l'enlève pour éviter des erreurs
			//à faire avant le foreach sinon génère des erreurs
			//Il faut supprimer du tableau des données la clé primaire si celle ci est définie
			//Ajout de la condition !$forceInsert pour gérer l'id correctement sur la RI
			
			foreach($datas as $k => $v){//On parcours $datas
				if(in_array($k, $this->shema())){//On test si la clé est présente dans le schema
					$fieldsToSave[] = "$k=:$k";//Champs à sauvegarder, :$k variable version Pdo
					$dataToSave[":$k"] = $v;//Données à sauvegarder, valeurs
				}
			}
			
			if($action == 'insert'){
				$sql = 'INSERT INTO '.$this->table.' SET '.implode(',',$fieldsToSave).';';
			}else{
				$sql = 'UPDATE '.$this->table.' SET '.implode(',',$fieldsToSave).' WHERE '.$key.'=:'.$key.';';
			}
			
			// pr($datas);
			
			
			// pr($fieldsToSave);
			// pr($dataToSave);
			// pr($sql);
			// pr($this->db);
			
			// die();
			
			$pre = $this->db->prepare($sql);
			// pr($pre);
			$pre->execute($dataToSave);
			
			//Affectation de la valeur de la clé primaire à la variable de classe
			if($action == 'insert'){ $this->id = $this->db->lastInsertId(); }
			else{ $this->id = $returnId; }
		}
		
		/**
		* Fonction de validation des données
		* @param array $datas tableau de données envoyé pour la validation
		* @return boolean
		* @access public
		*/
		public function validates($datas){
			//Message d'erreur dans un tableau
			$errors = array();
			if(isset($this->validate)){
				//Parcours des données à valider
				//On parcours toujours le tableau le plus petit
				foreach($this->validate as $k => $v){
					if(!isset($datas[$k])){
						$errors[$k] = $v['message'];
					}else{
						if($v['rule'] == 'notEmpty'){
							if(empty($datas[$k])){
								$errors[$k] = $v['message'];
							}
						}elseif(!preg_match('/^'.$v['rule'].'$/',$datas[$k])){
							$errors[$k] = $v['message'];
						}
					}
				}
			}
			//On injecte une variable dans l'objet
			$this->errors = $errors;
			//Cas le plus récurrent
			if(empty($errors)){
				return true;
			}
			//Dans tous les autres cas on retourne faux
			return false;
		}
		
}












