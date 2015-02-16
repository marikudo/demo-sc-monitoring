<?php

/*
* Autoloading models class and helpers
* 
*/

/*loading models automatically e.g. array('db','model1');
*default models
*	-db
*/
$config['models'] = array();

//Helpers
//e.g. array('default','helper1');
$config['helpers'] = array('generals');

//Libararies
$config['libraries'] = array('session','hash');