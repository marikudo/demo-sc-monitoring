<?php
if(!defined('APPS')) exit ('No direct access allowed');

class user extends crackerjack_model{
	public function __construct(){
		parent::__construct();
	}

	public function data($id){
		$result =  $this->crud->read("SELECT * FROM _xusers WHERE xusers_id=:id",array(':id'=>$id),'assoc');
		$get = $this->crud->read('SELECT role FROM _xroles WHERE xroles_id = :id',array(':id'=>$result['xroles_id']),'assoc');
		$result['role'] = $get['role'];
		return $result;
	}

	public function isPasswordCorrect($id,$password){
		$return  = false;
			$result = $this->data($id);
				if ($result) {
					$dbpasswrod = $this->hash->decryptMe_($result['password']);
					if ($password==$dbpasswrod) {
						$return = true;
					}
			}

		return $return;
	}
}