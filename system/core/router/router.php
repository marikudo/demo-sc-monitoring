<?php
/**
 * Routing of url
 */


if(!defined('APPS')) exit ('No direct access allowed');

class router{

		private function __construct(){
		}

		public function route(Request $request){
			
			$application = $request->getApplication();
			$controller = $request->getController();
			$method = $request->getMethod();
			$params = $request->getParams();
			$appx = explode('\\',$application);
			$app = APPS.$application.DS.'controllers'.DS.$controller.EXT;
				if (count($appx) > 1) {
					$app = APPS.$appx[0].DS.'controllers'.DS.$appx[1].DS.$controller.EXT;
				}

			

			if (file_exists($app)) {
				require_once $app;
				$object = new $controller();
					if (method_exists($object, $method)) {
						if(!empty($params)){
							$object->{$method}($params);
						}else{
							/* FOR recontructions due to error of private methods
							------------------*/
							$object->{$method}();
						}
					}else{
						header('HTTP/1.0 404 Not Found');
		                header('Status: 404 Not Found');
		                echo ucfirst($method).' not exists on '.ucfirst($controller.EXT);
					}
			}else{
				echo "xxx";
				header('HTTP/1.0 404 Not Found');
                header('Status: 404 Not Found');
                echo '<pre>404 File Not Found</pre>';
			}
			
		}

	
}

