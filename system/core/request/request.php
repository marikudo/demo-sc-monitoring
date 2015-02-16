<?php
/**
 * Request class
 * sanitation and segments of url
 */

if(!defined('SYSLIBS')) exit ('No direct access allowed');

class request{

		protected $_app;
		private $_controller;
		private $_method;
		private $_args;
		private $_dir;
		private $_temp = false;
    private $_config = array();
    private $hasApp = false;
		public function __construct(){
			
		      $ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? true:false;
    			$sp = strtolower($_SERVER['SERVER_PROTOCOL']);
    			$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    			$port = $_SERVER['SERVER_PORT'];
    			$port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    			$host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
   			 	$full_url = $protocol . '://'.$host.$port.$_SERVER['REQUEST_URI'];
		    	
          $url_segment = parse_url($full_url, PHP_URL_PATH );
          $needle = '/';

          $replace = str_replace('/','\\',$url_segment); 

          $root = explode('\\',rtrim(ROOT,"\\"));

        //  print_r($root);

          $requestURI = str_replace($root,"", $url_segment);
          $cleanURI =  $this->trimSlashes($requestURI);
              if ($cleanURI=='') {
                  $requestURI = DEFAULT_APP;
                   $config_file = APPS.'main'.DS.'config'.DS.'config.php';
                    if (file_exists($config_file)){
                         require($config_file);
                        $y[] = $requestURI;
                        $y[] = $config['default_controller'];
                        $y[] = 'index';
                    }
                }
          $endSlash === "" || substr($cleanURI, -strlen($needle)) === $needle;
          $cleanURI = $this->cleanIt($cleanURI);
          $app_uri = str_replace($_SERVER['SCRIPT_NAME'],"",$_SERVER['PHP_SELF']);
          $app_uri = rtrim($app_uri,"/");
          $app_uri = ltrim($app_uri,"/");
          $app_uri = $this->cleanIt($app_uri);
          $app_uri = ($app_uri=="") ? DEFAULT_APP : $app_uri;

          $segmentation = explode('/',str_replace("-","_",$app_uri));
         
          $segments = $segmentation[0];
          $app = APPS.$segmentation[0];

          $controller = null;
          $method = 'index';
          $params = array();
       
            if (is_dir($app)) {
               $config_file = $app.DS.'config'.DS.'config.php';
                    if (file_exists($config_file))
                         require($config_file);
                      
                     // print_r($config);
                   $file = APPS.$segments.DS."controllers".DS.$segmentation[1].EXT;
                     $controller = $config['default_controller'];

                            if ($segmentation[1]!="") {
                                $controller = $segmentation[1];
                                if ($segmentation[2]!="") {
                                   $method = $segmentation[2];
                                     if (count($segmentation) > 3){
                                         $z = array();
                                          foreach ($segmentation as $key => $value) {
                                              if ($key > 2) {
                                                $val = $this->cleanIt($value);
                                                if ($val !="") {
                                                 $z[] = $val;
                                                }
                                              }
                                          }
                                        $params = $z;  
                                     }
                                }
                            }            

            }else{
                $segments = DEFAULT_APP;
                  $config_file = APPS.$segments.DS.'config'.DS.'config.php';
                    if (file_exists($config_file))
                         require($config_file);
                          $file = APPS.$segments.DS."controllers".DS.$segmentation[0].EXT;
                          $controller = $segmentation[0];
                            if ($segmentation[1]!="") {
                              $method = $segmentation[1];

                                 if (count($segmentation) > 2){
                                  $z = array();
                                  foreach ($segmentation as $key => $value) {
                                   
                                      if ($key > 1) {
                                        $val = $this->cleanIt($value);
                                        if ($val !="") {
                                         $z[] = $val;
                                        }
                                      }
                                  }
                                $params = $z;
                                
                         }

                   }
            }


            $this->_app = $segments;
           // echo "<br />";
             $this->_controller= $controller;
            //echo "<br />";
            $this->_method = $method;
            //echo "<br />";
            $this->_args = $params;

              if ($method=='index' || count($params) <= 0) {
                unset($this->_args);
              }


      /* $this->_app = $this->cleanIt($y[0]);
       $this->_controller = $this->cleanIt($y[1]);
       $this->_method = $this->cleanIt($y[2]);
       $this->_args = (isset($y[3])) ? $y[3] : null;*/

		}

    public function getApplication(){
        return $this->_app;
    }

    public function getController(){
      return $this->_controller;
    }

    public function getMethod(){
      return $this->_method;
    }

    public function getParams(){
      return $this->_args;
    }


    private function isExist($config_file){
       if (file_exists($config_file)){
              require($config_file);
                $this->_config = $config;
              return true;
             }else{
            die("file not exists : ".$config_file);
       }
    }

    public function cleanIt($string)
    {
      return preg_replace('/\?.*/', '', str_replace('-', '_', $string));
    }

    private function trimSlashes($subject){
        $subject = ltrim($subject,"/");
        $subject = rtrim($subject,"/");
        return $subject;
    }

    private function getAppConfig($app){
      $file = APPS.$app.DS.'config'.DS.'config.php';
      $result = false;
      if (file_exists($file)){
          require_once($file);
         return $config;
      }        
    }

}