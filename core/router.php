﻿<?php
class Router {
	
	static $routes = array();	
	static $prefixes = array();	
	static $extensions = array('.html', '.csv', '.xml', '.txt', '.sql', '.pot');	
	
	/**
	* Fonction qui permet de d�terminer la liste des prefixes
	*/	
	static function prefix($url, $prefix) {
		
		self::$prefixes[$url] = $prefix; //On indique la correspondance entre le prefixe de l'url et le prefix des fonctions dans les controllers
	}
	
	/**
	* Permet de paser une url
	* @param $url url a parser
	* @param $request objet de type Request
	* @return tableau contenant les param�tres 
	*/
	static function parse($url, $request) {
		
		$url = trim($url, '/'); //On enl�ve les / en d�but et fin de chaine
		$url = str_replace(Router::$extensions, '', $url); //On enl�ve l'extension
		
		//Gestion du cas j'arrive sur la racine
		if(empty($url)) { $url = Router::$routes[0]['url']; }
		else {

			$match = false; //par d�faut �a ne match pas
			
			//On va analyser les urls et v�rifier que l'on ne tombe pas dans le cas d'un catcher
			foreach(Router::$routes as $v) {
				
				if(!$match && preg_match($v['redirreg'], $url, $match)) {
					
					$url = $v['origin'];
					
					//Modification pour integrer plusieurs url pour la galerie
					// pr($request);
					// pr($url);
					$req_exp = explode('/',$request->url);
					// pr($req_exp);
					if($req_exp[1] == 'portefolio'){
						$req = explode('/',$url);
						// pr($req);
						$req[0] = 'projects';
						// pr($req);
						$url = implode('/',$req);
					}
					// die();
					///////////////////////////////////////////////////////////
					foreach($match as $k => $v) {
						
						$url = str_replace(':'.$k.':', $v, $url);
						// pr($url);
						// die();
					}
					$match = true;					
				}			
			}
		}		
		
		$params = explode('/', $url); //On r�cup�re l'url sous forme de tableau
		
		//Le systeme d'admin n'ayant pas besoin d'url r��crite on peut se positionner � ce niveau
		//On va tester si le premier param�tre de l'url figure dans le tableau des prefixes
		if(in_array($params[0], array_keys(self::$prefixes))) {
			
			//Si oui on va initialiser une nouvelle valeur � request
			$request->prefix = self::$prefixes[$params[0]];
			array_shift($params); //Par d�faut params commence par la cl� du prefixe on va donc d�caller d'un valeur pour qu'il commence bien par le controller
		}		
		
		$request->controller = $params[0]; //Initialisation du controller
		$request->action = isset($params[1]) ? $params[1] : 'index'; //On va tester si une action est demand�e, sinon on affecte la fonction index par d�faut
		
		//HACK pour �viter que les fonctions du back ne puissent etre accessible avec une url du type front
		//ex --> post/admin_edit/19
		// C'est de la que vient le backoffice_
		foreach(self::$prefixes as $k => $v) { //R�cup�ration des pr�fixes
			
			if(strpos($request->action, $v.'_') === 0) { //Si il est pr�sent dans la fonction
				
				$request->prefix = $v; //On injecte le prefixe dans le request
				$request->action = str_replace($v.'_', '', $request->action); //Et on remplace l'action
			}
		}
		// pr($request->prefix);
		// pr($request->action);
		// pr($request);
		// pr($_SESSION);
		$request->params = array_slice($params, 2); //On fait passer ensuite l'ensemble des �ventuels param�tres au tableau
		return true;
	}

