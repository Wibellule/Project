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
	 
	/**
	 * Fonction qui affiche un formulaire de contact pour le frontoffice
	 * @return $html tout le html pour le formulaire de contact sur le frontoffice
	 * @access public
	 * @author Gyome
	 * @version 0.1
	 * @todo 02/06/13 appeler le html de manière (beaucoup) plus dynamique
	 */
	public function contact($id,$slug){
		
		$html = '';
		
		$html .= '<div class="three-fourth last">';

		$html .= '<h3>Gardons le contact</h3>';

		$html .= '<form action="'.Router::url('categories/view/id:'.$id.'/slug:'.$slug).'" method="post" class="contact-form" id="form-contact">';
			
		$html .= '<p class="input-block">';
				$html .= '<label for="contact-name"><strong>Nom</strong> (obligatoire)</label>';
				$html .= '<input type="text" name="name" value="" id="contact-name" required>';
				// $html .= '<input type="text" name="name" value="" id="contact-name">';
		$html .= '</p>';

		$html .= '<p class="input-block">';
				$html .= '<label for="contact-email"><strong>Email</strong> (obligatoire)</label>';
				$html .= '<input type="email" name="email" value="" id="contact-email" required>';
				// $html .= '<input type="email" name="email" value="" id="contact-email">';
		$html .= '</p>';
				
		$html .= '<p class="input-block">';
				$html .= '<label for="contact-subject"><strong>Sujet</strong></label>';
				$html .= '<input type="text" name="subject" value="" id="contact-subject">';
		$html .= '</p>';

		$html .= '<p class="textarea-block">';
				$html .= '<label for="contact-message"><strong>Votre Message</strong> (obligatoire)</label>';
				$html .= '<textarea name="content" id="contact-message" cols="88" rows="6" required></textarea>';
				// $html .= '<textarea name="message" id="contact-message" cols="88" rows="6"></textarea>';
		$html .= '</p>';
			
				$html .= '<div class="hidden">';
					$html .= '<label for="contact-spam-check">Do not fill out this field:</label>';
					$html .= '<input name="spam-check" type="text" value="" id="contact-spam-check" />';
				$html .= '</div>';

				$html .= '<input type="submit" value="Envoyer">';

				$html .= '<div class="clear"></div>';

			$html .= '</form>';

		$html .= '</div><!-- end .three-fourth.last -->';
		
		return $html;
	
	}
	
	/**
	 * Fonction qui va générer le formulaire pour les commentaires des articles
	 */
	 public function comment($id,$slug){
	 
		$html = '';
		$html .= '<section id="respond">';

			$html .= '<h6 class="section-title">Laisser un commentaire</h6>';

			$html .= '<form method="post" class="comments-form" id="comments-form" action="'.Router::url('posts/view/id:'.$id.'/slug:'.$slug.'/prefix:article').'">';
			
				$html .= '<input type="hidden" name="article" value="'.$id.'"/>';
				
				$html .= '<p class="input-block">
					<label for="comment-name"><strong>Nom</strong> (required)</label>
					<input type="text" name="name" value="" id="comment-name" required>
				</p>

				<p class="input-block">
					<label for="comment-email"><strong>Email</strong> (required)</label>
					<input type="email" name="email" value="" id="comment-email" required>
				</p>
				
				<p class="input-block">
					<label for="comment-url"><strong>Site Web</strong></label>
					<input type="url" name="url" value="" id="comment-url">
				</p>

				<p class="textarea-block">
					<label for="comment-message"><strong>Votre commentaire</strong> (required)</label>
					<textarea name="message" id="comment-message" cols="88" rows="6" required></textarea>
				</p>';
			
				$html .= '<input type="submit" value="Envoyer">

				<div class="clear"></div>

			</form>
			
		</section>';
		
		return $html;
	 
	 }
	
	
}