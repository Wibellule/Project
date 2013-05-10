<?php
class Form{
	
	/**
	* Variable contenant l'objet controler ayant fait appel au formulaire
	*/
	public $controller;
	public $msgerr;

	/**
	* Variable contenant les options à ne pas prendre en compte lors de la mise en place des attributs input
	*/
	var $escapeAttributes = array('type' => '', 'displayError' => '', 'label' => '', 'div' => '', 'value' => '', 'datas' => '');
	//François
	// var $escapeAttributes = array('type', 'displayError', 'label', 'div', 'value', 'datas');
	
	/**
	* Constructeur de la classe
	* @param object $view Vue par laquelle la classe est utilisée
	* @access public
	*/
	function __construct($controller = null){
		$this->controller = $controller;
		// pr($this);
	}
	
	/**
	* Cette fonction créer le formulaire avec les options indiquées
	* @param array $options Tableau des options possibles
	* @return varchar chaine de caractère contenant la balise de début de formulaire
	* @access public
	*/
	public function create($options){
		$html = '';
		$html .= '<form ';
		foreach($options as $k=>$v){
			$html .= $k.'="'.$v.'" '; 
			$html .= $k.'="'.$v.'" ';
		}
		$html .= '>';
		return $html;
	}
	
	/**
	* Cette fonction va créer les différents type de champs
	* Les valeurs possibles pour le paramètre options sont:
	* - type : type de champs input --> hidden, text, textarea, checkbox, radio, file, password, select
	* - label : si vrai la valeur retournée contiendra le champ label
	* - div : si vrai la valeur retournée sera contenu dans une div
	* - displayError : si vrai affiche les erreurs sous les champs input
	* - value : si renseignée cette valeur sera insérée dans le champs input
	* - tooltip : si renseignée affichera un tooltip à coté du label
	* - wysiwig : si renseigné et à vrai alors le code de l'éditeur sera généré
	*
	* @param varchar $name 		Nom du champ input
	* @param varchar $label 	Label pour le champ input
	* @param array $options 	Options par défaut
	* @return varchar 			Chaine html
	* @access public
	*/
	public function input($name,$label,$options = array()){
	
		//Liste des options par défaut
		$defaultOptions = array(
			'type' 		=> 'text',
			'label' 	=> true,
			'value' 	=> false
		);
		$options = array_merge($defaultOptions, $options);//Génération du tableau d'options
		
		//text,textarea,checkbox
		//id, name, values par défaut et les attributs
				
		$attributs = array_merge($options,$this->escapeAttributes);//Fusionne les deux tableaux
		$result = array_diff($attributs,$this->escapeAttributes);//Fait la différence pour faire ressortir les attributs
		// pr($result);

		//Chargement automatique du model
		// pr($this->controller->request->controller);
		$modelName = ucfirst(substr($this->controller->request->controller,0,-1));
		
		//Gestion des labels d'erreurs
		$html = '<div class="controls">';
		if(isset($this->controller->$modelName->errors)){
			// pr($this->controller->Categorie->errors);
			$msgerr = $this->controller->$modelName->errors;
			if($this->controller->$modelName->validate){
				$classError = ' error';
				// pr($msgerr);
				if(isset($msgerr[$name])){
					// pr($msgerr);
					$html .=	'<div class="control-group'.$classError.'"><label class="control-label" for="input'.$name.'">'.$msgerr[$name].'</label>';
					// pr($msgerr[$name]);
				}
			}else{
				$classError = '';
				$msgerr = '';
			}
		}
		
		
		//Attributs
		$attr = '';
		foreach($result as $k=>$v){
		
			//Correction François
			// if(!in_array($k, $this->escapeAttributes)){$attr .= " $k=\"$v\"";}
			$attr .= " $k=\"$v\"";
		}
		// pr($attr);
		
		$name = $this->_set_input_name($name);//Mise en variable du nom
		$inputIdText = $this->_set_input_id($name);//Mise en variable de l'id
		$value = $this->_get_input_value($name,$options['value']);
		// pr($value);
		
		// pr($options['datas']);
		
		// pr($options['type']);
		//Gestion des champs cachés
		if($options['type'] == 'hidden'){
			return '<input type="hidden" name="'.$name.'" id="'.$inputIdText.'" value="'.$value.'">';
		}
		
		// $html .= '';//Variable qui va contenir le html
		// $html = '<p>';//Variable qui va contenir le html
		
		if($options['label']){ $html .= '<label for="'.$inputIdText.'">'.$label.'</label>'; }
		{ $html .= ''; }
		
		//Les différents type de champs selon le type
		switch($options['type']){
			case 'text':
				$html .= '<input type="text" id="'.$inputIdText.'" name="'.$name.'" value="'.$value.'" '.$attr.'>';
			break;
			case 'textarea':
				$html .= '<textarea id="'.$inputIdText.'" name="'.$name.'" '.$attr.'>'.$value.'</textarea>';
			break;
			case 'checkbox':
				// $html .= '<input type="checkbox" value="'.$value.'" id="'.$inputIdText.'Id" name="'.$name.'" '.$attr.'>';
				$html .= '<input type="hidden" id="'.$inputIdText.'" name="'.$name.'" value="0">';
				$html .= '<input type="checkbox" id="'.$inputIdText.'" name="'.$name.'" value="1" '.(empty($value)?'':'checked').'>';//Si on coche ce champ prend le dessus
			break;
			case 'radio':
				foreach($options['radios'] as $v){
					$html .= '<input type="radio" id="'.$inputIdText.'" name="'.$name.'" value="'.$v.'">'.$v;
				}
			break;
			case 'password':
				$html .= '<input type="password" name="'.$name.'" id="'.$inputIdText.'Id" value="'.$value.'" '.$attr.' >';
			break;
			case 'file':
				$html .= '<input type="file" name="'.$name.'" id="'.$inputIdText.'Id" '.$attr.' >';
			break;
			case 'select':
				$html .= '<select id="'.$inputIdText.'" name="'.$name.'"';
				
				//Gestion des champs multiple
				if(isset($options['multiple']) && $options['multiple']){ $html .= 'multiple="multiple"';}
				$html .= $attr.'>';
				
				//Gestion des options
				foreach($options['datas'] as $k => $v){
					if($value == $v){ $selected=' selected="selected"'; } else { $selected = ''; }
					// $html .= '<option value="'.$k.'"'.$selected.'>'.$v.'</option>';
					$html .= '<option value="'.$v.'"'.$selected.'>'.$v.'</option>';
				}
				
				//Hack pour éviter une erreur si l'option est vide
				if(count($options['datas']) == 0){ $html .= '<option></option>';}
				$html .= '</select>';
			break;
			case 'submit':
				$html .= '<input type="submit" name="'.$name.'" id="'.$inputIdText.'Id">';
			break;
		}
		// return $html.'</p>';
		return $html.'</div>';
	}
	