	/**
	* Cette fonction va initialiser dans la classe une variable contenant la liste des urls possibles
	*
	* @param varchar $redir Url de redirection
	* @param varchar $url Url de d�part
	*/	
	static function connect($redir, $url) {
		
		$r = array();		
		$r['params'] = array();
		$r['url'] = $url;
		
		//$r['redir'] = $redir;
				
		//On va retravailler cette r�gle pour avoir un tableau de r�sultats dans la fonction url qui soit plus coh�rent
		//cl� avec la valeur du champ et non une valeur num�rique				
		//on r�cup�re deux valeurs : 
		// - la premiere r�cup�re tout ce qui est avant les : lettres et chiffres r�p�t�s plusieurs fois
		// - la seconde tout ce qui est apr�s et qui se termine par un /
		//On r�cup�re ensuite ces valeurs dans ${1} et ${2}
		//et on va transformet pour avoir ?P<id> --> permet de r�cup�rer dans le r�sultat de l'expression r�guli�re les valeurs avec comme cl� les variables
		//On va travailler en deux fois la premiere fois on va modifier $url puis apres on travaille sur $r['origin'] pour eviter les erreur avec les \
		
		$r['originreg'] = preg_replace('/([a-z0-9]+):([^\/]+)/', '${1}:(?P<${1}>${2})', $url);
		$r['originreg'] = str_replace('/*', '(?P<args>/?.*)', $r['originreg']);
		$r['originreg'] = '/^'.str_replace('/', '\/', $r['originreg']).'$/'; 
		
		$r['origin'] = preg_replace('/([a-z0-9]+):([^\/]+)/', ':${1}:', $url);
		$r['origin'] = str_replace('/*', ':args:', $r['origin']);
		
		//On va analyser l'url pass�e au Router dans le fichier conf.php 
		$params = explode('/', $url); 
		foreach($params as $k => $v) {
			
			//On recherche les valeurs contenants un :
			if(strpos($v, ':')) {
				
				//On va refaire un explode sur :
				$p = explode(':', $v);
				
				//On ajoute les parametres � $r
				$r['params'][$p[0]] = $p[1];				
			}
		}
		
		//On va cr�er une nouvelle variable qui va contenir l'url de base avec les expression reg de remplacement
		$r['redirreg'] = $redir;
		
		//Traitement pour les appels direct d'action
		$r['redirreg'] = str_replace('/*', '(?P<args>/?.*)', $r['redirreg']); 
		
		foreach($r['params'] as $k => $v) {
			
			$r['redirreg'] = str_replace(":$k", "(?P<$k>$v)", $r['redirreg']);			
		}
		$r['redirreg'] = '/^'.str_replace('/', '\/', $r['redirreg']).'$/'; //On va convertir le format de l'url pour qu'il soit compr�hensible pour le preg_match
		
		$r['redir'] = preg_replace('/:([a-z0-9]+)/', ':${1}:', $redir);
		$r['redir'] = str_replace('/*', ':args:', $r['redir']); //On va convertir le format de l'url pour qu'il soit compr�hensible pour le preg_match
		
		self::$routes[] = $r; //On injecte les routes dans le tableau de classe
		// Router::promote(3);
		// pr(self::$routes);
	}
	
	/**
	* Permet de construire une url
	*
	* @param varchar $url Url de la page � atteindre
	* @param boolean $extension Indique si il faut ou non mettre l'extension html
	* @return varchar Url format�e
	*/		
	static function url($url = '', $controller = null, $extension = 'html') {
		
		trim($url, '/');
		
		//debug(self::$routes);
		
		//Parcours de toutes les routes
		foreach(self::$routes as $v) {
		
		// if($controller = 'projects'){
			// Router::promote(4);
			// pr(self::$routes);
			// die();
		// }
			//Si la route parcourue correspond � une url stock�e dans la classe
			if(preg_match($v['originreg'], $url, $match)) {
				
				//debug($match);
				$url = $v['redir'];
				//On va parcourir les r�sultats
				foreach($match as $k => $w) {
					
					//Et on ne travaille que sur les cl�s non num�rique
					//if(!is_numeric($k)) {
						
						$url = str_replace(":$k:", $w, $url); //On remplace les cl�s par leurs valeurs
						// pr($url);
					//}
				}
			}
		}
		
		//On va v�rifier si un prefixe n'est pas � mettre en place pour une url
		foreach(self::$prefixes as $k => $v) {
			
			if(strpos($url, $v) === 0) { //Si il trouve une correspondance de prefixe
				
				$url = str_replace($v, $k, $url); //On le remplace dans l'url ex : Router::prefix('cockpit', 'admin');
			}
		}
		
		$url = str_replace('//', '/', '/'.$url);
		if($url != '/') { $url .= '.'.$extension; } //Cas ou on est pas sur la racine du site
		return BASE_URL.$url;
	}
	
	/**
	* Lien vers le dossier webroot
	*
	* @param varchar $url Url du lien
	* @return varchar Url format�e
	*/	
	static function webroot($url) {
			
		trim($url, '/');
		return BASE_URL.str_replace('//', '/', '/'.$url);		
	}	
	
	/**
	* Promote a route (by default, the last one added) to the beginning of the list
	*
	* @param integer $which A zero-based array index representing the route to move. For example,
	*    if 3 routes have been added, the last route would be 2.
	* @return boolean Returns false if no route exists at the position specified by $which.
	*/
	static function promote($which = null) {
		if ($which === null) {
			$which = count(self::$routes) - 1;
		}
		if (!isset(self::$routes[$which])) {
			return false;
		}
		$route =& self::$routes[$which];
		unset(self::$routes[$which]);
		array_unshift(self::$routes, $route);
		// pr(self::$routes);
		return true;
	}
}