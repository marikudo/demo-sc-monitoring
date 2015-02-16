<?php
if(!defined('APPS')) exit ('No direct access allowed');

class admin_actions extends crackerjack_model{
	public function __construct(){
		parent::__construct();
	}

	public function createlog($data){
		return $this->crud->create('_xactivity_logs',$data,array());
	}
	
}