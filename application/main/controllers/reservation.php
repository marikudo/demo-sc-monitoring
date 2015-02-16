<?php
class reservation extends crackerjack{
		public function __construct(){
			parent::__construct();
		}
		public function index(){
			$this->load->render('header');
			$this->load->render('footer');
		}

		
}