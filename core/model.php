<?php
class Model extends Object /*implements EventListener*/{

	public $conf = 'localhost';
	public $db;
	public $table = false;
	public $primaryKey = 'id';
	static $connections = array();
	
	/**
	 * Event manager, used to handle dispatcher filters
	 *
	 * @var EventManager
	 */
	protected $_eventManager;

	// public function implementedEvents(){
 			// return array('Model' => 'test');
	// }
	
	public function __construct(){
		// require ROOT.DS.'configs'.DS.'database.php';
		require_once ROOT.DS.'core'.DS.'ConfigMagik'.DS.'class.ConfigMagik.php';
		$config = new ConfigMagik( ROOT.DS.'configs'.DS.'database.ini', true, true);
		
		//Test si une configuration de type localhost ou non, et charge la bonne section du database.ini
		$httpHost = $_SERVER["HTTP_HOST"];
		if($httpHost == 'localhost' || $httpHost == '127.0.0.1') { $section = 'localhost'; } else { $section = 'online'; }
		//Charge la bonne section
		$conf = $config->get($section);
		
		//Si le nom de la table n'est pas d�fini on va l'initialiser automatiquement
		if($this->table === false){
			$tableName = strtolower(get_class($this)).'s';//Mise en variable du nom de la table
			$this->table = $tableName;//Affectation de la variable de classe
		}
		$this->dbName = $conf['database'];
		
		//On test qu'une connexion ne soit pas d�j� active
		//Pour �viter de se connecter deux fois � la base de donn�es
		if(isset(Model::$connections[$this->conf])) {
			$this->db = Model::$connections[$this->conf];
			return true;
		}
		
		// pr($this);
		
		//On va tenter de se connecter � la base de donn�es
		try {
			//Cr�ation d'un objet PDO
			$pdo = new PDO(
				'mysql:host='.$conf['host'].';dbname='.$conf['database'],
				$conf['login'],
				$conf['password'],
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
			);
			
			//Mise en place des erreurs de la classe PDO
			//Utilisation du mode exception pour r�cup�rer les erreurs
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			
			Model::$connections[$this->conf] = $pdo; //On affecte l'objet � la classe
			$this->db = $pdo;
			
		} catch(PDOException $e) { //Erreur
			$message = '<pre style="background-color: #EBEBEB; border: 1px dashed black; padding: 10px;">';
			$message .= "La base de donn�es n'est pas disponible merci de reessayer plutard ".$e->getMessage();
			$message .= '</pre>';
			die($message);
		}
	}
		
