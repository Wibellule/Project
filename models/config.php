<?php
/**
 * Modèle permettant la gestion de la configuration de du template et de l'application
 */
class Config extends Model {
	
/**
 * Tableau contenant l'ensemble des configurations à insérer lors de la création d'une nouvelle langue
 *
 * @var 	array
 * @access 	public
 * @author 	koéZionCMS
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
 * Cette fonction va permettre lors de l'ajout d'un langue d'insérer les données de configurations
 * 
 * @param	varchar $locale Code de la langue
 * @access 	public
 * @author 	koéZionCMS
 * @version 0.1 - 18/04/2012 by FI
 */	
	/*function init_configs_for_locales($locale) {
				
		foreach($this->initConfigs as $config) {

			$config['locale'] = $locale;
			$this->save($config);
		}		
	}*/
}