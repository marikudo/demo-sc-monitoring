<?php
/*
* Loader file for the MVC framework
*
*/
if(!defined('APPS')) exit ('No direct access allowed');

class Loader{

	protected static $instance;
	protected $_config = array();
	protected $application_path;
	public function __construct(){

			self::$instance =& $this;
			$object = new config;
			$this->application_path = $object->getApplicationPath();
			$file = $this->application_path.'config'.DS.'autoload.php';
			require($file);
			$this->_config = $config;
			$this->auto_models($this->_config['models']);
			//$this->_config['helpers'] = array('generals');
			$this->auto_helpers($this->_config['helpers']);
			$this->auto_libraries($config['libraries']);
			/*$a = new config;
			$application = $a->application->getApplication();
			$config  = APPS.$application."config"*/
			/*if(!empty($config['time_zone'])){
				date_default_timezone_set($config['time_zone']);
			}*/


	}

	/*
	param @template: require your templates
	*/
	public function render($name = '',array $data = NULL,$template = false){
		$file = $this->application_path.'views'.DS.$name.EXT;
		if(file_exists($file)){
				if(isset($data)){
					extract($data);
				}
			require($file);
			return TRUE;

		}
		throw new Exception("Error Processing view ".$name);
	}


	public function model($name){
		$this->auto_models($name);
	}

	public function helper($name){

		$this->auto_helpers($name);
	}

	public function libraries($name){
		$this->auto_libraries($name);
	}
	private function auto_models($models){

		if(is_array($models)){
			foreach ($models as $key => $value) {
				$file = SYSLIBS.'model'.DS.$value.EXT;
				if ($value=='db') {
					$file = SYSLIBS.'database'.DS.$value.EXT;
				}
				if(file_exists($file)){
					require_once $file;
					$mvc =Registry::getInstance();
					$mvc->$value = new $value();
				}else{
					$filename = $this->application_path.'model'.DS.$value.EXT;
					if (file_exists($filename)) {
						require_once $filename;
						$mvc =Registry::getInstance();
						$mvc->$value = new $value();
					}else{
						header('HTTP/1.0 404 Not Found');
                		header('Status: 404 Not Found');
                		echo '<pre>404 File Not Found : '.$value.EXT.' model</pre>';
					}

				}

			}
			return;
		}
		throw new Exception("cannot access non-array variable", 1);

	}

	private function auto_helpers($helper){
		if(is_array($helper)){
				foreach ($helper as $value) {

				$file = SYSLIBS.'helper'.DS.$value.EXT;
				if(file_exists($file)){
					require_once $file;
				}else{
					$filename = $this->application_path.'helper'.DS.$value.EXT;
					if (file_exists($filename)) {
						require_once $filename;
					}else{
						header('HTTP/1.0 404 Not Found');
                		header('Status: 404 Not Found');
                		echo '<pre>404 File Not Found : '.$value.EXT.' helper</pre>';
					}

				}

			}
			return;
		}
		throw new Exception("cannot access non-array variable", 1);

	}


	private function auto_libraries($libs){
		if(is_array($libs)){
			foreach ($libs as $value) {

				$file = SYSLIBS.'libraries'.DS.$value.EXT;
				if(file_exists($file)){
					require_once $file;
					$mvc =Registry::getInstance();
					$mvc->$value = new $value();
				}else{
					$filename = $this->application_path.'libraries'.DS.$value.EXT;
					if (file_exists($filename)) {
						require_once $filename;
						$mvc =Registry::getInstance();
						$mvc->$value = new $value();
					}else{
						header('HTTP/1.0 404 Not Found');
                		header('Status: 404 Not Found');
                		echo '<pre>404 File Not Found : '.$value.EXT.' libraries</pre>';
					}

				}

			}
			return;
		}
		throw new Exception("cannot access non-array variable", 1);

	}


}