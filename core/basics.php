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
	
	
	/**
	 * Gets an environment variable from available sources, and provides emulation
	 * for unsupported or inconsistent environment variables (i.e. DOCUMENT_ROOT on
	 * IIS, or SCRIPT_NAME in CGI mode). Also exposes some additional custom
	 * environment information.
	 *
	 * @param  string $key Environment variable name.
	 * @return string Environment variable setting.
	 * @link http://book.cakephp.org/2.0/en/core-libraries/global-constants-and-functions.html#env
	 */
		function env($key) {
			if ($key === 'HTTPS') {
				if (isset($_SERVER['HTTPS'])) {
					return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
				}
				return (strpos(env('SCRIPT_URI'), 'https://') === 0);
			}

			if ($key === 'SCRIPT_NAME') {
				if (env('CGI_MODE') && isset($_ENV['SCRIPT_URL'])) {
					$key = 'SCRIPT_URL';
				}
			}

			$val = null;
			if (isset($_SERVER[$key])) {
				$val = $_SERVER[$key];
			} elseif (isset($_ENV[$key])) {
				$val = $_ENV[$key];
			} elseif (getenv($key) !== false) {
				$val = getenv($key);
			}

			if ($key === 'REMOTE_ADDR' && $val === env('SERVER_ADDR')) {
				$addr = env('HTTP_PC_REMOTE_ADDR');
				if ($addr !== null) {
					$val = $addr;
				}
			}

			if ($val !== null) {
				return $val;
			}

			switch ($key) {
				case 'SCRIPT_FILENAME':
					if (defined('SERVER_IIS') && SERVER_IIS === true) {
						return str_replace('\\\\', '\\', env('PATH_TRANSLATED'));
					}
					break;
				case 'DOCUMENT_ROOT':
					$name = env('SCRIPT_NAME');
					$filename = env('SCRIPT_FILENAME');
					$offset = 0;
					if (!strpos($name, '.php')) {
						$offset = 4;
					}
					return substr($filename, 0, -(strlen($name) + $offset));
				case 'PHP_SELF':
					return str_replace(env('DOCUMENT_ROOT'), '', env('SCRIPT_FILENAME'));
				case 'CGI_MODE':
					return (PHP_SAPI === 'cgi');
				case 'HTTP_BASE':
					$host = env('HTTP_HOST');
					$parts = explode('.', $host);
					$count = count($parts);

					if ($count === 1) {
						return '.' . $host;
					} elseif ($count === 2) {
						return '.' . $host;
					} elseif ($count === 3) {
						$gTLD = array(
							'aero',
							'asia',
							'biz',
							'cat',
							'com',
							'coop',
							'edu',
							'gov',
							'info',
							'int',
							'jobs',
							'mil',
							'mobi',
							'museum',
							'name',
							'net',
							'org',
							'pro',
							'tel',
							'travel',
							'xxx'
						);
						if (in_array($parts[1], $gTLD)) {
							return '.' . $host;
						}
					}
					array_shift($parts);
					return '.' . implode('.', $parts);
			}
			return null;
		}
		
	
