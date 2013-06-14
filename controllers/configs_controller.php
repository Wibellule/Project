﻿<?php
class ConfigsController extends AppController {
	
//////////////////////////////////////////////////////////////////////////////////////////
//										BACKOFFICE										//
//////////////////////////////////////////////////////////////////////////////////////////	

	/**
	* Cette fonction va permettre l'affichage des configurations de la base de donn�es
	*
	* @access 	public
	* @author 	ko�ZionCMS
	* @version 0.1 - 02/03/2012 by FI
	* @version 0.2 - 18/04/2012 by FI - Modification de la proc�dure de gestion des configurations de la base de donn�es, maintenant uniquement deux configurations locale et production
	*/
	function backoffice_database_liste() { 
		
		//Import de la librairie de gestion des fichiers de configuration
		require_once ROOT.DS.'core'.DS.'ConfigMagik'.DS.'class.ConfigMagik.php';
		$cfg = new ConfigMagik( ROOT.DS.'configs'.DS.'database.ini', true, true);
		
		//Si des donn�es sont post�es
		if($this->request->data) {
		
			foreach($this->request->data as $section => $config) { 
				
				foreach($config as $k => $v) { $cfg->set($k, $v, $section); } 
			}
			
			Session::setFlash("Fichier de configuration modifi�"); //Message de confirmation
			$this->redirect('backoffice/configs/database_liste'); //Redirection
		}
		
		//On va r�cup�rer la liste des donn�es de configuration de la base de donn�es (Configurations locale et de production)		
		$sections = $cfg->listSections(); //R�cup�ration des diff�rentes sections du fichier de configuration
		foreach($sections as $section) { $this->request->data[$section] = $cfg->get($section); } //On parcours les sections et on r�cup�re les donn�es que l'on affecte "aux donn�es post�es" 
	}

	/**
	* Cette fonction va permettre l'affichage des configurations des envois de mails
	*
	* @access 	public
	* @author 	ko�ZionCMS
	* @version 0.1 - 02/03/2012 by FI
	* @version 0.2 - 18/04/2012 by FI - Passage des traitements dans une fonction priv�e pour mutualiser
	*/
	// function backoffice_mailer_liste() { 
		
		// $currentWebsite = Session::read('Backoffice.Websites.current'); //Site courant
		// $websitesList = Session::read('Backoffice.Websites.details'); //Liste des sites
		// $currentWebsiteUrl = $websitesList[$currentWebsite]['url']; //Url du site courant
		// $this->_proceed_datas_ini(CONFIGS.DS.'files'.DS.'mailer.ini', 'backoffice/configs/mailer_liste', CURRENT_WEBSITE_ID, $currentWebsiteUrl); 
	// }
	
	/**
	* Cette fonction va permettre l'affichage des configurations des routes
	*
	* @access 	public
	* @author 	ko�ZionCMS
	* @version 0.1 - 02/03/2012 by FI
	* @version 0.2 - 18/04/2012 by FI - Passage des traitements dans une fonction priv�e pour mutualiser
	*/
	// function backoffice_router_liste() { $this->_proceed_datas_ini(CONFIGS.DS.'files'.DS.'routes.ini', 'backoffice/configs/router_liste'); }

	/**
	* Cette fonction va permettre l'affichage des configurations des posts
	*
	* @access 	public
	* @author 	ko�ZionCMS
	* @version 0.1 - 22/03/2012 by FI
	* @version 0.2 - 18/04/2012 by FI - Passage des traitements dans une fonction priv�e pour mutualiser
	*/
	// function backoffice_posts_liste() { $this->_proceed_datas_ini(CONFIGS.DS.'files'.DS.'posts.ini', 'backoffice/configs/posts_liste'); }
	
	/**
	* Cette fonction va permettre l'affichage du code de s�curit� utilis� pour les taches planifi�es
	*
	* @access 	public
	* @author 	ko�ZionCMS
	* @version 0.1 - 10/09/2012 by FI
	*/
	// function backoffice_security_code_liste() { $this->_proceed_datas_ini(CONFIGS.DS.'files'.DS.'security_code.ini', 'backoffice/configs/security_code_liste'); }	

	/**
	* Cette fonction va permettre de supprimer les fichiers de cache
	*
	* @access 	public
	* @author 	ko�ZionCMS
	* @version 0.1 - 07/01/2013 by FI
	*/
	// function backoffice_delete_cache() {
		
