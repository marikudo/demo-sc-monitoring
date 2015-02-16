<?php

function islogin(){
		$mvc =Registry::getInstance();
		 if($mvc->session->_get('islogin')==true){
			return true;
		}else{
			return false;
	} 
}