	/**
	* Cette fonction va gérer la fin du formulaire
	* @param boolean $full Booléen indiquant si on ne retourne que la fermeture du formulaire ou le bouton + la fermeture 
	* @return varchar Chaine de caractéres contenant la balise de fin de formulaire
	* @access public
	*/
	public function end($full = false){
		$html = '</form>';
		if($full){
			$htmlFull = '<div class="form-actions"><button class="btn btn-success" type="submit">Valider</button></div>';
			$html = $htmlFull.$html;
		}
		return $html;
	}
	
	/**
	* Fonction qui permet la création de la chaine de caractère qui sera le name du champ name
	* En retour celle ci donnera une chaine du type Category[desc][fr]
	* @param varchar $name Nom du champ
	* @return varchar Chaine de caractères contenant la valeur de l'attribut name du champ
	* @access protected
	*/
	protected function _set_input_name($name){
		$name = explode(".",$name);// On crée un tableau par rapport au caractère .
		$return = '';// Variable retournée par défaut vide
		foreach($name as $k => $v){
		
			//Par défaut lors du premier passage on ne va pas mettre les []
			//Elles ne seront mise qu'à partir du second niveau
			if(strlen($return) == 0){ $return .= $v; }
			else{ $return .= '['.$v.']'; }
		}
		return $return;
		// pr($name);
	}
	
	/**
	* Cette fonction permet la création de la chaine de caractère qui sera le ID du champ input
	* Le paramètre principal est le name du champ input
	* @param varchar $id ID du champ input
	* @return varchar Chaine de caractère contenant la valeur de l'identifiant du champ input
	* @access protected
	*/
	protected function _set_input_id($id){
		$return = 'input_'.$id;
		$return = str_replace('[', ' ', $return);
		$return = str_replace(']', ' ', $return);
		$return = Inflector::camelize(/*Inflector:variable(*/$return/*)*/);
		return $return;
	}
	
	/**
	* Cette fonction permet la récupération de la valeur par défaut du champs input
	* @param varchar $name Nom du champ
	* @param mixed $defaultValue Valeur par défaut
	* @return mixed Valeur du champ input
	* @access protected
	*/
	protected function _get_input_value($name,$defaultValue){
		//Si les données ont été postées
		if(!isset($this->controller->request->data['name']) && $defaultValue) { return $defaultValue; }
		//Sinon on retourne celles postées
		else{ return Set::classicExtract($this->controller->request->data, $name);}
	}
	
	function ckeditor($input){
	
		if(!is_array($input)) $input = array($input);
		ob_start();
		?><script type="text/javascript"><?php
		
			foreach($input as $k => $v){
				$inputIdText = $this->_set_input_id($v);
				?>
				//Plusieurs variable sinon conflits
				var ck_<?php echo $inputIdText; ?>_editor = CKEDITOR.replace('<?php echo $inputIdText;?>');
				CKFinder.setupCKEditor( ck_<?php echo $inputIdText; ?>_editor , '<?php echo Router::webroot('/js/ckfinder/');?>');
				// alert('<?php echo Router::webroot('/js/ckfinder/');?>');
				<?php 
			} 
			
		?></script><?php
		return ob_get_clean();
	}
}