		// Cache::delete_cache_directory(TMP.DS.'cache'.DS);
		// Session::setFlash("Cache supprim�"); //Message de confirmation
		// $this->redirect('backoffice/configs/delete_cache_result'); //Redirection
	// }	
	
	/**
	* Cette fonction va permettre l'affichage du message de confirmation lors de la suppression du cache
	*
	* @access 	public
	* @author 	ko�ZionCMS
	* @version 0.1 - 23/01/2013 by FI
	*/
	// function backoffice_delete_cache_result() {}	
	
//////////////////////////////////////////////////////////////////////////////////////
//										AJAX										//
//////////////////////////////////////////////////////////////////////////////////////
	
	/**
	* Cette fonction est utilis�e par l'�diteur de texte pour r�cup�rer le chemin de base des css de l'application
	*
	* @access 	public
	* @author 	ko�ZionCMS
	* @version 0.1 - 18/01/2013 by FI
	*/
	// public function backoffice_ajax_get_css_editor() {
	
		// $this->layout = 'ajax'; //D�finition du layout � utiliser
		
		// $currentWebsiteId = Session::read("Backoffice.Websites.current");
		// $websiteLayout = Session::read("Backoffice.Websites.details.".$currentWebsiteId.".tpl_layout");
		// $websiteLayoutCode = Session::read("Backoffice.Websites.details.".$currentWebsiteId.".tpl_code");
		
		// $this->set('baseUrl', BASE_URL);
		// $this->set('websiteLayout', $websiteLayout);
		// $this->set('websiteLayoutCode', $websiteLayoutCode);
	// }
	
	/**
	* Cette fonction est utilis�e par l'�diteur de texte pour r�cup�rer le chemin de base de l'application
	*
	* @access 	public
	* @author 	ko�ZionCMS
	* @version 0.1 - 18/01/2013 by FI
	*/
	// public function backoffice_ajax_get_baseurl() {
	
		// $this->layout = 'ajax'; //D�finition du layout � utiliser		
		
		// $currentWebsiteId = Session::read("Backoffice.Websites.current");
		// $websiteLayout = Session::read("Backoffice.Websites.details.".$currentWebsiteId.".tpl_layout");
		// $websiteLayoutCode = Session::read("Backoffice.Websites.details.".$currentWebsiteId.".tpl_code");
		
		// $this->set('baseUrl', BASE_URL);
		// $this->set('websiteLayout', $websiteLayout);
	// }		

//////////////////////////////////////////////////////////////////////////////////////////////////
//										FONCTIONS PRIVEES										//
//////////////////////////////////////////////////////////////////////////////////////////////////	

	/**
	* Cette fonction va permettre l'affichage et la modification des fichiers ini sans section
	*
	* @param	varchar $file		Fichier ini � charger
	* @param	varchar $redirect	Page de redirection
	* @access 	private
	* @author 	ko�ZionCMS
	* @version 0.1 - 18/04/2012 by FI
	*/
	// function _proceed_datas_ini($file, $redirect, $section = null, $websiteUrl = null) {
	
		// require_once(LIBS.DS.'config_magik.php'); //Import de la librairie de gestion des fichiers de configuration
		
		//Cr�ation d'une instance
		// if(isset($section)) { $cfg = new ConfigMagik($file, true, true); }
		// else { $cfg = new ConfigMagik($file, true, false); }
	
		//Si des donn�es sont post�es
		// if($this->request->data) {
			
			// if(isset($section)) {
				
				// foreach($this->request->data as $k => $v) { $cfg->set($k, $v, $section); }
				// $cfg->set('website_url', $websiteUrl, $section); //On va rajouter l'url du site dans les configurations pour information
				
			// } else {

				//On va parcourir les donn�es post�es et mettre � jour le fichier ini
				// foreach($this->request->data as $k => $v) { $cfg->set($k, $v); }
			// }

			// Session::setFlash("Fichier de configuration modifi�"); //Message de confirmation
			// $this->redirect($redirect); //Redirection			
		// }	

		//R�cup�ration des configurations
		// if(isset($section)) { $this->request->data = $cfg->keys_values($section); }
		// else { $this->request->data = $cfg->keys_values(); }
	// }
}