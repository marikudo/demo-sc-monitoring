<?php
if(!defined('APPS')) exit ('No direct access allowed');

class user_auth extends crackerjack_model{
	public function __construct(){
		parent::__construct();
	}

	public function validate($username,$password){
		$return = false;
		$result = $this->email_exists($username);
			if ($result) {
					$dbpasswrod = $this->hash->decryptMe_($result['password']);
					if ($password==$dbpasswrod) {
						
						unset($result['password']);
						$return = $result;
					}
			}
		return $return;
	}

	public function email_exists($email){
		$return = false;
		$result = $this->crud->read("SELECT * FROM _xusers WHERE email=:username",array(':username'=>$email),'assoc');
			if ($result) {
				$return = $result;
			}
		return $return;
	}

	public function forgot($email){
		$result = $this->email_exists($email);
			if ($result) {
				$return = $result;				
			}
		return $return;
	}



}