		/**
		* Cette fonction permet l'ex�cution du requ�te sans passer par la fonction find
		* Il suffit d'envoyer directement dans le param�tre $sql la requ�te � effectuer (par exemple un SELECT ou autre)
		*
		* @param varchar $sql Requ�te � effectuer
		* @param boolean $return Indique si ou ou non on doit retourner le r�sultat de la requ�te
		* @return array Tableau contenant les �l�ments r�cup�r�s lors de la requ�te
		* @access public
		*/
		function query($sql, $return = false) {
			// pr($this->db);
			$pre = $this->db->prepare($sql); //On pr�pare la requ�te
			$result = $pre->execute(); //On l'ex�cute
			if($result) { //Si l'ex�cution s'est correctement d�roul�e
				if($return) { return $pre->fetchAll(PDO::FETCH_ASSOC); } //On retourne le r�sultat si demand�
				else { return true; } //On retourne vrai sinon
			} else { return false; } //Si la requ�te ne s'est pas bien d�roul�e on retourne faux
		}
		
		
		/**
		* Fonction permettant d'effectuer des recherches dans la base de donn�es
		*
		* $req peut �tre compos� des index suivants :
		* - fields (optionnel) : liste des champs � r�cup�rer. Cet index peut �tre une chaine de caract�res ou un tableau, si il est
		laiss� vide la requ�te r�cup�rera l'ensemble des colonnes de la table.
		* - conditions (optionnel) : ensemble des conditions de recherche � mettre en place. Cet index peut �tre une chaine de
		caract�res ou un tableau.
		* - moreConditions (optionnel) : cet index est une chaine de caract�res et permet lorsqu'il est renseign� de rajouter des
		conditions de recherche particuli�res.
		* - order (optionnel) : cet index est une chaine de caract�res et permet lorsqu'il est renseign� d'effectuer un tri sur les
		�l�ments retourn�s.
		* - limit (optionnel) : cet index est un entier et permet lorsqu'il est renseign� de limiter le nombre de r�sultats
		retourn�s.
		* - allLocales (optionnel) : cet index est un bool�en qui permet lors de la r�cup�ration d'un �l�ment d'indiquer si il faut ou
		non r�cup�rer l'ensemble des champs traduits
		*
		* @param array $req Tableau de conditions et param�trages de la requete
		* @param object $type Indique le type de retour de PDO dans notre cas un tableau dont les index sont les colonnes
		de la table
		* @return array Tableau contenant les �l�ments r�cup�r�s lors de la requ�te
		*/
		public function find($req = array(), $type = PDO::FETCH_ASSOC) {
			$sql = 'SELECT '; //Requete sql
			
			///////////////////////
			// CHAMPS FIELDS //
			if(!isset($req['fields'])) {
				//Si aucun champ n'est demand� on va r�cup�rer le sh�ma de la table et r�cup�rer ces champs
				//Dans le cas de table traduite on va �galement r�cup�rer les champs traduits ainsi que la langue associ�e
				$req['fields'] = $this->shema();
			}
			if(is_array($req['fields'])) { $sql .= implode(', ', $req['fields']); } //Si il s'agit d'un tableau
			else { $sql .= $req['fields']; } //Si il s'agit d'une chaine de caract�res
			$sql .= ' FROM '.$this->table.' AS '.get_class($this).' '; //Mise en place du from
			
			///////////////////////////
			// CHAMPS CONDITIONS //
			if(isset($req['conditions'])) { //Si on a des conditions
				$conditions = 'WHERE '; //Mise en variable des conditions
				//On teste si conditions est un tableau
				//Sinon on est dans le cas d'une requ�te personnalis�e
				if(!is_array($req['conditions'])) {
					$conditions .= $req['conditions']; //On les ajoute � la requete
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
				$sql .= $conditions; //On rajoute les conditions � la requ�te
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
			if(isset($req['limit'])) { $sql .= ' LIMIT '.$req['limit']; }//ex: 30[element de d�part],10[nombre d'�l�ments par pages]
			//[nombre d'element par page]*[num�ro de la page - 1], [nombre d'element par page]
			// pr($sql);
			
			//EXECUTION DE LA REQUETE
			$pre = $this->db->prepare($sql);
			// pr($sql);
			$pre->execute();
			return $pre->fetchAll($type);
		}
		
		/** findFirst 
		* Fonction qui permet de r�cup�rer le premier �l�ment d'un tableau
		* @param $req requete � envoyer
		* @return retourne l'�l�ment courant
		* @access public
		* @use find
		*/
		public function findFirst($req){
			//Retourne l'�l�ment courant
			return current($this->find($req));
		}
		
		/** findCount
		* Fonction qui permet de compter les �lements
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
			// return current($this->query($request, true));//Par d�faut on va retourner le premier element du tableau	
			return $result['NbElements'];
			}
				
		/**
		* Cette fonction permet d'afficher le sch�ma d'une table
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
		* Fonction DELETE FRAN�OIS
		*/
		public function delete($id){
			if(is_array($id)){ $idConditions = " IN (".implode(',',$id).')';} else { $idConditions = " = ".$id; }
			$sql = "DELETE FROM ".$this->table." WHERE ".$this->primaryKey.$idConditions.";";
			// $queryResult = $this->db->query($sql);
			$queryResult = $this->query($sql);
			return $queryResult;
		}
		
		/**
		* Fonction save, permet d'effectuer la sauvegarde des donn�es
		* Selon les cas un insert ou un update
		* On travaille avec les requetes pr�par�es de PDO
		* @param array $datas contient l'ensemble des index et valeurs de $_POST
		* @param $forceInsert boolean sert pour forcer l'ajout de donn�e ( RI )
		* @access public
		*/
		public function save($datas, $forceInsert = false){
		
			$key = $this->primaryKey;//R�cup�ration de la cl� primaire //On testera la cl� pour d�terminer l'insert ou l'update
			$fieldsToSave = array();//Tableau des champs � sauvegarder
			$datasToSave = array();//Tableau utilis� pour la pr�paration des requetes
			
			//Permet de connaitre le type de requete � effectuer pour deux choses
			//--> Savoir quelle requete lancer INSERT ou UPDATE
			//--> Savoir comment renvoyer l'id
			//--> Ajout de la condition !$forceInsert pour la RI
			//Dans ce cas on est sur de l'update (car cl� pas vide)
			if(isset($datas[$key]) && !empty($datas[$key]) && !$forceInsert){
				$action = 'update';//D�finition de l'action
				$returnId = $datas[$key];//R�cup�ration de la valeur de la cl� primaire
				//Notation PDO
				$dataToSave[":$key"] = $returnId;//On ins�re dans les donn�es pr�par�es la valeur de la cl�e lors de l'update
			}else{
				//Dans ce cas on est sur de l'insert
				$action = 'insert';//D�finition de l'action
				if(in_array('created', $this->shema())){
					$datas['created'] = date('Y-m-d H:i:s');//On proc�de � la mise � jour du champ created s'il existe
				}
				if(in_array('created_by', $this->shema())){
					$datas['created_by'] = Session::read('Backoffice.User.id');//On proc�de � la mise � jour du champ created_by s'il existe
				}
			}
			
			//Mise � jour des champs modified et modified_by
			if(in_array('modified', $this->shema())){
				$datas['modified'] = date('Y-m-d H:i:s');//On proc�de � la mise � jour du champ modified s'il existe
			}
			if(in_array('modified_by', $this->shema())){
				$datas['modified_by'] = Session::read('Backoffice.User.id');//On proc�de � la mise � jour du champ modified_by s'il existe
			}
			
			//Par d'accolade que s'il y a une seule instruction
			if(isset($datas[$key]) && !$forceInsert) unset($datas[$key]);
			//Comme la cl� est pr�sente par d�faut, on l'enl�ve pour �viter des erreurs
			//� faire avant le foreach sinon g�n�re des erreurs
			//Il faut supprimer du tableau des donn�es la cl� primaire si celle ci est d�finie
			//Ajout de la condition !$forceInsert pour g�rer l'id correctement sur la RI
			
			foreach($datas as $k => $v){//On parcours $datas
				if(in_array($k, $this->shema())){//On test si la cl� est pr�sente dans le schema
					$fieldsToSave[] = "$k=:$k";//Champs � sauvegarder, :$k variable version Pdo
					$dataToSave[":$k"] = $v;//Donn�es � sauvegarder, valeurs
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
			
			//Affectation de la valeur de la cl� primaire � la variable de classe
			if($action == 'insert'){ $this->id = $this->db->lastInsertId(); }
			else{ $this->id = $returnId; }
		}
		
		/**
		* Fonction de validation des donn�es
		* @param array $datas tableau de donn�es envoy� pour la validation
		* @return boolean
		* @access public
		*/
		public function validates($datas){
			//Message d'erreur dans un tableau
			$errors = array();
			$this->datas = $datas;
			
			if(isset($this->validate)){
				//Parcours des donn�es � valider
				//On parcours toujours le tableau le plus petit
				foreach($this->validate as $k => $v){
					if(!isset($datas[$k])){
						$errors[$k] = $v['message'];					
					}else{
						switch($v['rule']){
							case 'notEmpty':
								if(empty($datas[$k])){
								$errors[$k] = $v['message'];
							}
							break;
							case 'checkParadox':
								if($this->datas['id'] == $datas[$k]){
									$errors[$k] = $v['message'];
								}
							break;
							case 'checkRedirect':
								if($this->datas['id'] == $datas[$k]){
									$errors[$k] = $v['message'];
								}
							break;
							case '([a-z0-9\-]+)':
								if(!preg_match('/^([a-z0-9\-]+)$/',$datas[$k])){
									$errors[$k] = $v['message'];
								}
							break;
						}
					}
				}
			}
			
			//On injecte une variable dans l'objet
			$this->errors = $errors;
			//Cas le plus r�current
			if(empty($errors)){
				return true;
			}
			//Dans tous les autres cas on retourne faux
			return false;			
		}
		
		/**
		 * Retourne une instance EventManager ou en cr�e une s'il n'y en a pas de cr�e.
		 * Attache par d�faut, s'il existe, l'�couteur correspondant au controleur dans lequel la m�thode est appel�e
		 *
		 * @return EventManager
		 */
		public function getEventManager() {
			if (empty($this->_eventManager)) {
				$this->_eventManager = new EventManager();
				//Charge le fichier �v�nement si celui ci existe
				$event = ROOT.DS.'events'.DS.$this->table.'_event.php';
					if(file_exists($event)){
						require_once($event);
						$eventName = ucfirst($this->table).'EventListener';
						//On d�clare une nouvelle instance du $eventName
						if(!isset($this->$eventName)){ $this->$eventName = new $eventName();}
					}
				//On attache l'instance au bon �couteur pour lancer l'action
				$this->_eventManager->attach($this->$eventName);
			}
			return $this->_eventManager;
		}
		
		/**
		 * Cette fonction permet de contr�ler qu'une cat�gorie ne soit pas son propre parent
		 * Fonction qui doit v�rifier qu'une cat�gorie ne doit pas �tre son propre parent
		 * @var 	integer $val Valeur du champ parent_id
		 * @access 	public
		 * @author 	ko�ZionCMS
		 * @version 0.1 - 20/04/2012 by FI
		 */	
		// function check_paradox($val) {
			//R�cup�ration des conditions
			// $conditions = array('conditions' => array('online' => 1, 'type' => 1, 'id' => $val));
			//Requete et variable interm�diaire
			// $value = $this->findFirst($conditions);
			// pr($value['id']);
			// if($value['id'] != $val){ return false; }
			// else{ return true; }
			
			
			// if(isset($value['id'])) { return $value['id'] != $val; }
			// else {return true;}
			// $modelDatas = $this->datas; //Donn�es post�es
			// pr($val);

			//Il faut contr�ler si on est sur un ajout ou sur une �dition
			//car dans le cas de l'ajout il ne faudra pas faire le test		
			// if(isset($modelDatas['id'])) { return $modelDatas['id'] != $val; }
			// else { return true; }		
		// }	
		
		/**
		 * Cette fonction permet de contr�ler qu'une cat�gorie ne soit redirig�e vers elle m�me
		 * Fonction qui doit v�rifier qu'une cat�gorie n'est pas redirig�e vers elle m�me ( boucle infinie )
		 * @var 	integer $val Valeur du champ parent_id
		 * @access 	public
		 * @author 	ko�ZionCMS
		 * @version 0.1 - 20/04/2012 by FI
		 */	
		// function check_redirect($val) {
			
			// $modelDatas = $this->datas; //Donn�es post�es
			
			//Il faut contr�ler si on est sur un ajout ou sur une �dition
			//car dans le cas de l'ajout il ne faudra pas faire le test		
			// if(isset($modelDatas['id'])) { return $modelDatas['id'] != $val; }
			// else { return true; }		
		// }
		
}












