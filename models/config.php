<?php
/**
 * Mod�le permettant la gestion de la configuration de du template et de l'application
 */
class Config extends Model {
	
	// var $validate = array(
		// 'localhost.host' => array(
			// 'rule' 		=> 'notEmpty',
			// 'message' 	=> "Vous devez indiquer un host"
		// ),
		// 'localhost.database' => array(
			// 'rule'		=> 'notEmpty',
			// 'message'	=> "Vous devez indiquer une base de donn�e"
		// ),
		// 'localhost.login' => array(
			// 'rule'		=> 'notEmpty',
			// 'message'	=> "Le login ne doit pas �tre vide"
		// ),
		// 'online.host' => array(
			// 'rule'		=> 'notEmpty',
			// 'message'	=> "Vous devez indiquer une base de donn�e"
		// ),
	// );
	
/**
 * Tableau contenant l'ensemble des configurations � ins�rer lors de la cr�ation d'une nouvelle langue
 *
 * @var 	array
 * @access 	public
 * @author 	ko�ZionCMS
 * @version 0.1 - 18/04/2012 by FI
 */	
	/*var $initConfigs = array(
		array('name' => 'txt_page_newsletter', 'code' => 'NEWSLETTER'),
		array('name' => 'code_google_analytics', 'code' => 'GA'),
		array('name' => 'seo_page_title', 'code' => 'SEO'),
		array('name' => 'seo_page_description', 'code' => 'SEO'),
		array('name' => 'seo_page_keywords', 'code' => 'SEO'),
		array('name' => 'txt_home_slogan', 'code' => 'TXT_HOME'),
		array('name' => 'txt_home_posts', 'code' => 'TXT_HOME'),
		array('name' => 'footer_colonne_gauche', 'code' => 'FOOTER'),
		array('name' => 'footer_social', 'code' => 'FOOTER'),
		array('name' => 'footer_colonne_droite', 'code' => 'FOOTER'),
		array('name' => 'footer_bottom', 'code' => 'FOOTER'),
		array('name' => 'txt_page_wait', 'code' => 'WAIT')
	);*/
	
/**
 * Cette fonction va permettre lors de l'ajout d'un langue d'ins�rer les donn�es de configurations
 * 
 * @param	varchar $locale Code de la langue
 * @access 	public
 * @author 	ko�ZionCMS
 * @version 0.1 - 18/04/2012 by FI
 */	
	/*function init_configs_for_locales($locale) {
				
		foreach($this->initConfigs as $config) {

			$config['locale'] = $locale;
			$this->save($config);
		}		
	}*/
}