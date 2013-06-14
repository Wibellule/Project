<?php
/**
 * BEHAVIORS | TREE
 * Repr�sentation intervallaire pour la gestion des pages (cat�gories)
 *
 * @version 0.1 - 09/05/2013
 *
 * @link        http://www.koezion-cms.com  
 * @link 		http://www.siteduzero.com/tuto-3-20017-1-la-representation-intervallaire.html Tutoriel sur la Repr�sentation Intervallaire d'arbre en SQL
 * @link 		http://sqlpro.developpez.com/cours/arborescence/ Cours sur la gestion d'arborescence en SQL (par Frederic Brouard)
 *
 * @link		R�f�rences - http://fr2.php.net/manual/fr/language.references.whatare.php
 */
 
 class Tree extends Model {
 
	/**
	 * Tableau contenant l'arbre � afficher
	 *
	 * @var 	array
	 * @access 	public
	 * @author 	ko�ZionCMS
	 * @version 0.1 - 17/01/2012 by FI
	 */	
	var $displayTree = array();
 
	/**
	 * Tableau contenant la correspondance entre les anciens id et les nouveaux lors du d�placement d'un noeud
	 *
	 * @var 	array
	 * @access 	public
	 * @author 	ko�ZionCMS
	 * @version 0.1 - 20/02/2012 by FI
	 */
	var $oldNewId = array();
	
	/**
	 * Fonction de r�cup�ration de l'arbre
	 * @param $req tableau -> requete suppl�mentaire
	 * @return $return tableau -> noeuds pass� par r�f�rence
	 */
	function getTree($req = array()){
	
		$defaultReq = array('order' => 'lft ASC'); //Requ�te � executer - tri par la borne gauche	
    	$req = array_merge($defaultReq, $req); //G�n�ration du tableau utilis� pour les conditions de recherche - fusion des tableaux
    	
    	$tree = $this->find($req);//execution de la requ�te
    	
        $return = array(); //Tableau de retour 
		foreach ($tree as &$node) { //Mise en forme du tableau + passage par r�f�rence
			$return[$node['id']] = $node;  
		}     
        return $return; //On le retourne
	
	}
	
	/**
	 * Cette fonction permet de r�cup�rer les donn�es sous forme de tableau pouvant �tre utilis� pour une liste d�roulante
	 *
	 * @param 	boolean $withRacine 	Indique si il faut ou non renvoyer le noeud racine
	 * @param 	varchar $req	 		Param�tres de recherche
	 * @access	public
	 * @author	ko�ZionCMS
	 * @return 	array Liste de tous les noeuds de l'arbre
	 * @version 0.1 - 27/12/2011 by FI
	 * @version 0.2 - 23/02/2012 by FI - Rajout du passage de conditions pour la r�cup�ration de l'arbre
	 * @version 0.3 - 16/05/2012 by FI - Modification de la r�cup�ration des cat�gories suite � la mise en place de la gestion des sites - R�cup�ration en premier de la cat�gorie parente du site et suppression de celle-ci du r�sultat
	 */    
		function getTreeList($withRacine = true, $req = array()) {
			
			$arbre = $this->getTree($req); //R�cup�ration de l'arbre       	
			$racine = each($arbre); //R�cup�ration de la racine de l'arbre
			if($racine['value']['type'] == 3) { unset($arbre[$racine['key']]); } //On supprime maintenant l'�l�ment correspondant � la racine du site
			
			if($withRacine) { $retour = array($racine['key'] => 'Racine'); }
			else { $retour = array(); }
			
			foreach($arbre as $v) { $retour[$v['id']] = str_repeat('__', $v['level']).' '.$v['name']; }       	
			return $retour;
		} 

	/**
	 * Cette fonction permet de r�cup�rer l'arbre sous forme de parents/enfants
	 *
	 * @param 	array 	$req 		Liste des param�tres � prendre en compte pour la recherche
	 * @param 	integer $parentId 	Identifiant de l'�l�ment parent
	 * @return 	array Arbre
	 * @access	public
	 * @author	ko�ZionCMS
	 * @version 0.1 - 01/01/2012 by FI
	 * @version 0.2 - 23/02/2012 by FI - Modification de la structure de la fonction pour g�rer d'un cot� l'identifiant du parent et de l'autre les conditions suppl�mentaires
	 * @version 0.2 - 13/04/2012 by FI - Modification de l'ordre et de la structure des param�tres
	 */    
		function getTreeRecursive($req = array(), $parentId = null) {

			$this->_recursive($req, $parentId);
			return $this->displayTree;    	
		}    
	
	/**
	 * Cette fonction permet de r�cup�rer les enfants de l'�l�ment dont l'identifiant est pass� en param�tre
	 *
	 * @param 	integer $id 		Indentifiant de l'�l�ment parent
	 * @param 	boolean $withParent Indique si il faut �galement retourner le parent dans la liste
	 * @param 	boolean $reverse 	Indique si il faut renvoyer le tableau en ordre inverse
	 * @param 	varchar $level 		Indique le niveau des enfants � retourner
	 * @param 	array 	$conditions Conditions de recherches suppl�mentaires
	 * @return 	array Liste de tous les enfants du noeud parent
	 * @access	public
	 * @author	ko�ZionCMS
	 * @version 0.1 - 01/01/2012 by FI
	 * @version 0.2 - 28/02/2012 by FI - Rajout du niveau � retourner
	 */    
    function getChildren($id, $withParent = false, $reverse = true, $level = null, $conditions = array()){

		$id = (int)$id; //On force le type de l'identifiant
        $tree = $this->getTree($conditions); //R�cup�ration de l'arbre
        
		if(!isset($tree[$id])) { return array(); } //Si l'identifiant n'existe pas on retourne une valeur vide
        
		$parent = $tree[$id];
		$childs = array(); //Liste des enfants � retourner
        
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
	 * Fonction save qui va permettre soit de faire un ajout soit une �dition des donn�es
	 * @param $datas tableau des donn�es � sauvegarder
	 */
	function save($datas) {
		
		//Si la cl� id est pr�sente dans les donn�es � sauvegarder il s'agit d'un update
		if(isset($datas['id'])) { $this->edit($datas); } 
		//Sinon il s'agit d'un ajout
		else { $this->add($datas); }
	}
	
	/**
	 * Fonction add qui va ajouter une feuille dans l'arbre
	 * @param $datas tableau des donn�es � sauvegarder
	 * @param $forceInsert booleen permettant m�me si le champ id est pr�sent dans le tableau de forcer l'insert
	 */
	function add($datas, $forceInsert = false){
	
		if(!is_array($datas)) { return false; } //Si les donn�es � sauvegarder ne sont pas sous forme de tableau on retourne faux
		
		//Cas multi site o� la racine n'existe pas
		if(!isset($datas['parent_id'])) { $datas['parent_id'] = 0; } //Si la valeur du parent_id n'est pas d�finie on va lui attribuer 0 par d�faut 	
    	$parent_id = $datas['parent_id']; //On stocke cette valeur dans une variable pour plus de facilit�
		
		//   HACK SPECIAL POUR LE DEPLACEMENT D'UN NOEUD   //
    	if(isset($this->oldNewId[$parent_id])) { $parent_id = $this->oldNewId[$parent_id]; }
    	
        $tree = $this->getTree(); //R�cup�ration de l'arbre
        // pr($tree);
        //Si le parent existe dans l'arbre on va s�lectionner ses bornes gauche et droite
        if($parent_id != 0 && isset($tree[$parent_id])) {
        	
        	$parent_data = array(
				'rgt' => $tree[$parent_id]['rgt'],
        		'level' => $tree[$parent_id]['level']
        	);
        	
		//Sinon on va s�lectionner la borne la plus � droite et rejouter 1 pour l'ins�rer        	
        } else {
			//coalesce r�cup�re le premier �lement non null parmis ses arguments
        	$sql = 'SELECT (COALESCE(MAX(rgt), 0) + 1) as rgt, -1 as level FROM '.$this->table;
        	$parent_data = current($this->query($sql, true));
			// pr($parent_data);
        }
        
        //D�calage des bornes droite
        $sql = 'UPDATE '.$this->table.' SET rgt = rgt + 2 WHERE rgt >= '.$parent_data['rgt'];        
        $this->query($sql);
		// pr($sql);
        
        //D�calage des bornes gauche
        $sql = 'UPDATE '.$this->table.' SET lft = lft + 2 WHERE lft >= '.$parent_data['rgt'];
        $this->query($sql);
		// pr($sql);

        //On ajoute les donn�es manquantes aux donn�es � sauvegarder
        $datas['lft'] = $parent_data['rgt'];
		$datas['rgt'] = $parent_data['rgt'] + 1;
		$datas['level'] = $parent_data['level'] + 1;
        
		parent::save($datas, $forceInsert); //Sauvegarde des donn�es en faisant appel � la fonction parente
		
		// pr($parent_id);
		// pr($datas);
		
		// die();
		
	}
	
	/**
	 * Fonction charg�e de l'�dition d'une feuille de l'arbre
	 *
	 * @param 	array $datas Donn�es � mettre � jour
	 * @return  mixed Un bool�en si faux, un entier si vrai : la valeur de l'�l�ment cr�� si vrai
	 * @access	public
	 * @author	ko�ZionCMS
	 * @version 0.1 - 28/12/2011 by FI
	 * @todo 	28/12/2011 - A voir si au lieu de retourner faux lors du test sur l'id et la pr�sence du noeud dans l'arbre on ne fait pas appel � la fonction add
	 */
	function edit($datas) {
		
		if(!is_array($datas)) { return false; } //Si les donn�es � sauvegarder ne sont pas sous forme de tableau on retourne faux
    	    	
		$key = $this->primaryKey; //R�cup�ration de la cl� primaire
        $id = $datas['id']; //R�cup�ration de la valeur de l'identifiant
        $fields = array(); //Tableau qui va contenir la liste des champs � sauvegarder

        $tree = $this->getTree(); //R�cup�ration de l'arbre

		if(!$id || !isset($tree[$id])) { return false; } //Si l'identifiant n'existe par ou que le noeud n'est pas dans l'arbre on retourne faux
        
        $current = $tree[$id]; //R�cup�ration du noeud courant
        // pr($current);
        parent::save($datas); //Sauvegarde des donn�es en faisant appel � la fonction parente      
        // pr($id);
		
		// pr($datas['parent_id']);
		
        //Si le champ parent_id est pr�sent dans les donn�es � mettre � jour
        //ET que la valeur courante du champ parent_id et diff�rente de celle post�e
        if(isset($datas['parent_id']) && $current['parent_id'] != $datas['parent_id']) {

        	//On va extraire l'arbre, le supprimer puis l'ins�rer � la bonne place
            //On r�cup�re �galement le noeud parent          
            $curTree = $this->getChildren($id, true, false);
            // pr($curTree);
            //Pour chacun des �l�ments de l'arbre on va supprimer les valeurs lft, rgt et level car elles vont �tre recalcul�e lors de l'ajout
            foreach($curTree as $key => $node) { unset($curTree[$key]['lft'], $curTree[$key]['rgt'], $curTree[$key]['level']); }
                        
            $curTree[0]['parent_id'] = $datas['parent_id']; //On affecte au noeud parent la nouvelle valeur du champ parent
            $this->delete($id); //On supprime le noeud
                   
			// pr($curTree);
				   
            //On va parcourir le tableau d'�l�ments du noeud courant
            foreach($curTree as $key => $node){ $this->add($node, true); }//Ajouter le noeud dans l'arbre 

        }
		
		// die();
    }  

	/**
	 * Fonction charg�e de la suppression d'un �l�ment de l'arbre
	 *
	 * @param 	integer $id Identifiant du noeud � supprimer
	 * @access	public
	 * @author	ko�ZionCMS
	 * @return 	boolean Vrai si la suppression s'est correctement d�roul�e, faux sinon
	 * @version 0.1 - 28/12/2011 by FI
	 */
	function delete($id) {
    	
        $id = (int)$id; //On fait un cast sur l'id
        $tree = $this->getTree(); //R�cup�ration de l'arbre        
        if(!isset($tree[$id])) { return false; } //Si l'identifiant pass� en param�tre ne fait pas parti de l'arbre
        
        //On r�cup�re la valeur lft et rgt du noeud courant
        $curLft = $tree[$id]['lft'];
        $curRgt = $tree[$id]['rgt'];
		
		// pr($curLft);
		// pr($curRgt);
        
        //S�lection des identifiants des cat�gories � supprimer        
        //On formate le tout sous forme de tableau puis on fait appel � la fonction parente pour la suppression
        $sql = 'SELECT id FROM '.$this->table.' WHERE lft >= '.$curLft.' AND rgt <= '.$curRgt;
		
		// pr($sql);
		
        $idToDeleteTMP = $this->query($sql, true);
		// pr($idToDeleteTMP);
		
        $idToDelete = array();
        foreach($idToDeleteTMP as $v) { $idToDelete[] = $v['id']; }
        
        parent::delete($idToDelete);
		
		// pr($idToDelete);
                
        $diff = $tree[$id]['rgt'] - $tree[$id]['lft'] + 1; //On calcule la diff�rence des deux bornes supprim�es
        
        //Rebouchage des trous
        $sql = 'UPDATE '.$this->table.' SET lft = lft - :diff WHERE lft >= :lft'; //Pr�paration de la requ�te
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
	
	/**
	 * Cette fonction permet de r�cup�rer le chemin d'un noeud
	 * Fonction pratique pour la mise en place du fil d'ariane
	 *
	 * @param 	integer 	$childrenId Identifiant du noeud 
	 * @param 	varchar 	$type Type de retour souhait� (array dans son fonctionnement normal, varchar si on l'utilise dans la fonction r�cursive)
	 * @return	mixed	Soit un tableau, soit une chaine de caract�res
	 * @access	public
	 * @author	ko�ZionCMS
	 * @version 0.1 - 01/01/2012 by FI
	 * @version 0.2 - 13/04/2012 by FI - Modification des conditions de recherche
	 * @version 0.3 - 16/05/2012 by FI - Modification de la r�cup�ration des cat�gories suite � la mise en place de la gestion des sites - On ne r�cup�re pas les cat�gories de type 3
	 */    
		function getPath($childrenId, $type = 'array') {
			
			$children = $this->getTree(array('conditions' => array('id' => $childrenId))); //R�cup�ration de l'enfant    	
			$children = $children[$childrenId]; //R�cup�ration de l'enfant

			$req = array('moreConditions' => "lft<".$children['lft']." AND rgt>".$children['rgt']." AND type != 3"); //Conditions de recherche
			$node = $this->getTree($req); //On va r�cup�rer les menus
			
			if($type == 'array') {
				
				if(!empty($node)) return array_merge($node, array($childrenId => $children));
				else return array(0 => $children);
				
			//Utilis� pour la g�n�ration de la fonction r�cursive pour la mise en place de l'arbre    		
			} else if($type == 'varchar') {

				if(!empty($node)) {
					
					$path = array_merge($node, array($childrenId => $children)); //Path du noeud
					$return = ''; //Variable de retour
					foreach($path as $k => $v) { //Parcours des noeuds

						if($v['level'] > 1) { $return .= 'children.'; } //Si le level est > 0 on est sur un noeud enfant
						$return .= $v['id'].'.'; 
					}
					
					$return = substr($return, 0, strlen($return) - 1); //Suppression du dernier .
					return $return; //On retourne les donn�es
				} else {
					
					return $childrenId; //On retourne l'identifiant du noeud par d�faut
				} 
			}
		}
		
	/**
	 * Cette fonction est utilis�e pour mettre en place l'arbre avec toutes les d�pendances parents/enfants
	 *
	 * @param 	array 	$req 		param�tres de recherche
	 * @param 	integer $parentId 	Identifiants de l'�lement parent
	 * @access	public
	 * @author	ko�ZionCMS
	 * @version 0.1 - 01/01/2012 by FI
	 * @version 0.2 - 23/02/2012 by FI - Modification de la structure de la fonction pour g�rer d'un cot� l'identifiant du parent et de l'autre les conditions suppl�mentaires 
	 * @version 0.3 - 16/05/2012 by FI - Modification de la r�cup�ration des cat�gories suite � la mise en place de la gestion des sites - R�cup�ration en premier de la cat�gorie parente du site 
	 */    
		function _recursive($req = array(), $parentId = null) {
						
			//R�cup�ration de l'indentifiant de la cat�gorie racine du site
			$racineConditions = array('conditions' => array('type' => 3, 'online' => 1));
			$racine = $this->findFirst($racineConditions);
			$racineId = $racine['id'];
			
			if(empty($parentId)) { $req['conditions']['parent_id'] = $racineId; }
			else { $req['conditions']['parent_id'] = $parentId; }
					
			$nodes = $this->getTree($req); //On va r�cup�rer les menus
			foreach($nodes as $k => $v) { //On parcours l'ensemble de ces menus
				
				$path = $this->getPath($v['id'], 'varchar'); //On r�cup�re le path    		
				$this->displayTree = Set::insert($this->displayTree, $path, $v); //On ins�re l'�l�ment courant dans l'arbre
				
				//Pour savoir si le noeud courant � des enfants il suffit de faire 
				//la diff�rence entre la borne doite et la borne gauche si cette
				//valeur est > 1 il y � des enfants    		
				$diff = $v['rgt'] - $v['lft'];    		
				if($diff > 1) { $this->_recursive($req, $v['id']); } //On relance la fonction
			}
		}
	
	
	
	
	
 }