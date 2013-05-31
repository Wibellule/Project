<?php
	function pr($mVar2Display) {

		$debug = debug_backtrace();
		echo '<div class="status info" style="margin-left:250px;width:500px"><p><img src="'.Router::webroot('img/icons/icon_info.png').'" alt="Information" /><span>Information:</span><pre style="background-color: #EBEBEB; border: 1px dashed black; width: 97%; padding: 10px;">';
		print_r($mVar2Display);
		print_r("\n".'[FILE]:'.$debug[0]['file']."\n");
		print_r('[LINE]:'.$debug[0]['line']."\n");
		echo '</pre></div>';
	}

	function prTab($mVar2Display){
		print_r($mVar2Display);
	}

	/**
	 * Fonction qui transforme une balise <img /> avec son lien, en adresse pour un lien <a>
	 * @param $req array tableau qui contient les balises à traiter
	 * @param $multi boolean true si plusieurs lien sinon false
	 * @return $result array tableau des liens
	 */
	function imgToLink($req, $multi = true){
		if($multi){
			foreach($req as $k => $v){
				/*multi link*/
				$tabLink = array();
				$tabLink = explode('<img alt="" src="', $v['content']);
				foreach($tabLink as $k => $v){
					$tabLink[$k] = stristr($tabLink[$k],'" style="',true);
				}
				$tabLink = array_slice($tabLink,1);
			}
		}else{
			foreach($req as $k => $v){
				/*single link*/
				$tabLink = array();
				$tabLink = explode('<img alt="" src="', $v['content']);
				$tabLink = implode('',$tabLink);
				$tabLink = stristr($tabLink, '" style', true);
			}
		}	
		return $tabLink;
	}

	/**
	 * Recursively strips slashes from all values in an array
	 *
	 * @param array $values Array of values to strip slashes
	 * @return mixed What is returned from calling stripslashes
	 * @link http://book.cakephp.org/view/1138/stripslashes_deep
	 */
	function stripslashes_deep($values) {
		if (is_array($values)) {
			foreach ($values as $key => $value) {
				$values[$key] = stripslashes_deep($value);
			}
		} else {
			$values = stripslashes($values);
		}
		return $values;
	}	