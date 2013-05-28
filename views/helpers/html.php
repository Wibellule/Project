<?php

class Html{

	function __construct($controller = null){
		$this->controller = $controller;
		// pr($this);
	}

	function stripslashes_deep($value)
	{
		$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
		return $value;
	}

	
/**
 * Cette fonction est utilisée pour générer le menu frontoffice
 * Cette fonction est récursive
 * Elle ne retourne aucunes données
 *
 * @param array $categories		Liste des catégories qui composent le menu
 * @param array $breadcrumbs	Fil d'ariane utilisé pour sélectionner la catégorie courante
 * @param array $moreElements	Permet de rajouter des menus qui ne sont pas dans la table des catégories
 * @access 	public
 * @author 	koéZionCMS
 * @version 0.1 - 06/03/2012 by FI
 */	
	public function generateMenu($categories, $breadcrumbs, $moreElements = null) {
		
		if(count($categories) > 0) {		
			
			if(!empty($breadcrumbs)) { $iParentCategory = $breadcrumbs[0]['id']; } else { $iParentCategory = 0; }
			?><ul><?php			
			foreach($categories as $k => $v) {
				
				?>
				<li>
					<?php if($v['level'] == 1 && $iParentCategory == $v['id']) { $sCssMenu = ' class="menu_selected_bg"'; } else { $sCssMenu = ''; } ?>
					<a href="<?php echo Router::url('categories/view/id:'.$v['id'].'/slug:'.$v['slug']); ?>"<?php echo $sCssMenu; ?>><?php echo $v['name']; ?></a>
					<?php if(isset($v['children'])) { $this->generateMenu($v['children'], $breadcrumbs); }; ?>
				</li>
				<?php
			}

			if(isset($moreElements) && !empty($moreElements)) { 
				
				foreach($moreElements as $k => $v) {
					?>
					<li<?php if(isset($v['class'])) { ?> class="<?php echo $v['class']; ?>"<?php } ?>><a href="<?php echo $v['link']; ?>"><?php echo $v['name']; ?></a></li>
					<?php 
				}
			}
			?></ul><?php
		}		
	}
	
	
	/**
	 * Fonction qui génère le menu des catégories et sous-catégories
	 */
	 function menu($categories){
		if(count($categories) > 0){
			// pr($categories);
			// pr($this->controller->request->url);
			$iParentCategory = 0;
			?><ul>
			<!--<li class="current"><a href="<?php //echo router::url('/');?>" data-description="Tout commence ici">Accueil</a></li>-->
			<!--<li><a href="<?php //echo router::url('portefolio');?>" data-description="Tous nos projets">Portefolio</a></li>
			<li><a href="<?php //echo router::url('blog');?>" data-description="Actualités">Blog</a></li>-->
			<?php			
			foreach($categories as $k => $v) {
				?>
				<li <?php if('/'.$v['slug'].'-'.$v['id'].'.html' == $this->controller->request->url) { echo "class='current'"; } else { echo "class=''";} ?>>
					<?php 
						if($v['level'] == 1 && $iParentCategory == $v['id']) { 
							$sCssMenu = ' class="current"'; 
						} else { 
							$sCssMenu = ''; 
						} 
						// pr($v);
					?>
					<a href="<?php echo Router::url('categories/view/id:'.$v['id'].'/slug:'.$v['slug']); ?>"<?php echo $sCssMenu; ?>data-description="<?php echo $v['name'];?>"><?php echo $v['name']; ?></a>
					<?php 
						if(isset($v['children'])){
							// pr($v['children']);
							$this->menu($v['children']);
						}; 
					?>
				</li>
				<?php
			}
		}
	 }
	
	
}