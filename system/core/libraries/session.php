<?php
/**
 *  Session
 */

if(!defined('APPS')) exit ('No direct access allowed');

 if(session_start() == false){
          session_start();
         }

class session{
    protected $alias = '';
    public function __contruct(){
      
    }

    public function _set($var){
       $this->getCOnfig();
        if (is_array($var)) {
            foreach ($var as $key => $value) {
               
                if (is_array($value)) {
                    //print_pre($value);
                    $k = $key;
                    foreach ($value as $key2 => $val) {
                        $k2 = $key2;
                        $val2 = $val;
                        if (is_array($val2)) {
                            $_SESSION[$this->alias]["$k"]["$k2"] = $val2;
                        }else{
                             $_SESSION[$this->alias]["$k"]["$k2"] = "$val2";
                        }
                    }
                }else{
                       // echo $k."-".$key2." = ".$value2;
                 //  print_pre($value);
                    $_SESSION[$this->alias]["$key"] = "$value";
                    
                }
			   
            }
			
        }
    }

    public function _get($key) {
	$this->getCOnfig();

             if (!isset($_SESSION[$this->alias]["$key"])) {
                $_SESSION[$this->alias]["$key"] = "";
                
            } 

        return $_SESSION[$this->alias]["$key"];
    }

    protected function getCOnfig(){
         $con = new config;
        $this->alias = $con->config['alias'];
    }

    public function _destroy(){
        session_destroy();
        session_unset();
    }

    public function _unset($key=null){
        $this->getCOnfig();
            unset($_SESSION[$this->alias]);
    }

    public function _alias(){
        $this->getCOnfig();
        return $this->alias;
    }



}