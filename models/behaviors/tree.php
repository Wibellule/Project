<?php
/**
 * BEHAVIORS | TREE
 * Représentation intervallaire pour la gestion des pages (catégories)
 *
 * @version 0.1 - 09/05/2013
 *
 * @link        http://www.koezion-cms.com  
 * @link 		http://www.siteduzero.com/tuto-3-20017-1-la-representation-intervallaire.html Tutoriel sur la Représentation Intervallaire d'arbre en SQL
 * @link 		http://sqlpro.developpez.com/cours/arborescence/ Cours sur la gestion d'arborescence en SQL (par Frederic Brouard)
 *
 * @link		Références - http://fr2.php.net/manual/fr/language.references.whatare.php
 */
 
 class Tree extends Model {
 
	/**
	 * Tableau contenant l'arbre à afficher
	 *
	 * @var 	array
	 * @access 	public
	 * @author 	koéZionCMS
	 * @version 0.1 - 17/01/2012 by FI
	 */	
	var $displayTree = array();
 
	/**
	 * Tableau contenant la correspondance entre les anciens id et les nouveaux lors du déplacement d'un noeud
	 *
	 * @var 	array
	 * @access 	public
	 * @author 	koéZionCMS
	 * @version 0.1 - 20/02/2012 by FI
	 */
	var $oldNewId = array();
	
	/**
	 * Fonction de récupération de l'arbre
	 * @param $req tableau -> requete supplémentaire
	 * @return $return tableau -> noeuds passé par référence
	 */
	function getTree($req = array()){
	
		$defaultReq = array('order' => 'lft ASC'); //Requête à executer - tri par la borne gauche	
    	$req = array_merge($defaultReq, $req); //Génération du tableau utilisé pour les conditions de recherche - fusion des tableaux
    	
    	$tree = $this->find($req);//execution de la requête
    	
        $return = array(); //Tableau de retour 
		foreach ($tree as &$node) { //Mise en forme du tableau + passage par référence
			$return[$node['id']] = $node;  
		}     
        return $return; //On le retourne
	
	}
	
	/**
	 * Cette fonction permet de récupérer les données sous forme de tableau pouvant être utilisé pour une liste déroulante
	 *
	 * @param 	boolean $withRacine 	Indique si il faut ou non renvoyer le noeud racine
	 * @param 	varchar $req	 		Paramètres de recherche
	 * @access	public
	 * @author	koéZionCMS
	 * @return 	array Liste de tous les noeuds de l'arbre
	 * @version 0.1 - 27/12/2011 by FI
	 * @version 0.2 - 23/02/2012 by FI - Rajout du passage de conditions pour la récupération de l'arbre
	 * @version 0.3 - 16/05/2012 by FI - Modification de la récupération des catégories suite à la mise en place de la gestion des sites - Récupération en premier de la catégorie parente du site et suppression de celle-ci du résultat
	 */    
		function getTreeList($withRacine = true, $req = array()) {
			
			$arbre = $this->getTree($req); //Récupération de l'arbre       	
			$racine = each($arbre); //Récupération de la racine de l'arbre
			if($racine['value']['type'] == 3) { unset($arbre[$racine['key']]); } //On supprime maintenant l'élément correspondant à la racine du site
			
			if($withRacine) { $retour = array($racine['key'] => 'Racine'); }
			else { $retour = array(); }
			
			foreach($arbre as $v) { $retour[$v['id']] = str_repeat('__', $v['level']).' '.$v['name']; }       	
			return $retour;
		}  
	
	/**
	 * Cette fonction permet de récupérer les enfants de l'élément dont l'identifiant est passé en paramètre
	 *
	 * @param 	integer $id 		Indentifiant de l'élément parent
	 * @param 	boolean $withParent Indique si il faut également retourner le parent dans la liste
	 * @param 	boolean $reverse 	Indique si il faut renvoyer le tableau en ordre inverse
	 * @param 	varchar $level 		Indique le niveau des enfants à retourner
	 * @param 	array 	$conditions Conditions de recherches supplémentaires
	 * @return 	array Liste de tous les enfants du noeud parent
	 * @access	public
	 * @author	koéZionCMS
	 * @version 0.1 - 01/01/2012 by FI
	 * @version 0.2 - 28/02/2012 by FI - Rajout du niveau à retourner
	 */    
    function getChildren($id, $withParent = false, $reverse = true, $level = null, $conditions = array()){

		$id = (int)$id; //On force le type de l'identifiant
        $tree = $this->getTree($conditions); //Récupération de l'arbre
        
		if(!isset($tree[$id])) { return array(); } //Si l'identifiant n'existe pas on retourne une valeur vide
        
		$parent = $tree[$id];
		$childs = array(); //Liste des enfants à retourner
        
		if(!$withParent && isset($tree[$id])) unset($tree[$id]);

		//On va parcourir l'arbre
        foreach($tree as $node) {
        	
            if($node['lft'] < $parent['lft']) continue;            
            if($node['rgt'] > $parent['rgt']) break;
            $childs[] = $node;
        }   
        
        if(isset($level)) {
        	
        	foreach($childs as $k => $node) { if($node['level'] != $level) unset($childs[$k]); }
        }        
        
        if($reverse) { return array_reverse($childs); }
        else { return $childs; }
    }
	
	/**
	 * Fonction save qui va permettre soit de faire un ajout soit une édition des données
	 * @param $datas tableau des données à sauvegarder
	 */
	function save($datas) {
		
		//Si la clé id est présente dans les données à sauvegarder il s'agit d'un update
		if(isset($datas['id'])) { $this->edit($datas); } 
		//Sinon il s'agit d'un ajout
		else { $this->add($datas); }
	}
	
	/**
	 * Fonction add qui va ajouter une feuille dans l'arbre
	 * @param $datas tableau des données à sauvegarder
	 * @param $forceInsert booleen permettant même si le champ id est présent dans le tableau de forcer l'insert
	 */
	function add($datas, $forceInsert = false){
	
		if(!is_array($datas)) { return false; } //Si les données à sauvegarder ne sont pas sous forme de tableau on retourne faux
		
		//Cas multi site où la racine n'existe pas
		if(!isset($datas['parent_id'])) { $datas['parent_id'] = 0; } //Si la valeur du parent_id n'est pas définie on va lui attribuer 0 par défaut 	
    	$parent_id = $datas['parent_id']; //On stocke cette valeur dans une variable pour plus de facilité
		
		//   HACK SPECIAL POUR LE DEPLACEMENT D'UN NOEUD   //
    	if(isset($this->oldNewId[$parent_id])) { $parent_id = $this->oldNewId[$parent_id]; }
    	
        $tree = $this->getTree(); //Récupération de l'arbre
        // pr($tree);
        //Si le parent existe dans l'arbre on va sélectionner ses bornes gauche et droite
        if($parent_id != 0 && isset($tree[$parent_id])) {
        	
        	$parent_data = array(
				'rgt' => $tree[$parent_id]['rgt'],
        		'level' => $tree[$parent_id]['level']
        	);
        	
		//Sinon on va sélectionner la borne la plus à droite et rejouter 1 pour l'insérer        	
        } else {
			//coalesce récupère le premier élement non null parmis ses arguments
        	$sql = 'SELECT (COALESCE(MAX(rgt), 0) + 1) as rgt, -1 as level FROM '.$this->table;
        	$parent_data = current($this->query($sql, true));
			// pr($parent_data);
        }
        
        //Décalage des bornes droite
        $sql = 'UPDATE '.$this->table.' SET rgt = rgt + 2 WHERE rgt >= '.$parent_data['rgt'];        
        $this->query($sql);
		// pr($sql);
        
        //Décalage des bornes gauche
        $sql = 'UPDATE '.$this->table.' SET lft = lft + 2 WHERE lft >= '.$parent_data['rgt'];
        $this->query($sql);
		// pr($sql);

        //On ajoute les données manquantes aux données à sauvegarder
        $datas['lft'] = $parent_data['rgt'];
		$datas['rgt'] = $parent_data['rgt'] + 1;
		$datas['level'] = $parent_data['level'] + 1;
        
		parent::save($datas, $forceInsert); //Sauvegarde des données en faisant appel à la fonction parente
		
		// pr($parent_id);
		// pr($datas);
		
		// die();
		
	}
	
	/**
	 * Fonction chargée de l'édition d'une feuille de l'arbre
	 *
	 * @param 	array $datas Données à mettre à jour
	 * @return  mixed Un booléen si faux, un entier si vrai : la valeur de l'élément créé si vrai
	 * @access	public
	 * @author	koéZionCMS
	 * @version 0.1 - 28/12/2011 by FI
	 * @todo 	28/12/2011 - A voir si au lieu de retourner faux lors du test sur l'id et la présence du noeud dans l'arbre on ne fait pas appel à la fonction add
	 */
	function edit($datas) {
		
		if(!is_array($datas)) { return false; } //Si les données à sauvegarder ne sont pas sous forme de tableau on retourne faux
    	    	
		$key = $this->primaryKey; //Récupération de la clé primaire
        $id = $datas['id']; //Récupération de la valeur de l'identifiant
        $fields = array(); //Tableau qui va contenir la liste des champs à sauvegarder

        $tree = $this->getTree(); //Récupération de l'arbre

		if(!$id || !isset($tree[$id])) { return false; } //Si l'identifiant n'existe par ou que le noeud n'est pas dans l'arbre on retourne faux
        
        $current = $tree[$id]; //Récupération du noeud courant
        // pr($current);
        parent::save($datas); //Sauvegarde des données en faisant appel à la fonction parente      
        // pr($id);
		
		// pr($datas['parent_id']);
		
        //Si le champ parent_id est présent dans les données à mettre à jour
        //ET que la valeur courante du champ parent_id et différente de celle postée
        if(isset($datas['parent_id']) && $current['parent_id'] != $datas['parent_id']) {

        	//On va extraire l'arbre, le supprimer puis l'insérer à la bonne place
            //On récupère également le noeud parent          
            $curTree = $this->getChildren($id, true, false);
            // pr($curTree);
            //Pour chacun des éléments de l'arbre on va supprimer les valeurs lft, rgt et level car elles vont être recalculée lors de l'ajout
            foreach($curTree as $key => $node) { unset($curTree[$key]['lft'], $curTree[$key]['rgt'], $curTree[$key]['level']); }
                        
            $curTree[0]['parent_id'] = $datas['parent_id']; //On affecte au noeud parent la nouvelle valeur du champ parent
            $this->delete($id); //On supprime le noeud
                        
            //On va parcourir le tableau d'éléments du noeud courant
            foreach($curTree as $key => $node){ $this->add($node, true); }//Ajouter le noeud dans l'arbre 

        }
		
		// die();
    }  

	/**
	 * Fonction chargée de la suppression d'un élément de l'arbre
	 *
	 * @param 	integer $id Identifiant du noeud à supprimer
	 * @access	public
	 * @author	koéZionCMS
	 * @return 	boolean Vrai si la suppression s'est correctement déroulée, faux sinon
	 * @version 0.1 - 28/12/2011 by FI
	 */
	function delete($id) {
    	
        $id = (int)$id; //On fait un cast sur l'id
        $tree = $this->getTree(); //Récupération de l'arbre        
        if(!isset($tree[$id])) { return false; } //Si l'identifiant passé en paramètre ne fait pas parti de l'arbre
        
        //On récupère la valeur lft et rgt du noeud courant
        $curLft = $tree[$id]['lft'];
        $curRgt = $tree[$id]['rgt'];
		
		// pr($curLft);
		// pr($curRgt);
        
        //Sélection des identifiants des catégories à supprimer        
        //On formate le tout sous forme de tableau puis on fait appel à la fonction parente pour la suppression
        $sql = 'SELECT id FROM '.$this->table.' WHERE lft >= '.$curLft.' AND rgt <= '.$curRgt;
		
		// pr($sql);
		
        $idToDeleteTMP = $this->query($sql, true);
		// pr($idToDeleteTMP);
		
        $idToDelete = array();
        foreach($idToDeleteTMP as $v) { $idToDelete[] = $v['id']; }
        
        parent::delete($idToDelete);
		
		// pr($idToDelete);
                
        $diff = $tree[$id]['rgt'] - $tree[$id]['lft'] + 1; //On calcule la différence des deux bornes supprimées
        
        //Rebouchage des trous
        $sql = 'UPDATE '.$this->table.' SET lft = lft - :diff WHERE lft >= :lft'; //Préparation de la requête
		// pr($sql);
        $d[":lft"] = $curLft;
        $d[":diff"] = $diff;
        $pre = $this->db->prepare($sql);
		$pre->execute($d);
		$d = array();
		$pre = null;
                
        $sql = 'UPDATE '.$this->table.' SET rgt = rgt - :diff WHERE rgt >= :rgt';
		// pr($sql);
        $d[":rgt"] = $curRgt;
        $d[":diff"] = $diff;
        $pre = $this->db->prepare($sql);
		$pre->execute($d);
		$d = array();
		$pre = null;
			
        return true;
    }
	
	
	
	
	
	
 }