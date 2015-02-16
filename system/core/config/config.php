<?php
class config{
	public $request_object;
	public $_app;
	public static $config = array();

	public function __construct(){

		
		$this->request_object = new request;
		$app = $this->request_object->getApplication();
		$appx = explode('\\',$app);
		$this->_app = APPS.$appx[0].DS;
		$file = APPS.$appx[0].DS.'config'.DS.'config'.EXT;
		require($file);
		$this->config = $config;
	}

	public function getApplicationPath(){
		return $this->_app;
	}


	public function configData(){
		unset($this->config['default_controller']);
		unset($this->config['models']);
		unset($this->config['helpers']);
		unset($this->config['libraries']);
		return $this->config;
	}



	


}