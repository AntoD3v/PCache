<?php 

/*

PCache crée par AntoZzz
Website: antozzz.fr
Twitter: @AntoZzzOfficial

*/

class PCache {

	private $folder = "cachehere/";
	private $name;
	private $value;
	private $expire = 120;

	function __construct(String $name, int $expire){
		$this->name = $name;
		$this->expire = $expire;
	}

	public function isCache() {
		if($this->folderManager()) {
			if(file_exists($this->getFolder().$this->name)) {
				if(!$this->isObselette()) {
					return true;
				}
			}
			return false;
		}else{
			die('<b>Une erreur est parvenu dans le PCache</b>: Impossible de crée le répertoire');
		}
	}

	public function getValue() {

		if($this->folderManager()) {
			if(file_exists($this->getFolder().$this->name)) {
				if(!$this->isObselette()) {
					$file_content = unserialize(base64_decode(file_get_contents($this->getFolder().$this->name)));

					if(is_array($file_content) AND isset($file_content['content'])){
						return $file_content['content'];
					}
					return false;
				}else{
					return false;
				}
			}
			return false;
		}else{
			die('<b>Une erreur est parvenu dans le PCache</b>: Impossible de crée le répertoire');
		}

	}

	public function setValue($var) {

		if($this->folderManager()) {
			if(file_exists($this->getFolder().$this->name)) {

				$this->loadPrivate();

				unlink($this->getFolder().$this->name);

				$timestamp = time() + $this->expire;

				file_put_contents($this->getFolder().$this->name, base64_encode(serialize(array('content' => $var, 'cache-expire' => $timestamp))));

				$this->removePrivate();
	
				return true;

			}else{

				$this->loadPrivate();

				$timestamp = time() + $this->expire;

				file_put_contents($this->getFolder().$this->name, base64_encode(serialize(array('content' => $var, 'cache-expire' => $timestamp))));

				$this->removePrivate();
	
				return true;
			}
			return false;
		}else{
			die('<b>Une erreur est parvenu dans le PCache</b>: Impossible de crée le répertoire');
		}

	}

	private function loadPrivate() {

		$file_name = $this->getFolder().$this->name.".lock";

		while (file_exists($file_name)) {
			if (round(microtime(true), 0) - fileatime($file_name) > 2) unlink($file_name);
			sleep(0.01);
		}

		file_put_contents($file_name, 'lock', LOCK_EX);

	}


	private function removePrivate() {

		$file_name = $this->getFolder().$this->name.".lock";

		unlink($file_name);

	}

	private function isObselette() {

		if($this->folderManager()) {
			if(file_exists($this->getFolder().$this->name)) {
				$file_content = unserialize(base64_decode(file_get_contents($this->getFolder().$this->name)));
	
				if(is_array($file_content) AND isset($file_content['cache-expire']) AND $file_content['cache-expire'] > time()){
					return false;
				}
				return true;
			}
			return true;
		}else{
			die('<b>Une erreur est parvenu dans le PCache</b>: Impossible de crée le répertoire');
		}


	}


	private function getFolder() {
		return __DIR__."/".$this->folder;
	}

	private function folderManager() {
		if(file_exists($this->getFolder())) {
			return true;
		}else{
			mkdir($this->getFolder());
			if(!file_exists($this->getFolder())) {return false;}
			return true;
		}
	}
}


?>