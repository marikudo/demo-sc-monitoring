<?php

/*
* Autoloading models class and helpers
* 
*/

/*loading models automatically e.g. array('db','model1');
*default models
*	-db
*/
$config['models'] = array('db','crud','user_auth','user','permission','gData','admin_actions');

//Helpers
//e.g. array('default','helper1');
$config['helpers'] = array('natsession','generals','permissionhelpers','testin');

//Libararies
$config['libraries'] = array('session','hash','form','template');